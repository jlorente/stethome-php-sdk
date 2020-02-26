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
$stethome->api()->getToken();
```

#### getVisit

https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#947e93dc-97d0-4864-8b6b-24d15f018770

Check processing status of all recordings associated with given visit id.

```php
$stethome->api()->getVisit($visitId);
```

#### getPoint

https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#7b46673b-5505-41e1-bf61-6f0babe54964

Check processing status of single recording associated with given visit id.

```php
$stethome->api()->getPoint($visitId, $point);
```

#### getPointTags

https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#a664d3ed-4931-4fec-bc1b-c71cdc28f68a

Get analysed tags for a single recording from given visit id.

```php
$stethome->api()->getPointTags($visitId, $point);
```

#### getPointWav

https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#35ad2fca-bc3c-4977-95c0-c034cad6270c

Get single recording audio file for playback.

```php
$stethome->api()->getPointWav($visitId, $point);
```

#### getVisitId

https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#1403949b-2a3c-4bc3-982c-7923f31f22f5

Generate visit ID. All subsequent client requests will have to send this ID to properly match all recordings to same visit.

```php
$stethome->api()->getVisitId();
```

#### addPointRecord

https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#eb72c015-046b-4fb6-8284-14bdb45bc9ea

Adds recording to visit with given id.

```php
$stethome->api()->addPointRecord($visitId, array $parameters = []);
```

## License 
Copyright &copy; 2020 José Lorente Martín <jose.lorente.martin@gmail.com>.

Licensed under the BSD 3-Clause License. See LICENSE.txt for details.
