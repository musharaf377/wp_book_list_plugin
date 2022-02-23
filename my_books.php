<?php 
/**
 * Plugin Name: My Books
 * Plugin URI: http://www.musharaf.com/
 * Description: This is a plugin for my books
 * Version: 1.0
 * Author: Musharaf Hossain
 * Author URI: http://www.musharaf.com/
 * License: GPL2
 * text-domain: my_books
 * Domain Path: /languages/
 * tags: my_books, books, book, plugin, wordpress,
 * 
 */

//  constants define here
 if(!defined('ABSPATH')){
     exit;
 }

 if(!defined('PLUGIN_DIR_PATH')){
     define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
 }
 if(!defined('PLUGIN_DIR_URL')){
     define('PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
 }
 
//  text domain load here
 function my_books_load_textdomain(){
    load_plugin_textdomain('my_books', false, dirname(__FILE__) . '/languages'); 
 }
 add_action('plugins_loaded', 'my_books_load_textdomain');

 // plugin css and js file load here
 function my_books_admin_enqueue_scripts()
 {
      wp_enqueue_style('bootstrap-min', PLUGIN_DIR_URL . 'assets/css/bootstrap.min.css', array(), '1.0.0', 'all');
      wp_enqueue_style('data-table-min', PLUGIN_DIR_URL . 'assets/css/data_table.min.css', array(), '1.0.0', 'all');
      wp_enqueue_style('jquery_notify', PLUGIN_DIR_URL . 'assets/css/jquery_notify.css', array(), '1.0.0', 'all');
      wp_enqueue_style('main_style', PLUGIN_DIR_URL . 'assets/css/style.css', array(), '1.0.0', 'all');

      wp_enqueue_script('jquery');
      wp_enqueue_script('bootstrap-min-js', PLUGIN_DIR_URL . 'assets/js/bootstrap.min.js',array('jquery'),'1.0',true);
      wp_enqueue_script('data_table_js', PLUGIN_DIR_URL . 'assets/js/data_table.min.js',array('jquery'),'1.0',true);
      wp_enqueue_script('jquery_form_validation', PLUGIN_DIR_URL . 'assets/js/jquery_form_validation.js',array('jquery'),'1.0',true);
      wp_enqueue_script('jquery_notify-js', PLUGIN_DIR_URL . 'assets/js/jquery_notify.js',array('jquery'),'1.0',true);
      wp_enqueue_script('main_scripts', PLUGIN_DIR_URL . 'assets/js/scripts.js',array('jquery'),'1.0',true);

      wp_localize_script('main_scripts','ajaxurl',admin_url('admin-ajax.php'));
 }
 add_action('admin_enqueue_scripts', 'my_books_admin_enqueue_scripts');

 // plugin admin menu create here
 function my_books_admin_menu()
 {
      add_menu_page('My Books', 'My Books', 'manage_options', 'my_books', 'my_books_admin_page', 'dashicons-book-alt', 6);

      add_submenu_page('my_books', 'Books List', 'Books List', 'manage_options', 'my_books', 'my_books_admin_page');

      add_submenu_page('my_books', 'Add New Book', 'Add New Book', 'manage_options','add_new_book', 'my_books_add_new_book_page');

      add_submenu_page('my_books', '', '', 'manage_options','edit-book', 'my_books_edit_book_page');

 }
 add_action('admin_menu', 'my_books_admin_menu');

  // plugin admin page create here
  function my_books_admin_page()
  {
      require_once PLUGIN_DIR_PATH . 'views/book_list.php';
  }

  // plugin add new book page create here
  function my_books_add_new_book_page()
  {
      require_once PLUGIN_DIR_PATH . 'views/add_new_book.php';
  }

  // plugin edit book page create here
  function my_books_edit_book_page()
  {
      require_once PLUGIN_DIR_PATH . 'views/edit_book.php';
  }

 // plugin activation hook here
  function my_books_activate()
  {
    global $wpdb;
    $table_name = $wpdb->prefix.'books_list'; 

    $sql = "CREATE TABLE $table_name(
        id int(100) NOT NULL AUTO_INCREMENT,
        name varchar(100) DEFAULT NULL,
        author varchar(100) DEFAULT NULL,
        about text DEFAULT NULL,
        book_image varchar(100) DEFAULT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

  }
  register_activation_hook(__FILE__, 'my_books_activate');

  // plugin deactivation hook here
  function my_books_deactivate()
  {
    global $wpdb;
    $table_name = $wpdb->prefix.'books_list'; 
    $wpdb->query("DROP TABLE IF EXISTS $table_name");

  }
  register_deactivation_hook(__FILE__, 'my_books_deactivate');
  
  // plugin uninstall hook here
  function my_books_uninstall()
  {
    global $wpdb;
    $table_name = $wpdb->prefix.'books_list'; 
    $wpdb->query("DROP TABLE IF EXISTS $table_name");

  }
  register_uninstall_hook(__FILE__, 'my_books_uninstall');

  // ajax function for add new book here
  function my_books_ajax_handler()
  {
    if($_REQUEST['param']=='save_book'){
      
      $name = $_REQUEST['name'] ? $_REQUEST['name'] : '';
      $author = $_REQUEST['author'] ? $_REQUEST['author'] : '';
      $about = $_REQUEST['about_book'] ? $_REQUEST['about_book'] : '';
      $book_image = $_REQUEST['image_name'] ? $_REQUEST['image_name'] : '';


      global $wpdb;
      $table_name = $wpdb->prefix.'books_list';

      $wpdb->insert(
        $table_name,
        array(
          'name' => $name,
          'author' => $author,
          'about' => $about,
          'book_image' => $book_image,
        ),
      );

      echo json_encode(array("status"=>1,"message"=>"Book created successfully"));
    }elseif($_REQUEST['param'] == 'edit_book') {      


      global $wpdb;
      $table_name = $wpdb->prefix.'books_list';
      $wpdb->update(
        $table_name,
        array(
          'name'       => $_REQUEST['name'],
          'author'     => $_REQUEST['author'],
          'about'      => $_REQUEST['about_book'],
          'book_image' => $_REQUEST['image_name'],
        ),
        array(
          'id' => $_REQUEST['book_id'],
        )
      );
     
      echo json_encode(array("status" => 1, "message" => "Book Update Successfully."));
         
    }elseif($_REQUEST['param'] == 'delete_book') {

      // print_r($_REQUEST);
      global $wpdb;
      $table_name = $wpdb->prefix.'books_list';
      $wpdb->delete(
        $table_name,
        array(
          'id' => $_REQUEST['id'],
        )
      );

      echo json_encode(array("status" => 1, "message" => "Book Deleted Successfully."));
    }

    wp_die();
    
  }
  add_action('wp_ajax_book_list', 'my_books_ajax_handler');


  //this is update