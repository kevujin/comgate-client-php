[![Build Status](https://travis-ci.org/renat-magadiev/comgate-client.svg?branch=master)](https://travis-ci.org/renat-magadiev/comgate-client) [![Coverage Status](https://coveralls.io/repos/github/renat-magadiev/comgate-client/badge.svg?branch=master)](https://coveralls.io/github/renat-magadiev/comgate-client?branch=master)

# Comgate API client
Comgate API client wrapper conatining all available developed request/responses

Is forked from from tomasz-kusy/comgate-client and contains also updates from renat-magadiev/comgate-client which is the original developer

Requirements
-------------
- PHP 7.4 or higher
- [guzzlehttp/guzzle](https://packagist.org/packages/guzzlehttp/guzzle)

Installation
------------
```sh
$ composer require kevujin/comgate-client
```


Base usage - create a client
------------

```php
use Comgate\Client;

$client = new Client(
    'merchant', // your merchant ID you got from Comgate
    true, // if testing environment -> false = production
    'secret' // secret passphrase/token you got from Comgate
);

```

Create payment
------------

```php
use Comgate\Request\CreatePayment;

$createPayment = new CreatePayment(
    1000, // the price in cents 10.00 => 1000
    'orderId', // your ID
    'test@test.cz', // email of customer or some email for Comgate to communicate with if payment problems
    'Product name' // payment label
);

$createPaymentResponse = $client->send($createPayment);

$redirectUrl = $createPaymentResponse->getRedirectUrl();

```

`CreatePayment` class has the same props as described in Comgate [documentation](https://help.comgate.cz/docs/protocol-api-en#creating-a-payment)


Get payment status
------------

```php
use Comgate\Request\PaymentStatus;

$paymentStatus = new PaymentStatus(
    'transId' // Comgate ID you received from create payment process
);

$paymentStatusResponse = $client->send($paymentStatus);

```

`PaymentStatus` response class has the same props as described in Comgate [documentation](https://help.comgate.cz/docs/protocol-api-en#getting-payment-status-in-the-background)


Cancel payment
------------

```php
use Comgate\Request\CancelPayment;

$cancelPayment = new CancelPayment(
    'transId' // Comgate ID you received from create payment process
);

$cancelPaymentResponse = $client->send($cancelPayment);

```

`CancelPayment` response and request class has the same props as described in Comgate [documentation](https://help.comgate.cz/docs/protocol-api-en#storno-of-payment)


Get payment methods
------------

```php
use Comgate\Request\GetMethods;

$getMethods = new GetMethods(
    'currency', // currency to filter methods for, could be null to match all available
    'country' // country to filter methods available in, could be null to match all available
);

$getMethodsResponse = $client->send($getMethods);
var_dump($getMethodsResponse->methods);
var_dump($getMethodsResponse->getMethod('BANK_ALL')); // exact one method
```

`GetMethods` response and request class are described in Comgate [documentation](https://help.comgate.cz/docs/protocol-api-en#obtaining-allowed-methods)

List transfers
------------
Get the list of fund transfer for provided date. There might be more transfers in one day than only one or there can be none.
Transfers are used to be processed about 15:00 GMT.

```php
use Comgate\Request\ListTransfers;

$listTransfers = new ListTransfers(
    date('Y-m-d') // let's look for today 
);

$listTransfersResponse = $client->send($listTransfers);
var_dump($listTransfersResponse->transfers); // collection of Response\Item\Transfer
```

`ListTransfers` response and request class are described in Comgate [documentation](https://help.comgate.cz/docs/protocol-api-en#list-of-transfers-within-the-day)


For each transfer there is another API call to get its detail (exact payments) which are included in such transfer

```php
foreach ($listTransfersResponse->transfers as $transfer) { // transfer is object Response\Item\Transfer
    $getTransferRequest = $transfer->createRequest(); // Request\GetTransfer

    $getTransferResponse = $client->send($getTransferRequest);
    var_dump($getTransferResponse->transferItems); // collection of Response\Item\TransferItem
}
```

`GetTransfer` response and request class are described in Comgate [documentation](https://help.comgate.cz/docs/protocol-api-en#detail-of-bank-transfer)