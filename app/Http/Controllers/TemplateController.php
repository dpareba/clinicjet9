<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use Auth;
use Illuminate\Support\Str; //Added
use Session;

class TemplateController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


    }

    public function showcc(Request $request){
       $term = $request->term;
       $templates = Template::where('template','LIKE','%'.$term.'%')->where('templatetype','=','CC')->where('user_id','=',Auth::user()->id)->get();

       if (count($templates)==0) {
        $searchResult[] = "No Templates Found";
    }else{
        foreach ($templates as $t) {
            $searchResult[] = $t->template;
        }
    }
    return $searchResult;
}

    public function storecc(Request $request){

        $this->validate($request,[
            'templatename'=>'required|unique:templates,templatename',
            'template'=>'required|unique:templates,template'
            ],[
            'templatename.required'=>'Template Name cannot be left blank',
            'templatename.unique'=>'A Template by this name already exists',
            'template.required'=>'New Template cannot be left blank',
            'template.unique'=>'This Template alredy exists'
            ]);

        $template = new Template;
        $template->templatename = Str::upper($request->templatename);
        $template->templatetype = "CC";
        $template->template = Str::upper($request->template);
        $template->user_id = Auth::user()->id;

        $template->save();

       
    }

    public function showef(Request $request){
       $term = $request->term;
       $templates = Template::where('template','LIKE','%'.$term.'%')->where('templatetype','=','EF')->where('user_id','=',Auth::user()->id)->get();

       if (count($templates)==0) {
        $searchResult[] = "No Templates Found";
    }else{
        foreach ($templates as $t) {
            $searchResult[] = $t->template;
        }
    }
    return $searchResult;
}

public function storeef(Request $request){

        $this->validate($request,[
            'templatenameef'=>'required|unique:templates,templatename',
            'templateef'=>'required|unique:templates,template'
            ],[
            'templatenameef.required'=>'Template Name cannot be left blank',
            'templatenameef.unique'=>'A Template by this name already exists',
            'templateef.required'=>'New Template cannot be left blank',
            'templateef.unique'=>'This Template alredy exists'
            ]);

        $template = new Template;
        $template->templatename = Str::upper($request->templatenameef);
        $template->templatetype = "EF";
        $template->template = Str::upper($request->templateef);
        $template->user_id = Auth::user()->id;

        $template->save();

       
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
        //
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
