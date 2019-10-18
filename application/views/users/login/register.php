<div class="container" style="height:100vh;">
  <!-- Outer Row -->
  <div class="row justify-content-center" style="height:100%;">

    <div class="col-xl-10 col-lg-12 col-md-9" style="align-self: center;">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-register-image" style=" background: url(https://www.sciencenews.org/wp-content/uploads/2018/09/0914_ti_gene-count_feat_free.jpg);"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form id="form1" method="post">
                  <div class="form-group">
                    <select class="form-control" name="role">
                      <option>Select role</option>
                      <option>Hospital</option>
                      <option>Gym</option>
                      <option>Individual</option>
                    </select>

                  </div>
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name">

                  </div>
                  <div class="form-group">
                    <input type="text" name="email" class="form-control has-error" placeholder="Email Address">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="col-sm-6">
                      <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                    </div>
                  </div>
                  <button id="btn" class="btn btn-primary btn-user btn-block">
                    Register
                  </button>
                  <!-- <hr>
            <a href="index.html" class="btn btn-google btn-user btn-block">
              <i class="fab fa-google fa-fw"></i> Register with Google
            </a>
            <a href="index.html" class="btn btn-facebook btn-user btn-block">
              <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
            </a> -->
                </form>
                <hr>
                <!-- <div class="text-center">
            <a class="small" href="forgot-password.html">Forgot Password?</a>
          </div> -->
                <div class="text-center">
                  <a class="small" href="<?php echo base_url('Login') ?>">Already have an account? Login!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<script src="<?php echo base_url("assets/js/scripts/register.js") ?>"></script>