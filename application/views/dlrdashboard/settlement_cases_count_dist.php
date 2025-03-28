<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <style>
        .card {
            margin: 0 auto; /* Added */
            float: none; /* Added */
            margin-bottom: 10px; /* Added */
            /* margin-top: 50px; */
        }

        .low{
            background-color : red !important;
            color: white;
            font-weight: bold;
        }

        .mid{
            background-color : #ffbf00 !important;
            color: black;
        }

        .midl{
            background-color : #2dd256 !important;
            color: black;
        }

        .high{
            background-color : green !important;
            color: black;
        }

        .tenant{
            background-color : #007bff78 !important;
            border-bottom-width: 0px;
        }

        .bold{
            font-weight: bold;
        }

        #example_wrapper{
            width: 100%;
        }
        .mclr{
        background-color: red !important;
        color: white;
        }
        .dclr{
            background-color: gold !important;
            color: black;
        }
        .dcly{
            background-color: yellow !important;
            color: black;
        }
        .dclg{
            background-color: green; !important;
            color: black;
        }
    </style>

</head>
<body>

    <div class="container">
        <div class="card col-md-12" id="loc_save">
            <div class="card-body">                
                
              <!--   <div class="text-right"> 
                    <a  href='#' onclick='loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountService"; ?>",1)'>
                       <i class="fa fa-link" style="color: green;">
                       District wise Service wise status </i>
                   </a>
                   <br>
                   <a  href='#' onclick='loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountServiceUser"; ?>",2)'>
                       <i class="fa fa-link" style="color: green;">
                       District wise user wise status </i>
                   </a>
                   <br>
                   <a  href='#' onclick='loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountCircle"; ?>",3)'>
                       <i class="fa fa-link" style="color: green;">
                       Circle wise status </i>
                   </a>
                   <br>
                   <a target="blank" href='#' onclick='loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountCircleService"; ?>",4)'>
                       <i class="fa fa-link" style="color: green;">
                       Circle wise Service wise status </i>
                   </a>

                </div>
 -->
                <div class="row">
                    <h4 class="mb-4" style="line-height: 0.2; color: red; margin-top: 20px;text-align:center;" >
                                 Data would be updated every hour (Last updated at: <?php echo $modified_at?>)
                    </h4>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="button" class="btn btn-default" id='dist_count_btn'><i class="fa fa-camera fa-2xl" aria-hidden="true" ></i></button>
                    </div>
                </div>                

                <br>
                <div class="row" id='dist_count_data'>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4 class="mb-4" style="line-height: 0.2; color: #007bff; margin-top: 20px; text-align:center;" >
                                District Wise Disposal Status
                            </h4>
                    </div>
                    <table class="table-bordered" id="">

                        <tr>
                          <th>District</th>
                          <th>Dispose Percentage</th>
                          <th>Total Pending</th> 
                          <th>Total Disposed</th> 
                        </tr>
                        <tr>
                            <th></th>
                            <th><?=$datas?>%</th>
                            <td class="low"><?=$datas1?>% (<?=$alldata->pending?>)</td>
                            <td class="bold"><?=$alldata->disposed?></td>
                        </tr>
                        
                        <?php foreach($disposedPercentages as $d):?>
                            <tr>

                                <?php 
                                    if((number_format($d['disposedPercentage'],2))>=VALUE_LOW && (number_format($d['disposedPercentage'],2))<VALUE_MID)
                                    {
                                        $clr="low";
                                    }
                                    else if((number_format($d['disposedPercentage'],2))>=VALUE_MID && (number_format($d['disposedPercentage'],2))<VALUE_MIDL){
                                        $clr="mid";  
                                    }
                                    else if((number_format($d['disposedPercentage'],2))>=VALUE_MIDL && (number_format($d['disposedPercentage'],2))<VALUE_HIGH){
                                        $clr="midl"; 
                                    }
                                    else{
                                        $clr="high";
                                    }
                                ?>
                                <td><?=$d['output']->district?></td>
                                <th class="<?=$clr?> text-end"><?=number_format($d['disposedPercentage'],2)?>%</th>
                                <td class='text-end'><?=$d['output']->pending?></td>
                                <td class='text-end'><?=$d['output']->disposed?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table> 
                </div>

            </div>
        </div>
        <div class="card col-md-12" >
            <div class="card-body" >   
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-default" id='district_service_btn'><i class="fa fa-camera fa-2xl" aria-hidden="true" ></i></button>
                </div>
                <div class="" style='display:none;' id='dist_service'></div>
            </div>
        </div>
         <div class="card col-md-12" >
            <div class="card-body">   
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-default" id='district_service_user_btn'><i class="fa fa-camera fa-2xl" aria-hidden="true" ></i></button>
                </div>
                <div class="" style='display:none;' id='dist_service_user'></div>
            </div>
        </div>        
        <div class="card col-md-12" >
            <div class="card-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-default" id='sdlac_count_btn'><i class="fa fa-camera fa-2xl" aria-hidden="true" ></i></button>
                </div>
                <div class="" style='display:none;' id='sdlac_count'></div>
            </div>
        </div>
        <div class="card col-md-12" >
            <div class="card-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-default" id='circle_count_btn'><i class="fa fa-camera fa-2xl" aria-hidden="true" ></i></button>
                </div>
                <div class="" style='display:none;' id='circle_count'></div>
            </div>
        </div>
         <div class="card col-md-12" >
            <div class="card-body">
                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-default" id='circle_service_btn'><i class="fa fa-camera fa-2xl" aria-hidden="true" ></i></button>
                </div> -->
                <div class="" style='display:none;' id='circle_service'></div>
            </div>
        </div>
        
      
    </div>

</body>
</html>
 

<script>
    loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountSdlac"; ?>",5);
    loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountService"; ?>",1);
    loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountServiceUser"; ?>",2);
    loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountCircle"; ?>",3);
    loadData("<?php echo base_url() . "index.php/DlrDashboard/indexCountCircleService"; ?>",4);
    $(document).ready(function() {
        $('#example').DataTable({

            "pageLength": 20
        });
    });
    function loadData(url, val) {
        $.ajax({
            url: url,
            type: 'POST',            
            success: function(response){
                // What to do?
                if (val == 1)
                {
                    $('#dist_service').html(response);
                    $('#dist_service').show();   
                }
                else if (val == 2)
                {
                    $('#dist_service_user').html(response);
                    $('#dist_service_user').show();
                } 
                else if (val == 3)
                {
                    $('#circle_count').html(response);
                    $('#circle_count').show();
                }
                else if (val == 4)
                {
                    $('#circle_service').html(response);
                    $('#circle_service').show();
                } 
                else if (val == 5)
                {
                    $('#sdlac_count').html(response);
                    $('#sdlac_count').show();
                }                
            }
        })        
    }

</script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src='https://superal.github.io/canvas2image/canvas2image.js'></script>
<script type="text/javascript">
    
    document.querySelector('#dist_count_btn').addEventListener('click', function() 
    {       
        let div = document.getElementById('dist_count_data');
        html2canvas(div).then(
            function (canvas) {
               return Canvas2Image.saveAsPNG(canvas);
        })
    });
    document.querySelector('#district_service_btn').addEventListener('click', function() 
    {       
        let div = document.getElementById('dist_service');
        html2canvas(div).then(
            function (canvas) {
               return Canvas2Image.saveAsPNG(canvas);
        })
    });
    document.querySelector('#district_service_user_btn').addEventListener('click', function() 
    {       
        let div = document.getElementById('dist_service_user');
        html2canvas(div).then(
            function (canvas) {
               return Canvas2Image.saveAsPNG(canvas);
        })
    });
    document.querySelector('#circle_count_btn').addEventListener('click', function() 
    {       
        let div = document.getElementById('circle_count');
        html2canvas(div).then(
            function (canvas) {
               return Canvas2Image.saveAsPNG(canvas);
        })
    });
    document.querySelector('#sdlac_count_btn').addEventListener('click', function() 
    {       
        let div = document.getElementById('sdlac_count');
        html2canvas(div).then(
            function (canvas) {
               return Canvas2Image.saveAsPNG(canvas);
        })
    });
    // document.querySelector('#circle_service_btn').addEventListener('click', function() 
    // {       
    //     let div = document.getElementById('circle_service');
    //     html2canvas(div).then(
    //         function (canvas) {
    //            return Canvas2Image.saveAsPNG(canvas);
    //     })
    // });
    
    
</script>
