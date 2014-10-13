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

"auth_provider" and "auth_uid" is required. (ToDo: Field names to be configuratable)
```sql
CREATE TABLE `users` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `auth_provider` varchar(45) NOT NULL,
  `auth_uid` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
);
```

* Set up authentication compoonent and OpauthLogin helper.

** Options

*** 'fields' (default: [ 'auth_provider' => 'auth_provider', 'auth_uid' => 'auth_uid' ])

Database table field's names.

*** 'registrationUrl' (default: null)

Registration page's url redirected when authoriged user is not found.
Set null to disable ridirecting.

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
                'OpauthLogin.OpauthLogin' => [
                    'fields' => [
                        'auth_provider' => 'auth_provider',
                        'auth_uid' => 'auth_uid',
                    ],
                    'registrationUrl' => ['plugin' => null, 'controller' => 'users', 'action' => 'add']
                ]
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
