<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'LoginController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//////////history///////
$route['user-history'] = 'DepartmentController/history';

$route['dashboard'] = 'Home/index';
$route['dashboard-api'] = 'Home/dashboardAPIPort';
$route['dashboard-api-curl'] = 'Home/dashboardAPICurl';

//********** User **********//
$route['login'] = 'LoginController/index';
$route['loginProcess'] = 'LoginController/loginProcess';
$route['logout'] = 'LoginController/logout';
$route['change-password'] = 'UserController/dpartChangePassword';
$route['user-profile'] = 'UserController/departUserProfile';
$route['re-captcha'] = 'LoginController/getReCaptcha';

$route['user-profile-update'] = 'UserController/updateDpartUserProfile';

//add user
$route['user-profile-create'] = 'UserController/createDpartUserProfile';
$route['user-profile-create-save'] = 'UserController/createDpartUserProfileSave';

$route['dashboard'] = 'Home/dashboard';
$route['getDetail'] = 'Home/dashboardAPICurl';

//number of dags
$route['number-of-dags-district-wise'] = 'DistrictWiseController/numberOfDagDistrictWise';
$route['number-of-dags-circle-wise/(:any)'] = 'CircleWiseController/numberOfDagCircleWise/$1';
$route['number-of-dags-lot-wise'] = 'LotWiseController/numberOfDagLotWise';
$route['number-of-dags-village-wise'] = 'VillageWiseController/numberOfDagVillageWise';


//Total Patta
$route['patta-type-wise'] = 'DistrictWiseController/pattaTypeWise';
$route['total-patta-district-wise'] = 'DistrictWiseController/totalPattaDistrictWise';
$route['total-patta-circle-wise/(:any)'] = 'CircleWiseController/totalPattaCircleWise/$1';
$route['patta-type-district-wise'] = 'DistrictWiseController/pattaTypeDistrictWise';
$route['patta-type-circle-wise/(:any)'] = 'CircleWiseController/pattaTypeCircleWise';
$route['annual-patta-district-wise'] = 'DistrictWiseController/annualPattaDistrictWise';
$route['annual-patta-circle-wise/(:any)'] = 'CircleWiseController/annualPattaCircleWise';

$route['periodic-patta-district-wise'] = 'DistrictWiseController/periodicPattaDistrictWise';
$route['periodic-patta-circle-wise/(:any)'] = 'CircleWiseController/periodicPattaCircleWise';


//Total Land Area
$route['total-land-area-brahmaputra-valley-district-wise'] = 'DistrictWiseController/totalBrahmaputraLandAreaDistrictWise';
$route['total-land-area-barak-valley-district-wise'] = 'DistrictWiseController/totalBarakLandAreaDistrictWise';
$route['total-land-area-circle-wise/(:any)'] = 'CircleWiseController/totalLandAreaCircleWise/$1';
$route['total-land-area-lot-wise'] = 'LotWiseController/totalLandAreaLotWise';
$route['total-land-area-village-wise'] = 'VillageWiseController/totalLandAreaVillageWise';

//Annual patta dags
$route['ap-dags-district-wise'] = 'DistrictWiseController/apDagDistrictWise';
$route['ap-dags-circle-wise'] = 'CircleWiseController/apDagCircleWise';
$route['ap-dags-village-wise'] = 'VillageWiseController/apDagVillageWise';
$route['ap-dags-lot-wise'] = 'LotWiseController/apDagLotWise';

//periodic atta dags
$route['pp-dags-district-wise'] = 'DistrictWiseController/ppDagDistrictWise';
$route['pp-dags-circle-wise'] = 'CircleWiseController/ppDagCircleWise';
$route['pp-dags-village-wise'] = 'VillageWiseController/ppDagVillageWise';
$route['pp-dags-lot-wise'] = 'LotWiseController/ppDagLotWise';

//govt dags
$route['govt-dags-district-wise'] = 'DistrictWiseController/govtDagDistrictWise';
$route['govt-dags-circle-wise'] = 'CircleWiseController/govtDagCircleWise';
$route['govt-dags-village-wise'] = 'VillageWiseController/govtDagVillageWise';
$route['govt-dags-lot-wise'] = 'LotWiseController/govtDagLotWise';

//area of survey data
$route['area-of-survey-district-wise'] = 'DistrictWiseController/areaOfSurveyDistrictWise';
$route['area-of-survey-circle-wise'] = 'CircleWiseController/areaOfSurveyCircleWise';
$route['area-of-survey-village-wise'] = 'VillageWiseController/areaOfSurveyVillageWise';
$route['area-of-survey-lot-wise'] = 'LotWiseController/areaOfSurveyLotWise';

//Pattadar
$route['total-pattadar-district-wise'] = 'DistrictWiseController/totalPattadarDistrictWise';
$route['total-pattadar-circle-wise/(:any)'] = 'CircleWiseController/totalPattadarCircleWise/$1';

//zonal
$route['zonal-value-dag-village-wise'] = 'StateWiseController/zonalDagVillageWise';
$route['zonal-dag-district-wise'] = 'DistrictWiseController/zonalDagDistrictWise';
$route['zonal-dag-circle-wise/(:any)'] = 'CircleWiseController/zonalDagCircleWise/$1';
$route['zonal-dag-village-wise'] = 'VillageWiseController/zonalDagVillageWise';

$route['zonal-village-district-wise'] = 'DistrictWiseController/zonalVillageDistrictWise';
$route['zonal-village-circle-wise/(:any)'] = 'CircleWiseController/zonalVillageCircleWise/$1';
$route['zonal-village-village-wise'] = 'VillageWiseController/zonalVillageVillageWise';


//village-land-bank 
$route['village-land-bank-district-wise'] = 'DistrictWiseController/vlbDistrictWise';
$route['village-land-bank-circle-wise/(:any)'] = 'CircleWiseController/vlbCircleWise/$1';
$route['village-land-bank-village-wise'] = 'VillageWiseController/vlbVillageWise';

//khatian 
$route['khatian-district-wise'] = 'DistrictWiseController/khatianDistrictWise';
$route['khatian-circle-wise/(:any)'] = 'CircleWiseController/khatianCircleWise/$1';
$route['khatian-village-wise'] = 'VillageWiseController/khatianVillageWise';

//Porting
$route['port'] = 'LoginController/dashboardAPIPort';

$route['postDepartmentUser'] = 'DepartmentApi/postDepartmentUser';


// New added for SDLAC Sign Up
//aadhaar verification
$route['verify-aadhar'] = 'AadhaarAuth/verifyAadhaar';
$route['userCreation'] = 'AadhaarAuth/userCreateWithAadhaarAuth';
$route['save-aadhaar-auth-data'] = 'AadhaarAuth/saveData';


$route['link-account-with-aadhaar'] = 'AadhaarAuth/ilrmsLinkAadhaar';
$route['linkAadhaarForm'] = 'AadhaarAuth/linkAadhaarAuthUserAccount';

$route['save-auth-data'] = 'AadhaarAuth/saveDataWithoutAadhar';


//******* added on 22/08/2023
$route['create-cab-id'] = 'CabController/createCabId';
$route['to-be-finalize-cab'] = 'CabController/toBeFinalizeCabId';
$route['finalized-cab-id'] = 'CabController/finalApproveCabId';



$route['user-profile-create-assistant'] = 'UserController/createDpartUserProfileAssistant';
$route['user-profile-create-assistant-save'] = 'UserController/createDpartUserProfileAssistantSave';
$route['approved-cab-id'] = 'CabController/deptApprovedCabIdList';


////For VGR /PGR

$route['create-vgr-cab-id'] = 'CabController/createVGRCabId';
$route['to-be-finalize-cab-vgr'] = 'CabController/toBeFinalizeVGRCabId';
$route['finalized-cab-id-vgr'] = 'CabController/finalApproveCabIdVGR';
$route['approved-cab-id-vgr'] = 'CabController/deptApprovedCabIdListVGR';


$route['dc_profile_creation'] = 'DcUserCreation/createDCUser';
$route['dc-profile-create-save'] = 'DcUserCreation/createDCUserProfileSave';


$route['basundhara-services'] = 'Basundhara/basundharaAllServices';


$route['case-history'] = 'CaseHistoryController/caseHistory';



///////////////////////////NC Village Settlement Routes/////////////////////////////////////

$route['create-nc-village-cab'] = 'CabController/createCabId';


$route['update-mobile-no'] = 'LoginController/updateMobileNo';
$route['get-otp-on-mobile'] = 'LoginController/getOtpOnMobileNo';
$route['btn-submit-otp'] = 'LoginController/submitOtp';
$route['otp-verify-login'] = 'LoginController/verifyOtpAndLogin';


$route['reports'] = 'AdlrReportController/reports';

$route['pending-conversion-cases'] = 'DeptConversion/conversionLanding';
$route['conversion-proposal-cases'] = 'DeptConversion/conversionProposalCases';
$route['conversion-proposal-list'] = 'DeptConversion/conversionProposalList';

$route['manage-conversion-cabinet'] = 'DeptConversion/manageConversionCabinet';
$route['to-be-finalize-conversion-cabinet'] = 'DeptConversion/toBeFinalizeConversionCabinet';
$route['finalized-conversion-cabinet'] = 'DeptConversion/finalizedConversionCabinet';
$route['approved-conversion-cabinet'] = 'DeptConversion/approvedConversionCabinet';

$route['conversion-cabinet-ps'] = 'DeptConversion/conversionPendingCabinetPS';

$route['clear-conversion-cases'] = 'DeptConversion/clearConversionCaseData';


//////////////////////////////////////////////////////////////////////////

$route['village-type-list'] = 'AdlrReportController/adlrReportList';
$route['patta-type-list'] = 'AdlrReportController/adlrReportList';
$route['landclass-type-list'] = 'AdlrReportController/adlrReportList';










$route['dc-profile-create-save'] = 'DcUserCreation/createDCUserProfileSave';


$route['get-lots'] = 'Home/getLots';
$route['get-villages'] = 'Home/getVillages';



// New Code by Masud Reza 12/07/2024
$route['get-application']     = 'TicketSysCommonController/createApplication';
$route['save-application']    = 'TicketSysCommonController/saveApplicationData';
$route['get-service-type']    = 'TicketSysCommonController/createServiceType';
$route['save-service-type']   = 'TicketSysCommonController/saveServiceTypeData';
$route['get-ticket-type']     = 'TicketSysCommonController/createTicketType';
$route['save-ticket-type']    = 'TicketSysCommonController/saveTicketTypeData';
$route['get-nic-developer']   = 'TicketSysCommonController/getAllNicDeveloperData';
$route['update-application']  = 'TicketSysCommonController/updateApplicationData';
$route['update-service-type'] = 'TicketSysCommonController/updateServiceTypeData';

$route['pending-ticket-assign-man']       = 'TicketNicManController/getPendingTicketNicMan';
$route['assign-ticket-to-dev']            = 'TicketNicManController/getAssignTicketToNicDev';
$route['rejected-ticket-list']            = 'TicketNicManController/getRejectedTicketNicMan';
$route['closed-ticket-list']              = 'TicketNicManController/getClosedTicketNicMan';
$route['request-for-closed']              = 'TicketNicManController/getRequestForClosedTicketByNicDev';
$route['change-technical-ticket-status']  = 'TicketNicManController/changeTechnicalTicketStatus';
$route['assign-technical-ticket-to-dev']  = 'TicketNicManController/assignTechnicalTicketToDev';
$route['closed-technical-ticket']         = 'TicketNicManController/closedTechnicalTicket';
$route['get-dashboard-nic-man']           = 'TicketNicDashboardController/getDashboardForNicMan';
$route['register-ticket-nic-man']         = 'TicketNicDashboardController/getAllRegisterTicketNicMan';
$route['closed-ticket-nic-man']           = 'TicketNicDashboardController/getAllClosedTicketNicMan';
$route['rejected-ticket-nic-man']         = 'TicketNicDashboardController/getAllRejectedTicketNicMan';
$route['in-queue-ticket-nic-man']         = 'TicketNicDashboardController/getAllInQueueTicketNicMan';
$route['under-processing-ticket-nic-man'] = 'TicketNicDashboardController/getAllUnderProcessingTicketNicMan';
$route['pending-ticket-nic-man']          = 'TicketNicDashboardController/getAllPendingTicketNicMan';
$route['ticket-search-nic-man']           = 'TicketNicDashboardController/searchTicketForNicMan';

// dev
$route['assign-ticket-list-dev'] = 'TicketNicDevController/getAssignedTicketListNicDev';
$route['request-for-closed-dev'] = 'TicketNicDevController/getRequestForClosedTicketList';
$route['closed-ticket-list-dev'] = 'TicketNicDevController/getClosedTicketNicDev';
$route['request-to-close-dev']   = 'TicketNicDevController/requestToCloseTicketDev';

// adlr
$route['ticket-dashboard-for-adlr']        = 'TicketSysReportController/getDashboardForAdlr';
$route['ticket-search-for-adlr']           = 'TicketSysReportController/searchTicketForAdlr';
$route['register-ticket-for-adlr']         = 'TicketSysReportController/getAllRegisterTicketForReport';
$route['closed-ticket-for-adlr']           = 'TicketSysReportController/getAllClosedTicketForReport';
$route['rejected-ticket-for-adlr']         = 'TicketSysReportController/getAllRejectedTicketForReport';
$route['in-queue-ticket-for-adlr']         = 'TicketSysReportController/getAllInQueueTicketForReport';
$route['under-processing-ticket-for-adlr'] = 'TicketSysReportController/getAllUnderProcessingTicketForReport';
$route['pending-ticket-for-adlr']          = 'TicketSysReportController/getAllPendingTicketForReport';

$route['lgd-code-list-exist'] = 'AdlrReportController/lgdCodeList';
$route['lgd-code-not-exist'] = 'AdlrReportController/lgdCodeList';
$route['dag-reports'] = 'AdlrReportController/dagDetailsReport';

//mobile===============
$route['update-mobile-no'] = 'LoginController/updateMobileNo';
$route['get-otp-on-mobile'] = 'LoginController/getOtpOnMobileNo';
$route['btn-submit-otp'] = 'LoginController/submitOtp';
$route['otp-verify-login'] = 'LoginController/verifyOtpAndLogin';

//md user creation
$route['aidc_md_profile_creation'] = 'AidcUserCreation/createMDUser';
$route['aidc-md-profile-create-save'] = 'AidcUserCreation/createMDUserProfileSave';
///////////////////REVIEW//////////////////
$route['review'] = 'BasundharaReview/index';

//******* added on 2024-11-26offline
$route['create-cab-id-offline'] = 'CabController/createCabIdOffline';
$route['to-be-finalize-cab-offline'] = 'CabController/toBeFinalizeCabIdOffline';
$route['finalized-cab-id-offline'] = 'CabController/finalApproveCabIdOffline';
$route['approved-cab-id-offline'] = 'CabController/deptApprovedCabIdListOffline';


//******* added on 2024-11-26NC settlement
$route['create-cab-id-nc'] = 'CabController/createCabIdNC';
$route['to-be-finalize-cab-nc'] = 'CabController/toBeFinalizeCabIdNC';
$route['finalized-cab-id-nc'] = 'CabController/finalApproveCabIdNC';
$route['approved-cab-id-nc'] = 'CabController/deptApprovedCabIdListNC';

$route['e-khazana-manual-payment-response'] = 'EkhajanaMouzadarCFRmanualResponse/egrasResponse';

$route['chitha-data-reports'] = 'DharController/reports';
//Digitalized Settlement of land to non-individual juridical entities
$route['pending-juridical-cases'] = 'DeptJuridical/landingPage';
// $route['reverted-juridical-cases'] = 'DeptJuridical/revertPage';

$route['reverted-mb3-cases/(:any)'] = 'Mb3RevertController/revertPage/$1';

// Offering Reclassification Suite
$route['pending-reclass-suite-cases'] = 'DeptReclassSuite/landingPage';



// **************HRP
//tea grant dept part
$route['pending-tea-grant-cases'] = 'DeptTeaGrant/teaGrantLanding';
//conversion dept part
$route['pending-conversion-cases'] = 'DeptConversion/conversionLanding';
//tenant dept part
$route['pending-tenant-cases'] = 'DeptTenant/tenantLanding';
$route['manage-mb3-cabinet'] = 'DeptMb3Cabinet/manageMb3Cabinet';
$route['to-be-finalize-mb3-cabinet'] = 'DeptMb3Cabinet/toBeFinalizeMb3Cabinet';
$route['finalized-mb3-cabinet'] = 'DeptMb3Cabinet/finalApproveCabId';
//10-01-2025 routes
$route['review-pending-case-landing'] = 'BasundharaMb2Review/pendingReviewCaselanding';
$route['review-pending-case-ast']     = 'BasundharaMb2Review/getCasesListByDistrict';
$route['perpetual-pending-case-landing'] = 'BasundharaMb2Perpetual/pendingPerpetualCaselanding';
$route['perpetual-pending-case-ast']     = 'BasundharaMb2Perpetual/getCasesListByDistrict';
$route['pending-conversion-cases-new'] = 'DeptConversionNew/conversionLanding';
