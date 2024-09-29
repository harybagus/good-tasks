<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::query()
            ->whereNot('id', '1')
            ->latest()
            ->get();

        return view('dashboard', [
            'users' => $users
        ]);
    }
}
