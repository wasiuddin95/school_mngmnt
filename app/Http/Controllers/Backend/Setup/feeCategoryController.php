<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\FeeCategory;
use DB;
use Session;

class feeCategoryController extends Controller
{

    public function view()
    {
        // dd('ok');
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view-fee-category', $data);
    }

    public function add()
    {
        // dd('ok');
        return view('backend.setup.fee_category.add-fee-category');
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
            'name' => 'required|unique:fee_categories,name'
        ]);
        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Fee Category created successfully');
        return redirect()->route('setups.fee.category.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = FeeCategory::find($id);
        return view('backend.setup.fee_category.add-fee-category', compact('editData'));
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
        $data = FeeCategory::find($id);
        // Validation
        $this->validate($request , [
            'name' => 'required|unique:fee_categories,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        Session::flash('success', 'Shift updated successfully');
        return redirect()->route('setups.fee.category.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = FeeCategory::find($id);
        $data->delete();

        Session::flash('success', 'Shift deleted successfully');
        return redirect()->route('setups.fee.category.view');
    }

    
}
