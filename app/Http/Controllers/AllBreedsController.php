<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DogService;
use App\Http\Controllers\Controller;

class AllBreedsController extends Controller
{
    public function __construct()
    {
        $this->photos = new DogService;
    }

    public function random($bot)
    {
        $bot->reply($this->photos->random());
    }

    public function byBreed($bot, $name)
    {
        $bot->reply($this->photos->byBreed($name));
    }
}
