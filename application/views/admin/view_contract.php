<?php $isEditForm = $CURRENT_METHOD == "edit_agent"; ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 font-weight-bold text-primary"><?php echo !$isEditForm ? "View Contract" : "Edit Agent"; ?></h4>
    </div>
    <div class="card-body">

      <form id="form1" method="post" >
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
            Registation Type
            <select class="form-control" id="reg_type" name="reg_type">
              <?php
              $reg_types = get_registration_types();
              foreach ($reg_types as $value) {
              ?>
                <option value="<?php echo $value ?>" <?php if (isset($user_detail['reg_type']) && $value == $user_detail['reg_type']) {
                                                        echo "selected";
                                                      } ?>><?php echo ucwords($value) ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="col-sm-4" hidden>
            Agent Type

            <select class="form-control" name="agent_type">
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
            <input type="text" class="form-control" value="<?php if (isset($user_detail['name'])) {
                                                              echo $user_detail['name'];
                                                            } ?>" name="name">
          </div>

          <div class="col-sm-4" company-inputs>
            Company Name*
            <input type="text" class="form-control" value="<?php if (isset($user_detail['company_name'])) {
                                                              echo $user_detail['company_name'];
                                                            } ?>" name="company_name">
          </div>

          <div class="col-sm-4" company-inputs>
            GST No*
            <input type="text" class="form-control" value="<?php if (isset($user_detail['gst'])) {
                                                              echo $user_detail['gst'];
                                                            } ?>" name="gst">
          </div>
          <div class="col-sm-4">
            Phone*
            <input type="text" class="form-control" value="<?php if (isset($user_detail['mobile'])) {
                                                              echo $user_detail['mobile'];
                                                            } ?>" name="phone">
          </div>
          <div class="col-sm-4">
            Email*
            <input type="text" class="form-control" value="<?php if (isset($user_detail['email'])) {
                                                              echo $user_detail['email'];
                                                            } ?>" name="email">
          </div>
          <div class="col-sm-4">
            Password*
            <input type="text" class="form-control" value="<?php if (isset($user_detail['password'])) {
                                                              echo $user_detail['password'];
                                                            } ?>" name="password">
          </div>
          <div class="col-sm-4">
            Address*
            <textarea type="text" class="form-control" name="address"><?php if (isset($user_detail['address'])) {
                                                                        echo $user_detail['address'];
                                                                      } ?></textarea>
          </div>
          </div>
          <h4>Referred by</h4>
        <div class="form-group row">
        <div class="col-sm-6">
            Referred by (Reference Code)
            <input type="text" autocomplete="off" class="form-control" value="<?php if (isset($user_detail['referred_by'])) {
                                                                                            echo $user_detail['referred_by'];
                                                                                          } ?>" name="referred_by">
          </div>
          <div class="col-sm-6">
            Percentage (%)
            <input type="text" autocomplete="off" class="form-control" value="<?php if (isset($user_detail['percentage'])) {
                                                                                            echo $user_detail['percentage'];
                                                                                          } ?>" name="percentage">
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