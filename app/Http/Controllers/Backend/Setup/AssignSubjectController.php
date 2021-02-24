<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\FeeCategory;
use App\Model\FeeCategoryAmount;
use App\Model\Subject;
use App\Model\AssignSubject;
use DB;
use Session;

class AssignSubjectController extends Controller
{

    public function view()
    {
        // dd('ok');
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view-assign-subject', $data);
    }

    public function add()
    {
        // dd('ok');
        $data['subjects'] = Subject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.add-assign-subject',$data);
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
        // $this->validate($request , [
        //     'name' => 'required|unique:fee_categories,name'
        // ]);

        $subjectCount = count($request->subject_id);
        if ($subjectCount != NULL) {
            for ($i=0; $i < $subjectCount; $i++) { 
                $assign_sub = new AssignSubject();
                $assign_sub->class_id = $request->class_id;
                $assign_sub->subject_id = $request->subject_id[$i];
                $assign_sub->full_mark = $request->full_mark[$i];
                $assign_sub->pass_mark = $request->pass_mark[$i];
                $assign_sub->subjective_mark = $request->subjective_mark[$i];
                $assign_sub->save();
            }
        }

        Session::flash('success', 'Assign Subject created successfully');
        return redirect()->route('setups.assign.subject.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id)
    {
        $data['editData'] = AssignSubject::where('class_id',$class_id)->get();
        // dd($data['editData']->toArray());
        $data['subjects'] = Subject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.edit-assign-subject', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_id)
    {
        if ($request->subject_id==NULL) {
            Session::flash('error', 'Sorry you have not select any subject!!');
            return redirect()->back();
        }else {
            AssignSubject::where('class_id',$class_id)->delete();
            $subjectCount = count($request->subject_id);
            for ($i=0; $i < $subjectCount; $i++) { 
                $assign_sub = new AssignSubject();
                $assign_sub->class_id = $request->class_id;
                $assign_sub->subject_id = $request->subject_id[$i];
                $assign_sub->full_mark = $request->full_mark[$i];
                $assign_sub->pass_mark = $request->pass_mark[$i];
                $assign_sub->subjective_mark = $request->subjective_mark[$i];
                $assign_sub->save();
            }

        }
        Session::flash('success', 'Fee Category updated successfully');
        return redirect()->route('setups.assign.subject.view');
    }

    public function details($class_id)
    {
        $data['editData'] = AssignSubject::where('class_id',$class_id)->get();
        // dd($data['editData']->toArray());
        return view('backend.setup.assign_subject.details-assign-subject', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = AssignSubject::find($id);
        $data->delete();

        Session::flash('success', 'Shift deleted successfully');
        return redirect()->route('setups.fee.category.view');
    }

    
}
