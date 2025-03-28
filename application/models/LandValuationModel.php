<?php
class LandValuationModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    //For Land Valuation Certificate    
    public function getChithaDagDetails($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$dag_no,$patta_no,$patta_type_code)
    {
        $sql = "select dag_area_b,dag_area_k,dag_area_lc,dag_area_g,dag_area_kr from chitha_basic  where dist_code =? and subdiv_code = ? and cir_code =? and mouza_pargona_code =? and lot_no = ? and vill_townprt_code =? and dag_no =? and patta_no =? and patta_type_code =? ";
        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$dag_no,$patta_no,$patta_type_code));
        return $data;
    }


    public function getAllDagsByPattaNoPdarIdPattaType($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_no,$pdar_id,$patta_type_code)
    {
        $sql = "SELECT cdp.dist_code, cdp.subdiv_code, cdp.cir_code, cdp.mouza_pargona_code, cdp.lot_no, cdp.vill_townprt_code, cdp.dag_no, cdp.patta_type_code, cdp.patta_no
                    FROM chitha_dag_pattadar cdp
                    WHERE cdp.dist_code = ?
                        AND cdp.subdiv_code = ?
                        AND cdp.cir_code = ?
                        AND cdp.mouza_pargona_code = ?
                        AND cdp.lot_no = ?
                        AND cdp.vill_townprt_code = ?
                        AND cdp.patta_no = ?
                        AND cdp.pdar_id = ?
                        AND cdp.patta_type_code = ?
                        AND EXISTS (
                            SELECT 1
                            FROM chitha_pattadar cp
                            WHERE cp.pdar_id = cdp.pdar_id
                                AND cp.patta_no = cdp.patta_no
                                AND cp.patta_type_code = cdp.patta_type_code
                                AND cp.dist_code = cdp.dist_code
                                AND cp.subdiv_code = cdp.subdiv_code
                                AND cp.cir_code = cdp.cir_code
                                AND cp.mouza_pargona_code = cdp.mouza_pargona_code
                                AND cp.lot_no = cdp.lot_no
                                AND cp.vill_townprt_code = cdp.vill_townprt_code)";
        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_no,$pdar_id,$patta_type_code));
        return $data;
    }
  
    public function getZonalValueByDagLocation($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$dag_no)
    {
        $sql = "SELECT vz.land_rate, vz.zone_name,vz.subclass_name
                FROM dagwise_zone_info dz 
                LEFT JOIN villagewise_zone_info vz 
                ON dz.unique_village_code = vz.unique_village_code 
                WHERE dz.flag = ? 
                AND vz.flag = ? 
                AND dz.dist_code = ? 
                AND dz.subdiv_code = ? 
                AND dz.cir_code = ? 
                AND dz.mouza_pargona_code = ? 
                AND dz.lot_no = ? 
                AND dz.vill_code = ?
                AND dz.dag_no = ? 
                AND vz.zone_code::int = dz.zone_id::int 
                AND vz.subclass_code::int = dz.subclass_id::int";

        $params = array('1', '1', $dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no,$vill_townprt_code, $dag_no);
        $data = $dbb->query($sql, $params);
        return $data;
    }


    public function getZonalValueByDagUUID($dist_code,$uuid,$dag_no)
    {

        $sql = "SELECT vz.land_rate, vz.zone_name,vz.subclass_name
                FROM dagwise_zone_info dz 
                LEFT JOIN villagewise_zone_info vz 
                ON dz.unique_village_code = vz.unique_village_code 
                WHERE dz.dist_code = ? 
                AND dz.unique_village_code = ? 
                AND dz.dag_no = ? 
                AND dz.flag = ? 
                AND vz.flag = ? 
                AND vz.zone_code::int = dz.zone_id::int 
                AND vz.subclass_code::int = dz.subclass_id::int";

        $params = array($dist_code, $uuid, $dag_no,'1', '1');

        $data = $this->db2->query($sql, $params);

        return $data;
    }

    public function getPattadarCount($dbb,$dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no,$vill_townprt_code,$patta_no,$pdar_id,$patta_type_code, $dag_no)
    {
        $sql = "select count(chitha_dag_pattadar.pdar_id) from chitha_dag_pattadar  join chitha_pattadar on chitha_pattadar.pdar_id = chitha_dag_pattadar.pdar_id and
                        chitha_pattadar.patta_no = chitha_dag_pattadar.patta_no and chitha_pattadar.patta_type_code = chitha_dag_pattadar.patta_type_code and
                        chitha_pattadar.dist_code = chitha_dag_pattadar.dist_code and chitha_pattadar.subdiv_code = chitha_dag_pattadar.subdiv_code and
                        chitha_pattadar.cir_code = chitha_dag_pattadar.cir_code and chitha_pattadar.mouza_pargona_code = chitha_dag_pattadar.mouza_pargona_code and
                        chitha_pattadar.lot_no = chitha_dag_pattadar.lot_no and chitha_pattadar.vill_townprt_code = chitha_dag_pattadar.vill_townprt_code   where
                        chitha_dag_pattadar.dist_code = ? and chitha_dag_pattadar.subdiv_code = ? and chitha_dag_pattadar.cir_code = ? and
                        chitha_dag_pattadar.mouza_pargona_code = ? and chitha_dag_pattadar.lot_no = ? and chitha_dag_pattadar.vill_townprt_code  = ?
                        and chitha_dag_pattadar.patta_no = ? and chitha_dag_pattadar.pdar_id != ? and chitha_dag_pattadar.patta_type_code = ?  and dag_no = ?";
        $params = array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no,$vill_townprt_code, $patta_no,$pdar_id,$patta_type_code, $dag_no);
        $data = $dbb->query($sql, $params);
        return $data;
    }



	//function created for displaying the Circle name
    public function getCircleName($dbb,$dist_code, $subdiv_code, $circle_code)
	{
		$circle = $dbb->query("select loc_name AS circle from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='00' and "
			. " vill_townprt_code='00000' and lot_no='00'");

		return $circle;
	}

	//function created for displaying the mouza name
	public function getMouzaName($dbb,$dist_code, $subdiv_code, $circle_code, $mouza_code)
	{
		$mouza = $dbb->query("select loc_name AS mouza from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
			. " vill_townprt_code='00000' and lot_no='00'");
		return $mouza;
	}
	//function created for displaying the village name
	public function getVillageName($dbb,$dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no, $vill_code)
	{
		$village = $dbb->query("select loc_name AS village from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
			. " vill_townprt_code='$vill_code' and lot_no='$lot_no'");

		return $village;
	}

    //Get patta type
	function getPattaType($dbb,$patta_type_code)
	{
		$pattatype = $dbb->query("select patta_type,pattatype_eng from patta_code where 
				type_code ='$patta_type_code'");

        if ($pattatype->num_rows() > 0) {
            return $pattatype->row()->patta_type;
        } else {
            return "NA";
        }
	}

    //get Gender
    function getGender($dbb,$gender_id)
    {
        $gender = $dbb->query("select gen_name_eng from master_gender where 
                id ='$gender_id'");

        if ($gender->num_rows() > 0) {
            return $gender->row()->gen_name_eng;
        } else {
            return "NA";
        }
    }


    public function getCoUsers($dbb,$dist_code,$subdiv_code,$cir_code)
    {
        $sql = "select user_code from loginuser_table  where dist_code =? and subdiv_code = ? and cir_code =? and dis_enb_option =? and user_code like '%CO%'";
        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,'E'));
        return $data;
    }

    public function getCurrentCoUserDetails($dbb,$dist_code, $subdiv_code, $cir_code, $user_code)
    {
        $username = null;
        $userSign = null;
        $dist = null;
        $subdiv = null;
        $circle = null;

        try {
            if (ENVIRONMENT === 'production')
            {
                $sql = $dbb->query(
                'SELECT dist_code, subdiv_code, cir_code, username, user_sign1 FROM users 
                 WHERE dist_code = ? AND subdiv_code = ? AND cir_code = ? AND user_code = ?', 
                array($dist_code, $subdiv_code, $cir_code, $user_code)
                );
            }
            else
            {
                $sql = $dbb->query(
                'SELECT dist_code, subdiv_code, cir_code, username, user_sign1 FROM users 
                 WHERE dist_code = ? AND subdiv_code = ? AND cir_code = ? AND user_code = ?', 
                array($dist_code, $subdiv_code, $cir_code, $user_code)
                );
            }

            if ($sql->num_rows() > 0) {
                $row = $sql->row();
                $username = $row->username;
                $dist = $row->dist_code;
                $subdiv = $row->subdiv_code;
                $circle = $row->cir_code;
                $userSign = pg_unescape_bytea($row->user_sign1);

                if ($userSign !== false) {
                    $base64Image = base64_encode($userSign);
                    $tempFile = tempnam(sys_get_temp_dir(), 'img');
                    file_put_contents($tempFile, $userSign);
                    $fileMimeType = mime_content_type($tempFile);
                    unlink($tempFile);
                    $userSign = '<img style="max-height:40px; max-width:100px;" src="data:' . $fileMimeType . ';base64,' . $base64Image . '" />';
                } else {
                    $userSign = null;
                }
            }
        } catch (Exception $e) {
            error_log('Error fetching user details: ' . $e->getMessage());
            return array('error' => 'An error occurred while fetching user details.');
        }

        return array(
            'username' => $username,
            'userSign' => $userSign,
            'userDist' => $dist,
            'userSubdiv' => $subdiv,
            'userCircle' => $circle
        );
    }


    public function getRuralUrban($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code)
    {
        $sql = "select rural_urban from location  where dist_code =? and subdiv_code = ? and cir_code =? and mouza_pargona_code =? and lot_no = ? and vill_townprt_code = ?";
        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code));
        return $data;
    }



}