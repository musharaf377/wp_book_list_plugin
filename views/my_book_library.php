<?php
  if($_REQUEST['param']=='save_book'){
      
    $name = $_REQUEST['name'] ? $_REQUEST['name'] : '';
    $author = $_REQUEST['author'] ? $_REQUEST['author'] : '';
    $about = $_REQUEST['about_book'] ? $_REQUEST['about_book'] : '';
    $book_image = $_REQUEST['image_name'] ? $_REQUEST['image_name'] : '';

    global $wpdb;
    $wpdb->insert(
      books_list(),
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
    $wpdb->update(
      books_list(),
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
    $wpdb->delete(
      books_list(),
      array(
        'id' => $_REQUEST['id'],
      )
    );

    echo json_encode(array("status" => 1, "message" => "Book Deleted Successfully."));
  }elseif($_REQUEST['param'] == "add_author"){
    
    global $wpdb;
    $wpdb->insert(
      my_author(),
      array(
        'name' => $_REQUEST['author_name'],
        'fb_link' => $_REQUEST['fb_link'],
        'about' => $_REQUEST['author_about'],
      )
    );

    echo json_encode(array("status" => 1, "message" => "Author Added Successfully."));

  }elseif($_REQUEST['param'] == "add_student"){

  $student_id =  $user_id = wp_create_user( $_REQUEST['user_name'], $_REQUEST['password'], $_REQUEST['email']); 

   $user = new WP_User($student_id);
   $user->set_role('wp_read_book_user_keyy');
    
    global $wpdb;
    $wpdb->insert(
      my_students(),
      array(
        'name'          => $_REQUEST['name'],
        'email'         => $_REQUEST['email'],
        'user_login_id' => $user_id,
      )
    );

    echo json_encode(array("status" => 1, "message" => "Student Added Successfully."));

  }
 
  wp_die();