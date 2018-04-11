<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vending Machine</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	@yield('style')

	<!-- Fonts -->
	{{-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> --}}

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body ng-app="ngCart" ng-controller="NgCartController">
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				@if (!Auth::guest())
					@if (Auth::user()->name == 'admin')
                        <a class="navbar-brand" href="{{ url('/home') }}" style="font-weight: 600; font-size: 24px;">Vending Machine</a>
                    @endif
                @else
                	<a class="navbar-brand" href="{{ url('products') }}" style="font-weight: 600; font-size: 24px;">Vending Machine</a>
				@endif
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="font-size: 16px; font-weight: 600;">
				<ul class="nav navbar-nav">
					@if (!Auth::guest())
						@if (Auth::user()->name == 'admin')
							<li class="{{ Request::is('report') ? 'active' : '' }} {{ Request::is('home') ? 'active' : '' }}"><a href="{{ url('report') }}">รายงานยอดขาย</a></li>
							<li class="{{ Request::is('product') ? 'active' : '' }}"><a href="{{ url('product') }}">จัดการสินค้า</a></li>
	                        <li class="{{ Request::is('manage-category') ? 'active' : '' }}"><a href="{{ url('manage-category') }}">จัดการหมวดสินค้า</a></li>
							<li class="{{ Request::is('queue') ? 'active' : '' }}"><a href="{{ url('queue') }}">คิวการซื้อขาย</a></li>
							<li><a href="{{ url('reset-queue') }}" onclick="return confirm('คุณต้องการรีเซ็ตคิว ใช่หรือไม่?')">รีเซ็ตคิวการซื้อขาย</a></li>
                        @endif
					@endif
					@if (Auth::guest())
						<li class="{{ Request::is('products') ? 'active' : '' }}"><a href="{{ url('products') }}">รายการสินค้า</a></li>
						<li class="{{ Request::is('queue') ? 'active' : '' }}"><a href="{{ url('queue') }}">คิวการซื้อขาย</a></li>
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">เข้าสู่ระบบ</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ ucwords(Auth::user()->name) }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('changepassword') }}">เปลี่ยนรหัสผ่าน</a></li>
								<li><a href="{{ url('/auth/logout') }}">ออกจากระบบ</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.4.0/jQuery.print.min.js"></script>
	@yield('script')

	<script type="text/javascript">

	</script>
</body>
</html>
