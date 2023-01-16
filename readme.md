# NotifyLog Library for Laravel

A library for sending notifications using the NotifyLog API.

### Installation

To install the library, run the following command:

```bash
composer require notifylog/laravel
```

### Configuration

To use the library, configure your Account Token in `.env`

```bash
NOTIFYLOG_ACCOUNT_TOKEN=[account_token]
```

You can find your Account Token [here](https://app.notifylog.com/dashboard/settings/api)

### Test your Configuration

run

```bash
php artisan notifylog:test
```

### Usage

Then, you can use NotifyLog `publish` method to send a notification from within your controller

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use NotifyLog\Laravel\NotifyLog;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    function index(NotifyLog $notifyLog){


        $event = [
            "name" =>  "NotifyLog Laravel Plugin",
            "description" =>  "Hello world from Laravel",
            "channel" =>  "from-laravel",
            "icon" =>  "💸",
            "notify" =>  true,
            "tags" => [
                "my-tag" =>  "my-tag-value",
            ],
            "message" =>
                "[Link](https://google.com)",
        ];

       // Use:
       $notifyLog->publish($event);

       // or, you can also use the helper
       // without the need to inject
       // NotifyLog into the controller
       // by calling

       notifylog()->publish($event);

```

#### Support

If you need help, please send an email to hello@notifylog.com.

#### Create an account

To create an account on the NotifyLog platform, visit https://notifylog.com.
