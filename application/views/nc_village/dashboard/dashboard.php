<link href="<?php echo base_url('css/style_new.css'); ?>" rel="stylesheet" />

<style>
    .badge-warning {
        color: black;
    }

    .badge-success {
        color: green
    }

    .wrapper {
        width: 100%;
        height: 600px;
        display: block;
        overflow: hidden;
        margin: 0 auto;
        padding: 60px 50px;
        background: #fff;
        border-radius: 4px;
    }

    article {
        width: 100%;
        height: 600px;
        display: block;
        overflow: hidden;
        margin: 0 auto;
        padding: 60px 50px;
        background: #fff;
        border-radius: 4px;
        display: none;
    }

    article.on {
        display: block;
    }

    .dataTables_scrollBody {
        overflow-x: hidden !important;
        overflow-y: auto !important;
    }

    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: hidden !important;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }

    .table.dataTable.no-footer {
        border-bottom: 0px;
        border-top: 0px;
    }

    .table.dataTable.no-header {
        border-bottom: 0px;
        border-top: 0px;
    }

    #legend-container {
        display: flex;
        justify-content: center;
        padding: 0.5em;
    }

    #legend-container ul {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr);
        grid-row-gap: 0.5em;
    }

    span2 {
        font-size: 12px;
        color: #303952;
    }

    .tab-res{
        padding-left:3rem !important
    }

    .tab-res2{
        padding-left:4rem !important

    }

    th {
        font-size: 13px;
        /*color: #303952;*/
    }


    .main-card{
        border-radius: 5px;
        display: inline-block;
        background: #fff;
        box-shadow: 0px 3px 5px #999 !important;
        padding: 8px;
        width: 100%!important;
    }

    @media only screen and (max-width: 600px) {
        span2{
            font-size: 10px;

        }
    }

    @media only screen and (max-width: 600px) {
        table.dataTable tbody th, table.dataTable tbody td {
            text-align: right !important;
            padding: 8px 10px;
            font-size: .9em;
        }

        .tab-res{
            padding-left:0rem !important;


        }
        .tab-res2{
            padding-left:1rem !important

        }
        .dist-res{
            text-align: left!important;
        }
    }
    @media only screen and (max-width: 600px) {

        .table-service {
            padding: 0rem 0rem !important;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }
    }
    .tmpselected{
        color: red;
    }
    .chartWrapper {
        position: relative;
        overflow-x: scroll;
    }

    .chartWrapper>canvas {
        position: absolute;
        left: 0;
        top: 0;
        pointer-events: none;
    }

    .chartAreaWrapper {
        width: 1500px;
        overflow-x: scroll;
    }
    .height {
        margin-bottom: 20px;
        height: 130px;
    }
    a:hover {
        font-size: 1.2em;
        color: #136a8a;
    }
</style>
<div class="card" id="dashboard_header_name_div" style="display:block">
    <div class="card-header  text-black h5 text-center">
        <span id="dh_name_text">NC Village Dashboard</span>
    </div>
</div>

<div class="mt-2 p-2 bg-secondary text-center text-white h6 shadow-sm border border-white rounded"><b>Last Updated at :
        <?php if (isset($updated_at)) {echo date('d F Y', strtotime($updated_at));} else {echo "";}?>, <?php if (isset($updated_at_time)) {echo date('h:i a', strtotime($updated_at_time));} else {echo "";}?></b></div>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #ffffff !important">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">NC Village Dashboard</li>
        </ol>
    </nav>
    <div class="dash_content_area">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card height">
                        <div class="card-body" style="font-weight:500; background-color: #a29bfe">
                            TOTAL VILLAGES (CHITHA ENTERED)
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/getDataEnteredDistrict/')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"><img src="<?php echo base_url('assets/officenew.png'); ?>" alt="Office"> <?php if (isset($villCount)) {echo $villCount;} else {echo "0";}?></small></a>
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/getDataEnteredDistrict/')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"></small></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card height">
                        <div class="card-body" style="font-weight:500; background-color: #a29bfe">
                            VERIFIED DRAFT CHITHA AND MAP (LM)
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/districts/verified_lm')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"><img src="<?php echo base_url('assets/officenew.png'); ?>" alt="Office"> <?php if (isset($verified_lm_count)) {echo $verified_lm_count;} else {echo "0";}?></small></a>
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/districts/verified_lm')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"></small></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card height">
                        <div class="card-body" style="font-weight:500; background-color: #a29bfe">
                            CERTIFICATION OF DRAFT CHITHA AND MAP (CO)
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/districts/certified_co')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"><img src="<?php echo base_url('assets/officenew.png'); ?>" alt="Office"> <?php if (isset($certified_co_count)) {echo $certified_co_count;} else {echo "0";}?></small></a>
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/districts/certified_co')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"></small></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card height">
                        <div class="card-body" style="font-weight:500; background-color: #a29bfe">
                            CERTIFICATION OF DRAFT CHITHA AND MAP (DC)
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/districts/digi_signature_dc')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"><img src="<?php echo base_url('assets/officenew.png'); ?>" alt="Office"> <?php if (isset($digi_signature_dc_count)) {echo $digi_signature_dc_count;} else {echo "0";}?></small></a>
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/districts/digi_signature_dc')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"></small></a>
                        </div>
                    </div>
                </div>

				<div class="col-lg-4">
                    <div class="card">
                        <div class="card-body" style="font-weight:500; background-color: #a29bfe">
                            DLRS STATUS
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/dashboardDeptDistrictWise/dc_forwarded')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"> <i class="fa-solid fa-forward"></i>
                                    Forwarded by DC : <?php if (isset($dc_forwarded)) {echo $dc_forwarded;} else {echo "0";}?></small></a><br>
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/dashboardDeptDistrictWise/dlrs_pending')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"> <i class="fa-solid fa-spinner"></i>
                                    Pending at DLRS : <?php if (isset($dlrs_pending)) {echo $dlrs_pending;} else {echo "0";}?></small></a><br>
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/dashboardDeptDistrictWise/dlr_forwarded')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"> <i class="fa-solid fa-forward"></i>
                                    Forwarded to Senior Most Secretary : <?php if (isset($dlr_forwarded)) {echo $dlr_forwarded;} else {echo "0";}?></small></a>
                        </div>
                        <div class="card-footer">
                            <a href="<?=base_url('index.php/nc_village/NcDashboardController/villages/')?>" title="Click here for a detailed view" class="card-title"><small class="text-muted"></small></a>
                        </div>
                    </div>
                </div>

            </div> <!---// end of class row ---->
        </div> <!---// end of class col-lg-12 col-md-12 col-sm-12 col-xs-12 ---->
    </div> <!---// end of class dash_content_area ---->

    <!-- Village Wise -->

    <div class="dash_content_area">
        <div class="row" style=" margin-top: 35px; margin-bottom: 30px;">
            <div class="col-md-12">
                <div class="main-card">
                    <div class="card-header text-center"><i class="fa fa-area-chart" aria-hidden="true"></i>District Wise
                    </div>
                    <div class="" style="overflow-x:auto;">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover no-header" id='datatableDist' width="100%">
                            <thead>
                            <tr style="background-color:#a29bfe">
                                <th class="tab-res2" >District</th>
                                <th class="text-center">Verified by LM</th>
                                <th class="text-center">Certified by CO</th>
                                <th class="text-center">Digitally Sign by DC</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($districts as $district): ?>
                                <tr>
                                    <td>
                                        <div class="widget-content p-0 tab-res" >
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <a href="<?=base_url('index.php/nc_village/NcDashboardController/getNcVillagesByNCStatus') . '/' . $district['loc_name']['dist']['dist_code']?>" class='' title=""><span2 class="dist-res"style="color: #303952;"><?php echo $district['loc_name']['dist']['loc_name'] ?></a>
                                                    </span2>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge"><span2 style="color: green;"><?php echo $district['verified_lm_count'] ?></span2>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge">
                                            <span2 style="color: green;"><?php echo $district['certified_co_count'] ?>
                                            </span2>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge">
                                            <span2 style="color: green;"><?php echo $district['digi_signature_dc_count'] ?>
                                            </span2>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;?>

                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!---// end of class container-fluid ---->

