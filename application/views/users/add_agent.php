        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">Add Agent</h4>
            </div>
            <div class="card-body">
              <form id="form1" method="post">
          
                <div class="form-group row">
                  <div class="col-sm-4">
                    Registation Type
                    <select class="form-control" id="reg_type" name="reg_type">
                      <?php
                      $reg_types = get_registration_types();
                      foreach ($reg_types as $value) {
                        ?>
                        <option value="<?php echo $value ?>"><?php echo ucwords($value) ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-4" hidden>
                    Agent Type

                    <select class="form-control"  name="agent_type">
                      <?php
                      if (!empty($agent_types)) {
                        foreach ($agent_types as $value) {
                          ?>
                          <option value="<?php echo $value['id'] ?>"><?php echo ucwords($value['type']) ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    Name*
                    <input type="text" class="form-control" value="" name="name">
                  </div>

                  <div class="col-sm-4" company-inputs>
                    Company Name*
                    <input type="text" class="form-control" value="" name="company_name">
                  </div>

                  <div class="col-sm-4" company-inputs>
                    GST No*
                    <input type="text" class="form-control" value="" name="gst">
                  </div>
                  <div class="col-sm-4">
                    Phone*
                    <input type="text" class="form-control" value="" name="phone">
                  </div>
                  <div class="col-sm-4">
                    Email*
                    <input type="text" class="form-control" value="" name="email">
                  </div>
                  <div class="col-sm-4">
                    Password*
                    <input type="text" class="form-control" value="" name="password">
                  </div>
                  <div class="col-sm-4">
                    Address*
                    <textarea type="text" class="form-control" value="" name="address"></textarea>
                  </div>
                  <div class="col-sm-12" style="text-align: center;">
                    <button type="submit" id="btn" class="btn btn-primary"> <i class="fas fa-fw fa-user-plus"></i> Add</button>
                  </div>
                </div>
                              



              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        