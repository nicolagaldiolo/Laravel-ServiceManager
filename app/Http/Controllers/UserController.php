<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Auth::user());

        $users = User::get();

        if(request()->wantsJson() || request()->expectsJson()) {
            return DataTables::of($users)->addColumn('actions', function($user){
                return implode("", [
                    '<a href="' . route('users.edit', $user) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>',
                    '<a href="' . route('users.destroy', $user) . '" class="delete btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
                ]);
            })->rawColumns(['actions'])->make(true);
        }

        return view('users.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Auth::user());

        return view('users.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewUserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        User::create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('type', 'success')
            ->with('status', 'User created with success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('view', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->validated());

        if((Auth::user()->id == $user->id) && !$user->isAdmin()){
            return redirect()->route('dashboard');
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if(request()->wantsJson() || request()->expectsJson()) {
            $redirect = (Auth::user() == $user) ? route('login') : '';
            (bool) $res = $user->delete();
            return [
                'redirect' => $redirect,
                'message' => $res ? 'Domain deleted' : 'Domain not deleted',
                'status' => $res
            ];
        }

        if(Auth::user() == $user){
            $user->delete();
            return redirect()->route('login');
        }
    }
}
