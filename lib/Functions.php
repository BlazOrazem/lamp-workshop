<?php

/**
 * Required validation
 */
if (!function_exists('check_required')) {
    function check_required(array $fields)
    {
        $valid = true;
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                $valid = false;
            }
        }

        return $valid;
    }
}

/**
 * Debugging
 */
if (!function_exists('debug')) {
    function debug()
    {
        $vars = func_get_args();
        echo '<pre>';
        foreach ($vars as $var) {
            echo '<strong>(' . gettype($var) . ')</strong> ';
            print_r($var);
        }
        echo '</pre>';

        return;
    }
}
if (!function_exists('diebug')) {
    function diebug()
    {
        call_user_func_array('debug', func_get_args());
        die();
    }
}
