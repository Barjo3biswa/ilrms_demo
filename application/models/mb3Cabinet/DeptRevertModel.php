<?php
class DeptRevertModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDetailsToBeRevertedCase($dbb,$commaSeparatedCases,$service_code)
    {
        // var_dump($service_code);
        // $table =$service_code==40?'reclass_suite_basic':'settlement_basic';

        $table='settlement_basic';
        if($service_code == '40'){
           $table= 'reclass_suite_basic';
        }else if($service_code == '44'){
            $table= 'petition_basic';
        }
        $sql = "select * from $table where case_no in ($commaSeparatedCases)";
        // echo $sql;
        // die;
        $data  = $dbb->query($sql)->result();
        return ['reverted_case_list' => $data];
    }

    public function getAllMb3CabList($dist_code,$user_code,$service_code)
    {
        // $sql = "select * from mb3_cabinet_list where dist_code =? and user_code =? and service_code=? and status in (?, ?)";
        // $data  = $this->db->query($sql, array($dist_code,$user_code,$service_code, GENERATED_CAB_ID, ADD_CASES_UNDER_CAB_ID))->result();
        $sql = "select * from mb3_cabinet_list where dist_code =? and user_code =? and status in (?, ?)";
        $data  = $this->db->query($sql, array($dist_code,$user_code, GENERATED_CAB_ID, ADD_CASES_UNDER_CAB_ID))->result();
        return $data;
    }

    public function checkForAsstVerification($dbb, $commaSeparatedCases, $table)
    {
       $sql = $dbb->query("SELECT * FROM $table WHERE (ast_verification IS NULL OR ast_verification!=?) AND case_no IN ($commaSeparatedCases)", 
                array('A'));
       return $sql->num_rows();
    }




}?>