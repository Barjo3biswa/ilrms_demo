<style type="text/css">
	.div_dash {
		border: 1px solid rgba(0, 0, 0, 0.125);
		margin: 10px;
		border-radius: 5px 5px;
		background: linear-gradient(to right, #7b4397, #dc2430);
	}

	.div_inner {
		padding: 10px;
	}

	.purecounter {
		font-weight: bold;
		font-size: 25px;
		color: #fff;
		padding-left: 30px;
	}

	.purecounter p {
		margin-bottom: 0px;
	}

	.title {
		font-size: 18px;
		color: #fff;
	}

	.div_dash:hover {
		/*background: yellow;*/
		transform: scale(1.05);
	}

	.card-body{  background: #7B4397; /* fallback for old browsers */
  		background: -webkit-linear-gradient(to right, #7B4397, #DC2430); /* Chrome 10-25, Safari 5.1-6 */
  		background: linear-gradient(to right, #7B4397, #DC2430); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */);}
  	#circle {
		background: #0F546A;
		border-radius: 30%;
		padding: 7px !important;
		font-weight: bold;
		font-size: 2em;
    }
    .btn-success:hover{
        background-color:#086320;
        border-color:#086320;
    }

	.card{
		margin-bottom : 0px;
	}
</style>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>

<div class="p-2 bg-success text-center text-white h5 shadow-sm border border-white rounded">
	<b>Commission-Details(Mouza : <?=$this->utilclass->getMouzaName($this->session->userdata('dist_code'),$this->session->userdata('subdiv_code'),$this->session->userdata('cir_code'),$this->session->userdata('mouza_pargona_code'))?>)</b>
</div>

<div class="container-fluid">
  	<div class="col-lg-12 text-center" style="border:3px solid #96907E; border-radius:5px">
		<div class="bg-dark text-white h6 p-3" style="margin:0px;">
			DEMAND SATISFIED YEAR (UP-TO) : <span class="text-danger"><?=$demand_statisfied_year?></span>
		</div>
	</div>
</div>


<div class="container-fluid">
  <div class="col-lg-12 mt-2  p-3" style="border:3px solid #96907E; border-radius:5px">
    <div class="row ">		
        <div class="col-lg-6">
          	<div class="card">
                <div class="card-body text-white">
					<h5>
						Total Amount Received: <kbd id='square'> RS <?=$total_amount?></kbd>
					</h5>					
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body text-white">
                  	<h5>
				  		Total Commision Received: <kbd id='square'>RS <?=$total_commission?></kbd>
				  	</h5>                  	
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid form-top mb-5">
    <div class="row">
        <div class="col-lg-12 ">
            <form id="commissionDetailsForm" method="post" action="<?php echo base_url() . 'index.php/EkhajanaMouzadarCommissionController/commisionReport' ?>">
            	<div class="col-lg-12 col-lg-offset-1">
                <div class="panel panel-info mt-3">
                    <div style="border:2px solid grey;" class="shadow-lg bg-white">   
                        <div class="panel-heading bg-dark text-center">
                            <h6 class="panel-title text-white p-2">
                                SELECT THE DATE RANGE TO VIEW THE COMMISION DETAILS PATTA WISE 
                            </h6>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right " style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            DATE(FROM-DATE)<span class="text-danger h4">*</span>
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <input autocomplete="off" class="form-control stdate" id="commission_start_date" type="text" name="start_date" placeholder="dd-mm-yyyy" style="width: 85%">
                                        <span class="help-block">commission start from date</span>
                                    </div>
                                </div>                    
                            </div>
                        </div> 
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            DATE(TO-DATE)<span class="text-danger h4">*</span>
                                        </label>
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <input autocomplete="off" class="form-control stdate" id="commission_end_date" type="text" name="to_date" placeholder="dd-mm-yyyy" style="width: 85%">
                                        <span class="help-block">commission upto date</span>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                        <hr style="border-bottom: 2px solid #000;">
                        <div class="row">
                            <div class="col-lg-12 text-center mb-3">
                                <button type="submit" name="AMDANISubmit" class="btn btn-success" onclick="amdaniReportFormDetailsSubmit()"><i class='fa fa-check'></i>&nbsp;<?php echo $this->lang->line('submit_button'); ?></button>
                                <button type="reset" name="AMDANISu" class="btn btn-primary"><i class='fa fa-refresh'>&nbsp;</i><?php echo $this->lang->line('reset'); ?></button>
                                <a href="<?php echo base_url(); ?>index.php/Home/dashboard" class="btn btn-danger">
                                    <i class="fa fa-arrow-left"></i>&nbsp;<?php echo $this->lang->line('back_to_main_menu'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

<script>
    var baseurl = '<?php echo base_url();?>';
    $(document).ready( function () {
        $('#commission_start_date').datepick({dateFormat: 'yyyy-mm-dd'});
        $('#commission_end_date').datepick({dateFormat: 'yyyy-mm-dd'});
    });

	function amdaniReportFormDetailsSubmit(){
        event.preventDefault();
		var form_date = $('#commission_start_date').val();
		if(form_date == '' || form_date == null){
			alert("Please Select From-Date..!");
			return;
		}
		var to_date = $('#commission_end_date').val();
		if(to_date == '' || to_date == null){
			alert("Please Select To-Date..!");
			return;
		}
		//****************************************/
		//testing
		//alert("form date is " + form_date);		
		//alert("end date is " + to_date);
		//alert(formdata);
		//****************************************/
		$('#commissionDetailsForm').submit();
    }

</script>




