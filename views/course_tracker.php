<?php

  global $wpdb;
 
?>

<section id="all_user_page">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Manage Course</div>
          <div class="panel-body">
            <table id="book_list_table" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>course</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
        
              
              ?>
                <tr>
                  <td><?php  ?></td>
                  <td><?php  ?></td>
                  <td><?php  ?></td>
                  <td><?php  ?></td>
                  <!-- <td><img src="" style="width:80px; height:80px;" alt=""></td> -->
                  <td>
                    <a href="" class="btn btn-info">Edit</a>
                    <a href="javascript:void(0)" class="btn btn-danger " data-id="<?php ?>">Delete</a>
                  </td>
                </tr> 

              <?php ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>course</th>
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