<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="/register" method="post">
        {{
            csrf_field()
        }}
        <input type="text" placeholder="Name..." name="name"><br><br>
        <input type="email" placeholder="Email..." name="email"><br><br>
        <input type="password" placeholder="Password..." name="password"><br><br>
        <input type="submit" value="Create account">
    </form>
</body>
</html>