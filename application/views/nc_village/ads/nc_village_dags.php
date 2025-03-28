<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<script>
    function alpineData() {
        return {
            'dags': [],
            'base_url': "<?= base_url(); ?>",
            'application_no': '',
            'nc_village': '',
            'selected_dag': '',
            'pdf': '',
            'dc_name': '',
            'is_loading': false,
            'ads_certification': '',
            'ads_note': '',
            'ads_note_updated': '',
            'verified':'',
            'map_list':[],
            init() {
                var nc_village = '<?= json_encode($nc_village) ?>';
                var nc_village = JSON.parse(nc_village);
                this.application_no = nc_village.application_no;
                this.dist_code = nc_village.dist_code;
                this.ads_note_updated = nc_village.ads_note;
                this.nc_village = nc_village;
                var map_list = '<?= json_encode($map) ?>';
                this.map_list = JSON.parse(map_list);
                this.getDags();
            },
            selectFile(event) {
                this.pdf = event.target.files[0]
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
                    url: '<?= base_url(); ?>index.php/nc_village/NcAdsController/getDags',
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
                            return;
                        }
                        self.dags = data.dags;
                        self.dc_name = data.dc_name.username;
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
                        <option selected value="<?= $locations->dist->dist_code ?>"><?= $locations->dist->loc_name ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Sub-Division</label>
                    <select id="subdiv_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations->subdiv->subdiv_code ?>"><?= $locations->subdiv->loc_name ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Circle</label>
                    <select id="cir_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations->circle->cir_code ?>"><?= $locations->circle->loc_name ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Mouza</label>
                    <select id="mouza_pargona_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations->mouza->mouza_pargona_code ?>"><?= $locations->mouza->loc_name ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Lot</label>
                    <select id="lot_no" class="form-control form-control-sm">
                        <option selected value="<?= $locations->lot->lot_no ?>"><?= $locations->lot->loc_name ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Village</label>
                    <select id="vill_townprt_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations->village->vill_townprt_code ?>"><?= $locations->village->loc_name ?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5> DAGS <span id="application_no" class="bg-gradient-danger text-white">
						</span> (Total Dags : <b x-text="dags.length"></b>)
                        <span><button class="btn btn-primary" onclick="villDagsChithaButton()">
								<i class='fa fa-eye'></i> View Certified Chitha</button>
                        </span>

                        <?php if(sizeof($map) > 0): ?>
                            <span>
                             <button class="btn btn-info py-2" style="color: white" onclick="viewMaps()">
                                <i class='fa fa-eye'></i> View Map
                            </button>
                        </span>
                        <?php endif; ?>
                    </h5>
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
                    <div class="border-top border-dark py-3">
                        <div class="form-group pb-2">
                            <label for="" class="form-label" style="font-weight: bold;">CO Certification Note</label>
                            <textarea rows="2"
                                      class="form-control" readonly><?= $nc_village->co_certification; ?></textarea>
                            <label for="" class="form-label" style="font-weight: bold;">DC Certification Note </label>
                            <textarea rows="2"
                                      class="form-control" readonly><?= $nc_village->dc_certification; ?></textarea>
                            <label for="" class="form-label" style="font-weight: bold;">DLRS Note </label>
                            <textarea rows="2"
                                      class="form-control" readonly><?= $nc_village->dlr_note; ?></textarea>
                            <label for="" class="form-label" style="font-weight: bold;">Department Note </label>
                            <textarea placeholder="" rows="2"
                                      class="form-control" readonly><?= $nc_village->depart_note; ?></textarea>
                        </div>
                    </div>
                    <div x-show="nc_village.ads_verified == 'Y'">
                        <label for="" class="form-label" style="font-weight: bold;">Asst Director of Surveys (ADS)
                            Note</label>
                        <textarea x-model="ads_note_updated" placeholder="Asst Director of Surveys (ADS) Note" rows="2"
                                  class="form-control" readonly></textarea>
                    </div>
                    <div class="border-top border-dark py-2" x-show="nc_village.dlr_verified != 'Y'">
                        <h5 class="text-danger">The Director of Land Records and Surveys has not yet submit report.</h5>
                    </div>
                    <div class="border-top border-dark py-2" x-show="nc_village.depart_verified != 'Y'">
                        <h5 class="text-danger">The Department has not yet submit report.</h5>
                    </div>
                    <div class="border-top border-dark py-2" x-show="nc_village.depart_verified == 'Y'">
                        <h5 class="text-success">The Draft Chitha and Map of this village has already been verified and forwarded to the Joint Secretary.</h5>
                    </div>
                    <?php if (sizeof($map) == 0): ?>
                        <div class="border-top border-dark py-2">
                            <h5 class="text-danger">The Assistant Director of Surveys (ADS) has not yet uploaded the
                                map..</h5>
                        </div>
                    <?php endif; ?>
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
                        <div><iframe width='100%' height='500px;' src='<?= 'data:application/pdf;base64,'.$pdf?>'></iframe></div>
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
                                                    x-bind:href="'<?= base_url()?>index.php/nc_village/NcCommonController/viewUploadedMap?id=' + list.id"
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
</script>
