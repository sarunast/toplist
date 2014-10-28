<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Account Confirmation</h2>

		Hello {{$username}}
		<div>
			Please access the link below to confirm your account.: {{ URL::to('verify', array($token)) }}.
		</div>

		Regards TamyTop Team
	</body>
</html>