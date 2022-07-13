<?php
/**
 * Checks if file is a CSV file
 *
 * @return boolean
 */
if (! function_exists('checkIfCSV')) {
    function checkIfCSV($file)
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
    function checkIfWeekend($day)
    {
        return ($day->isSunday() || $day->isSaturday());
    }
}
