<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pathology;
use Illuminate\Support\Facades\Input;
use Auth;

class PathologyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = Input::get('q');
        $id = Auth::user()->id;
        //$pathologies = Pathology::where('name','LIKE','q%')->get();
        $pathologies = Pathology::where(function($query) use($q){
            $query->where('name','LIKE',"$q%")->where('user_id','=','1');
        })->orWhere(function($query) use($q,$id){
            $query->where('name','LIKE',"$q%")->where('user_id','=',$id);
        })->get();

        //$pathologies = Pathology::all();
        foreach ($pathologies as $pathology) {
            $path = $pathology->name;
            $formatted_tags[] = ['id'=>$pathology->id,'text'=>$path];
        }
        //$formatted_tags[] = ['id' => 'Dilip', 'text' => 'Pareba'];
        return response()->json($formatted_tags);
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
       $this->validate($request,[
            'pathname'=>'required|unique:pathologies,name'
        ],[
            'pathname.required'=>'Investigation Name is required',
            'pathname.unique'=>'Investigation Name already exists'
        ]);
       $pathology = new Pathology;
       $pathology->name = $request->pathname;
       $pathology->category_id = '45';
       $pathology->user_id = Auth::user()->id;
       $pathology->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
