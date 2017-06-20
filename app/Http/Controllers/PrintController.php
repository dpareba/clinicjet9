<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Clinic;
use Session;
use PDF;
use App\Visit;
use App\Pageformat;

class PrintController extends Controller
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
        $clinic = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first();
        $pageformats = Pageformat::all();
        return view('print.settings')->withClinic($clinic)->withPageformats($pageformats);
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
        //dd($request);
        $this->validate($request,[
            'margin_top'=>'required|integer|between:0,10',
            'margin_bottom'=>'required|digits_between:0,10',
            // 'margin_right'=>'required|integer',
            // 'margin_left'=>'required|integer',
            'pageformat'=>'required'
            ],[
            'margin_top.required'=>'Top margin value cannot be blank',
            'margin_top.digits_between'=>'Value should be an integer between 0 and 10',
            'margin_bottom.required'=>'Bottom margin value cannot be blank',
            'margin_bottom.digits_between'=>'Value should be an integer between 0 and 10'
            // 'margin_right.required'=>'Right margin value cannot be blank',
            // 'margin_right.digits_between'=>'Value should be an integer between 0 and 255',
            // 'margin_left.required'=>'Left margin value cannot be blank',
            // 'margin_left.digits_between'=>'Value should be an integer between 0 and 255'
            ]);

        $clinic = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first();
        //getting value from user in cm
        //converting into mm
       
        $clinic->margin_top = $request->margin_top;
        $clinic->margin_bottom = $request->margin_bottom;
        // $clinic->margin_left = $request->margin_left;
        // $clinic->margin_right = $request->margin_right;
        $clinic->pageformat = $request->pageformat;
        $clinic->save();

        Session::flash('message','Success!!');
        Session::flash('text','Print settings updated successfully!!');
        Session::flash('type','success');
        Session::flash('timer','2500');

        return redirect()->route('print.index');
    }

    public function printVisit($id){
        $clinic = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first();
        $visit = Visit::find($id);
        $pdf = PDF::loadView('print.visit',['visit'=>$visit],[],[
            'watermark'=> 'Dilip Pareba',
            'title'=> 'Laravel mPDF',
            'show_watermark'=> false,
            'margin_header'=> 10,
            'default_font_size'=> '9',
            'default_font'=> 'sans-serif',
            //'default_font'=> 'times',
            //'default_font'=> 'arial',
            //'default_font'=> 'dejavu-serif',
            'format'=> $clinic->pageformat,
            'margin_top' => $clinic->margin_top*10,
            'margin_bottom' => $clinic->margin_bottom*10,
            'margin_left'=> $clinic->margin_left*10,
            'margin_right'=> $clinic->margin_right*10,
            'orientation'=> 'P'
            ]);
        return $pdf->stream('document.pdf');
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
