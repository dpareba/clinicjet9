<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medicine;
use Illuminate\Support\Facades\Input;
use Auth;

class MedicineController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $q = Input::get('q');
        //$medicines = Medicine::all();
        // $medicines = Medicine::where('name','LIKE',"$q%")->where('user_id','=','1')->orWhere('user_id','=',$id)->get();
        // $medicines = Medicine::where(function($query) use ($q,$id){
        //     $query->where('name','LIKE',"$q%")->where('user_id','=','1');
        // })->where('name','LIKE',"$q%")->where('user_id','=',$id)->get();
         
        $medicines = Medicine::where(function($query) use($q){
            $query->where('name','LIKE',"$q%")->orWhere('composition','LIKE',"%$q%")->where('user_id','=','1');
        })->orWhere(function($query) use($q,$id){
            $query->where('name','LIKE',"$q%")->where('user_id','=',$id);
        })->get();

        foreach ($medicines as $medicine) {
            if ($medicine->composition == '') {
                $med = $medicine->name;
            }else{
                $med = $medicine->name . ' (' . $medicine->composition . ')';
            }
            
            $formatted_tags[] = ['id' => $medicine->id, 'text' => $med , 'composition' => $medicine->composition, 'mednameonly'=> $medicine->name];
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
            'medname'=>'required|unique:medicines,name'
            ],
            [
            'medname.required'=>'Medicine Name cannot be left blank.',
            'medname.unique'=>'Medicine by this name already exists.'
            ]);
        $medicine = new Medicine;
        $medicine->name = $request->medname;
        $medicine->composition = $request->medicomp;
        $medicine->user_id = Auth::user()->id;
        $medicine->save();
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
