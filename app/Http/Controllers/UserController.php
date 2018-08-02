<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
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

        /*if (!request()->hasFile('avatar')) { //controllo se nella request c'è una chiave album_thumb altrimenti torno false
            dd("non c'è");
        }
        $file = request()->file('avatar'); // salvo nella variabile l'oggetto uploadedFile
        if (!$file->isValid()) { // controllo se il file contiene errori torno false altrimenti procedo
            dd("non valido");
        }*/

        $user->update($request->validated());

        //$user->name = $request->get('name');
        //$user->email = $request->get('name');
        //$user->save();

        //avendo impostato come disco di default per il salvataggio il disco public nel file config/filesystem.php non
        // serve che passo alcun parametro aggiuntivo, se in quale caso particolare voglio dichiare un disco diverso
        // da quello di default posso passare come 2° parametro il disco di salvataggio tra quelli configurati (local, public, S3)
        //$filePath = $file->store(env('ALBUM_THUMB_DIR')); // do libertà al laravel di creare un file con un nome random
        //$fileName = "album_" . $user->id . '.' . $file->extension();
        //$filePath = $file->storeAs('images/album_thumbs', $fileName); // imposto il nome del file
        //$user->avatar = $filePath;

        //$user->save();

        return redirect()->route('dashboard');
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
    }
}
