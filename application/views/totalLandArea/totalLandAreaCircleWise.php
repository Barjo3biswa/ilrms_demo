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
                <li class="breadcrumb-item font-weight-bold active" aria-current="page">Circle Wise</li>
            </ol>
        </nav>        
    </div>
    <div class="col-lg-2 pull-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3 text-white">
                <li class="breadcrumb-item font-weight-bold">
					<?php if(in_array(basename($_SERVER['REQUEST_URI']), BARAK_VALLEY)): ?>
                    		<a href="<?= base_url().'total-land-area-barak-valley-district-wise'?>">
						<?php else: ?>
							<a href="<?= base_url().'total-land-area-brahmaputra-valley-district-wise'?>">
						<?php endif; ?>
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
			<?php  $service = DHARITREE;
                        $param = basename($_SERVER['REQUEST_URI']);

                        $arr = $service.$param;

                        $cirwise = $circleLandAreaCount->result();
                        $circle = json_decode($cirwise[0]->circlewise_json);
                        $cir = $circle->{$arr};
                        $cir_dag = $cir->dag;
			?>
            <table class="table table-hover text-center tab1">
                <thead>
                    <tr style="background-color: #136a6f; color: #fff;">
						<td width="10%">Sl No.</td>
                        <td width="15%">Circle Name</td>
                        <td width="10%">Bigha</td>
                        <td width="15%">Katha</td>
                        <td width="15%">Lessa</td>
						<?php if(in_array($cir_dag[0]->dist_code, BARAK_VALLEY)): ?>
                        <td width="15%">Ganda</td>
                        <td width="15%">Kranti</td>
						<?php endif; ?>
						<td width="15%">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($cir_dag as $key=>$row) :
                    ?>
                        <tr>
							<td><?= ++$key ?></td>
                            <td><?= $this->utilityclass->cir_name($row->dist_code,$row->subdiv_code,$row->cir_code) ?></td>
                            <td><?= round($row->bigha,2) ?></td>
                            <td><?= round($row->katha,2) ?></td>
                            <td><?= round($row->lessa,2) ?></td>
							<?php if(in_array($row->dist_code, BARAK_VALLEY)): ?>
                            <td><?= round($row->ganda,2) ?></td>
                            <td><?= round($row->kranti,2) ?></td>
							<?php endif; ?>
							<td align="center">
								<a href="<?= base_url().'total-land-area-lot-wise?dist_code='.$row->dist_code.'&subdiv='.$row->subdiv_code.'&cir_code='.$row->cir_code?>">
									<button type="button" class="btn btn-info btn-sm">
										<i class="fa fa-eye"></i>&nbsp;View
									</button>
								</a>
							</td>
                        </tr>
                    <?php //$key++; 
                endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/datatables/buttons.dataTables.min.css">
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>

<script type="text/javascript">
	$(".tab1").DataTable({
		dom: 'Bfrtp',
		pageLength: 50,
		buttons: [
			'pageLength',
			'excel'
		]
	});
</script>
