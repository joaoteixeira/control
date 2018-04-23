<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Key;
use App\Room;
use Illuminate\Http\Request;

class KeysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $keys = Key::where('copia', 'LIKE', "%$keyword%")
                ->orWhere('disponivel', 'LIKE', "%$keyword%")
                ->orWhere('qr_code', 'LIKE', "%$keyword%")
                ->orWhere('room_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $keys = Key::paginate($perPage);
        }

        return view('keys.index', compact('keys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $rooms = Room::all();

        return view('keys.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        //check
        $keyCount = Key::where('copia', $request->copia)
                        ->where('room_id', $request->room_id)
                        ->count();

        if($keyCount)
          return redirect()->back()->withInput()->with('flash_message_error', 'A cópia da chave já existe!');

        $key = Key::create($requestData);
        $key->qr_code = bcrypt($key->id.$key->copia.$key->room_id.str_random(40));
        $key->save();

        return redirect('keys')->with('flash_message', 'Chave adicionada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $key = Key::findOrFail($id);

        return view('keys.show', compact('key'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $key = Key::findOrFail($id);
        $rooms = Room::all();

        return view('keys.edit', compact('key', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $key = Key::findOrFail($id);
        $key->update($requestData);

        return redirect('keys')->with('flash_message', 'Key updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Key::destroy($id);

        return redirect('keys')->with('flash_message', 'Key deleted!');
    }
}
