<?php

namespace App\Helpers;

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
        $parsedData = self::parseOddsData($filteredData,$title);
        return $parsedData;
    }
}
