@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">เข้าสู่ระบบ</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							@if ( $errors->first('name') == "The name field is required." )
								<div>
									<strong>กรุณากรอกชื่อผู้ใช้งาน</strong>
								</div>
							@endif
							@if ( $errors->first('name') == "These credentials do not match our records." )
								<div>
									<strong>รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</strong>
								</div>
							@endif
							@if ( $errors->has('password') )
								<div>
									<strong>กรุณากรอกรหัสผ่าน</strong>
								</div>
							@endif
						</div>
					@endif
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">ผู้ใช้งาน</label>
							<div class="col-md-6">
								<!-- <input type="email" class="form-control" name="email" value="{{ old('email') }}"> -->
								<input type="name" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">รหัสผ่าน</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
