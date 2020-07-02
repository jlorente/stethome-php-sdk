StethoMe PHP SDK v2
===============
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
$stethome->pulmonary()->getVisit($visitId);
```

### Methods

#### Security

##### getToken

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/security/get_token

Generate client token for end user device.

```php
$stethome->security()->getToken();
```

##### postToken

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/security/post_token

Generate client token for end user device, scoped to given visits ids (recommended).

```php
$stethome->security()->postToken($params);
```

#### Pulmonary

##### deleteVisit

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/delete_pulmonary_visit__id_

Delete visit recordings.

```php
$stethome->pulmonary()->deleteVisit($visitId);
```

##### getVisit

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/get_pulmonary_visit

Check processing status of all recordings associated with given visit id.

```php
$stethome->pulmonary()->getVisit($visitId);
```

##### getPoint

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/get_pulmonary_visit__id__recording__point__check

Check processing status of single recording associated with given visit id.

```php
$stethome->pulmonary()->getPoint($visitId, $point);
```

##### getPointTags

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/get_pulmonary_visit__id__recording__point__tags

Get analysed tags for a single recording from given visit id.

```php
$stethome->pulmonary()->getPointTags($visitId, $point);
```

##### getPointWav

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/get_pulmonary_visit__id__recording__point__wav

Get single recording audio file for playback.

```php
$stethome->pulmonary()->getPointWav($visitId, $point);
```

##### getVisitId

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/get_pulmonary_visit

Generate visit ID. All subsequent client requests will have to send this ID to properly match all recordings to same visit.

```php
$stethome->pulmonary()->getVisitId();
```

##### postVisitContent

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/post_pulmonary_visit__id_

Add visit content.

```php
$stethome->pulmonary()->postVisitContent($visitId, array $parameters = []);
```

##### copyVisit

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/get_pulmonary_visit__id__copy

Create visit copy token.

```php
$stethome->pulmonary()->copyVisit($visitId);
```

##### lockVisit

https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/pulmonary/post_pulmonary_visit__id__lock

Lock visit.

```php
$stethome->pulmonary()->lockVisit($visitId);
```

## License 
Copyright &copy; 2020 José Lorente Martín <jose.lorente.martin@gmail.com>.

Licensed under the BSD 3-Clause License. See LICENSE.txt for details.
