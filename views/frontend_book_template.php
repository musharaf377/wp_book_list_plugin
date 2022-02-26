<?php

/**
 * template name: Book Template
 */

 get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success">
        <h5>Our Book List</h3>
      </div>
      <?php 

        echo do_shortcode('[book_page]');
      
      ?>

    </div>
  </div>
</div>


<?php get_footer();