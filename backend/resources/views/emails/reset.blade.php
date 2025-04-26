<!-- resources/views/emails/reset.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
</head>
<body>
    <h1>Hello, {{ $customer->ho_ten }}!</h1>
    <p>You requested to reset your password. Click the link below to set a new password:</p>
    <a href="{{ $url }}">Reset Password</a>
    <p>If you did not request this, please ignore this email.</p>
</body>
</html>