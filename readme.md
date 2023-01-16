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

### Usage

Then, you can use the `publish` method to send a notification from within your controllers

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


       notifylog()->publish($event);

       $notifyLog->publish($event);

```

#### Support

If you need help, please send an email to hello@notifylog.com.

#### Create an account

To create an account on the NotifyLog platform, visit https://notifylog.com.
