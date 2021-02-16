@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Student Class</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Class</li>
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
                                Edit Student Class
                                @else
                                Add Student Class
                                @endif
                                <a href="{{ route('setups.student.class.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Student Class List</a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ (@$editData)?route('setups.student.class.update',$editData->id):route('setups.student.class.store') }}" method="post" id="myForm">
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
                                    <div class="form-group col-md-6">
                                        <label>Student Class</label>
                                        <input type="text" value="{{ @$editData->name }}" name="name" class="form-control" placeholder="Enter Student Class Name">
                                        {{-- <font style="color: red;">{{($errors->has('name'))?($errors->first('name')):''}}</font> --}}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary">{{ (@$editData)?'Update':'Submit' }}</button>
                                    </div>
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
                }
            },
            messages: {
                name: {
                    required: "Please enter name!! ",
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