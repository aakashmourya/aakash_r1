<?php $isEditForm = $CURRENT_METHOD == "edit_agent"; ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 font-weight-bold text-primary"><?php echo !$isEditForm ? "Manage Contract" : "Edit Agent"; ?></h4>
    </div>
    <div class="card-body">

      <form id="form1" method="post">
        <?php if ($isEditForm) {
        ?>
          <input type="hidden" class="form-control" value="<?php if (isset($user_detail['user_id'])) {
                                                              echo base64_encode($user_detail['user_id']);
                                                            } ?>" name="user_id">
        <?php
        }
        ?>
        <div class="form-group row">
          <div class="col-sm-4">
            Select Agent*
            <select class="form-control" id="reg_type" name="reg_type">
              <?php
              foreach ($agents as $value) {
              ?>
                <option value="<?php echo $value['name'] ?>"><?php echo ucwords($value['name']) ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <div class="col-sm-4">
            From Date*
            <input type="text" autocomplete="off" class="form-control datepicker" value="<?php if (isset($user_detail['name'])) {
                                                                                            echo $user_detail['name'];
                                                                                          } ?>" name="name">
          </div>

          <div class="col-sm-4">
            To Date*
            <input type="text" autocomplete="off" class="form-control datepicker" value="<?php if (isset($user_detail['mobile'])) {
                                                                                            echo $user_detail['mobile'];
                                                                                          } ?>" name="phone">
          </div>
          <div class="col-sm-12">
            Upload Document*
            <input type="file" class="form-control" name="phone">
          </div>

        </div>

        <h4>Add Test</h4>
        <div class="form-group row">
          <div class="col-sm-12">
            Select Test*

            <div class="input-group mb-3">
              <select class="form-control" id="testsSelect" name="reg_type">
              <option value="">----- Select Test -----</option>
                <?php
                foreach ($tests as $value) {
                ?>
                  <option value="<?php echo $value['id'] ?>"><?php echo ucwords($value['test']) ?></option>
                <?php
                }
                ?>
              </select>
              <div class="input-group-append">
                <button id="addTestBtn" class="btn btn-info" type="button">Add</button>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-bordered add-test-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Test</th>
                    <th scope="col">Package</th>
                    <th scope="col">Percentage(%)</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="setectedTestTable">
                
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-sm-12" style="text-align: center;">
            <button type="submit" id="btn" class="btn btn-<?php echo !$isEditForm ? "primary" : "warning"; ?>"> <i class="<?php echo !$isEditForm ? "fas fa-fw fa-user-plus" : "fa fa-pencil"; ?>"></i> <?php echo !$isEditForm ? "Add" : "Update"; ?></button>
          </div>
        </div>






      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->