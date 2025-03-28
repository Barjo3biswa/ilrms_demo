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
                            Circle Wise Service Wise Status
                        </h4>
                    </div>
                </div>
             
                <div class="row"  style="overflow-x:auto;">

                   <table class="table-bordered" id="">

                        <tr>
                          <th class="headt">District</th>
                          <th class="headt">Circle</th>
                          <th class="headt">Total Cases</th> 
                          <th class="headt">Total Pending</th> 
                          <th class="headt">Occupancy Tenant Pending</th>
                          <th class="headt">PGR/VGR Pending</th> 
                          <th class="headt">Tribal Communities Pending</th> 
                          <th class="headt">Special Cultivators Pending</th> 
                          <th class="headt">AP Transfer Pending</th> 
                          <th class="headt">Khas Land Pending</th> 
                        </tr>
                      
                        <?php foreach($output as $d):?>
                            <tr>
                               <?php if(($d->total)>=VALUE_LOW && ($d->total)<=VALUE_PENL1){
                                    $clr="dclg";
                                 }
                                 elseif(($d->total)>=VALUE_PENL1 && ($d->total)<=VALUE_PENL2/2){
                                    $clr="dcly";
                                 }
                                 // elseif(($d->total)>=VALUE_PENL2/2 && ($d->total)<=VALUE_PENL3){
                                 //    $clr="dcly";
                                 // }  
                                 else{
                                    $clr="mclr";
                                 }?>    

                                <td><?=$d->district?></td>
                                <td><?=$d->circle?></td>
                                <th class="<?=$clr?> text-end"><?=$d->total?></th>
                                <th class="<?=$clr?> text-end"><?=$d->total_pending?></th>
                                <td class='text-end'><?=$d->pending_tenant?></td>
                                <td class='text-end'><?=$d->pending_pgr?></td>
                                <td class='text-end'><?=$d->pending_tribal?></td>
                                <td class='text-end'><?=$d->pending_cultivator?></td>
                                <td class='text-end'><?=$d->pending_ap?></td>
                                <td class='text-end'><?=$d->pending_khas?></td>
                            </tr>
                        <?php endforeach; ?>

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
