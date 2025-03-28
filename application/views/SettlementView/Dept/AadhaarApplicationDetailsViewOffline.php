  <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-list-alt" aria-hidden="true"></i>
      Application Details
  </h5>

<div class="row justify-content-center">
    <table class="table table-bordered">
        <tr>
            <th style="width: 25%">Application No.</th>
            <td style="width: 25%; font-weight: bold"><?php echo $case_no ?></td>
            <th style="width: 25%">Application Status.</th>
            <td style="width: 25%; font-weight: bold">
                <?php if($settlement_basic['status'] == 'D'): ?>
                    Rejected
                <?php elseif($settlement_basic['status'] == 'F'): ?>
                    Delivered
                <?php else: ?>
                    Under Process
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th style="width: 25%">Pending Office</th>
            <td style="width: 25%; font-weight: bold"><?php echo $settlement_basic['pending_office'] ?></td>
            <th style="width: 25%">Pending With</th>
            <td style="width: 25%; font-weight: bold"><?php echo $settlement_basic['pending_officer'] ?></td>
        </tr>
        <tr>
            <th style="width: 25%">Applied On</th>
            <td style="width: 25%; font-weight: bold">
                <?php echo date('d-m-Y', strtotime($settlement_basic['date_entry'])); ?>
            </td>
            <th style="width: 25%">Applied By</th>
            <td style="width: 25%; font-weight: bold">DC</td>
        </tr>




        <tr>
            <th style="width: 25%">Type of House</th>
            <td style="width: 25%; font-weight: bold; text-transform: capitalize"><?php echo $caseDetails->house_type  ?></td>
            <th style="width: 25%">Period & Nature of Possession</th>
            <td style="width: 25%; font-weight: bold; text-transform: capitalize"><?php echo $caseDetails->nature_of_possession  ?></td>
        </tr>

        <tr>
            <th style="width: 25%">SDLAC Recommendation</th>
            <td style="width: 25%; font-weight: bold">
                <?php if($caseDetails->sdlac_rec == 1): ?>
                    Recommended
                <?php elseif($caseDetails->sdlac_rec == 2): ?>
                   Not Recommended
                <?php else: ?>
                    Not Mention
                <?php endif; ?>
            </td>
            <th style="width: 25%">SDLAC Recommendation Date</th>
            <td style="width: 25%; font-weight: bold">
                <?php echo date('d-m-Y', strtotime($caseDetails->sdlac_rec_date )); ?>
            </td>
        </tr>
        <tr>
            <th style="width: 25%">Zonal valuation </th>
            <td style="width: 25%; font-weight: bold"><?php echo $caseDetails->zonal_value  ?></td>
            <th style="width: 25%">Rate of premium </th>
            <td style="width: 25%; font-weight: bold"><?php echo $caseDetails->premium  ?></td>
        </tr>
        <tr>
            <th style="width: 25%">Accepted / Recommendation</th>
            <td style="width: 25%; font-weight: bold">
                <?php if($caseDetails->recommendation == 1): ?>
                    Accepted
                <?php elseif($caseDetails->recommendation == 2): ?>
                    Rejected
                <?php else: ?>
                    Not Mention
                <?php endif; ?>
            </td>
            <th style="width: 25%">Concession</th>
            <td style="width: 25%; font-weight: bold"><?php echo $caseDetails->concession  ?></td>
        </tr>
        <tr>
            <th style="width: 25%">Whether eligible as per Clause 14.4 of Land Policy, 2019</th>
            <td style="width: 25%; font-weight: bold; text-transform: capitalize"><?php echo $caseDetails->land_policy_status  ?></td>
            <th style="width: 25%">Checklist Submitted</th>
            <td style="width: 25%; font-weight: bold; text-transform: capitalize"><?php echo $caseDetails->checklist  ?></td>
        </tr>
        <tr>
            <th style="width: 25%">Remarks </th>
            <td style="width: 75%" colspan="3"><?php echo $caseDetails->remarks  ?></td>
        </tr>
    </table> 
</div>