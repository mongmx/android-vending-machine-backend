@extends('app')

@section('content')
<h3 class="text-center">แก้ไขผู้ใช้งาน</h3>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">รายละเอียด</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/'.$user->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Role</label>
                            <div class="col-md-6">
                                <select class="form-control" name="role">
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">username</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">email</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" value="{{$user->email}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('style')
@stop

@section('script')
@stop
