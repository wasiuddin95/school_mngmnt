<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\ExamType;
use App\Model\Subject;
use DB;
use Session;

class SubjectController extends Controller
{

    public function view()
    {
        // dd('ok'); 
        $data['allData'] = Subject::all();
        return view('backend.setup.subject.view-subject', $data);
    }

    public function add()
    {
        // dd('ok');
        return view('backend.setup.subject.add-subject'); 
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
            'name' => 'required|unique:subjects,name'
        ]);
        $data = new Subject();
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Subjects created successfully');
        return redirect()->route('setups.subject.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = Subject::find($id);
        return view('backend.setup.subject.add-subject', compact('editData'));
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
        $data = Subject::find($id);
        // Validation
        $this->validate($request , [
            'name' => 'required|unique:subjects,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Subjects updated successfully');
        return redirect()->route('setups.subject.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Subject::find($id);
        $data->delete();

        Session::flash('success', 'Subjects deleted successfully');
        return redirect()->route('setups.subject.view');
    }

    
}
