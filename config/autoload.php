<?php

if(!class_exists('wp_mvc_page')){
    
    class wp_mvc_page{
        
        public static $name        = "RS Aplication";
        
        public static $icon        = "rs/images/system_stop_music_movie_film-16.png";
        
        public static $plugin_slug = 'rs';
        
        public static $folder      = 'rs';
        
        function __construct(){
              
              add::action_page( array($this, 'admin_page') );
              
              /**
                * Backend Style
              **/
                 
              add::style(true, self::$plugin_slug.'admin-style', self::$folder.'/css/admin.css' );
    
              
              /**
               * Front Style
              **/
              
              add::style(false, self::$plugin_slug.'front-style', self::$folder.'/css/front.css' );
                
              /**
                * Backend Script 
              **/
    
              add::wp_script('jQuery');
              add::wp_script('jquery-ui-sortable');
              add::wp_script('jquery-ui-draggable');
              add::wp_script('jquery-ui-droppable');
              
              add::wp_script('jquery-ui-core');
              add::wp_script('jquery-ui-dialog');
              add::wp_script('jquery-ui-slider');
              
              add::script(true, self::$plugin_slug.'admin-script', self::$folder.'/js/admin.js' );
              add::script(true, self::$plugin_slug.'sort-script', self::$folder.'/js/sort.js' );
              
              add::script(true, self::$plugin_slug.'ajax_handler', self::$folder.'/js/ajax.js' );
              add::localize_script( true, self::$plugin_slug.'ajax_handler', 'ajax_script', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
              
              /**
                * Frontend Script 
              **/
              
              add::script(false, self::$plugin_slug.'front-script', self::$folder.'/js/front.js' );
    
              // actions option
              
              add::action_loaded( array($this,'update_db_check') );
              
              // actions shortcode callback
              
              add::shortcode('shortcode_name', 'shortcode_name_function');
    
        } 
        
        public function admin_page(){
            
            $menu[] = array( self::$name, self::$name, 1, self::$plugin_slug, array( $this,  self::$plugin_slug.'_function'), self::$icon );
            $menu[] = array( 'Add New', 'Add New', 1, self::$plugin_slug, 'add_new_option_'.self::$plugin_slug, array( $this, 'add_new_option_'.self::$plugin_slug.'_function' ) );
            $menu[] = array( 'Help?', 'Help?', 1, self::$plugin_slug, 'help_'.self::$plugin_slug, array( $this, 'help_'.self::$plugin_slug.'_function' ) );
            
            if( is_array( $menu )){
                add::load_menu_page( $menu );
            }
        }
        
        public function update_db_check() {
            global $db_version;
            if (get_site_option( 'db_version' ) != $db_version) {
                self::install();
            }
        }
        
        public static function install(){
            global $wpdb;
            
            // dbDelta

        }
        
        // view 
        
        public function rs_function(){
            load::view('manage');
        }
        
        public function add_new_option_rs_function(){
            load::view('add');
        }
        
        public function help_rs_function(){
            load::view('help');
        }
        
        // shortcode
        
        public function shortcode_name_function(){
            load::view('shortcode/shortcode.php');
        }
    
    }

}  

$wp_mvc_page = new wp_mvc_page();
?>