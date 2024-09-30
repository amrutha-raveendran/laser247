<?php

namespace App\Helpers;
use Mockery\Matcher\ArgumentListMatcher;

class RunnerHelper
{

    /**
     * Process and organize runner data into pairs.
     *
     * @param array $rows
     * @return array
     */
    public static function processRunnerData(array $rows): array
    {

        if(!empty($rows)){
             // First, filter the data based on the filter string 'OPEN'
        $filteredData = self::filterOddsData($rows, 'OPEN');

        // If filtered data is empty, return an empty array
        if (empty($filteredData) || !isset($filteredData[0])) {
            return [];
        }

        // Only process the first row of filtered data
        $rowData = $filteredData[0];

        // Slice the array to include only relevant elements starting from index 10
        $rowData = array_slice($rowData, 10);

        // Define indices to remove from the array
        $indicesToRemove = [12, 13, 26, 27];

        // Remove elements at specified indices
        foreach ($indicesToRemove as $index) {
            if (isset($rowData[$index])) {
                unset($rowData[$index]);
            }
        }

        // Re-index the array after removing elements
        $rowData = array_values($rowData);

        // Create pairs from the remaining elements
        $pairs = [];
        for ($i = 0; $i < count($rowData); $i += 2) {
            if (isset($rowData[$i + 1])) {
                $pairs[] = [$rowData[$i], $rowData[$i + 1]];
            } else {
                $pairs[] = [$rowData[$i]];
            }
        }

        // Sort the pairs using a custom sorting function if defined
        $pairs = self::customSortPairs($pairs);

        return $pairs;
        }

    }

    /**
     * Custom sorting of pairs into specific groups.
     *
     * @param  array $pairs
     * @return array
     */
    private static function customSortPairs(array $pairs): array
    {
        // Split pairs into segments
        $firstPart = array_slice($pairs, 0, 3);
        $secondPart = array_slice($pairs, 3, 3);
        $thirdPart = array_slice($pairs, 6, 3);
        $remainingPart = array_slice($pairs, 9);

        // Sort the first part in ascending order
        usort($firstPart, function($a, $b) {
            return $a[0] <=> $b[0];
        });

        // Sort the second part in descending order
        usort($secondPart, function($a, $b) {
            return $b[0] <=> $a[0];
        });

        // Sort the third part in ascending order
        usort($thirdPart, function($a, $b) {
            return $a[0] <=> $b[0];
        });

        // Combine all parts into one array
        return array_merge($firstPart, $secondPart, $thirdPart, $remainingPart);
    }

    /**
     * Filters the given data array by the filter string.
     *
     * @param array $data The input data array to filter.
     * @param string $filterString The string used to filter the data rows.
     * @return array The filtered data array.
     */
    public static function filterOddsData(array $data, string $filterString): array
    {
        // Check if $data is not empty
        if (is_array($data) && !empty($data)) {
            $filteredData = [];

            // Filter rows by the given filter string
            foreach ($data as $row) {
                // Check if $row is a string
                if (is_string($row)) {
                    // Remove surrounding quotes and trim the row
                    $row = trim($row, '"');

                    // Split the row into an array based on the pipe delimiter
                    $fields = explode('|', $row);

                    // Check if the filter string is present in any element of the array
                    if (in_array($filterString, $fields, true)) {
                        $filteredData[] = $fields;
                    }
                }
            }
            return $filteredData;
        }

        return [];
    }

    /**
     * Parses the filtered data to extract team and odds information.
     *
     * @param array $filteredData The filtered data array from the filterOddsData function.
     * @param string $filterString The string used to filter the data rows.
     * @return array The parsed data array with teams and their corresponding odds.
     */
    public static function parseOddsData(array $filteredData,string $filterString=null): array
    {
    // Initialize the parsed data array
    $parsedData = [];

    // Filter the data based on the normalized filter string using `use` keyword to pass $filterString
    $filteredData = array_filter($filteredData, function ($item) use ($filterString) {
        return isset($item[14]) && $item[14] === $filterString;
    });

        // Iterate through each item in filtered data
        foreach ($filteredData as $item) {
            // Loop through the array, checking specific indices
            $currentIndex = 0;

            while ($currentIndex < count($item)) {
                // Check if index 19 exists and contains a string (assumed as team name)
                if (isset($item[$currentIndex + 19]) && is_string($item[$currentIndex + 19])) {
                    $teamName = $item[$currentIndex + 19];

                    // Add the team name and next four values to parsedData
                    $parsedData[$teamName] = [
                        'team' => $teamName,
                        'odds1' => $item[$currentIndex + 24] ?? null, // First odds value
                        'value1' => $item[$currentIndex + 25] ?? null, // Corresponding value
                        'odds2' => $item[$currentIndex + 26] ?? null, // Second odds value
                        'value2' => $item[$currentIndex + 27] ?? null, // Corresponding value
                    ];
                }

                // Move to the next set of indices (assuming a pattern of increment)
                // To find the next team string, increment to the next starting index
                $nextTeamIndex = $currentIndex + 13;
                $currentIndex = $nextTeamIndex;
            }
        }

        return $parsedData;
    }





    /**
     * Main function to filter and parse odds data.
     *
     * @param array $data The input data array to process.
     * @param string $filterString The string used to filter the data rows.
     * @return array The final parsed data array.
     */
    public static function filterAndParseOddsData(array $data, string $filterString,string $title=null): array
    {
        // First, filter the data based on the filter string
        $filteredData = self::filterOddsData($data, $filterString);
        if($title=='FANCY')
        $parsedData = self::parseOddsfancyData($filteredData,$title);
        else if($title == "OPEN")
        $parsedData = self::parseOddsMarketsData($filteredData,$title);
        else
        $parsedData = self::parseOddsData($filteredData,$title);

        return $parsedData;
    }


    /**
     * Parses the filtered data to extract team and odds information.
     *
     * @param array $filteredData The filtered data array from the filterOddsData function.
     * @param string $filterString The string used to filter the data rows.
     * @return array The parsed data array with teams and their corresponding odds.
     */
    public static function parseOddsfancyData(array $filteredData, string $filterString = null): array
    {
        $parsedData = [];

        // Loop through each fancy data row
        foreach ($filteredData as $data) {
            $parsedData[] = [
                'title'=>$data[7],
                'index_17' => $data[17] ?? '0.00', // Value at index 17
                'index_18' => $data[18] ?? '0.00', // Value at index 18
                'index_19' => $data[19] ?? '0.00', // Value at index 19
                'index_20' => $data[20] ?? '0.00', // Value at index 20
            ];
        }

        return $parsedData;
    }

    /**
     * Parses the filtered data to extract team and odds information.
     *
     * @param array $filteredData The filtered data array from the filterOddsData function.
     * @param string $filterString The string used to filter the data rows.
     * @return array The parsed data array with teams and their corresponding odds.
     */
    public static function parseOddsMarketsData(array $filteredData, string $filterString = null): array
    {
        $parsedData = [];

       // Initialize the result array
$result = [];

foreach ($filteredData as $subArray) {
    // Step 1: Store the first index as market_id
    $market_id = $subArray[0];

    // Step 2: Initialize the structure for this sub-array
    $entry = [
        'market_id' => $market_id,
        'active_segments' => []
    ];

    // Step 3: Loop through the sub-array and find "ACTIVE" segments
    for ($i = 0; $i < count($subArray); $i++) {
        if ($subArray[$i] === 'ACTIVE' && isset($subArray[$i + 12])) {
            // Extract the 6 values after "ACTIVE"
            $valuesAfterActive = array_slice($subArray, $i + 1, 12);

            // Add these values to the active_segments
            $entry['active_segments'][] = [
                'active' => 'ACTIVE',
                'values' => $valuesAfterActive
            ];
        }
    }

    // Add the entry to the result array
    $result[] = $entry;
}

return $result;
    }
    public static function getmarketdatabyId($marketId,$marketdata)
    {
        $data_score =[];
        foreach ($marketdata as $entry) {
            if (strpos($entry, $marketId) === 0) {
                if (strpos($entry, 'OPEN') !== false) {
                    $parts = explode('|', $entry);
                    foreach ($parts as $index => $part) {
                        if ($part === 'ACTIVE') {
                            // Check if the 1st and 7th values exist
                            $firstValueAfterActive = isset($parts[$index + 1]) ? $parts[$index + 1] : '-';
                            $seventhValueAfterActive = isset($parts[$index + 7]) ? $parts[$index + 7] : '-';
                            $data_score[] = [
                                'firstvalue' => $firstValueAfterActive,
                                'lastvalue'=> $seventhValueAfterActive
                            ];
                            
                        }
                    }
                }
            }
        }
       return $data_score;
    }

    public static function check_matchoddvalue_in_markets($matchodds,$marketid)
    {
      foreach ($matchodds as $item) {
            if ($item == $marketid) {
                return true; // ID exists
            }
        }
        return false;
    }

    // Event Detail Match Odd Value
    public static function check_matchoddvalue_in_detail($marketid,$marketdata,$selection_id)
    {
        // dd($selection_id);
        // dd($marketdata);
       if (isset($marketdata[$marketid])) {
            $market_details = $marketdata[$marketid];
            if(!empty($market_details)){
            // Split the data using '|' as the delimiter
            $market_data = explode('|', $market_details);
            foreach ($marketdata as $market_id => $market_details) {
                if (strpos($market_details, 'OPEN')){
                    if (strpos($market_details, $selection_id) !== false) {
                        preg_match_all('/'.$selection_id.'(?:\|([^|]+)){12}/', $market_details, $match);
                           // Split the data using '|' as the delimiter
                        $exploded_data = explode('|', $market_details);
                        $index = array_search($selection_id, $exploded_data);
                        if ($index !== false && isset($exploded_data[$index + 1])) {
                            // Check the status is ACTIVE
                            if ($exploded_data[$index + 1] === 'ACTIVE') {
                                $active_index = $index + 1;
                                $next_12_values = array_slice($exploded_data, $active_index + 1, 12);
                                return $next_12_values;
                            }
                        }
                    }
                }
            }
        }
       }
      return false;
    }

    public static function check_bookmaker_in_detail($event_id,$marketid,$market_data,$selection_id,$bookmaker_id) {

        if(isset($market_data[$marketid])) {
            $marketlist = $market_data[$marketid];
            
            if (strpos($marketlist, $event_id)){
                if (strpos($marketlist, 'BOOK_MAKER')){
                    $market_datas = explode('|', $marketlist);
                    if(strpos($marketlist,$selection_id)){
                        // Find the index of the selection_id
                    $index = array_search($selection_id, $market_datas);
                    }
                    // print_r($market_datas);
                
                    $next_values = array_slice($market_datas, $index + 2, '9');
                    return $next_values;
                }
            }
        }

    }
    public static function check_fancy_in_detail($event_id,$marketid,$market_data,$selection_id,$id) {
        if(isset($market_data[$marketid])) {
            $marketlist = $market_data[$marketid];
            if (strpos($marketlist, $event_id)){
                if (strpos($marketlist, 'FANCY')){
                    if(strpos($marketlist,$id))
                    {
                        // 
                        $market_datas = explode('|', $marketlist);
                        $index = array_search($id, $market_datas);
                        $next_values = array_slice($market_datas, $index + 7, '13');
                        return $next_values;
                    }
                    
                }
            }
        }
        return false;
    }
   
}
