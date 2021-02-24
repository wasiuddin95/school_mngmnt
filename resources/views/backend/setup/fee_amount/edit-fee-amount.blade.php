@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Fee Category Amount</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Fee Amount</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-md-12 ">
                    <!-- Custom tabs (Charts with tabs)         connectedSortable           -->
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                @if (isset($editData))
                                Edit Fee Amount
                                @else
                                Add Fee Amount
                                @endif
                                <a href="{{ route('setups.fee.amount.view') }}"
                                    class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Fee Amount
                                    List</a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('setups.fee.amount.update',$editData[0]->fee_category_id) }}"
                                method="post" id="myForm">
                                @csrf
                                <div class="add_item">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Fee Category</label>
                                            <select name="fee_category_id" class="form-control">
                                                <option value="">Select Fee Category</option>
                                                @foreach ($fee_categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ ($editData['0']->fee_category_id==$category->id)?"selected":"" }}>
                                                    {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @foreach($editData as $edit)
                                    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label>Class</label>
                                                <select name="class_id[]" class="form-control">
                                                    <option value="">Select Class</option>
                                                    @foreach ($classes as $cls)
                                                    <option value="{{ $cls->id }}"
                                                        {{($edit->class_id==$cls->id)?"selected":""}}>{{ $cls->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="">Amount</label>
                                                <input type="text" value="{{$edit->amount}}" name="amount[]"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-md-2" style="padding-top: 32px;">
                                                <span class="btn btn-success addeventmore ml-1"><i
                                                        class="fa fa-plus-circle"></i></span>
                                                <span class="btn btn-danger removeeventmore ml-1"><i
                                                        class="fa fa-minus-circle"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="submit"
                                    class="btn btn-primary">{{ (@$editData)?'Update':'Submit' }}</button>
                            </form>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>Class</label>
                    <select name="class_id[]" class="form-control">
                        <option value="">Select Class</option>
                        @foreach ($classes as $cls)
                        <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="">Amount</label>
                    <input type="text" name="amount[]" class="form-control">
                </div>
                <div class="form-group col-md-2" style="padding-top: 32px;">
                    <div class="form-row">
                        <span class="btn btn-success addeventmore ml-1"><i class="fa fa-plus-circle"></i></span>
                        <span class="btn btn-danger removeeventmore ml-1"><i class="fa fa-minus-circle"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- extra add item --}}
<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;
        $(document).on("click", ".addeventmore", function () {
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function (event) {
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#myForm').validate({
            rules: {
                "fee_category_id": {
                    required: true,
                },
                "class_id[]": {
                    required: true,
                },
                "amount[]": {
                    required: true,
                }
            },
            messages: {
                "fee_category_id": {
                    required: "Please enter category id!! ",
                },
                "class_id[]": {
                    required: "Please select class!! ",
                },
                "amount[]": {
                    required: "Please enter an amount!!",
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection