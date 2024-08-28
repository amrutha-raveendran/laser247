<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    protected $httpClient;
    protected $cacheKey = 'menu_data';
    protected $cacheTTL = 60 * 60; // Cache duration in seconds (e.g., 1 hour)

    public function __construct(Client $client)
    {
        $this->httpClient = $client;
    }

    public function getMenuData()
    {
        // Attempt to retrieve menu data from cache
        return Cache::remember($this->cacheKey, $this->cacheTTL, function () {
            return $this->fetchMenuData();
        });
    }

    protected function fetchMenuData()
    {
        // Fetch the menu data from the API
        $response = $this->httpClient->request('GET', 'https://api.datalaser247.com/api/guest/menu');
        $menuData = json_decode($response->getBody()->getContents(), true);

        // Process and return the fetched data
        return collect($menuData['data']['menu'])->pluck('name', 'id');
    }
}
