<h1>Đăng nhập thành công</h1>
@if (isset($user))
	{{ "Tên : " . $user=>name }}
	<br>
	{{ "email : ". $user=>email }}
@endif