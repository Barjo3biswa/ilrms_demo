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
                <li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'dashboard'?>">Total Land Area</a></li>
                <li class="breadcrumb-item font-weight-bold active text-red" 
                aria-current="page">District Wise</li>
            </ol>
        </nav>        
    </div>
    <div class="col-lg-2 pull-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3 text-white">
                <li class="breadcrumb-item font-weight-bold">
                    <a href="<?= base_url().'dashboard'?>">
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

            <table class="table table-hover text-center" id="tab1">
                <thead>
                    <tr style="background-color: #136a6f; color: #fff;">
                        <td width="15%">District Name</td>
                        <td width="15%">Bigha</td>
                        <td width="15%">Katha</td>
                        <td width="15%">Lessa</td>
                        <td width="15%">Ganda</td>
                        <td width="15%">Kranti</td>
                        <td style="text-align: center; width: 15%">Action</td>
                    </tr>
                </thead>
                <tbody>

                    <?php
//                        $districtwise = $districtLandAreaCount->result();
//                        $district = json_decode($districtwise[0]->districtwise_json);
                        foreach($districtLandAreaCount as $key=>$row) :
                    ?>
                        <tr>
                            <td><?= $this->utilityclass->dist_name($row->district_code) ?></td>
                            <td><?= round($row->district_wise_dag_area_bigha,2) ?></td>
                            <td><?= round($row->district_wise_dag_area_katha,2) ?></td>
                            <td><?= round($row->district_wise_dag_area_lessa,2) ?></td>
                            <td><?= round($row->district_wise_dag_area_ganda,2) ?></td>
                            <td><?= round($row->district_wise_dag_area_kranti,2) ?></td>
                            <td align="center">
                                <a href="<?= base_url().'total-land-area-circle-wise/'.$row->district_code?>">
                                    <button type="button" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>&nbsp;View
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
    $("#tab1").DataTable({
        dom: 'Bfrtp',
        buttons: [
            'excel',
        ]
    });
</script>
