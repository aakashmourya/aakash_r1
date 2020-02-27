        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php
          // echo "<pre>";
          print_r($user);
          ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <!-- <div class="row"> -->

          <!-- Earnings (Monthly) Card Example -->
          <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          <!-- Earnings (Monthly) Card Example -->
          <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          <!-- Earnings (Monthly) Card Example -->
          <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          <!-- Pending Requests Card Example -->
          <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          <!-- </div> -->

          <!-- Content Row -->



          <!-- Content Row -->

          <div class="row">
            <!-- show image with name -->
            <!-- <div class="card shadow mb-4 col-sm-2 img_card">
              <div class="card-body profile_card">
                <img class="img-profile rounded-circle profile_img" src="<?php echo base_url('assets/img/avatar5.png') ?>">
                <div>
                  <p class="u_name">Hello Yathath Sharma</p>
                </div>
              </div>
            </div> -->
            <!-- personal details tab -->
            <div class="col-sm-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary">Personal Details</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <!-- <div class="offset-1 col-sm-5 text-primary">Registration Type :</div>
                    <div class="col-sm-6">Individual</div> -->
                    <div class="col-sm-4 text-primary">Name :</div>
                    <div class="col-sm-8"><?php echo ucwords($user['name']) ?></div>
                    <div class="col-sm-4 text-primary">Company Name :</div>
                    <div class="col-sm-8"><?php echo $user['company_name'] == '' ? 'xxxxx' : $user['company_name'] ?></div>
                    <!-- <div class="offset-1 col-sm-5 text-primary">GST No :</div>
                    <div class="col-sm-6">YS012345</div> -->
                    <div class="col-sm-4 text-primary">Phone :</div>
                    <div class="col-sm-8"><?php echo $user['mobile'] ?></div>
                    <div class="col-sm-4 text-primary">Email :</div>
                    <div class="col-sm-8"><?php echo $user['email'] ?></div>
                    <div class="col-sm-4 text-primary">Address :</div>
                    <div class="col-sm-8"><?php echo $user['address'] ?></div>
                    <!-- <div class="offset-1 col-sm-5 text-primary">Referred by :</div>
                    <div class="col-sm-6">Aakash Maurya</div> -->
                  </div>
                </div>
              </div>
            </div>




            <!-- reffered by and other details -->
            <div class="col-sm-6">
              <div class="card shadow mb-4" style="min-height:92%">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary">Reffered By & Other Details</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4 text-primary">Registration Type :</div>
                    <div class="col-sm-8"><?php echo $user['reg_type'] ?></div>
                    <div class="col-sm-4 text-primary">GST No :</div>
                    <div class="col-sm-8"><?php echo $user['gst'] == '' ? 'xxxxx' : $user['gst'] ?></div>
                    <div class="col-sm-4 text-primary">Referred by :</div>
                    <div class="col-sm-8">Aakash Maurya</div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->