<style>
@media only screen and (max-width: 750px) {
    .label3 {
    margin-right:29rem;
  }
}

.content-div {
            display: none;
            /*justify-content: center;
            align-items: center;
            margin-top: 20px;*/
        }

.area-div {
            display: none;
        }

.remarkshow {
            display: none;  
        }

.revenue_div {
            display: none;  
        }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link href="<?php echo base_url(); ?>css/select2.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert2.min.css">
<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<!--links are added for jquery calendar-->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">    
    <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaAstController/index'?>">E-Khajana</a></li>
    <li class="breadcrumb-item font-weight-bold active" aria-current="page">Change Request</li>
  </ol>
</nav>
<form id='formAjaxPost'>
<div class="container-fluid form-top mb-5">
    <div class="row">
        <div class="col-lg-12 ">
          
            <div class="col-lg-12 col-lg-offset-1">
                <div class="panel panel-info mt-3">
                    <div style="border:2px solid grey;" class="shadow-lg bg-white">   
                        <div class="panel-heading bg-dark text-center">
                            <h5 class="panel-title text-warning p-2">
                                Change Request Form For Mouza : <?=$mouza_name?>
                            </h5>
                        </div>
                        <div class="panel-heading bg-primary text-center" style="margin-top:-10px;">
                            <h5 class="panel-title text-white p-1">
                                District: <?=$district_name?>,
                                Sub-division: <?=$subdiv_name?>, 
                                Circle: <?=$circle_name?>
                            </h5>
                        </div> 
                    
                        <!-- village-selection  -->
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            VILLAGE
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <select class="js-single js-states form-control" style="width: 85%" id="village_uuid" 
                                        onchange="villageOnChange()" name="village_uuid">
                                            <option value="00" selected>-ALL-VILLAGE-</option>  
                                            <?php foreach ($village_list as $village):?>
                                                <option value="<?=$village->uuid?>"><?=$village->loc_name?>(<?=$village->locname_eng?>)</option>
                                            <?php endforeach;?>     
                                        </select>
                                    </div>
                                </div>                    
                            </div>
                        </div>   
                        <!-- patta-type-selection  -->
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            PATTA TYPE
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <select class="js-single js-states form-control" style="width: 85%" onchange="getPattaNo()" 
                                        id="patta_type_code" name="patta_type_code">
                                            <option value="00" selected>-ALL-PATTA-TYPE-</option>
                                        </select>
                                    </div>
                                </div>                    
                            </div>
                        </div>  
                        <!-- patta-no-selection  -->
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            PATTA NO
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <select class="js-single js-states form-control" style="width: 85%"  onchange="getRevenueofPatta()" id="patta_numbers" name="patta_no">
                                            <option value="00" selected>-ALL-PATTA-NO-</option>
                                        </select>
                                    </div>
                                </div>                    
                            </div>
                        </div>

                        

                        <div class="row mt-3 remarkshow">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                           Remark
                                        </label>            
                                    </div>
                                    <div class="col-lg-6 text-left">
                                        <textarea class="form-control" name='remark' id='remark' placeholder="Enter your remark"></textarea> 
                                    </div>
                                </div>                    
                            </div>
                        </div>

                        <div class="area-div" id="area-div"><br>
                            <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                           Existing Revenue Details
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                    <table class="table table-bordered">
                                        <tbody id='dagarea'>
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>                    
                            </div>
                        </div>

                        </div>
                        <br>

                        <div class="row mt-3 revenue_div">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                           <?php echo $this->lang->line('proposed_land_revenue'); ?>
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <input type="text" class="numberonly form-control" placeholder="Amount" id="P_land" name="P_land_rev">
                                    <span class="text-danger error P_land_rev_error"></span> 
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            <?php echo $this->lang->line('proposed_local_tax'); ?>
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <input type="text" class="numberonly form-control" placeholder="Amount" id="p_loc_tax" name="p_local_tax">
                                    <span class="text-danger error p_local_tax_error"></span>
                                    </div>
                                </div>  

                                                   
                            </div>
                        </div>


                
                        <!-- validation-errors-div -->
                        <div class="col-lg-12" id="ekAr_error_div" style="display:none;margin-top:1rem">
                            <div class="card-header h5 bg-danger text-white text-center">
                                VALIDATION ERRORS 
                            </div>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <strong class="text-center" style="color:red !important" id="ekAr_error_div_validation_error_msg">
                                </strong>
                            </div>
                        </div>
                        <!-- validation-error-div-end -->
                        <hr style="border-bottom: 2px solid #000;">
                        <div class="row">
                            <div class="col-lg-12 text-center mb-3">
                                <!-- <button type="submit" name="AMDANISubmit" class="btn btn-success" onclick="amdaniReportFormDetailsSubmit()"><i class='fa fa-check'></i>&nbsp;<?php //echo $this->lang->line('submit_button'); ?></button> -->


                                <span id='loading'></span><span id='msg'></span>
                                <button type="submit" class="btn btn-sm btn-success"><i class='fa fa-check-square-o'></i> Forward</button>&nbsp;
                                <button type="reset" name="AMDANISu" class="btn btn-primary"><i class='fa fa-refresh'>&nbsp;</i><?php echo $this->lang->line('reset'); ?></button>
                                <a href="<?php echo base_url(); ?>index.php/home/index" class="btn btn-danger">
                                    <i class="fa fa-arrow-left"></i>&nbsp;<?php echo $this->lang->line('back_to_main_menu'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
         
        </div>
    </div>
       </form>

<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar_change_request.js'); ?>"></script>


<script type="text/javascript">
  $(document).ready(function(){
             
  $('#formAjaxPost').on('submit', function(event)
  {
    event.preventDefault();
    $('.error').html('');
    if($("#remark").val().trim().length < 1)
    {
      alert("Please Enter Your Remark");
      return; 
    }
    var formData = $(this).serialize();

    
    //console.log(formData);
        $.ajax({
            type        : 'POST', 
            url         : baseurl+'EkhajanaMouzadarChangeRequestController/revenuechangePost', 
            data        : formData, 
            dataType    : 'json', 
            encode      : true,
            beforeSend: function(){
                    $("#loading").html("Validating ...Please wait...");
                    $('.alert').hide();
                },
            success: function(data){
                console.log('hello1');
                if(data.result == 'SUCCESS'){
                    //console.log(data);
                    $("#loading").hide();
                    alert(data.msg);
                    $('#msg').html('<div class="alert alert-info text-center">' + data.msg + '</div>');
                    window.location.href = data.redirect_url;
                }else if(data.result =='SERVER-ERROR'){
                    $("#loading").hide();
                    $('.btn-block').show();
                    $('#msg').html('<div class="alert alert-danger text-center">' + data.msg + '</div>');
                }
            },
           
            error: function(errorData,data,err){
                // console.log(errorData);
                // console.log(errorData.responseJSON);
                // console.log(JSON.parse(errorData))
                $("#loading").hide();
                $('.btn-block').show();
                if(errorData.status == 403){
                    const errorInJson = errorData.responseJSON.errors;
                    if(Object.keys(errorInJson).length){
                        $.each(errorInJson, function(index, value){
                            $(`.${index}_error`).html(value);
                        });
                    }else{
                        $('.error_container').html('<div class="alert alert-danger text-center">Something went wrong. Please try again later.</div>');
                    }
                }
                else{
                    $('.error_container').html('<div class="alert alert-danger text-center">Something went wrong. Please try again later.</div>');
                }
            }
        });
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.js-single').select2();
})
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".numberonly").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        }); 
    });
    </script>