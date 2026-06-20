<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService

{
    // const BASE_URL='https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/';
    const data = '';

    function getWeather(String $location)
    {


        $ttl = env('CACHE_TTL', 43200); // Default to 12 hours 
         $data=Cache::remember("weather_{$location}", $ttl, function () use ($location) {
            // Log::info("Fetching fresh weather data for {$location} from API...");
             $url = env('WEATHER_BASE_URL') . urlencode($location) . '?key=' . env('API_KEY');
            return Http::get($url)->throw()->json();
        });



        if (!$data) {
            return response()->json(['error' => 'Weather data not found'], 404);
        }

        $tempInFehrenheit = $data['currentConditions']['temp'] ?? null;
        $tempInCelsius = ($tempInFehrenheit - 32) * 5 / 9;
        return   [
            'city' => $location,
            'temperature' => $tempInCelsius ?? null,
            'description' => $data['currentConditions']['conditions'] ?? null
        ];
    }
}
