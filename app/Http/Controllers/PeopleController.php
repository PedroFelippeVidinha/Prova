<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleRequest;
use App\Models\People;
use App\Models\Phones;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $people = People::where(function($query) use($request){
            if(isset($request->search)){
                $query = $query->where('name', 'like', "%".$request->search."%");
            }

            if(isset($request->duration)){
                $query = $query->where('duration', $request->duration);
            }

        })->get()->toJson();

        return  response()->json($people, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleRequest $request)
    {

        $requestData = $request->validated();
        unset($requestData['phones']);

        $people = People::create($requestData);

        if($request->phones){
            $phones = array();
            foreach($request->phones as $phone){
                array_push($phones,new Phones(["phone" => $phone, "people_id" => $people->id]));
            }

            $people->phones()->saveMany($phones);
        }

        return  response()->json(["message" => "pessoa criada com sucesso"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $people = People::where('id', $id)->first();

        return view('people.show',compact('people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $people = People::where('id', $id)->first();

        return view('people.edit',compact('people'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, people $people)
    {
        $cadastro = $request->all();
        $id = $cadastro['id'];

        $request->validate([
            'name' => 'nullable|string|max:100',
            'cpf' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:50',
            'date_birth' => 'nullable|string|max:10',
            'nationality' => 'nullable|string|max:20'
        ]);

        $newPeople = People::find($id);

        $newPeople->name = $request->name;
        $newPeople->cpf = $request->cpf;
        $newPeople->email = $request->email;
        $newPeople->date_birth = $request->date_birth;
        $newPeople->nationality = $request->nationality;

        $newPeople->update($newPeople->toArray());

        return redirect()->route('people')
                        ->with('success','Pessoa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Phones::where('people_id', $id)->delete();
       People::where('id', $id)->delete();

        return redirect()->route('people')
                        ->with('success','Pessoa excluída com sucesso.');
    }
}
