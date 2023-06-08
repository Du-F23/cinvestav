<?php

namespace App\Http\Controllers;

use App\Models\Rama;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RamaController extends Controller
{
    public function __construct()
    {
        $this->middleware('visor');
    }

    public function index(): View
    {
        $ramas=Rama::paginate(20);
        $ramasDeleted=Rama::onlyTrashed()->paginate(20);

        return view('ramas.index', compact('ramas', 'ramasDeleted'));
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description'=>'required|string|max:255',
        ]);

        Rama::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('ramas.index')->with('status', 'Rama created successfully.');
    }

    public function show($id): JsonResponse
    {
        $rama=Rama::withTrashed()->find($id);

        return response()->json($rama);
    }

    public function edit($id)
    {
        $rama=Rama::find($id);

        return view('ramas.edit', compact('rama'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description'=>'required|string|max:255',
        ]);

        $rama=Rama::find($id);

        $rama->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('ramas.index')->with('status', 'Rama updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $rama=Rama::find($id);

        $rama->delete();

        return redirect()->route('ramas.index')->with('success', 'Rama deleted successfully.');
    }

    public function restore($id): RedirectResponse
    {
        $rama=Rama::onlyTrashed()->find($id);

        $rama->restore();

        return redirect()->route('ramas.index')->with('success', 'Rama restored successfully.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $rama=Rama::onlyTrashed()->find($id);

        $rama->forceDelete();

        return redirect()->route('ramas.index')->with('success', 'Rama deleted successfully.');
    }
}
