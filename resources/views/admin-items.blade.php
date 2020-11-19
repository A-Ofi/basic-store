<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
    <link rel="stylesheet" href=" {{ mix('/css/items.css') }} ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
    <title>Items</title>
</head>
<body>
    <label class="title">Items</label>
    <x-item-table :items="$items" :headers="[
        'Name', 'Description', 'Price', 'City', 'Created at']" />
        
    {{ $items->links('paginator', ['paginator' => $items]) }}

    <a class="button-link" href="/admin/items/create">
        <button class="create-btn" type="button">Create new item</button>
    </a>
    
</body>
</html>