<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        // Get search query
        $search = $request->input('search');
        
        // Query users with search filter if provided
        $users = User::when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10); // Paginate with 10 users per page

        return view('user.list', compact('users'));
    }
}