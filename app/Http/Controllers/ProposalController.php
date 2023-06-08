<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Proposal;
use App\Models\Rama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('user')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    public function index()
    {
        if (Auth::user()->role_id !== 3){
            $proposals = Proposal::with('user', 'project', 'rama')->paginate(20);

            return view('proposals.index', compact('proposals'));
        }
        $proposals = Proposal::where('user_id', Auth::user()->id)->with('project', 'rama')->paginate(20);

        return view('proposals.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rama = Rama::all();

        return view('proposals.create', compact('rama'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:10', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:255'],
            'archive' => ['required', 'file', 'mimes:pdf'],
            'rama_id' => ['required', 'integer', 'exists:' . Rama::class . ',id'],
        ]);

        $project=Project::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $proposal = Proposal::create([
            'user_id' => Auth::user()->id,
            'project_id' => $project->id,
            'rama_id' => $request->rama_id,
            'status' => 0,
        ]);

        $proposal->archive = $request->file('archive');
        $proposal->archive = 'proposals/' . $proposal->id . '_' . date('Y-m-d') . '_'. $request->file('archive')->getClientOriginalName();
        $request->file('archive')->storeAs('public', $proposal->archive);

        $proposal->save();

        return redirect()->route('proposals.index')->with('status', 'Proposal created');
    }

    public function show($id)
    {
        $proposal = Proposal::where('id', $id)->with('user','project', 'rama')->first();

        return view('proposals.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
