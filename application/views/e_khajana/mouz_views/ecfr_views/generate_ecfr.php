<div class="container-fluid form-top login">
    <div class="col-lg-12 col-lg-offset-2"> 
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="bg-dark p-2 text-warning shadow mt-2 text-center" style="margin-bottom:0px!important;">
                    GENERATION OF e-CFR
                </h5>
                <h6 class="bg-info p-2 text-white shadow text-center" style="margin-bottom:0px!important;">
                    <?php echo $this->lang->line('district')?>: <?= $dist_name?>,
                    <?php echo $this->lang->line('subdivision')?>: <?= $subdiv_name?>,
                    <?php echo $this->lang->line('circle')?>: <?= $cir_name?>,
                    Mouza: <?= $mouza_name?>
                </h6>
                <h6 class="bg-warning p-2 text-white shadow text-center">
                    NOTE: e-CFR CAN ONLY BE GENERATED AFTER THE APPLICATION IS FORWARDED BY MOUZADAR 
                </h6>
                <div class="card-text mt-5 lm-report">
                    <form class='form-horizontal' method="post" action="" id="generate_ecfr_form">
                        <input type='hidden' name="dist_code" value="<?=$dist_code?>" id="dist_code">
                        <input type='hidden' name="subdiv_code" value="<?=$subdiv_code?>" id="subdiv_code">
                        <input type='hidden' name="cir_code" value="<?=$cir_code?>" id="cir_code">
                        <input type='hidden' name="mouza_code" value="<?=$mouza_pargona_code?>" id="mouza_code">
                        <div class="form-group">
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                    LAND DETAILS<br>APPLICATION NO
                                </div>
                                <div class="col-sm-4"> 
                      				<input type="text" class="form-control" name="ld_application_no" id="ld_application_no" 
                                        placeholder="--LAND-DETAILS-APPLICATION-NO--" required ></div><size=4><b>                             
                                </div>
                            </div>
                            <div class="row mb-3">
                            <hr>
                            <div class="row" align="center" style="padding:10px;">
                                <div class="col-lg-12" align="center">
                                    <button type="button" class="btn btn-sm btn-success" onclick="generateECFR()">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                            VERIFY E-CFR
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                            HOME
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>
    var baseurl = '<?=base_url()?>'; 
    function generateECFR(){
        event.preventDefault();        
        var ld_application_no = $('#ld_application_no').val();
        if(ld_application_no == ""){
            alert("Kindly Enter The Land Details Application No..!");
            return;
        }
        var formdata = $('#generate_ecfr_form').serialize();
        $.ajax({
            url: baseurl + "/EkhajanaECFRController/submitECFR",
            type: 'POST',
            data: formdata,
            dataType: 'json',
            beforeSend: function () {
                console.log("Loader Code Display");
            },
            success: function (data) {     
                if(data.flag == 'N'){
                    $.unblockUI();
                    alert(data.msg);
                    return;

                }else if(data.flag == 'Y'){
                    $.unblockUI();
                    Swal.fire({
                        title: 'eCFR Details Submitted Successfully For The Land Application No('+ld_application_no+') !!',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'GENERATE'
                    }).then((flag) => {
                    if (flag.isConfirmed) {
                            location.href = baseurl + "/EkhajanaECFRController/printECFR?land_application_no="+ld_application_no;
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



                        
               
                            
                        
               
                        

    
