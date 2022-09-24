<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index() : Response
    {
        return Inertia::render('AdminDashboard',[
            'isAdmin' => Auth::user()->hasRole('admin'),
            'users' => User::all(),
        ]);
    }
}
