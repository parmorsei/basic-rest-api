# Play Basic  simple REST API Web service


Installation
------------
Libraries rest apt with Mongodb
```
composer require jenssegers/mongodb

Configuration
-------------

Change your default database connection name in `app/config/database.php`:

```php
'default' => env('DB_CONNECTION', 'mongodb'),
```

And add a new mongodb connection:

```php
'mongodb' => [
    'driver'   => 'mongodb',
    'host'     => env('DB_HOST', 'localhost'),
    'port'     => env('DB_PORT', 27017),
    'database' => env('DB_DATABASE'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'options' => [
        'db' => 'admin' // sets the authentication database required by mongo 3
    ]
],

Create collection and set unique email

```php
> db.createCollection("items", {} )
{ "ok" : 1 }
> db.items.createIndex( { email: 1 }, { unique: true } )
{
        "createdCollectionAutomatically" : false,
        "numIndexesBefore" : 1,
        "numIndexesAfter" : 2,
        "ok" : 1
}
> 

],
```

Code Guild
------------

  - App\Http\Controllers\Api\ServicesController  this ServicesController is controller user access operations and handle respones
  - App\Lib\Api\BasicServices BasicServices is processor activity about fuctions


Examples
------------

### Basic Usage

**Path :: /api/1/basic/items**

### Method "GET"  /api/1/basic/items
   
    restpone data list 
**Params**
```php
    page : numeric
    limit : numeric
```
**Sample**
```php
curl -X GET -G 'http://xxx/api/1/basic/items' -d 'page=0&limit=10'
```
**Respone 200**
```php
   {
  "code": 200,
  "message": "success",
  "data": {
    "total": 3,
    "per_page": 10,
    "current_page": 1,
    "last_page": 1,
    "next_page_url": null,
    "prev_page_url": null,
    "from": 1,
    "to": 3,
    "data": [
      {
        "_id": "570e564fcf2bdf047737aad4",
        "name": "val2",
        "email": "parmorsei@gmail.com",
        "descriptions": null,
        "updated_at": "2016-04-13 14:37:11",
        "created_at": "2016-04-13 14:23:11"
      },
      {
        "_id": "570e581bcf2bdf047865fec5",
        "name": "test",
        "description": "test",
        "updated_at": "2016-04-13 14:30:51",
        "created_at": "2016-04-13 14:30:51"
      },
      {
        "_id": "570e5a0ccf2bdf047737aad5",
        "name": "maethee",
        "email": "parmorsei@2gmail.com",
        "descriptions": "test",
        "updated_at": "2016-04-13 14:39:08",
        "created_at": "2016-04-13 14:39:08"
      }
    ]
  }
}
```
**Error 400**
```php
{"code":400,"error":"xxx" }"}
```



