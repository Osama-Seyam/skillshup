@extends('admin.layout')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$message->name}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('dashboard/messages')}}">Messages</a></li>
                        <li class="breadcrumb-item active">{{$message->name}}</li>
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
                <div class="col-12">
                    <!-- <card body> -->
                    @include('admin.include.messages')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Message details</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-md">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>
                                            {{$message->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>
                                            {{$message->email}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Subject</th>
                                        <td>
                                            {{$message->subject??"..."}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Body</th>
                                        <td>
                                            {{$message->body}}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <!-- </card body> -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Message Response</h3>
                        </div>
                        <div class="card-body p-0">
                            @include('admin.include.errors')
                            <form method= "POST" action="{{url("dashboard/messages/response/$message->id")}}" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" >
                                    </div>
                                    <div class="form-group">
                                        <label>Body</label>
                                        <textarea rows="5" class="form-control" name="body" >
                                        </textarea>
                                    </div>
                                    <div>
                                        <button class="btn btn-success">Submit</button>
                                        <a href="{{url()->previous()}}" class="btn btn-primary">back</a>
                                    </div>
                                </div>
                            </form>
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