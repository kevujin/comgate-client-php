[![Build Status](https://travis-ci.org/renat-magadiev/comgate-client.svg?branch=master)](https://travis-ci.org/renat-magadiev/comgate-client) [![Coverage Status](https://coveralls.io/repos/github/renat-magadiev/comgate-client/badge.svg?branch=master)](https://coveralls.io/github/renat-magadiev/comgate-client?branch=master)

# Comgate API client
Comgate API client wrapper conatining all available developed request/responses

Is forked from from tomasz-kusy/comgate-client and contains also updates from renat-magadiev/comgate-client which is the original developer

Requirements
-------------
- PHP 7.0 or higher
- [guzzlehttp/guzzle](https://packagist.org/packages/guzzlehttp/guzzle)

Installation
------------
```sh
$ composer require kevujin/comgate-client
```


Basic usage
------------

```php
use Comgate\Client;
use Comgate\Request\CreatePayment;

$client = new Client('merchant', true, 'secret');
$createPayment = new CreatePayment(1000, 'orderId', 'test@test.cz', 'Product name');

$createPaymentResponse = $client->send($createPayment);

$redirectUrl = $createPaymentResponse->getRedirectUrl();

```

`CreatePayment` class has the same props as described in Comgate [documentation](https://platebnibrana.comgate.cz/cz/protokol-api#sidemenu-link-12)