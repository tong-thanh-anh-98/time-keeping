<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
</head>
<body>
    <h1>Dear {{ $name }},</h1>
    <p>Your account has been successfully created.</p>
    <p>Here are your account details:</p>
    <ul>
        <li>Name: {{ $name }}</li>
        <li>Email: {{ $email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>
    <p>Thank you for registering with us!</p>
    <p>Please change your password to ensure personal information security!</p>
</body>
</html>