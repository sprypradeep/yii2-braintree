Yii 2 Braintree Integration
===========================
braintree for yii 2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bryglen/yii2-braintree "*"
```

or add

```
"bryglen/yii2-braintree": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, you should configure it in the application configuration like the following,

```php
'components' => [
    'braintree' => [
        'class' => 'bryglen\braintree\Braintree',
        'environment' => 'sandbox',
        'merchantId' => 'your_merchant_id',
        'publicKey' => 'your_public_key',
        'privateKey' => 'your_private_key',
    ]
]
```

** Creating a customer

```php
$braintree = Yii::$app->braintree;
$response = $braintree->call('Customer', 'create', [
    'firstName' => 'bryan',
    ....
]);

$braintree = Yii::$app->braintree;
$response = $braintree->call('Transaction', 'sale', [
    'amount' => 25.00,
    'customerId' => 1,
    'paymentMethodToken' => 'some_token'
    ....
]);
```

braintree is using static methods for their API and to use the static methods for braintree.
it should be like this `Braintree_Transaction::sale($args)` into `$braintree->call('Transaction', 'sale', $args)`

