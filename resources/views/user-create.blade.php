<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
    <link rel="stylesheet" href=" {{ mix('/css/createUser.css') }} ">
    <title>Create User</title>
</head>
<body>
    <label class="title">User info</label>
    <div class="info-card">
        <x-user-form create="true" />
    </div>
</body>
</html>