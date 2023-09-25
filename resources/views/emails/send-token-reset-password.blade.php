<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <p>Hello,</p>
    <p>You have requested a password reset. Your token is: {{ $token }}</p>
    <p>Click the link below to reset your password:</p>
    <a href="{{ url('api/reset-password', $token) }}">Reset Password</a>
</body>
</html>
