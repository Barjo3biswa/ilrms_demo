<style>
    .dt-button {
        background-color: #00e676 !important;
        padding: 5px 20px !important;
        border-radius: 5px;
    }
</style>
<link href="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">

<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif"></div>
<script src="<?php echo base_url(); ?>application/views/js/blockUI.js"></script>
<script>
    document.onreadystatechange = function(e)
    {
        $.blockUI({
            message: $('#displayBox'),
            css: {
                border:'none',
                backgroundColor:'transparent'
            }
        });
    };
    window.onload = function(){
        $.unblockUI();
    }
</script>

<div class="row">
    <div class="col-lg-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3 text-white">
                <li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'dashboard'?>">Number of Pattadar</a></li>
                <li class="breadcrumb-item font-weight-bold active" aria-current="page">Circle Wise</li>
            </ol>
        </nav>        
    </div>
    <div class="col-lg-2 pull-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3 text-white">
                <li class="breadcrumb-item font-weight-bold">
                    <a href="<?= base_url().'total-pattadar-district-wise'?>">
                        <button class="btn btn-sm btn-warning">
                            <i class="fa fa-backward"></i>&nbsp;Back</button>
                    </a>
                </li>
            </ol>
        </nav> 
        
    </div>
</div>


<div class="panel panel-info panel-form">
    <div class="tab-content">
        <div class="card-body">
            <table class="table table-hover text-center tab1">
                <thead>
                    <tr style="background-color: #136a6f; color: #fff;">
                        <td width="15%">Circle Name</td>
                        <td width="15%">No of Pattadar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $service = DHARITREE;
                        $param = basename($_SERVER['REQUEST_URI']);

                        $arr = $service.$param;

                        $cirwise = $circlePattadarCount->result();
                        $circle = json_decode($cirwise[0]->circlewise_json);
                        $cir = $circle->{$arr};
                        $cir_pattadar = $cir->pattadar;

                        foreach($cir_pattadar as $key=>$row) :
                    ?>
                        <tr>
                            <td><?= $this->utilityclass->cir_name($row->dist_code,$row->subdiv_code,$row->cir_code) ?></td>
                            <td><?= $row->pattadar ?></td>
                        </tr>
                    <?php //$key++; 
                endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>

<script type="text/javascript">
    $(".tab1").DataTable({
        dom: 'Bfrtp',
        buttons: [
            'excel',
        ]
    });
</script>
