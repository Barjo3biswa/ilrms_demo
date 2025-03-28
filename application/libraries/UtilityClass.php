<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UtilityClass {
    
    protected $CI;
    public function __construct() {
        $CI =& get_instance();
    }
    function dist_name($d){
        $CI =& get_instance();
        $sql="Select loc_name as distname from location where dist_code='$d' and subdiv_code='00'";
        $name=$CI->dbb->query($sql)->row()->distname;
        return $name;
    }
    function subdiv_name($d,$s){
        $CI =& get_instance();
        $sql="Select loc_name as subdiv from location where dist_code='$d' and subdiv_code='$s' and cir_code='00' ";
        $name=$CI->dbb->query($sql)->row()->subdiv;
        return $name;
    }
    function cir_name($d,$s,$c){
        $CI =& get_instance();
        $sql="Select loc_name as cirname,locname_eng from location where dist_code='$d' and subdiv_code='$s' and cir_code='$c' and mouza_pargona_code='00' ";
        $name=$CI->dbb->query($sql)->row()->cirname;
		$name_eng=$CI->dbb->query($sql)->row()->locname_eng;
        return $name.' ('.$name_eng.')';
    }
    function mouza_name($d,$s,$c,$m){
        $CI =& get_instance();
        $sql="Select loc_name as mou from location where dist_code='$d' and subdiv_code='$s' and cir_code='$c' and mouza_pargona_code='$m' and lot_no='00' ";
        $name=$CI->dbb->query($sql)->row()->mou;
        return $name;
    }
    function lot_name($d,$s,$c,$m,$l){
        $CI =& get_instance();
        $sql="Select loc_name as lotno from location where dist_code='$d' and subdiv_code='$s' and cir_code='$c' and mouza_pargona_code='$m' and lot_no='$l' and vill_townprt_code='00000'  ";
        $name=$CI->dbb->query($sql)->row()->lotno;
        return $name;
    }
    function village_name($d,$s,$c,$m,$l,$v){
        $CI =& get_instance();
        $sql="Select loc_name as village from location where dist_code='$d' and subdiv_code='$s' and cir_code='$c' and mouza_pargona_code='$m' and lot_no='$l' and vill_townprt_code='$v'  ";
        $name=$CI->dbb->query($sql)->row()->village;
        return $name;
    }

//	function village_name_uuid($uuid){
//		$CI =& get_instance();
//		$sql="Select loc_name as village from location where uuid='$uuid'";
//		$name=$CI->dbb->query($sql)->row()->village;
//		return $name;
//	}

	//for brahmaputra valley
	function brahmaputra_valley_total_lessa($bigha, $katha, $lessa) {
		$total_lessa = $lessa + ($katha * 20) + ($bigha * 100);
		return $total_lessa;
	}

	function brahmaputra_valley_total_bigha_katha_lessa($total_lessa) {
		$bigha = $total_lessa / 100;
		$rem_lessa = fmod($total_lessa, 100);
		$katha = $rem_lessa / 20;
		$r_lessa = fmod($rem_lessa, 20);
		$mesaure = array();
		$mesaure[].=floor($bigha);
		$mesaure[].=floor($katha);
		$mesaure[].=$r_lessa;
		return $mesaure;
	}

	//for barak valley
	function barak_valley_total_ganda($bigha, $katha, $lessa,$ganda){
		$total_ganda = ($bigha * 6400) + ($katha * 320) + ($lessa * 20) + $ganda;
		return $total_ganda;
	}

	function barak_valley_total_bigha_katha_lessa_ganda($total_ganda)
	{
		$bigha = $total_ganda / 6400;
		$rem_ganda = fmod($total_ganda, 6400);
		$katha = $rem_ganda/ 320;
		$r_ganda = fmod($rem_ganda, 320);
		$lessa = $r_ganda / 20;
		$ganda = fmod($r_ganda, 20);
		$mesaure = array();
		$mesaure[].=floor($bigha);
		$mesaure[].=floor($katha);
		$mesaure[].=floor($lessa);
		$mesaure[].=$ganda;
		return $mesaure;
	}

	//***** get Patta Type ****/
	function getPatta_type($dist_code,$patta_type)
	{
		$CI =& get_instance();
		$CI->db = $CI->load->database('kamrup',TRUE);
		$data = $CI->db->query("select patta_type,pattatype_eng from patta_code where 
				type_code=?", array($patta_type))->row();
		return $data->patta_type.' ('.$data->pattatype_eng.')';
	}

	public function ins_sub_type($ins_cat) {
        $list = SUB_CAT;
        foreach ($list as $key => $value) {
            if($value['id'] == $ins_cat)
            {
                return $value['category_name'];
            }
        }
    }
}
