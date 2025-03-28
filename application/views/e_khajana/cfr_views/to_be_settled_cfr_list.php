<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/index'?>">CFR-INDEX</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">Updated CFR Pages List</li>
  </ol>
</nav>
<input type="hidden" value="<?=base_url()?>" id="base_url" name="base_url">
<div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 150px;"></div>
<div class="panel panel-info panel-form">     
    <div class="tab-content">        
        <div class="card-body">
            <div class="card-body shadow-lg p-1 mb-5 bg-white rounded">                              
                <div class="card panel-heading text-white bg-primary text-center">
                    <h5 class="panel-title">
                        <u>
                            <b>Updated CFR Pages List</b><br>
                            DISTRICT-<?=$district_name?>, CIRCLE-<?=$circle_name?>, MOUZA-<?=$mouza_name?>
                        </u>                        
                    </h5>
                </div> 
                <div class="card panel-heading text-warning bg-dark text-center" style="margin-top:-20px;">
                    <h6 class="panel-title">
                        <u>
                            <b>NOTE:</b> AT MAX 10 CFR PAGES CAN BE SELECTED AT ONCE FOR PAYMENT.
                        </u>                        
                    </h6>
                </div> 
                <div class="card-body">            
                    <table id="ek_ast_pending_list_1" class="table table-hover text-center" style="width:100%">            
                        <thead class="thead-dark">                            
                        <tr style="background-color: black; color: #fff;">
                                <td>SELECT ALL<br>
                                    <input type="checkbox" id="selectAll">
                                </td>
                                <td>CFR-BOOK-NUMBER</td>
                                <td>CFR-PAGE-NUMBER</td>
                                <td>TOTAL NO OF <br>PATTA IN THE CFR</td>
                                <td>ACTION</td>
                            </tr>                                                        
                        </thead>
                        <tbody>
                            <?php foreach ($toBeSettleList as $row):?> 
                                <tr>
                                    <td>
                                        <input type="checkbox" class="row-checkbox" data-book-no="<?=$row->cfr_book_no?>" data-total-patta="<?=$row->total_no_of_patta?>" value="<?=$row->cfr_page_no?>">
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-danger">
                                            <?=$row->cfr_book_no?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-success">
                                            <?=$row->cfr_page_no?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-success">
                                            <?=$row->total_no_of_patta?>
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm text-white" 
                                            href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/viewUpdatedCfrPageDetails/'.$row->cfr_page_no?>" role="button" style="font-size: 14px;">
                                            View Complete Details &nbsp;&nbsp;
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    <div class="text-center mt-3">
                        <button id="payButton" class="btn btn-success btn-sm">
                            <i class="fa fa-inr"></i> PROCEED FOR PAYMENT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var baseurl = $('#base_url').val();

    $('#ek_ast_pending_list_1').DataTable();

    // Select/Deselect all checkboxes
    $('#selectAll').on('click', function() {
        const isChecked = $(this).is(':checked');
        $('.row-checkbox').prop('checked', isChecked);
    });

    // Handle pay button click
    $('#payButton').on('click', function() {
        const selectedRows = [];
        let totalPattaCount = 0;

        $('.row-checkbox:checked').each(function() {
            const rowData = {
                bookNumber: $(this).data('book-no'),
                pageNumber: $(this).val(),
                totalPatta: parseInt($(this).data('total-patta'))
            };
            selectedRows.push(rowData);
            totalPattaCount += rowData.totalPatta;
        });

        // Check if no row is selected
        if (selectedRows.length === 0) {
            alert('Please select at least one row.');
            return;
        }

        // Validate maximum selection limit
        if (selectedRows.length > 10) {
            alert('Maximum 10 CFR pages can be settled in one time settlement.');
            return;
        }

        Swal.fire({
            title: 'Confirm Payment',
            text: `Total number of patta to be settled: ${totalPattaCount}. Do you want to proceed?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a dynamic form
                const form = $('<form>', {
                    action: baseurl + '/EkhajanaMouzadarCfr/cfrPagesToBePaidDetails',
                    method: 'POST',
                    target: '_blank' // Open in new tab
                });

                // Append rows to the form
                selectedRows.forEach(row => {
                    form.append($('<input>', {
                        type: 'hidden',
                        name: 'rows[]',
                        value: JSON.stringify(row)
                    }));
                });

                // Append totalPattaCount to the form
                form.append($('<input>', {
                    type: 'hidden',
                    name: 'totalPattaCount',
                    value: totalPattaCount
                }));

                // Append the form to the body and submit it
                $('body').append(form);
                form.submit();
            }
        });
    });
});

</script>
