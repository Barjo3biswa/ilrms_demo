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
                        District wise service wise status
                    </h4>
                </div>
            </div>

            <div class="row"  style="overflow-x:auto;">

                <table class="table-bordered" id="">
                
                    <tr>
                      <th rowspan="3">District</th>
                      <th>Total Pending</th>
                      <th>Settlement of Government Khas & Ceiling Surplus Land</th> 
                      <th>Settlement of Transferred AP land</th> 
                      <th>Conferring ownership rights to Occupancy Tenants</th> 
                      <th>Settlement of hereditary land of Tribal communities</th>
                      <th>Settlement of VGR/PGR Land</th> 
                      <th>Settlement of land for indigenous special cultivators (small tea growers etc.)</th> 
                    </tr>
                    <tr>
                        <th>100%</th>
                        
                        <?php if(($datas[0]['totPenKhas'])>=VALUE_LOW && ($datas[0]['totPenKhas'])<=VALUE_LOWH){
                                $clr1="dclg";
                        }
                        elseif(($datas[0]['totPenKhas'])>=VALUE_LOWH && ($datas[0]['totPenKhas'])<=VALUE_MIDL){
                                $clr1="dclr";
                        }                        
                        else{
                                $clr1="mclr";
                        }?>
                        <th class="<?=$clr1?>"><?=($datas[0]['totPenKhas'])?>%</th>

                        <?php if(($datas[0]['totPenAp'])>=VALUE_LOW && ($datas[0]['totPenAp'])<=VALUE_LOWH){
                                $clr1="dclg";
                        }
                        elseif(($datas[0]['totPenAp'])>=VALUE_LOWH && ($datas[0]['totPenAp'])<=VALUE_MIDL){
                                $clr1="dclr";
                        }
                        else{
                                $clr1="mclr";
                        }?>
                        <th class="<?=$clr1?>"><?=($datas[0]['totPenAp'])?>%</th>

                        <?php if(($datas[0]['totPentenant'])>=VALUE_LOW && ($datas[0]['totPentenant'])<=VALUE_LOWH){
                                $clr1="dclg";
                        }
                        elseif(($datas[0]['totPentenant'])>=VALUE_LOWH && ($datas[0]['totPentenant'])<=VALUE_MIDL){
                                $clr1="dclr";
                        }                        
                        else{
                                $clr1="mclr";
                        }?>
                        <th class="<?=$clr1?>"><?=($datas[0]['totPentenant'])?>%</th>

                        <?php if(($datas[0]['totPenTribal'])>=VALUE_LOW && ($datas[0]['totPenTribal'])<=VALUE_LOWH){
                                $clr1="dclg";
                        }
                        elseif(($datas[0]['totPenTribal'])>=VALUE_LOWH && ($datas[0]['totPenTribal'])<=VALUE_MIDL){
                                $clr1="dclr";
                        }                        
                        else{
                                $clr1="mclr";
                        }?>
                        <th class="<?=$clr1?>"><?=($datas[0]['totPenTribal'])?>%</th>

                        <?php if(($datas[0]['totPenPgr'])>=VALUE_LOW && ($datas[0]['totPenPgr'])<=VALUE_LOWH){
                                $clr1="dclg";
                        }
                        elseif(($datas[0]['totPenPgr'])>=VALUE_LOWH && ($datas[0]['totPenPgr'])<=VALUE_MIDL){
                                $clr1="dclr";
                        }                        
                        else{
                                $clr1="mclr";
                        }?>
                        <th class="<?=$clr1?>"><?=($datas[0]['totPenPgr'])?>%</th>

                        <?php if(($datas[0]['totPenCult'])>=VALUE_LOW && ($datas[0]['totPenCult'])<=VALUE_LOWH){
                                $clr1="dclg";
                        }
                        elseif(($datas[0]['totPenCult'])>=VALUE_LOWH && ($datas[0]['totPenCult'])<=VALUE_MIDL){
                                $clr1="dclr";
                        }                        
                        else{
                                $clr1="mclr";
                        }?>
                        <th class="<?=$clr1?>"><?=($datas[0]['totPenCult'])?>%</th>
                    </tr>
                    <tr>
                        <th><?=$alldata->total?></th>
                       
                        <th class='text-end'><?=$alldata->total_pending_khas?></th>
                        <th class='text-end'><?=$alldata->total_pending_ap?></th>
                        <th class='text-end'><?=$alldata->total_pending_tenant?></th>
                        <th class='text-end'><?=$alldata->total_pending_tribal?></th>
                        <th class='text-end'><?=$alldata->total_pending_pgr?></th>
                        <th class='text-end'><?=$alldata->total_pending_cultivator?></th>
                    </tr>
                    <?php foreach($output->data2 as $d):?>
                        <tr>
                       
                            <?php if(($d->total)>=VALUE_LOW && ($d->total)<=VALUE_PENL1){
                                $clr="dclg";
                             }
                             elseif(($d->total)>=VALUE_PENL1 && ($d->total)<=VALUE_PENL2){
                                $clr="dclr";
                             }
                             elseif(($d->total)>=VALUE_PENL2 && ($d->total)<=VALUE_PENL3){
                                $clr="dcly";
                             }  
                             else{
                                $clr="mclr";
                             }?>                             
                            <td><?=$d->district?></td>
                            <th class="<?=$clr?> text-end"><?=$d->total?></th>
                            <td class='text-end'><?=$d->pending_khas?></td>
                            <td class='text-end'><?=$d->pending_ap?></td>
                            <td class='text-end'><?=$d->pending_tenant?></td>
                            <td class='text-end'><?=$d->pending_tribal?></td>
                            <td class='text-end'><?=$d->pending_pgr?></td>
                            <td class='text-end'><?=$d->pending_cultivator?></td>
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
    $('#example').DataTable({
    
    "pageLength": 20
  });
  
});
</script>
