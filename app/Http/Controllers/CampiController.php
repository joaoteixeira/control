<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Campi;
use Illuminate\Http\Request;

class CampiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 2;

        if (!empty($keyword)) {
            $campi = Campi::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('sigla', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $campi = Campi::paginate($perPage);
        }

        return view('campi.index', compact('campi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('campi.create');
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
        $this->validate($request, [
    			'nome' => 'required',
    			'sigla' => 'required'
    		]);
        $requestData = $request->all();

        Campi::create($requestData);

        return redirect('campi')->with('flash_message', 'Campi added!');
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
        $campi = Campi::findOrFail($id);

        return view('campi.show', compact('campi'));
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
        $campi = Campi::findOrFail($id);

        return view('campi.edit', compact('campi'));
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
        $this->validate($request, [
    			'nome' => 'required',
    			'sigla' => 'required'
    		]);
        $requestData = $request->all();

        $campi = Campi::findOrFail($id);
        $campi->update($requestData);

        return redirect('campi')->with('flash_message', 'Campi updated!');
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
        Campi::destroy($id);

        return redirect('campi')->with('flash_message', 'Campi deleted!');
    }
}
