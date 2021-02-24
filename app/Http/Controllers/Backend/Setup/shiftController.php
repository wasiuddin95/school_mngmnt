<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use DB;
use Session;

class shiftController extends Controller
{

    public function view()
    {
        // dd('ok');
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view-shift', $data);
    }

    public function add()
    {
        // dd('ok');
        return view('backend.setup.shift.add-shift');
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
            'name' => 'required|unique:student_shifts,name'
        ]);
        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Shift created successfully');
        return redirect()->route('setups.student.shift.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = StudentShift::find($id);
        return view('backend.setup.shift.add-shift', compact('editData'));
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
        $data = StudentShift::find($id);
        // Validation
        $this->validate($request , [
            'name' => 'required|unique:student_shifts,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Shift updated successfully');
        return redirect()->route('setups.student.shift.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = StudentShift::find($id);
        $data->delete();

        Session::flash('success', 'Shift deleted successfully');
        return redirect()->route('setups.student.shift.view');
    }

    
}
