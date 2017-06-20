<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Visit;
use App\Report;
use Auth;
use App\Category;
use Carbon\Carbon;
use Log;
use Image;

class ReportController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $visit = Visit::find($id);
        $reports = $visit->reports;
        //dd($reports);
        $categories = Category::all();
        //dd($categories);
        $patient = $visit->patient;
        return view('reports.create')->withVisit($visit)->withPatient($patient)->withCategories($categories)->withReports($reports);
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
            'name'=>'required|max:255',
            'report_date'=>'required|date|before:tomorrow',
            'cat_name'=>'required|max:255'
            ],[
            'name.required'=>'The Report Name Cannot be Left Blank!!',
            'cat_name.required'=>'You need to Select a Report Category',
            'report_date.date'=>'Invalid Date Format',
            'report_date.before'=>'The Date of Investigation cannot be later than today\'s date',
            'report_date.required'=>'The Date of Investigation cannot be left blank!'
            ]);
        //dd($request);
        $visit = Visit::find($request->id);
        $patient = $visit->patient()->first();
        $report = new Report;
        $report->name = $request->name;
        if ($request->report_date == "") {
            $input = '01/01/1900';
        }else{
            $input = $request->report_date;
        }
        $format = 'm/d/Y';
        $date = Carbon::createFromFormat($format,$input);
        $report->report_date = $date;
        $report->cat_name = $request->cat_name;
        $report->visit_id = $visit->id;
        //$report->patient_id = $patient->id;
        $report->created_by = Auth::user()->id;

        $report->save();

        return redirect()->route('reports.create',$visit->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //dd($request);
        $report = Report::findOrFail($request->reportid);
        //$report = Report::findOrFail($id);
        $patient = $report->visit->patient;
        //dd($report);
        return view('reports.show')->withReport($report)->withPatient($patient);
    }


    public function doImageUpload(Request $request){

        $file = $request->file('file');
        $filename = uniqid() . '-' . $request->patient_code . '-' . $request->report_id . '.' . $file->getClientOriginalExtension();
        //Log::info($filename);
        $file->move('dilip/images', $filename);
        //Image::make($file)->resize(300,300)->save( public_path('/dilip/images/' . $filename) );

        $report = Report::findOrFail($request->report_id);
        //Log::info($report);
        $image = $report->images()->create([
            'report_id' => $request->report_id,
            'file_name' => $filename,
            'file_size' => $file->getClientSize(),
            'file_mime' => $file->getClientMimeType(),
            'file_path' => 'dilip/images/' . $filename,
            'created_by' => Auth::user()->id
            ]);

        return $image;
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

        $report = Report::findOrFail($id);
        //dd($report);
        
        foreach ($report->images as $image) {
            unlink(public_path($image->file_path));
        }

        $images = $report->images()->delete();
        $report->delete();

        return redirect()->back();
    }
}
