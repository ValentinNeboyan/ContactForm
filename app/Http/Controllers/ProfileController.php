<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.profile.index', [
            'user'=>Auth::user()
        ]);
    }

    /**
     * show form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('user.profile.update', [
            'user'=>Auth::user()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('profile', 'public');
            Auth::user()->update([
                'avatar' =>'/storage/'. $path,
            ]);
        }

        Auth::user()->update([
            'name' => $request->name,
        ]);

        return back();
    }
}
