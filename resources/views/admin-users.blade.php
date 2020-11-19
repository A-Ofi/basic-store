<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
    <link rel="stylesheet" href=" {{ mix('/css/users.css') }} ">
    <title>Users</title>
</head>
<body>
    <label class="title">Users</label>
    <x-user-table :users="$users" :headers="['Name', 'Email', 'Created at']" />
    {{ $users->links('paginator', ['paginator' => $users]) }}
    
    <a class="button-link" href="/admin/users/create">
        <button class="create-btn" type="button">Create new user</button>
    </a>
</body>
</html>