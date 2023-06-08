<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(): View
    {
        $users = User::with('role')->paginate(20);
        $usersDeleted = User::onlyTrashed()->with('role')->paginate(20);

        return view('users.index', compact('users', 'usersDeleted'));
    }

    public function create(): View
    {
        $roles = Roles::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['title' => ['required', 'string', 'max:255'], 'name' => ['required', 'string', 'max:255'], 'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class], 'password' => ['required', Rules\Password::defaults(), 'confirmed'], 'role_id' => ['required', 'integer', 'exists:' . Roles::class . ',id'],]);
//        dd($request->all());

        $user = User::create(['title' => $request->title, 'name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password ?? 'password'), 'role_id' => $request->role_id,]);

        return redirect()->route('users.index')->with('success', 'User ' . $user->name . ' created successfully.');
    }

    public function show($id): JsonResponse
    {
        //busca el usuario con el id que se le pasa por parametro incluyendo en los borrados
        $user = User::withTrashed()->find($id);

        return response()->json($user);
    }

    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Roles::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $request->validate(['title' => ['string', 'max:255'], 'name' => ['string', 'max:255'], 'email' => ['string', 'email', 'max:255'], 'password' => [Rules\Password::defaults()], 'role_id' => ['integer', 'exists:' . Roles::class . ',id'],]);

//         dd($request->all());

        return redirect()->route('users.index')->with('success', 'User ' . $user->name . ' updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User ' . $user->name . ' deleted successfully.');
    }

    public function restore($id): RedirectResponse
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();

        return redirect()->route('users.index')->with('success', 'User ' . $user->name . ' restored successfully.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();

        return redirect()->route('users.index')->with('success', 'User ' . $user->name . ' permanently deleted successfully.');
    }
}
