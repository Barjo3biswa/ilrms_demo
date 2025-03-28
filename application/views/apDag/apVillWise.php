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
                <li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'dashboard'?>">Annual Patta Dags</a></li>
                <li class="breadcrumb-item font-weight-bold active" aria-current="page">Village Wise</li>
            </ol>
        </nav>        
    </div>
    <div class="col-lg-2 pull-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3 text-white">
                <li class="breadcrumb-item font-weight-bold">
                    <a href="<?= base_url().'ap-dags-lot-wise'?>">
                        <button class="btn btn-sm btn-warning">
                            <i class="fa fa-backward"></i>&nbsp;Back</button>
                    </a>
                </li>
            </ol>
        </nav> 
        
    </div>
</div>
<div class="panel panel-info panel-form">
    <!-- <div class="panel-heading bg-warning text-center">
        <h3 class="panel-title">
            <u>
                Village Land Bank - (Pending-List)
                <br>Circle - <?php //echo $this->utilityclass->getCircleName($dist_code,$subdiv_code,$circle_code); ?>,
            </u>
        </h3>
    </div> -->
    <div class="tab-content">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead>
                    <tr style="background-color: #136a6f; color: #fff;">
                        <td width="15%">Village Name</td>
                        <td width="15%">No of Dag(s)</td>
                        <td style="text-align: center; width: 15%">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Kamrup</td>
                        <td>10</td>
                        <td align="center">
                            <!-- <a href="<?php //echo base_url().'number-of-dags-village-wise'?>">
                                <button type="button" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>&nbsp;View
                                </button>
                            </a> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- land bank details add modal  -->
<?php //include 'lb_view_form.php'; ?>
<!-- <script src="<?php //echo base_url(); ?>application/views/js/land_bank/land_bank_co.js"></script> -->