<section id="all_user_page">
  <div class="container">
    <div class="row">
      
      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Add New Author</div>
          <div class="panel-body">
            <form class="form-horizontal" action="javascript:void(0)" id="add_author_form">

              <div class="form-group">  
                <label class="control-label" for="author_name">Author Name:</label>
                  <input type="text" class="form-control" name="author_name" id="author_name" placeholder="Enter name" required>
              </div>

              <div class="form-group">  
                <label class="control-label" for="fb_link">Facebook link:</label>
                  <input type="text" class="form-control" name="fb_link" id="fb_link" placeholder="Enter Facebook Link" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="author_about">Author About</label>
                  <textarea class="form-control" name="author_about" id="author_about" placeholder="Enter About Author"></textarea>
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