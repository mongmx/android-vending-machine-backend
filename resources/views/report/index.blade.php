@extends('app')

@section('content')
<div class="container-fluid">

    @if (count($lessProduct) > 0)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" id="less-product" style="color: #cc0000; border-color: #ff4040;">
                    <div class="panel-heading text-center" style="color: #fff; background-color: #cc0000;">
                        <strong>สินค้าใกล้หมด</strong>
                        <div class="pull-right btn btn-xs btn-default no-print" onclick="print('less-product')">พิมพ์</div>
                    </div>

                    <!-- Table -->
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr class="danger">
                                <th class="text-center">รหัส</th>
                                <th class="text-center">ชื่อสินค้า</th>
                                <th class="text-center">จำนวนต่ำสุดของสินค้า</th>
                                <th class="text-center">จำนวนสินค้าคงเหลือ</th>
                                <th class="text-center">จำนวนสูงสุดของสินค้า</th>
                                <th class="text-center">จำนวนสินค้าที่ต้องซื้อเพิ่ม</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessProduct as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td class="text-right">{{$product->min}}</td>
                                    <td class="text-right">{{$product->stock}}</td>
                                    <td class="text-right">{{$product->max}}</td>
                                    <td class="text-right">{{$product->need}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" id="report">
                <div class="panel-heading text-center">
                	<strong>
                        รายงานการขาย วันที่
                        @if (isset($h_date))
                            {{-- */ $h = explode("/", $h_date); /* --}}
                            {{ $h[0] }}
                            {{ ($h[1] == 1) ? ' มค. ' : '' }}
                            {{ ($h[1] == 2) ? ' กพ. ' : '' }}
                            {{ ($h[1] == 3) ? ' มีค. ' : '' }}
                            {{ ($h[1] == 4) ? ' เมย. ' : '' }}
                            {{ ($h[1] == 5) ? ' พค. ' : '' }}
                            {{ ($h[1] == 6) ? ' มิย. ' : '' }}
                            {{ ($h[1] == 7) ? ' กค. ' : '' }}
                            {{ ($h[1] == 8) ? ' สค. ' : '' }}
                            {{ ($h[1] == 9) ? ' กย. ' : '' }}
                            {{ ($h[1] == 10) ? ' ตค. ' : '' }}
                            {{ ($h[1] == 11) ? ' พย. ' : '' }}
                            {{ ($h[1] == 12) ? ' ธค. ' : '' }}
                            {{ $h[2] + 543 }}
                        @else
                            {{ date('j') }}
                            {{ (date("m") == 1) ? ' มค. ' : '' }}
                            {{ (date("m") == 2) ? ' กพ. ' : '' }}
                            {{ (date("m") == 3) ? ' มีค. ' : '' }}
                            {{ (date("m") == 4) ? ' เมย. ' : '' }}
                            {{ (date("m") == 5) ? ' พค. ' : '' }}
                            {{ (date("m") == 6) ? ' มิย. ' : '' }}
                            {{ (date("m") == 7) ? ' กค. ' : '' }}
                            {{ (date("m") == 8) ? ' สค. ' : '' }}
                            {{ (date("m") == 9) ? ' กย. ' : '' }}
                            {{ (date("m") == 10) ? ' ตค. ' : '' }}
                            {{ (date("m") == 11) ? ' พย. ' : '' }}
                            {{ (date("m") == 12) ? ' ธค. ' : '' }}
                            {{ date('Y') + 543 }}
                        @endif
                    </strong>
                    <div class="pull-right btn btn-xs btn-default no-print" onclick="print('report')">พิมพ์</div>
                </div>

                <div class="panel-body">
                    <div class="row no-print">
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
                        <div class="col-lg-3">
                            <div class="input-group">
                                <select id="cateInput" type="text" class="form-control" onChange="window.location.href=this.value">
                                    <option>ดูรายการสินค้าตามหมวด</option>
                                    <option value="/report">ทั้งหมด</option>
                                    @foreach ($categories as $category)
                                        <option value="/report/category/{{$category->id}}">
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 pull-right text-right">
                            <div class="input-group" style="display: inline-block;">
                                <select id="dateInput" type="text" class="form-control">
                                    <option>วันที่</option>
                                    @for ($d = 1; $d <= 31; $d++)
										<option value="{{ $d }}"{{ ($d == date("d")) ? ' selected' : '' }}>
                                            {{ $d }}
                                        </option>
									@endfor
                                </select>
                            </div>
                            <div class="input-group" style="display: inline-block;">
                                <select id="monthInput" type="text" class="form-control">
                                    <option>เดือน</option>
                                    <option value="1" {{ (date("m") == 1) ? ' selected' : '' }}>มค.</option>
                                    <option value="2" {{ (date("m") == 2) ? ' selected' : '' }}>กพ.</option>
                                    <option value="3" {{ (date("m") == 3) ? ' selected' : '' }}>มีค.</option>
                                    <option value="4" {{ (date("m") == 4) ? ' selected' : '' }}>เมย.</option>
                                    <option value="5" {{ (date("m") == 5) ? ' selected' : '' }}>พค.</option>
                                    <option value="6" {{ (date("m") == 6) ? ' selected' : '' }}>มิย.</option>
                                    <option value="7" {{ (date("m") == 7) ? ' selected' : '' }}>กค.</option>
                                    <option value="8" {{ (date("m") == 8) ? ' selected' : '' }}>สค.</option>
                                    <option value="9" {{ (date("m") == 9) ? ' selected' : '' }}>กย.</option>
                                    <option value="10" {{ (date("m") == 10) ? ' selected' : '' }}>ตค.</option>
                                    <option value="11" {{ (date("m") == 11) ? ' selected' : '' }}>พย.</option>
                                    <option value="12" {{ (date("m") == 12) ? ' selected' : '' }}>ธค.</option>
                                </select>
                            </div>
                            <div class="input-group" style="display: inline-block;">
                                <select id="yearInput" type="text" class="form-control">
                                    <option>ปี</option>
									<option value="2016" selected>2559</option>
                                </select>
                            </div>
                            <div class="input-group" style="display: inline-block; vertical-align: top;">
                                <button class="btn btn-default" onclick="showHistory()">ดูรายงาน</button>
                            </div>
                        </div>
                    </div>
                    @if (count($orderItems) > 0)
                        <br class="no-print"><br class="no-print">
                        <div><h4>ยอดขายในแต่ละหมวด</h4></div>
                        @if(!is_null($totalByCate))
                            <div class="row">
                                <div>
                                    <!-- Table -->
                                    <table class="table table-hover table-bordered table-striped">
                                        <tr>
                                            <th class="text-center">หมวด</th>
                                            <th class="text-center">รวม</th>
                                        </tr>
                                        @foreach($totalByCate as $tbc)
                                            @if($tbc['total'] > 0)
                                                <tr>
                                                    <th class="text-center" width="50%">
                                                        {{ $tbc['name'] }}
                                                    </th>
                                                    <td class="text-right" width="25%">
                                                        {{ $tbc['total'] }}&nbsp;&nbsp;&nbsp;&nbsp;บาท
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        @endif
                        <div><h4>ยอดขายรวม</h4></div>
                        <div class="row">
                            <div>
                                <!-- Table -->
                                <table class="table table-hover table-bordered table-striped">
                                        <tr>
                                            <th class="text-center" width="50%">ยอดขายจากการหยอดเหรียญ</th>
                                            <td class="text-right" width="25%">{{ number_format($totalcoin, 2) }}</td>
                                            <td class="text-center" width="25%">บาท</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center" width="50%">ยอดขายจากการจ่ายเงินสด</th>
                                            <td class="text-right" width="25%">{{ number_format($totalcash, 2) }}</td>
                                            <td class="text-center" width="25%">บาท</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center" width="50%">ยอดขายรวม</th>
                                            <td class="text-right" width="25%">{{ number_format($total, 2) }}</td>
                                            <td class="text-center" width="25%">บาท</td>
                                        </tr>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

                @if (count($orderItems) > 0)
                    <div style="margin-left: 15px;"><h4>รายการสินค้า</h4></div>
                    <!-- Table -->
                    <table class="table table-hover table-bordered table-striped">
                        <thead style="border-top: 1px solid #ddd;">
                            <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">รหัส</th>
                                <th class="text-center">ชื่อสินค้า</th>
                                <th class="text-center">ราคาต่อหน่วย</th>
                                <th class="text-center">จำนวนการขาย</th>
                                <th class="text-center">ยอดขาย (บาท)</th>
                                <th class="text-center">จำนวนสินค้าคงเหลือ</th>
                                <!-- <th>สถานะ</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        	@if (count($orderItems) > 0)
    	                        {{-- */ $i = 1; /* --}}
    	                        @foreach ($orderItems as $orderItem)
    	                            <tr>
    	                                <td>{{$i++}}</td>
    	                                <td>{{$orderItem->id}}</td>
                                        <td>{{$orderItem->name}}</td>
    	                                <td class="text-right">{{$orderItem->unitprice}}</td>
    	                                <td class="text-right">{{$orderItem->total_sales}}</td>
    	                                <td class="text-right">{{$orderItem->price}}</td>
    	                                <td class="text-right">{{$orderItem->stock}}</td>
    	                                <!-- <td>{{ (is_null($orderItem->status))?"OK":"OUT" }}</td> -->
    	                            </tr>
    	                        @endforeach
    	                    @else
    	                    	<tr>
                                    <td colspan="7" class="text-center">ยังไม่มีข้อมูลการขายในวันนี้</td>
                                </tr>
    	                    @endif
                        </tbody>
                    </table>
                @else
                    <br>
                    <div class="text-center">ยังไม่มีข้อมูลการขายในวันนี้</div>
                    <br>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
    $(function () {
        // $('[data-toggle="tooltip"]').tooltip();

        $('#searchButton').click(function(){
            if ($('#searchInput').val() !== "") {
                window.location.href="{!! url('/search') !!}/"+
                $('#searchInput').val();
            } else {
                window.location.href="{!! url('/') !!}";
            };
        })

        $(document).keypress(function(e) {
            if(e.which == 13) {
                if ($('#searchInput').val() !== "") {
                    window.location.href="{!! url('/search') !!}/"+
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

    showHistory = function() {
    	dd = $('#dateInput').val();
    	mm = $('#monthInput').val();
    	YY = $('#yearInput').val();
    	if ((dd != "วันที่") && (mm != "เดือน") && (YY != "ปี")) {
    		window.location.href = "/history_report/"+dd+"/"+mm+"/"+YY;
    	}
    }

    function print(id) {
        $.print("#"+id);
    }
</script>
@stop
