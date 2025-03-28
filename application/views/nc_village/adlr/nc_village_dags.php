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
            'dc_name': '',
            'is_loading': false,
            'dlr_certification': '',
            'dlr_note': '',
            'verified': '',
            'ads_verified': '',
            'map_list': [],
            'old_vill': '',
            'new_vill': '',
            'new_vill_eng': '',
            'uuid': '',
            'dlr_verified_vill_name': '',
            'is_name_forwarding': false,
            init() {
                var nc_village = '<?= json_encode($nc_village) ?>';
                var nc_village = JSON.parse(nc_village);
                this.application_no = nc_village.application_no;
                this.dist_code = nc_village.dist_code;
                this.ads_verified = nc_village.ads_verified;
                this.nc_village = nc_village;
                var map_list = '<?= json_encode($map) ?>';
                this.map_list = JSON.parse(map_list);
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
                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/getDags',
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
            changeVill() {
                var self = this;
                this.is_name_forwarding = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm to forward',
                    type: 'green',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/changeVill',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'dist_code': self.dist_code,
                                        'uuid': self.uuid,
                                        'new_vill_name': self.new_vill,
                                        'new_vill_name_eng': self.new_vill_eng,
                                        'application_no': self.application_no,
                                        'change_vill_remark': 'The survey of village ' + self.old_vill + ' is completed and its new updated name will be ' + self.new_vill + ' (' + self.new_vill_eng + ')',
                                    },
                                    success: function(data) {
                                        if (data.verified != 'Y') {
                                            $.confirm({
                                                title: 'Error Occurred!!',
                                                content: 'Failed!!. Please contact the system admin.',
                                                type: 'red',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.is_name_forwarding = false;
                                                        }
                                                    },
                                                }
                                            });
                                            self.is_name_forwarding = false;
                                            return;
                                        } else {
                                            $.confirm({
                                                title: 'Success',
                                                content: 'Village successfully forwarded to JDS.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.is_name_forwarding = false;
                                                            window.location.reload();
                                                        }
                                                    },
                                                }
                                            });
                                        }
                                        self.dlr_verified_vill_name = data.verified;
                                        self.is_name_forwarding = false;
                                    }
                                });
                            }
                        },
                        Cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {

                            }
                        }
                    }
                });

                self.is_name_forwarding = false;
            },
            certifyVillage() {
                if (!this.dlr_note) {
                    alert('Please enter the Additional Director Of Land Records Note');
                    return;
                }
                var self = this;
                this.is_loading = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm to verify the Draft Chitha and Draft Map of this Village',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm again to verify the Draft Chitha and Draft Map of this Village',
                                    type: 'orange',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-success',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/certifyVillage',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'dist_code': self.dist_code,
                                                        'application_no': self.application_no,
                                                        'remark': self.dlr_note,
                                                        'uuid': self.uuid,
                                                        'change_village_remark': $('#templateTA').html(),
                                                    },
                                                    success: function(data) {
                                                        if (data.submitted != 'Y') {
                                                            $.confirm({
                                                                title: 'Error Occurred!!',
                                                                content: 'Failed.. Please contact the system admin.',
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
                                                        if (data.submitted == 'Y') {
                                                            $.confirm({
                                                                title: 'Success',
                                                                content: 'The Chitha and map of this village have been successfully save.',
                                                                type: 'green',
                                                                typeAnimated: true,
                                                                buttons: {
                                                                    Ok: {
                                                                        text: 'OK',
                                                                        btnClass: 'btn-info',
                                                                        action: function() {
                                                                            self.is_loading = false;
                                                                            self.nc_village = data.nc_village;
                                                                        }
                                                                    },
                                                                }
                                                            });
                                                        }
                                                        self.is_loading = false;
                                                    },
                                                    error: function(error) {
                                                        $.confirm({
                                                            title: 'Error Occurred!!',
                                                            content: 'Please contact the system admin',
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
                                                    }
                                                });
                                            }
                                        },
                                        cancel: {
                                            text: 'Cancel',
                                            btnClass: 'btn-warning',
                                            action: function() {
                                                self.is_loading = false;
                                            }
                                        },
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_loading = false;
                            }
                        },
                    }
                });
            },
            revertVillage() {
                if (!this.dlr_note) {
                    alert('Please enter the Additional Director Of Land Records Note');
                    return;
                }
                var self = this;
                this.is_loading = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm to Revert this Village to DC',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm again to Revert this Village to DC',
                                    type: 'orange',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-success',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/revertVillage',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'dist_code': self.dist_code,
                                                        'application_no': self.application_no,
                                                        'remark': self.dlr_note
                                                    },
                                                    success: function(data) {
                                                        if (data.submitted != 'Y') {
                                                            $.confirm({
                                                                title: 'Error Occurred!!',
                                                                content: data.msg,
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
                                                        if (data.submitted == 'Y') {
                                                            $.confirm({
                                                                title: 'Success',
                                                                content: 'Successfully Reverted to DC.',
                                                                type: 'green',
                                                                typeAnimated: true,
                                                                buttons: {
                                                                    Ok: {
                                                                        text: 'OK',
                                                                        btnClass: 'btn-info',
                                                                        action: function() {
                                                                            self.is_loading = false;
                                                                            self.nc_village = data.nc_village;
                                                                        }
                                                                    },
                                                                }
                                                            });
                                                        }
                                                        self.is_loading = false;
                                                    },
                                                    error: function(error) {
                                                        $.confirm({
                                                            title: 'Error Occurred!!',
                                                            content: 'Please contact the system admin',
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
                                                    }
                                                });
                                            }
                                        },
                                        cancel: {
                                            text: 'Cancel',
                                            btnClass: 'btn-warning',
                                            action: function() {
                                                self.is_loading = false;
                                            }
                                        },
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_loading = false;
                            }
                        },
                    }
                });
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
                        <span>
                            <button class="btn btn-primary" onclick="villDagsChithaButton()">
                                <i class="fa fa-eye"></i> View Certified Chitha
                            </button>
                        </span>
                        <?php if (sizeof($map) > 0) : ?>
                            <span>
                                <button class="btn btn-info py-2" style="color: white" onclick="viewMaps()">
                                    <i class='fa fa-eye'></i> View Map
                                </button>
                            </span>
                        <?php endif; ?>
                        <span>
                            <button class="btn btn-info py-2" style="color: white" onclick="viewProposal()">
                                <i class='fa fa-eye'></i> View Proposal
                            </button>
                        </span>
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
                            <textarea rows="2" class="form-control" readonly><?= $nc_village->co_certification; ?></textarea>
                            <label for="" class="form-label mt-1" style="font-weight: bold;">DC Certification Note </label>
                            <textarea rows="2" class="form-control" readonly><?= $nc_village->dc_certification; ?></textarea>

                            <div class="form-group mt-1">
                                <label for="" class="form-label " style="font-weight: bold;">Change Village Name</label>
                                <div class="form-group mt-2 row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="sel1">Existing Village Name:</label>
                                            <input x-model="old_vill" name="village_name" type="text" class="form-control" value="" id="village_name" disabled required>
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
                                <div x-show="nc_village.dlr_verified == 'Y'" class="mt-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <p rows="3" class=" mt-2 form-control">The survey of village "<span x-text="old_vill"></span>" is done and its new updated name will be "<span x-text="new_vill"></span> (<span x-text="new_vill_eng"></span>)" as per government OM No.ECF.213444/2022/ Dated Dispur, the 03-01-2024.</p>
                                </div>
                            </div>

                            <div class="form-group pt-2" x-show="nc_village.dlr_verified != 'Y' && nc_village.adlr_verified != 'Y' && nc_village.status =='I'">
                                <label for="" class="form-label" style="font-weight: bold;">Additional Director Of Land Records Note <span style="color:red;">*</span></label>
                                <textarea placeholder="Additional Director Of Land Records Note" rows="2" x-model="dlr_note" class="form-control" placeholder="Director of Land Records and Surveys Note"></textarea>
                                <div class="pt-2">
                                    <button x-on:click="certifyVillage" class="btn btn-success" type="button"><i class="fa fa-check"></i> Submit</button>
                                    <button x-on:click="revertVillage" class="btn btn-danger" type="button"><i class="fa fa-backward"></i> Revert to DC</button>
                                    <a href="javascript:history.go(-1)"><button class="btn btn-primary" type="button"> <i class="fa fa-arrow-left"></i> GO Back </button></a>
                                </div>
                            </div>
                            <div class="form-group pt-2" x-show="nc_village.status == 'B'">
                                <div x-show="nc_village.pre_user == 'ADLR'">
                                    <label for="" class="form-label" style="font-weight: bold;">Additional Director Of Land Records Note <span style="color:red;">*</span></label>
                                    <textarea rows="2" x-text="nc_village.adlr_note" class="form-control" readonly></textarea>
                                </div>
                                <div x-show="nc_village.pre_user == 'DLR'">
                                    <label for="" class="form-label" style="font-weight: bold;">Director of Land Records and Surveys Note <span style="color:red;">*</span></label>
                                    <textarea rows="2" x-text="nc_village.dlr_note" class="form-control" readonly></textarea>
                                </div>
                                <h5 class="text-danger pt-2">This village has been reverted back to DC.</h5>
                                <a href="javascript:history.go(-1)"><button class="btn btn-primary" type="button"> <i class="fa fa-arrow-left"></i> GO Back </button></a>
                            </div>
                            <div class="form-group pt-2" x-show="nc_village.dlr_verified == 'Y' || nc_village.adlr_verified == 'Y'">
                                <div x-show="nc_village.pre_user == 'ADLR'">
                                    <label for="" class="form-label" style="font-weight: bold;">Additional Director Of Land Records Note <span style="color:red;">*</span></label>
                                    <textarea rows="2" x-text="nc_village.adlr_note" class="form-control" readonly></textarea>
                                </div>
                                <div x-show="nc_village.pre_user == 'DLR'">
                                    <label for="" class="form-label" style="font-weight: bold;">Director of Land Records and Surveys Note <span style="color:red;">*</span></label>
                                    <textarea rows="2" x-text="nc_village.dlr_note" class="form-control" readonly></textarea>
                                </div>
                                <h5 class="text-success pt-2" x-show="nc_village.depart_verified != 'Y'">The Draft Chitha and Map of this village has already been verified.</h5>
                                <a href="javascript:history.go(-1)"><button class="btn btn-primary" type="button"> <i class="fa fa-arrow-left"></i> GO Back </button></a>
                            </div>
                            <div class="form-group pt-2" x-show="nc_village.status == 'P'">
                                <div x-show="nc_village.pre_user == 'ADLR'">
                                    <label for="" class="form-label" style="font-weight: bold;">Additional Director Of Land Records Note <span style="color:red;">*</span></label>
                                    <textarea rows="2" x-text="nc_village.adlr_note" class="form-control" readonly></textarea>
                                </div>
                                <div x-show="nc_village.pre_user == 'DLR'">
                                    <label for="" class="form-label" style="font-weight: bold;">Director of Land Records and Surveys Note <span style="color:red;">*</span></label>
                                    <textarea rows="2" x-text="nc_village.dlr_note" class="form-control" readonly></textarea>
                                </div>
                                <h5 class="text-danger pt-2">This village has been forwarded to JDS for Village Name Change on Map.</h5>
                                <a href="javascript:history.go(-1)"><button class="btn btn-primary" type="button"> <i class="fa fa-arrow-left"></i> GO Back </button></a>
                            </div>
                            
                        </div>
                    </div>
                    <?php if ($nc_village->depart_verified == 'Y') : ?>
                        <div class="border-top border-dark py-3">
                            <div class="form-group pb-2">
                                <label for="" class="form-label" style="font-weight: bold;">Department Note </label>
                                <textarea placeholder="" rows="2" class="form-control" readonly><?= $nc_village->depart_note; ?></textarea>
                            </div>
                        </div>
                        <div class="border-top border-dark py-2">
                            <h5 class="text-success">The Draft Chitha and Map of this village has already been verified and forwarded to the Department.</h5>
                        </div>
                    <?php endif; ?>
                    <?php if (sizeof($map) == 0) : ?>
                        <div class="border-top border-dark py-2">
                            <h5 class="text-danger">The Assistant Director of Surveys (ADS) has not yet uploaded the map.</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- change vill MOdal -->

        <div id="vill_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Submit Changed Village Name</h5>
                    </div>
                    <div class="modal-body">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <form action="">

                                    <div class="row border border-info p-3">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">District:</label>
                                                <h6 id="d"><?= $locations->dist->loc_name ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Sub-Div:</label>
                                                <h6 id="s"><?= $locations->subdiv->loc_name ?></h6>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Circle:</label>
                                                <h6 id="cir"><?= $locations->circle->loc_name ?></h6>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Mouza/Porgona:</label>
                                                <h6 id="mza"><?= $locations->mouza->loc_name ?></h6>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Lot:</label>
                                                <h6 id="lot"><?= $locations->lot->loc_name ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">Village:</label>
                                                <h6 id="vill"><?= $locations->village->loc_name ?></h6>

                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">New Village Name:</label>
                                                <input x-model="new_vill" name="new_vill_name" type="text" class="form-control" id="new_vill_name" required>
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
                                                <p id="templateTA" class="form-control" aria-label="With textarea">The survey of village <span x-text="old_vill"></span> is completed and its new updated name will be <span x-text="new_vill"></span> (<span x-text="new_vill_eng"></span> ).</p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="uuid" id="uuid" value="" />
                    <input style="display: none;" type="text" name="new_vill_name" id="new_vill_name" value="" />
                    <input style="display: none;" type="text" name="new_vill_name_eng" id="new_vill_name_eng" value="" />
                    <div class="modal-footer">
                        <button type="button" x-show="!is_name_forwarding" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button type='button' x-show="!is_name_forwarding" class="btn btn-info" x-on:click='changeVill()' value="Submit">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i> Forward To JDS
                        </button>
                        <div x-show="is_name_forwarding" class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--	Modal for village dag chitha verify-->
        <div class="modal" id="modal_vill_dag_chitha" tabindex="-1" aria-labelledby="modal_vill_dag_chitha" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="width: 100% !important;">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title"> <i class="fa fa-file"></i> Certified Draft Chitha</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" onclick="closeModal()">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div><iframe width='100%' height='500px;' src='<?= CHITHA_URL . $nc_village->chitha_dir_path ?>'></iframe></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="closeModal()" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-close'></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--	Modal for Proposal -->
        <div class="modal" id="modal_proposal" tabindex="-1" aria-labelledby="modal_proposal" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="width: 100% !important;">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title"> <i class="fa fa-file"></i> Proposal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" onclick="closeModal()">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div><iframe width='100%' height='500px;' src='<?= 'data:application/pdf;base64,' . $proposal_pdf ?>'></iframe></div>
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
                                                <a x-bind:href="'<?= base_url() ?>index.php/nc_village/NcCommonController/viewUploadedMap?id=' + list.id" class="btn btn-info py-2" style="color: white" target="_blank">
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

    function viewProposal() {
        $('#modal_proposal').modal('show');
    }
    $(document).on('click', '.change', function() {
        $("#vill_modal").modal('show');
    });
</script>