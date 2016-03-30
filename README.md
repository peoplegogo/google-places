# Google Places API - A PHP wrapper
[![Latest Stable Version](http://img.shields.io/packagist/v/peoplegogo/google-places.svg)](https://packagist.org/packages/peoplegogo/google-places)
[![License](http://img.shields.io/badge/license-MIT-lightgrey.svg)](https://github.com/peoplegogo/google-places/blob/master/LICENSE)
[![Build Status](http://img.shields.io/travis/peoplegogo/google-places.svg)](https://travis-ci.org/peoplegogo/google-places/)

![Logo of Google Places API Web Service](https://raw.githubusercontent.com/peoplegogo/google-places/master/google-places.png)

This is a PHP wrapper for Google Places API Web Service.

## Installation
### Composer
The recommended installation method is through [Composer](https://getcomposer.org/). Add to your composer.json file:
``` json
{
    "require": {
        "peoplegogo/google-places": "~1.0"
    }
}
```
or with the following command from your browser:
```
composer require peoplegogo/google-places
```

Check [in Packagist](https://packagist.org/packages/peoplegogo/google-places).

### Manually
Steps:
- Copy src/GooglePlaces.php to your codebase, perhaps to the vendor directory.
- Add the GooglePlaces class to your autoloader or require the file directly.

## Getting Started
First you have to create an instance of GooglePlaces:
``` php
$google_places = new GooglePlaces();
```

You can pass the API key _(used to authenticate in front of Google service)_ during the creation of the instance or you can set it up later.
``` php
$google_places = new GooglePlaces($apiKey);
```
or
``` php
$google_places = new GooglePlaces();
$google_places->setApiKey($apiKey);
```

By default, the format is set to json but you can change it that way:
``` php
$google_places = new GooglePlaces($apiKey, $format);
```
or
``` php
$google_places->setFormat($format);
```

You can also set up the language if you want. 
``` php
$google_places->setLanguage($language_code);
```
In this way it won't be necessary to set up the language within every request.

You can also prepare the input parameters:
``` php
$params = [
	'input' => 'Vict',
	'types' => '(cities)',
	'language' => 'pt_BR' 
];
```
Once all parameters are set, the final step is to send the request to the Google Places Api:
``` php
$results = $google_places->getAutocomplete($params);
```

The result is an array. The GooglePlaces class decodes the response received from Google, so it is not necessary for you to do that.

For more information for the methods and the features of the library you can check _"src"_ or _"tests"_ folders.
## Contributing
How can you contribute:

1. Fork it.
2. Create your feature branch (git checkout -b my-new-feature).
3. Commit your changes (git commit -am 'Added some feature').
4. Push to the branch (git push origin my-new-feature).
5. Create a new Pull Request.
