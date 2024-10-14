<?php

use Illuminate\Support\Facades\Route;


route::group(['middleware' => 'auth:sanctum'], function () {});