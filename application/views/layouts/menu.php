<div class="border-end" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">ILRMS Menu</div>
    <div class="list-group list-group-flush">
        <div class="sidenav">
            <button class="dropdown-btn">
                <i class="fa fa-fw fa-user"></i>&nbsp; User Management
                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                </i>&nbsp;
            </button>
            <div class="dropdown-container">
                <a href="<?= base_url() . 'user-profile' ?>" class="nav-link">
                    <i class="fa fa-fw fa-angle-right"></i>&nbsp; User Profile</a>
            </div>
            <?php if ($this->session->userdata('designation') == MOUZADAR_USERCODE) : ?>
                <a href="<?php echo base_url() . 'dashboard' ?>"><i class="fa fa-fw fa-dashboard"></i>&nbsp;Dashboard</a>

                <?php if (EKHAJANA_MOUZADAR_ACTIVE == 1) : ?>
                    <button class="dropdown-btn">
                        <i class="fa fa-fw fa-user"></i>&nbsp; Doul View
                        <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                        </i>&nbsp;
                    </button>
                    <div class="dropdown-container">
                        <a href="<?php echo base_url() . 'EkhajanaDoulController/viewDoulMouzaWise' ?>"><i class="fa fa-fw fa-address-card "></i>&nbsp;View Doul</a>
                        <a href="<?php echo base_url() . 'EkhajanaDoulController/viewDoulPattaWise' ?>"><i class="fa fa-fw fa-address-card "></i>&nbsp;View Doul Patta Wise</a>
                    </div>

                    <a href="<?php echo base_url() . 'JamaWasilController/index' ?>"><i class="fa fa-fw fa-book"></i>&nbsp;Jama-Wasil</a>
                    <a href="<?php echo base_url() . 'EkhajanaMouzadarController/amdaniReportForm' ?>"><i class="fa fa-fw fa-balance-scale"></i>&nbsp;Amdani Report</a>
                    <a href="<?php echo base_url() . 'EkhajanaArrearController/index' ?>"><i class="fa fa-book fa-fw"></i>&nbsp;Arrear Pre-Update</a>
                    <a href="<?php echo base_url() . 'EkhajanaMouzadarController/index' ?>"><i class="fa fa-fw fa-rupee"></i>&nbsp;E-khajana</a>
                    <a href="#" style="display:none;"><i class="fa fa-fw fa-balance-scale"></i>&nbsp;Amdani Report</a>
                    <!--					<a href="--><?php //echo base_url() . 'EkhajanaCommissionController/index' 
                                                        ?><!--"><i class="fa fa-fw fa-dollar"></i>&nbsp;Commission</a> -->
                    <!--					<a href="--><?php //echo base_url() . 'EkhajanaMouzadarBankDetails/mouzadarBankDetailsDataEntry' 
                                                        ?><!--"><i class="fa fa-fw fa-bank"></i>&nbsp;BANK DETAILS ENTRY</a> -->


                    <?php if (EKHAJANA_MOUZADAR_CFR_RECONCILIATON_MODULE == 1) : ?>
                        <a href="<?php echo base_url() . 'EkhajanaMouzadarCfr/index' ?>"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Manual-CFR</a>
                    <?php endif;?>

                    <?php if (EKHAJANA_CHECK_EKHAJANA_PATTA_STATUS == 1) : ?>
                        <a href="<?php echo base_url() . 'EkhajanaPatta/pattaStatus' ?>"><i class="fa fa-check"></i>&nbsp;Check Patta Status</a>
                    <?php endif;?>
                
        	<?php endif ?>
            <?php else : ?>
                <?php if ($this->session->userdata('designation') != NYKS_VOLUNTEER) : ?>
                    <a href="<?= base_url() . "user-history" ?>"><i class="fa fa-fw fa-history"></i>&nbsp; User History</a>
                <?php endif ?>

                <?php if ($this->session->userdata('designation') != NYKS_VOLUNTEER) : ?>
                    <a href="<?php echo base_url() . 'CaseHistoryController/caseHistory' ?>"><i class="fa fa-box"></i>&nbsp; Case History</a>
                    <!-- <a class="active" href="">base_url()."user-profile-create"<i
                                class="fa fa-fw fa-user"></i>&nbsp; Create User Profile</a> -->
                <?php endif ?>
            <?php endif ?>

            <?php if (($this->session->userdata('designation') == ADLR) && (ADLR_VILLAGE_REPORT == 1)) : ?>
                <a href="<?= base_url() . "reports" ?>"><i class="fa fa-fw fa-history"></i>&nbsp;Village Reports</a>


            <?php endif ?>

            <?php if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) : ?>
                <a href="<?= base_url() . 'user-profile-create-assistant' ?>" class="nav-link">
                    <i class="fa fa-fw fa-angle-right"></i>&nbsp; Profile Creation</a>

                <a style="" href="<?php echo base_url() . 'DcUserCreation/createDCUser' ?>">
                    <i class="fa fa-fw fa-plus"></i>&nbsp; Create User Profile (DC)
                </a>
                <a style="" href="<?php echo base_url() . 'AidcUserCreation/createMDUser' ?>">
                    <i class="fa fa-fw fa-plus"></i>&nbsp; Create Industrial MD User
                </a>

                <?php if (MB2_SERVICE_DISABLED == 1) : ?>

                    <button class="dropdown-btn">
                        <i class="fa fa-fw fa-edit"></i>&nbsp; CAB Memo
                        <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                        </i>&nbsp;
                    </button>
                    <div class="dropdown-container">
                        <a href="<?= base_url() . 'create-cab-id' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Create CAB ID</a>
                        <a href="<?= base_url() . 'to-be-finalize-cab' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; To be Finalize</a>
                        <a href="<?= base_url() . 'finalized-cab-id' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Finalized CAB ID</a>

                        <a href="<?= base_url() . 'approved-cab-id' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Approved List</a>
                    </div>

                <?php endif ?>


                <!-- VGR CABINET -->

                <?php if (MB2_SERVICE_DISABLED == 1) : ?>

                    <button class="dropdown-btn">
                        <i class="fa fa-fw fa-edit"></i>&nbsp; VGR CAB Memo
                        <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                        </i>&nbsp;
                    </button>
                    <div class="dropdown-container">
                        <a href="<?= base_url() . 'create-vgr-cab-id' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Create VGR CAB ID </a>
                        <a href="<?= base_url() . 'to-be-finalize-cab-vgr' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; To be Finalize (VGR)</a>
                        <a href="<?= base_url() . 'finalized-cab-id-vgr' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Finalized CAB ID (VGR)</a>

                        <a href="<?= base_url() . 'approved-cab-id-vgr' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Approved List (VGR)</a>
                    </div>
                    <a href="<?php echo base_url() ?>index.php/Basundhara/getAllCasesListByDept"><i class="fa fa-table"></i>&nbsp; View All Pending Cases</a>

                    <a href="<?php echo base_url() ?>index.php/Basundhara/getAllVgrCicleDistWise"><i class="fa fa-table"></i>&nbsp; View All PGR/VGR Cases</a>

                    <a href="<?php echo base_url() ?>index.php/Basundhara/getAllRevertedCasesListByDeptVGR"><i class="fa fa-undo"></i>&nbsp; View VGR Reverted Cases</a>


                    <a href="<?php echo base_url() ?>index.php/Basundhara/getAllRevertedCasesListByDept"><i class="fa fa-undo"></i>&nbsp; View All Reverted Cases</a>


                    <a href="<?php echo base_url() ?>index.php/Basundhara/searchCasesWithData"><i class="fa fa-search"></i>&nbsp; Cases Search</a>

                    <a href="<?php echo base_url() ?>index.php/Basundhara/clearCaseData"><i class="fa fa-trash"></i>&nbsp; Clear Case Data</a>

                <?php endif ?>



            <?php endif ?>

            <?php if ($this->session->userdata('designation') == DLR || $this->session->userdata('designation') == 'NIC') : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-user"></i>&nbsp; Service Wise
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?= base_url() . 'index.php/BasundharaApi/getRtpsData' ?>" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; MB2</a>
                    <a href="<?= base_url() . 'index.php/DlrDashboard/indexCount' ?>" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; MB2 Summery</a>
                    <a href="<?= base_url() . 'index.php/DlrDashboard/partialPaymentDayWise' ?>" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; MB2 Partial Payment</a>
                </div>

                <button class="dropdown-btn">
                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp; E-Khajana<i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;"></i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?= base_url() . 'EkhajanaDlrDashboard/getEkhajanaRtpsData' ?>" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp; Dashboard</a>
                    <?php if (EKHAJANA_MOUZADAR_BANK_DETAILS_DATA_ENTRY == 1) : ?>
                        <a href="<?php echo base_url() . 'EkhajanaMouzadarBankDetails/mouzadarBankDetailsDataEntry' ?>"><i class="fa fa-fw fa-angle-right"></i>&nbsp;BANK DETAILS ENTRY</a>
                    <?php endif ?>
                    <a href="<?php echo base_url() ?>index.php/EkhajanaDoatReportController/getEkhajanaDoatReport"><i class="fa fa-fw fa-angle-right"></i>&nbsp; Ekhajana DOAT report</a>
                    <a href="<?php echo base_url() ?>index.php/EkhajanaDlrDashboard/getEkhajanaMouzaWiseDemandSatsisfiedReport"><i class="fa fa-fw fa-angle-right"></i>&nbsp; Demand Satisfied Info</a>
                    <a href="<?php echo base_url() ?>index.php/EkhajanaDlrDashboard/getDpFlaggingReportDistWise"><i class="fa fa-fw fa-angle-right"></i>&nbsp; DP Flagging Report</a>
                </div>
            <?php endif ?>

            <!--  START NC VILLAGE MENU-->
            <?php if ($this->session->userdata('designation') == DPT_PS) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcDepartController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
            <?php endif ?>

            <?php if ($this->session->userdata('designation') == DPT_SEC) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcSecretaryController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
            <?php endif ?>

            <?php if ($this->session->userdata('designation') == DPT_JSEC) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcJointSecretaryController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
            <?php endif ?>
            <?php if ($this->session->userdata('designation') == DPT_SO) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcSectionOfficerController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
            <?php endif ?>
            <?php if ($this->session->userdata('designation') == DPT_ASO) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcAsstSectionOfficerController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
            <?php endif ?>
            <?php if ($this->session->userdata('designation') == MINISTER) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcMinisterController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
            <?php endif ?>

            <?php if ($this->session->userdata('designation') == DLR  || $this->session->userdata('designation') == 'NIC') : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcDashboardController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Dashboard</a>

                    <a href="<?php echo base_url() ?>index.php/nc_village/NcDlrController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
            <?php endif ?>
            <?php if ($this->session->userdata('designation') == ADLR  || $this->session->userdata('designation') == 'NIC') : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcAdlrController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
            <?php endif ?>

            <?php if ($this->session->userdata('designation') == ADS) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; Village Map
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/map/AdsMapController/selectLocation" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; Upload Map </a>
                </div>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcAdsController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village </a>
                </div>
            <?php endif ?>

            <?php if ($this->session->userdata('designation') == JDS) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; Village Map
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/map/JdsMapController/viewPendingMaps" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; View Pending Map </a>
                </div>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-home"></i>&nbsp; NC Village
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <!--                <div class="dropdown-container">-->
                <!--                    <a href="--><?php //echo base_url() 
                                                    ?><!--index.php/nc_village/NcJdsController/viewPendingCasesPage" class="nav-link">-->
                <!--                    <i class="fa fa-fw fa-angle-right"></i>&nbsp; View NC Village</a>-->
                <!--                </div>-->
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/nc_village/NcJdsController/dashboard" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; NC Village Process</a>
                </div>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-list"></i>&nbsp; Utility
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?php echo base_url() ?>index.php/LocationController/addVillageForm" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; Add New Village</a>
                </div>
            <?php endif ?>

            <!--  END NC VILLAGE MENU-->

            <?php if ($this->session->userdata('designation') == SDLAC_USERCODE) : ?>
                <a href="<?php echo base_url() ?>index.php/Basundhara/getAllProposalListUnderSdlac"><i class="fa fa-fw fa-address-card "></i>&nbsp; SDLAC Proposal by Meeting</a>

                <a href="<?php echo base_url() ?>index.php/Basundhara/getAllProposalListUnderSdlacOnlineOffline"><i class="fa fa-list"></i>&nbsp; All Proposal List</a>

                <a href="<?php echo base_url() ?>index.php/Basundhara/searchCasesSdlac"><i class="fa fa-search"></i>&nbsp; Cases Search</a>
            <?php endif ?>



            <?php if (($this->session->userdata('designation') == ASSISTANT_USERCODE) || ($this->session->userdata('designation') == UNDER_SEC_USERCODE)) : ?>

                <a href="<?php echo base_url() ?>index.php/Basundhara/getCasesListByDistrict"><i class="fa fa-table"></i>&nbsp; View All Case List</a>


                <a href="<?php echo base_url() ?>index.php/Basundhara/searchCasesWithData"><i class="fa fa-search"></i>&nbsp; Cases Search</a>


            <?php endif ?>

            <?php if ($this->session->userdata('unique_user_id') == CONVERSION_USER) : ?>

                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-edit"></i>&nbsp; Conversion
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a href="<?= base_url() . 'manage-conversion-cabinet' ?>" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; Manage Cabinet
                    </a>
                    <a style="" href="<?php echo base_url() . 'pending-conversion-cases' ?>">
                        <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
                    </a>
                    <a style="" href="<?php echo base_url() . 'conversion-proposal-cases' ?>">
                        <i class="fa fa-clock-o"></i>&nbsp;Cases for Proposal
                    </a>
                    <a style="" href="<?php echo base_url() . 'conversion-proposal-list' ?>">
                        <i class="fa fa-clock-o"></i>&nbsp;Proposal List
                    </a>
                    <a style="" href="<?php echo base_url() . 'to-be-finalize-conversion-cabinet' ?>">
                        <i class="fa fa-fw fa-plus"></i>&nbsp;To be Finalize Cabinet
                    </a>
                    <a href="<?= base_url() . 'finalized-conversion-cabinet' ?>" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; Finalized Cabinet</a>

                    <a href="<?= base_url() . 'approved-conversion-cabinet' ?>" class="nav-link">
                        <i class="fa fa-check-circle"></i>&nbsp; Approved Cabinet</a>
                </div>



            <?php endif ?>

            <?php if ($this->session->userdata('designation') == DPT_PS) : ?>

                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-edit"></i>&nbsp; Conversion
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a style="" href="<?php echo base_url() . 'conversion-proposal-list' ?>">
                        <i class="fa fa-clock-o"></i>&nbsp;Proposal List
                    </a>

                    <a style="" href="<?php echo base_url() . 'conversion-cabinet-ps' ?>">
                        <i class="fa fa-fw fa-plus"></i>&nbsp; Conversion Cabinet
                    </a>

                </div>
            <?php endif ?>

            <?php if ($this->session->userdata('designation') == DPT_SO) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-edit"></i>&nbsp; Conversion
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a style="" href="<?php echo base_url() . 'pending-conversion-cases' ?>">
                        <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
                    </a>
		</div>

                  <!-- Digitalized Settlement of land to non-individual juridical entities  starts -->
            <div class="dropdown-btn" id="tea-grant-btn">
                <i class="fa-solid fa fa-check-circle"></i>&nbsp;JURIDICAL ENTITIES
                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 20px;"></i>
            </div>
            <div class="dropdown-container" id="tea-grant-menu">
                <!-- Pending Cases Link -->
                <a style="display: block;" href="<?php echo base_url() . 'pending-juridical-cases' ?>">
                    <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
                </a>
            </div>

            <!-- Offering Reclassification Suite  starts -->
            <div class="dropdown-btn" id="tea-grant-btn">
                <i class="fa-solid fa fa-check-circle"></i>&nbsp;Reclassification Suite
                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 20px;"></i>
            </div>
            <div class="dropdown-container" id="tea-grant-menu">
                <!-- Pending Cases Link -->
                <a style="display: block;" href="<?php echo base_url() . 'pending-reclass-suite-cases' ?>">
                    <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
                </a>
            </div>

            <?php endif ?>

            <?php if ($this->session->userdata('designation') == ASSISTANT_USERCODE) : ?>
                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-edit"></i>&nbsp; Conversion
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">
                    <a style="" href="<?php echo base_url() . 'pending-conversion-cases' ?>">
                        <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
                    </a>
                </div>
            <?php endif ?>


            <?php if ($this->session->userdata('designation') != NYKS_VOLUNTEER && $this->session->userdata('designation') != (MOUZADAR_USERCODE || 'MOU' || 'MOUZADAR')) : ?>
                <a href="<?php echo base_url() . 'Welcome/deed_list' ?>"><i class="fa fa-box"></i>&nbsp; Epanjeeyan Deed List</a>
            <?php endif ?>
            <?php if (($this->session->userdata('designation') == ADLR) || ($this->session->userdata('designation') == 'NIC') && (NEW_REVENUE_DASHBORAD_ENABLE == 1)) : ?>
                <a class="active" href="<?php echo base_url(); ?>index.php/RevenueDashboard/dashboardIndex"><i class="fa fa-fw fa-dashboard"></i>&nbsp; Revenue Dashboard</a>
            <?php endif ?>



            <?php if ($this->session->userdata('designation') == DPT_SEC) : ?>

                <button class="dropdown-btn">
                    <i class="fa fa-fw fa-edit"></i>&nbsp; Conversion
                    <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                    </i>&nbsp;
                </button>
                <div class="dropdown-container">

                    <a style="" href="<?php echo base_url() . 'conversion-proposal-list' ?>">
                        <i class="fa fa-clock-o"></i>&nbsp;Proposal List
                    </a>

                </div>

            <?php endif ?>

            <!-- New code by Masud Reza 12/07/2024-->
            <?php if (TICKET_SYSTEM_NIC_LIVE  == 1) : ?>
                <?php if ($this->session->userdata('designation') == TICKET_SYSTEM_NIC_ADMIN) : ?>
                    <button class="dropdown-btn">
                        <i class="fa fa-fw fa-bug"></i>&nbsp; Ticket System
                        <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                        </i>&nbsp;
                    </button>
                    <div class="dropdown-container">
                        <a href="<?= base_url() . 'get-dashboard-nic-man' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Dashboard
                        </a>
                        <a href="<?= base_url() . 'ticket-search-nic-man' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Search
                        </a>
                        <button class="dropdown-btn">
                            <i class="fa fa-fw fa-bug"></i>&nbsp; Ticket
                            <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                            </i>&nbsp;
                        </button>
                        <div class="dropdown-container">
                            <a href="<?= base_url() . 'pending-ticket-nic-man' ?>" class="nav-link">
                                <i class="fa fa-fw fa-angle-right"></i>&nbsp; Pending
                            </a>
                            <a href="<?= base_url() . 'in-queue-ticket-nic-man' ?>" class="nav-link">
                                <i class="fa fa-fw fa-angle-right"></i>&nbsp; Assigned to Dev
                            </a>
                            <a href="<?= base_url() . 'under-processing-ticket-nic-man' ?>" class="nav-link">
                                <i class="fa fa-fw fa-angle-right"></i>&nbsp; Request for Closed
                            </a>
                            <a href="<?= base_url() . 'closed-ticket-nic-man' ?>" class="nav-link">
                                <i class="fa fa-fw fa-angle-right"></i>&nbsp; Closed
                            </a>
                            <a href="<?= base_url() . 'rejected-ticket-nic-man' ?>" class="nav-link">
                                <i class="fa fa-fw fa-angle-right"></i>&nbsp; Rejected
                            </a>
                        </div>
                        <a href="<?= base_url() . 'get-nic-developer' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; NIC Developer
                        </a>
                        <a href="<?= base_url() . 'get-application' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Application Type
                        </a>
                        <a href="<?= base_url() . 'get-service-type' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Service Type
                        </a>
                        <a href="<?= base_url() . 'get-ticket-type' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Ticket Type
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->userdata('designation') == TICKET_SYSTEM_NIC_DEVELOPER) : ?>
                    <button class="dropdown-btn">
                        <i class="fa fa-fw fa-bug"></i>&nbsp; Ticket System
                        <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                        </i>&nbsp;
                    </button>
                    <div class="dropdown-container">
                        <a href="<?= base_url() . 'assign-ticket-list-dev' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Assigned Ticket
                        </a>
                        <a href="<?= base_url() . 'request-for-closed-dev' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Request for Closed
                        </a>
                        <a href="<?= base_url() . 'closed-ticket-list-dev' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Closed Ticket
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->userdata('designation') == TICKET_SYSTEM_ADLR) : ?>
                    <button class="dropdown-btn">
                        <i class="fa fa-fw fa-bug"></i>&nbsp; Ticket System
                        <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                        </i>&nbsp;
                    </button>
                    <div class="dropdown-container">
                        <a href="<?= base_url() . 'ticket-dashboard-for-adlr' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Dashboard
                        </a>
                        <a href="<?= base_url() . 'ticket-search-for-adlr' ?>" class="nav-link">
                            <i class="fa fa-fw fa-angle-right"></i>&nbsp; Search
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


            <?php if ($this->session->userdata('designation') == DLR || $this->session->userdata('designation') == ADLR  || $this->session->userdata('designation') == 'NIC') : ?>
                <a href="<?= base_url() . "village-type-list" ?>"><i class="fa fa-list"></i>&nbsp;Village Type List</a>
                <a href="<?= base_url() . "patta-type-list" ?>"><i class="fa fa-list"></i>&nbsp;Patta Type List</a>
                <a href="<?= base_url() . "landclass-type-list" ?>"><i class="fa fa-list"></i>&nbsp;Land Class Type List</a>

                <a href="<?= base_url() . "lgd-code-list-exist" ?>"><i class="fa fa-list"></i>&nbsp;LGD Code Exist List</a>
                <a href="<?= base_url() . "lgd-code-not-exist" ?>"><i class="fa fa-list"></i>&nbsp;LGD Code Not Exist List</a>

                <a href="<?= base_url() . "dag-reports" ?>"><i class="fa fa-list"></i>&nbsp;Dag Details Report</a>
            <?php endif; ?>
 <?php if ($this->session->userdata('designation') == DLR || $this->session->userdata('designation') == 'NIC') : ?>
		<a href="<?= base_url() . "review" ?>"><i class="fa fa-list"></i>&nbsp;MB2 Review Cases</a>
           <a href="<?= base_url() . "chitha-data-reports" ?>"><i class="fa fa-list"></i>&nbsp;Chitha Details</a>

           <?php endif; ?>
           <!-- /////////OFFLINE SETTLEMENT START//////////// -->
            <?php if ($this->session->userdata('designation') == DEPARTMENT_USERCODE && OFFLINE_SETTLEMENT_OPEN == 1) : ?>
					<button class="dropdown-btn">
						<i class="fa fa-fw fa-angle-right"></i>&nbsp; Offline Settlement
						<i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
						</i>&nbsp;
					</button>
					<div class="dropdown-container">
						<a href="<?php echo base_url() ?>index.php/OfflineSettlement/getAllCasesListByDept" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp;Pending Cases</a>
						<a href="<?php echo base_url() ?>index.php/OfflineSettlement/getAllRevertedCasesListByDept" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp;Reverted Cases</a>
						<a href="<?= base_url() . 'create-cab-id-offline' ?>" class="nav-link">
							<i class="fa fa-fw fa-angle-right"></i>&nbsp; Create CAB ID</a>
						<a href="<?= base_url() . 'to-be-finalize-cab-offline' ?>" class="nav-link">
							<i class="fa fa-fw fa-angle-right"></i>&nbsp; To be Finalize</a>
						<a href="<?= base_url() . 'finalized-cab-id-offline' ?>" class="nav-link">
							<i class="fa fa-fw fa-angle-right"></i>&nbsp; Finalized CAB ID</a>
						<a href="<?= base_url() . 'approved-cab-id-offline' ?>" class="nav-link">
							<i class="fa fa-fw fa-angle-right"></i>&nbsp; Approved List</a>
						
					</div>
	    <?php endif ?>
            <?php if ($this->session->userdata('designation') ==  DEPARTMENT_USERCODE && NC_SETTLEMENT_OPEN == 1) : ?>
				<button class="dropdown-btn">
					<i class="fa fa-fw fa-angle-right"></i>NC Settlement(MB3)
					<i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
					</i>&nbsp;
				</button>
				<div class="dropdown-container">
					<a href="<?php echo base_url() ?>index.php/NcSettlement/getAllCasesListByDept" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp;Pending Cases</a>
					<a href="<?php echo base_url() ?>index.php/NcSettlement/getAllRevertedCasesListByDept" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp;Reverted Cases</a>
					<a href="<?= base_url() . 'create-cab-id-nc' ?>" class="nav-link">
						<i class="fa fa-fw fa-angle-right"></i>&nbsp; Create CAB ID</a>
					<a href="<?= base_url() . 'to-be-finalize-cab-nc' ?>" class="nav-link">
						<i class="fa fa-fw fa-angle-right"></i>&nbsp; To be Finalize</a>
					<a href="<?= base_url() . 'finalized-cab-id-nc' ?>" class="nav-link">
						<i class="fa fa-fw fa-angle-right"></i>&nbsp; Finalized CAB ID</a>
					<a href="<?= base_url() . 'approved-cab-id-nc' ?>" class="nav-link">
						<i class="fa fa-fw fa-angle-right"></i>&nbsp; Approved List</a>
					
				</div>
	    <?php endif ?>

        <?php if ($this->session->userdata('designation') == NYKS_VOLUNTEER) : ?>
            <a href="<?php echo base_url() . 'Nyks/eID' ?>"><i class="fa fa-id-card" aria-hidden="true"></i>  &nbsp;e-ID</a>
            <a href="<?= base_url() . 'dashboard'?>"><i class="fa fa-tachometer" aria-hidden="true"></i>  &nbsp;Dashboard</a>  
            <!-- <a href="https://basundhara.assam.gov.in/ekhazana" target ="_ekhajanaPortal"><i class="fas fa-laptop-code"></i>  &nbsp;e-Khazana Portal</a>   -->
	    <a href="<?= base_url() . 'Nyks/Registration' ?>" target ="_ekhajanaReg"><i class="fa fa-registered" aria-hidden="true"></i>  &nbsp;Registration</a>  
            <button class="dropdown-btn">
                <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; Feedback
                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                </i>&nbsp;
            </button>
            <div class="dropdown-container">
                <a href="<?= base_url() . 'Nyks/MutiApply' ?>"><i class="fa fa-file-text" aria-hidden="true"></i>  &nbsp;Feedback Form</a>
                <a href="<?= base_url() . 'Nyks/FeedBackList' ?>"><i class="fa fa-list-ol" aria-hidden="true"></i>  &nbsp;Feedback List</a>
            </div>
        <?php endif;?>
        
        <?php if ($this->session->userdata('designation') == JDS) : ?>
				<button class="dropdown-btn">
					<i class="fa fa-fw fa-angle-right"></i>Reclass Suite
					<i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
					</i>&nbsp;
				</button>
				<div class="dropdown-container">
					<a href="<?php echo base_url() ?>index.php/ReclassificationSuiteSurvey/getAllCasesListByDept" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp;Pending Cases</a>
					<a href="<?php echo base_url() ?>index.php/ReclassificationSuiteSurvey/getAllRevertedCasesListByDept" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp;Reverted Cases</a>
				</div>
			<?php endif ?>

        <?php if ($this->session->userdata('designation') == ADS) : ?>
				<button class="dropdown-btn">
					<i class="fa fa-fw fa-angle-right"></i>Reclass Suite
					<i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
					</i>&nbsp;
				</button>
				<div class="dropdown-container">
					<a href="<?php echo base_url() ?>index.php/ReclassificationSuiteSurvey/getAllCasesListByDeptAds" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp;Pending Cases</a>
				</div>
			<?php endif ?>

			<?php if ($this->session->userdata('designation') == DLR) : ?>
				<button class="dropdown-btn">
					<i class="fa fa-fw fa-angle-right"></i>Reclass Suite
					<i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
					</i>&nbsp;
				</button>
				<div class="dropdown-container">
					<a href="<?php echo base_url() ?>index.php/ReclassificationSuiteSurvey/getAllCasesListByDeptDlr" class="nav-link"><i class="fa fa-fw fa-angle-right"></i>&nbsp;Pending Cases</a>
				</div>
             <?php endif ?>
	     <!-- MENU FOR MB 3.0 STARTS -->
        <!-- MB 3.0 Section -->
        <?php if (($this->session->userdata('designation') == DPT_JS) || ($this->session->userdata('designation') == ASSISTANT_USERCODE)):?>
	        <div class="dropdown-btn" id="mb3-btn">
	            <i class="fa-solid fa fa-check-circle"></i>&nbsp; MB 3.0
	            <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;"></i>
	        </div>

	        <!-- Tea Grant Section -->
	        <div class="dropdown-container" id="tea-grant-section">
	            <div class="dropdown-btn" id="tea-grant-btn">
	                <i class="fa-solid fa fa-check-circle"></i>&nbsp; TEA GRANT
	                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;"></i>
	            </div>
	            <div class="dropdown-container" id="tea-grant-menu">
	                <!-- Pending Cases Link -->
	                <a style="display: block;" href="<?php echo base_url() . 'pending-tea-grant-cases' ?>">
	                    <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
	                </a>
	            </div>
	            <!-- Tea grant ends -->
	            <!-- Conversion starts -->
	            <div class="dropdown-btn" id="tea-grant-btn">
	                <i class="fa-solid fa fa-check-circle"></i>&nbsp; CONVERSION
	                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;"></i>
	            </div>
	            <div class="dropdown-container" id="tea-grant-menu">
	                <!-- Pending Cases Link -->
	                <a style="display: block;" href="<?php echo base_url() . 'pending-conversion-cases-new' ?>">
	                    <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
	                </a>
	            </div>
	            <!-- Conversion ends -->
	            <!-- Tenant starts -->
	            <div class="dropdown-btn" id="tea-grant-btn">
	                <i class="fa-solid fa fa-check-circle"></i>&nbsp;OCCUPANCY TENANT
	                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 20px;"></i>
	            </div>
	            <div class="dropdown-container" id="tea-grant-menu">
	                <!-- Pending Cases Link -->
	                <a style="display: block;" href="<?php echo base_url() . 'pending-tenant-cases' ?>">
	                    <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
	                </a>
	            </div>

	            <!-- Digitalized Settlement of land to non-individual juridical entities  starts -->
	            <div class="dropdown-btn" id="tea-grant-btn">
	                <i class="fa-solid fa fa-check-circle"></i>&nbsp;JURIDICAL ENTITIES
	                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 20px;"></i>
	            </div>
	            <div class="dropdown-container" id="tea-grant-menu">
	                <!-- Pending Cases Link -->
	                <a style="display: block;" href="<?php echo base_url() . 'pending-juridical-cases' ?>">
	                    <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
	                </a>
	            </div>

	            <!-- Offering Reclassification Suite  starts -->
	            <div class="dropdown-btn" id="tea-grant-btn">
	                <i class="fa-solid fa fa-check-circle"></i>&nbsp;Reclassification Suite
	                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 20px;"></i>
	            </div>
	            <div class="dropdown-container" id="tea-grant-menu">
	                <!-- Pending Cases Link -->
	                <a style="display: block;" href="<?php echo base_url() . 'pending-reclass-suite-cases' ?>">
	                    <i class="fa fa-clock-o"></i>&nbsp;Pending Cases
	                </a>
	            </div>
                </div>
	    <?php endif;?>
	    <?php if (($this->session->userdata('designation') == DPT_JS)):?>
	            <!-- Tenant ends -->
	            <div class="dropdown-btn" id="tea-grant-btn">
	                <i class="fa-solid fa fa-check-circle"></i>&nbsp; CABINET
	                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;"></i>
	            </div>
	            <div class="dropdown-container" id="cabinet-menu">
	                <!-- Manage Cabinet Link -->
	                <a style="display: block;" href="<?php echo base_url() . 'manage-mb3-cabinet' ?>">
	                    <i class="fa fa-clock-o"></i>&nbsp;Manage Cabinet
	                </a>
	                <a style="" href="<?php echo base_url() . 'to-be-finalize-mb3-cabinet' ?>">
	                    <i class="fa fa-caret-square-o-right"></i>&nbsp;To be Finalize Cabinet
	                </a>
	                <a href="<?= base_url() . 'finalized-mb3-cabinet' ?>" class="nav-link">
	                    <i class="fa fa-hand-o-right"></i>&nbsp; Finalized Cabinet
	                </a>
	            </div>
	    <?php endif;?>
        <!-- MENU FOR MB 3.0 ENDS -->
        <!-- MENU FOR MB 2.0 STARTS -->
        <?php if (($this->session->userdata('designation') == DPT_JS)):?>
            <button class="dropdown-btn">
                <i class="fa fa-fw fa-home"></i>&nbsp; MB 2.0
                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                </i>&nbsp;
            </button>
            <div class="dropdown-container">
                <a href="<?= base_url() . 'review-pending-case-landing' ?>" class="nav-link">
                    <i class="fa fa-fw fa-angle-right"></i>&nbsp; Review Pending Cases</a>
                <a href="<?= base_url() . 'perpetual-pending-case-landing' ?>" class="nav-link">
                    <i class="fa fa-fw fa-angle-right"></i>&nbsp; Perpetual Pending Cases</a>
                <a href="<?= base_url() . 'CabControllerReviewPerpetual/createCabId' ?>" class="nav-link">
                    <i class="fa fa-clock-o"></i>&nbsp; Manage Cabinet</a>
                <a href="<?= base_url() . 'CabControllerReviewPerpetual/toBeFinalizeCabId' ?>" class="nav-link">
                    <i class="fa fa-caret-square-o-right"></i>&nbsp; To be Finalize Cabinet</a>
                <a href="<?= base_url() . 'CabControllerReviewPerpetual/finalApproveCabId' ?>" class="nav-link">
                    <i class="fa fa-hand-o-right"></i>&nbsp; Finalized Cabinet</a>
            </div>
        <?php endif;?>
        <?php if (($this->session->userdata('designation') == ASSISTANT_USERCODE)):?>
            <!-- MENU FOR MB 3.0 ENDS -->
            <button class="dropdown-btn">
                <i class="fa fa-fw fa-home"></i>&nbsp; MB 2.0 Pending
                <i class="fa fa-fw fa-caret-down" style="padding-top: 15px; padding-right: 40px;">
                </i>&nbsp;
            </button>
            <div class="dropdown-container">
                    <a href="<?= base_url() . 'review-pending-case-ast' ?>" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; Review </a>
                    <a href="<?= base_url() . 'perpetual-pending-case-ast' ?>" class="nav-link">
                        <i class="fa fa-fw fa-angle-right"></i>&nbsp; Perpetual </a>
            </div>
        <?php endif;?>
        </div>
    </div>
</div>
