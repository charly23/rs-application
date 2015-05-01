<?php

function reqister_wp_mvc() {
    
    include_once ('config/load.php');
        
    $php     = array( ".php", "/" );
    $php_val = array_shift(array_values($php));
    $slashes = end($php);
    
    // config system    
    
    $system = $system_load;
    define('WP_MVC_SYSTEMS', 'system');
    foreach ( $system as $system_key => $system_var ) {
       if( is_string( $system[$system_key] )){  
           require_once ( WP_MVC_SYSTEMS . $slashes . $system[$system_key] . $php_val );
       }
    }
    
    // config loader
    
    $config = $config_load;
    define('WP_MVC_CONFIG', 'config');
    foreach ( $config as $config_key => $config_var ) {
       if( is_string(  $config[$config_key] )){ 
           require_once ( WP_MVC_CONFIG . $slashes . $config[$config_key] . $php_val );
       }
    }
    
    // config model
   
    $model = $model_load;
    define('WP_MVC_MODEL', 'model');
    foreach ( $model as $model_key => $model_var ) {
       if( is_string(  $model[$model_key] )){ 
           require_once ( WP_MVC_MODEL . $slashes . $model[$model_key] . $php_val );
       }
    }
    
    // config control

    $control = $control_load;
    define('WP_MVC_CONTROLLER', 'controller');
    foreach ( $control as $control_key => $control_var ) {
       if( is_string(  $control[$control_key] )){ 
           require_once ( WP_MVC_CONTROLLER . $slashes . $control[$control_key] . $php_val );
       }
    }
        
}

?>