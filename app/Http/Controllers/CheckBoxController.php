<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CheckBox;
use Illuminate\Http\Request;

class CheckBoxController extends Controller
{
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
    public function create()
    {
        $checkbox_lables = CheckBox::all();
        return view('checkbox_create')->with(['checkbox_lables'=>$checkbox_lables]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $checkbox = new CheckBox();
        $checkbox->lable = $request->lable;
        $checkbox->created_by = auth()->user()->name;
        $checkbox->save();
 
        return redirect('checkbox/create')->with('success','Checkbox created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckBox  $checkBox
     * @return \Illuminate\Http\Response
     */
    public function show(CheckBox $checkBox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckBox  $checkBox
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckBox $checkBox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckBox  $checkBox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckBox $checkBox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckBox  $checkBox
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckBox $checkBox,$id)
    {
        CheckBox::where('id', $id)->delete();
        return redirect('checkbox/create')->with('success','Deleted.');

    }
    
    public function get_checkbox_list(){

        $respose['checkboxlist'] = CheckBox::get(); 
        echo json_encode($respose['checkboxlist']);
    }

    public function update_checkbox(Request $request)
    {
        // dd($request->all());
        if($request->isChecked == "true"){
            $isChecked = 1;
        }else{
            $isChecked = 0;
        }
        $checkbox = CheckBox::findOrFail($request->id);
        $checkbox->status = $isChecked;
        $checkbox->set_status_by = auth()->user()->name;
        $checkbox->save();

        $respose['status'] = 200;
        echo json_encode($respose);
    }
}
