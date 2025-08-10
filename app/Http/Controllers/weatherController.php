<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\weatherService;
use Illuminate\Support\Facades\Cache;

class weatherController extends Controller
{
    protected $weatherService;

    public function __construct(weatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }
   
    public function show(String $location){
        
        $weatherData=$this->weatherService->getWeather($location);

        return dd($weatherData);
        
    }
}
