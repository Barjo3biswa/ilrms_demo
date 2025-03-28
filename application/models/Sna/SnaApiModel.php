<?php
class SnaApiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function snaApiInsert($dbb,$snaUserData,$table)
    {
        $snaInsert = $dbb->insert($table, $snaUserData);
        return $dbb->trans_status();
    }

    public function checkIfUserExist($dist_code,$subdiv_code,$cir_code,$unique_user_id)
    {
        $query = $this->db->query("select * from sna_primary_account where dist_code=? and subdiv_code=? and cir_code=? and unique_user_id=?",array($dist_code,$subdiv_code,$cir_code,$unique_user_id));
        return $query;
    }
}
?>