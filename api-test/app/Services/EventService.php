<?php

// app/Services/EventService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class EventService
{
    public function fetchEventData(int $id): ?array
    {
        $response = Http::post("https://api.datalaser247.com/api/guest/event/{$id}");

        return $response->successful() ? $response->json() : null;
    }

    public function fetchMarketData(array $marketIds): ?array
    {
        $response = Http::asForm()->post('https://odds.l247.biz/ws/getMarketDataNew', [
            'market_ids' => $marketIds,
        ]);

        return $response->successful() ? $this->formatMarketData($response->json()) : null;
    }

    private function formatMarketData(array $marketData): array
    {
        return [
            'items' => array_map(fn($item) => explode('|', $item), $marketData),
        ];
    }

    public function extractMarketIds(array $eventDetails): array
    {
        $marketIds = [];
        $marketSources = ['match_odds', 'book_makers', 'fancy', 'markets'];

        foreach ($marketSources as $source) {
            if (!empty($eventDetails[$source]) && is_array($eventDetails[$source])) {
                foreach ($eventDetails[$source] as $item) {
                    if (!empty($item['market_id'])) {
                        $marketIds[] = $item['market_id'];
                    }
                }
            }
        }

        return $marketIds;
    }
}
