<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaDoatReportController/getEkhajanaDoatReport'?>">Report-Index</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">Monthly-Report-(<?=$month_name?>-<?=$year?>)</li>
  </ol>
</nav>
<div class="panel panel-info panel-form ">
    <div class="card panel-heading text-white bg-success text-center">
        <h4 class="panel-title">
            <u>
                <b>e-Khajana Monthly Transaction Details For The Month Of <?=$month_name?>, <?=$year?></b><br>
            </u>                        
        </h4>
    </div> 
    <div class="tab-content">
        <div class="card-body">
            <div class="card-body shadow-lg p-1 mb-5 bg-white rounded">                              
                <div class = "card-body">            
                    <table id="ekhajana_doat_report_table" class="table table-hover text-center" style="width:100%">            
                        <thead class="thead-dark">                            
                            <tr style="background-color: black; color: #fff;">
                                <td>Sl.no</td>
                                <td>GRN No.</td>
                                <td>PARTY NAME</td>
                                <td>AMOUNT(Total Receipt)</td>
                                <td>DATE</td>
                                <td>Commissiion Amount</td>
                                <td>Mouza Name</td>
                            </tr>                                                        
                        </thead>
                        <tbody>
                            <?php $count = 1;?>
                            <?php foreach ($report_data as $row):?> 
                                <tr>
                                    <td>
                                        <span class="font-weight-bolder text-danger">
                                            <?=$count++?>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-success">
                                            <?=$row->grn_no?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-primary">
                                            <?=$row->party_name?>
                                        <span>
                                        
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-danger">
                                           Rs <?=$row->total_amount?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-success">
                                            <?=date('d/m/Y',strtotime($row->created_at))?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-success">
                                            Rs <?=$row->total_commission_patta_wise?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-success">
                                            <?=$row->mouza_name?>
                                        <span>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            <tr>
                                <td>
                                    <span class="font-weight-bolder">
                                        Total No Of GRN : 
                                    </span>
                                </td>
                                <td><?=$total_unique_GRN?></td>
                                <td>
                                    <span class="font-weight-bold">
                                        Total Amount Received:
                                    <span>                                    
                                </td>
                                <td>Rs <?=$total_amount_received?></td>
                                <td></td>
                                <td>
                                    <span class="font-weight-bold">
                                        Total Commission Amount : 
                                    <span>
                                </td>                                
                                <td>Rs <?=$total_commission_received?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTableButtonJsZIP.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/datatableButtons.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/datatableButtonHtml.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.9/vfs_fonts.js" integrity="sha512-nNkHPz+lD0Wf0eFGO0ZDxr+lWiFalFutgVeGkPdVgrG4eXDYUnhfEj9Zmg1QkrJFLC0tGs8ZExyU/1mjs4j93w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">  
$(document).ready( function () {
    $('#ekhajana_doat_report_table').dataTable({
        "scrollX": true,
        "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
        "pageLength": 20,
        //"autoWidth":false,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'pdf',
                customize: function ( doc ) {doc.watermark = {text: 'e-Khajana Monthly Transaction Details For The Month Of <?=$month_name?> <?=$year?>', color: 'blue', opacity: 0.1}},
                title: 'e-khajana Monthly Accounting Report For Office Of AG, <?=$month_name?> <?=$year?>',
                //filename: 'customized_pdf_file_name',
                text:'<i class="fa fa-download"></i> Download As Pdf',
            }],
        initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-info btn-sm');
            btns.removeClass('dt-button');
        }
    });
});
</script>
