## **Yelp Business Api**

I created this project using Laravel 10

## Technology
* Laravel Framework 10
* MySql
* Php 8.1

## Initial Setup
* Clone this Repositores
* Composer Install
* Copy .env.example and rename to .env
* Change the content of .env
* Running php artisan key:generate

## ENV
``` plaintext
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=business
DB_USERNAME=root
DB_PASSWORD=
```

## Import database
``` plaintext
running : php artisan migrate
```

## Api Documentation

### GET Method

``` plaintext
To access search data using a link : http://127.0.0.1:8000/api/business/search

The query parameters that must be filled in are: location or latitude and longtitude.

Types of query parameters available: 
1. location
2. latitude
3. longtitude
4. term
5. radius
6. locale
7. limit
```

### POST Method

``` plaintext
To access add data using a link  : http://127.0.0.1:8000/api/business

example body data : 
{
        "business_name": "Rubirosa",
        "location" : "NY",
        "latitude": 40.722766,
        "longtitude": -73.996233,
        "term": "Cafe",
        "radius": 20,
        "categories": "Cafe",
        "locale": "NY",
        "price": 530,
        "open_now": true,
        "open_at": "8.45",
        "attributes": "High"
}

```

### PUT Method
``` plaintext
To access update data using a link  : http://127.0.0.1:8000/api/business/1

example body data : 
{
        "business_name": "Seven Chicken",
        "location" : "NYC",
        "latitude": "-7.938530",
        "longtitude": "112.629452",
        "term": "Resto & Cafe",
        "radius": 20,
        "categories": "Coffee & Backrey",
        "locale": "ID",
        "price": "2000",
        "open_now": false,
        "open_at": "10.00",
        "attributes": "Cozy"
}

```

### DELETE Method
``` plaintext
To access delete data using a link : http://127.0.0.1:8000/api/business/1

```
