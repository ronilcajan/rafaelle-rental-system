<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $user = auth()->user();
        
        $this->authorize('view_user', $user);
            
        return view('users.profile', compact('user'));
    }
}