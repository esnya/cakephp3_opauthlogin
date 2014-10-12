# Opauth plugin for CakePHP 3.0

## Requirements

* CakePHP 3.0.0 or greater.
* Opauth 0.4.3 or greater.
* Opauth Strategies.

## Installation

* Install cakephp3_opauth, Opauth and Opauth Strategies with composer.

Example:
```json
"require": {
    "php": ">=5.4.16",
    "mobiledetect/mobiledetectlib": "2.*",
    "cakephp/cakephp": "3.0.*-dev",

    "ukatama/cakephp3_opauth": "*",
    "opauth/opauth": "*",
    "opauth/twitter": "*"
}
```

* Load the plugin
```php
Plugin::load('Opauth', ['bootstrap' => false, 'routes' => true]);
```


## Usage

* Install the plugin.

* Set up config/app.php.
```php
$config = [
    /** Other Configurations **/

    'OpauthStrategy' => [
        'Twitter' => [
            'key' => '(Consumer Key)',
            'secret' => '(Consumer Secret')
        ]
    ]
];
```

* Set up authentication compoonent and Opauth helper.
```php
class AppController  extends Controller {
    public $helpers = ['Opauth.Opauth'];

    public $components = [
        'Auth' => [
            'loginAction' => [
                'controller' => 'pages',
                'action' => 'login'
            ],
            'authenticate' => [
                'Opauth.Opauth',
            ]
        ]
    ];
```

* Create login page.
```php
<?php echo $this->Opauth->login(__('Login with Twitter'), 'twitter', ['class' => 'btn btn-default']); ?>
```
