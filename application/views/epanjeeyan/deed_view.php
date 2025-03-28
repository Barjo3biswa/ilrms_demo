<!-- <script>
$(document).ready(function() {
  $('#datatableCaseList').DataTable({
    // ... other options
    search: true,
    dom: 'lf<"dt-search"<"search_container"f>>rtp'
  });
});
</script> -->
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/department.js'); ?>"></script>

<style>
    :root {
        --loader-size: 50px;
        --dot-size: 6px;
        --loader-bg: #e1e6e2;
        --dot-color: black;
    }

    .loader {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(1, 18, 64, 0.2);
        transition: opacity 0.3s ease-out, top 0.3s step-end;
        z-index: 99;
    }

    .loader.trans {
        transition: opacity 0.5s ease-out, top 0.5s step-start;
        opacity: 1;
        top: 0;
    }

    .loader .loaderview {
        position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: auto;
        height: auto;
        padding: 10px 40px;
        border-radius: 5px;
        top: 0;
        left: 0;
        z-index: 100;
        flex-flow: column;
        background-color: var(--loader-bg);
    }

    h1 {
        color: var(--dot-color);
        font-size: 1.2em;
        animation: fading 1.5s ease-in-out infinite;
        font-family: "Comfortaa", cursive;
    }

    .Loader-box {
        margin: 20px;
        flex: 0 0 auto;
        height: var(--loader-size);
        width: var(--loader-size);
    }

    .box {
        position: absolute;
        height: var(--loader-size);
        width: var(--loader-size);
        animation: rotating 4s ease-in infinite;
        animation-delay: calc(var(--id) * 0.5s);
    }

    .dot {
        background-color: var(--dot-color);
        height: var(--dot-size);
        width: var(--dot-size);
        border-radius: 100%;
    }

    @keyframes rotating {
        0% {
            opacity: 0;
            transform: rotateZ(0);
        }
        25% {
            opacity: 100%;
            transform: rotateZ(160deg);
        }

        75% {
            opacity: 200%;
            opacity: 100;
        }
        80% {
            transform: rotateZ(300deg);
            opacity: 100;
        }
        100% {
            transform: rotateZ(350deg);
            opacity: 0;
        }
    }

    @keyframes fading {
        0% {
            opacity: 40%;
        }
        50% {
            opacity: 90%;
        }
        100% {
            opacity: 40%;
        }
    }
</style>


<div class="hide loader" id="loader" style="display:none">
    <div class="loaderview">
        <h1>Don't refresh the page until the process is completed...</h1>
        <div class="Loader-box">
            <div class="box" style="--id:1">
                <div class="dot"></div>
            </div>
            <div class="box" style="--id:2">
                <div class="dot"></div>
            </div>
            <div class="box" style="--id:3">
                <div class="dot"></div>
            </div>
            <div class="box" style="--id:4">
                <div class="dot"></div>
            </div>
            <div class="box" style="--id:5">
                <div class="dot"></div>
            </div>
        </div>
    </div>
</div>


<div class='container ' style="margin-top:10px">
    <div class='col-lg-12'>
        <?php // echo form_open('Welcome/getRecord', array("class" => "form-horizontal")); ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 offset-2">
                    <div class="bg-white shadow-lg rounded p-2 card-info">
                        <div class="card-header text-white text-bold bg-primary">
                            <h5>DAG DETAILS</h5>
                        </div>
                        <div class="card-body">
                            <div class="row pt-2">
                                <div class="col-sm-4">
                                    <label class="mb-0 mt-1 font-weight-normal">
                                        <span class="text-danger">*</span> Select District :</label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control" name='district_code' id='district_code' onchange="get_office_list();" required >
                                        <option value="">Select District</option>
                                        <?php  
                                            foreach ($applications as $key => $value) {
                                        ?>                      
                                        <option value= '<?php echo $value['district_code']; ?>'><?php echo $value['district_value']; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <span class="text-danger"><?php echo form_error('district_code'); ?></span>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-4">
                                    <label class="mb-0 mt-1 font-weight-normal">
                                        <span class="text-danger">*</span> Select Office :</label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control" name='dbname' id='dbname' required onchange="get_village_list();"> 
                                        <option value="">Select Office</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-4">
                                    <label class="mb-0 mt-1 font-weight-normal">
                                        <span class="text-danger">*</span> Select Village :</label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control" name='villcode' id='villcode' required > 
                                        <option value="">Select Village</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-4">
                                    <label class="mb-0 mt-1 font-weight-normal">
                                        <span class="text-danger">*</span> Enter Dag No :</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" name="dagno" id="dagno" class="form-control" placeholder="Enter Dag No" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" id="dag_history_form_submit" class="btn btn-success" onclick="getDagHistory();">Check Records</button>
                        </div>
                        <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Party Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Party Details</h4>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                    <table class="table table-bordered   table-striped" id='datatableCaseList2'>
                        <thead class="table__head">
                            <tr class="winner__table">
                                <th>Party Name</th>
                                <th>Gender</th>
                                <th>Party Type</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody id="partyDetailsBody">
                        </tbody>
                        </table>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>          
        </div>
    </div>
    <!-- Deed View Modal -->
    <div class="modal fade" id="deedModal" role="dialog">
        <div class="modal-dialog">        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">View Deed</h4>
            </div>
            <div class="modal-body">
              <p id="viewDeed"></p>
            </div>            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>          
        </div>
    </div>
    <div class="row" style='padding: 10px 40px 10px 10px'>
        <div class="col-lg-12">
            <div class="reza-card">
                <div class="reza-body">
                    <div class="table-responsive">
                        <table class="table table-bordered   table-striped" id='datatableCaseList'>
                            <thead class="table__head">
                                <tr class="winner__table">
                                    <th>Deed No</th>
                                    <th>Approval Date</th>
                                    <th>Applicant Name</th>
                                    <th>Dag</th>
                                    <th>Circle</th>
                                    <th>Mouza</th>
                                    <th>Village</th>
                                    <th>Comcase</th>
                                    <th>Party</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function get_office_list() {
        const district_code = $('#district_code').val()
        console.log('DISTRICT '+district_code);
        $.ajax({
            url: 'get_office_list',
            data: {
                district_code: district_code
            },
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                // console.log(result);
                if (result) {
                    let dbname = "<option value=''>Select Office</option>";
                    result.forEach(a => {
                        dbname = dbname + "<option value='" + a.dbname +"'>" + a.officename + "</option>";
                    });

                    $('#dbname').html(dbname);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.msg
                    })
                }

            }, error: function (jqXHR, exception) {
            }
        });
    }
    function get_village_list() {
        const dbname = $('#dbname').val()
        // console.log('DB '+dbname);
        $.ajax({
            url: 'get_village_list',
            data: {
                dbname: dbname
            },
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                console.log(result);
                if (result) {
                    let villcode = "<option value=''>Select Village</option>";
                    result.forEach(a => {
                        villcode = villcode + "<option value='" + a.vlcode +"'>" + a.vlname + "</option>";
                    });

                    $('#villcode').html(villcode);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.msg
                    })
                }
            }, error: function (jqXHR, exception) {
            }
        });
    }

    // function getDagHistory() {
    //     const district_code = $('#district_code').val()
    //     const dbname = $('#dbname').val()
    //     const villcode = $('#villcode').val()
    //     const dagno = $('#dagno').val()
    //     // alert(district_code+"-"+dbname+"-"+villcode+"-"+dagno)
    //     $.ajax({
    //         url: 'get_all_dag_details_list',
    //         data: {
    //             district_code: district_code,
    //             dbname: dbname,
    //             villcode: villcode,
    //             dagno: dagno
    //         },
    //         type: 'POST',
    //         dataType: 'json',
    //         success: function (result) {
    //             // console.log(result);
    //             if (result) {
    //                 tableData = "";
    //                 result.forEach(a => {
    //                     tableData = tableData + "<tr><td>" + setCharAt(a.fcaseno,7,'*******') +"</td><td>" + a.dtcomple + "</td><td>" + setCharAt(a.nmapplicant, 0, '****') + "</td><td>" + a.dagno + "</td><td>" +  a.circle + "</td><td>" + a.mouza + "</td><td>" + a.village + "</td><td>" + setCharAt(a.comcaseno, 1, '***') + "</td><td><button type='button' class='btn btn-primary btn-sm'  id='"+a.comcaseno+"' onclick='getPartyHistory(this.id);'>Party</button></td><td><button type='button' class='btn btn-primary btn-sm'  id='"+a.comcaseno+"' onclick='getDeedView(this.id);'>View</button></td></tr>";
    //                 });
    //                 $('#tableData').html(tableData);
    //             } else {
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error',
    //                     text: result.msg
    //                 })
    //             }
    //         }, error: function (jqXHR, exception) {
    //         }
    //     });
    // }
    


    function getPartyHistory(comcaseno){
        const district_code = $('#district_code').val()
        const dbname = $('#dbname').val()
        const villcode = $('#villcode').val()
        $.ajax({
            url: 'get_all_party_details_list',
            data: {
                dbname: dbname,
                comcaseno: comcaseno
            },
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                // console.log(result);
                if (result) {
                    $("#myModal").modal();
                    partyDetailsBody = "";
                    result.forEach(a => {
                        partyDetailsBody = partyDetailsBody + "<tr><td>" + a.nameparty +"</td><td>" + a.sex +"</td><td>" + a.partytype + "</td><td>" + a.address + "</td></tr>";                        
                    });
                    $('#partyDetailsBody').html(partyDetailsBody);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.msg
                    })
                }
            }, error: function (jqXHR, exception) {
            }
        });
    }
    function maskAfterFirstFour(str) {
        if (str.length <= 4) {
            return str;
        }
        let visiblePart = str.slice(0, 4);
        let maskedPart = '*'.repeat(str.length - 4);
        return visiblePart + maskedPart;
    }

    function getDeedView(comcaseno){
        const district_code = $('#district_code').val()
        const dbname = $('#dbname').val()
        const villcode = $('#villcode').val()
        $.ajax({
            url: 'get_deed_view',
            data: {
                dbname: dbname,
                comcaseno: comcaseno
            },
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                // console.log(result);
                if (result) {  
                    var base64 = (result);
                    const blob = base64ToBlob( base64, 'application/pdf' );
                    const url = URL.createObjectURL( blob );
                    const pdfWindow = window.open("");
                    pdfWindow.document.write("<iframe width='100%' height='100%' src='" + url + "'></iframe>");

                    function base64ToBlob( base64, type = "application/octet-stream" ) {
                        const binStr = atob( base64 );
                        const len = binStr.length;
                        const arr = new Uint8Array(len);
                        for (let i = 0; i < len; i++) {
                            arr[ i ] = binStr.charCodeAt( i );
                        }
                        return new Blob( [ arr ], { type: type } );
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.msg
                    })
                }
            }, error: function (jqXHR, exception) {
            }
        });
    }
    function setCharAt(str,index,chr) {
        res = str.substring(0,index) + chr + str.substring(index+1);
        // console.log("ReS "+res);
        return res;
    }

    var dataTableInitialized = false;
  
    function getDagHistory() {
        const district_code = $('#district_code').val();
        const dbname = $('#dbname').val();
        const villcode = $('#villcode').val();
        const dagno = $('#dagno').val();

        $.ajax({
            url: 'get_all_dag_details_list',
            data: {
                district_code: district_code,
                dbname: dbname,
                villcode: villcode,
                dagno: dagno
            },
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                if (result) {
                    tableData = "";
                    result.forEach(a => {
                        tableData += `<tr>
                            <td>${a.fcaseno}</td>
                         
                            <td>${a.dtcomple}</td>
                            <td>${a.nmapplicant}</td>
                            <td>${a.dagno}</td>
                            <td>${a.circle}</td>
                            <td>${a.mouza}</td>
                            <td>${a.village}</td>
                            <td>${a.comcaseno}</td>
                            <td><button type='button' class='btn btn-primary btn-sm' id='${a.comcaseno}' onclick='getPartyHistory(this.id);'>Party</button></td>
                            <td><button type='button' class='btn btn-primary btn-sm' id='${a.comcaseno}' onclick='getDeedView(this.id);'>View</button></td>
                        </tr>`;
                    });
                    $('#tableData').html(tableData);

                    if (!$.fn.DataTable.isDataTable('#datatableCaseList')) {
                        $('#datatableCaseList').DataTable({
                            // "paging": true,
                            "searching": true
                        });
                    } else {
                        $('#datatableCaseList').DataTable().clear().rows.add($(tableData)).draw();
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.msg
                    });
                }
            },
            error: function (jqXHR, exception) {
                // Handle errors here
            }
        });
    }

    // function maskData(str) {
    //     if (str.length <= 5) {
    //         return str; // Return the string as is if it's too short to mask
    //     }
    //     let maskedPortion = '*'.repeat(str.length - 5);
    //     return str.charAt(0) + maskedPortion + str.slice(-4);
    // }

    function customMaskData(str) {
    let parts = str.split('/');
    if (parts.length === 3) {
        let fixedStart = parts[0];
        let toBeMasked = parts[1].replace(/./g, '*'); // replace all characters with '*'
        let fixedEnd = parts[2];
        return `${fixedStart}/${toBeMasked}/${fixedEnd}`;
    }
    return str; // Return the string as is if it's not in the expected format
}
</script>



      