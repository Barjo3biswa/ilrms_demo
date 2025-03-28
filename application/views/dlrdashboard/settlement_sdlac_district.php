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

        .headt{
            font-weight: bold;
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

        #example_wrapper{
            width: 100%;
        }
    </style>

</head>
<body>

    <div class="container">
        <div class="col-md-12" id="loc_save">
            <div class="">
               
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="mb-4" style="line-height: 0.2; color: #007bff; margin-top: 20px; text-align:center;" >
                            District Wise SDLAC Meeting 
                        </h4>
                    </div>
                </div>
             
                <div class="row"  style="overflow-x:auto;">

                   <table class="table-bordered" id="">

                        <tr>
                          <th class="headt">District</th>                          
                          <th class="headt">Total</th> 
                          <th class="headt">By ADC</th>
                          <th class="headt">By SDO</th> 
                          <th class="headt">Total Proposals</th> 
                          <th class="headt">Total Cases</th>                              
                        </tr>
                      
                        <?php $t_meeting=0;$t_adc=0;$t_sdo=0;$t_prop=0; $t_cases=0; foreach($output as $d):?>
                            <tr>
                                <td><?=$d->distname?></td>                                
                                <th class='text-end'><?=$d->total_meeting?></td>
                                <td class='text-end'><?=$d->meeting_by_adc?></td>
                                <td class='text-end'><?=$d->meeting_by_sdo?></td>
                                <td class='text-end'><?=$d->total_proposal_count?></td>
                                <td class='text-end'><?=$d->total_case_count?></td>                  
                                <?php 
                                  $t_meeting = $t_meeting + $d->total_meeting;
                                  $t_adc = $t_adc + $d->meeting_by_adc;
                                  $t_sdo = $t_sdo + $d->meeting_by_sdo;
                                  $t_prop = $t_prop + $d->total_proposal_count;
                                  $t_cases = $t_cases + $d->total_case_count;
                                ?>            
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th>Total</th>
                            <th class='text-end'><?=$t_meeting?></th> 
                            <th class='text-end'><?=$t_adc?></th> 
                            <th class='text-end'><?=$t_sdo?></th> 
                            <th class='text-end'><?=$t_prop?></th> 
                            <th class='text-end'><?=$t_cases?></th> 
                        </tr>
                    </table> 

                </div>

            </div>
        </div>
    </div>

</body>
</html>


<script>
    $(document).ready(function() {
        $('#').DataTable({

            "pageLength": 20
        });

    });
</script>
