        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">List of all agents</h4>
            </div>
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <!-- <th hidden>#</th> -->
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Reg. Type</th>
                      <th>Company Name</th>
                      <th>GST</th>
                      <th>Actions</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    if (isset($agents) && !empty($agents)) {
                      //my_print($agents);
                      foreach ($agents as $row) {
                    ?>

                        <tr>
                          <!-- <td hidden><?php //echo $row['id']; ?></td> -->
                          <td><?php echo $row['name'] ?></td>
                          <td><?php echo $row['mobile'] ?></td>
                          <td><?php echo $row['email'] ?></td>
                          <td><?php echo ucwords($row['reg_type']) ?></td>
                          <td><?php echo $row['company_name'] ?></td>
                          <td><?php echo $row['gst'] ?></td>
                          <td>
                            <a title="Edit Agent" href="<?php echo base_url($this->router->fetch_class()."/edit-agent/".base64_encode($row['user_id'])) ?>" class="btn btn-warning btn-sm">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <!-- <a title="Manage Contract" href="<?php echo base_url($this->router->fetch_class()."/edit-agent/".base64_encode($row['user_id'])) ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-file-contract"></i>
                            </a> -->
                          </td>

                        </tr>

                    <?php
                                    }
                                  } ?>

                  </tbody>
                </table>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->