<?php

use App\Http\Controllers\BotManController;
use App\Http\Controllers\AllBreedsControlller;
use App\Http\Controllers\SubBreedController;




$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

// $botman->hears('/random', BotManController::class.'@random');
$botman->hears('/doggos', BotManController::class.'@startConversation');
$botman->hears('/random', 'App\Http\Controllers\AllBreedsController@random');
$botman->hears('/b {breed}', 'App\Http\Controllers\AllBreedsController@byBreed');
$botman->hears('/s {breed}:{subBreed}', 'App\Http\Controllers\AllBreedsController@random');
