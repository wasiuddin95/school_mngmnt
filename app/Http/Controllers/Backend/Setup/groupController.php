<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\StudentGroup;
use DB;
use Session;

class groupController extends Controller
{

    public function view()
    {
        // dd('ok');
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view-group', $data);
    }

    public function add()
    {
        // dd('ok');
        return view('backend.setup.group.add-group');
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
            'name' => 'required|unique:student_groups,name'
        ]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Group created successfully');
        return redirect()->route('setups.student.group.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = StudentGroup::find($id);
        return view('backend.setup.group.add-group', compact('editData'));
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
        $data = StudentGroup::find($id);
        // Validation
        $this->validate($request , [
            'name' => 'required|unique:student_groups,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Group updated successfully');
        return redirect()->route('setups.student.group.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = StudentGroup::find($id);
        $data->delete();

        Session::flash('success', 'Group deleted successfully');
        return redirect()->route('setups.student.group.view');
    }

    
}
