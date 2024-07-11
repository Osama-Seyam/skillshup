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
                        <form action="{{url("dashboard/exams/$exam->id")}}" method="POST" id="form-delete">
                            @csrf
                            @method('DELETE')
                        </form>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$exam->name('en')}}</td>
                            <td>{{$exam->name('ar')}}</td>

                            <td>
                                <img src="{{ asset("uploads/$exam->img") }}" alt="" height="50px">
                            </td>
                            <td>{{ $exam->skill->name('en') }}</td>
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
                                <a  href="{{url("dashboard/exams/show/$exam->id/questions")}}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-question"></i>
                                </a>
                                <a  href="{{url("dashboard/exams/$exam->id/edit")}}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" form="form-delete" class="btn btn-sm btn-danger">
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

{{-- <div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
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
                <form method="POST" action="{{url('dashboard/exams')}}" id="add-form" enctype="multipart/form-data">
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description (en)</label>
                                    <textarea name="desc_en" class="form-control" rows="3" placeholder="Enter ..." data-lt-tmp-id="lt-3188" spellcheck="false" data-gramm="false"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Descreption (ar)</label>
                                    <textarea name="desc_ar" class="form-control" rows="3" placeholder="Enter ..." data-lt-tmp-id="lt-3188" spellcheck="false" data-gramm="false"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Questions Number</label>
                                    <input type="text" name="questions_no" class="form-control" >
                                    </div>
                                </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Difficulty</label>
                                    <input type="text" name="difficulty" class="form-control" >
                                    </div>
                                </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Duration (Mins)</label>
                                    <input type="text" name="duration_mins" class="form-control" >
                                    </div>
                                </div>
                            </div>
                </form>
            </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-form" class="btn btn-primary">Save changes</button>
                </div>
        </div>
    </div>
</div> --}}


{{-- <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
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
        <form method="POST" action="{{url("dashboard/exams/$exam->id")}}" id="edit-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                        <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar" >
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Description (en)</label>
                            <textarea id="edit-form-desc-en" name="desc-en" class="form-control" rows="3" placeholder="Enter ..." data-lt-tmp-id="lt-3188" spellcheck="false" data-gramm="false"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Descreption (ar)</label>
                            <textarea name="desc-ar" id="edit-form-desc-ar" class="form-control" rows="3" placeholder="Enter ..." data-lt-tmp-id="lt-3188" spellcheck="false" data-gramm="false"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>Questions Number</label>
                            <input type="text" name="name_ar" class="form-control" id="edit-form-questions-no">
                            </div>
                        </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label>Difficulty</label>
                            <input type="text" name="name_ar" class="form-control" id="edit-form-diff" >
                            </div>
                        </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Duration (Mins)</label>
                            <input type="text" name="name_ar" class="form-control" id="edit-form-duration">
                            </div>
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
  </div> --}}



  @endsection