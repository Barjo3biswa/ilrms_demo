<link href="<?= base_url().'css/bootstrap.min.css'?>">
<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif"></div>
<script src="<?php echo base_url(); ?>application/views/js/blockUI.js"></script>
<script>
    document.onreadystatechange = function(e)
    {
        $.blockUI({
            message: $('#displayBox'),
            css: {
                border:'none',
                backgroundColor:'transparent'
            }
        });
    };
    window.onload = function(){
        $.unblockUI();
    }
</script>

<div class="row">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-3 text-white">
            <li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'dashboard'?>">Create User Profile (Assistant)</a></li>
            <li class="breadcrumb-item font-weight-bold active text-red" 
            aria-current="page">New User</li>
        </ol>
    </nav>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 offset-2">
            <?php echo $this->session->flashdata('alert_msg');?>
            <div class="bg-white shadow-lg rounded p-2 card-info">
                <?=form_open('user-profile-create-assistant-save')?>
                <div class="card-header text-danger text-bold">
                    <h6>Create User Profile (Assistant / Under Secretary)</h6>
                </div>
                <div class="card-body"> 
                    
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">First Name :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control " 
                            value="<?=$this->input->post('fname')?>" placeholder="Enter First Name"
                                   name="fname" id="fname" autocomplete="off">
                            <span class="text-danger"><?=form_error('fname')?></span>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Last Name :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control " 
                            value="<?=$this->input->post('lname')?>" placeholder="Enter Last Name"
                                   name="lname" id="lname" autocomplete="off">
                            <span class="text-danger"><?=form_error('lname')?></span>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Designation :</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="desgntn" id="desgntn" autocomplete="off">
                                <option value="">-- Select Designation --</option>
                                <option value="<?=ASSISTANT_USERCODE?>"><?=ASSISTANT_USERCODE?></option>
                                <option value="<?=UNDER_SEC_USERCODE?>"><?=UNDER_SEC_USERCODE?></option>
                            </select>
                            <span class="text-danger"><?=form_error('desgntn')?></span>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Mobile No :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="<?=$this->input->post('mobile_no')?>" placeholder="Enter Mobile No"
                                   name="mobile_no" id="mobile_no" maxlength="10" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            <span class="text-danger"><?=form_error('mobile_no')?></span>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Email :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="email_id" 
                            value="<?=$this->input->post('email_id')?>"
                            placeholder="Enter Email ID"
                                   name="email_id" autocomplete="off">
                            <span class="text-danger"><?=form_error('email_id')?></span>
                        </div>
                    </div>
                    
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Address :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="address" value="<?=$this->input->post('address')?>"
                            placeholder="Enter Address"
                                   name="address" autocomplete="off">
                            <span class="text-danger"><?=form_error('address')?></span>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">User ID :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="user_id_new" value="" 
                             maxlength=20 placeholder="Set a User ID"
                            name="user_id_new" autocomplete="off">
                            <span class="text-danger"><?=form_error('user_id_new')?></span>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Set Password :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="set_pswrd" value="12345678" 
                            minlength=8 maxlength=12 placeholder="Set a Password"
                            name="set_pswrd" autocomplete="off">
                            <span class="text-danger"><?=form_error('set_pswrd')?></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" id="update_user" 
                    class="btn btn-success"><i class="fa fa-check"></i> Create Profile</button>
                </div>
                <?=form_close()?>
            </div>
        </div>


        <hr class="mt-3">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
            <div class="bg-white shadow-lg rounded p-2 card-info">
                <div class="card-header text-danger text-bold">
                    <h6>User Assistant / Under Secretary List for Districts: 
                    </h6>
                    <strong class="text-primary">
                    <?php foreach ($user_dist as $dist) :  ?>
                                        #  <?= $this->utilclass->getDistrictNameOnLanding($dist->dist_code) ?>
                    <?php endforeach; ?> 
                    </strong>


                </div>
                <div class=""> 
                    <table class="table" id='dataTable'>
                        <thead>
                            <tr>
                                <th>Sl no.</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>Mobile no.</th>
                                <th>Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($user_list as $key => $value) { ?>
                            
                                <tr>
                                    <td><?=$count++;?></td>
                                    <td><?=$value->name;?></td>
                                    <td><?=$value->designation;?></td>
                                    <td class="text-danger"><?=$value->unique_user_id;?></td>
                                    <td><?=$value->email;?></td>
                                    <td><?=substr( $value->mobile_no, 0, 4 )
                                            .str_repeat( '*', ( strlen($value->mobile_no ) - 8 ) )
                                                .substr($value->mobile_no, -4 );?></td>
                                    <td><?=$value->address;?></td>
                                    <td><?=$value->status == 'E' ? 'Active' : 'Disable';?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            
            "pageLength": 50,
            "order": [1, "asc"],
            "autoWidth": false,
            "deferRender": true,
        });
    });
</script>