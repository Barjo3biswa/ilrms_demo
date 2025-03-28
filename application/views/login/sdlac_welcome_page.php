<!DOCTYPE html>
<html lang="en">

<head>
    <title>ILRMS | Government of Assam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.bxslider.css">
    <!-- Script -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.bxslider.min.js"></script>
    <!-- End Script -->
</head>
<style>
    * {
        font-family: 'montserrat', sans-serif;
    }

    body {
        margin: 0;
        padding: 0;
    }

    .page {
        background: #f1f1f1;
        display: flex;
        flex-wrap: wrap;
    }

    .col {
        flex: 1;
        height: 100vh;
        position: relative;
    }

    .countdown-col {
        background: url("<?php echo base_url(); ?>assets/sdlac_user_image.png") no-repeat center;
        /* background-size: cover; */
    }

    .time {
        color: #fff;
        text-transform: uppercase;
        width: 90%;
        display: flex;
        justify-content: center;
    }

    .middle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .time span {
        padding: 0 14px;
        font-size: 10px;
    }

    .time span div {
        font-size: 40px;
    }

    .newslatter {
        width: 90%;
    }

    .newslatter h4 {
        font-style: italic;
        font-size: 12px;
    }

    .newslatter input,
    .newslatter button {
        display: block;
        margin: 12px auto;
        width: 30%;
        max-width: 400px;
        box-sizing: border-box;
        padding: 14px 20px;
        border-radius: 30px;
        border: 1px solid #ddd;
        outline: none;
    }

    .newslatter-button {
        background: linear-gradient(125deg, #3498db, #34495e);
        color:#fff;
        cursor: pointer;
        transition: 0.4s;
    }

    .newslatter-button:hover {
        opacity: 0.7;
    }


    @media screen and (max-width: 900px) {
        .col {
            flex: 100%;
        }
    }

    .newslatter-button-2 {
        background: linear-gradient(125deg, #fa9c16, #34495e);
        color: #fff;
        cursor: pointer;
        transition: 0.4s;
    }

</style>


<body>
    <!-- Start Top Nav -->
    <form id='aadhaarForm' method="POST" action="<?= AADHAARREGURL; ?>">
        <input type="hidden" name="enc_data" id="enc_data">
    </form>

    <div class="ilrms_belowbanner">
        <div class="page">
            <div class="countdown-col col">
                <div class="time middle">
                    <span>
                        <!-- <h1>W E L C O M E</h1> -->
                    </span>
                </div>
            </div>
            <div class="newsletter-col col">
                <div class="newslatter middle">
                    <h2 style="text-transform: uppercase;">Welcome to </h2>
                    <h3>SDLAC member Sign Up</h3>
                    <!-- <h4>Subscribe to get notification when we start</h4> -->
                    <button type="button" class="newslatter-button" onclick="aadhaarLink();">Sign Up <i class="fa fa-sign-in" aria-hidden="true"></i></button>

	  	    <a style="text-decoration:none" href="<?php echo base_url(); ?>Basundhara/loginSdlacWithoutAdhaar">
                    <button type="button" class="newslatter-button-2">Manual Sign Up <i class="fa fa-sign-in" aria-hidden="true"></i></button>
                    </a>

                </div>
            </div>
        </div>

        <script>
            let salt = "<?= $this->session->userdata('randomKey') ?>";
            var BASE_URL = "<?= base_url(); ?>";

            function aadhaarLink() {
                $.ajax({
                    url: BASE_URL + "/AadhaarAuth/ilrmsSignUp",
                    dataType: "JSON",
                    type: "POST",
                    success: function(data) {
                        $("#enc_data").val(data.data);
                        $("#aadhaarForm").submit();
                    },
                });

            }
        </script>
        <script src="<?= base_url(); ?>js/login/login.js"></script>
        <script src="<?= base_url(); ?>assets/js/sha512.min.js"></script>
</body>

</html>
