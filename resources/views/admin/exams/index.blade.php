@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Exams</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Exams</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @include('admin.include.messages')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Exams</h3>
                        <div class="card-tools">
                            <a href="{{url("dashboard/exams/create")}}" class="btn btn-sm btn-primary">Add new</a>
                        </div>
                    </div>

                <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name (en)</th>
                        <th>Name (ar)</th>
                        <th>Image</th>
                        <th>Skill</th>
                        <th>Question no.</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $exam )
                        <form action="" method="POST" id="form-delete">
                            @csrf
                            @method('DELETE')
                        </form>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$exam->nameLang('en')}}</td>
                            <td>{{$exam->nameLang('ar')}}</td>

                            <td>
                                <img src="{{ asset("uploads/$exam->img") }}" alt="" height="50px">
                            </td>
                            <td>{{ $exam->skill->nameLang('en') }}</td>
                            <td>{{ $exam->questions_no }}</td>
                            <td>
                                @if ($exam->active)
                                    <span class="badge bg-success">yes</span>
                                @else
                                    <span class="badge bg-danger">no</span>
                                @endif
                            </td>
                            <td>
                                <a  href="{{url("dashboard/exams/$exam->id")}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a  href="{{url("dashboard/exams/show-questions/$exam->id")}}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-question"></i>
                                </a>
                                <a  href="{{url("dashboard/exams/$exam->id/edit")}}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" data-id="{{$exam->id}}" form="form-delete" class="btn btn-sm btn-danger delete-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="{{url("dashboard/exams/toggle/$exam->id")}}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                    <div class="d-flex my-3 justify-content-center">
                        {{$exams->links()}}
                    </div>

                </div>

                </div>

                </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection

  @section('scripts')
    <script>
       $('.delete-btn').click(function () {
            let id = $(this).attr('data-id')
            let  urlString= "{{url("dashboard/exams")}}" + "/" + id;

            var frm = document.getElementById('form-delete') || null;
            if(frm) {
                frm.action = urlString
            }
            console.log(frm.action)
        });
    </script>
  @endsection