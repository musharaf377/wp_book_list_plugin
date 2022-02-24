<section id="all_user_page">
  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">Add New Students</div>
      <div class="panel-body">
        <form class="form-horizontal" action="javascript:void(0)" id="add_student_form">
          
          <div class="form-group">
            <label class="control-label" for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
          </div>

          <div class="form-group">
            <label class="control-label" for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
          </div>

          <div class="form-group">
            <label class="control-label" for="user_name">User Name:</label>
            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter Your User Name"
              required />
          </div>

          <div class="form-group">
            <label class="control-label" for="password">Password:</label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Enter Your Password"
              required />
          </div>

          <div class="form-group">
            <label class="control-label" for="confirm_pass">Confirm Password:</label>
            <input type="text" class="form-control" name="confirm_pass" id="confirm_pass"
              placeholder="Confirm Your Password" required />
          </div>


          <div class="form-group mt-5">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>