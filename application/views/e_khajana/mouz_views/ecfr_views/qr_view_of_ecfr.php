<?php
    $date = strtotime(date('Y-m-d',strtotime($ecfr_data->created_at)));
    $newDate = date('Y-m-d',strtotime('+15 days',$date));
?>
<div class="container " style="margin-bottom:2rem;overflow-x: scroll;">
    <table class="table" width='100%'>
        <tr>
            <td>
                LAND-APPLICATION-NO
            </td>
            <td>
                <?=$ecfr_data->application_no?>
            </td>
            <td>
                E-CFR ENTRY TIME
            </td>
            <td>
                <?=date('Y-m-d',strtotime($ecfr_data->created_at))?>
            </td>
        </tr>
        <tr>
            <td>
                TOTAL-AMOUNT
            </td>
            <td>
                <?=$ecfr_data->due_amount?>
            </td>
            <td>
                VILLAGE
            </td>
            <td>
                <?=$this->utilclass->getVillageName($ecfr_data->dist_code,$ecfr_data->subdiv_code,$ecfr_data->cir_code,$ecfr_data->mouza_pargona_code,$ecfr_data->lot_no,$ecfr_data->vill_townprt_code)?>
            </td>
        </tr>
        <tr>
            <td>
                PATTA-TYPE
            </td>
            <td>
                <?=$this->utilclass->getPattaType($ecfr_data->patta_type_code)?>
            </td>
            <td>
                PATTA-NO
            </td>
            <td>
                <?=$ecfr_data->patta_no?>
            </td>
        </tr>
        <tr>
            <td>
                PATTADAR-NAME
            </td>
            <td>
                <?=$ecfr_data->pdar_name?>
            </td>
            <td>
                VALID UPTO
            </td>
            <td>
                <?=$newDate?>
            </td>
        </tr>
    </table>
</div>