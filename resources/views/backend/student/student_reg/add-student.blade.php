@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Students</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
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
                                Edit Student
                                @else
                                Add Student
                                @endif
                                <a href="{{ route('students.registration.view') }}"
                                    class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Students
                                    List</a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form
                                action="{{ (@$editData)?route('students.registration.update',$editData->id):route('students.registration.store') }}" method="post" id="myForm" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Student Name<font style="color: red;"> *</font></label>
                                            <input type="text" value="{{ @$editData->name }}" name="name"
                                                class="form-control form-control-sm" placeholder="Enter Student Name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Father's Name<font style="color: red;"> *</font></label>
                                            <input type="text" value="{{ @$editData->fname }}" name="fname"
                                                class="form-control form-control-sm" placeholder="Enter Father's Name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Mother's Name<font style="color: red;"> *</font></label>
                                            <input type="text" value="{{ @$editData->mname }}" name="mname"
                                                class="form-control form-control-sm" placeholder="Enter Mother's Name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Mobile NO<font style="color: red;"> *</font></label>
                                            <input type="text" value="{{ @$editData->mobile }}" name="mobile"
                                                class="form-control form-control-sm" placeholder="Enter Mobile No">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address<font style="color: red;"> *</font></label>
                                            <input type="text" value="{{ @$editData->address }}" name="address"
                                                class="form-control form-control-sm" placeholder="Enter Student Address">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender<font style="color: red;"> *</font></label>
                                            <select name="gender" id="gender" class="form-control form-control-sm">
                                              <option value="">Select Gender</option>
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Religion<font style="color: red;"> *</font></label>
                                            <select name="religion" id="religion" class="form-control form-control-sm">
                                              <option value="">Select Religion</option>
                                              <option value="Islam">Islam</option>
                                              <option value="Christian">Christian</option>
                                              <option value="Hindu">Hindu</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date Of Birth<font style="color: red;"> *</font></label>
                                            <input type="date" value="{{ @$editData->dob }}" name="dob"
                                                class="form-control form-control-sm singledatepicker" autocomplete="off">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Discount<font style="color: red;"> *</font></label>
                                            <input type="text" value="{{ @$editData->discount }}" name="discount"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Year<font style="color: red;"> *</font></label>
                                            <select name="year_id" id="year_id" class="form-control form-control-sm">
                                              <option value="">Select Year</option>
                                              @foreach ($years as $year)
                                              <option value="{{$year->id}}">{{$year->name}}</option>
                                              @endforeach   
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Class<font style="color: red;"> *</font></label>
                                            <select name="class_id" id="class_id" class="form-control form-control-sm">
                                              <option value="">Select Class</option>
                                              @foreach ($classes as $cls)
                                              <option value="{{$cls->id}}">{{$cls->name}}</option>
                                              @endforeach   
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Group</label>
                                            <select name="group_id" id="group_id" class="form-control form-control-sm">
                                              <option value="">Select Group</option>
                                              @foreach ($groups as $grp)
                                              <option value="{{$grp->id}}">{{$grp->name}}</option>
                                              @endforeach   
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Shift</label>
                                            <select name="shift_id" id="shift_id" class="form-control form-control-sm">
                                              <option value="">Select Shift</option>
                                              @foreach ($shifts as $shift)
                                              <option value="{{$shift->id}}">{{$shift->name}}</option>
                                              @endforeach   
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Image<font style="color: red;"> *</font></label>
                                            <input type="file" value="{{ @$editData->image }}" name="image"
                                               id="image" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <img id="showImage" src="{{url('public/upload/no_image.png')}}" style="width: 120px; height: 130px; border:1px solid #000;">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">{{ (@$editData)?'Update':'Submit' }}</button>
                                </div>
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

<script type="text/javascript">
    $(function () {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                fname: {
                    required: true,
                },
                mname: {
                    required: true,
                },
                mobile: {
                    required: true,
                },
                address: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                religion: {
                    required: true,
                },
                dob: {
                    required: true,
                },
                discount: {
                    required: true,
                },
                year: {
                    required: true,
                },
                class_id: {
                    required: true,
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