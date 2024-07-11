@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Skills</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Skills</li>
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
                        <h3 class="card-title">All Skills</h3>
                        <div class="card-tools">
                            <button type="button" data-toggle="modal" data-target="#add-modal" class="btn btn-sm btn-primary">Add new</button>
                        </div>
                    </div>

                <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name (en)</th>
                        <th>Name (ar)</th>
                        <th>Descreption (en)</th>
                        <th>Descreption (ar)</th>
                        <th>Image</th>
                        <th>Skill</th>
                        <th>Question Number</th>
                        <th>Difficulty</th>
                        <th>Duration (mins)</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $exam )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$exam->name('en')}}</td>
                            <td>{{$exam->name('ar')}}</td>
                            <td>{{$exam->desc('ar')}}</td>
                            <td>{{$exam->desc('ar')}}</td>
                            <td>
                                <img src="{{ asset("uploads/$exam->img") }}" alt="" height="50px">
                            </td>
                            <td>{{ $exam->skill->name('en') }}</td>
                            <td>{{ $exam->questions_no }}</td>
                            <td>{{ $exam->difficulty }}</td>
                            <td>{{ $exam->duration_mins }}</td>
                            <td>
                                @if ($exam->active)
                                    <span class="badge bg-success">yes</span>
                                @else
                                    <span class="badge bg-danger">no</span>
                                @endif
                            </td>
                            <td>
                                <button  type="submit" data-id="{{$exam->id}}" data-name-en="{{$exam->name('en')}}" data-name-ar="{{$exam->name('ar')}}" data-img="{{$exam->img}}" data-skill-id="{{$exam->category_id}}" data-toggle="modal" data-target="#edit-modal" class="btn btn-sm btn-info edit-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{url("dashboard/exams/delete/$exam->id")}}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
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

<div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Add New Skill </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                 </button>
                </div>
            <div class="modal-body">
                @include('admin.include.errors')
                <form method="POST" action="{{url('dashboard/exams/store')}}" id="add-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >Name (en)</label>
                                <input type="text" name="name_en" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name (ar)</label>
                                <input type="text" name="name_ar" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Skills</label>
                                    <select class="custom-select form-control" name="skill_id">
                                        @foreach ($skills as $skill)
                                            <option value="{{$skill->id}}"> {{$skill->name('en')}}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="img">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="close" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-form" class="btn btn-primary">Save changes</button>
                </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
    <div class="modal-body">
        @include('admin.include.errors')
        <form method="POST" action="{{url('dashboard/exams/update')}}" id="edit-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="edit-form-id">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label >Name (en)</label>
                        <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Name (ar)</label>
                        <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Skills</label>
                        <select class="custom-select form-control" name="skill_id" id="edit-form-skill-id">
                            @foreach ($skills as $skill)
                                <option value="{{$skill->id}}"> {{$skill->name('en')}}</option>
                            @endforeach
                       </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <img src="" id="" alt="">
                </div>
            </div>
        </form>
    </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" form="edit-form" class="btn btn-primary">Save changes</button>
        </div>
    </div>
    </div>
  </div>

@endsection

@section('scripts')
    <script>
        $('.edit-btn').click(function () {
            let id = $(this).attr('data-id')
            let nameEn = $(this).attr('data-name-en')
            let nameAr = $(this).attr('data-name-ar')
            let skillId = $(this).attr('data-skill-id')

            $('#edit-form-id').val(id)
            $('#edit-form-name-en').val(nameEn)
            $('#edit-form-name-ar').val(nameAr)
            $('#edit-form-skill-id').val(skillId)
        });
    </script>
@endsection