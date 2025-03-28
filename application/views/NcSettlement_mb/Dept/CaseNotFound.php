<style>
    /*======================
    404 page
=======================*/

    .page_404 {
        padding: 40px 0;
        background: #fff;
        font-family: 'helvetica', sans-serif;
    }

    .page_404 img {
        width: 100%;
    }

    .four_zero_four_bg {

        /* background-image: url('https://assets.codepen.io/1538474/star.svg'); */
        background-position: center;
    }


    .four_zero_four_bg h1 {
        font-size: 80px;
    }

    .four_zero_four_bg h3 {
        font-size: 80px;
        color: #2C5364 !important;
        font-weight: bold;


    }

    .link_404 {
        color: #fff !important;
        padding: 10px 20px;
        border: none;
        text-align: center;
        background: #39ac31;
        margin: 20px 0;
        display: inline-block;
        font-size: 16px;
        font-family: helvetica;

    }

    .contant_box_404 {
        margin-top: 50px;
        color: #2C5364 !important;


    }
</style>

<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="four_zero_four_bg">
                    <h3 class="text-center">CASE NOT FOUND</h3>
                </div>
                <img src="<?php echo base_url(); ?>assets/pagenotfound.jpg" alt="" width="400" height="450">

                <div class="contant_box_404 text-center">
                    <p class="h5" style="color: #FF4B2B;">
                        The case you are looking for application no : <?php echo $application_no ?> not avaible!
                    </p>
                    <button class="link_404" onclick="history.back()">Go Back</button>
                </div>

            </div>
        </div>
    </div>
</section>