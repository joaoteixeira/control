<?php

namespace App\Http\Controllers;

use Mail;
use App\Key;
use App\Person;
use App\Room;
use App\ListaEnvio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Adldap\Laravel\Facades\Adldap;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('activities.index');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = Person::where('qr_code', $request->data)->with('campi')->first();

        if ($person) {
            $dateNow = (new \DateTime('NOW'))->format('Y-m-d');

            $keys = $person->keys()->wherePivot('devolucao', null)->whereDate('retirada', '<', $dateNow);

            if ($keys->count()) {
                return response()->json(['success' => true, 'tipo' => 'pendencia', 'data' => [
                    'person' => $person,
                    'keys'   => $keys->with('room')->get()
                ]]);
            }

            return response()->json(['success' => true, 'tipo' => 'person', 'data' => $person]);
        }

        $key = Key::where('qr_code', $request->data)->with('room')->first();

        if ($key) {
            $tipo = $key->disponivel ? 'key' : 'devolucao';

            return response()->json(['success' => true, 'tipo' => $tipo, 'data' => $key]);
        }

        return response()->json(['success' => false]);
    }

    public function take(Request $request)
    {
        $person = Person::where('qr_code', $request->person)->first();
        $key = Key::where('qr_code', $request->key)->first();

        if ($person && $key) {

            $keyRetidara = $person->keys()->wherePivot('devolucao', null)->where('room_id', $key->room_id);

            if ($keyRetidara->count()) {
                return response()->json(['success' => false, 'tipo' => 'copia_retirada', 'data' => [
                    'key'    => $keyRetidara->with('room')->first(),
                    'person' => $person
                ]
                ]);
            }

            $person->keys()->attach($key->id, ['retirada' => (new \DateTime('NOW'))->format('Y-m-d H:i:s')]);
            $key->disponivel = false;
            $key->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function back(Request $request)
    {
        $key = Key::where('qr_code', $request->key)->first();

        $people = $key->people()->get();

        $personSelect = null;
        $id = null;
        $email = null;

        foreach ($people as $person) {
            if (empty($person->pivot->devolucao)) {
                $id = $person->pivot->id;
                $nome = $person->nome;
                $email = $person->email;
                break;
            }
        }

        if ($id) {
            DB::table('keys_has_people')->where('id', $id)->update(['devolucao' => (new \DateTime('NOW'))->format('Y-m-d H:i:s')]);

            $key->disponivel = true;
            $key->save();

            ListaEnvio::create(['nome' => $nome, 'email' => $email, 'dados' => json_encode(['key' => $key->qr_code])]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function checkUser(Request $request)
    {
        $user = Adldap::search()->where('samaccountname', '=', $request->user)->first();

        if (!$user)
            return response()->json(['success' => false, 'tipo' => 'user_not_found']);

        if (!$user->isActive())
            return response()->json(['success' => false, 'tipo' => 'user_disabled']);

        $username = $request->user . '@ifro.local';
        if (!Adldap::auth()->attempt($username, $request->password))
            return response()->json(['success' => false, 'tipo' => 'user_and_pass_error']);

        $column = strlen($request->user) == 7 ? 'siape' : 'cpf';
        $person = Person::where($column, $request->user)->with('campi')->first();

        return response()->json(['success' => true, 'data' => $person]);
    }

    private function sendEmail($nome, $email, $key)
    {
        try {
            Mail::send('emails.back', ['key' => $key, 'nome' => $nome], function ($m) use ($email, $nome) {
                $m->from(env('MAIL_FROM_EMAIL', 'noreply@ifro.edu.br'), env('MAIL_FROM_NAME', 'IFRO - Ji-Paraná'));

                $m->to($email, $nome)->subject("Chave devolvida");
            });
        } catch (\Exception $e) {

        }
    }

    public function control()
    {
        $keys = Key::all();

        return view('activities.control', compact('keys'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
