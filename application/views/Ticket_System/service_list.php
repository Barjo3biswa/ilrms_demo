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

    .rezaButt {
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

    body{
        background: linear-gradient(#dbe1e2, #faf2f2);
    }


</style>


<div class="row" style='padding: 5px 20px 20px 0px'>

    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="padding-left: 30px; margin-top: 15px">
        Ticket System / Service Type
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" align="right" style="margin-top: 15px">
        <a href="<?= base_url()?>dashboard">
            <button type="button" class="btn btn-sm btn-danger pull-right">
                <i class="fa fa-backward"></i>&nbsp;Dashboard</button>
        </a>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php if($this->session->flashdata('success')) { ?>
            <br>
            <br>
            <div class="success-msg">
                <div class="alert alert-success" style="box-shadow:  0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b><i class="fa fa-check"></i> <?php echo $this->session->flashdata('success') ?></b>
                </div>
            </div>
            <br>

        <?php } ?>

        <?php if($this->session->flashdata('error')) { ?>
            <br>
            <br>
            <div class="alert alert-danger alert-dismissable" style="box-shadow:  0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <b><?php echo $this->session->flashdata('error') ?></b>
                <br>
                <b><?php echo $this->session->flashdata('error_code') ?></b>
            </div>
            <br>
        <?php } ?>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="reza-card">
            <div class="reza-title">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <span> Service Type (Ticket Management System)</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12"  align="right">
                        <button type="button" data-color="purple" class="rezaButt bg-purple waves-effect" data-toggle="modal" data-target="#defaultModal">
                            <i class="fa fa-plus-circle"></i>
                            Add Service Type
                        </button>
                    </div>
                </div>
                <hr>
            </div>

            <div class="reza-body" style="margin-top: -30px!important;">
                <table class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Application</th>
                        <th>Service Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $service->application_name ?></td>
                            <td><?php echo $service->service_name ?></td>
                            <td>
                                <?php if($service->status==1) : ?>
                                    <?php echo 'Active'?>
                                <?php else : ?>
                                    <?php echo 'Inactive'?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url() ?>TicketSysCommonController/getServiceTypeDetailsPage/?app=<?php echo $service->id?>"
                                   type="button" class="btn btn-primary waves-effect">
                                    <i class="fa fa-eye"></i>
                                    <span>View</span>
                                </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Add Service Type </h4>
            </div>
            <form id="form_validation" action="<?php echo base_url()?>save-service-type" method="POST">
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div class="form-group">
                            <label class="form-label">Application Type <span style="color:red;">*</span></label>
                            <select class="select form-control"   style="width: 100%" name="applicationType" required>
                                <option disabled selected>Select</option>
                                <?php foreach ($applications as $application) {?>
                                    <option value="<?php echo $application->id ?>">
                                        <?php echo $application->application_name ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label"> Service Type Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="serviceTypeName" required maxlength="80" minlength="2">
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">SUBMIT</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/department.js'); ?>"></script>

