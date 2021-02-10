<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class ApiNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registration']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user()->id;
        if (isset($user))
        {
            $user = User::find($user); //И тут му можем уже сделать выборку по id пользователя
            $note = $user->notes()->get(); //Получаем все записи текущего пользователя
            return $note;
        }
        else
        {
            $message = array(
                'massage' => 'Unauthorized'
            );
            return $message;
        }


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
        $user = auth()->user()->id;
        if (isset($user))
        {
            $user = User::find($user); //И тут му можем уже сделать выборку по id пользователя
            $note = new Note();
            $note->record = $request->record;
            $user->notes()->save($note);
            return $note;
        }
        else
        {
            $message = array(
                'massage' => 'Unauthorized'
            );
            return $message;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $user = auth()->user()->id;

        if (isset($user))
        {
            $user = User::find($user); //И тут му можем уже сделать выборку по id пользователя
            $note->record = $request->record;
            $user->notes()->save($note);
            return $note;
        }
    else
        {
            $message = array(
                'massage' => 'Unauthorized'
            );
            return $message;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        $message = array(
            'massage' => 'Удалено'
        );
        return $message;
    }
}
