<?php

    return [
        '~^hello/(.*)$~' => [MyProject\Controllers\MainController::class, 'sayHello'],
        '~^$~' => [MyProject\Controllers\MainController::class, 'main'],
        '~^products/(\d+)/edit$~' => [MyProject\Controllers\ProductsController::class, 'edit'],
        '~^products/add$~' => [MyProject\Controllers\ProductsController::class, 'add'],
        '~^products/(\d+)/remove$~' => [MyProject\Controllers\ProductsController::class, 'remove'],
        '~^products/(\d+)$~' => [MyProject\Controllers\ProductsController::class, 'view'], //\d означает любой цифровой символ, а '+' означает 1 или более раз
    ];