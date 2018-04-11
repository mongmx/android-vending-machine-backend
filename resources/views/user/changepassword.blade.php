@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">เปลี่ยนรหัสผ่าน</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							@if ( $errors->first('password') == "The password field is required." )
								<div>
									<strong>กรุณากรอกรหัสผ่านใหม่ และยืนยันรหัสผ่านใหม่อีกครั้ง</strong>
								</div>
							@endif
							@if ( $errors->first('password') != "The password field is required." )
								<div>
									<strong>รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง</strong>
								</div>
							@endif
						</div>
					@endif
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/changepassword') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">รหัสผ่านใหม่</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">ยืนยันรหัสผ่าน</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
