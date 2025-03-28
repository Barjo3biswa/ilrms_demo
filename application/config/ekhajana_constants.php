<?php
//************************************************************************/
//ekhajana constants  
//************************************************************************/
//tehsildari system dist codes array
define('EKHAJANA_TEHSILDARI_SYSTEM_DIST_CODES', json_encode([
    '02', '03', '21', '13', '38'
]));
//tehsildari system and mouzadari system dist codes array
define('EKHAJANA_TEHSILDARI_MIXED_DIST_CODES', json_encode([
    '02'
]));
//mouzdari system village codes in tehsildari districts 
define('EKHAJANA_TEHSILDARI_MIXED_VILLAGE_CODES', json_encode([
    '10000000000726', '10000000000699','10000000000703', 
    '10000000000704', '10000000000700', '10000000000701', 
    '10000000000667', '10000000000138'
]));
//*************************************************************/
define('EKHAJANA_MOUZADAR_ACTIVE', 1);//0 for deactive, 1 for active
define('EKHAJANA_JAMAWASIL_VIEW_API', DHAR_APP.'index.php/dharitreeApi/getJamaWasil');
define('EKHAJANA_DOWNLOAD_DOCUMENT_API_FOR_MOUZADAR', RTPS2_APP.'Ekhajana/downloadDocumentForCo');
define('EKHAJNA_MOUZADAR_PENDING_COUNT_API',RTPS2_APP.'Ekhajana/getMouzdarPendingCount');
define('EKHAJANA_STATUS_CO_FORWARD_MOUZADAR_OBJECTION', 'OBJ_F');
define('EKHAJNA_MOUZADAR_PENDING_LIST_API',RTPS2_APP.'Ekhajana/getPendingListForMouzadar');
define('EKHAJANA_PENDING_CASE_DETAILS_API', RTPS2_APP.'Ekhajana/getEkhajanaPendingCaseDetails');
define('EKHAJANA_STATUS_COMBINE_FORWARD', 'COM_F');
define('EKHAJANA_STATUS_MOU_FORWARD', 'MOU_F');
//constant not in live
define('EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_API', RTPS2_APP.'Ekhajana/updateLandDetailsmouzadar');
define('EKHAJANA_STATUS_LM_FORWARD', 'LM-F');
define('EKHAJANA_STATUS_CO_FORWARD', 'CO-F');
define('EKHAJANA_STATUS_COMPLETED', 'F');
define('EKHAJANA_STATUS_REJECTED', 'R');
define('EKHAJANA_PAYMENT_UPDATE_API', RTPS2_APP.'Ekhajana/updatePayment');//For live
define('JAMA_WASIL_ACTION_MOUZADAR_ENTRY', 'mouzadar_arrear_update');
define('JAMA_WASIL_STATUS_OFFLINE', 'offline');
define('JAMA_WASIL_STATUS_ONLINE', 'online');
define('MOUZADAR_MENU', 1);//1 for only mouzadar
define('EKHAJANA_AST_MOU_REVERT', 'L');
define('EKHAJANA_REVERT_CASE_API', RTPS2_APP.'Ekhajana/updateRevertDetails');
define('EKHAJANA_LAND_DETAILS_UPDATE_API',RTPS2_APP.'Ekhajana/updateLandDetails');
define('EKHAJANA_MOUZADAR_OBJECTION', 'M_OBJ');
define('EKHAJANA_AADHAAR_PHOTO_FETCH', RTPS2_APP.'Ekhajana/getApplicantPhoto');
define('EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API', RTPS2_APP.'Ekhajana/updateLandDetailsmouzadar');
define('EKHAJANA_AREEAR_PRE_UPDATED', 'PU'); //PU for Preupdated
define('EKHAJANA_PRE_ARREAR_YEARS', ['2000','2001','2002','2003','2004','2005','2006','2007','2008','2009','2010','2011','2012','2013','2014','2015','2016','2017','2018','2019','2020','2021','2022','2023']);
define('EKHAJANA_LAND_DETAILS_FETCH_URL',RTPS2_APP.'Ekhajana/getLandDetailsIdFromLdCaseNo');
//define('EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_API', 'https://basundhara.assam.gov.in/rtpsmb2demo/Ekhajana/updateLandDetailsmouzadar');

define('EKHAJANA_MOUZADAR_BANK_DETAILS_DATA_ENTRY',1);

define('EDIT_EKHAJANA_PRE_ARREAR',1);

define('EKHAJANA_VOLUNTEER_CATEGORIES', json_encode([
    ['E_CODE' => 1, 'NAME' => 'MUTATION'],
    ['E_CODE' => 2, 'NAME' => 'NAME CORRECTION'],
    ['E_CODE' => 3, 'NAME' => 'e-KHAJNA'],
]));

//******************************************************
//ekhajana cfr constants 
define("UPLOAD_DIR_FOR_OFFLINE_CFR", BASE_UPLOAD_DIR.'uploadsCFR/');
if (is_dir(UPLOAD_DIR_FOR_OFFLINE_CFR) === false) mkdir(UPLOAD_DIR_FOR_OFFLINE_CFR,0777,true);
define('GRAS_URL','https://uatgras.assam.gov.in/');
define('EKHAJANA_NON_TREASURY_PAYMENT_TYPE', '03');
//define('EKHAJANA_STATUS_COMPLETED', 'F');
define('EKHAJANA_ID', 19);
define('EKHAJANA_CFR_GRAS_DIRECT_PAY','EKHCGP');
//define('JAMA_WASIL_STATUS_OFFLINE', 'offline');
//define('JAMA_WASIL_STATUS_ONLINE', 'online');
define('JAMA_WASIL_STATUS_PAID','PAID');
define('JAMA_WASIL_STATUS_UNPAID','UNPAID');
define('E_GRAS_URL','https://uatgras.assam.gov.in/challan/models/frmgetgrn.php');
define('EKHAJANA_MOUZADAR_CFR_RECONCILIATON_MODULE', 1);
define('EKHAJANA_CHECK_EKHAJANA_PATTA_STATUS',1);
define('doul_year_no','2025');
//******************************************************



?>
