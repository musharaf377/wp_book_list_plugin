<?php

  global $wpdb;
 $student_data = $wpdb->get_results(
    $wpdb->prepare(
      "SELECT * FROM ".my_students()
    )
  );
 
// print_r($student_data);
?>

<section id="all_user_page">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Manage Students</div>
          <div class="panel-body">
            <table id="book_list_table" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $i = 1;
                foreach ($student_data as $key => $value) {
                  
                  $user_name = get_userdata($value->user_login_id);
                
                  
                ?>
                <tr>
                  <td><?php echo $i++  ?></td>
                  <td><?php echo $value->name ?></td>
                  <td><?php echo $value->email ?></td>
                  <td><?php echo $user_name->user_login ?></td>
                  
                  <td>
                    <a href="" class="btn btn-info">Edit</a>
                    <a href="javascript:void(0)" class="btn btn-danger " data-id="<?php ?>">Delete</a>
                  </td>
                </tr> 

              <?php }  ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Username</th>
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