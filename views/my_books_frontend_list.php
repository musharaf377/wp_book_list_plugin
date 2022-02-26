
<?php

 global $wpdb;
 global $user_ID;
 $book_list = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT * FROM ".books_list(),"ORDER BY id DESC",""
      ), ARRAY_A
  );

// print_r($book_list);

?>

<div class="container">
  <div class="row">

  <?php
    if(count($book_list) > 0){

      foreach ($book_list as $key => $value) { 
  ?>
    <div class="col-lg-3">
      <div class="single_book_list">
        <div class="book_img">
          <img src="<?php echo $value['book_image']; ?>" style="width:150px; height:150px;" alt="">
        </div>
        <h2><?php echo $value['name']; ?></h2>
        <p><?php echo author_details($value['author'])['name']; ?></p>

        <button class="btn btn-success"><?php if($user_ID > 0){ echo "Enroll Now"; }else{ echo "Enroll to Login"; } ?></button>
      </div>
    </div>
  <?php } } ?>
  </div>
</div>