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
        Ticket System /
        <a href="<?= base_url() . 'get-nic-developer' ?>"> NIC Developers </a>
        / Details
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
                        <span> NIC Developer Details (Ticket Management System)</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12"  align="right">

                    </div>
                </div>
                <hr>
            </div>

            <div class="reza-body"  style="margin-top: -30px!important;">
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th width="50%">Name</th>
                        <td width="50%"><?php echo $developer->name; ?></td>
                    </tr>
                    <tr>
                        <th>Display Name </th>
                        <td><?php echo $developer->display_name; ?></td>
                    </tr>

                    <tr>
                        <th>Mobile No.</th>
                        <td><?php echo $developer->mobile_no; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $developer->email; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if($developer->status == 1): ?>
                                Active
                            <?php elseif($developer->status == 0): ?>
                                Inactive
                            <?php else: ?>
                                Unknown
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date of Joining</th>
                        <td><?php echo  date("d-m-Y", strtotime($developer->date_of_joining));  ?></td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <hr>
                <div class="row reza-title">
                    Ticket Details Related to <?php echo $developer->display_name; ?>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th width="60%">Total no. of ticket Request For Closed</th>
                        <td width="20%"><?php echo $request; ?></td>
                        <td width="20%">
                            <a class="rezaButt" href="<?php echo base_url() ?>TicketSysCommonController/getRequestToClosedTicketBySelectedNicDev/?app=<?php echo $developer->unique_user_id?>">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Total no. of ticket Pending</th>
                        <td><?php echo $pending; ?></td>
                        <td width="20%">
                            <a class="rezaButt" href="<?php echo base_url() ?>TicketSysCommonController/getPendingTicketWithSelectedNicDev/?app=<?php echo $developer->unique_user_id?>">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Total no. of ticket Closed</th>
                        <td><?php echo $closed; ?></td>
                        <td width="20%">
                            <a class="rezaButt" href="<?php echo base_url() ?>TicketSysCommonController/getClosedTicketBySelectedNicDev/?app=<?php echo $developer->unique_user_id?>">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </td>
                    </tr>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>





<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/department.js'); ?>"></script>

