<style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
        size: landscape; /* for page layout */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>application/css/sweetalert2.min.css">
<script src="<?php echo base_url(); ?>application/views/js/sweetalert2/sweetalert2.all.min.js"></script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">    
    <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaAstController/index'?>">E-Khajana</a></li>
    <li class="breadcrumb-item font-weight-bold active" aria-current="page">Mouzadar Commission</li>
  </ol>
</nav>
<div class="container-fluid form-top login">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="col-lg-12 col-lg-offset-1">
                <div class="panel panel-info mt-3">
                    <div style="border:2px solid grey;" class="shadow-lg bg-white">   
                        <div class="panel-heading bg-dark text-center">
                            <h5 class="panel-title text-warning p-2">
                                Commission For Mouza : <?=$mouza_name?>
                            </h5>
                        </div>
                        <div class="panel-heading bg-primary text-center" style="margin-top:-10px;">
                            <h5 class="panel-title text-white p-1">
                                District: <?=$district_name?>,
                                Sub-division: <?=$subdiv_name?>, 
                                Circle: <?=$circle_name?>
                            </h5>
                        </div>
                        <div class="card-body shadow-lg bg-white rounded">                              
                            <div class = "card-body">           
                               <div class="table-responsive"> 
                                <table id="mouzdar_view_doul_table" class="table table-hover" style="width:100%;">            
                                    <thead class="thead-dark">                            
                                        <tr style="background-color: #515151; color: #fff;font-size:18px;">
                                            <td>Total Patta From Doul</td>
                                            <td>Total Paid Patta</td>
                                            <td>Total Demand From Doul</td>
                                            <td>Total Amount Received<br>(Including-Arrear)</td>
                                            <td>Total Commision</td>
                                        </tr>                                                        
                                    </thead>
                                    <tbody>
                                        <td>
                                            <span class="font-weight-bolder text-danger">
                                                <?=$commission_details['current_doul_details']->total_dag_doul?>
                                            </span>                                            
                                        </td>
                                        <td>
                                            <span class="font-weight-bolder text-danger">
                                                <?=$commission_details['jama_wasil_details']->total_patta?>
                                            </span>                                            
                                        </td>
                                        <td>
                                            <span class="font-weight-bolder text-danger">
                                                <?=(float)$commission_details['current_doul_details']->dag_revenue+(float)$commission_details['current_doul_details']->dag_local_tax?> Rs
                                                <span class="font-weight-bolder text-primary">
                                                    <br>(Total-Revenue : <?=(float)$commission_details['current_doul_details']->dag_revenue?> Rs)
                                                    <br>(Total-Tax : <?=(float)$commission_details['current_doul_details']->dag_local_tax?> Rs)
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            <!-- <?=var_dump($commission_details['jama_wasil_details'])?> -->
                                            <span class="font-weight-bolder text-danger">
                                                <?=$commission_details['jama_wasil_details']->total_amount?> Rs
                                            </span>
                                        </td>
                                        <td>
                                            <span class="font-weight-bolder text-danger">
                                                <?= round((float)$commission_details['jama_wasil_details']->total_amount * 30/100,2)?> Rs <br>
                                                <span class="font-weight-bolder text-primary">
                                                    (Slab-1)
                                                </span>
                                            </span>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                          </div>        
                        </div>    
                    </div>
                    <div style="border:2px solid grey;" class="mt-3 shadow-lg bg-white mb-3">
                        <div class="tab-content">
                            <div class="card-body">
                                <div class="card-body shadow-lg p-1 mb-5 bg-white rounded">                              
                                    <div class = "card-body">    
                                       <div class="table-responsive">
                                        
                                        <table id="datatable" class="datatable table table-stripped" style="font-size: 13px;">  
                                            <thead>  
                                                <tr>
                                                    <th>RTPS APPLICATION NO</th>
                                                    <th>LD APPLICATION-NO</th>
                                                    <th>
                                                        VILLAGE NAME
                                                        <select class="form-control" name="vill_category" id="vill_category">
                                                        <option value="">select</option>
                                                        <?php if(isset($get_villages)){ foreach($get_villages as $select){?>
                                                        <option value="<?=$select->vill_townprt_code?>">
                                                            <?=$this->utilclass->getVillageName($select->dist_code, $select->subdiv_code, $select->cir_code, $select->mouza_pargona_code, $select->lot_no, $select->vill_townprt_code)?>
                                                        </option>
                                                        <?php }}?>
                                                    </select>
                                                    </th>
                                                    <th>PATTA NO</th>
                                                    <th>Year</th>
                                                    <th>AMOUNT PAID</th>
                                                    <th>COMMISSION(30%)</th>
                                                
                                                </tr>    
                                            </thead>  
                                            <tbody>

                                            </tbody>
                                        </table> 

				      </div>



                                        <!-- <table id="ek_ast_pending_list_1" class="table table-hover text-center" style="width:100%">            
                                            <thead class="thead-dark">                            
                                                <tr style="background-color: black; color: #fff;">
                                                    <td>RTPS-APPLICATION-NO</td>
                                                    <td>LAND-DETAILS-APPLICATION-NO</td>
                                                    <td>VILLAGE-NAME</td>
                                                    <td>PATTA-NO</td>
                                                    <td>AMOUNT-PAID</td>
                                                    <td>30% COMMISSION</td>
                                                
                                                </tr>                                                        
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(($ekhajana_commission_details != false)):
                                                    foreach ($ekhajana_commission_details as $row):?> 
                                                        <tr>
                                                            <td>
                                                                <span class="font-weight-bolder text-danger">
                                                                    <?=$row->application_no?>
                                                                
                                                            </td>
                                                            <td>
                                                                <span class="font-weight-bolder text-success">
                                                                    <?=$row->ld_application_no?>
                                                                
                                                                <span>
                                                            </td>
                                                            <td>
                                                                <span class="font-weight-bold text-primary">
                                                                    <?=$this->utilclass->getVillageName($row->dist_code,
                                                                    $row->subdiv_code, 
                                                                    $row->cir_code, $row->mouza_pargona_code, 
                                                                    $row->lot_no, $row->vill_townprt_code)?>
                                                                    
                                                                <span>
                                                                
                                                            </td>
                                                            <td>
                                                                <span class="font-weight-bolder text-danger">
                                                                <?=$row->patta_no?>
                                                                <span>
                                                            </td>
                                                            <td>
                                                                <span class="font-weight-bold text-success">
                                                                <?=$row->total_khajana?>
                                                                <span>
                                                            </td>
                                                            <td>
                                                                <span class="font-weight-bold text-success">
                                                                    <?=round(($row->total_khajana* 30/100),2)?>
                                                                <span>
                                                            </td>
                                                            
                                                        </tr>
                                                    <?php 
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tbody>
                                        </table> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="border:2px solid grey;" class="mt-3 shadow-lg bg-white mb-3">   
                        <div class="panel-heading bg-success text-center">
                            <h5 class="panel-title text-white p-1">
                                Commision Slabs
                            </h5>
                        </div>
                        <div class = "card-body shadow-lg bg-white rounded">    
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class = "card-body col-lg-10">         
                                    <table id="mouzdar_view_doul_table" class="table table-hover" style="width:100%;">            
                                        <thead class="thead-dark">                            
                                            <tr style="background-color: #9f9f9f; color: #fff;font-size:18px;">
                                                <td>Sl-No</td>
                                                <td>Revenue-Collection</td>
                                                <td>Commision-Payable</td>
                                            </tr>      
                                            <tr>
                                                <td>1</td>
                                                <td>Minimum floor rate (upto 49%)</td>
                                                <td>30% upon total collection</td>
                                            </tr>     
                                            <tr>
                                                <td>2</td>
                                                <td>If the collection is 50% or more but less than 75% against demand</td>
                                                <td>32% upon total collection</td>
                                            </tr>     
                                            <tr>
                                                <td>3</td>
                                                <td>If the collection is 75% or more but less than 90% against demand</td>
                                                <td>33% upon total collection</td>
                                            </tr>     
                                            <tr>
                                                <td>4</td>
                                                <td>If the collection is 90% or more but less than 100% against demand</td>
                                                <td>34% upon total collection</td>
                                            </tr>     
                                            <tr>
                                                <td>5</td>
                                                <td>100% collection against demand</td>
                                                <td>35% upon total collection</td>
                                            </tr>                                                                                        
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-lg-1"></div>
                            </div>                            
                        </div>     
                    </div>         


                    <div style="border:2px solid grey;" class="mt-3 shadow-lg bg-white mb-3">
                        <div class="tab-content">
                            <div class="card-body">
                                <div class="card-body shadow-lg p-1 mb-5 bg-white rounded">                              
                                    <div class = "card-body">  
                                        <h5 class="text-center">
                                            Leftout commision arrears 
                                            <button onclick="getArrears('<?=$dist_code?>','<?=$subdiv_code?>','<?=$cir_code?>','<?=$mouza_pargona_code?>');" type="button" class="btn btn-sm btn-warning">View Details</button>
                                        </h5>  
                                        <hr>
                                        
                                        <div id="arrear_id" class="px-5 justify-content-center">
                               
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="panel panel-form p-1 mb-3">
                        <div class="col-lg-12 mt-1 text-center">
                            <a href="<?php echo base_url().'dashboard'?>" class="btn btn-danger btn-sm text-white" role="button" style="padding: 7px !important;font-size: 14px;font-weight: bold;">
                                <i class="glyphicon glyphicon-remove-sign"></i>
                                BACK TO HOME PAGE
                            </a>
                        </div>                
                    </div>           
                </div>  
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>



<style>
    /* .dataTables_filter, .dataTables_info { display: none; } */
    .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: right;
        visibility: hidden;
        }
 </style>

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
</script>

<script>
    $(document).ready(function ()
    {
        $(document).on('change', '#vill_category', function(){
            var category = $(this).val();
            $('#datatable').DataTable().destroy();
            if(category != '')
            {
                load_data(category);
            }
            else
            {
                load_data();
            }
        });

        load_data();

        function load_data(vill_townprt_code)
        {

            var base_url = "<?php echo base_url();?>";

            $('#datatable thead th:nth-of-type(1)').each(function () {
                var title = $(this).text();
                $(this).html(title+' <input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
            });

            $('#datatable thead th:nth-of-type(2)').each(function () {
                var title = $(this).text();
                $(this).html(title+' <input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
            });

            $('#datatable thead th:nth-of-type(4)').each(function () {
                var title = $(this).text();
                $(this).html(title+' <input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
            });

            $('#datatable thead th:nth-of-type(5)').each(function () {
                var title = $(this).text();
                $(this).html(title+' <input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
            });
            
            var table = $('#datatable').DataTable({
                // "scrollX": true,
                'pageLength':10,
                "processing": true,
                "serverSide": true,
                "ordering": false,
                // "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
                // 'language': {
                //             "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                //         },
                'ajax':{
                    url: base_url+'/EkhajanaCommissionController/mzdrCommissionTable',
                    type:'POST',
                    data: {
                        vill_townprt_code:vill_townprt_code,
                    },
                    deferLoading: 57,
                },


                // order: [[2, 'asc']],
                columnDefs: [{
                    targets: "_all",
                    orderable: false,
                    "className": "dt-center", "targets":[ 0, 1, 2, 3, 4, 5, 6],
                    }]
                    
            });

            table.columns().every(function () {
                var table = this;
                $('input', this.header()).on('keyup change', function () {
                    if (table.search() !== this.value) {
                            table.search(this.value).draw();
                    }
                });
            });
        }
        
    });

</script>

<script>
    function getArrears(dist_code, subdiv_code, cir_code, mouza_pargona_code)
    {
        var postData = {
            'dist_code' : dist_code,
            'subdiv_code' : subdiv_code,
            'cir_code' : cir_code,
            'mouza_pargona_code' : mouza_pargona_code,
        };

        $.blockUI({
            message: $('#displayBox'),
            css: {
                border:'none',
                backgroundColor:'transparent'
            }
        });
        
        $.ajax({
            url: baseurl+'/EkhajanaCommissionController/targetWiseArrCalc',
            type: "POST",
            data: postData,
            success: function(data) {
                arr = JSON.parse(data);
                $.unblockUI();

                if(arr.responseType == 0)
                {
                    alert(arr.msg);
                    return false;
                }

                var rows = [];

                for(i=0; i<arr.content.length; i++)
                {
                    var is_claimed = "<button onclick=\"fileReturn('"+arr.content[i].year+"','"+arr.content[i].total_doul_demand+"','"+arr.content[i].total_doul_demand_collection+"','"+arr.content[i].collection_percentage+"','"+arr.content[i].eligible_commision_percentage+"','"+arr.content[i].paid_commission_at_30+"','"+arr.content[i].claimable_amount+"','"+arr.content[i].claimable_decimal_amount+"','"+arr.content[i].total_claimable_amount+"')\" class='mt-4 mb-2 col-12 btn btn-sm btn-primary'>File return</button>"

                    if(arr.content[i].is_already_claimed == 1)
                    {
                        is_claimed = "<button class='mt-4 mb-2 col-12 btn btn-sm btn-primary' disabled>Already Filed</button>";
                    }

                     rows = "<div class='row justify-content-center'>"+
                                "<div class='col-md-6 border'>"+
                                    "<h5 class='mt-3 text-center'> YEAR - "+ arr.content[i].year +" ("+ arr.content[i].slab +")</h5><hr>"+
                                    "<div class='row px-2 py-1'>"+
                                        "<div class='col-9'>Total Doul Demand: </div>"+
                                        "<div class='col-3'>"+ arr.content[i].total_doul_demand +"</div>"+
                                    "</div>"+
                                    "<div class='row px-2 py-1'>"+
                                        "<div class='col-9'>Total received: </div>"+
                                        "<div class='col-3'>"+ arr.content[i].total_doul_demand_collection +"</div>"+
                                    "</div>"+
                                    "<div class='row px-2 py-1'>"+
                                        "<div class='col-9'>Collection percentage: </div>"+
                                        "<div class='col-3'>"+ arr.content[i].collection_percentage +"</div>"+
                                    "</div>"+
                                    "<div class='row px-2 py-1'>"+
                                        "<div class='col-9'>Eligible commission percentage: </div>"+
                                        "<div class='col-3'>"+ arr.content[i].eligible_commision_percentage +"</div>"+
                                    "</div>"+


                                    "<div class='row px-2 py-1'>"+
                                        "<div class='col-9'>Commission paid @30%: </div>"+
                                        "<div class='col-3'>"+ arr.content[i].paid_commission_at_30 +"</div>"+
                                    "</div>"+


                                    "<div class='row px-2 py-1'>"+
                                        "<div class='col-9'>Commission to be claimed: </div>"+
                                        "<div class='col-3'>"+ arr.content[i].claimable_amount +"</div>"+
                                    "</div>"+
                                    "<div class='row px-2 py-1'>"+
                                        "<div class='col-9'>Leftout adjustment amount(decimal): </div>"+
                                        "<div class='col-3'>"+ arr.content[i].claimable_decimal_amount +"</div>"+
                                    "</div> <hr>"+
                                    "<div class='row px-2 py-1'>"+
                                        "<div class='col-9'><b>Total claimable amount: </b></div>"+
                                        "<div class='col-3'><b>"+ arr.content[i].total_claimable_amount +"</b></div>"+
                                    "</div>"+
                                    is_claimed+
                                "</div>"+
                            "</div>";
                }
                $('#arrear_id').html('');
                $('#arrear_id').append(rows);

            }
        });
    }


    function fileReturn(doul_year,total_doul_demand,total_doul_demand_collection,collection_percentage,eligible_commision_percentage,paid_commission_at_30,claimable_amount,claimable_decimal_amount,total_claimable_amount)
    {
        var postData = {
            'doul_year': doul_year, 
            'total_doul_demand': total_doul_demand, 
            'total_doul_demand_collection': total_doul_demand_collection, 
            'collection_percentage': collection_percentage, 
            'eligible_commision_percentage': eligible_commision_percentage, 
            'paid_commission_at_30': paid_commission_at_30, 
            'claimable_amount': claimable_amount, 
            'claimable_decimal_amount': claimable_decimal_amount, 
            'total_claimable_amount': total_claimable_amount, 
        };
   
        $.blockUI({
            message: $('#displayBox'),
            css: {
                border:'none',
                backgroundColor:'transparent'
            }
        });
        $.ajax({
            url: baseurl+'/EkhajanaCommissionController/fileReturn',
            type: "POST",
            data: postData,
            success: function(data) {
                arr = JSON.parse(data);
                $.unblockUI();
                if(arr.responseType == 0)
                {
                    showErrorMessage(arr.msg);
                }
                else
                {
                    showSuccessMessage(arr.msg);
                    getArrears(arr.dist_code, arr.subdiv_code, arr.cir_code, arr.mouza_pargona_code);
                }
            }
        });
    }
</script>
