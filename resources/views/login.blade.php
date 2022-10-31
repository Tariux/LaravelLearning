<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="{{ route('do.login') }}" method="post">
        
        @csrf
        
        <input type="email" placeholder="Email..." name="email"><br><br>
        <input type="password" placeholder="Password..." name="password"><br><br>
        <input type="submit" value="Login account">
    </form>
    {{
        Auth::user();
    }}

</body>
</html>