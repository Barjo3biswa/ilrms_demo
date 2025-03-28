<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>

<script>
    function alpineData() {
        return {
            'dist_code': "<?= $dist_code; ?>",
            'proposal_no': "<?= $proposal_no; ?>",
            'proposal': '',
            'base_url': "<?= base_url(); ?>",
            'is_loading': false,
            init() {
                this.getProposals();
            },
            getProposals() {
                this.is_loading = true;
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonMyController/getProposalStatus',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code': self.dist_code,
                        'proposal_no': self.proposal_no,
                    },
                    success: function(data) {
                        console.log(data);
                        self.proposal = data;
                        self.is_loading = false;
                    }
                });
            }
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="row">
        <div class="col-xl-8 mx-auto text-center">
            <div class="section-title">
                <h4>NC VILLAGE PROPOSAL STATUS</h4>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="timeline">
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 class=" text-light bg-success">Director of Land Records & Survey</h3>
                    <p>PROPOSAL FORWARDED TO SENIOR MOST SECRETARY.</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-text="proposal.created_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.ps_verified =='Y' ? 'bg-success' : 'bg-warning'" class=" text-light" >SENIOR MOST SECRETARY </h3>
                    <p>PROPOSAL FORWARDED TO SECRETARY.</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.ps_verified =='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="proposal.ps_verified !='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-text="proposal.ps_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.secretary_verified =='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">SECRETARY </h3>
                    <p>PROPOSAL FORWARDED TO JOINT SECRETARY.</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.secretary_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="proposal.secretary_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-text="proposal.secretary_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.joint_secretary_verified =='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">JOINT SECRETARY </h3>
                    <p>PROPOSAL FORWARDED TO SECTION OFFICER .</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.joint_secretary_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="proposal.joint_secretary_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-text="proposal.joint_secretary_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.section_officer_verified =='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">SECTION OFFICER </h3>
                    <p>PROPOSAL FORWARDED TO ASSISTANT SECTION OFFICER .</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.section_officer_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="proposal.section_officer_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-text="proposal.section_officer_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.asst_section_officer_verified =='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">ASSISTANT SECTION OFFICER </h3>
                    <p>DRAFT NOTIFICATION GENERATED AND FORWARDED TO SECTION OFFICER .</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.asst_section_officer_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="proposal.asst_section_officer_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-text="proposal.asst_section_officer_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.notification && proposal.notification.section_officer_verified=='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">SECTION OFFICER </h3>
                    <p>DRAFT NOTIFICATION FORWARDED TO JOINT SECRETARY .</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.notification && proposal.notification.section_officer_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="!proposal.notification || proposal.notification.section_officer_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-show="proposal.notification && proposal.notification.section_officer_verified=='Y'" x-text="proposal.notification.section_officer_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.notification && proposal.notification.joint_secretary_verified=='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">JOINT SECRETARY </h3>
                    <p>DRAFT NOTIFICATION FORWARDED TO SECRETARY .</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.notification && proposal.notification.joint_secretary_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="!proposal.notification || proposal.notification.joint_secretary_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-show="proposal.notification && proposal.notification.joint_secretary_verified=='Y'" x-text="proposal.notification.joint_secretary_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.notification && proposal.notification.secretary_verified=='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">SECRETARY </h3>
                    <p>DRAFT NOTIFICATION FORWARDED TO SENIOR MOST SECRETARY.</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.notification && proposal.notification.secretary_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="!proposal.notification || proposal.notification.secretary_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-show="proposal.notification && proposal.notification.secretary_verified=='Y'" x-text="proposal.notification.secretary_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.notification && proposal.notification.ps_verified=='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">SENIOR MOST SECRETARY</h3>
                    <p>DRAFT NOTIFICATION FORWARDED TO HONOURABLE MINISTER.</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.notification && proposal.notification.ps_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="!proposal.notification || proposal.notification.ps_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-show="proposal.notification && proposal.notification.ps_verified=='Y'" x-text="proposal.notification.ps_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.notification && proposal.notification.minister_verified=='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">HONOURABLE MINISTER</h3>
                    <p>DRAFT NOTIFICATION APPROVED AND FORWARDED TO SENIOR MOST SECRETARY.</p>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.notification && proposal.notification.minister_verified=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="!proposal.notification || proposal.notification.minister_verified!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-show="proposal.notification && proposal.notification.minister_verified=='Y'" x-text="proposal.notification.minister_verified_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.notification && proposal.notification.ps_sign=='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">SENIOR MOST SECRETARY</h3>
                    <p>DRAFT NOTIFICATION  APPROVED, E-SIGNED AND FORWARDED TO JOINT SECRETARY.</p>
                    <a x-show="proposal.notification && proposal.notification.ps_sign=='Y'" x-bind:href=base_url+"index.php/nc_village/NcCommonController/viewSignNotification/"+proposal.notification.notification_no target="_blank" class="btn btn-success text-white">View Notification</a>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.notification && proposal.notification.ps_sign=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="!proposal.notification || proposal.notification.ps_sign!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-show="proposal.notification && proposal.notification.ps_sign=='Y'" x-text="proposal.notification.ps_sign_at"></time>
                </div>
            </div>
            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
                    <h3 x-bind:class="proposal.notification && proposal.notification.js_sign=='Y' ? 'bg-success' : 'bg-warning'" class=" text-light">JOINT SECRETARY</h3>
                    <p>NOTIFICATION E-SIGN COMPLETED.</p>
                    <a x-show="proposal.notification && proposal.notification.js_sign=='Y'" target="_blank" x-bind:href=base_url+"index.php/nc_village/NcCommonController/viewJsSignedNotification/"+proposal.notification.notification_no class="btn btn-success text-white">View Notification</a>
                </div>
                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                    <img x-show="proposal.notification && proposal.notification.js_sign=='Y'" src="<?= base_url('assets/check.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                    <img x-show="!proposal.notification || proposal.notification.js_sign!='Y'" src="<?= base_url('assets/pending.svg') ?>" width="40px" style="color: red;" class="img-fluid" alt="img">
                </div>
                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                    <time x-show="proposal.notification && proposal.notification.js_sign=='Y'" x-text="proposal.notification.ps_sign_at"></time>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> VILLAGES
                            </h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                            <tr>
                                <th>#</th>
                                <th>District</th>
                                <th>Circle</th>
                                <th>Mouza</th>
                                <th>Lot</th>
                                <th>Village</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(village,index) in proposal.villages" :key="index">
                                <tr>
                                    <td x-text="++index"></td>
                                    <td x-text="village.dist_name"></td>
                                    <td x-text="village.circle_name"></td>
                                    <td x-text="village.mouza_name"></td>
                                    <td x-text="village.lot_name"></td>
                                    <td x-text="village.vill_name"></td>
                                </tr>
                            </template>
                            <tr x-show="proposal && proposal.villages == 0">
                                <td colspan="t" class="text-center">
                                    <span>No villages Found</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --white: #ffffff;
        --black: #000000;
        --blue: #0288d1;
        --gray: #ebebeb;
        --box-shadow1: 0px 0px 18px 2px rgba(10, 55, 90, 0.15);
    }

    body {
        font-family: 'Roboto', sans-serif;
        font-weight: lighter;
        color: #637280;
        -moz-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    :focus {
        outline: 0px solid transparent !important;
    }

    .timeline {
        padding: 50px 0;
        position: relative;
    }

    .timeline-nodes {
        padding-bottom: 25px;
        position: relative;
    }

    .timeline-nodes:nth-child(even) {
        flex-direction: row-reverse;
    }

    .timeline h3,
    .timeline p {
        padding: 5px 15px;
    }

    .timeline h3 {
        font-weight: lighter;
        /* background: var(--blue); */
    }

    .timeline p,
    .timeline time {
        /* color: var(--blue) */
    }

    .timeline::before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 50%;
        width: 0;
        border-left: 2px dashed gray;
        height: 100%;
        z-index: 1;
        transform: translateX(-50%);
    }

    .timeline-content {
        border: 1px solid gray;
        position: relative;
        border-radius: 0 0 10px 10px;
        box-shadow: 0px 3px 25px 0px rgba(10, 55, 90, 0.2)
    }

    .timeline-nodes:nth-child(odd) h3,
    .timeline-nodes:nth-child(odd) p {
        text-align: right;
    }

    .timeline-nodes:nth-child(odd) .timeline-date {
        text-align: left;
    }

    .timeline-nodes:nth-child(even) .timeline-date {
        text-align: right;
    }

    .timeline-nodes:nth-child(odd) .timeline-content::after {
        content: "";
        position: absolute;
        top: 5%;
        left: 100%;
        width: 0;
        border-left: 10px solid var(--blue);
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
    }

    .timeline-nodes:nth-child(even) .timeline-content::after {
        content: "";
        position: absolute;
        top: 5%;
        right: 100%;
        width: 0;
        border-right: 10px solid var(--blue);
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
    }

    .timeline-image {
        position: relative;
        z-index: 100;
    }

    .timeline-image::before {
        content: "";
        width: 80px;
        height: 80px;
        border: 2px dashed gray;
        border-radius: 50%;
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        z-index: 1;


    }

    .timeline-image img {
        position: relative;
        z-index: 100;
    }

    /*small device style*/

    @media (max-width: 767px) {

        .timeline-nodes:nth-child(odd) h3,
        .timeline-nodes:nth-child(odd) p {
            text-align: left
        }

        .timeline-nodes:nth-child(even) {
            flex-direction: row;
        }

        .timeline::before {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 4%;
            width: 0;
            border-left: 2px dashed gray;
            height: 100%;
            z-index: 1;
            transform: translateX(-50%);
        }

        .timeline h3 {
            font-size: 1.7rem;
        }

        .timeline p {
            font-size: 14px;
        }

        .timeline-image {
            position: absolute;
            left: 0%;
            top: 60px;
            /*transform: translateX(-50%;);*/
        }

        .timeline-nodes:nth-child(odd) .timeline-content::after {
            content: "";
            position: absolute;
            top: 5%;
            left: auto;
            right: 100%;
            width: 0;
            border-left: 0;
            border-right: 10px solid var(--blue);
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
        }

        .timeline-nodes:nth-child(even) .timeline-content::after {
            content: "";
            position: absolute;
            top: 5%;
            right: 100%;
            width: 0;
            border-right: 10px solid var(--blue);
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
        }

        .timeline-nodes:nth-child(even) .timeline-date {
            text-align: left;
        }

        .timeline-image::before {
            width: 65px;
            height: 65px;
        }
    }

    /*extra small device style */
    @media (max-width: 575px) {
        .timeline::before {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 3%;
        }

        .timeline-image {
            position: absolute;
            left: -5%;
        }

        .timeline-image::before {
            width: 60px;
            height: 60px;
        }
    }

    .section-title h4 {
        text-transform: capitalize;
        font-size: 40px;
        position: relative;
        padding-bottom: 20px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .section-title h4:before {
        position: absolute;
        content: "";
        width: 60px;
        height: 2px;
        background-color: #ff3636;
        bottom: 0;
        left: 50%;
        margin-left: -30px;
    }

    .section-title h4:after {
        position: absolute;
        background-color: #ff3636;
        content: "";
        width: 10px;
        height: 10px;
        bottom: -4px;
        left: 50%;
        margin-left: -5px;
        border-radius: 50%;
    }
</style>
