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
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        if (isset($user_id))
        {
            $user = User::find($user_id); //И тут му можем уже сделать выборку по id пользователя
            $note = $user->notes()->get(); //Получаем все записи текущего пользователя
            return $note;
        }
        else
        {
            $message = array(
                'massage' => 'User ID not found'
            );
            return $message;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        if (isset($user_id))
        {
            $user = User::find($user_id); //И тут му можем уже сделать выборку по id пользователя
            $note = new Note();
            $note->record = $request->record;
            $user->notes()->save($note);
            return $note;
        }
        else
        {
            $message = array(
                'massage' => 'User ID not found'
            );
            return $message;
        }
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
        $user_id = auth()->user()->id;

        if (isset($user_id))
        {
            $user = User::find($user_id); //И тут му можем уже сделать выборку по id пользователя
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
            'massage' => 'Deleted'
        );
        return $message;
    }
}
