# Basic Store
This is a basic store created for coop training using [Laravel](http://laravel.com)

## installation

clone the repository and navigate to it
install dependencies
```bash
$ composer install
$ npm install
```

create your own `.env` file
```bash
$ cat .env.example > .env
```
modify `.env` file with your own configration
compile assets files
```bash
$ npm run dev
```
build your databse
```bash
$ php artisan migrate
```
## database seeding
We are using [fakerJS](https://www.npmjs.com/package/faker) to seed our database instead of [PHP faker](https://github.com/fzaninotto/Faker), the reason is PHP faker doesn't have english text. this is achived by serving [fakerJS](https://www.npmjs.com/package/faker) from a NodeJS http server listening on `localhost:7500` (can be configured at `.env`). The Server is turned on by package `packages/Helium/FakerJS` everytime we ask for `db:seed`
to seed the database
```bash
$ php artisan db:seed
```
this will seed the databse with 30 users each one selling 0 to 10 items and each 5 to 8 items in their carts.

to create an Admin user
```bash
$ php artisan tinker
>>> $admin = new App\Models\Admin();
>>> # fill name, email, password
>>> $admin->name = "...";
>>> $admin->email = "...";
#no need to call Hash::make()
>>> $admin->password = "...";
>>> $admin->save();
```
## Running The Store
```bash
$ php artisan serve
```
now navigate to `localhost:8000/admin`
logging out is not implemented right now to signout clear cookies or close your browser.
### API
```
# to create new User
POST /api/user/signup
body: {
    "name": "",
    "email": "",
    "password": "",
    "password_confirmation": ""
}
```
```
# to log in
POST /api/user/login
body: {
    "email": "",
    "password": "",
}
```
```
# to log out
# [authentication required]
POST /api/user/logout
```
```
# create new Item
# [authentication required]
POST /api/item
body: {
    "name": "",
    "description": "",
    "price": "",
    city: ""
}
```
```
# update Item
# [authentication required]
POST /api/item/update/{item_id}
# only included data in body will be updated
body: {
    "name": "",
    "description": "",
    "price": "",
    city: ""
}
```
```
# delete Item
# [authentication required]
POST /api/item/delete/{item_id}
```
```
# add Item to cart
# [authentication required]
POST /api/item/add/{item_id}
```
```
# remove Item from cart
# [authentication required]
POST /api/item/remove/{item_id}
```
```
# get item
# [authentication required]
GET /api/item/{item_id}
```
when signing up or signin in server will send authentication token in `authentication_token` header. to authinticate a request, a valid token should be sent as a bearer token in `Authorization` header e.g `Authorization: Bearer <token>`.