<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use DB;
use Session;

class StudentClassController extends Controller
{

    public function view()
    {
        // dd('ok');
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view-class', $data);
    }

    public function add()
    {
        return view('backend.setup.student_class.add-class');
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
            'name' => 'required|unique:student_classes,name'
        ]);
        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Student class created successfully');
        return redirect()->route('setups.student.class.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = StudentClass::find($id);
        return view('backend.setup.student_class.add-class', compact('editData'));
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
        $data = StudentClass::find($id);
        // Validation
        $this->validate($request , [
            'name' => 'required|unique:student_classes,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Student class updated successfully');
        return redirect()->route('setups.student.class.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = StudentClass::find($id);
        $data->delete();

        Session::flash('success', 'Student class deleted successfully');
        return redirect()->route('setups.student.class.view');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
