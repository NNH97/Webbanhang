<?php 

    /**
    * debug
    **/
    function _debug($data) {

        echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto">';
        echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';

        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);

        echo '<div>File: ' . $debug['file'] . '</div>';
        echo '<div>Line: ' . $debug['line'] . '</div>';

        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            var_dump($data);
        }
        echo '</pre>';
    }
    
    
    function  getInput($string)
    {
        return isset($_GET[$string]) ? $_GET[$string] : '';
    }

    
    /**
     * post Input
     */
    
    function  postInput($string)
    {
        return isset($_POST[$string]) ? $_POST[$string] : '';
    }



    function base_url()
    {
        // return $url  = "http://codedoan.com/"; 
        return $url  = "http://localhost:8080/websitebanlaptop/"; 
    }


    function public_admin()
    {
        return base_url() . "public/admin/";
    }

    function public_frontend()
    {
        return base_url() . "public/frontend/";
    }

    function modules($url)
    {
        return base_url() . "admin/modules/" .$url ;
    }

    function uploads()
    {
        return base_url() . "public/upload/";
    }
    
     if ( ! function_exists('redirectStyle'))
    {
        function redirectStyle($url = "")
        {
            header("location: ".base_url()."{$url}");exit();
        }
    }



    /**
     *  redirect về các trang 
     */
    if ( ! function_exists('redirectAdmin'))
    {
        function redirectAdmin($url = "")
        {
            header("location: ".base_url()."admin/modules/{$url}");exit();
        }
    }



    /**
     *  redirect về các trang 
     */
    if ( ! function_exists('redirect'))
    {
        function redirect($url = "")
        {
            header("location: ".base_url().$url);exit();
        }
    }

    function formatpricesale($number,$sale)
    {
        $number=intval($number);
        $sale=intval($sale);

        $price =$number*(100-$sale)/100;
        return number_format($price);
    }


 ?>
