<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class ApiNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Нам необходимо получить id пользователя. Для этого:
        $token = ($request->headers->all('authorization')); //Получаем токен из заголовка текущего запроса
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://jwt/api/auth/me',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json',
                'Authorization: '.$token[0]
                ),
        ));
        //Отправляем запрос на функцию me которая нам вернет запись текущего пользователя
        $response = curl_exec($curl);
        curl_close($curl);

        $user = User::find(json_decode($response)->id); //И тут му можем уже сделать выборку по id пользователя
        $note = $user->notes()->get(); //Получаем все записи текущего пользователя
        return $note;
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
        //Нам необходимо получить id пользователя. Для этого:
        $token = ($request->headers->all('authorization')); //Получаем токен из заголовка текущего запроса
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://jwt/api/auth/me',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json',
                'Authorization: '.$token[0]
            ),
        ));
        //Отправляем запрос на функцию me которая нам вернет запись текущего пользователя
        $response = curl_exec($curl);
        curl_close($curl);

        $user = User::find(json_decode($response)->id); //И тут му можем уже сделать выборку по id пользователя
        $note = new Note();
        $note->record = $request->record;
        $user->notes()->save($note);
        return $note;
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
        //Нам необходимо получить id пользователя. Для этого:
        $token = ($request->headers->all('authorization')); //Получаем токен из заголовка текущего запроса
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://jwt/api/auth/me',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json',
                'Authorization: '.$token[0]
            ),
        ));
        //Отправляем запрос на функцию me которая нам вернет запись текущего пользователя
        $response = curl_exec($curl);
        curl_close($curl);

        $user = User::find(json_decode($response)->id); //И тут му можем уже сделать выборку по id пользователя
        $note->record = $request->record;
        $user->notes()->save($note);
        return $note;
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
