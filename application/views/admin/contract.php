<?php $isEditForm = $CURRENT_METHOD == "edit_contract"; ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 font-weight-bold text-primary"><?php echo !$isEditForm ? "Manage Contract" : "Update Contract"; ?></h4>
    </div>
    <div class="card-body">

      <form id="form1" method="post">

        <div class="form-group row">
          <div class="col-sm-4">
            <?php if ($isEditForm) {
            ?>
              <input type="hidden" class="form-control" value="<?php if (isset($contract_detail['user_id'])) {
                                                                  echo base64_encode($contract_detail['user_id']);
                                                                } ?>" name="user_id">
              Selected Agent
              <input type="text" autocomplete="off" class="form-control" value="<?php if (isset($contract_detail['name'])) {
                                                                                  echo $contract_detail['name'] . ' (' . $contract_detail['ref_code'] . ')';
                                                                                } ?>" readonly>
            <?php
            } else { ?>

              Select Agent*
              <select class="form-control" name="user_id">
                <?php
                foreach ($agents as $value) {
                  if (empty($value['contract_no'])) {
                ?>
                    <option value="<?php echo base64_encode($value['user_id']) ?>"><?php echo ucwords($value['name']) ?> (<?php echo $value['ref_code'] ?>)</option>
                <?php
                  }
                }
                ?>
              </select>
            <?php
            }
            ?>

          </div>

          <div class="col-sm-4">
            From Date*
            <input type="text" autocomplete="off" class="form-control datepicker" value="<?php if (isset($contract_detail['from_date'])) {
                                                                                            echo date_format(date_create_from_format("Y-m-d", $contract_detail['from_date']), "d/m/Y");
                                                                                          } ?>" name="from_date">
          </div>

          <div class="col-sm-4">
            To Date*
            <input type="text" autocomplete="off" class="form-control datepicker" value="<?php if (isset($contract_detail['to_date'])) {
                                                                                            echo date_format(date_create_from_format("Y-m-d", $contract_detail['to_date']), "d/m/Y");
                                                                                          } ?>" name="to_date">
          </div>

          <div class="col-sm-4">
            Upload Document*
            <input type="file" class="form-control" name="file">
          </div>
          <?php if (isset($contract_detail['document'])) { ?>
            <div class="col-sm-4">
              Uploaded Document
              <br>
              <a class="btn btn-success" href="<?php echo API_BASE . $contract_detail['document']; ?>" target="_blank">View Document</a>
            </div>
          <?php } ?>

        </div>

        <h4>Add Test</h4>
        <div class="form-group row">
          <div class="col-sm-12">
            Select Test*

            <div class="input-group mb-3">
              <select class="form-control" id="testsSelect">
                <option value="">----- Select Test -----</option>
                <?php

                $selected_tests = isset($contract_detail['tests']) ? $contract_detail['tests'] : [];
                $selected_test_ids=array_column($selected_tests,'test_id');

                foreach ($tests as $value) {
                  if(!in_array($value['id'],$selected_test_ids)){
                ?>
                  <option data-mrp="<?php echo $value['mrp'] ?>" value="<?php echo $value['id'] ?>"><?php echo ucwords($value['test']) ?></option>
                <?php
                }
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
            <button type="submit" id="btn" class="btn btn-<?php echo !$isEditForm ? "primary" : "warning"; ?>"> <i class="<?php echo !$isEditForm ? "fas fa-file-signature" : "fa fa-pencil"; ?>"></i> <?php echo !$isEditForm ? "Submit" : "Update"; ?></button>
          </div>
        </div>






      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->