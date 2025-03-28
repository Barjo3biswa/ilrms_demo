<?php

class RevenueDashboardModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    // public function getCaseCountDetailsByService($dbb,$service,$service_code)
    // {
    //     if($service == 'FMUTI' || $service == 'FMUTD')
    //     {
    //         $subQuery = "AND (app.is_urban ='N'  AND ( app.is_omut ='N'  OR app.is_omut is NULL))";
    //     }
    //     if(($service == 'OMUTI' || $service == 'OMUTD'))
    //     {
    //         $subQuery = "AND ((app.is_urban = 'Y' AND (app.is_omut = 'Y' OR app.is_omut IS NULL)) OR (app.is_urban = 'N' AND app.is_omut = 'Y'))";
    //     }
    //     if($service == 'RECLASS')
    //     {
    //         $subQuery = "";
    //     }

    //     $sql = "SELECT 
    //             COUNT(*) AS total_received_count,
    //             COUNT(CASE WHEN app.status IN ('F', 'f') THEN 1 END) AS total_approved_count,
    //             AVG(app.modified_at::date - app.date_submission::date) AS average_time,
    //             MAX(app.modified_at::date - app.date_submission::date) AS maximum_time,
    //             MIN(app.modified_at::date - app.date_submission::date) AS minimum_time,
    //             AVG(COALESCE(ep.total_amount, 0)) AS average_fees        
    //         FROM 
    //             applications app
    //         JOIN 
    //             epayment ep ON ep.application_no = app.application_no
    //         WHERE 
    //             app.service_code= '$service_code'
    //         AND app.initial_payment_status = 'C' AND app.status IN('F','f') $subQuery";

    //     $result = $dbb->query($sql);
    //     return $result;
    // }


    public function getCaseCountDetailsByService($dbb,$service,$service_code)
    {
        if($service == 'FMUTI' || $service == 'FMUTD')
        {
            $subQuery = "AND (app.is_urban ='N'  AND ( app.is_omut ='N'  OR app.is_omut is NULL))";
        }
        if(($service == 'OMUTI' || $service == 'OMUTD'))
        {
            $subQuery = "AND ((app.is_urban = 'Y' AND (app.is_omut = 'Y' OR app.is_omut IS NULL)) OR (app.is_urban = 'N' AND app.is_omut = 'Y'))";
        }
        if($service == 'RECLASS')
        {
            $subQuery = "";
        }

        $sql = "SELECT 
                COUNT(*) AS total_received_count,
                COUNT(CASE WHEN app.status IN ('F', 'f') THEN 1 END) AS total_approved_count,
                AVG(COALESCE(ep.total_amount, 0)) AS average_fees        
            FROM 
                applications app
            JOIN 
                epayment ep ON ep.application_no = app.application_no
            WHERE 
                app.service_code= '$service_code'
            AND app.initial_payment_status = 'C' $subQuery";

        $result = $dbb->query($sql);
        return $result;
    }

    public function timeCalculation($dbb,$service,$service_code)
    {
        if($service == 'FMUTI' || $service == 'FMUTD')
        {
            $subQuery = "AND (app.is_urban ='N'  AND ( app.is_omut ='N'  OR app.is_omut is NULL))";
        }
        if(($service == 'OMUTI' || $service == 'OMUTD'))
        {
            $subQuery = "AND ((app.is_urban = 'Y' AND (app.is_omut = 'Y' OR app.is_omut IS NULL)) OR (app.is_urban = 'N' AND app.is_omut = 'Y'))";
        }
        if($service == 'RECLASS')
        {
            $subQuery = "";
        }

        $sqlTime = "SELECT 
                AVG(app.modified_at::date - date(to_timestamp(ep.transcompletiondatetime,'YYYYMMDDHH24MISS'))) AS average_time,
                MAX(app.modified_at::date - date(to_timestamp(ep.transcompletiondatetime,'YYYYMMDDHH24MISS'))) AS maximum_time,
                MIN(app.modified_at::date - date(to_timestamp(ep.transcompletiondatetime,'YYYYMMDDHH24MISS'))) AS minimum_time    
            FROM 
                applications app
            JOIN 
                epayment ep ON ep.application_no = app.application_no
            WHERE 
                app.service_code= '$service_code'
            AND app.initial_payment_status = 'C' AND app.status IN('F','f') AND length(ep.transcompletiondatetime) = 14 $subQuery";

        $result = $dbb->query($sqlTime);
        return $result;
    }

    public function getMedianCaseCountByService($dbb,$service,$service_code)
    {

        if($service == 'FMUTI' || $service == 'FMUTD')
        {
            $subQuery = "AND (app.is_urban ='N'  AND ( app.is_omut ='N'  OR app.is_omut is NULL))";
        }
        if($service == 'OMUTI' || $service == 'OMUTD')
        {
            $subQuery = "AND ((app.is_urban = 'Y' AND (app.is_omut = 'Y' OR app.is_omut IS NULL)) OR (app.is_urban = 'N' AND app.is_omut = 'Y'))";
        }
        if($service == 'RECLASS')
        {
            $subQuery ="";
        }
                    $median_sql = "WITH time_differences AS (
                            SELECT
                                (app.modified_at::date - app.date_submission::date) AS time_diff
                            FROM
                                applications app
                            WHERE
                                app.service_code= '$service_code'
                            AND app.initial_payment_status = 'C' AND app.status IN('F','f') $subQuery
                        ),
                        ranked_times AS (
                            SELECT
                                time_diff,
                                ROW_NUMBER() OVER (ORDER BY time_diff) AS rn,
                                COUNT(*) OVER () AS total_count
                            FROM
                                time_differences
                        )
                        SELECT 
                            CASE
                                WHEN total_count % 2 = 0 THEN 
                                    (SELECT AVG(time_diff) 
                                    FROM ranked_times 
                                    WHERE rn IN (total_count / 2, total_count / 2 + 1))
                                ELSE 
                                    (SELECT time_diff 
                                    FROM ranked_times 
                                    WHERE rn = (total_count + 1) / 2)
                            END AS median_time
                        FROM ranked_times
                        LIMIT 1";
        $median_result = $dbb->query($median_sql);
        return $median_result;

    }



    public function getAllCaseListDetails($dbb,$start, $length, $order, $service,$service_code,$searchByCol_0)
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
            $dbb->select('app.application_no, app.date_submission, app.modified_at,ep.amount, ep.total_amount');
            $dbb->from('applications app');
            $dbb->join('epayment ep', 'ep.application_no = app.application_no');
            $dbb->where('app.initial_payment_status', 'C');
            $dbb->where_in('app.status', ['F', 'f']);
            $dbb->where('app.service_code', $service_code);
            if($service == 'FMUTI' || $service == 'FMUTD')
            {
                $this->db->group_start()
                        ->where('app.is_omut', 'N')
                        ->or_where('app.is_omut IS NULL', null, false)
                        ->group_end();
            }
            if($service == 'OMUTI' || $service == 'OMUTD')
            {
                $this->db->group_start()
                        ->group_start()
                            ->where('app.is_urban', 'Y')
                            ->group_start()
                                ->where('app.is_omut', 'Y')
                                ->or_where('app.is_omut IS NULL', null, false)
                            ->group_end()
                        ->group_end()
                        ->or_group_start()
                            ->where('app.is_urban', 'N')
                            ->where('app.is_omut', 'Y')
                        ->group_end()
                    ->group_end();
            }

            if ($searchByCol_0 != null) {
                $dbb->like('ep.application_no', $searchByCol_0);
            }
                $dbb->limit($length, $start);
            $query = $dbb->get();
            if ($query->num_rows() > 0) {
                $data['data_results'] = $query->result();
                $dbb->select('app.application_no, app.date_submission, app.modified_at,ep.amount, ep.total_amount');
            $dbb->from('applications app');
            $dbb->join('epayment ep', 'ep.application_no = app.application_no');
            $dbb->where('app.initial_payment_status', 'C');
            $dbb->where_in('app.status', ['F', 'f']);
            $dbb->where('app.service_code', $service_code);
            if($service == 'FMUTI' || $service == 'FMUTD')
            {
                $this->db->group_start()
                        ->where('app.is_omut', 'N')
                        ->or_where('app.is_omut IS NULL', null, false)
                        ->group_end();
            }
            if($service == 'OMUTI' || $service == 'OMUTD')
            {
                $this->db->group_start()
                        ->group_start()
                            ->where('app.is_urban', 'Y')
                            ->group_start()
                                ->where('app.is_omut', 'Y')
                                ->or_where('app.is_omut IS NULL', null, false)
                            ->group_end()
                        ->group_end()
                        ->or_group_start()
                            ->where('app.is_urban', 'N')
                            ->where('app.is_omut', 'Y')
                        ->group_end()
                    ->group_end();
            }
            if ($searchByCol_0 != null) {
                $dbb->like('ep.application_no', $searchByCol_0);
            }
            $data['total_records'] = $dbb->count_all_results();
                return $data;
            }
    }
}