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
                          Approved Cabinet List
                      </div>
                </div>
                <hr style="margin-bottom: -5px">
            </div>

            <div class="reza-body" id="showBody">
                    <!-- DataTable -->
                    <input type="hidden" name="selectDistrict">
                    <table class='table' id='dataTableApprovedConversionCabinet' width="100%">
                        <thead>
                        <tr>
                            <th class="center"><label class="control-label">Memo</th>
                            <th class="center"><label class="control-label">Cab Id</th>
                            <th class="center"><label class="control-label">Assigned District(s)</th>
                            <th class="center"><label class="control-label">Date</label></th>
                            <th class="center"><label class="control-label">Status</label></th>
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
      $('#dataTableApprovedConversionCabinet').DataTable().destroy();
      load_data(selectDistrict);
    });
    load_data();
    function load_data(selectDistrict)
    {
      var table = $('#dataTableApprovedConversionCabinet').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
          url: base_url+'index.php/DeptConversion/getApprovedConversionCabinet',
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




</script>

 