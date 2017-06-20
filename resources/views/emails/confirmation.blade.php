<!DOCTYPE html>
<html>
<head>
	<title>Confirmation Email from ClinicJet Support</title>
</head>
<body>
	<h1>Welcome to ClinicJet</h1>
	<p>
		You need to confirm your email address by clicking <a href='{{ url("register/confirm/{$user->token}") }}'>here</a>
	</p>
</body>
</html>