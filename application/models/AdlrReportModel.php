<?php

class AdlrReportModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function getVillageList($dbb,$distCode, $subdivcode, $circode) {
        $district = $dbb->query("select *  from location where dist_code =?  and  subdiv_code=? and cir_code=? and mouza_pargona_code!='00'  and lot_no!='00' and vill_townprt_code !='00000' order by vill_townprt_code",
            array($distCode,$subdivcode,$circode));
        return $district->result();
    }

        public function getVillageListDetails($dbb,$start, $length, $order, $dist_code,$subdiv_code,$cir_code,$searchByCol_0)
    {
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }
        $dbb->distinct();
        $dbb->select('*');
        $dbb->from('location');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('subdiv_code', $subdiv_code);
        $dbb->where('cir_code', $cir_code);
        $dbb->where('mouza_pargona_code !=','00' );
        $dbb->where('lot_no !=','00' );
        $dbb->where('vill_townprt_code !=','00000' );
        if ($searchByCol_0 != null) {
            $dbb->like('locname_eng', $searchByCol_0);

        }
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $dbb->distinct();
        $dbb->select('*');
        $dbb->from('location');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('subdiv_code', $subdiv_code);
        $dbb->where('cir_code', $cir_code);
        $dbb->where('mouza_pargona_code !=','00' );
        $dbb->where('lot_no !=','00' );
        $dbb->where('vill_townprt_code !=','00000' );
        if ($searchByCol_0 != null) {
            $dbb->like('locname_eng', $searchByCol_0);
        }
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    public function getVillageTypeListDetails($dbb,$start, $length, $order, $dist_code,$searchByCol_0)
    {
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }
        $dbb->select([
            '(SELECT loc_name FROM location WHERE dist_code = t.dist_code AND subdiv_code = \'00\') AS district',
            '(SELECT loc_name FROM location WHERE dist_code = t.dist_code AND subdiv_code = t.subdiv_code AND cir_code = t.cir_code AND mouza_pargona_code = \'00\') AS circle',
            't.loc_name AS village',
            't.lgd_code',
            'CASE 
                WHEN t.rural_urban = \'R\' THEN \'RURAL\'
                WHEN t.rural_urban = \'U\' THEN \'URBAN\'
                WHEN t.rural_urban = \'N\' THEN \'NOT-MAPPED\'
            END AS mapped_as',
            't.nc_btad AS flagged_type'
        ]);
        
        $dbb->from('location t');
        $dbb->where('t.vill_townprt_code <>', '00000');
        if ($searchByCol_0 != null) {
            $dbb->like('locname_eng', $searchByCol_0);

        }
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $dbb->select([
            '(SELECT loc_name FROM location WHERE dist_code = t.dist_code AND subdiv_code = \'00\') AS district',
            '(SELECT loc_name FROM location WHERE dist_code = t.dist_code AND subdiv_code = t.subdiv_code AND cir_code = t.cir_code AND mouza_pargona_code = \'00\') AS circle',
            't.loc_name AS village',
            't.lgd_code',
            'CASE 
                WHEN t.rural_urban = \'R\' THEN \'RURAL\'
                WHEN t.rural_urban = \'U\' THEN \'URBAN\'
                WHEN t.rural_urban = \'N\' THEN \'NOT-MAPPED\'
            END AS mapped_as',
            't.nc_btad AS flagged_type'
        ]);
        
        $dbb->from('location t');
        $dbb->where('t.vill_townprt_code <>', '00000');
        if ($searchByCol_0 != null) {
            $dbb->like('locname_eng', $searchByCol_0);
        }
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }



    public function getCircleByDistJSON($dbb,$distCode) {
        $district = $dbb->query("select * from location where dist_code =?  and "
                . " subdiv_code!='00' and cir_code!='00' and mouza_pargona_code='00' and "
                . " vill_townprt_code='00000' and lot_no='00'",array($distCode));
        return $district->result();
    }

    function downloadExcelReport($filename, $result_array)
    {
        require_once 'application/libraries/Xlsxwriter.class.php';
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        // var_dump($result_array[0]);
        //$head_array[] = array_keys($result_array[0]);
        foreach ($result_array[0] as $key => $head) {
            $final_head[$key] = 'string';
        }
        $styles1 = array(
            'font' => 'Arial', 'font-size' => 14, 'font-style' => 'bold', 'fill' => '#FFFF00',
            'halign' => 'center', 'border' => 'left,right,top,bottom'
        );
        $styles7 = array('border' => 'left,right,top,bottom');
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //header("Content-Type: application/vnd.ms-excel");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        $writer = new XLSXWriter();
        $writer->setAuthor('Dharitree');
        $writer->writeSheetHeader('Sheet1', $final_head, $styles1);
        foreach ($result_array as $row)
            $writer->writeSheetRow('Sheet1', (array)$row, $styles7);
        ob_end_clean();
        $writer->writeToStdOut();
        exit(0);
    }


    public function getLocationList($dbb,$distCode) {
        $district = $dbb->query("select *  from location where dist_code =?  and  subdiv_code!='00' and cir_code!='00' and mouza_pargona_code!='00'  and lot_no!='00' and vill_townprt_code !='00000' order by vill_townprt_code",
            array($distCode));
        return $district->result();
    }

    public function getAadharrCountByDist($dbb,$distCode) {
        $district = $dbb->query("select *  from location where dist_code =?",
            array($distCode));
        return $district->result();
    }


    public function getlgdCodeListReport($dbb,$start, $length, $order,$dist_code,$searchByCol_0,$route_name)
    {
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }
        $dbb->select([
        '(SELECT locname_eng 
          FROM location 
          WHERE dist_code = t.dist_code 
            AND subdiv_code = \'00\') AS dist',
        
        '(SELECT locname_eng 
          FROM location 
          WHERE dist_code = t.dist_code 
            AND subdiv_code = t.subdiv_code
            AND cir_code = t.cir_code 
            AND mouza_pargona_code = \'00\') AS circle',
        
        '(SELECT locname_eng 
          FROM location 
          WHERE dist_code = t.dist_code 
            AND subdiv_code = t.subdiv_code 
            AND cir_code = t.cir_code
            AND mouza_pargona_code = t.mouza_pargona_code 
            AND lot_no = t.lot_no 
            AND vill_townprt_code = t.vill_townprt_code) AS village',
        
        'loc_name',
        'uuid',
        'lgd_code'
         ]);

        $dbb->from('location t');
        $dbb->where('vill_townprt_code <>', '00000');

        if ($route_name == "lgd-code-list-exist") {
            $dbb->where('lgd_code IS NOT NULL');
        }
        if ($route_name == "lgd-code-not-exist") {
            $dbb->where('lgd_code IS NULL');
        }
        if ($searchByCol_0 != null) {
            $dbb->like('locname_eng', $searchByCol_0);
        }
        $dbb->limit($length, $start);
        $query = $dbb->get();

        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

        $dbb->select([
        '(SELECT locname_eng 
          FROM location 
          WHERE dist_code = t.dist_code 
            AND subdiv_code = \'00\') AS dist',
        
        '(SELECT locname_eng 
          FROM location 
          WHERE dist_code = t.dist_code 
            AND subdiv_code = t.subdiv_code
            AND cir_code = t.cir_code 
            AND mouza_pargona_code = \'00\') AS circle',
        
        '(SELECT locname_eng 
          FROM location 
          WHERE dist_code = t.dist_code 
            AND subdiv_code = t.subdiv_code 
            AND cir_code = t.cir_code
            AND mouza_pargona_code = t.mouza_pargona_code 
            AND lot_no = t.lot_no 
            AND vill_townprt_code = t.vill_townprt_code) AS village',
        
        'loc_name',
        'uuid',
        'lgd_code'
         ]);

        $dbb->from('location t');
        $dbb->where('vill_townprt_code <>', '00000');
        if ($route_name == "lgd-code-list-exist") {
            $dbb->where('lgd_code IS NOT NULL');
        }
        if ($route_name == "lgd-code-not-exist") {
            $dbb->where('lgd_code IS NULL');
        }
        if ($searchByCol_0 != null) {
            $dbb->like('locname_eng', $searchByCol_0);
        }
        
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }


    public function getLandClassTypeDetails($dbb,$start, $length, $order,$dist_code,$searchByCol_0)
    {
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }
        $dbb->select([
        'land_type',
        'landtype_eng',
        'CASE 
            WHEN class_code_cat = \'01\' THEN \'AGRI\' 
            WHEN class_code_cat = \'02\' THEN \'NON-AGRI\' 
        END AS landcategory'
        ]);

        $dbb->from('landclass_code');
        $dbb->limit($length, $start);
        $query = $dbb->get();

        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            $dbb->select([
            'land_type',
            'landtype_eng',
            'CASE 
                WHEN class_code_cat = \'01\' THEN \'AGRI\' 
                WHEN class_code_cat = \'02\' THEN \'NON-AGRI\' 
            END AS landcategory'
            ]);

            $dbb->from('landclass_code');
        
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }



    public function getPattaTypeDetails($dbb,$start, $length, $order,$dist_code,$searchByCol_0)
    {
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }
        $dbb->select('patta_type,pattatype_eng');
        $dbb->from('patta_code');
        $dbb->limit($length, $start);
        $query = $dbb->get();

        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            $dbb->select('patta_type,pattatype_eng');
            $dbb->from('patta_code');
        
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    
public function getDagPattaDetails1($dbb, $start, $length, $order, $dist_code, $subdiv_code, $cir_code, $searchByCol_0)
{
    $dir = "desc";  // Default to 'desc'
    $order_column = '';  // Initialize to an empty string

    if (!empty($order)) {
        // Assuming single column ordering
        $col = $order[0]['column'];  
        $dir = $order[0]['dir'];
        $order_column = $col;  // Set the column to order by

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
    }

    // Build the base query
    $dbb->select("
        (SELECT locname_eng 
         FROM location 
         WHERE dist_code = cb.dist_code AND subdiv_code = '00') as district,
        (SELECT locname_eng 
         FROM location 
         WHERE dist_code = cb.dist_code AND subdiv_code = cb.subdiv_code 
         AND cir_code = cb.cir_code AND mouza_pargona_code = '00') as circle,
        COUNT(*) as total_urban_dags,
        COUNT(DISTINCT(CONCAT(patta_no, patta_type_code))) as total_urban_patta,
        (SUM(dag_area_b * 100 + dag_area_lc * 20 + dag_area_k) * 13.38 / 1000000) as area_in_sqkm");

    $dbb->from('chitha_basic cb');
    $dbb->join('location lc', 
        'cb.dist_code = lc.dist_code 
         AND cb.subdiv_code = lc.subdiv_code 
         AND cb.cir_code = lc.cir_code 
         AND cb.mouza_pargona_code = lc.mouza_pargona_code 
         AND cb.lot_no = lc.lot_no 
         AND cb.vill_townprt_code = lc.vill_townprt_code');

    // Apply the WHERE clauses
    $dbb->where('lc.dist_code', $dist_code);
    $dbb->where('lc.subdiv_code', $subdiv_code);
    $dbb->where('lc.cir_code', $cir_code);
    $dbb->where('lc.vill_townprt_code <>', '00000');
    $dbb->where('lc.rural_urban', 'U');
    $dbb->where_in('patta_type_code', 
        $dbb->select('type_code')
            ->from('patta_code')
            ->where('jamabandi', 'y'));

    // Apply grouping
    $dbb->group_by([
        'cb.dist_code', 
        'cb.subdiv_code', 
        'cb.cir_code', 
        'cb.mouza_pargona_code', 
        'cb.lot_no', 
        'cb.vill_townprt_code'
    ]);

    // Apply ordering if column is specified
    if ($order_column != '') {
        $dbb->order_by($order_column, $dir);
    }

    // Apply pagination
    $dbb->limit($length, $start);

    // Execute the query
    $query = $dbb->get();

    // Prepare the result
    $data = [];
    if ($query->num_rows() > 0) {
        $data['data_results'] = $query->result();
    }

    // Get total records count
    $dbb->reset_query();  // Reset query to apply the same base conditions
    $dbb->select("COUNT(*) as total_count");
    
    $dbb->from('chitha_basic cb');
    $dbb->join('location lc', 
        'cb.dist_code = lc.dist_code 
         AND cb.subdiv_code = lc.subdiv_code 
         AND cb.cir_code = lc.cir_code 
         AND cb.mouza_pargona_code = lc.mouza_pargona_code 
         AND cb.lot_no = lc.lot_no 
         AND cb.vill_townprt_code = lc.vill_townprt_code');

    // Apply the same WHERE and GROUP BY conditions
    $dbb->where('lc.dist_code', $dist_code);
    $dbb->where('lc.subdiv_code', $subdiv_code);
    $dbb->where('lc.cir_code', $cir_code);
    $dbb->where('lc.vill_townprt_code <>', '00000');
    $dbb->where('lc.rural_urban', 'U');
    $dbb->where_in('patta_type_code', 
        $dbb->select('type_code')
            ->from('patta_code')
            ->where('jamabandi', 'y'));

    $dbb->group_by([
        'cb.dist_code', 
        'cb.subdiv_code', 
        'cb.cir_code', 
        'cb.mouza_pargona_code', 
        'cb.lot_no', 
        'cb.vill_townprt_code'
    ]);
    
    $data['total_records'] = $dbb->count_all_results();

    return $data;
}



public function getDagPattaDetails($dbb, $start, $length, $order, $dist_code, $subdiv_code, $cir_code, $searchByCol_0)
{
    $dir = "desc";  // Default to 'desc'
    $order_column = '';  // Initialize to an empty string

    if (!empty($order)) {
        // Assuming single column ordering
        $col = $order[0]['column'];  
        $dir = $order[0]['dir'];
        $order_column = $col;  // Set the column to order by

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
    }

    // Get the list of type codes for 'jamabandi' = 'y'
    $subquery = $dbb->select('type_code')
                    ->from('patta_code')
                    ->where('jamabandi', 'y')
                    ->get_compiled_select();

    // Convert subquery result to an array
    $subquery_result = $dbb->query($subquery)->result_array();
    $type_codes = array_column($subquery_result, 'type_code');

    // Build the main query
    $dbb->select("
        (SELECT locname_eng 
         FROM location 
         WHERE dist_code = cb.dist_code AND subdiv_code = '00') as district,
        (SELECT locname_eng 
         FROM location 
         WHERE dist_code = cb.dist_code AND subdiv_code = cb.subdiv_code 
         AND cir_code = cb.cir_code AND mouza_pargona_code = '00') as circle,
        (Select locname_eng from location where dist_code=cb.dist_code and subdiv_code=cb.subdiv_code and cir_code=cb.cir_code and
         mouza_pargona_code=cb.mouza_pargona_code and lot_no=cb.lot_no and vill_townprt_code=cb.vill_townprt_code) as village,
        COUNT(*) as total_urban_dags,
        COUNT(DISTINCT(CONCAT(patta_no, patta_type_code))) as total_urban_patta,
        (SUM(dag_area_b * 100 + dag_area_lc * 20 + dag_area_k) * 13.38 / 1000000) as area_in_sqkm");

    $dbb->from('chitha_basic cb');
    $dbb->join('location lc', 
        'cb.dist_code = lc.dist_code 
         AND cb.subdiv_code = lc.subdiv_code 
         AND cb.cir_code = lc.cir_code 
         AND cb.mouza_pargona_code = lc.mouza_pargona_code 
         AND cb.lot_no = lc.lot_no 
         AND cb.vill_townprt_code = lc.vill_townprt_code');

    // Apply the WHERE clauses
    $dbb->where('lc.dist_code', $dist_code);
    $dbb->where('lc.subdiv_code', $subdiv_code);
    $dbb->where('lc.cir_code', $cir_code);
    $dbb->where('lc.vill_townprt_code <>', '00000');
    $dbb->where('lc.rural_urban', 'U');

    // Use where_in with the array of type codes
    if (!empty($type_codes)) {
        $dbb->where_in('patta_type_code', $type_codes);
    } else {
        // If no matching type codes, ensure the query returns no results
        $dbb->where('patta_type_code IS NULL');
    }

    // Apply grouping
    $dbb->group_by([
        'cb.dist_code', 
        'cb.subdiv_code', 
        'cb.cir_code', 
        'cb.mouza_pargona_code', 
        'cb.lot_no', 
        'cb.vill_townprt_code'
    ]);

    // Apply ordering if column is specified
    if ($order_column != '') {
        $dbb->order_by($order_column, $dir);
    }

    // Apply pagination
    $dbb->limit($length, $start);

    // Execute the query
    $query = $dbb->get();

    // Prepare the result
    $data = [];
    if ($query->num_rows() > 0) {
        $data['data_results'] = $query->result();
    }

    // Get total records count
    $dbb->reset_query();  // Reset query to apply the same base conditions
    $dbb->select("COUNT(*) as total_count");
    
    $dbb->from('chitha_basic cb');
    $dbb->join('location lc', 
        'cb.dist_code = lc.dist_code 
         AND cb.subdiv_code = lc.subdiv_code 
         AND cb.cir_code = lc.cir_code 
         AND cb.mouza_pargona_code = lc.mouza_pargona_code 
         AND cb.lot_no = lc.lot_no 
         AND cb.vill_townprt_code = lc.vill_townprt_code');

    // Apply the same WHERE and GROUP BY conditions
    $dbb->where('lc.dist_code', $dist_code);
    $dbb->where('lc.subdiv_code', $subdiv_code);
    $dbb->where('lc.cir_code', $cir_code);
    $dbb->where('lc.vill_townprt_code <>', '00000');
    $dbb->where('lc.rural_urban', 'U');

    // Use where_in with the array of type codes
    if (!empty($type_codes)) {
        $dbb->where_in('patta_type_code', $type_codes);
    } else {
        // If no matching type codes, ensure the query returns no results
        $dbb->where('patta_type_code IS NULL');
    }

    $dbb->group_by([
        'cb.dist_code', 
        'cb.subdiv_code', 
        'cb.cir_code', 
        'cb.mouza_pargona_code', 
        'cb.lot_no', 
        'cb.vill_townprt_code'
    ]);
    
    $data['total_records'] = $dbb->count_all_results();

    return $data;
}




}