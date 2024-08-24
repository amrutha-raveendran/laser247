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

            // Apply custom sorting logic to $pairs array
            $pairs = self::customSortPairs($pairs);
        }

        return $pairs;
    }

    // Custom sorting function for $pairs array
    private static function customSortPairs($pairs)
    {
        // Split $pairs into three parts as required
        $firstPart = array_slice($pairs, 0, 3);
        $secondPart = array_slice($pairs, 3, 3);
        $thirdPart = array_slice($pairs, 6, 3);
        $remainingPart = array_slice($pairs, 9);

        // Sort the first part in increasing order based on the first element
        usort($firstPart, function($a, $b) {
            return $a[0] <=> $b[0];
        });

        // Sort the second part in decreasing order based on the first element
        usort($secondPart, function($a, $b) {
            return $b[0] <=> $a[0];
        });

        // Sort the third part first in increasing order
        usort($thirdPart, function($a, $b) {
            return $a[0] <=> $b[0];
        });

        // Merge the sorted parts back together
        return array_merge($firstPart, $secondPart, $thirdPart, $remainingPart);
    }
}
