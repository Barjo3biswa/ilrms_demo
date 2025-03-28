<?php

class DharModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getCircleByDistJSON($dbb,$distCode) {
        $district = $dbb->query("select * from location where dist_code =?  and "
                . " subdiv_code!='00' and cir_code!='00' and mouza_pargona_code='00' and "
                . " vill_townprt_code='00000' and lot_no='00'",array($distCode));
        return $district->result();
    }

    public function getVillageByCircleUUIDJSON($dbb,$distCode, $cir_uuid) {
        $district = $dbb->query("select * from location where dist_code =?  and "
                . " uuid = ? and "
                . " mouza_pargona_code='00'",array($distCode, $cir_uuid));
        $row =  $district->row();
        return $this->getVillageList($dbb, $row->dist_code, $row->subdiv_code, $row->cir_code);
    }
    
    public function getVillageList($dbb,$distCode, $subdivcode, $circode) {
        $district = $dbb->query("select *  from location where dist_code =?  and  subdiv_code=? and cir_code=? and mouza_pargona_code!='00'  and lot_no!='00' and vill_townprt_code !='00000' order by vill_townprt_code",
            array($distCode,$subdivcode,$circode));
        return $district->result();
    }

    public function getDagNosInt($dbb, $distCode,$subdivcode, $circode,$mouzacode,$lot_no,$vill_code)
    {
        $district = $dbb->query("select dag_no::int from chitha_basic where dist_code =?  and "
            . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
            . " lot_no=? and vill_townprt_code=? and dag_no ~ '^\d+$' group by  dag_no::int order by dag_no::int"
            , array($distCode,$subdivcode,$circode,$mouzacode,$lot_no,$vill_code));
        log_message('error', $dbb->last_query());
        return $district->result();
    }

    public function getDagNosChar($dbb,$distCode,$subdivcode, $circode,$mouzacode,$lot_no,$vill_code)
    {
        $district = $dbb->query("select dag_no from chitha_basic where dist_code =?  and "
            . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
            . " lot_no=? and vill_townprt_code=? and dag_no !~ '^\d+$' group by  dag_no order by dag_no"
            , array($distCode,$subdivcode,$circode,$mouzacode,$lot_no,$vill_code));
        log_message('error', $dbb->last_query());
        return $district->result();
    }
    public function getDagDetails($dbb, $distCode,$subdivcode, $circode,$mouzacode,$lot_no,$vill_code, $dag_no)
    {
        $sql = "select dag_no,old_dag_no, patta_no, old_patta_no,
                    (select patta_type from patta_code where type_code=c.patta_type_code) as patta_type,patta_type_code,
                    (select land_type from landclass_code where class_code=c.land_class_code) as land_class,
                     dag_area_b, dag_area_k, dag_area_lc, dag_area_g, dag_area_kr, dag_revenue, dag_local_tax 
                  from chitha_basic c where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? 
                        and lot_no=? and vill_townprt_code=? and dag_no=?";
        $data = $dbb->query($sql, array($distCode,$subdivcode, $circode,$mouzacode,$lot_no,$vill_code, $dag_no));
        $data = $data->row();
        return $data;
    }   
    public function getOwnerDetails($dbb, $distCode,$subdivcode, $circode,$mouzacode,$lot_no,$vill_code, $dag_no, $patta_type, $patta_no)
    {
        $sql = "select cp.pdar_name, cp.pdar_father, cp.pdar_guard_reln,cp.pdar_gender from
                (select * from chitha_pattadar  where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? 
                    and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?) cp join
                (select * from chitha_dag_pattadar  where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? 
                    and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=? and dag_no=? and (p_flag='0' or p_flag is null)) cdp
         on cp.pdar_id=cdp.pdar_id";
        $data = $dbb->query($sql, array($distCode,$subdivcode, $circode,$mouzacode,$lot_no,$vill_code, $patta_type, $patta_no,
                                        $distCode,$subdivcode, $circode,$mouzacode,$lot_no,$vill_code, $patta_type, $patta_no, $dag_no));
        $data = $data->result();
        return $data;
    }
    public function getLocationByUUID($dbb, $uuid)
    {
        $data = $dbb->query("select * from location where uuid=?",array($uuid));
        return $data->row();
    }
}