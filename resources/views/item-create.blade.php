<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
    <link rel="stylesheet" href=" {{ mix('/css/createItem.css') }} ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
</head>
<body>
    <label class="title">Item info</label>
    <div class="info-card">
        <x-item-form new="true" />
    </div>
</body>
</html>