<style>

      .reza-card {
        background: #fff;
        border-radius: 2px;
        display: inline-block;
        margin: 1rem;
        position: relative;
        width: 100%;
    }

    .scroll {
        width: 200px; height: 400px;
        overflow: hidden;
    }  

    .form-control-1{
            font-size:14px;
        width:100%;

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
        background-color: #40739e;
        /* background-color: #8c7ae6; */
    }

      .badge-warning {
        color: black;
      }

      .badge-success {
        color: green
      }

        .text-blue
        {
        color:#273c75
        }
        .text-green
        {
        color:#009432
        }       
        .text-red
        {
        color:#EA2027
        }

      .wrapper {
        width: 100%;
        height: 600px;
        display: block;
        overflow: hidden;
        margin: 0 auto;
        padding: 60px 50px;
        background: #fff;
        border-radius: 4px;
      }



      .dataTables_scrollBody {
        overflow-x: hidden !important;
        overflow-y: auto !important;
      }

      .table-responsive {
        display: block;
        width: 100%;
        overflow-x: hidden !important;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
      }

      .table.dataTable.no-footer {
        border-bottom: 0px;
        border-top: 0px;
      }

      .table.dataTable.no-header {
        border-bottom: 0px;
        border-top: 0px;
      }

      #legend-container {
        display: flex;
        justify-content: center;
        padding: 0.5em;
      }

      #legend-container ul {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr);
        grid-row-gap: 0.5em;
      }

      .tab-res{
        padding-left:3rem !important
      }

      .tab-res2{
          padding-left:4rem !important

      }

      th {
        font-size: 13px;
        /*color: #303952;*/
      }


      .main-card{
        border-radius: 5px;
        display: inline-block;
        background: #fff;
        box-shadow: 0px 3px 5px #999 !important;
        padding: 8px;
        width: 100%!important;
      }

      @media only screen and (max-width: 600px) {
        span2{
        font-size: 8.5px;

        }
      }
      
      @media only screen and (max-width: 600px) {
        table.dataTable tbody th, table.dataTable tbody td {
          text-align: right !important;
          padding: 8px 10px;
          font-size: .9em;
        }

        .tab-res{
          padding-left:0rem !important;


        }
        .tab-res2{
          padding-left:1rem !important

        }
        .dist-res{
          text-align: left!important;
        }
      }
      @media only screen and (max-width: 600px) {

        .table-service {
          padding: 0rem 0rem !important;
          background-color: var(--bs-table-bg);
          border-bottom-width: 1px;
          box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }
      }
      .tmpselected{
        color: red;
      }
      .chartWrapper {
        position: relative;
        overflow-x: scroll;
      }

      .chartWrapper>canvas {
        position: absolute;
        left: 0;
        top: 0;
        pointer-events: none;
      }

      .chartAreaWrapper {
        width: 1500px;
        overflow-x: scroll;
      }

      .table thead tr:first-child {
        background: #6c5ce7;
    }
</style>
<div class="container-fluid">
  <div class="row" style='padding: 10px 40px 10px 10px'>
      <div class="col-lg-12">
          <div class="reza-card">
            <div class="reza-title">
                <span>Revenue Dashboard</span>
            </div>
            <div class="reza-body">
                    <div class="row" id="searchBox">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="serviceSelect" class="form-label">Select Service</label>
                                <select id="serviceSelect" class="form-select serviceselect reset" name='service_type' required>
                                    <option disabled selected>Select Service</option>
                                    <option value='FMUTI'>Mutation By Inheritance (Field)</option>
                                    <option value='OMUTI'>Mutation By Inheritance (Office)</option>
                                    <option value='FMUTD'>Mutation By Deed (Field)</option>
                                    <option value='OMUTD'>Mutation By Deed (Office)</option>
                                    <option value='RECLASS'>Reclassification</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
          </div>
        </div>
      </div>
    </div>




<div class="container-fluid" id="table_div">
</div>

</div>


<script>
$(document).ready(function() {

    var baseurl = "<?php echo base_url(); ?>";

    function handleSelectionChange() {
        var district = $('.districtselect').val();
        var serviceType = $('.serviceselect').val();

        if (serviceType === null) {
            alert("Please Select District and Service !!!");
            return;
        }

        $.blockUI({
            message: $('#displayBox'),
            css: {
                border:'none',
                backgroundColor:'transparent'
            }
        });

        $.ajax({
            url: baseurl + "index.php/RevenueDashboard/viewDashboardDetails",
            type: "POST",
            data: {district: district, serviceType: serviceType},
            error: function() {
                $.unblockUI();
                Swal.fire({
                    title: "Failed",
                    text: "Error",
                    icon: "warning",
                    timer: 5000
                });
            },
            success: function(data) {
                $.unblockUI();
                $("#table_div").html(data);
            }
        });
    }

    // $('.districtselect').on('change', handleSelectionChange);
    $('.serviceselect').on('change', handleSelectionChange);
});
</script>