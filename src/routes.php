<?php

    return [
        '~^hello/(.*)$~' => [MyProject\Controllers\MainController::class, 'sayHello'],
        '~^$~' => [MyProject\Controllers\MainController::class, 'main'],
        '~^products/(\d+)/edit$~' => [MyProject\Controllers\ProductsController::class, 'edit'],
        '~^products/add$~' => [MyProject\Controllers\ProductsController::class, 'add'],
        '~^products/(\d+)/remove$~' => [MyProject\Controllers\ProductsController::class, 'remove'],
        '~^users/register$~' => [MyProject\Controllers\UserController::class, 'signUp'],
        '~^users/login$~' => [MyProject\Controllers\UserController::class, 'login'],
        '~^users/exit$~' => [MyProject\Controllers\UserController::class, 'exit'],
        '~^products/(\d+)$~' => [MyProject\Controllers\ProductsController::class, 'view'], //\d означает любой цифровой символ, а '+' означает 1 или более раз
        // '~^products/(\d+)/property$~' => [MyProject\Controllers\ProductsController::class, 'property'],
        // '~^users/info$~' => [MyProject\Controllers\UserController::class, 'info'],
        // '~^users/order$~' => [MyProject\Controllers\UserController::class, 'info'],
        '~^users/cart$~' => [MyProject\Controllers\UserController::class, 'cart'],
        '~^users/checkout$~' => [MyProject\Controllers\UserController::class, 'checkout'],
        '~^users/checkout/success$~' => [MyProject\Controllers\UserController::class, 'orderSuccess'],

    ];