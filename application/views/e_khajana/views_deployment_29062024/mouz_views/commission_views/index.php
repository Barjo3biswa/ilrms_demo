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

<div class="p-2 bg-success text-center text-white h5 shadow-sm border border-white rounded">
	<b>Commission-Details(Mouza : <?=$this->utilclass->getMouzaName($this->session->userdata('dist_code'),$this->session->userdata('subdiv_code'),$this->session->userdata('cir_code'),$this->session->userdata('mouza_pargona_code'))?>)</b>
</div>

<div class="p-1 bg-dark text-center text-warning h6 shadow-sm border border-white rounded" style="margin-top:-12px;">
	<b>NOTE: COMMISSION AMOUNTS WILL BE AUTOMATICALLY UPDATED AFTER STARTING OF PAYMENTS IN E-KHAJANA</b> 
</div>

<div class="container-fluid">
  <div class="col-lg-12 mt-2  p-3" style="border:3px solid #96907E; border-radius:5px">
    <div class="row ">		
        <div class="col-lg-6">
          	<div class="card">
                <div class="card-body text-white">
                <h4></h4>
                  	Total Amount Received: <kbd id='square'> RS 0</kbd>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body text-white">
                  <h4></h4>
                  	Total Commision Received: <kbd id='square'>RS 0</kbd>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>



