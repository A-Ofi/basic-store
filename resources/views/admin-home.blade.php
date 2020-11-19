<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=" {{ mix('css/app.css') }} ">
    <link rel="stylesheet" href=" {{ mix('css/home.css') }} ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <div class="card"
        onclick="location.href='users';">

        <img class="card-image" src="/img/users.png" alt="Users" width="180" height="130">
        <p class="card-title"> Users </p>
        <div class="card-description">
            Manage users,
            accounts status,
            register or delete users,
            edit users data
        </div>
    </div>

    <div class="card"
        onclick="location.href='items';">

        <img class="card-image" src="/img/items.png" alt="Items" width="180" height="130">
        <p class="card-title"> Items </p>
        <div class="card-description">
            Manage items,
            items status,
            add or delete items,
            edit items data
        </div>
    </div>

</body>
</html>