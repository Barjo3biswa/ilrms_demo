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
</style>
  <div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="reza-card">
            <div class="reza-title">
                <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <span class="text-danger">VGR CAB Memo List to be Finalized
                          </span>
                      </div>
                </div>
                <hr style="margin-bottom: -5px">
            </div>

            <div class="reza-body" id="showBody">
                    <!-- DataTable -->
                    <input type="hidden" name="selectDistrict">
                    <table class='table table-striped table-bordered' id='dataTableToBeFinalizeVGR' width="100%">
                        <thead>
                        <tr>
                            <th class="center"><label class="control-label">Memo</th>
                            <th class="center"><label class="control-label">VGR Cab Id</th>
                            <th class="center"><label class="control-label">Assigned District(s)</th>
                            <th class="center"><label class="control-label">Created Date</label></th>
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
<div id="generateMemoViewVGR"></div>
<!-- Modal -->
<div class="modal" role="dialog" id="viewCasesByCabId" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header  bg-success">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">
          Case List for CAB ID : <span id='display_cab_id'></span>
        </h5>
      </div>
      <hr>
      <div class="modal-body">
        <div class="row">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Case No</th>
                <th>District</th>
              </tr>
            </thead>
            <tbody id="list_of_cases"></tbody>
          </table>              
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->

<div class="modal" role="dialog" id="memoModalVGR" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header  bg-success">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">
          Generate Memorendum for Cab No : <span id='display_cab_id_memo_vgr'></span>
        </h5>
      </div>
      <hr>
      <form id="generateMemoPost">
      <div class="modal-body">
              
                <div class="row"> 
                  <input type="hidden" name="cab_id_memo" id="cab_id_memo">

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label style="color: #666">Date of Cabinet Meeting</label>
                      <input type="date" class="form-control" name="cab_memo_date" id="cab_memo_date" value="" placeholder="Date of Cabinet Meeting">
                    </div>
                  </div>

                  <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label style="color: #666">Revenue Memo Reference Number</label>
                      <input type="text" class="form-control" name="rev_cab_ref_no" id="rev_cab_ref_no" value="" placeholder="Revenue Memo Reference Number">
                    </div>
                  </div> -->

                  <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label style="color: #666">Inter Departmental Consultations</label>
                      <textarea class="form-control" id="idc" name="idc" placeholder="Inter Departmental Consultations" style="height: 275px;"></textarea>
                    </div>
                  </div> -->

                  
                </div>
                
              </div> 
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">Generate Cabinet Memo</button>
            <button type="button" class="btn btn-secondary" id="closeModalMemo">Close</button>
          </div>
          </form>
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

    $('#selectDistrict').change(function(){
      var selectDistrict = null;
      $('#dataTableToBeFinalizeVGR').DataTable().destroy();
      load_data(selectDistrict);
    });
    load_data();
    function load_data(selectDistrict)
    {
      var table = $('#dataTableToBeFinalizeVGR').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
          url: base_url+'index.php/CabController/getVGRCabIdByUserDistrict',
          type:'POST',
          data: { selectDistrict:selectDistrict },
          deferLoading: 57,
        },
        order: [[2, 'asc']],

        columnDefs: [{
        targets: "_all",
        orderable: false,
          "className": "dt-center", "targets":[ 0, 1, 2, 3, 4],
        }]
      });
    }
  });

  $('#closeModal').on('click', function(){
    $('#viewCasesByCabId').hide('modal');
  });

  $('#closeModalMemo').on('click', function(){
    $('#memoModalVGR').hide('modal');
  });
  $('#closeModalMemoView').on('click', function(){
    $('#generatememoModalVGR').hide('modal');
  });

  function openModal(cab_id)
  {
    const list = {
      cab_id : cab_id,
      status : 0,
    };

    $.ajax({
      url: base_url + "CabController/getCasesByCabId",
      type: "post",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {

        if(data.responseType == 1) {
          showErrorMessage(data.message);
        }
        else if (data.responseType == 2) 
        {              
          $('#viewCasesByCabId').show('modal');
          $('#display_cab_id').html(cab_id);
          $('#list_of_cases').html(data.result);
        }
      },
      data: JSON.stringify(list)        
    });
  }




  var selectedCheckBoxArray = [];
  $('#dataTableToBeFinalizeVGR tbody').on('click', 'input[type="checkbox"]', function(e) {
    var checkBoxId = $(this).val();
    var rowIndex = $.inArray(checkBoxId, selectedCheckBoxArray); 
    if(this.checked && rowIndex === -1) {
      selectedCheckBoxArray.push(checkBoxId);
    }
    else if (!this.checked && rowIndex !== -1) {
      selectedCheckBoxArray.splice(rowIndex, 1); // Remove it from the array.
    }
  });

  $("#dataTableToBeFinalizeVGR").on('draw.dt', function() {
    for (var i = 0; i < selectedCheckBoxArray.length; i++) {
      checkboxId = selectedCheckBoxArray[i];
      const myArray = checkboxId.split("/");
      var arr = myArray[3];
      $('#' + arr).attr('checked', true);
    }
  });

  $("#checkedAll").click(function(){
    if(this.checked){
      $('.selectMark').each(function(){
        this.checked = true;
        var id = $(this).val();
        if($.inArray(id, selectedCheckBoxArray) !== -1){
          // $('.selectMark').prop('checked', false);
        }else{
          selectedCheckBoxArray.push(id);
          $('.selectMark').prop('checked', true);
        }
      })
    }else{
      $('.selectMark').each(function(){
        this.checked = false;
        var id = $(this).val();
        var rowIndex = $.inArray(id, selectedCheckBoxArray);
        if(rowIndex == -1){

        }else{
          selectedCheckBoxArray.splice(rowIndex, 1);
          $('.selectMark').prop('checked', false);
        }                
      })
    }
  });

  $('#saveAndProcess').click(function(){

    var selectedList = [];
    $('.selectMark:checked').each(function(i){
      selectedList[i] = $(this).val();
    });

    if (selectedList.length > 0)
    {
      const list = {
        selectedList: selectedList,
      };

      $.ajax({
        url: BASE_URL + "/CabController/toBeFinalizeSave",
        type: "post",
        dataType: "json",
        contentType: "application/json",
        success: function (data) {
          if(data.responseType == 1){
            showErrorMessage(data.message);
          }
          else if(data.responseType == 2){
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
          }
        },
        data: JSON.stringify(list)
      });
    }
    else {
      showErrorMessage("Select at least one CAB ID");
    }

  });

  function openModalMemoVGR(cab_id){
    $('#display_cab_id_memo_vgr').html(cab_id);
    $('#cab_id_memo').val(cab_id);
    $('#memoModalVGR').show('modal');
  }



</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#generateMemoPost').on('submit', function(event){
    event.preventDefault();

    var cab_memo_date = $("#cab_memo_date");
    if (cab_memo_date.val() == "") {
        alert("Please select Date of cabinet meeting");
        return false;
    }
    var rev_cab_ref_no = $("#rev_cab_ref_no");
    if (rev_cab_ref_no.val() == "") {
        alert("Please enter Revenue Memo Reference Number");
        return false;
    }
    var formData = $(this).serialize();
        $.ajax({
            type        : 'POST', 
            url         : base_url +'CabController/GenerateCabMemoVGR', 
            data        : formData, 
            // dataType    : 'json', 
            encode      : true,
            success: function(data){
              console.log(data);
              $('#memoModalVGR').hide('modal');
              $("#generateMemoViewVGR").html(data);
              $('#generatememoModalVGR').show('modal');
            },
        });
    });


  // final submit & generate PDF
    $(document).on("click",'#generatePDFMemo',function(){
        // alert("hg");
        if(!confirm("Are you sure to proceed"))
        {
            return true;
        }
        else
        {

            var meeting_id = $("#cabmeetingId").val();
            var html1 = $("#html1").html();
            var html2 = $("#html2").html();
            var html3 = $("#html3").html();
            var html4 = $("#html4").html();
            var html11 = $("#html11").html();
            var html21 = $("#html21").html();
            var html31 = $("#html31").html();
            var html41 = $("#html41").html();

            $.ajax({
                url: base_url + "CabController/SavePDFMemo",
                type: "post",
                dataType: "json",
                data: {
                    meeting_id: meeting_id,
                    html1: html1,
                    html2: html2,
                    html3: html3,
                    html4: html4,
                    html11: html11,
                    html21: html21,
                    html31: html31,
                    html41: html41,

                },
                // contentType: "application/json",
                success: function (data) {
                    // $.unblockUI();
                    if (data.responseType == 3)
                    {
                        showErrorMessage(data.message);
                    }
                    else if(data.responseType == 2)
                    {
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
                    }
                    else
                    {
                        showErrorMessage("SOMETHING WENT WRONG");
                    }
                },
                

            });
        }

    });
});
    

</script>
