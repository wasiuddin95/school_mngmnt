@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Assign Subjects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assign Subjects</li>
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
                            <h3>Assign Subject List
                                <a href="{{ route('setups.assign.subject.add') }}"
                                    class="btn btn-success float-right btn-sm"><i class="fa fa-plus-circle"></i> Add
                                    Assign Subject</a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Class Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $key => $value)
                                    <tr class="{{$value->id}}">
                                        <td>{{ $key+1 }}</td>
                                        {{-- <td>{{ $value['student_class']['name'] }}</td> --}}
                                        <td>{{ $value->student_class->name }}</td>
                                        <td>
                                            <a href="{{ route('setups.assign.subject.details',$value->class_id) }}"
                                                title="Details" class="btn btn-success btn-sm"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="{{ route('setups.assign.subject.edit',$value->class_id) }}"
                                                title="Edit" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-edit"></i></a>
                                            {{-- Delete --}}
                                            {{-- <a href="{{ route('setups.assign.subject.delete',$value->class_id) }}"
                                                id="delete" title="Delete" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash"></i></a> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
@endsection