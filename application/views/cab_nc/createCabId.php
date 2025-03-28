<style>
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
    /*box-shadow: 0 2px 5px 0 rgb(0 0 0 / 23%);*/
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

  .table_div_responsive {
    overflow-x: scroll;
  }

</style>

<div class="row" style='padding: 40px 50px 40px 20px'>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="reza-card">
      <div class="reza-title">
        <span style="color:#ff681d">Create CAB ID for NC Settlement</span>
        <input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
        <hr style="margin-bottom: -5px">
      </div>

      <div class="reza-body">

        <div class="row">

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
              <label style="color: #666">CAB Memo Name</label>
              <input type="text" class="form-control" id="cab_memo_name" value="" placeholder="Enter CAB Memo Name">
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label style="color: #666">Remarks</label>
              <input type="text" class="form-control" id="cab_remarks" value="" placeholder="Enter Remarks">
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label style="color: #666">Select District(s) to create CAB ID</label>
              <small class="text-danger">You can choose multiple districts to create a ID</small>

              <?php foreach($user_assigned_dist as $row) { ?>

                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-check">
                      <input class="form-check-input selectDistricts" type="checkbox" 
                      value="<?=$row->dist_code?>" id="selectDistricts_<?=$row->dist_code?>" name="selectDistricts[]">
                      <label class="form-check-label" for="flexCheckDefault">
                        <?=$this->utilclass->getDistrictNameOnLanding($row->dist_code)?>
                      </label>
                    </div>
                  </div>
                </div>

              
              <?php } ?>

            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 15px" align="right">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="button" id="createCabId" class="rezaButt buttInfo" id="" style="width: 200px">
                    <i class="fa fa-done" aria-hidden="true"></i> Create CAB ID
                </button>
            </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table_div_responsive">
    <div class="reza-card">
      <div class="reza-title">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <span class="text-danger">List of Generated Cab ID for NC Settlement</span>
          </div>
        </div>
        <hr style="margin-bottom: -5px">
      </div>

      <div class="reza-body" id="showBody">
        <table class='table table-striped table-bordered table-responsive' id='dataTableCab' width="100%" >
          <thead>
            <tr>
              <th class="center"><label class="control-label">CAB ID</th>
              <th class="center"><label class="control-label">Memo Name</th>
              <th class="center"><label class="control-label">Remarks</th>
              <th class="center"><label class="control-label">Assigned District(s)</th>
              <th class="center"><label class="control-label">Created Date<br>(DD/MM/YYYY)</label></th>
              <th class="center"><label class="control-label">Action</label></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <!-- DataTable -->
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="editCabId" value="">
<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

<script>

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

  var BASE_URL = $("#getBaseURL").val();

  $(document).on('click', '#createCabId', function(){

    var selectedDistricts = [];
    $('.selectDistricts:checked').each(function(i){
      selectedDistricts[i] = $(this).val();
    });

    if (selectedDistricts.length > 0)
    {
      const list = {
        cab_memo_name     : $('#cab_memo_name').val(),
        cab_ref_no        : $('#cab_ref_no').val(),
        cab_remarks       : $('#cab_remarks').val(),
        selectedDistricts : selectedDistricts,
        editCabId         : $('#editCabId').val(),
      };
      $.ajax({
        url: BASE_URL + "CabController/generateCabIdNC",
        type: "post",
        dataType: "json",
        contentType: "application/json",
        success: function (data) {

          if(data.responseType == 1) {
            showErrorMessage(data.message);
          }
          else if (data.responseType == 2) {              
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
      $('.loader').addClass('hide');
      alert('Please select at least one district to generate CAB id');
    }
  });

  $(document).ready( function () {

    load_generated_cab_list();
    function load_generated_cab_list()
    {
      var table = $('#dataTableCab').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
          url: BASE_URL+'index.php/CabController/getNewlyGeneratedCabListNC',
          type:'POST',
          data: {status: 0},
          deferLoading: 57,
        },
        order: [[2, 'asc']],

        columnDefs: [{
        targets: "_all",
        orderable: false,
          "className": "dt-left", "targets":[ 0, 1, 2, 3, 4, 5],
        }]
      });
    }
  });

  function viewCaseDetail(cab_id)
  {
    const list = {
      cab_id : cab_id,
      option : 'edit',
    };

    $.ajax({
      url: BASE_URL + "CabController/createCabId",
      type: "post",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {

        if (data.responseType == 2) 
        {  
          $('#clickOption').val(1);            
          $('#editCabId').val(data.cab_id);
          $('#cab_memo_name').val(data.memo_name);
          $('#cab_ref_no').val(data.reference_no);
          $('#cab_remarks').val(data.remarks);

          $.each(data.selected_dist, function (i, val)
          {
            $.each(data.selected_dist, function (j, all){

              if(val['dist_code'] == all['dist_code']){
                $('#selectDistricts_'+val['dist_code']).prop('checked', true);
              }
            });
          });
        }
      },
      data: JSON.stringify(list)        
    });
  }

</script>