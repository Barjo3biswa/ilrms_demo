<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/loader1.gif" style="width: 100px;"></div> 
<style>

  .btn-circle {
    width: 300px;
    height: 300px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
  }
  .btn-circle.btn-lg {
    width: 300px;
    height: 300px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 25px;
  }
  .btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    font-size: 24px;
    line-height: 1.33;
    border-radius: 35px;
  }


  :root {
    --loader-size: 50px;
    --dot-size: 6px;
    --loader-bg: #e1e6e2;
    --dot-color: black;
  }

  .loader {
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(1, 18, 64, 0.2);
    transition: opacity 0.3s ease-out, top 0.3s step-end;
    z-index: 99;
  }

  .loader.trans {
    transition: opacity 0.5s ease-out, top 0.5s step-start;
    opacity: 1;
    top: 0;
  }

  .loader .loaderview {
    position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    width: auto;
    height: auto;
    padding: 10px 40px;
    border-radius: 5px;
    top: 0;
    left: 0;
    z-index: 100;
    flex-flow: column;
    background-color: var(--loader-bg);
  }

  h1 {
    color: var(--dot-color);
    font-size: 1.2em;
    animation: fading 1.5s ease-in-out infinite;
    font-family: "Comfortaa", cursive;
  }

  .Loader-box {
    margin: 20px;
    flex: 0 0 auto;
    height: var(--loader-size);
    width: var(--loader-size);
  }

  .box {
    position: absolute;
    height: var(--loader-size);
    width: var(--loader-size);
    animation: rotating 4s ease-in infinite;
    animation-delay: calc(var(--id) * 0.5s);
  }

  .dot {
    background-color: var(--dot-color);
    height: var(--dot-size);
    width: var(--dot-size);
    border-radius: 100%;
  }

  @keyframes rotating {
    0% {
      opacity: 0;
      transform: rotateZ(0);
    }
    25% {
      opacity: 100%;
      transform: rotateZ(160deg);
    }

    75% {
      opacity: 200%;
      opacity: 100;
    }
    80% {
      transform: rotateZ(300deg);
      opacity: 100;
    }
    100% {
      transform: rotateZ(350deg);
      opacity: 0;
    }
  }

  @keyframes fading {
    0% {
      opacity: 40%;
    }
    50% {
      opacity: 90%;
    }
    100% {
      opacity: 40%;
    }
  }
</style>
<style type="text/css">

  .card-body {
    width: 200px;
    height: 200px;
    background-color: #e4e4e4;
    border-radius: 50%;
  }

  .num-card-title {
    font-style: normal;
    font-size: 32px;
    text-align: center;
    font-weight: bold;
  }

  .card-text {
    margin-top: 2px;
    text-align: center;
    font-size: 20px;
  }

  .td-align-title {
    text-align:right;
    color: white;
    vertical-align: middle;
    text-align: center;

  }
  .td-align {
    text-align:right;
  }

  .table_div_responsive {
    overflow-x: scroll;
  }

  .input_field{
    opacity:0;
  }

  .more_details {
    color: red;
    font-size:15px; 
    margin-left: 30px;
    cursor: pointer;
  }

</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 text-white">
        <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadariDashboard/index'?>">Mouzadari-District-Details</a></li>        
    </ol>
</nav>
<hr>
<div class="container bg-success text-white p-1 shadow-lg">
  <h5 style="text-align:center">E-Khajana Mouzadari Area's Dashboard</h5>
</div>
<hr>
<div class="container">
  <div class="form-group">
    <div class="row">    
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 my-2">
        <div class="card-body">
          <h5 class="card-text">Received</h5><hr>
          <h4 class="num-card-title"><?=$mouzadari_total_applications_info['total_applications']?></h4><hr>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 my-2">
        <div class="card-body">
          <h5 class="card-text">Pending</h5><hr>
          <h4 class="num-card-title"><?=$mouzadari_total_applications_info['total_pending_applications']?></h4><hr>          
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 my-2">
        <div class="card-body">
          <h5 class="card-text">Delivered</h5><hr>
          <h4 class="num-card-title"><?=$mouzadari_total_applications_info['total_delivered_applications']?></h4><hr>          
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 my-2">
        <div class="card-body">
          <h5 class="card-text">Rejected</h5><hr>
          <h4 class="num-card-title"><?=$mouzadari_total_applications_info['total_rejected_applications']?></h4><hr>          
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="container bg-secondary text-white p-1 shadow-lg">
  <h6 style="text-align:center">Click The District To Get The Circle Level Info</h6>
</div>
<hr>
<div class="container mb-5">
  <table class="table table-hover table-bordered" style="border-color:black" id="mouz_dist_wise_table">
    <thead>
      <tr style="background-color:#b67eff;">
        <th scope="col" class="text-center">District</th>
        <th scope="col" class="text-center">Received</th>
        <th scope="col" class="text-center">Pending<br>With Mouzadar</th>
        <th scope="col" class="text-center">Pending<br>With LM</th>
        <th scope="col" class="text-center">Pending<br>With CO</th>
        <th scope="col" class="text-center">Delivered</th>
        <th scope="col" class="text-center">Rejected</th>
      </tr>
    </thead>
    <tbody>    
        <?php foreach ($mouzadari_dist_wise_applications_info as $row): ?>
            <tr>
                <th scope="row">
                  <a href="<?=base_url()?>index.php/EkhajanaMouzadariDashboard/circleWiseInfo/<?=$row['district_code']?>" target="_circle_mouz_dash">
                    <?=$row['district_name']?>
                  </a>                  
                </th>
                <th scope="row"><?=$row['total_applications']?></th>
                <th scope="row"><?=$row['pending_with_mouzadar']?></th>
                <th scope="row"><?=$row['pending_with_lm']?></th>
                <th scope="row"><?=$row['pending_with_co']?></th>
                <th scope="row">
                    <span class="text-success font-weight-bold">
                        <?=$row['total_delivered_applications']?>
                    </span>                    
                </th>
                <th scope="row">
                    <span class="text-danger font-weight-bold">
                        <?=$row['total_rejected_appliation']?>
                    </span>
                </th>
            </tr>  
        <?php endforeach ?>    
    </tbody>
  </table>
  <hr>
</div>
<link href="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>
<script>
  $('#mouz_dist_wise_table').dataTable({
      "scrollX": true,
      "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
      "pageLength": 5,
      //"autoWidth":false,
      responsive: true
  });
</script>