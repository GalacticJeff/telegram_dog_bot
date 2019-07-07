<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DogService;

class SubBreedController extends Controller
{
    //
    public function __construct()
    {
        $this->photos = new DogService;
    }

    public function random($bot, $breed, $subBreed)
    {
        $bot->reply($this->photos->bySubBreed($breed, $subBreed));
    }
}
