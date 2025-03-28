<style>
  @media (min-width: 576px){
    .modal-dialog-cabinet {
        max-width: 1200px !important;
        margin: 1.75rem auto;
    }
    }

    .fade.modal-backdrop.show{
        opacity: 0.8;
    }
  .reza-card {
      background: #fff;
      border-radius: 2px;
      display: inline-block;
      margin: 1rem;
      position: relative;
      width: 100%;
  }

  .reza-card {
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
      transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
  }

  .reza-title {
      font-weight: bold;
      font-size: 18px;
      padding: 20px;
      color: #37474F;
  }

  .reza-body {
      padding-left: 20px;
      padding-right: 20px;
      padding-bottom: 20px;
  }

  .badge {
      padding: 10px;
      font-size: 15px;
  }

  .rezaButt {
      color: #FFF;
      background-color: #03a9f4;
  }

  .rezaButt:hover {
      color: #0c0c0c;
  }

  .rezaButt {
      display: inline-block;
      position: relative;
      cursor: pointer;
      height: 35px;
      min-width: 150px;
      line-height: 35px;
      padding: 0 1.5rem;
      font-size: 15px;
      font-weight: 600;
      font-family: "Roboto", sans-serif;
      letter-spacing: 0.8px;
      text-align: center;
      text-decoration: none;
      text-transform: uppercase;
      vertical-align: middle;
      white-space: nowrap;
      outline: none;
      border: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      border-radius: 2px;
      transition: all 0.3s ease-out;
  }

  .rezaText {
      font-size: 16px;
  }

  label {
      padding-bottom: 5px;
      font-weight: bold;
  }

  #searchBox {
      padding: 15px;
      border: 1px solid #00BCD4;
      margin: 0px;
  }

  #cases_wrapper {
      margin-top: 0px !important;
  }

  .table thead tr:first-child {
      background: #40739e;
  }
</style>

  <div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="reza-card">
            <div class="reza-title">
                <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          Conversion Proposal List
                      </div>
                </div>
                <hr style="margin-bottom: -5px">
            </div>

            <div class="reza-body" id="showBody">
                    <!-- DataTable -->
                    <table class='table table-striped table-bordered' id='dataTableConversionProposalList' width="100%">
                        <thead>
                        <tr>
                            <th class="center"><label class="control-label">Proposal</th>
                            <th class="center"><label class="control-label">Date</label></th>
                            <th class="center"><label class="control-label">Status</th>
                            <!-- <th class="center"><label class="control-label">Assigned District(s)</th> -->
                            <th class="center"><label class="control-label">Action</label></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- DataTable -->
            </div>
        </div>
    </div>
  </div>

</div>



<!-- Modal Structure -->
<div class="modal fade" id="sentProposalToSecModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Proposal for Verification :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="text" class="form-control" id="proposalNumber" readonly>
      <div class="modal-body">
        <h5>Do You Really want to send this proposal for Verification</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confirmSendForVerifyToSec">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- Send Proposal to PS -->
<div class="modal fade" id="sentProposalToPSModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Proposal for Verification to PS :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="text" class="form-control" id="proposalNumberSec" readonly>
      <div class="modal-body">
        <h5>Do You Really want to send this proposal for Verification</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confirmSendForVerifyToPS">Confirm</button>
      </div>
    </div>
  </div>
</div>


<!-- Verify by PS -->
<div class="modal fade" id="verifyProposalByPSModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Proposal for Verification :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="text" class="form-control" id="proposalNumberPS" readonly>
      <div class="modal-body">
        <h5>Do You Really want to send this proposal for Verification</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confirmVerifyProposalByPS">Confirm</button>
      </div>
    </div>
  </div>
</div>



<input type="hidden" id="getBaseURL" value="<?=base_url()?>index.php">

<script type="text/javascript">

  var base_url = "<?php echo base_url();?>";

  function showSuccessMessage(text) {
    swal.fire({
      title: "Success !",
      text: text,
      icon: 'success',
      position: 'top',
      showConfirmButton: true,
      timer: 5000,
    });
  }

  function showErrorMessage(text) {
    swal.fire({
      title: "Error!",
      text: text,
      icon: 'error',
      position: 'top',
      timer: 5000,
      showCancelButton: true
    });
  }

  function showWarningMessage(text) {
    swal.fire({
      title: "Warning!",
      text: text,
      icon: 'warning',
      position: 'top',
      timer: 5000,
      showCancelButton: true
    });
  }
  $(document).ready( function () {

    $(document).on('click', '#sentProposalToSec', function() {
        var proposalNo = $(this).val(); 
        $('#sentProposalToSecModal .modal-body').html('Proposal No: ' + proposalNo);
        $('#proposalNumber').val(proposalNo);
        $('#sentProposalToSecModal').modal('show');
    });

    $(document).on('click', '#sentProposalToPS', function() {
        var proposalNo = $(this).val(); 
        $('#sentProposalToPSModal .modal-body').html('Proposal No: ' + proposalNo);
        $('#proposalNumberSec').val(proposalNo);
        $('#sentProposalToPSModal').modal('show');
    });

    $(document).on('click', '#verifyProposalByPS', function() {
        var proposalNo = $(this).val(); 
        $('#verifyProposalByPSModal .modal-body').html('Proposal No: ' + proposalNo);
        $('#proposalNumberPS').val(proposalNo);
        $('#verifyProposalByPSModal').modal('show');
    });

    load_conversion_proposal_list();

    function load_conversion_proposal_list(selectDistrict)
    {
      var table = $('#dataTableConversionProposalList').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
          url: base_url+'index.php/DeptConversion/getGeneratedProposalList',
          type:'POST',
          deferLoading: 57,
        },
      });
    }

  });


      //////////Send by JS to SEC for verification
      $(document).on('click', '#confirmSendForVerifyToSec', function() {
        var proposalNo = $("#proposalNumber").val();
            const applicant = {
                proposalNo: proposalNo,
            };
            console.log(applicant);
            $.ajax({
                url: base_url + "DeptConversion/sendConversionProposalToSec",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {
                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {              
                        Swal.fire({
                            backdrop:true,
                            allowOutsideClick: false,
                            text: data.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                actions: 'my-actions',
                                confirmButton: 'order-2',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(true);
                            }
                        });
                    } else if (data.responseType == 3) {
                        Swal.fire({
                            html: data.message,
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        });
                    } else {
                        showErrorMessage("List Not Generated.");
                    }
                },
                data: JSON.stringify(applicant)
            });
    });



        //////////Send by SEC to PS for verification
      $(document).on('click', '#confirmSendForVerifyToPS', function() {
        var proposalNo = $("#proposalNumberSec").val();
            const applicant = {
                proposalNo: proposalNo,
            };
            console.log(applicant);
            $.ajax({
                url: base_url + "DeptConversion/sendConversionProposalToPS",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {
                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {              
                        Swal.fire({
                            backdrop:true,
                            allowOutsideClick: false,
                            text: data.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                actions: 'my-actions',
                                confirmButton: 'order-2',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(true);
                            }
                        });
                    } else if (data.responseType == 3) {
                        Swal.fire({
                            html: data.message,
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        });
                    } else {
                        showErrorMessage("List Not Generated.");
                    }
                },
                data: JSON.stringify(applicant)
            });
    });


          //////////Confirm Verification by PS
      $(document).on('click', '#confirmVerifyProposalByPS', function() {
        var proposalNo = $("#proposalNumberPS").val();
            const applicant = {
                proposalNo: proposalNo,
            };
            console.log(applicant);
            $.ajax({
                url: base_url + "DeptConversion/verifyApproveConversionProposalByPS",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {
                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {              
                        Swal.fire({
                            backdrop:true,
                            allowOutsideClick: false,
                            text: data.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                actions: 'my-actions',
                                confirmButton: 'order-2',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(true);
                            }
                        });
                    } else if (data.responseType == 3) {
                        Swal.fire({
                            html: data.message,
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        });
                    } else {
                        showErrorMessage("List Not Generated.");
                    }
                },
                data: JSON.stringify(applicant)
            });
    });



</script>
