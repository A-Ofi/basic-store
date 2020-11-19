<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
    <link rel="stylesheet" href=" {{ mix('/css/item.css') }} ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <label class="title">Item info</label>
    <div class="info-card">
        <x-item-form :item="$item" />
    </div>
    <!--
        users who have this item in their cart
    -->
    <label class="second-title">Item clients</label>
    <x-user-table :users="$item->users()->get()" :detachableItem="$item" :headers="['name']"/>
</body>
<script src=" {{ mix('/js/buttonsHandler.js') }} "></script>

</html>