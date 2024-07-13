@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$exam->name('en')}} Questions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{url("dashboard/exams")}}">Exams</a></li>
              <li class="breadcrumb-item active"><a href="{{url("dashboard/exams/$exam->id")}}">{{$exam->name('en')}}</a></li>
              <li class="breadcrumb-item active">Questions</li>
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
            <div class="col-12 pb-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Exam Questions</h3>
                    </div>

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Options</th>
                                <th>Right Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exam->questions as $question )
                                {{-- <form action="{{url("dashboard/exams/$exam->id")}}" method="POST" id="form-delete">
                                    @csrf
                                    @method('DELETE')
                                </form> --}}
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$question->title}}</td>
                                    <td>
                                        {{$question->option_1}} |<br>
                                        {{$question->option_2}} |<br>
                                        {{$question->option_3}} |<br>
                                        {{$question->option_4}} <br>
                                    </td>
                                    <td>
                                        {{$question->right_ans}}
                                    </td>
                                    <td>
                                        <a  href="{{url("dashboard/exams/edit-questions/{$exam->id}/{$question->id}")}}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <a href="{{url()->previous()}}" class="btn btn-sm btn-primary">Back</a>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection