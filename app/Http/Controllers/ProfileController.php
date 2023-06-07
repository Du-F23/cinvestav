<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function changePicture(Request $request): RedirectResponse{
        $request->validate([
            'img' => 'required|image',
        ]);
        $user=Auth::user();

        $user->img = $request->file('img');
        //renombra la imagen con el id del usuario y la fecha actual
        $user->img = 'profile/' . $user->id . '_' . date('Y-m-d') . '.' . $request->file('img')->getClientOriginalExtension();

//        dd($request->file('img'));
        //guarda la imagen en la carpeta storage/app/public/profile con el nombre que se le ha dado
        $request->file('img')->storeAs('public', $user->img);
        //guarda la imagen en la base de datos
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Profile picture updated');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'title' => ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
        ]);

        $user = Auth::user();

        $user->update($request->only('title', 'name', 'email'));

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
