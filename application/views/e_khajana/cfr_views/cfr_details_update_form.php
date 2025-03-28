<style>
    #all_patta_table {
        overflow-x: auto;
        max-height: 400px; /* Adjust as needed */
        overflow-y: auto;
    }

    #land_details_table th,
    #land_details_table td {
        min-width: 150px;
        word-wrap: break-word;
        white-space: normal; /* Allow text to wrap inside input fields */
    }

    #land_details_table input[readonly] {
        background-color: #f9f9f9; /* Optional: subtle background for readonly fields */
        border: none; /* Optional: remove border if desired */
    }

    #land_details_table td div {
        font-size: 14px;
        color: #333;
        word-wrap: break-word;
        white-space: normal;
    }
    
    .heading_first_color{
        background: linear-gradient(180deg, rgba(163,7,36,0.7959558823529411) 0%, rgba(166,33,58,0.8239670868347339) 88%, rgba(226,9,27,0.6783088235294117) 100%);;
    }
    .heading_second_color{
        background: linear-gradient(180deg, rgba(7,78,163,0.7959558823529411) 0%, rgba(33,166,149,0.8239670868347339) 88%, rgba(3,101,96,0.6783088235294117) 100%);;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url('css/select2.min.css'); ?>">
<script src="<?php echo base_url('js/select2.min.js'); ?>"></script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/index'?>">CFR-INDEX</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">CFR DETAILS UPDATE FORM</li>
  </ol>
</nav>
<input type="hidden" value="<?=base_url()?>" id="base_url" name="base_url">
<div class="container-fluid form-top login mt-5">
    <div class="col-lg-10 offset-1">
        <div class="panel mt-5 shadow-lg">
            <div class="panel-body">
                <h5 class="heading_first_color p-2 text-white shadow mt-2 text-center" style="margin-bottom:0px!important;">
                    CFR DETAILS UPDATE FORM
                </h5>
                <h6 class="heading_second_color p-2 text-white shadow text-center">
                    <?php echo $this->lang->line('district')?>: <?= $district_name?>,
                    <?php echo $this->lang->line('subdivision')?>: <?= $subdiv_name?>,
                    <?php echo $this->lang->line('circle')?>: <?= $circle_name?>,
                    Mouza: <?= $mouza_name?>
                </h6>
                <div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 150px;"></div>
                <form id="cfr_data">
                    <input type="hidden" value="<?=$dist_code?>" id="dist_code" name="dist_code">
                    <input type="hidden" value="<?=$subdiv_code?>" id="subdiv_code" name="subdiv_code">
                    <input type="hidden" value="<?=$cir_code?>" id="cir_code" name="cir_code">
                    <input type="hidden" value="<?=$mouza_pargona_code?>" id="mouza_pargona_code" name="mouza_pargona_code">
                    <input type="hidden" value="<?=$mouza_name?>" id="mouza_name" name="mouza_name">
                    <div class="row mb-3">
                        <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                            <?php echo "CFR Book Number"?>
                            <span class="text-danger">*</span>
                        </div>
                        <div class="col-sm-4">
                            <?php /*
                            <input type="number" class="form-control" name="book_no" id="book_no" autocomplete="off" placeholder="Enter CFR Book Number">
                            */?>
                            <select class="js-single js-states form-control" id="book_no" onchange="" name="location" name="book_no">
                                <option value="00" selected>-SELECT-BOOK-NUMBER-</option>  
                                <?php foreach ($approvedCfrBooksList as $cfr_book):?>
                                    <option value="<?=$cfr_book->cfr_book_number?>">
                                        <?=$cfr_book->cfr_book_number?>
                                    </option>
                                <?php endforeach;?>     
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                            <?php echo "CFR Page Number"?>
                            <span class="text-danger">*</span>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="page_no" id="page_no" autocomplete="off" placeholder="Enter CFR Page Number">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                            CFR CARBON COPY
                            <span class="text-danger">*</span>
                        </div>
                        <div class="col-sm-4">
                            <input type="file" class="form-control-file" id="uploadFile1" name="fileUpload" style="width: 100%">
                            <small class="form-text text-danger font-weight-bold" style="font-weight:bold">
                                (NOTE: Only 'pdf', 'jpeg', 'jpg', and 'png' files are allowed. Maximum file size: 2MB.)
                            </small>
                        </div>
                    </div>
                    <hr>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-4">
                                <label style="font-weight:bold;">SELECT LOT NO<span class="text-danger">*</span></label>
                                <select class="js-single js-states form-control" id="lot_no" required name="lot_no" onchange="lotOnChange()">
                                    <option disabled selected>--LOT-NAME--</option>
                                    <?php foreach ($lot_list as $lot):?>
                                        <option value="<?=$lot->lot_no?>"><?=$lot->loc_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label style="font-weight:bold;">SELECT VILLAGE<span class="text-danger">*</span></label>
                                <select class="js-single js-states form-control" id="village" required name="village" onchange="VillageOnChange()">
                                    <option value="00" selected>--VILLAGE--</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label style="font-weight:bold;">SELECT PATTA TYPE<span class="text-danger">*</span></label>
                                <select class="js-single js-states form-control" id="patta_type_code" required name="patta_type_code" onchange="PattaTypeOnChange()">
                                    <option value="00" selected>--PATTA-TYPE--</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <label style="font-weight:bold;">SELECT PATTA NUMBER<span class="text-danger">*</span></label>
                                <select class="js-single js-states form-control" id="patta_no" required name="patta_no" onchange="PattaNumberOnChange()">
                                    <option value="00" selected>--PATTA-NUMBER--</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label style="font-weight:bold;">SELECT(কাৰ পৰা পোৱা হল)<span class="text-danger">*</span></label>
                                <select class="js-single js-states form-control" id="pdar_id_kpph" required name="pdar_id_kpph" onchange="pattadarKPPHonChnage()">
                                    <option value="00" selected>--কাৰ পৰা পোৱা হল--</option>
                                </select>
                                <div id="pdar_id_kpph_name_container" class="mt-3"></div>
                            </div>
                            <div class="col-4">
                                <label style="font-weight:bold;">SELECT(কাৰ বাবে পোৱা হল)<span class="text-danger">*</span></label>
                                <select class="js-single js-states form-control" id="pdar_id_kbph" required name="pdar_id_kbph" onchange="pattadarKBPHonChange()">
                                    <option value="00" selected>--কাৰ বাবে পোৱা হল--</option>
                                </select>
                                <div id="pdar_id_kbph_name_container" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="mt-3" id="add_more_buuton" style="display:none">
                            <button type="button" class="btn btn-success btn-sm" onclick="onClickAddPatta()"><i class="fa fa-plus"></i>ADD MORE PATTA</button>
                        </div>                        
                    </center>
                </form>
            </div>
            <hr>
            <form id="table_data_form">
                <!-- diplaying property details -->
                <div class="card-body" id="all_patta_table" style="display: none;">
                    <div style="overflow-x: auto; white-space: nowrap; max-height: 400px; overflow-y: auto;">
                        <table class="table" id="land_details_table">
                            <thead>
                                <tr class="text-white bg-info">
                                    <th scope="col">Book No</th>
                                    <th scope="col">Page No</th>
                                    <th scope="col">Mouza</th>
                                    <th scope="col">Lot</th>
                                    <th scope="col">Village</th>
                                    <th scope="col">Patta-Type</th>
                                    <th scope="col">Patta No</th>
                                    <th scope="col">কাৰ পৰা<br>পোৱা হল</th>
                                    <th scope="col">কাৰ বাবে<br>পোৱা হল</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be dynamically populated -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            <center>
                <div class="mt-2 mb-4" id="finalSubmit_btn" style="display:none">
                    <button type="button" class="btn btn-primary btn-sm mb-4" onclick="finalSubmit()"><i class="fa fa-plus"></i>Submit All details</button>
                </div>
            </center>
        </div>
    </div>
</div>

<script src="<?php echo base_url('js/ekhajana/ekhajana_cfr.js'); ?>"></script>
