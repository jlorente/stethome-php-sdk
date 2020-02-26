StethoMe PHP SDK
=============
A PHP package to access the [StethoMe API](https://stethome.me/docs/api) by a comprehensive way.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

With Composer installed, you can then install the extension using the following commands:

```bash
$ php composer.phar require jlorente/stethome-php-sdk
```

or add 

```json
...
    "require": {
        "jlorente/stethome-php-sdk": "*"
    }
```

to the ```require``` section of your `composer.json` file.

## Configuration

You can set the STETHOME_VENDOR_TOKEN as environment variables or add them later 
on StethoMe class instantiation.

The name of the environment var is STETHOME_VENDOR_TOKEN.

## Usage

Endpoints calls must done through the StethoMe class.

If you haven't set the environment variable previously, remember to provide the 
key on instantiation.

```php
$stethome = new \Jlorente\StethoMe\StethoMe($secretVendorToken);
$stethome->api()->getVisit($visitId);
```

### Methods

#### getToken

https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#79b4672f-642c-4e47-8b89-7d7fe29762de

Returns a client token.

```php
$stethome = new \Jlorente\StethoMe\StethoMe($secretVendorToken);
$stethome->api()->getToken();
```

#### getVisit

https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#947e93dc-97d0-4864-8b6b-24d15f018770

Check processing status of all recordings associated with given visit id.

```php
$stethome = new \Jlorente\StethoMe\StethoMe($secretVendorToken);
$stethome->api()->getVisit(string $visitId);
```

## License 
Copyright &copy; 2020 José Lorente Martín <jose.lorente.martin@gmail.com>.

Licensed under the BSD 3-Clause License. See LICENSE.txt for details.
