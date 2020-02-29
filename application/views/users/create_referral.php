<div class="container-fluid">

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Create Referral</h1>
 </div>

 <!-- Page Body -->
 <div class="row">
  <div class="col-sm-12">
   <div class="card shadow mb-4">
    <div class="card-header py-3">

     <div class="row">
      <div class="col-sm-9">
       <h5 class="m-0 font-weight-bold text-primary">Details</h5>
      </div>
      <div class="card-body">
       <form id="form1" method="post">
        <?php $isEditForm = false;
        if ($isEditForm) {
        ?>
         <input type="hidden" class="form-control" value="<?php if (isset($user_detail['user_id'])) {
                                                           echo base64_encode($user_detail['user_id']);
                                                          } ?>" name="user_id">
        <?php
        }
        ?>
        <div class="form-group row">

         <div class="col-sm-4">
          Referral Code
          <input type="text" autocomplete="off" class="form-control" value="<?php if (isset($user_detail['ref_code'])) {
                                                                             echo $user_detail['ref_code'];
                                                                            } ?>" name="percentage">
         </div>

         <div class="col-sm-4">
          From Date*
          <input type="text" autocomplete="off" class="form-control datepicker" value="<?php if (isset($user_detail['name'])) {
                                                                                        echo $user_detail['name'];
                                                                                       } ?>" name="from_date">
         </div>

         <div class="col-sm-4">
          To Date*
          <input type="text" autocomplete="off" class="form-control datepicker" value="<?php if (isset($user_detail['mobile'])) {
                                                                                        echo $user_detail['mobile'];
                                                                                       } ?>" name="to_date">
         </div>
        </div>

        <h4>Select Test</h4>
        <div class="form-group row">
         <div class="col-sm-12">
          Select Test*

          <div class="input-group mb-3">
           <select class="form-control" id="testsSelect">
            <option value="">----- Select Test -----</option>
            
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
              <!-- <th scope="col">Package</th> -->
              <th scope="col">Discount(%)</th>
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
   </div>
  </div>
 </div>
</div>