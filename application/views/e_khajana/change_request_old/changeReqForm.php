<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class='container ' style="margin-top:20px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaArrearController/index'?>">index</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">Pre-Update-Arrear-Form</li>
  </ol>
</nav>
<style>
    .arrear{display:flex;gap:8px;}
    .showTotalRevenue{width:100%;padding:10px;box-sizing:border-box;display:flex;justify-content:space-between;
        gap: 10px;font-size: 18px;font-weight: bold;color: green;text-align: center;}
    .showTotalRevenue div{flex:1 1;background:#f7e9e9;padding:7px;border-radius:5px;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;}
    .showTotalRevenue div p{margin-bottom:4px;}
    .showTotalRevenue div span{color:red;}
</style>

<div class="container-fluid form-top login">
    <div class="col-lg-12 col-lg-offset-2">
        <div class="card mt-2">
            <div class="card-body">
                <div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>
                    <h5 class="p-2 text-white shadow mt-2 text-center" style="margin-bottom:0px!important;background-color:#0d5218">
                        SELECT LOCATION FOR CHANGE REQUEST
                    </h5>
                    <h6 class="p-2 text-white shadow text-center" style="background-color:#176363">
                        <?php echo $this->lang->line('district')?>: <?= $dist_name?>,
                        <?php echo $this->lang->line('subdivision')?>: <?= $subdiv_name?>,
                        <?php echo $this->lang->line('circle')?>: <?= $cir_name?>,
                        Mouza: <?= $mouza_name?>
                    </h6>
                    <div class="card-text mt-2 lm-report">
                        <form class='form-horizontal' id ="change_req_update_form" method="post">
                            <input type='hidden' name="dist_code" value="<?=$dist_code?>" id="dist_code">
                            <input type='hidden' name="subdiv_code" value="<?=$subdiv_code?>" id="subdiv_code">
                            <input type='hidden' name="cir_code" value="<?=$cir_code?>" id="cir_code">
                            <input type='hidden' name="mouza_pargona_code" value="<?=$mouza_code?>" id="mouza_code">
                            <div class="form-group">
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                        <?php echo $this->lang->line('vill_town')?>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="js-single js-states form-control" style="width: 85%" id="location" 
                                        onchange="villageOnChange1()" name="location">
                                            <option value="00" selected>-ALL-VILLAGE-</option>  
                                            <?php foreach ($village_list as $village):?>
                                                <option value="<?=$village->uuid?>|<?=$village->vill_townprt_code?>|<?=$village->lot_no?>"><?=$village->loc_name?>(<?=$village->locname_eng?>)
                                                </option>
                                            <?php endforeach;?>     
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                        <?php echo $this->lang->line('patta_type')?>
                                    </div>
                                    <div class="col-sm-4">
                                    <select class="js-single js-states form-control" style="width: 85%" onchange="getPattaNo1()" 
                                        id="patta_type_code" name="patta_type_code">
                                            <option value="" selected>-ALL-PATTA-TYPE-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                        <?php echo $this->lang->line('patta_no')?>
                                    </div>
                                    <div class="col-sm-4"> 
                                    <select class="js-single js-states form-control" style="width: 85%" id="patta_numbers" name="patta_no"
                                    onchange="getDagNo()">
                                            <option value="" selected>-ALL-PATTA-NO-</option>
                                    </select>                             
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                        Dag No
                                    </div>
                                    <div class="col-sm-4"> 
                                    <select class="js-single js-states form-control" style="width: 85%" id="dag_numbers" name="dag_no" onchange="getExistingLandClass()">
                                            <option value="" selected>-ALL-DAG-NO-</option>
                                    </select>                             
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                        Existing Land Class 
                                    </div>
                                    <div class="col-sm-4"> 
                                    <select class="js-single js-states form-control" style="width: 85%" id="existing_land_class" name="existing_land_class">
                                            <option value="" selected>-EXISTING-LAND-CLASS-</option>
                                    </select>                             
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                        Land Class Used As 
                                    </div>
                                    <div class="col-sm-4"> 
                                    <select class="js-single js-states form-control" style="width: 85%" id="proposed_land_class" name="proposed_land_class">
                                            <option value="" selected>-LAND-CLASS-USED-AS-</option>
                                            <?php foreach ($land_classes as $land_class):?>
                                                <option value="<?=$land_class->class_code?>">
                                                    <?=$land_class->land_type?>(<?=$land_class->landtype_eng?>)
                                                </option>
                                            <?php endforeach;?>    
                                    </select>                             
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                        Remark 
                                    </div>
                                    <div class="col-sm-8"> 
                                        <textarea name="change_req_rmk" style="width:41%" id="change_req_rmk"></textarea>                            
                                    </div>
                                </div>
                                <div class="row mb-3">
                                </div>
                                <hr>
                                <!-- validation-errors-div -->
                                <div class="col-lg-12" id="chg_req_form_validation_error_div" style="display:none;">
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <strong class="text-center" style="color:red !important"
                                            id="chg_req_form_validation_error_msg">
                                        </strong>
                                    </div>
                                </div>
                                <!-- validation-error-div-end -->
                                <div class="text-center">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4"></div>
                                            <div class="col-4" style="text-align:center">
                                                <div class="col-sm-12 col-lg-offset-6" style="display:flex" >
                                                    <button class="btn btn-sm text-white" onclick="submitChangeReq()" style="padding: 5px!important;font-size: 14px;font-weight: bold;background-color:#1e5727"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                            SUBMIT
                                                    </button>
                                                    &nbsp;&nbsp;
                                                    <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarChangeNoticeController/index' ?>" 
                                                        role="button" class="btn btn-danger text-white">
                                                        <i class='fa fa-home'></i>&nbsp;Back</button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('js/ekhajana/ekhajana_arrear.js'); ?>"></script>


<script>
$(document).ready(function() {
    $('.js-single').select2();
})

//function village on change 
function villageOnChange1(){
    //***************select-reset*************/
    $('#patta_type_code').empty();
    $('#patta_type_code').append('<option value="00" selected>-ALL-PATTA-TYPE-</option>');
    $('#patta_numbers').append('<option value="00" selected>-ALL-PATTA-NO-</option>');
    $('#dag_numbers').empty();
    $('#dag_numbers').append('<option value="00" selected>-ALL-DAG-NO-</option>');
    $('#existing_land_class').empty();
    $('#existing_land_class').append('<option value="00" selected>-EXITSTING-LAND-CLASS-</option>');
    //***************************************/
    var mouza_code = $('#mouza_code').val();
    var location = $('#location').val();
    //alert(location);
    var explodedString = location.split("|");
    vill_uuid =explodedString[0];
    vill_townprt_code= explodedString[1];
    lot_no =explodedString[2];
    if(vill_uuid == '00'){
        return;
    }
    $.ajax({ 
        url: baseurl + "EkhajanaArrearController/getPattaTypes",
        type: 'POST',
        data: {'mouza_code':mouza_code, 'vill_uuid':vill_uuid, 'lot_no':lot_no, 'vill_townprt_code':vill_townprt_code},
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBoxEK'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {      
            for(var i=0; i<data.length; i++) {
                $('#patta_type_code').append('<option value="'+data[i].type_code+'">'+data[i].patta_type+'('+ data[i].pattatype_eng+')</option>');
            }
            $.unblockUI();
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }  
    });
    $.unblockUI(); 
}

//getting patta no
function getPattaNo1(){
    //***************select-reset*************/
    $('#patta_numbers').empty();
    $('#pattadars').empty();
    $('#patta_numbers').append('<option value="00" selected>-ALL-PATTA-NO-</option>');
    $('#dag_numbers').empty();
    $('#dag_numbers').append('<option value="00" selected>-ALL-DAG-NO-</option>');
    $('#existing_land_class').empty();
    $('#existing_land_class').append('<option value="00" selected>-EXITSTING-LAND-CLASS-</option>');
    //***************************************/
    var location = $('#location').val();
    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_code = $('#mouza_code').val();
    var explodedString = location.split("|");
    vill_uuid =explodedString[0];
    vill_townprt_code= explodedString[1];
    lot_no =explodedString[2];
    var patta_type_code = $('#patta_type_code').val();
    if(patta_type_code == '00'){
        return;
    }
    if(location == "" || patta_type_code == ""){
        alert("Please Select Village And Patta-Type..!!");
        return;
    }
    $.ajax({
        url: baseurl + "EkhajanaArrearController/getPataNumbers",
        type: 'POST',
        data: {'vill_uuid' : vill_uuid,'dist_code' : dist_code,'subdiv_code' : subdiv_code,'cir_code' : cir_code,'mouza_pargona_code' : mouza_code, 'patta_type_code' : patta_type_code},
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBoxEK'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {      
            if(data.length === 0){
                alert("No Patta Found ..!, Please Select Different Patta Type Or Village!");
                return;
            }else{
                for(var i=0; i<data.length; i++) {
                    $('#patta_numbers').append('<option value="'+data[i].patta_no+'">'+data[i].patta_no+'</option>');
                }
                $.unblockUI();  
            }            
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }  
    });
    $.unblockUI(); 
}

function getDagNo(){
    $('#existing_land_class').empty();
    $('#existing_land_class').append('<option value="00" selected>-EXITSTING-LAND-CLASS-</option>');
    var location = $('#location').val();
    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_code = $('#mouza_code').val();
    var explodedString = location.split("|");
    vill_uuid =explodedString[0];
    vill_townprt_code= explodedString[1];
    lot_no =explodedString[2];
    var patta_type_code = $('#patta_type_code').val();
    var patta_no = $('#patta_numbers').val();
    //************************************************************/
    //testing 
    console.log(dist_code+subdiv_code+cir_code+mouza_code+lot_no+vill_townprt_code+patta_type_code+patta_no);
    //************************************************************/
    $.ajax({
        url: baseurl + "EkhajanaMouzadarChangeNoticeController/getDagNumbers",
        type: 'POST',
        data: {'vill_uuid' : vill_uuid,'dist_code' : dist_code,'subdiv_code' : subdiv_code,'cir_code' : cir_code,'mouza_pargona_code' : mouza_code, 
               'lot_no':lot_no, 'vill_townprt_code':vill_townprt_code, 'patta_type_code' : patta_type_code,'patta_no':patta_no},
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBoxEK'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {      

            if(data.length === 0){
                alert("No Dag Found ..!, Please Select Different Patta No!");
                return;
            }else{
                for(var i=0; i<data.length; i++) {
                    $('#dag_numbers').append('<option value="'+data[i].dag_no+'">'+data[i].dag_no+'</option>');
                }
                $.unblockUI();  
            }            
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }  
    });
    $.unblockUI();
}

function getExistingLandClass(){
    var location = $('#location').val();
    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_code = $('#mouza_code').val();
    var explodedString = location.split("|");
    vill_uuid =explodedString[0];
    vill_townprt_code= explodedString[1];
    lot_no =explodedString[2];
    var patta_type_code = $('#patta_type_code').val();
    var patta_no = $('#patta_numbers').val();
    var dag_no = $('#dag_numbers').val();
    //************************************************************/
    //testing 
    console.log(dist_code+subdiv_code+cir_code+mouza_code+lot_no+vill_townprt_code+patta_type_code+patta_no+dag_no);
    //************************************************************/    
    $.ajax({
        url: baseurl + "EkhajanaMouzadarChangeNoticeController/getExistingLandClass",
        type: 'POST',
        data: {'vill_uuid' : vill_uuid,'dist_code' : dist_code,'subdiv_code' : subdiv_code,'cir_code' : cir_code,'mouza_pargona_code' : mouza_code, 
               'lot_no':lot_no, 'vill_townprt_code':vill_townprt_code, 'patta_type_code' : patta_type_code,'patta_no':patta_no,
                'dag_no': dag_no},
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBoxEK'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {      
            if(data.length === 0){
                alert("No Land Class Found ..!, Please Select Different Dag No!");
                return;
            }else{
                for(var i=0; i<data.length; i++) {
                    $('#existing_land_class').append('<option value="'+data[i].land_class_code+'">'+data[i].land_type+'('+data[i].landtype_eng+')</option>');
                }
                $.unblockUI();  
            }            
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }  
    });
    $.unblockUI();
}

function submitChangeReq(){
    event.preventDefault();
    $('#chg_req_form_validation_error_msg').empty();
    $('#chg_req_form_validation_error_div').hide();
    var location = $('#location').val();
    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_code = $('#mouza_code').val();
    var explodedString = location.split("|");
    vill_uuid =explodedString[0];
    vill_townprt_code= explodedString[1];
    lot_no =explodedString[2];
    var patta_type_code = $('#patta_type_code').val();
    var patta_no = $('#patta_numbers').val();
    var dag_no = $('#dag_numbers').val();
    var existing_land_class = $('#existing_land_class').val();    
    var proposed_land_class = $('#proposed_land_class').val();
    var change_req_rmk = $('#change_req_rmk').val();
    // alert(change_req_rmk);
    // alert(existing_land_class);
    // alert(proposed_land_class);
    $.ajax({
        url: baseurl + "EkhajanaMouzadarChangeNoticeController/submitChangeReq",
        type: 'POST',
        data: {'vill_uuid' : vill_uuid,'dist_code' : dist_code,'subdiv_code' : subdiv_code,'cir_code' : cir_code,'mouza_pargona_code' : mouza_code, 
               'lot_no':lot_no, 'vill_townprt_code':vill_townprt_code, 'patta_type_code' : patta_type_code,'patta_no':patta_no,
                'dag_no': dag_no, 'existing_land_class': existing_land_class, 'proposed_land_class': proposed_land_class,
                'change_req_rmk':change_req_rmk},
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBoxEK'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {       
            if(data.result == "validation_error"){
                alert("Validation Error..! Please Fill All The Details Before Submit..!");
                $('#chg_req_form_validation_error_div').show();
                for (let i = 0; i < data.msg.length; i++) {
                    $('#chg_req_form_validation_error_msg').append(data.msg[i]);
                }
                return;
                return;
            }

            if(data.result == 'SERVER-ERROR'){
                alert(data.msg);
            }else{
                alert(data.msg);
                window.location.href = baseurl + "/EkhajanaMouzadarChangeNoticeController/index";
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


                        
               
                            
                        
               
                        

    
