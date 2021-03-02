<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\User;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\Year;
use DB;
use Session;

class StudentRegController extends Controller
{
    public function view()
    {
        // dd('ok');
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = Year::orderBy('id','desc')->first()->id;
        // dd($data['year_id']);
        $data['class_id'] = StudentClass::orderBy('id','asc')->first()->id;
        $data['allData'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
        // dd($data['allData']);
        return view('backend.student.student_reg.view-student',$data);
    }

    public function yearClassWise(Request $request)
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        return view('backend.student.student_reg.view-student',$data);
    }

    public function add()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.add-student',$data);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use($request){
          $checkYear = Year::find($request->year_id)->name;
          $student = User::where('usertype','student')->orderBy('id','DESC')->first();
          if ($student == null) {
              $firstReg = 0;
              $studentId = $firstReg+1;
              if ($studentId < 10) {
                  $id_no = '000'.$studentId;
              }elseif ($studentId < 100) {
                  $id_no = '00'.$studentId;
              }elseif ($studentId < 1000) {
                  $id_no = '0'.$studentId;
              }
          }else {
              $student = User::where('usertype','student')->orderBy('id','DESC')->first()->id;
              $studentId = $student+1;
              if ($studentId < 10) {
                  $id_no = '000'.$studentId;
              }elseif ($studentId < 100) {
                  $id_no = '00'.$studentId;
              }elseif ($studentId < 1000) {
                  $id_no = '0'.$studentId;
              }
          }
          $final_id_no = $checkYear.$id_no;
          $user = new User();
          $user->id_no = $final_id_no;
          $code = rand(100000,999999);
          $user->password = bcrypt($code);
          $user->usertype = 'student';
          $user->code = $code;
          $user->name = $request->name;
          $user->fname = $request->fname;
          $user->mname = $request->mname;
          $user->mobile = $request->mobile;
          $user->address = $request->address;
          $user->gender = $request->gender;
          $user->religion = $request->religion;
          $user->dob = date('Y-m-d',strtotime($request->dob));
          if ($request->file('image')) {
              $file = $request->file('image');
              $filename =date('YmdHi').$file->getClientOriginalName();
              $file->move(public_path('upload/student_images'), $filename);
              $user['image']= $filename;
          }
          $user->save();
          $assign_student = new AssignStudent();
          $assign_student->student_id = $user->id;
          $assign_student->year_id = $request->year_id;
          $assign_student->class_id = $request->class_id;
          $assign_student->group_id = $request->group_id;
          $assign_student->shift_id = $request->shift_id;
          $assign_student->save();
          $discount_student = new DiscountStudent();
          $discount_student->assign_student_id = $assign_student->id;
          $discount_student->fee_category_id = '1';
          $discount_student->discount = $request->discount;
          $discount_student->save();
        });

        Session::flash('success', 'Student information added successfully!!');
        return redirect()->route('students.registration.view');
    }

}
