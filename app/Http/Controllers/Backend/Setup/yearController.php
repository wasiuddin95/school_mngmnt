<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use DB;
use Session;

class yearController extends Controller
{

    public function view()
    {
        // dd('ok');
        $data['allData'] = Year::all();
        return view('backend.setup.year.view-year', $data);
    }

    public function add()
    {
        // dd('ok');
        return view('backend.setup.year.add-year');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('ok');
        // Validation
        $this->validate($request , [
            'name' => 'required|unique:years,name'
        ]);
        $data = new Year();
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Year created successfully');
        return redirect()->route('setups.student.year.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = Year::find($id);
        return view('backend.setup.year.add-year', compact('editData'));
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
        // dd('ok');
        $data = Year::find($id);
        // Validation
        $this->validate($request , [
            'name' => 'required|unique:years,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Year updated successfully');
        return redirect()->route('setups.student.year.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Year::find($id);
        $data->delete();

        Session::flash('success', 'Year deleted successfully');
        return redirect()->route('setups.student.year.view');
    }

    
}
