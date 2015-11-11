<div>
	<img src="image/logo.jpg"/>

	Dear {{ $user->name }},

	 @if (env('APP_ENV') == 'production')

		<p>Untuk berpartisipasi dalam SMPI (Sistem Penjamin Mutu Internal), 
		Authentikasi dibutuhkan silahkan klik <a href="http://weblogindonesia.com/register/confirm/{{ $token }}">link berikut</a>, atau copy link berkut <a href="http://weblogindonesia.com/register/confirm/{{ $token }}">http://spmi.umn.ac.id/register/confirm/{{ $token }}</a> pada url browser anda</p>

	@endif
	
	@if (env('APP_ENV') == 'local')

		<p>Untuk berpartisipasi dalam SMPI (Sistem Penjamin Mutu Internal), 
		Authentikasi dibutuhkan silahkan klik <a href="http://weblogindonesia.com/register/confirm/{{ $token }}">link berikut</a>, atau copy link berkut <a href="http://weblogindonesia.com/register/confirm/{{ $token }}">http://spmi.umn.ac.id/register/confirm/{{ $token }}</a> pada url browser anda</p>

	@endif
</div>