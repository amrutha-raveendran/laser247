<?php

namespace App\Helpers;

class RunnerHelper
{
    public static function processRunnerData($rows)
    {
        $pairs = [];

        // Ensure $rows is an array and contains at least one element
        if (isset($rows) && !empty($rows)) {
            // Split the data from the first row
            $firstRow = reset($rows);
            $rowData = explode('|', $firstRow); // Split data from the first row

            // Remove the first 10 elements
            $rowData = array_slice($rowData, 10);

            // Indices to remove
            $indicesToRemove = [12, 13, 26, 27];

            // Remove specified indices
            foreach ($indicesToRemove as $index) {
                if (isset($rowData[$index])) {
                    unset($rowData[$index]);
                }
            }

            // Re-index the array
            $rowData = array_values($rowData);

            // Group remaining data into pairs
            for ($i = 0; $i < count($rowData); $i += 2) {
                if (isset($rowData[$i + 1])) {
                    $pairs[] = [$rowData[$i], $rowData[$i + 1]];
                } else {
                    // Handle the case where the array has an odd number of elements
                    $pairs[] = [$rowData[$i]];
                }
            }
        }

        return $pairs;
    }
}
