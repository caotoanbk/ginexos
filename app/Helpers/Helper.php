<?php
if (!function_exists('convertColumnNameToString')) {
    function convertColumnNameToString($columnName)
    {
        if(strpos($columnName, '_id') !== false)
        {
            return ucfirst(explode('_', $columnName)[0]);
        }
        $parts = preg_split('/(?=[A-Z])/', $columnName, -1, PREG_SPLIT_NO_EMPTY);
        return implode(' ', $parts);
    }
}
