<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Proposal;
use App\Models\Rama;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    public function index(): View
    {
        if (Auth::user()->role_id !== 3) {
            $proposals = Proposal::with('user', 'project', 'rama')->paginate(20);

            return view('proposals.index', compact('proposals'));
        }
        $proposals = Proposal::where('user_id', Auth::user()->id)->with('project', 'rama')->paginate(20);

        return view('proposals.index', compact('proposals'));
    }

    public function create(): View
    {
        $ramas = Rama::all();

        return view('proposals.create', compact('ramas'));
    }

    public function store(Request $request)
    {

//        dd($request->all());
        $request->validate(['name' => ['required', 'string', 'min:10', 'max:255'], 'description' => ['required', 'string', 'min:10', 'max:255'], 'archive' => ['required', 'file', 'mimes:pdf'], 'rama_id' => ['required', 'integer', 'exists:' . Rama::class . ',id'],]);

        $project = Project::create(['name' => $request->name, 'description' => $request->description,]);

        $proposal = Proposal::create(['user_id' => Auth::user()->id, 'project_id' => $project->id, 'rama_id' => $request->rama_id, 'status' => 0,]);

        $proposal->archive = $request->file('archive');
        $proposal->archive = 'proposals/' . $proposal->id . '_' . date('Y-m-d') . '_' . $request->file('archive')->getClientOriginalName();
        $request->file('archive')->storeAs('public', $proposal->archive);

        $proposal->save();

        return redirect()->route('proposals.index')->with('status', 'Proposal created');
    }

    public function show($id): View
    {
        $proposal = Proposal::where('id', $id)->with('user', 'project', 'rama')->first();

//        return response()->json($proposal);
        return view('proposals.show', compact('proposal'));
    }

    public function edit($id)
    {
        $proposal = Proposal::where('id', $id)->with('user', 'project', 'rama')->first();
        $ramas = Rama::all();

        return view('proposals.edit', compact('proposal', 'ramas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => ['required', 'string', 'min:10', 'max:255'], 'description' => ['required', 'string', 'min:10', 'max:255'], 'rama_id' => ['required', 'integer', 'exists:' . Rama::class . ',id'],]);

        if ($request->file('archive')) {
            $request->validate(['archive' => ['required', 'file', 'mimes:pdf'],]);
        }

        $proposal = Proposal::where('id', $id)->first();
        $project = Project::where('id', $proposal->project_id)->first();

        $proposal->update(['user_id' => Auth::user()->id, 'project_id' => $project->id, 'rama_id' => $request->rama_id,]);

        $project->update(['name' => $request->name, 'description' => $request->description,]);

        if ($request->file('archive')) {
            //busca en el storage la ruta del archivo y lo elimina
            $path=Storage::path('public/' . $proposal->archive);
            unlink($path);
            $exists = Storage::disk('public')->exists($proposal->archive);
            if ($exists) {
                Storage::disk('public')->delete($proposal->archive);
            }

            //guarda el nuevo archivo
            $proposal->archive = $request->file('archive');
            $proposal->archive = 'proposals/' . $proposal->id . '_' . date('Y-m-d') . '_' . $request->file('archive')->getClientOriginalName();
            $request->file('archive')->storeAs('public', $proposal->archive);

            $proposal->save();
        }

        return redirect()->route('proposals.index')->with('status', 'Proposal updated');
    }

    public function destroy($id)
    {
        //
    }

    public function downloadFile($id): BinaryFileResponse
    {
        $proposal = Proposal::where('id', $id)->first();
        $path = storage_path('app/public/' . $proposal->archive);

        return response()->download($path);
    }

    public function evaluate(Request $request, $id)
    {
        $proposal = Proposal::where('id', $id)->first();
        $proposal->status = $request->statusUpdate;
        $proposal->save();

//        dd($proposal);

        return redirect()->route('proposals.index')->with('status', 'Proposal evaluated');
    }
}
