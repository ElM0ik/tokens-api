<?php

use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\CharacterController;
use Illuminate\Support\Facades\Route;

Route::apiResource('movies', MovieController::class);
Route::apiResource('characters', CharacterController::class);