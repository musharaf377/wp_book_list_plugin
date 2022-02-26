<?php

  global $wpdb;
  $table_name = $wpdb->prefix."books_list";
  $book_list = $wpdb->get_results(
    $wpdb->prepare(
      "SELECT * FROM $table_name",""
    ),ARRAY_A
  );

// print_r($book_list);


?>

<section id="all_user_page">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Book List</div>
          <div class="panel-body">
            <table id="book_list_table" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Author</th>
                  <th>About</th>
                  <th>Created At</th>
                  <th>Book Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              
                  if(count($book_list) > 0){
                    $i = 1;
                    foreach ($book_list as $key => $book) {
                      // print_r($book);
                    
              
              ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $book['name']; ?></td>
                  <td><?php echo author_details($book['author'])['name']?></td>
                  <td><?php echo $book['about']; ?></td>
                  <td><?php echo $book['created_at']; ?></td>
                  <td><img src="<?php echo $book['book_image']; ?>" style="width:80px; height:80px;" alt=""></td>
                  <td>
                    <a href="admin.php?page=edit-book&id=<?php echo $book['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="javascript:void(0)" class="btn btn-danger delete_btn" data-id="<?php echo $book['id']; ?>">Delete</a>
                  </td>
                </tr> 

              <?php } } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Author</th>
                  <th>About</th>
                  <th>Create At</th>
                  <th>Book Image</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>