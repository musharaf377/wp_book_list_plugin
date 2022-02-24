
<?php wp_enqueue_media(); ?>

<section id="all_user_page">
  <div class="container">
    <div class="row">
      
      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Add New Book</div>
          <div class="panel-body">
            <form class="form-horizontal" action="javascript:void(0)" id="add_book_form">

              <div class="form-group">  
                <label class="control-label" for="name">Book Name:</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
              </div>

            
              <div class="form-group">  
                <label class="control-label" for="author">author:</label>
                  <select name="author" id="author" class="form-control mw-100">
                   <option value="-1">--Choose Author--</option>
                   <?php
                   global $wpdb;
                   $author_data = $wpdb->get_results(
                      $wpdb->prepare(
                           "SELECT * FROM ".my_author(),
                         ),ARRAY_A
                     ); 
                     
                    foreach($author_data as $key => $author) { ?>
                    
                    <option value="<?php echo $author['id'] ?>"><?php echo $author['name'] ?></option>
                    
                 <?php } ?> 

                  </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="about_book">About Books</label>
                  <textarea class="form-control" name="about_book" id="about_book"></textarea>
              </div>

              <div class="form-group">
                <label class="control-label" for="image_name">Book Image</label>
                  <input type="button" class="btn btn-info" value="upload" id="upload_img" required >
                  <span id="show_img"></span>
                  <input type="hidden" name="image_name" id="image_name">
              </div>
              
              <div class="form-group mt-5">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>

            </form>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-2"></div> -->
    </div>
  </div>
</section>