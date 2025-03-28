<style type="text/css">
	.div_dash {
		border: 1px solid rgba(0, 0, 0, 0.125);
		margin: 10px;
		border-radius: 5px 5px;
		background: linear-gradient(to right, #7b4397, #dc2430);
	}

	.div_inner {
		padding: 10px;
	}

	.purecounter {
		font-weight: bold;
		font-size: 25px;
		color: #fff;
		padding-left: 30px;
	}

	.purecounter p {
		margin-bottom: 0px;
	}

	.title {
		font-size: 18px;
		color: #fff;
	}

	.div_dash:hover {
		/*background: yellow;*/
		transform: scale(1.05);
	}

	.card-body{  background: #7B4397; /* fallback for old browsers */
  		background: -webkit-linear-gradient(to right, #7B4397, #DC2430); /* Chrome 10-25, Safari 5.1-6 */
  		background: linear-gradient(to right, #7B4397, #DC2430); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */);}
  	#circle {
		background: #0F546A;
		border-radius: 30%;
		padding: 7px !important;
		font-weight: bold;
		font-size: 2em;
    }
    .btn-success:hover{
        background-color:#086320;
        border-color:#086320;
    }

	.card{
		margin-bottom : 0px;
	}
</style>
<div class="container-fluid">
    <div class="row" id="eIdDiv">	
        <div class="col-lg-3"></div>
        <div class="col-lg-6 mt-4 mb-3 p-3" style="border:3px solid #96907E; border-radius:5px">           
            <div class="p-2 bg-warning text-center text-white h5 shadow-sm border border-white rounded">
                <b>e-ID oF <?=$name?></b>
            </div>
                <table class="table table-bordered table-dark" style="margin-top:-10px;">
                    <tbody>
                        <tr>
                            <td>EKHAZANA-ID-CODE</td>
                            <td><?=$id_code?></td>
                        </tr>
                        <tr>
                            <td>FULL-NAME</td>
                            <td><?=$name?></td>
                        </tr>
                        <tr>
                            <td>EMAIL</td>
                            <td><?=$email?></td>
                        </tr>
                        
                        <tr>
                            <td>MOBILE-NO</td>
                            <td><?=$mobile_no?></td>
                        </tr>
                        <tr>
                            <td>ADDRESS</td>
                            <td><?=$address?></td>
                        </tr>
                        <tr>
                            <td>JOINING-DATE</td>
                            <td><?=date('Y-m-d', strtotime($date_of_joining))?></td>
                        </tr>                        
                    </tbody>
		        </table>                             
        </div>  
    </div>
    <center>
        <button class="btn btn-sm btn-success" onclick="printDiv()"><i class="fa-solid fa-print"></i></i> Print</button>
    </center> 
</div>
<script>
    function printDiv() 
    {
        let printContents, popupWin;
        printContents = document.getElementById('eIdDiv').innerHTML;
        popupWin = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
        popupWin.document.open();
        popupWin.document.write(`
            <html>
            <head>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            </head>
            <style>
            </style>
                <body onload="window.print();window.close()">${printContents}</body>
            </html>`
        );
        popupWin.document.close();
    }
</script>




