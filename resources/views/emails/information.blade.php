<div>
	<img src="image/logo.jpg"/>

	Dear {{ $user->name }},

	 @if (env('APP_ENV') == 'local')

		<p>Untuk berpartisipasi dalam SMPI (Sistem Penjamin Mutu Internal), 
		Authentikasi dibutuhkan silahkan klik <a href="http://localhost:8000/user/token/{{ $token }}">link berikut</a>, atau copy link berkut <a href="http://localhost:8000/user/token/{{ $token }}">http://localhost:8000/userToken/{{ $token }}</a> pada url browser anda</p>

	@endif
</div>