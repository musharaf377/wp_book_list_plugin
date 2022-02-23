<?php 
  wp_enqueue_media();

  $book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

  global $wpdb;
  $table_name = $wpdb->prefix.'books_list';
  $book_data = $wpdb->get_row(
    $wpdb->prepare(

      "SELECT * FROM $table_name WHERE id = %d", $book_id
    ),ARRAY_A
  
  );

  // print_r($book_data);





?>

<section id="all_user_page">
  <div class="container">
    <div class="row">
      
      <div class="col-lg-12">
       
        <div class="panel panel-primary">
          <div class="panel-heading">Edit book</div>
          <div class="panel-body">
            <form class="form-horizontal" action="javascript:void(0)" id="edit_book_form">

            <input type="hidden" name="book_id" value="<?php echo isset($_GET['id'])?intval($_GET['id']): 0 ; ?>">
              <div class="form-group">  
                <label class="control-label" for="name">name:</label>
                  <input type="text" class="form-control" value="<?php echo $book_data['name'] ?>" name="name" id="name" placeholder="Enter name" required>
              </div>

              <div class="form-group">  
                <label class="control-label" for="author">author:</label>
                  <input type="text" class="form-control" value="<?php echo $book_data['author'] ?>" name="author" id="author" placeholder="Enter author" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="about_book">About Books</label>
                  <textarea class="form-control" name="about_book" id="about_book"><?php echo $book_data['about'] ?></textarea>
              </div>

              <div class="form-group">
                <label class="control-label" for="image_name">Book Image</label>
                  <input type="button" class="btn btn-info" value="upload" id="upload_img" required >
                  <span id="show_img">
                    <img src="<?php echo $book_data['book_image'] ?>" style="width:80px; height:80px;" alt="">
                  </span>
                  <input type="hidden" name="image_name" value="<?php echo $book_data['book_image'] ?>" id="image_name">
              </div>
              
              <div class="form-group mt-5">
                  <button type="submit" class="btn btn-primary">Update</button>
              </div>

            </form>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-2"></div> -->
    </div>
  </div>
</section>