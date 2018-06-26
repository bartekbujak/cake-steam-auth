# cakephp-steam-auth
Steam Authorization for CakePhp

Instruction:

Add following lines to initialize() mehtod in AppController.
```php
$this->Auth->config('authenticate', [
    'Steam', // app authentication object.
]);
```
Also add following lines to config/app.php
```php
'Steam' => [
    'redirectUrl' => '' //example: http://localhost:8765
]
```
