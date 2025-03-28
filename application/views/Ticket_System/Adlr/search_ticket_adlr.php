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
    .rezaForm{

        padding-bottom: 30px;
    }

    .form-label{
        font-weight: bolder;
    }

</style>

<div class="row" style='padding: 5px 20px 20px 0px'>
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="padding-left: 30px; margin-top: 15px">
        Ticket System / Search

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
            <div class="reza-title" style="margin-bottom: -10px"> Search Ticket </div>
            <hr>
            <div class="reza-body" >
                <div class="row" style=" border: 1px solid gray; padding: 30px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rezaForm">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> By Ticket Name </label>
                                <input type="text" class="form-control" name="ticketName" id="ticketName">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rezaForm">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> By Ticket Status </label>
                                <select class="form-control" name="ticketStatus" id="ticketStatus">
                                    <option selected disabled> Select</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Closed</option>
                                    <option value="0">Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rezaForm">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> From Date </label>
                                <input type="date" class="form-control" name="dateFrom" id="dateFrom">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rezaForm">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> To Date </label>
                                <input type="date" class="form-control" name="dateTo" id="dateTo">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rezaForm">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> By Application </label>
                                <select class="form-control" name="application" id="application">
                                    <option selected disabled> Select</option>
                                    <?php foreach ($applications as $application): ?>
                                        <option value="<?php echo $application->id ?>"><?php echo $application->application_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rezaForm">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> By Service Type</label>
                                <select class="form-control" name="serviceType" id="serviceType">
                                    <option selected disabled> Select</option>
                                    <?php foreach ($services as $service): ?>
                                        <option value="<?php echo $service->id ?>"><?php echo $service->service_name ?> ( <?php echo $service->application_name ?> ) </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rezaForm">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> By District </label>
                                <select class="form-control districtselect1 reset" name='dist_code' id='dist_code' >
                                    <option disabled selected>Select </option>
                                    <option value='10'>ছিৰাং ( Chirang )</option>
                                    <option value='06'>নলবাৰী ( Nalbari )</option>
                                    <option value='08'>দৰং ( Darrang )</option>
                                    <option value='07'>কামৰূপ ( Kamrup )</option>
                                    <option value='33'>নগাওঁ ( Nagaon )</option>
                                    <option value='14'>গোলাঘাট ( Golaghat )</option>
                                    <option value='01'>কোকৰাঝাৰ (Kokrajhar)</option>
                                    <option value='02'>ধুবুৰী ( Dhubri )</option>
                                    <option value='03'>গোৱালপাৰা ( Goalpara )</option>
                                    <option value='05'>বৰপেটা ( Barpeta )</option>
                                    <option value='13'>বঙাইগাঁও ( Bongaigaon )</option>
                                    <option value='15'>যোৰহাট ( Jorhat )</option>
                                    <option value='17'>ডিব্ৰুগড় ( Dibrugarh )</option>
                                    <option value='21'>করিমগঞ্জ ( Karimganj )</option>
                                    <option value='24'>কামৰূপ মহানগৰ ( Kamrup Metro )</option>
                                    <option value='32'>মৰিগাওঁ ( Morigaon )</option>
                                    <option value='36'>হোজাই ( Hojai )</option>
                                    <option value='38'>দক্ষিণ শালমাৰা ( South Salmara )</option>
                                    <option value='39'>বজালী ( Bajali )</option>
                                    <option value='22'>Hailakandi</option>
                                    <option value='23'>Cachar</option>
                                    <option value='27'>Udalguri</option>
                                    <option value='12'>লক্ষীমপূৰ ( Lakhimpur )</option>
                                    <option value='16'>শিৱসাগৰ ( Sibsagar )</option>
                                    <option value='18'>তিনিচুকীয়া ( Tinsukia )</option>
                                    <option value='34'>মাজুলী ( Majuli )</option>
                                    <option value='37'>চৰাইদেউ ( Charaideo )</option>
                                    <option value='11'>শোণিতপুৰ ( Sonitpur )</option>
                                    <option value='25'>ধেমাজি ( Dhemaji )</option>
                                    <option value='35'>বিশ্বনাথ ( Biswanath )</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rezaForm">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> By Circle </label>
                                <select class="form-control circleselect1 reset" name='cir_code' id='cir_code'>
                                    <option selected disabled>Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                        <button class="rezaButt buttPrimary" id="searchButt"  onclick="myFunction()">
                            <i class="fa fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="tab" style="padding: 15px; margin-top: -20px; display: none">
                <table class="datatable table table-stripped " id='datatable'>
                    <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Application</th>
                        <th>Service</th>
                        <th>Ticket Name</th>
                        <th>Report On</th>
                        <th>Status</th>
                        <th class="center">Action</th>
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
    var base_url = "<?php echo base_url();?>";

    $(document).ready(function (e)
    {
        $('.districtselect1').change(function (e) {
            var distCode = $(this).val();
            $.ajax({
                url: base_url + "index.php/TicketSysReportController/getCircleJson/" + distCode,
                beforeSend: function () {
                    $('.loader').addClass('trans');
                    $('.loader').removeClass('hide');
                },
                success: function (data) {
                    $('.loader').addClass('hide');
                    $('.loader').removeClass('trans');
                    var circode = JSON.parse(data);
                    var template = "<option selected disabled>Select Circle</option>"
                    for (var i = 0; i < circode.length; i++) {
                        template += "<option value='" + circode[i].cir_code + "_" + circode[i].subdiv_code + "'>" + circode[i].loc_name + "</option>"
                    }
                    $('.circleselect1').html(template);
                },
                error: function (jqXHR, exception) {
                    $('.loader').addClass('hide');
                    alert('Error : Could not load Circle..!');
                }
            });
        });

    });


    $('#datatable').DataTable();


    function myFunction()
    {
        $("#tab").show();
        var ticketName   = $('#ticketName').val();
        var ticketStatus = $('#ticketStatus').val();
        var dateFrom     = $('#dateFrom').val();
        var dateTo       = $('#dateTo').val();
        var application  = $('#application').val();
        var serviceType  = $('#serviceType').val();
        var dist_code    = $('#dist_code').val();
        var cir_code     = $('#cir_code').val();

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
                url: base_url+'index.php/TicketSysReportController/ajaxSearchTicketForReport',
                type:'POST',
                data: {
                    ticketName   : ticketName,
                    ticketStatus : ticketStatus,
                    dateFrom     : dateFrom,
                    dateTo       : dateTo,
                    application  : application,
                    serviceType  : serviceType,
                    dist_code    : dist_code,
                    cir_code     : cir_code
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

