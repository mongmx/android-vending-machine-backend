@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            @if (Auth::user()->name == 'admin')
                ส่วนจัดการระบบ
            @else
                ขออภัย คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้
            @endif
        </div>
    </div>
</div>
@endsection
