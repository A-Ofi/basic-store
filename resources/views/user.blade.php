<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
    <link rel="stylesheet" href=" {{ mix('/css/user.css') }} ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User: {{ $user->name }}</title>
</head>
<body>
    <div class="main">
        <div class="ribbon">
            <div class="info"><!--user's data-->
                <img src="https://picsum.photos/200/150" alt="" srcset="">
                <x-user-form :user="$user" />
            </div>
        </div>
        <label class="title">User's items</label>
        <div class="items">
            <x-item-table :headers="[
                    'Name',
                    'Description',
                    'Price',
                    'City',
                    ]" 
                    :items="$user->items()->get()"
            />
        </div>
        <label class="title" id="second-title">Items in cart</label>
        <div class="second-items">
            <x-item-table :headers="['Name']" :items="$user->cart()->get()" :detachableUser="$user" />

        </div>
    </div>

    
        
</body>
<script src=" {{ mix('/js/buttonsHandler.js') }} "></script>
</html>