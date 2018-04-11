@extends('app')

@section('content')
<h3 class="text-center">แก้ไขสินค้า</h3>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/product/'.$product->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-md-4 control-label">หมวด</label>
                            <div class="col-md-6">
                                <select class="form-control" name="category">
                                    <!-- <option value="1" {!! ($product->category_id == 1) ? "selected" : "" !!}>
                                        อาหารสำเร็จรูป
                                    </option>
                                    <option value="2" {!! ($product->category_id == 2) ? "selected" : "" !!}>
                                        ขนม
                                    </option>
                                    <option value="3" {!! ($product->category_id == 3) ? "selected" : "" !!}>
                                        เครื่องดื่ม
                                    </option>
                                    <option value="4" {!! ($product->category_id == 4) ? "selected" : "" !!}>
                                        ผลิตภัณฑ์ห้องครัว
                                    </option>
                                    <option value="5" {!! ($product->category_id == 5) ? "selected" : "" !!}>
                                        อุปกรณ์การเรียน
                                    </option>
                                    <option value="6" {!! ($product->category_id == 6) ? "selected" : "" !!}>
                                        บัตรเติมเงิน
                                    </option>
                                    <option value="7" {!! ($product->category_id == 7) ? "selected" : "" !!}>
                                        เบ็ดเตล็ด
                                    </option> -->
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {!! ($product->category_id == $category->id) ? "selected" : "" !!}>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">ชื่อสินค้า</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">ชื่อภาษาอังกฤษ</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name_en" value="{{ $product->name_en }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">ราคา</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">จำนวนสินค้าที่มี</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="stock" value="{{ $product->stock }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">จำนวนต่ำสุดของสินค้า</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="min" value="{{ $product->stock_min }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">จำนวนสูงสุดของสินค้า</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="max" value="{{ $product->stock_max }}">
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
