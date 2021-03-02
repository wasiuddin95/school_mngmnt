<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\Designation;
use DB;
use Session;

class DesignationController extends Controller
{

    public function view()
    {
        // dd('ok');
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view-designation', $data);
    }

    public function add()
    {
        // dd('ok');
        return view('backend.setup.designation.add-designation');
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
            'name' => 'required|unique:designations,name'
        ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Designation created successfully');
        return redirect()->route('setups.designation.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = Designation::find($id);
        return view('backend.setup.designation.add-designation', compact('editData'));
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
        $data = Designation::find($id);
        // Validation
        $this->validate($request , [
            'name' => 'required|unique:designations,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Designation updated successfully');
        return redirect()->route('setups.designation.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Designation::find($id);
        $data->delete();

        Session::flash('success', 'Designation deleted successfully');
        return redirect()->route('setups.designation.view');
    }

    
}
