@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
                        <h3 class="card-title">All Categories</h3>
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
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                            <tbody>
                                    @foreach ($categories as $category )
                                        {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete']) !!}
                                        {!! Form::close() !!}
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$category->nameLang('en')}}</td>
                                            <td>{{$category->nameLang('ar')}}</td>
                                            <td>
                                                @if ($category->active)
                                                    <span class="badge bg-success">yes</span>
                                                @else
                                                    <span class="badge bg-danger">no</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button  type="submit" data-id="{{$category->id}}" data-name-en="{{$category->nameLang('en')}}" data-name-ar="{{$category->nameLang('ar')}}" data-toggle="modal" data-target="#edit-modal" class="btn btn-sm btn-info edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="submit" data-id="{{$category->id}}" form="form-delete" class="btn btn-sm btn-danger delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <a href="{{url("dashboard/categories/toggle/$category->id")}}" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                <div class="d-flex my-3 justify-content-center">
                                    {{$categories->links()}}

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
                <h4 class="modal-title"> Add New Category </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                 </button>
                </div>
            <div class="modal-body">
                @include('admin.include.errors')
                {!! Form::open(['url' => 'dashboard/categories', 'id' => 'add-form']) !!}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::text('name_en', null, ['class' => 'form-control' , "placeholder" => "Name (en)"]) !!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::text('name_ar', null, ['class' => 'form-control' , "placeholder" => "Name (ar)"]) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
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
        @if (isset($category))
            {!! Form::model($category, ['method' => 'PUT', 'url' => "dashboard/categories/{$category->id}", 'id' => 'edit-form']) !!}
                {!! Form::hidden('id', null, ['id' => 'edit-form-id']) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::text('name_en', null, ['class' => 'form-control' , "placeholder" => "Name (en)"]) !!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::text('name_en', null, ['class' => 'form-control' , "placeholder" => "Name (en)"]) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
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

            $('#edit-form-id').val(id)
            $('#edit-form-name-en').val(nameEn)
            $('#edit-form-name-ar').val(nameAr)
        });


        $('.delete-btn').click(function () {
            let id = $(this).attr('data-id')
            let  urlString= "{{url("dashboard/categories")}}" + "/" + id;

            var frm = document.getElementById('form-delete') || null;
            if(frm) {
                frm.action = urlString
            }
            console.log(frm.action)
        });
    </script>
@endsection