<?php 

namespace App\Helpers;

class RunnerHelper
{
    /**
     * Process and organize runner data into pairs.
     *
     * @param  array $rows
     * @return array
     */
    public static function processRunnerData($rows)
    {
        $pairs = [];
    
        // Check if $rows is not empty and is an array
        if (is_array($rows) && !empty($rows)) {
            // Get the first element from $rows
            $firstRow = reset($rows);
    
            // Check if $firstRow is empty
            if (empty($firstRow)) {
            return [];
            }
    
            // Ensure that $firstRow is a string
            if (is_string($firstRow)) {
                $rowData = explode('|', $firstRow);
    
                // Remove empty values and trim whitespace
                $rowData = array_filter(array_map('trim', $rowData));
    
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
                for ($i = 0; $i < count($rowData); $i += 2) {
                    if (isset($rowData[$i + 1])) {
                        $pairs[] = [$rowData[$i], $rowData[$i + 1]];
                    } else {
                        $pairs[] = [$rowData[$i]];
                    }
                }
    
                // Sort the pairs using a custom sorting function
                $pairs = self::customSortPairs($pairs);
            } else {
                // Handle the case where $firstRow is not a string
                throw new \UnexpectedValueException('Expected string, but received ' . gettype($firstRow));
            }
        } else {
            return [];
        }
    
        return $pairs;
    }
    
    /**
     * Custom sorting of pairs into specific groups.
     *
     * @param  array $pairs
     * @return array
     */
    private static function customSortPairs($pairs)
    {
        $firstPart = array_slice($pairs, 0, 3);
        $secondPart = array_slice($pairs, 3, 3);
        $thirdPart = array_slice($pairs, 6, 3);
        $remainingPart = array_slice($pairs, 9);

        usort($firstPart, function($a, $b) {
            return $a[0] <=> $b[0];
        });

        usort($secondPart, function($a, $b) {
            return $b[0] <=> $a[0];
        });

        usort($thirdPart, function($a, $b) {
            return $a[0] <=> $b[0];
        });

        return array_merge($firstPart, $secondPart, $thirdPart, $remainingPart);
    }

    /**
     * Filter and parse odds data based on a filter string.
     *
     * @param  array  $data
     * @param  string $filterString
     * @return array
     */
    public static function filterAndParseOddsData(array $data, string $filterString): array
    {
        $filteredData = [];
    
        // Filter rows by the given filter string
        foreach ($data as $row) {
            // Remove surrounding quotes and trim the row
            $row = trim($row, '"');
    
            // Split the row into an array based on the pipe delimiter
            $fields = explode('|', $row);
    
            // Check if the filter string is present in any element of the array
            if (in_array($filterString, $fields)) {
                $filteredData[] = $fields;
            }
        }
    
        $parsedData = [];
    
        // Parse the filtered data into the desired format
        foreach ($filteredData as $fields) {
            // Add the first team (indices 19-27)
            $parsedData[19] = [
                'team' => $fields[19],  // Team name at index 19
                
                24 => $fields[24],
                25 => $fields[25],
                26 => $fields[26],
                27 => $fields[27],
            ];
    
            // Add the second team (indices 32-40)
            $parsedData[32] = [
                'team' => $fields[32],  // Team name at index 32
                37 => $fields[37],
                38 => $fields[38],
                39 => $fields[39],
                40 => $fields[40],
            ];
        }

        return $parsedData;
    }
}
