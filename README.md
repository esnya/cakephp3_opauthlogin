# Autentication with Opauth plugin for CakePHP 3.0

## Requirements

* CakePHP 3.0.0 or greater.
* Opauth 0.4.3 or greater.
* Opauth Strategies.

## Installation

* Install cakephp3_opauthlogin, Opauth and Opauth Strategies with composer.

Example:
```json
"require": {
    "php": ">=5.4.16",
    "mobiledetect/mobiledetectlib": "2.*",
    "cakephp/cakephp": "3.0.*-dev",

    "ukatama/cakephp3_opauthlogin": "*",
    "opauth/opauth": "*",
    "opauth/twitter": "*"
}
```

* Load the plugin
```php
Plugin::load('OpauthLogin', ['bootstrap' => false, 'routes' => true]);
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
            'secret' => '(Consumer Secret)'
        ]
    ]
];
```

* Create user table

"provider" and "uid" is required, must be a primary key.
```sql
CREATE TABLE `users` (
  `provider` varchar(45) NOT NULL,
  `uid` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`provider`,`uid`)
);
```

* Set up authentication compoonent and OpauthLogin helper.
```php
class AppController  extends Controller {
    public $helpers = ['OpauthLogin.OpauthLogin'];

    public $components = [
        'Auth' => [
            'loginAction' => [
                'controller' => 'pages',
                'action' => 'login'
            ],
            'authenticate' => [
                'OpauthLogin.OpauthLogin',
            ]
        ]
    ];
```

* Create login page.
```php
<!-- Make login link as "Login with Twitter". -->
<?php echo $this->OpauthLogin->login(__('Login with Twitter'), 'twitter', ['class' => 'btn btn-default']); ?>
```

* You can use as same as default auth component.

## ToDo

* Create Account
