<?php

  global $wpdb;
  $author_data = $wpdb->get_results(
        $wpdb->prepare(
          "SELECT * FROM ".my_author(),
        ),ARRAY_A
    );

    // print_r($author_data);
 
?>

<section id="all_user_page">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Manage Author</div>
          <div class="panel-body">
            <table id="book_list_table" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Fb Link</th>
                  <th>About</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $i = 1;
                if(count($author_data) > 0) {
                  foreach ($author_data as $key => $value) { ?>

                  <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['fb_link'] ?></td>
                    <td><?php echo $value['about'] ?></td>
                    <td>
                      <a href="" class="btn btn-info">Edit</a>
                      <a href="javascript:void(0)" class="btn btn-danger " data-id="<?php ?>">Delete</a>
                    </td>
                  </tr> 

              <?php  } } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Fb Link</th>
                  <th>About</th>
                  <th>Create At</th>
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