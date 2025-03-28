<style>
    .reza-card {
        background: #fff;
        border-radius: 2px;
        display: inline-block;
        margin: 1rem;
        position: relative;
        width: 100%;
    }
    .reza-card {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .reza-title{
        font-weight: bold;
        font-size: 18px;
        padding: 20px;
        color: #37474F;
    }
    .reza-body{
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 40px;
    }
    .badge{
        padding: 10px;
        font-size: 15px;
    }
    .buttPrimary {
        color: #FFF;
        background-color: #673AB7;
    }
    .buttInfo {
        color: #FFF;
        background-color: #03a9f4;
    }


    .rezaButt:hover {
        color: #0c0c0c;
    }
    .rezaButt{
        display: inline-block;
        position: relative;
        cursor: pointer;
        height: 35px;
        min-width: 150px;
        line-height: 35px;
        padding: 0 1.5rem;
        font-size: 15px;
        font-weight: 600;
        font-family: "Roboto", sans-serif;
        letter-spacing: 0.8px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        vertical-align: middle;
        white-space: nowrap;
        outline: none;
        border: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border-radius: 2px;
        transition: all 0.3s ease-out;
        /*box-shadow: 0 2px 5px 0 rgb(0 0 0 / 23%);*/
    }
    .rezaText {
        font-size: 16px;
    }

    .table>thead>tr>th {
        line-height: 2;

    }
    .table>tbody>tr>td {
        line-height: 2;

    }

    #files-area {
        width: 100%;
        margin: 0 auto;
    }
    .file-block {
        border-radius: 10px;
        background-color: rgba(144, 163, 203, 0.2);
        margin: 5px;
        color: initial;
        display: inline-flex;
    }
    .file-block > span.name {
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        width: max-content;
        display: inline-flex;
    }

    .file-delete {
        display: flex;
        width: 24px;
        padding-top: 3px;
        color: red;
        background-color: #6eb4ff00;
        font-size: large;
        justify-content: center;
        margin-right: 3px;
        cursor: pointer;
    }
    .card-subtitle{
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .rezaBR{
        margin-top: 15px;
    }
    body{
        background: linear-gradient(#dbe1e2, #faf2f2);
    }


    .reza-card .circle {
        border-radius: 3px;
        width: 100px;
        height: 100px;
        background: black;
        position: absolute;
        right: 0px;
        top: 0;
        background-image: linear-gradient(to top, #fbc2eb 0%, #a6c1ee 100%);
        border-bottom-left-radius: 170px;
    }
    .countNum{
        padding-left: 20px;
        padding-bottom: 10px;
        font-weight: bold;
        color: #7E57C2;
    }

</style>

<div class="row" style='padding: 5px 20px 20px 0px'>
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="padding-left: 30px; margin-top: 15px">
        Ticket System /
        <a href="<?= base_url() . 'get-dashboard-nic-man' ?>"> Dashboard </a>
        / <?php echo $title; ?>

    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" align="right" style="margin-top: 15px">
        <a href="<?= base_url()?>dashboard">
            <button type="button" class="btn btn-sm btn-danger pull-right">
                <i class="fa fa-backward"></i>&nbsp;Dashboard</button>
        </a>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left">
        <?php if($this->session->flashdata('success')) { ?>
            <div class="success-msg">
                <div class="alert alert-success" style="box-shadow:  0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b><i class="fa fa-check"></i> <?php echo $this->session->flashdata('success') ?></b>
                </div>
            </div>
            <br>

        <?php } ?>

        <?php if($this->session->flashdata('errorM')) { ?>
            <div class="alert alert-danger alert-dismissable" style="box-shadow:  0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <b><?php echo $this->session->flashdata('errorM') ?></b>
                <br>
                <b><?php echo $this->session->flashdata('error_code') ?></b>
            </div>
            <br>
        <?php } ?>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-right: 20px">
        <div class="reza-card">
            <div class="reza-title"> <?php echo $title; ?>  </div>

            <div class="table-responsive" style="padding: 15px; margin-top: -20px">

                <input type="hidden" name="tStatus" id="tStatus" value="<?php echo $tStatus ?>">
                <input type="hidden" name="tProcess" id="tProcess" value="<?php echo $tProcess?>">
                <table class="datatable table table-stripped " id='datatable'>
                    <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Application</th>
                        <th>Service</th>
                        <th>
                            Ticket Name
                            <input type="text" id="by_case_no" name="by_case_no" class="form-control" placeholder="By Ticket Name">
                        </th>
                        <th>
                            Report On
                            <input type="date" name="by_date"  id="by_date" class="form-control" >
                        </th>
                        <th>
                            Status
                        </th>

                        <th class="center">
                            Action
                            <button type="button" class="search_button btn btn-sm btn-success form-control"><i class="fa fa-search" aria-hidden="true"></i>
                                Search
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>



<!--Masud Script-->
<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
<script>

    $('#datatable').DataTable();
    load_data();


    function load_data(){
        var base_url = "<?php echo base_url();?>";
        var case_no  = $('#by_case_no').val();
        var sub_date = $('#by_date').val();
        var tStatus = $('#tStatus').val();
        var tProcess = $('#tProcess').val();

        $('#datatable').DataTable().destroy();
        var table = $('#datatable').DataTable({
            'pageLength':10,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
            'language': {
                "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
            },
            'ajax':{
                url: base_url+'index.php/TicketNicDashboardController/ajaxAllTicketWithStatusNicMan',
                type:'POST',
                data: {
                    case_no  : case_no,
                    tStatus  : tStatus,
                    tProcess : tProcess,
                    sub_date : sub_date
                },
                deferLoading: 57,
            },

            order: [[2, 'asc']],
            columnDefs: [{
                targets: "_all",
                orderable: false,
                "className": "dt-center", "targets":[ 0, 1, 2, 3, 4, 5]
            }]

        });
    }

    $('.search_button').click(function(){
        load_data();
    });


</script>



