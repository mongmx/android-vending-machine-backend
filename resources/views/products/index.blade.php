@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong>จัดการสินค้า</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <a class="btn btn-primary" href="/product/create">
                                <i class="glyphicon glyphicon-plus"></i>
                                เพิ่มสินค้า
                            </a>
                        </div>
                        <!-- <div class="col-lg-3">
                            <div class="input-group custom-search-form">
                                <input id="searchInput" type="text" class="form-control" placeholder="ค้นหา">
                                <span class="input-group-btn">
                                    <button id="searchButton" class="btn btn-default" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-3 pull-right">
                            <a class="btn btn-default pull-right" href="/reset-queue" onclick="return confirm('คุณต้องการรีเซ็ตคิว ใช่หรือไม่?')">
                                <i class="glyphicon glyphicon-exclamation-sign"></i>
                                รีเซ็ตคิว
                            </a>
                        </div> -->
                        <div class="col-lg-6">
                            <div class="input-group" style="width: 100%">
                                <select id="cateInput" type="text" class="form-control" onChange="window.location.href=this.value">
                                    <option>หมวดหมู่สินค้า</option>
                                    <option value="/product">ทั้งหมด</option>
                                    @foreach ($categories as $category)
                                        <option value="/product/category/{{$category->id}}">
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">หมวดสินค้า</th>
                            <th class="text-center">รหัสสินค้า</th>
                            <th class="text-center">ชื่อสินค้า</th>
                            <th class="text-center">ราคา</th>
                            <th class="text-center">จำนวนสินค้าคงเหลือ</th>
                            <th class="text-center">จำนวนต่ำสุดของสินค้า</th>
                            <th class="text-center">จำนวนสูงสุดของสินค้า</th>
                            <th width="60" class="text-center">แก้ไข</th>
                            <th width="60" class="text-center">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td class="text-right">{{$product->price}}</td>
                                <td class="text-right">{{$product->stock}}</td>
                                <td class="text-right">{{$product->stock_min}}</td>
                                <td class="text-right">{{$product->stock_max}}</td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary" href="/product/{{$product->id}}/edit" data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ URL::route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('ยืนยันว่าจะลบสินค้านี้?');">
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
                {{-- {!! $products->render() !!} --}}
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
    $(function () {
        // $('[data-toggle="tooltip"]').tooltip();

        $('#searchButton').click(function(){
            if ($('#searchInput').val() !== "") {
                window.location.href="{!! url('/product/search') !!}/"+
                $('#searchInput').val();
            } else {
                window.location.href="{!! url('/product/') !!}";
            };
        })

        $(document).keypress(function(e) {
            if(e.which == 13) {
                if ($('#searchInput').val() !== "") {
                    window.location.href="{!! url('/product/search') !!}/"+
                    $('#searchInput').val();
                };
            }
        });
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stop
