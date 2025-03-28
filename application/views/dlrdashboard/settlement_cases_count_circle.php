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


        /*new*/
        /* Apply a max-width to the table container */
        .fixed-table {
            position: fixed;
            top: 50px; /* Adjust this value to set the vertical position */
            left: 50px; /* Adjust this value to set the horizontal position */
            background-color: #fff;
            border: 1px solid #ddd;
            z-index: 1000; /* Adjust the z-index if necessary */
        }

        .wrapper{
            background: #fff;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            /*grid-template-rows: repeat(20,1fr); */
            font-size: 13px;
            margin-bottom: 30px;
            margin-top: 20px;
        }
        .wrapper .item{border: 1px solid #ccc;display: flex;justify-content: center; align-items: center;flex-direction: column;position: relative;}
        .wrapper .item span{

            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 0;
        }

        .wrapper .item p{
            padding: 12px 0px;
            text-align: center;
            font-weight: 500;
        }

       /* .mclr{
            background-color: red !important;
            color: white;
        }
        .dclr{
            background-color: gold !important;
            color: black;
        }*/
    </style>

</head>
<body>

    <div class="container">
        <div class="col-md-12" id="loc_save">
            <div class="">
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="mb-4" style="line-height: 0.2; color: #007bff; margin-top: 20px; text-align:center;" >
                            Circle wise status
                        </h4>
                    </div>
                </div>
                <div class="wrapper">
                    <?php foreach ($output as $d): ?>
                       <?php if(($d->pending)>=VALUE_LOW && ($d->pending)<=VALUE_PENL1){
                            $clr="dclg";
                         }
                         elseif(($d->pending)>=VALUE_PENL1 && ($d->pending)<=VALUE_PENL2){
                            $clr="dclr";
                         }
                         elseif(($d->pending)>=VALUE_PENL2 && ($d->pending)<=VALUE_PENL3){
                            $clr="dcly";
                         }  
                         else{
                            $clr="mclr";
                         }?>  
                        <div class="item">
                            <p>
                                <?= $d->circle ?>
                            </p>
                            <span class="<?=$clr?>">
                                <?= $d->pending ?>
                            </span>

                        </div>
                    <?php endforeach; ?>
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
