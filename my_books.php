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

//  hello bangladesh
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
      $includes_page = array('add_new_book','add_author','manage_author','add_student','manage_student','course_traker');

       if(isset($_GET['page']) && in_array($_GET['page'], $includes_page)){
        
        wp_enqueue_style('data-table-min', PLUGIN_DIR_URL . 'assets/css/data_table.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('jquery_notify', PLUGIN_DIR_URL . 'assets/css/jquery_notify.css', array(), '1.0.0', 'all');

        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-min-js', PLUGIN_DIR_URL . 'assets/js/bootstrap.min.js',array('jquery'),'1.0',true);
        wp_enqueue_script('data_table_js', PLUGIN_DIR_URL . 'assets/js/data_table.min.js',array('jquery'),'1.0',true);
        wp_enqueue_script('jquery_form_validation', PLUGIN_DIR_URL . 'assets/js/jquery_form_validation.js',array('jquery'),'1.0',true);
        wp_enqueue_script('jquery_notify-js', PLUGIN_DIR_URL . 'assets/js/jquery_notify.js',array('jquery'),'1.0',true);
        wp_enqueue_script('main_scripts', PLUGIN_DIR_URL . 'assets/js/scripts.js',array('jquery'),'1.0',true);

        wp_localize_script('main_scripts','ajaxurl',admin_url('admin-ajax.php'));
      }

 }
 add_action('admin_enqueue_scripts', 'my_books_admin_enqueue_scripts');

 function my_books_wp_enqueue_scripts()
 {
  wp_enqueue_style('bootstrap-min', PLUGIN_DIR_URL . 'assets/css/bootstrap.min.css', array(), '1.0.0', 'all');

  wp_enqueue_style('my_books_style', PLUGIN_DIR_URL . 'assets/css/style.css', array(), '1.0.0', 'all');
   
 }
 add_action('init', 'my_books_wp_enqueue_scripts');
 // plugin admin menu create here
 function my_books_admin_menu()
 {
      add_menu_page('My Books', 'My Books', 'manage_options', 'my_books', 'my_books_admin_page', 'dashicons-book-alt', 6);
      add_submenu_page('my_books', 'Books List', 'Books List', 'manage_options', 'my_books', 'my_books_admin_page');
      add_submenu_page('my_books', 'Add New Book', 'Add New Book', 'manage_options','add_new_book', 'my_books_add_new_book_page');
      add_submenu_page('my_books', '', '', 'manage_options','edit-book', 'my_books_edit_book_page');
      add_submenu_page('my_books', 'Add New Author', 'Add New Author', 'manage_options','add_author', 'add_new_author_func');
      add_submenu_page('my_books', 'Manage Author', 'Manage Author', 'manage_options','manage_author', 'manage_author_func');
      add_submenu_page('my_books', 'Add New Students', 'Add New Students', 'manage_options','add_student', 'add_new_student_func');
      add_submenu_page('my_books', 'Manage Students', 'Manage Students', 'manage_options','manage_student', 'manage_students_func');
      add_submenu_page('my_books', 'Course Tracker', 'Course Tracker', 'manage_options','course_traker', 'course_tracker_func');

 }
 add_action('admin_menu', 'my_books_admin_menu');

  // book list page create here
  function my_books_admin_page()
  {
      require_once PLUGIN_DIR_PATH . 'views/book_list.php';
  }

  // add new book page create here
  function my_books_add_new_book_page()
  {
      require_once PLUGIN_DIR_PATH . 'views/add_new_book.php';
  }

  // edit book page create here
  function my_books_edit_book_page()
  {
      require_once PLUGIN_DIR_PATH . 'views/edit_book.php';
  }
  // add new author page create here
  function add_new_author_func()
  {
      require_once PLUGIN_DIR_PATH . 'views/add_new_author.php';
  }
  // author manage page create here
  function manage_author_func()
  {
      require_once PLUGIN_DIR_PATH . 'views/manage_author.php';
  }
  // add new student page create here
  function add_new_student_func()
  {
      require_once PLUGIN_DIR_PATH . 'views/add_new_student.php';
  }
  // manage students page create here
  function manage_students_func()
  {
      require_once PLUGIN_DIR_PATH . 'views/manage_student.php';
  }
  // course tracker page create here
  function course_tracker_func()
  {
      require_once PLUGIN_DIR_PATH . 'views/course_tracker.php';
  }

  // my author table name function
  function books_list(){
    global $wpdb;
    return $wpdb->prefix."books_list";

  }
  // my author table name function
  function my_author(){
    global $wpdb;
    return $wpdb->prefix."my_author";
     
  }
  // my students table name function
  function my_students(){
    global $wpdb;
    return $wpdb->prefix."my_students";
  }
  // my enroll table name function
  function my_enrol(){
    global $wpdb;
    return $wpdb->prefix."my_enrol";
  }
 // plugin activation hook here
  function my_books_activate()
  {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $book_list_table = "CREATE TABLE ".books_list()."(
        id int(100) NOT NULL AUTO_INCREMENT,
        name varchar(100) DEFAULT NULL,
        author varchar(100) DEFAULT NULL,
        about text DEFAULT NULL,
        book_image varchar(100) DEFAULT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    dbDelta($book_list_table);
    
    $my_author = "CREATE TABLE ".my_author()." (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) DEFAULT NULL,
      `fb_link` varchar(255) DEFAULT NULL,
      `about` text DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    dbDelta($my_author);

    $my_students = "CREATE TABLE ".my_students()." (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL,
      `user_login_id` int(11) NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    dbDelta($my_students);

    $my_enrol = "CREATE TABLE ".my_enrol()." (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `student_id` int(11) NOT NULL,
      `book_id` int(11) NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    dbDelta( $my_enrol);
  // user roll create here
    add_role('wp_read_book_user_key', 'Read Books',array(
      'read' => true,
    ));

    // dynamic create page
    $book_post_id = wp_insert_post(
      array(
      "post_type"    => "page",
      'post_status'  => 'publish',
      'post_title'   => "Course Page",
      'post_content' => "[book_page]",
      'post_name'    => 'books_list',
      )
    );

    add_option( 'my_book_page', $book_post_id );


  }
  register_activation_hook(__FILE__, 'my_books_activate');

  // create shortcode here
  function my_books_shortcode()
  { 
      require_once PLUGIN_DIR_PATH ."views/my_books_frontend_list.php";
  }
  add_shortcode('book_page', 'my_books_shortcode');


  // plugin deactivation hook here
  function my_books_deactivate()
  {
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS " .books_list());
    $wpdb->query("DROP TABLE IF EXISTS " .my_author());
    $wpdb->query("DROP TABLE IF EXISTS " .my_students());
    $wpdb->query("DROP TABLE IF EXISTS " .my_enrol());

    //remove user role
    if(get_role('wp_read_book_user_key')){
      remove_role('wp_read_book_user_key');
    }
     // delete dynamic page..
     if(!empty(get_option( 'my_book_page'))){
       $page_id = get_option( 'my_book_page' );
       wp_delete_post( $page_id, true );
      delete_option( 'my_book_page' );
    }

    
  }
  register_deactivation_hook(__FILE__, 'my_books_deactivate');
  
  // plugin uninstall hook here
  function my_books_uninstall()
  {
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS " . books_list());
    $wpdb->query("DROP TABLE IF EXISTS " . my_author());
    $wpdb->query("DROP TABLE IF EXISTS " . my_students());
    $wpdb->query("DROP TABLE IF EXISTS " . my_enrol());

  }
  register_uninstall_hook(__FILE__, 'my_books_uninstall');

  // ajax function for add new book here
  function my_books_ajax_handler()
  {
    require_once PLUGIN_DIR_PATH ."views/my_book_library.php";
    
  }
  add_action('wp_ajax_book_list', 'my_books_ajax_handler');


// frontend page design here
function my_books_frontend_page($page_template)
{
  global $post;
  $page_slug = $post->post_name;

  if($page_slug == "books_list"){
    $page_template = PLUGIN_DIR_PATH ."views/frontend_book_template.php";
  }
  return $page_template;

}
add_filter('page_template', 'my_books_frontend_page');

//author details here 
function author_details($author_id)
{
  global $wpdb;
  $author_details = $wpdb->get_row(
    $wpdb->prepare(
      "SELECT * FROM ".my_author()." WHERE id = %d",
      $author_id
    ),ARRAY_A
  );
  return $author_details;
}

// user access control here
function my_books_login_redirect( $redirect_to,$request, $user)
{
  // custom user role
  global $user;
  if(isset($user->roles) && is_array( $user->roles)){
    
    if(in_array('wp_read_book_user_key', $user->roles)){
      return $redirect_to = site_url()."/books_list";
    
    }else{
      return $redirect_to;
    }
  }
  
}
add_filter('login_redirect', 'my_books_login_redirect', 10, 3);

function my_books_logout_user()
{
  // custom user role
  wp_redirect(site_url()."books_list");
  exit();
}
add_filter('wp_logout', 'my_books_logout_user');