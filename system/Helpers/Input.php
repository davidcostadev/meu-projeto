<?php
/**
 * Input Helper
 *
 * @author David Costa - davicosta@csthost.com.br
 * @version 1.0
 */

namespace Helpers;

/**
 * 
 */
class Input {

    public static $instance;

    public static function get($var, $default = null, $filter = FILTER_SANITIZE_STRING) {
        if(!self::$instance) {
            self::$instance = new Input();    
        }

        return self::$instance->__getMethod($var, $default, $filter);
    }

    public static function post($var, $default = null, $filter = FILTER_SANITIZE_STRING) {
        if(!self::$instance) {
            self::$instance = new Input();    
        }

        return self::$instance->__postMethod($var, $default, $filter);
    }

    public function __getMethod($var, $default = null, $filter = FILTER_SANITIZE_STRING) {

        if(isset($_GET[$var])) {
            return filter_input(INPUT_GET, $var, $filter);
        } elseif(isset($_POST[$var])) {
            return filter_input(INPUT_POST, $var, $filter);
        } else {
            return filter_var($default, $filter);
        }

    }

    public function __postMethod($var, $default, $filter = FILTER_SANITIZE_STRING) {
        
        if(isset($_POST[$var])) {
            return filter_input(INPUT_POST, $var, $filter);
        } else {
            return filter_var($default, $filter);
        }
    }

}