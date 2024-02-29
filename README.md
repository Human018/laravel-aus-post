# Laravel Australia Post Package (laravel-aus-post)

## Description

This is a Laravel package designed specifically to interface with the Australia Post API, providing a simple and efficient way to integrate Australia Post API services into your Laravel applications.

IMPORTANT: This package is a work in progress.

## Requirements

- PHP 8.1 or above
- Laravel Framework 9.52.4 or higher
## Installation

Use the package manager [composer](https://getcomposer.org/) to install Laravel Australia Post Package.

```compose require human018/laravel-aus-post```

After installation add your Australia Post API key to your .env file

```dotenv
AUSPOST_KEY=...
```

## Usage

The package uses the following class and method chaining in order to request postage information from Australia Post API.
```php
use Human018\LaravelAusPost\AusPost
```
At the very least you will need to provide the originating and destination postcodes, the type of postage and the postage service to use.

It's required that you always begin by stating the type of postage you wish to use - domestic or international.

```php
AusPost::domestic()
AusPost::international()
```

After which additional methods can be chained

```php
AusPost::domestic()
->parcelCalculate() // Tells the service we will be calculating for a Parcel (as opposed to a letter)
->fromPostcode // 4 digit origin postcode
->toPostcode // 4 digit destination postcode
->width() // mm
->height() // mm
->length() // mm
->weight() // grams
->usingService() // Provide one of the below service types
// AUS_PARCEL_EXPRESS
// AUS_PARCEL_REGULAR
->get() // Retrieves the result
```

## Domestic Postage Example
```php
Human018\LaravelAusPost\AusPost::domestic()->parcelCalculate()->fromPostcode(3000)->toPostcode(2000)->usingService('AUS_PARCEL_REGULAR')->get();
```

Result
```php
[
    "postage_result" => [
      "service" => "Parcel Post",
      "delivery_time" => "Delivered in 2-3 business days",
      "total_cost" => "10.60",
      "costs" => [
        "cost" => [
          "item" => "Parcel Post",
          "cost" => "10.60",
        ],
      ],
    ],
    "service" => [
      "service" => "AUS_PARCEL_REGULAR",
      "name" => "Regular Post",
      "description" => "Australia Post: Regular Parcel",
      "delivery_time" => "3-5 business days",
    ],
  ]
```
