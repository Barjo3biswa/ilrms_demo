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

<div class="p-2 bg-success text-center text-white h5 shadow-sm border border-white rounded">
	<b>Bank-Details(Mouza : <?=$this->utilclass->getMouzaName($this->session->userdata('dist_code'),$this->session->userdata('subdiv_code'),$this->session->userdata('cir_code'),$this->session->userdata('mouza_pargona_code'))?>)</b>
</div>
<div class="container-fluid">
    <div class="row">	
        <div class="col-lg-3"></div>
        <div class="col-lg-6 mt-4  p-3" style="border:3px solid #96907E; border-radius:5px">
           
                <table class="table table-bordered table-dark">
                    <tbody>
                        <tr>
                            <td>ACCOUNT HOLDER NAME</td>
                            <td><?php if(($bank_details!= null)) echo $bank_details->account_name ?></td>
                        </tr>
                        <tr>
                            <td>ACCOUNT NUMBER</td>
                            <td><?php if(($bank_details!= null)) echo $bank_details->account_number ?></td>
                        </tr>
                        
                        <tr>
                            <td>BANK NAME</td>
                            <td><?php if(($bank_details!= null)) echo $bank_details->bank_name?></td>
                        </tr>
                        <tr>
                            <td>BRANCH NAME</td>
                            <td><?php if(($bank_details!= null)) echo $bank_details->branch_name?></td>
                        </tr>
                        <tr>
                            <td>IFSC CODE</td>
                            <td><?php if(($bank_details!= null)) echo $bank_details->ifsc_code?></td>
                        </tr>
                        <tr>
                            <td>ACCOUNT CODE</td>
                            <td><?php if(($bank_details!= null)) echo $bank_details->account_code?></td>

                            <?php if(!isset($bank_details->account_code) ||  $bank_details == null):?>
                                <input type="hidden" id="account_code" value="--"></input>
                            <?php else:?>
                                <input type="hidden" id="account_code" value="<?=$bank_details->account_code?>"></input>  
                            <?php endif;?>

                            <input type="hidden" id="dist_code" value="<?=$dist_code?>"></input>
                            <input type="hidden" id="subdiv_code" value="<?=$subdiv_code?>"></input>
                            <input type="hidden" id="cir_code" value="<?=$cir_code?>"></input>
                            <input type="hidden" id="mouza_pargona_code" value="<?=$mouza_pargona_code?>"></input>
                        </tr>
                    </tbody>
		</table>

                <?php if($bank_details->mouzadar_declare_yn != null):?>
                    <?php if($bank_details->mouzadar_declare_yn == 'Y'):?>
                        <span style="color:green;text-align:center"><h5><b>Acknowledged as Correct <i class="fa fa-check" aria-hidden="true"></i></b></h5></span>
                    <?php elseif($bank_details->mouzadar_declare_yn == 'N'):?>
                        <span style="color:red;text-align:center"><h5><b>Acknowledged as Incorrect <i class="fa fa-times" aria-hidden="true"></i></b></h5></span>
                    <?php endif;?>
                <?php endif;?>
                <?php if($bank_details->adc_verified_yn != null):?>
                    <?php if($bank_details->adc_verified_yn == 'Y'):?>
                        <span style="color:green;text-align:center"><h5><b>Verified By ADC <i class="fa fa-check" aria-hidden="true"></i></b></h5></span>
                    <?php elseif($bank_details->adc_verified_yn == null || $bank_details->adc_verified_yn==""):?>
                        <span style="color:red;text-align:center"><h5><b>Not Verified By ADC <i class="fa fa-times" aria-hidden="true"></i></b></h5></span>
                    <?php endif;?>
                <?php endif;?>

                <?php if(MOUZADAR_BANK_DETAILS_DECLARE ==1):?>
                    <?php if($declaration_submit == "" || $declaration_submit==null):?>
                        <!-- confirmation by mouzadar starts -->
                        <div class="">
                            <div class="form-check">
                                <input class="form-check-input mouzadar_declare" name ="mouzadar_declaration" type="radio" value="Y" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Yes all my details displayed above are correct to my Knowledge
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input mouzadar_declare" name ="mouzadar_declaration" type="radio" value="N" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Some of my details are incorrect
                                </label>
                                </div>
                            </div>
                            &nbsp;
                            <center>
                            <button class="btn btn-sm btn-success" onclick="SubmitDeclaration()"><i class="fa fa-arrow-right"></i>Submit</button>
                        
                            <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/index'?>" class="btn btn-sm btn-danger">Cancel</a>
                            </center>
                            <!-- confirmation by mouzadar ends -->
                    <?php endif?>
                <?php endif?>
        </div>
    </div>
</div>

<script>
    
    function SubmitDeclaration()
    {
        var baseurl = "<?php echo base_url() ?>"
        var account_code = $('#account_code').val();
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();

        var mouzadar_check = $('.mouzadar_declare:checked').val();
            $.ajax({
            url: baseurl + "/EkhajanaMouzadarBankDetailsController/updateDeclartion",
            type: 'POST',
            data: { 'dist_code':dist_code,'subdiv_code':subdiv_code,'cir_code':cir_code,'mouza_pargona_code':mouza_pargona_code,'account_code' : account_code, 'mouzadar_declare' : mouzadar_check},
            dataType: 'json',
            
            success: function (data) {      
                //*******************/
                if(data.result == 'SERVER-ERROR'){
                    $.unblockUI();
                    alert(data.msg);
                    return;

                }else if(data.result == 'SUCCESS'){
                    $.unblockUI();
                    Swal.fire({
                        title: 'Details Updated Successfully!',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Home'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = baseurl + "/EkhajanaMouzadarBankDetailsController/index";
                        }
                    })
                    return;
                }
            },
            error: function (jqXHR, exception) {
                $.unblockUI();
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }  
        });
        $.unblockUI();
    }
</script>



