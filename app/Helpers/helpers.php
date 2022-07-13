<?php
declare(strict_types = 1);

use Illuminate\Support\Carbon;

/**
 * Checks if file is a CSV file
 *
 * @return boolean
 */
if (! function_exists('checkIfCSV')) {
    function checkIfCSV(string $file): bool
    {
        $pathInfo = pathinfo($file);
        return (isset($pathInfo['extension']) && $pathInfo['extension'] == 'csv');
    }
}
/**
 * Checks if the day falls on weekend
 *
 * @return boolean
 */
if (! function_exists('checkIfWeekend')) {
    function checkIfWeekend(Carbon $day): bool
    {
        return ($day->isSunday() || $day->isSaturday());
    }
}
