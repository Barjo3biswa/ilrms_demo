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
    /* background-color: #03a9f4; */
        background: linear-gradient(to right, #0575E6, #40739e);

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



  .checkboxes {
      max-width: 700px;
      margin: 0 auto;
      padding: 25px;

      display: flex;
      flex-direction: column;
    }
    .checkboxes__row {
      display: flex;
    }
    .checkboxes__row:not(:last-child) {
      border-bottom: 1px solid #eee;
    }
    .checkboxes__item {
      padding: 15px;
      width: 50%;
    }

    .checkbox.style-common {
      display: inline-block;
      position: relative;
      padding-left: 30px;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    .checkbox.style-common input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }
    .checkbox.style-common input:checked ~ .checkbox__checkmark {
      background-color: #0575E6;
    }
    .checkbox.style-common input:checked ~ .checkbox__checkmark:after {
      opacity: 1;
    }
    .checkbox.style-common:hover input ~ .checkbox__checkmark {
      background-color: #eee;
    }
    .checkbox.style-common:hover input:checked ~ .checkbox__checkmark {
      background-color: #0575E6;
    }
    .checkbox.style-common:hover input ~ .checkbox__body {
      color: #0575E6;
    }
    .checkbox.style-common .checkbox__checkmark {
      position: absolute;
      top: 1px;
      left: 0;
      height: 22px;
      width: 22px;
      background-color: #eee;
      transition: background-color 0.25s ease;
      border-radius: 11px;
    }
    .checkbox.style-common .checkbox__checkmark:after {
      content: "";
      position: absolute;
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid #333;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
      opacity: 0;
      transition: opacity 0.25s ease;
    }
    .checkbox.style-common .checkbox__body {
      color: #333;
      line-height: 1.4;
      font-size: 14px;
      transition: color 0.25s ease;
    }
    .checkbox.style-common input:checked ~ .checkbox__body {
  color: #0575E6;
    }

  .checkbox.style-common .checkbox__body {
    color: #333;
    line-height: 1.4;
    font-size: 14px;
    transition: color 0.25s ease;
    display: inline-block;
    width: 120px; /* Set a fixed width for the label */
    height: 22px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .table thead tr:first-child {
    background: #40739e;
}

</style>

<div class="row" style='padding: 40px 50px 20px 20px'>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2">
    <div class="reza-card">
      <div class="reza-title">
        <div class="row">
          <div class="col-lg-12">
              <span>Manage Cabinet</span>
          </div>
        </div>
      </div>
    </div>

    <div class="reza-card">
      <div class="reza-title">
        <div class="row">
          <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 mb-2">
            <div class="form-group">
              <label style="color: #666">CAB Memo Name</label>
              <input type="text" class="form-control" id="cab_memo_name" value="" placeholder="Enter CAB Memo Name">
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label style="color: #666">Remarks</label>
              <textarea  class="form-control" id="cab_remarks" rows="3" placeholder="Enter Remarks"></textarea>
            </div>
          </div>


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label style="color: #666">Select District(s)</label></br>
                <hr>
                  <?php foreach ($user_assigned_dist as $row): ?>
                        <label class="checkbox style-common">
                          <input class="form-check-input selectDistricts"  type="checkbox" name="selectDistricts[]" value="<?=$row->dist_code?>" id="selectDistricts_<?=$row->dist_code?>"  />
                          <div class="checkbox__checkmark"></div>
                          <div class="checkbox__body"><?=$this->utilclass->getDistrictNameOnLanding($row->dist_code)?></div>
                        </label>&nbsp;
                  <?php endforeach; ?>
                <hr>

              </div>
            </div>
          <div class="row" style="margin-top: 15px" align="right">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="button" id="createCabId" class="rezaButt buttInfo" id="" style="width: 260px">
                    <i class="fa fa-plus" aria-hidden="true"></i> Create Cabinet Memo
                </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>




    <div class="reza-card">
      <div class="reza-title">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <span class="text-danger">Cabinet List</span>
          </div>
        </div>
      </div>

      <div class="reza-body" id="showBody">
        <table class="datatable table table-stripped" id='dataTableConversionCabList'>
          <thead>
            <tr>
              <th class="center"><label class="control-label">Cab Memo</th>
              <th class="center"><label class="control-label">Cab ID</th>
              <th class="center"><label class="control-label">Assigned District(s)</th>
              <th class="center"><label class="control-label">Created Date</label></th>
              <th class="center"><label class="control-label">Action</label></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
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

    var baseurl = "<?php echo base_url(); ?>";


  $(document).on('click', '#createCabId', function(){

    var selectedDistricts = [];
    $('.selectDistricts:checked').each(function(i){
      selectedDistricts[i] = $(this).val();
    });

    if (selectedDistricts.length > 0)
    {
      const list = {
        cab_memo_name     : $('#cab_memo_name').val(),
        cab_remarks       : $('#cab_remarks').val(),
        selectedDistricts : selectedDistricts,
        editCabId         : $('#editCabId').val(),
      };
      $.ajax({
        url: baseurl + "DeptConversion/generateConversionCabinet",
        type: "post",
        dataType: "json",
        contentType: "application/json",
        success: function (data) {

          if(data.responseType == 1) {
            showWarningMessage(data.message);
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
      showWarningMessage('Please select District to generate Cab Memo');

    }
  });

  $(document).ready( function () {

    load_generated_cab_list();
    function load_generated_cab_list()
    {
      var table = $('#dataTableConversionCabList').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
          url: baseurl + "DeptConversion/getAllConversionCabinetList",
          type:'POST',
          data: {status: 0},
          deferLoading: 57,
        },
        // order: [[2, 'asc']],

        // columnDefs: [{
        // targets: "_all",
        // orderable: false,
        //   "className": "dt-left", "targets":[ 0, 1, 2, 3, 4, 5],
        // }]
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
      url: baseurl + "CabController/createCabId",
      type: "post",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {

        if (data.responseType == 2) 
        {  
          $('#clickOption').val(1);            
          $('#editCabId').val(data.cab_id);
          $('#cab_memo_name').val(data.memo_name);
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


  //Delete VGR Cab 
  function deleteCabMemoConversion(cab_id_delete)
  {
    const cablist = {
      cab_id_delete : cab_id_delete
    };
    Swal.fire({
        title: 'Are you Confirm?',
        text: 'Do You want to Delete This Cab Memo?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete!',
        cancelButtonText: 'No, cancel',
    }).then((result) => {
        if (result.value) {
            $.ajax({
            url: baseurl + "DeptConversion/deleteConversionCabinet",
            type: "post",
            dataType: "json",
            contentType: "application/json",
            success: function (data) {
              if(data.responseType == 1) {
                showErrorMessage(data.message);
              }
              else if (data.responseType == 2) 
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
            },
            data: JSON.stringify(cablist)        
          });
        }
    });
  }

</script>