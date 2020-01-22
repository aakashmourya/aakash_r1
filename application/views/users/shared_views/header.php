<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Know Your Gene</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
  
  <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap-notify/bootstrap-notify.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/helper.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/constants.js'); ?>"></script>
  <script>
    const BASE_URL = "<?php echo base_url() ?>";
    const USER_BASE_URL = "<?php echo base_url($this->router->fetch_class()) ?>";
    <?php
    //Load scripts Constants
    if (isset($js_contants)) {
      if (is_array($js_contants)) {
        foreach ($js_contants as $key=>$value) {
          echo "const ".$key. "='".$value."';";
        }
      } 
    }
    ?>
  </script>
</head>

<body id="page-top">