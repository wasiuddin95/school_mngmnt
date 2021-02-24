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
use DB;
use Session;

class feeAmountController extends Controller
{

    public function view()
    {
        // dd('ok');
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view-fee-amount', $data);
    }

    public function add()
    {
        // dd('ok');
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add-fee-amount',$data);
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

        $countClass = count($request->class_id);
        if ($countClass != NULL) {
            for ($i=0; $i < $countClass; $i++) { 
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }

        Session::flash('success', 'Fee Category created successfully');
        return redirect()->route('setups.fee.amount.view');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fee_category_id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        // dd($data['editData']->toArray());
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit-fee-amount', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fee_category_id)
    {
        if ($request->class_id==NULL) {
            Session::flash('error', 'Sorry you have not select any class!!');
            return redirect()->back();
        }else {
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
            $countClass = count($request->class_id);
            for ($i=0; $i < $countClass; $i++) { 
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }

        }
        Session::flash('success', 'Fee Category updated successfully');
        return redirect()->route('setups.fee.amount.view');
    }

    public function details($fee_category_id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        // dd($data['editData']->toArray());
        return view('backend.setup.fee_amount.details-fee-amount', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = FeeCategoryAmount::find($id);
        $data->delete();

        Session::flash('success', 'Shift deleted successfully');
        return redirect()->route('setups.fee.category.view');
    }

    
}
