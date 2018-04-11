@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">จัดการผู้ใช้งาน</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <a class="btn btn-primary" href="/user/create">
                                <i class="glyphicon glyphicon-plus"></i>
                                เพิ่มผู้ใช้งาน
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="60" class="text-center">แก้ไข</th>
                            <th width="60" class="text-center">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary" href="/user/{{$user->id}}/edit" data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ URL::route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('ยืนยันว่าจะลบรายการนี้?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="ลบ">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {!! $users->render() !!} --}}
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
    @if (session('status'))
        <script>
            alert('{{session('status')}}');
        </script>
    @endif

<script type="text/javascript">
    // $(function () {
    //     // $('[data-toggle="tooltip"]').tooltip();

    //     $('#searchButton').click(function(){
    //         if ($('#searchInput').val() !== "") {
    //             window.location.href="{!! url('/user/search') !!}/"+
    //             $('#searchInput').val();
    //         } else {
    //             window.location.href="{!! url('/user/') !!}";
    //         };
    //     })

    //     $(document).keypress(function(e) {
    //         if(e.which == 13) {
    //             if ($('#searchInput').val() !== "") {
    //                 window.location.href="{!! url('/user/search') !!}/"+
    //                 $('#searchInput').val();
    //             };
    //         }
    //     });
    // })

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
</script>
@stop
