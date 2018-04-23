<?php

namespace App\Http\Controllers;

use App\Campi;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Person;
use Illuminate\Http\Request;

class PeopleController extends Controller
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
            $people = Person::where('tipo', 'LIKE', "%$keyword%")
                ->orWhere('nome', 'LIKE', "%$keyword%")
                ->orWhere('cpf', 'LIKE', "%$keyword%")
                ->orWhere('siape', 'LIKE', "%$keyword%")
                ->orWhere('qr_code', 'LIKE', "%$keyword%")
                ->orWhere('campi_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $people = Person::paginate($perPage);
        }

        return view('people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $campi = Campi::all();

        return view('people.create', compact('campi'));
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
        $personCount = Person::where('cpf', $request->cpf)->count();

        if($personCount)
            return redirect()->back()->withInput()->with('flash_message_error', 'O Servidor/Aluno já está cadastrado!');
        
        $person = Person::create($requestData);
        $person->qr_code = bcrypt($person->id.$person->tipo.$person->campi_id.str_random(40));
        $person->save();


        return redirect('people')->with('flash_message', 'Person added!');
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
        $person = Person::findOrFail($id);

        return view('people.show', compact('person'));
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
        $person = Person::findOrFail($id);
        $campi = Campi::all();

        return view('people.edit', compact('person', 'campi'));
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
        
        $person = Person::findOrFail($id);
        $person->update($requestData);

        return redirect('people')->with('flash_message', 'Person updated!');
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
        Person::destroy($id);

        return redirect('people')->with('flash_message', 'Person deleted!');
    }
}
