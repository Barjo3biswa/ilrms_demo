<nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 text-white">
        <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadariDashboard/index'?>">Mouzadari-District-Details</a></li>
        <li class="breadcrumb-item font-weight-bold">
            <a href="<?php echo base_url() ?>index.php/EkhajanaMouzadariDashboard/circleWiseInfo/<?=$mouza_wise_applications_info[0]['dist_code']?>">
                Circle-Wise-Info
            </a>
        </li>         
        <li class="breadcrumb-item font-weight-bold">
            <a href="#">
                Mouza-Wise-Info
            </a>
        </li>         
    </ol>
</nav>
<hr>
<div class="container bg-success text-white p-1 shadow-lg">
  <h5 style="text-align:center">E-Khajana Mouzadari Area's Dashboard</h5>
</div>
<hr>
<!-- <div class="container bg-secondary text-white p-1 shadow-lg">
  <h6 style="text-align:center">Click The Circle To Get The Mouza Level Info</h6>
</div>
<hr> -->
<div class="container mb-5 mt-5">
  <table class="table table-hover table-bordered" style="border-color:black" id="mouz_dist_wise_table">
    <thead>
      <tr style="background-color:#b67eff;">
        <th scope="col" class="text-center">Mouza</th>
        <th scope="col" class="text-center">Received</th>
        <th scope="col" class="text-center">Pending<br>With Mouzadar</th>
        <th scope="col" class="text-center">Pending<br>With LM</th>
        <th scope="col" class="text-center">Pending<br>With CO</th>
        <th scope="col" class="text-center">Delivered</th>
        <th scope="col" class="text-center">Rejected</th>
      </tr>
    </thead>
    <tbody>    
        <?php foreach ($mouza_wise_applications_info as $row): ?>
            <tr>
                <th scope="row">                  
                    <?=$row['mouza_name']?>                  
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