<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    function dd($data)
    {
        echo '<pre>'; print_r($data); echo '</pre>'; die();
    }
    
    function d()
    {
        echo '<pre>'; print_r(); echo '<pre>';
    }
?>