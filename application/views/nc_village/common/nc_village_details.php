<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?=base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css')?>">
<script src="<?=base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js')?>"></script>
<script>
    function alpineData() {
        return {
            'dags': [],
            'base_url': "<?=base_url();?>",
            'application_no': '',
            'nc_village': '',
            'selected_dag': '',
            'dc_name': '',
            'is_loading': false,
            'dlr_certification': '',
            'dlr_note': '',
            'verified':'',
            'ads_verified':'',
            'map_list':[],
            'old_vill': '',
            'new_vill': '',
            'new_vill_eng': '',
            'uuid': '',
            'dlr_verified_vill_name': '',
            'villages': '',
            init() {
                //var nc_village = '<?//=json_encode($nc_village)?>//';
                //var nc_village = JSON.parse(nc_village);
                this.application_no = '<?=$application_no?>';
                this.dist_code = '<?=$d?>';
                // this.ads_verified = nc_village.ads_verified;
                // this.nc_village = nc_village;
                var map_list = '<?=json_encode($map)?>';
                this.map_list = JSON.parse(map_list);
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonMyController/getVillageDataDetails',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code':self.dist_code,
                        'application_no':self.application_no,
                    },
                    success: function(data) {
                        self.villages = data;
                        self.nc_village = data;
                        self.ads_verified = data.ads_verified;
                    }
                });
                this.getDags();
            },
            openModal(dag) {
                this.selected_dag = dag;
            },
            closeModal() {
                $('#close_modal').trigger('click');
            },
            get dags_verified() {
                var total = 0;
                this.dags.forEach(element => {
                    if (element.dc_verified == 'Y') {
                        total++;
                    }
                });
                return total;
            },
            getDags() {
                var self = this;
                this.is_loading = true;
                $.ajax({
                    url: '<?=base_url();?>index.php/nc_village/NcCommonController/getDags',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'application_no': self.application_no,
                        'dist_code': self.dist_code,
                    },
                    success: function(data) {
                        if (data.success != 'Y') {
                            $.confirm({
                                title: 'Error Occurred!!',
                                content: 'Data Not Found. Please contact the system admin.',
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'OK',
                                        btnClass: 'btn-info',
                                        action: function() {
                                            self.is_loading = false;
                                        }
                                    },
                                }
                            });
                            self.is_loading = false;
                            return;
                        }
                        self.dags = data.dags;
                        self.dc_name = data.dc_name.username;
                        self.old_vill = data.change_vill.old_vill_name;
                        self.new_vill = data.change_vill.new_vill_name;
                        self.new_vill_eng = data.change_vill.new_vill_name_eng;
                        self.uuid = data.change_vill.uuid;
                        self.is_loading = false;
                    }
                });
                self.is_loading = false;
            },
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="text-center p-2" style="font-size:18px; font-weight: bold; background-color: #ffc000">NC VILLAGE</div>
            <div class="row pt-2">
                <div class="col-lg-2">
                    <label for="">District</label>
                    <select id="dist_code" class="form-control form-control-sm">
                        <option selected value="<?=$locations->dist->dist_code?>"><?=$locations->dist->loc_name?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Sub-Division</label>
                    <select id="subdiv_code" class="form-control form-control-sm">
                        <option selected value="<?=$locations->subdiv->subdiv_code?>"><?=$locations->subdiv->loc_name?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Circle</label>
                    <select id="cir_code" class="form-control form-control-sm">
                        <option selected value="<?=$locations->circle->cir_code?>"><?=$locations->circle->loc_name?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Mouza</label>
                    <select id="mouza_pargona_code" class="form-control form-control-sm">
                        <option selected value="<?=$locations->mouza->mouza_pargona_code?>"><?=$locations->mouza->loc_name?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Lot</label>
                    <select id="lot_no" class="form-control form-control-sm">
                        <option selected value="<?=$locations->lot->lot_no?>"><?=$locations->lot->loc_name?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Village</label>
                    <select id="vill_townprt_code" class="form-control form-control-sm">
                        <option selected value="<?=$locations->village->vill_townprt_code?>"><?=$locations->village->loc_name?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url()?>index.php/nc_village/NcCommonMyController/viewBhunaksaMap" method="post">
                        <span class="font-weight-bold" style="font-size: 20px;">
                        DAGS <span id="application_no" class="bg-gradient-danger text-white">
                            </span> (Total Dags : <b x-text="dags.length"></b>)
                        </span>
                        <span>
                            <button type="button" class="btn btn-primary" onclick="villDagsChithaButton()">
                                <i class="fa fa-eye"></i> View Certified Chitha
                            </button>
                        </span>
                        <?php if (sizeof($map) > 0): ?>
                        <span>
                             <button type="button" class="btn btn-info py-2" style="color: white" onclick="viewMaps()">
                                <i class='fa fa-eye'></i> View Map
                            </button>
                        </span>
                        <?php endif;?>
                        <span>
                            <input type="hidden" name="location" value="<?= $locations->dist->dist_code
                            .'_'.$locations->subdiv->subdiv_code.'_'.
                            $locations->circle->cir_code.'_'.$locations->mouza->mouza_pargona_code.'_'.
                            $locations->lot->lot_no.'_'.$locations->village->vill_townprt_code?>">
                            <input name="vill_name" value="<?=$locations->village->loc_name?>" type="hidden">
                            <input type="hidden" name="dags" :value="villages.bhunaksa_total_dag">
                            <input type="hidden" name="area" :value="villages.bhunaksa_total_area_skm">
                            <input type="hidden" name="application_no" :value="application_no">
                            <input type="hidden" name="dist_code" :value="dist_code">
                             <button type="submit" class="btn btn-secondary py-2" style="color: white;">
                                <i class='fa fa-eye'></i> View Bhunaksha Map
                            </button>
                        </span>
                    </form>
                    <div class="border mb-2" style="height: 60vh;overflow-y:auto;">
                        <table class="table table-striped table-hover table-sm table-bordered">
                            <thead style="position: sticky;top:0;" class="bg-warning">
                            <tr>
                                <th>Sl.No.</th>
                                <th>Dag</th>
                                <th>Land Class</th>
                                <th>Area(B-K-L)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template x-for="(dag,index) in dags">
                                <tr>
                                    <td x-text="index + 1"></td>
                                    <td x-text="dag.dag_no"></td>
                                    <td x-text="dag.full_land_type_name"></td>
                                    <td x-text="dag.dag_area_b+'-'+dag.dag_area_k+'-'+dag.dag_area_lc"></td>
                                </tr>
                            </template>
                            <tr x-show="dags.length == 0">
                                <td colspan="4" class="text-center">
                                    <span x-show="!is_loading">No dags Found</span>
                                    <div class="d-flex justify-content-center" x-show="is_loading">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <th colspan="2" style="background-color: #136a6f; color: #fff">
                                Village Details
                            </th>
                            <?php
                                if(count($merge_village_requests)):
                            ?>
                            <?php
                                else:
                            ?>
                                    <!-- <th colspan="2" style="background-color: #136a6f; color: #fff">
                                        Chitha Details
                                    </th>
                                    <th colspan="2" style="background-color: #136a6f; color: #fff">
                                        Bhunaksha Details
                                    </th> -->
                            <?php
                                endif;
                            ?>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="25%">Total Dags</td>
                                <td width="25%" style="color:red" x-text="villages.bhunaksa_total_dag"></td>
                            </tr>
                            <tr>
                                <td width="25%">Area (sq km)</td>
                                <td width="25%" style="color:red" x-text="villages.bhunaksa_total_area_skm"></td>
                            </tr>
                            <tr>
                                <td class="text-danger font-weight-bold" colspan="2">
                                    <span x-show="nc_village.bhunaksa_total_area_skm < 2">
                                        The area is less than 2 (Square kilometre)
                                    </span>
                                </td>
                            </tr>
                            <?php
                                if(count($merge_village_requests)):
                            ?>
                            <?php
                                else:
                            ?>
                                    <!-- <tr>
                                        <td width="25%">Total Dags</td>
                                        <td width="25%" style="color:red" x-text="villages.chitha_total_dag"></td>
                                        <td width="25%">Total Dags</td>
                                        <td width="25%" style="color:red" x-text="villages.bhunaksa_total_dag"></td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Chitha Area (sq km)</td>
                                        <td width="25%" style="color:red" x-text="villages.chitha_total_area_skm"></td>
                                        <td width="25%">Bhunaksha Area (sq km)</td>
                                        <td width="25%" style="color:red" x-text="villages.bhunaksa_total_area_skm"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-danger font-weight-bold" colspan="2">
                                            <span x-show="villages.chitha_total_area_skm < 2">
                                                The Chitha area is less than 2 (Square kilometre)
                                            </span>
                                        </td>
                                        <td class="text-danger font-weight-bold" colspan="2">
                                            <span x-show="villages.bhunaksa_total_area_skm < 2">
                                                The Bhunaksha area is less than 2 (Square kilometre)
                                            </span>
                                        </td>
                                    </tr> -->
                            <?php
                                endif;
                            ?>
                        </tbody>
                    </table>

                    <?php
                        if(count($merge_village_requests)):
                    ?>
                        <div id="merge_village_data">
                            <h4>Village list to be merged</h4>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr style="background-color: #136a6f; color: #fff">
                                        <th>Sl No</th>
                                        <th>Village Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($merge_village_requests as $key => $merge_village_request):
                                ?>
                                        <tr>
                                            <td><?= ($key+1) ?></td>
                                            <td><?= $merge_village_request['vill_loc']['village']['loc_name'] ?></td>
                                        </tr>
                                <?php
                                    endforeach;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                        endif;
                    ?>

                    <div class="border-top border-dark py-3">
                        <div class="form-group pb-2">
                            <label for="" class="form-label" style="font-weight: bold;">CO Certification Note</label>
                            <textarea rows="2"
                                      class="form-control" readonly><?=$nc_village->co_certification;?></textarea>
                            <label for="" class="form-label mt-1" style="font-weight: bold;">DC Certification Note </label>
                            <textarea rows="2"
                                      class="form-control" readonly><?=$nc_village->dc_certification;?></textarea>

                            <div class="form-group mt-1">
                                <label for="" class="form-label " style="font-weight: bold;">Change Village Name</label>
                                <div class="form-group mt-2 row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="sel1">Existing Village Name:</label>
                                            <input x-model="old_vill" name="village_name" type="text" class="form-control" value="" id="village_name"disabled required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="sel1">New Village Name:</label>
                                            <input x-model="new_vill" value="" name="new_village_name" type="text" class="form-control" id="new_village_name" disabled required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <button style="margin-top: 1.5rem ;" class="btn change btn-info" x-show="nc_village.dlr_verified != 'Y' && nc_village.status =='I'" type="button"><i class="fa fa-check"></i> Edit Village Name</button>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="nc_village.dlr_verified == 'Y' || nc_village.adlr_verified =='Y'" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p  rows="3" class=" mt-2 form-control">The survey of village "<span x-text="old_vill"></span>" is done and its new updated name will be "<span x-text="new_vill"></span> (<span x-text="new_vill_eng"></span>)" as per government OM No.ECF.213444/2022/ Dated Dispur, the 03-01-2024.</p>
                                </div>
                            </div>
                            <div class="form-group py-2">
                                <div x-show="nc_village.dlr_verified == 'Y' && nc_village.adlr_verified !='Y'">
                                <label for="" class="form-label" style="font-weight: bold;">Director of Land Records and Surveys Note <span style="color:red;">*</span></label>
                                <textarea rows="2" x-text="nc_village.dlr_note"
                                          class="form-control" readonly></textarea>
                                </div>
                                <div x-show="nc_village.dlr_verified != 'Y' && nc_village.adlr_verified =='Y'">
                                    <label for="" class="form-label" style="font-weight: bold;">Additional Director Of Land Records Note <span style="color:red;">*</span></label>
                                    <textarea rows="2" x-text="nc_village.adlr_note"
                                              class="form-control" readonly></textarea>
                                </div>
                           </div>
                            <a href="javascript:history.go(-1)"><button class="btn btn-primary" type="button"> <i class="fa fa-arrow-left"></i> GO Back </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- change vill Modal -->
        <div id="vill_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Changed Village Name</h5>
                    </div>
                    <div class="modal-body">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <form action="">
                                    <div class="row border border-info p-3">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">District:</label>
                                                <h6 id="d"><?=$locations->dist->loc_name?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Sub-Div:</label>
                                                <h6 id="s"><?=$locations->subdiv->loc_name?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Circle:</label>
                                                <h6 id="cir"><?=$locations->circle->loc_name?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Mouza/Porgona:</label>
                                                <h6 id="mza"><?=$locations->mouza->loc_name?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Lot:</label>
                                                <h6 id="lot"><?=$locations->lot->loc_name?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Village:</label>
                                                <h6 id="vill"><?=$locations->village->loc_name?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">New Village Name:</label>
                                                <input x-model="new_vill"  name="new_vill_name" type="text" class="form-control" id="new_vill_name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">New Village Name (Eng):</label>
                                                <input x-model="new_vill_eng" name="new_vill_name_eng" type="text" class="form-control" id="new_vill_name_eng" required>
                                            </div>
                                        </div>
                                        <div id="template" class="col-lg-12 col-md-12  col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <p id="templateTA" class="form-control" aria-label="With textarea">The survey of village <span x-text="old_vill"></span> is done and its new updated name will be <span x-text="new_vill"></span> (<span x-text="new_vill_eng"></span> ) as per government OM No.ECF.213444/2022/ Dated Dispur, the 03-01-2024.</p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--	Modal for village dag chitha verify-->
        <div class="modal" id="modal_vill_dag_chitha"  tabindex="-1" aria-labelledby="modal_vill_dag_chitha" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="width: 100% !important;">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title"> <i class="fa fa-file"></i> Certified Draft Chitha</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" onclick="closeModal()">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div><iframe width='100%' height='500px;' src='<?= CHITHA_URL . $nc_village->chitha_dir_path?>'></iframe></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="closeModal()" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-close'></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modal_show_map_list" tabindex="-1" aria-labelledby="modal_show_map_list" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="width: 100% !important;">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title"> <i class="fa fa-file"></i> View Maps</h5>
                    </div>
                    <div class="modal-body">
                        <div class="border mb-2" style="height: 60vh;overflow-y:auto;">
                            <table class="table table-striped table-hover table-sm table-bordered">
                                <thead style="position: sticky;top:0;" class="bg-warning">
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>View Map</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template x-for="(list,index) in map_list">
                                    <tr>
                                        <td x-text="index + 1"></td>
                                        <td>
                                            <a
                                                x-bind:href="'<?=base_url()?>index.php/nc_village/NcCommonController/viewUploadedMap?id=' + list.id"
                                                class="btn btn-info py-2" style="color: white" target="_blank"
                                            >
                                                View Map
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="map_list.length == 0">
                                    <td colspan="4" class="text-center">
                                        <span x-show="!is_loading">No Map Found</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal">
                            <i class='fa fa-close'></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /** VIEW VILLAGE DAGS CHITHA **/
    function villDagsChithaButton() {
        $('#modal_vill_dag_chitha').modal('show');
    }
    function viewMaps() {
        $('#modal_show_map_list').modal('show');
    }
    $(document).on('click', '.change', function () {
        $("#vill_modal").modal('show');
    });
</script>

