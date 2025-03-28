
<div class="p-2 bg-success text-center text-white h5 shadow-sm border border-white rounded"><b>
        Notified Villages
    </b>
</div>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #ffffff !important">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">NC Village Dashboard</li>
            <li class="breadcrumb-item active" aria-current="page">
                Notified Villages
            </li>
        </ol>
    </nav>
    <div class="dash_content_area">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">

                <div class=" mt-5 col-md-6 offset-md-3">
                    <div class="card card-info">
                        <div class="card-header">
                            District Wise (Number of Notified Villages)
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php  if (isset($districts)):  ?>

                                    <?php foreach ($districts as $dist_code => $data): ?>
                                        <a href="<?=base_url('index.php/nc_village/NcDashboardController/ncVillageNotificationByVillage/')  . $dist_code?>">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?=$this->utilclass->getDistrictName($dist_code) . '(' . $data . ')'?>
                                                <i class="fa fa-chevron-right"></i>
                                            </li>
                                        </a>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>