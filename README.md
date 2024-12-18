Demo Product Service
========================

Requirements
------------

* PHP 8.2.0 or higher;
* and the [usual Symfony application requirements][1].
* RabbitMQ service.

Installation
------------
**STEP 1.** Please clone tne project into the document root folder .

**STEP 2.** Configure .env according to env.example

**STEP 3.** Create DB and execute migrations 
```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
**STEP 4.** Run a message consumer

```
php bin/console messenger:consume async -vv
```

API Endpints :
------------
**Get all products.**

**Method:** `GET`  
**Endpoint:** `/product`  
```
curl --request GET \
--url http://demo-product.loc/product
```

**Get a single product.**

**Method:** `GET`  
**Endpoint:** `/product/{uuid}`
```
curl --request GET \
--url http://demo-product.loc/product/1efbd2ee-68e0-608a-95c6-29d8fbfde3cf 

```

**Create a new product.**

**Method:** `POST`  
**Endpoint:** `/product`

**Content Body**
```
{
  "name": {Product name},
  "qty": {qty},
  "price": {price}
}

```
```
curl --request POST \
--url http://demo-product.loc/product \
--header 'Content-Type: application/json' \
--data '{
"name": "Iphone 12",
"qty": 5,
"price": 1200
}'
```

**Decrease a quality from the inventory.**

**Method:** `POST`  
**Endpoint:** `/inventory/{uuid}/decrease`

**Content Body**
```
{
  "qty": {qty},
}

```
```
curl --request POST \
  --url http://demo-product.loc/inventory/1efbcc4b-47e6-6ef0-ac48-77ca4906f7b4/decrease \
  --header 'Content-Type: application/json' \
  --data '{
	"qty": 1
}'
```
[1]: https://symfony.com/doc/current/setup.html#technical-requirements