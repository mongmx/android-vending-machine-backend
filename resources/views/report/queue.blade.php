@extends('app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" id="report">
                <div class="panel-heading text-center">
                	<strong>
                        คิวการซื้อขาย
                    </strong>
                    <!-- <div class="pull-right btn btn-xs btn-default no-print" onclick="print('report')">EXPORT</div> -->
                </div>

                <!-- Table -->
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">คิวที่</th>
                            <th class="text-center">รายการสินค้า</th>
                            <th class="text-center">จ่ายเงิน</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">ยอดรวม</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@if (count($orderQueue) > 0)
	                        @foreach ($orderQueue as $queue)
	                            <tr>
                                    <td class="text-center" width="10%">{{ $queue->id }}</td>
                                    <td width="50%">
                                        <table class="table table-bordered" style="margin-bottom: 0;">
                                            @foreach ($queue->orderItems as $item)
                                                <tr>
                                                    <td width="60%">{{ $item->name }}</td>
                                                    <td class="text-right" width="15%">{{ $item->quantity }} ชิ้น</td>
                                                    <td class="text-right" width="25%">{{ $item->subtotal }} บาท</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td class="text-center" width="15%">
                                        @if ($queue->status == 1)
                                            <span class="label label-success">ชำระเงินแล้ว</span><br>(หยอดเหรียญ)
                                        @elseif ($queue->status == 3)
                                            <span class="label label-warning">รอชำระเงิน</span><br>(เงินสด)
                                        @elseif ($queue->status == 4)
                                            <span class="label label-success">ชำระเงินแล้ว</span><br>(เงินสด)
                                        @endif
                                    </td>
                                    <td class="text-center" width="15%">
                                        @if ($queue->status == 1)
                                            <span class="label label-warning">รอจ่ายของ</span><br>
                                        @elseif ($queue->status == 4)
                                            <span class="label label-warning">รอจ่ายของ</span><br>
                                        @elseif ($queue->status == 7)
                                            <span class="label label-success">จ่ายของแล้ว</span><br>
                                        @elseif ($queue->status == 8)
                                            <span class="label label-success">จ่ายของแล้ว</span><br>
                                        @endif
                                    </td>
	                                <td class="text-right" width="20%">{{ number_format($queue->total, 2) }}</td>
	                            </tr>
	                        @endforeach
	                    @else
	                    	<tr>
                                <td colspan="6" class="text-center">ยังไม่มีข้อมูลการขายในวันนี้</td>
                            </tr>
	                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
    $(function () {
        // $('[data-toggle="tooltip"]').tooltip();
        setTimeout(function(){
            window.location.reload(true);
        }, 10000);

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
