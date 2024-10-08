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
                        <th>Image</th>
                        <th>Category</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skills as $skill )

                        {!! Form::open(['method' => 'DELETE' , 'id' => 'form-delete']) !!}
                        {!!Form::close()!!}
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$skill->nameLang('en')}}</td>
                            <td>{{$skill->nameLang('ar')}}</td>
                            <td>
                                <img src="{{ asset("uploads/$skill->img") }}" alt="" height="50px">
                            </td>
                            <td>{{ $skill->category->nameLang('en') }}</td>
                            <td>
                                @if ($skill->active)
                                    <span class="badge bg-success">yes</span>
                                @else
                                    <span class="badge bg-danger">no</span>
                                @endif
                            </td>
                            <td>
                                <button  type="submit" data-id="{{$skill->id}}" data-name-en="{{$skill->nameLang('en')}}" data-name-ar="{{$skill->nameLang('ar')}}" data-cat-id="{{$skill->category_id}}" data-toggle="modal" data-target="#edit-modal" class="btn btn-sm btn-info edit-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="submit" form="form-delete" data-id="{{$skill->id}}" class="btn btn-sm btn-danger delete-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="{{url("dashboard/skills/toggle/$skill->id")}}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                    <div class="d-flex my-3 justify-content-center">
                        {{$skills->links()}}
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
                {!! Form::open(['url' => 'dashboard/skills', 'id' => 'add-form', 'files' => true]) !!}
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::text('name_en', null , ['class'=>'form-control' , 'placeholder' => 'name (en)']) !!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::text('name_ar', null , ['class'=>'form-control' , 'placeholder' => 'name (ar)']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    {!! Form::select('category_id', $categories ?? null, null, ['class' => 'custom-select form-control']) !!}
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        @if (isset($skill))
            {!! Form::model($skill, ['method' => 'PUT', 'url' => "dashboard/skills/{$skill->id}", 'id' => 'edit-form']) !!}
                {!! Form::hidden('id', null, ['id' => 'edit-form-id']) !!}
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
                        <label>Category</label>
                        <select class="custom-select form-control" name="category_id" id="edit-form-cat-id">
                            @foreach ($categories as $category)
                            {!! Form::select('category_id', $categories ?? null, null, ['class' => 'custom-select form-control']) !!}
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
        {!!Form::close()!!}
        @endif
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
            let catId = $(this).attr('data-cat-id')

            $('#edit-form-id').val(id)
            $('#edit-form-name-en').val(nameEn)
            $('#edit-form-name-ar').val(nameAr)
            $('#edit-form-cat-id').val(catId)
        });

       $('.delete-btn').click(function () {
            let id = $(this).attr('data-id')
            let  urlString= "{{url("dashboard/skills")}}" + "/" + id;

            var frm = document.getElementById('form-delete') || null;
            if(frm) {
                frm.action = urlString
            }
            console.log(frm.action)
        });
    </script>
@endsection