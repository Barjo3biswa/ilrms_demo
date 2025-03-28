$(document).ready(function(){
  var baseurl = "http://141.148.207.152/ilrmsdemo";
    $('#dataTable').DataTable();

  // New Script for Button navigation
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
      localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    // alert(activeTab);
    if (activeTab) {
      $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
  });



   // button navigaion
  $('#btnNext').click(function() {
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
      if (activeTab == "#step1") {
        activeTab = "#step2";
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      } else if (activeTab == "#step2") {
        activeTab = "#step3";
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      } else if (activeTab == "#step3") {
        activeTab = "#step7";
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      } else if (activeTab == "#step7") {
        activeTab = "#step6";
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      }

    }

  });

  $('#btnPrevious').click(function() {
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
      if (activeTab == "#step2") {
        activeTab = "#step1";
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      } else if (activeTab == "#step3") {
        activeTab = "#step2";
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      } else if (activeTab == "#step7") {
        activeTab = "#step3";
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      } else if (activeTab == "#step6") {
        activeTab = "#step7";
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      }

    }
  });



 // ****************************************************************
    // proposal id search by case no
    $(document).on('click', '#searchProId', function() {
        $('#searchProIdModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#searchProIdModal').modal('show');
    });

    $(document).on('click', '#searchProIdModalNo', function() {
        $('#searchProIdModal').modal('hide');
    });

    $(document).on('click', '#searchProIdModalYes', function() {
        const applicant = {
            districtId: $("#districtId").val(),
            caseNo: $("#caseId").val(),
            applicationNo: $("#applicationId").val(),

        };


        $.ajax({
            url: BASE_URL + "/Basundhara/searchProposalIdByAppCaseNo",
            type: "post",
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data.responseType == 1) {
                    showErrorMessage("There is some problem, Please try again");
                } else if (data.responseType == 2) {

                    $('#searchProIdModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    var table = '';
                    var sl = 1;
                    $.each(data.proposalIds, function(i, val) {

                        table +=
                            '<tr>' +
                            // '<td style="font-size: 18px; font-weight: bold; color: red">' + sl + '. &nbsp;' + '</td>' +
                            '<td style="font-size: 18px; font-weight: bold; color: red">' + 'Case Fall Under Proposal No:  ' + val.proposal_id + '</td>' +
                            '</tr>';

                        sl = sl + 1;
                    });
                    $('#caseTable').html(table);
                } else if (data.responseType == 3) {
                    $('#searchProIdModal').modal('hide');
                    showErrorMessage("Data not found !");
                } else {
                    showErrorMessage("SOMETHING WENT WRONG");
                }
            },
            data: JSON.stringify(applicant)

        });
    });

    // proposal id search by case no End
 // ****************************************************************


  ////////////////////////////////// Newly Added Bulk Approve & Revert ////////////////////////////////


    var BASE_URL = $("#getBaseURL").val();

    // Success Message
    function showSuccessMessage(text) {
        swal.fire({
            title: "Success !",
            text: text,
            icon: 'success',
            position: 'top',
            showConfirmButton: true,
            timer: 5000,
        });
        location.reload();
    }

    // Error Message
    function showErrorMessage(text) {
        swal.fire({
            title: "Error!",
            text: text,
            icon: 'error',
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            showCancelButton: true
        });
    }

    // Warning Message
    function showWarningMessage(text) {
        swal.fire({
            // title: "Error!",
            text: text,
            icon: 'warning',
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            showCancelButton: true
        });
    }


    // ****************************************************************
    // Approve and FOrwared to Co Button
    $(document).on('click', '#bulkApproveDepartment', function() {
        $('#bulkApproveModal').modal('show');
    });

    function bulk_approval_reset_modal(){
        $('#bulkApproveModal').fadeOut('slow').modal('hide');
        document.getElementById("dept_approval_form").reset();
    }


    // Revert to DC Button
    $(document).on('click', '#bulkRevertDepartment', function() {
        $('#bulkRevertModal').modal('show');
    });


function bulk_revert_reset_modal(){
        $('#bulkRevertModal').fadeOut('slow').modal('hide');
        document.getElementById("dept_revert_form").reset();
    }

    $("#checkedAll").click(function() {
        if (this.checked) {
            $('.selectMark').each(function() {
                this.checked = true;
                $('.selectMark').prop('checked', true);
            })
        } else {
            $('.selectMark').each(function() {
                this.checked = false;
                $('.selectMark').prop('checked', false);
            })
        }
    });



    //Cases Approved by Department & Sent to CO
    $(document).on('click', '#bulkApproveByDeptYes', function() {
        $('#bulkApproveModal').modal('hide');

        var department_remarks_approve = $("#department_remarks_approve").val();
        var dept_order_date = $("#dept_order_date").val();
        var dept_order_no = $("#dept_order_no").val();
        var proposal_id_approve = $("#proposal_id_approve").val();
        var district_id_approve = $("#district_id_approve").val();

        if (dept_order_no == '') {
            showWarningMessage("Please Enter Order Number !");
        }

        if (dept_order_date == '') {
            showWarningMessage("Please Enter Order Date !");
        }
        if (department_remarks_approve == '') {
            showWarningMessage("Please Enter Some Additional Remarks !");
        }

        var selectedList = [];

        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
        });

        if (selectedList.length > 0) {

            const applicant = {
                selectedList: selectedList,
                department_remarks_approve: department_remarks_approve,
                dept_order_date: dept_order_date,
                dept_order_no: dept_order_no,
                proposal_id_approve: proposal_id_approve,
                district_id_approve: district_id_approve,
            };

            console.log(applicant);


            $.ajax({
                url: BASE_URL + "/Basundhara/bulkApproveByDepartment",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {

                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {

                        showSuccessMessage(data.message);
                        location.reload();

                    } else if (data.responseType == 3) {

                        showWarningMessage(data.message);
                    } else { 

                        showErrorMessage("Application Approval Failed.Kindly Contact System Administrator.");
                    }
                },
                data: JSON.stringify(applicant)

            });

        } else {
            showWarningMessage("Please Select Case Before Approve!");
        }

    });


    // Cases Revert by Department to DC
    $(document).on('click', '#bulkRevertByDeptYes', function() {
        $('#bulkRevertModal').modal('hide');

        // var task_remarks = $("#task_remarks").val();
        var department_remarks_revert = $("#department_remarks_revert").val();
        // var dept_order_date = $("#dept_order_date").val();
        // var dept_order_no = $("#dept_order_no").val();
        var proposal_id_revert = $("#proposal_id_revert").val();
        var district_id_revert = $("#district_id_revert").val();

        // if (dept_order_no == '') {
        //     showErrorMessage("Please Enter Order Date !");
        // }

        // if (dept_order_date == '') {
        //     showErrorMessage("Please Enter Order Date !");
        // }
        if (department_remarks_revert == '') {
            showErrorMessage("Please Enter Some Additional Remarks !");
        }

        var selectedList = [];

        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
        });

        if (selectedList.length > 0) {


            const applicant = {
                selectedList: selectedList,
                department_remarks_revert: department_remarks_revert,
                // dept_order_date: dept_order_date,
                // dept_order_no: dept_order_no,
                proposal_id_revert: proposal_id_revert,
                district_id_revert: district_id_revert,
            };

            $.ajax({
                url: BASE_URL + "/Basundhara/bulkRevertByDepartment",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {
                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {

                        showSuccessMessage(data.message);
                        location.reload();
                    } else if (data.responseType == 3) {

                        showWarningMessage(data.message);
                    } else {

                        showErrorMessage("Revert to Dc Failed. Kindly Contact System Administrator.");
                    }
                },
                data: JSON.stringify(applicant)

            });

        } else {
            showWarningMessage("Please Select Case Before Revert!");
        }

    });




    function getChithaCopy(dist_code, subdiv_code, cir_code, mouza_pargona_code, lot_no, vill_townprt_code, dag_no, patta_code) {

    var dist_code_chitha = dist_code;
    var subdiv_code_chitha = subdiv_code;
    var cir_code_chitha = cir_code;
    var mouza_pargona_code_chitha = mouza_pargona_code;
    var lot_no_chitha = lot_no;
    var vill_townprt_code_chitha = vill_townprt_code;
    var dag_no_chitha = dag_no;
    var patta_code_chitha = patta_code;


    const applicant = {
      dist_code: dist_code_chitha,
      subdiv_code: subdiv_code_chitha,
      cir_code: cir_code_chitha,
      mouza_pargona_code: mouza_pargona_code_chitha,
      lot_no: lot_no_chitha,
      vill_townprt_code: vill_townprt_code_chitha,
      dag_no: dag_no_chitha,
      patta_code: patta_code_chitha,
    };


    console.log(applicant);
    $.ajax({
        url: BASE_URL + "index.php/Basundhara/viewChithaCopy",
      type: "post",
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        if (data.responseType == 1) {
          showErrorMessage("There is some problem, Please try again");
        } else if (data.responseType == 2) {

          $('#viewChithaCopyModal').modal({
            backdrop: 'static',
            keyboard: false
          });
          $('#viewChithaCopyModal').modal('show');

          var noticeDiv = data.notice;

          $('#chithaCopyView').html(noticeDiv);
        } else if (data.responseType == 3) {
          showErrorMessage("Data not found !");
        } else {
          showErrorMessage("SOMETHING WENT WRONG");
        }
      },
      data: JSON.stringify(applicant)
    });
};
  


// CAB Recommended 

    $(document).on('click', '#cabRecommended', function() {
        $('#cabRecommendedModal').modal('show');
    });


    $(document).on('click', '#cabRecommendedModalNo', function () {
        $('#cabRecommendedModal').modal('hide');
    });


    $(document).on('click','#cabRecommendedModalYes',function ()
    {


        const applicant = {
            caseNo: $("#caseNo").val(),
            distCode: $("#distCodeCase").val(),
            serviceCode: $("#serviceCode").val(),
        };
        console.log(applicant);
        // return;
        $.ajax({
            url: BASE_URL + "index.php/Basundhara/verifyAndRecommendedForCab",
            type: "post",
            dataType: "json",
            contentType: "application/json",
            success: function (data) {
                $('#cabRecommendedModal').modal('hide');
                if (data.responseType == 1)
                {
                    showErrorMessage("There is some problem, Please try again");
                }
                else if (data.responseType == 2)
                {
                    $('.recommBtn').hide();
                    showSuccessMessage("Application successfully Recommended For CAB Memo");
                }
                else if (data.responseType == 3)
                {
                    showErrorMessage("Data not found !");
                }
                else
                {
                    showErrorMessage("SOMETHING WENT WRONG");
                }
            },
            data: JSON.stringify(applicant)

        });


    });






