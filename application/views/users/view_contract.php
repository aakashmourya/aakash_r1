<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Contract Details</h1>
  </div>

  <!-- Page Body -->
  <div class="row">
    <div class="col-sm-12">
      <div class="card shadow mb-4">
        <?php if(isset($contract_detail['contract_no']))
        {?>
        <div class="card-header py-3">

          <div class="row">
            <div class="col-sm-9">
              <h5 class="m-0 font-weight-bold text-primary">Details</h5>
            </div>
            <?php if ($this->userDetail['added_by'] == 'root') { ?>
            <div class="col-sm-3" align="right">
              <a title="Update Contract" href="<?php echo base_url($this->router->fetch_class() . "/edit-contract/" . base64_encode($contract_detail['contract_no'])) ?>" class="btn btn-warning">
                Update Contract
              </a>
            </div>
          <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-2 text-primary">Contract No. :</div>
            <div class="col-sm-2"><?php echo $contract_detail['contract_no'] ?></div>
            <div class="col-sm-2 text-primary">From Date :</div>
            <div class="col-sm-2"><?php echo date_format(date_create_from_format("Y-m-d", $contract_detail['from_date']), "d/m/Y") ?></div>
            <div class="col-sm-2 text-primary">To Date :</div>
            <div class="col-sm-2"><?php echo date_format(date_create_from_format("Y-m-d", $contract_detail['to_date']), "d/m/Y") ?></div>
          </div>


          <div class="row">
            <h5 class="mt-35 col-xl-12 col-md-12 font-weight-bold text-primary">Commission Details</h5>
            <?php if (!empty($contract_detail['tests'])) {
              foreach ($contract_detail['tests'] as $key => $value) {
                $border_icon = card_color_logo($value['test']);
            ?>
                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-<?php echo $border_icon['border'] ?> shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col row mr-2">
                          <div class="col-sm-6 text-primary">Test :</div>
                          <div class="col-sm-6"><?php echo $value['test'] ?></div>
                          <div class="col-sm-6 text-primary">Package :</div>
                          <div class="col-sm-6"><?php echo $value['package'] ?></div>
                          <div class="col-sm-6 text-primary">MRP :</div>
                          <div class="col-sm-6"><span class="font-weight-bold">&#8377;</span> <?php echo $value['mrp'] ?></div>
                          <div class="col-sm-6 text-primary">Commission :</div>
                          <div class="col-sm-6"><?php echo $value['percentage'] ?>%</div>
                        </div>
                        <div class="col-auto">
                          <i class="<?php echo $border_icon['icon'] ?> fa-2x text-<?php echo $border_icon['border'] ?>"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
            } ?>

            <div class="col-sm-12" style="text-align: center;">
              <a href="<?php echo API_BASE . $contract_detail['document'] ?>" id="btn" class="btn btn-primary text-light" target="_blank"> <i class="fa fa-eye"></i> View Contract</a>
            </div>

          </div>

        </div>
          <?php }else{?>
<h5 style="text-align:center;padding:10px;">No Data Available.</h5>
          <?php }?>
      </div>
    </div>
  </div>
</div>