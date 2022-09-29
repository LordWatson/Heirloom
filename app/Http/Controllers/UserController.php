<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index() : Response
    {
        $users = UserResource::collection(User::all());

        return Inertia::render('Users/Index',[
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(User $user) : Response
    {
        return Inertia::render('Users/Edit',[
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user) : RedirectResponse
    {
        /*
         * Email should be unique, but that doesn't work if the email is the existing users email
         * So we tell the validation to ignore the unique rule when this happens
         * */
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['string', 'required', 'email', 'max:255',
                    Rule::unique('users')->ignore($user),
                ],
        ]);

        $user->update($validated);

        return Redirect::route('user.index')->with('message', 'User updated successfully.');
    }

    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();

        return Redirect::back()->with('message', 'User deleted successfully.');
    }
}
