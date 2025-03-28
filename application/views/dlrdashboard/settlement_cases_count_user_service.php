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
            
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="mb-4" style="line-height: 0.2; color: #007bff; margin-top: 20px; text-align:center;" >
                            District wise user wise status
                        </h4>
                    </div>
                </div>
                <div class="row"  style="overflow-x:auto;">

                    <table class="table-bordered" id="">

                        <tr>
                              <th rowspan="3">District</th>
                              <th>Total Pending</th>
                              <th>DC</th> 
                              <th>ADC</th> 
                              <th>SDO</th> 
                              <th>CO</th>
                              <th>LRA</th> 
                              <th>Dept</th> 
                        </tr>
                        <tr>
                            <th>100%</th>
                            <?php if(($datas[0]['totDC'])>=VALUE_LOW && ($datas[0]['totDC'])<=VALUE_LOWH){
                                $clr1="dclg";
                            }
                            elseif(($datas[0]['totDC'])>=VALUE_LOWH && ($datas[0]['totDC'])<=VALUE_MIDL){
                                    $clr1="dclr";
                            }                        
                            else{
                                    $clr1="mclr";
                            }?>
                            <th class="<?=$clr1?>"><?=($datas[0]['totDC'])?>%</th>

                            <?php if(($datas[0]['totADC'])>=VALUE_LOW && ($datas[0]['totADC'])<=VALUE_LOWH){
                                $clr1="dclg";
                            }
                            elseif(($datas[0]['totADC'])>=VALUE_LOWH && ($datas[0]['totADC'])<=VALUE_MIDL){
                                    $clr1="dclr";
                            }                        
                            else{
                                    $clr1="mclr";
                            }?>
                            <th class="<?=$clr1?>"><?=($datas[0]['totADC'])?>%</th>

                            <?php if(($datas[0]['totSDO'])>=VALUE_LOW && ($datas[0]['totSDO'])<=VALUE_LOWH){
                                $clr1="dclg";
                            }
                            elseif(($datas[0]['totSDO'])>=VALUE_LOWH && ($datas[0]['totSDO'])<=VALUE_MIDL){
                                    $clr1="dclr";
                            }                        
                            else{
                                    $clr1="mclr";
                            }?>
                            <th class="<?=$clr1?>"><?=($datas[0]['totSDO'])?>%</th>

                            <?php if(($datas[0]['totCO'])>=VALUE_LOW && ($datas[0]['totCO'])<=VALUE_LOWH){
                                $clr1="dclg";
                            }
                            elseif(($datas[0]['totCO'])>=VALUE_LOWH && ($datas[0]['totCO'])<=VALUE_MIDL){
                                    $clr1="dclr";
                            }                        
                            else{
                                    $clr1="mclr";
                            }?>
                            <th class="<?=$clr1?>"><?=($datas[0]['totCO'])?>%</th>

                            <?php if(($datas[0]['totLRA'])>=VALUE_LOW && ($datas[0]['totLRA'])<=VALUE_LOWH){
                                $clr1="dclg";
                            }
                            elseif(($datas[0]['totLRA'])>=VALUE_LOWH && ($datas[0]['totLRA'])<=VALUE_MIDL){
                                    $clr1="dclr";
                            }                        
                            else{
                                    $clr1="mclr";
                            }?>
                            <th class="<?=$clr1?>"><?=($datas[0]['totLRA'])?>%</th>

                            <?php if(($datas[0]['totDept'])>=VALUE_LOW && ($datas[0]['totDept'])<=VALUE_LOWH){
                                $clr1="dclg";
                            }
                            elseif(($datas[0]['totDept'])>=VALUE_LOWH && ($datas[0]['totDept'])<=VALUE_MIDL){
                                    $clr1="dclr";
                            }                        
                            else{
                                    $clr1="mclr";
                            }?>
                            <th class="<?=$clr1?>"><?=($datas[0]['totDept'])?>%</th>
                        </tr>
                        <tr>
                            <th class='text-end'><?=$alldata->total?></th>
                            <th class='text-end'><?=$alldata->dc?></th>
                            <th class='text-end'><?=$alldata->adc?></th>
                            <th class='text-end'><?=$alldata->sdo?></th>
                            <th class='text-end'><?=$alldata->co?></th>
                            <th class='text-end'><?=$alldata->lm?></th>
                            <th class='text-end'><?=$alldata->dpt?></th>
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
                                <td class="<?=$clr?> text-end"><?=$d->total?></td>
                                <td class='text-end'><?=$d->dc?></td>
                                <td class='text-end'><?=$d->adc?></td>
                                <td class='text-end'><?=$d->sdo?></td>
                                <td class='text-end'><?=$d->co?></td>
                                <td class='text-end'><?=$d->lm?></td>
                                <td class='text-end'><?=$d->dpt?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table> 

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