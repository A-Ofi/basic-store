<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/login.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <div class="form-card">
        <p class="form-title"> Admin Login </p>
        <form action="" method="post">
            <div class="fields">
                @csrf
                <input type="email" name="email" placeholder="Email" id="email">
                <input type="password" name="password" placeholder="Password" id="password">
            </div>
            <button type="submit">Sign in</button>
        </form>
        @if (session('err'))
                <p class="err-msg">{{session('err')}}</p>
        @endif
    </div>
</body>
</html>