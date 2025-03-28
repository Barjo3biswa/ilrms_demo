<style>
    body{
        padding-right: 0 !important;
    }

    .table thead tr:first-child {
    background: #e6e1e1 ;
}
</style>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 text-white">
        <li class="breadcrumb-item font-weight-bold">
            <a href="<?php echo base_url() . 'index.php/CPMSAdcController/getCPMSDetails'?>">
                CPMS
            </a>
        </li>
        <li class="breadcrumb-item font-weight-bold active" aria-current="page">CPMS-Form</li>
    </ol>
</nav>
<div class="col-lg-10 offset-1 mb-5">
    <div class="panel panel-info">                
        <div class="panel-heading p-1 mb-1 shadow-lg" style="background-color:#17A57D;color:white">
            <h4 class="panel-title text-center">REPORT OF CONSULTANT PERFORMACE MONITORING SYSTEM</h4>
        </div>
        <div class="panel-body">                        
            <table id="cpms_rpt_dt" class="table table-hover text-left" 
            style="width:100%!important;background-color:#e6e1e1;font-size:12px;!important">            
                <thead class="thead-dark">                            
                    <tr>  
                        <th>SR-NO</th> 
                        <th>DISTRICT-NAME</th>                             
                        <th>CONSULTANT-NAME</th>
                        <th>CONSULTANT-CONTACT-NO</th>
                        <th>OVERALL-PERCENTAGE</th>
                        <th>GRADE</th>
                        <th>RESULT</th>
                        <th>REVISED SALARY</th>
                        <th>UPDATED DATE/TIME</th>
                    </tr>                                                        
                </thead>
                <tbody>       
                    <?php
                        $count= 1; 
                    ?>            
                    <?php foreach ($cpms_report_data as $row):?>             
                        <?php if($row['data_exists']): ?> 
                            <tr class="table-light">
                                <td><?=$count++?></td>
                                <td><?=$row['district_name']?></td>
                                <td><?=$row['consultant_name']?></td>
                                <td><?=$row['consultant_contact_no']?></td>
                                <td><?=$row['overall_percentage']?></td>
                                <td><?=$row['grade']?></td>
                                <td><?=$row['result']?></td>
                                <td><?=$row['revised_salary']?> RS</td>
                                <td><?=$row['updated_date_time']?></td>
                            </tr>
                        <?php else :?>
                            <tr class="text-danger">
                                <td><?=$count++?></td>
                                <td><?=$row['district_name']?></td>
                                <td><?=$row['consultant_name']?></td>
                                <td><?=$row['consultant_contact_no']?></td>
                                <td><?=$row['overall_percentage']?></td>
                                <td><?=$row['grade']?></td>
                                <td><?=$row['result']?></td>
                                <td><?=$row['revised_salary']?> RS</td>
                                <td><?=$row['updated_date_time']?></td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach;?> 
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTableButtonJsZIP.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/datatableButtons.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/datatableButtonHtml.js"></script>    
  
<script type="text/javascript">  
$(document).ready( function () {
    $('#cpms_rpt_dt').dataTable({
        "scrollX": true,
        "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
        "pageLength": 5,
        "paging": true,
        "searching" : true,
        "autoWidth":true,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download"></i> Download As Excel',
                titleAttr: 'Excel',
                title: "CPMS-REPORT",
            }, 
        ],
        initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-success btn-sm');
            btns.removeClass('dt-button');
        }
    });
});
</script>
