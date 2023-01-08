<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('profile', ['user' => auth()->user()]);
    }
    
    public function destroy()
    {
        $user = auth()->user();

        $user->delete();

        return to_route('home')->with(auth()->logout());
    }
    
    public function changePassword()
    {
        $user = auth()->user();

        $this->validate(request(), [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) 
            {
                // Check if the entered current password hash matches the current users password hash
                if (!Hash::check($value, $user->password))
                    $fail('Norādīta parole nav pareiza');
            }],
            'new_password' => 'required|different:current_password|confirmed|min:8|max:191|string'
        ]);

        // Set & save the hashed new password
        $user->password = Hash::make(request('new_password'));
        $user->save();

        return to_route('login')->with(auth()->logout());
    }
}
