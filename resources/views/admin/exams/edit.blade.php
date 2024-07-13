@extends('admin.layout')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Edit exam {{$exam->name('en')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit exam {{$exam->name('en')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- <card body> -->
                <div class="col-12 pb-3">
                    @include("admin.include.errors")
                    @include("admin.include.messages")
                    <form method="POST" action="{{url("dashboard/exams/$exam->id")}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name(en)</label>
                                        <input type="text" class="form-control" name="name_en" value="{{$exam->name('en')}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name(ar)</label>
                                        <input type="text" class="form-control" name="name_ar" value="{{$exam->name('ar')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description(en)</label>
                                        <textarea type="text" class="form-control" rows="5" name="desc_en" id="textarea-en"></textarea>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description(ar)</label>
                                        <textarea type="text" class="form-control" rows="5" name="desc_ar" id="textarea-ar"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Skill</label>
                                        <select class="Custom-select form-control"  id= "edit-form-cat-id" name="skill_id">
                                            @foreach($skills as $skill)
                                                <option value="{{$skill->id}}" @if($exam->skill_id == $skill->id) selected @endif>{{$skill->name('en')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="img">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Difficulty</label>
                                        <input type="number" class="form-control" name="difficulty"  value="{{$exam->difficulty}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Duration(mins)</label>
                                        <input type="number" class="form-control" name="duration_mins" value="{{$exam->duration_mins}}">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{url("dashboard/exams")}}" class="btn btn-primary">back </a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection