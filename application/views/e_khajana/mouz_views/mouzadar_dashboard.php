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
</style>

<?php if ($this->session->userdata('first_login') == 0) { ?>
	<script>
		$(document).ready(function () {
			$('#change_pass').modal({
				backdrop: 'static',
				keyboard: false
			})
			$('#change_pass').modal('show');
		});

		$(document).on('click', '#depart_btn_continue', function () {
			$('#change_pass').hide();
			$('.modal-backdrop').hide();
		});
	</script>

	<div class="modal" id="change_pass" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="text-center"><h4>Welcome <?= $this->session->userdata('name') ?></h4></div>
					<div class="text-center text-sm p-2" style="font-size: 16px; color: red"> Note: Please Change Your
						Password (Mandatory)
					</div>
					<hr>
					<form method="post" id="change_password">
						<div class="container py-2 m-0" style="padding-left: 5%;padding-right: 5%">
							<div class="row">
								<div style="width: 35%; text-align: right">
									User name:
								</div>
								<div style="width: 60%">
									<input class="form-control" name="user_name"
										   value="<?= $this->session->userdata('unique_user_id') ?>" readonly>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									Old Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" name="old_password" value=""
										   autocomplete="off" id="old_password">
									<sm id="old_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									New Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" name="new_password" id="new_password"
										   value="" autocomplete="off">
									<sm id="new_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									Re-Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" name="re_password" id="re_password"
										   value="" autocomplete="off">
									<sm id="re_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
						</div>
						<div class="text-center pt-4">
							<button type="submit" id="validate_submit_btn" class="btn btn-primary rounded"> Change
								Password
							</button>
						</div>
					</form>

					<div id="validate_msg" class="text-center"
						 style="font-weight: bold; font-size: 16px;color:green;"></div>

					<hr>
					<div style="padding-top: 10px; padding-bottom: 5px; font-size: 16px;"
						 class="text-gray-dark text-center">
						Password should have 8 to 12 characters, at least 1 digit and 1 special character(!@#$%^&*).
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div class="p-2 bg-success text-center text-white h5 shadow-sm border border-white rounded"><b>Mouzadar-Dashboard-(Mouza : <?=$this->utilclass->getMouzaName($this->session->userdata('dist_code'),$this->session->userdata('subdiv_code'),$this->session->userdata('cir_code'),$this->session->userdata('mouza_pargona_code'))?>)</b>
</div>

<div class="" style="display:none;">
    <b><p class="text-center bg-dark text-white p-1 mt-1">
        Application counts are displayed from date '01/07/2024'
    </p></b>
</div>

<div class="container-fluid">
  <div class="col-lg-12 mt-2  p-3" style="border:3px solid #96907E; border-radius:5px">
    <div class="row ">
        <div class="col-lg-3">
          	<div class="card">
                <div class="card-body text-white">
                <h4></h4>
                  	Application Received: <kbd id='circle'><?=$all_applications?></kbd>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
          	<div class="card">
                <div class="card-body text-white">
                <h4></h4>
                	Application Pending: <kbd id='circle'><?=$pending_applications?></kbd>
                </div>
              </div>
            </div>
        <div class="col-lg-3">
          	<div class="card">
                <div class="card-body text-white">
                <h4></h4>
                	Application Delivered: <kbd id='circle'><?=$disposed_applications?></kbd>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body text-white">
                  <h4></h4>
                  Application Reverted: <kbd id='circle'><?=$reverted_applications?></kbd>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<hr>

<!-- graphical representation code begins -->
<div class="p-3" style="border:2px solid #96907e;padding:3px;border-radius:6px" >
	<div class="card-header bg-secondary text-white mb-3 shadow   rounded " >
        <h6 class="text-center"> Graphical Representation Of Ekhajana Applications In Last 30 Days (Mouza : <?=$this->utilclass->getMouzaName($this->session->userdata('dist_code'),$this->session->userdata('subdiv_code'),$this->session->userdata('cir_code'),$this->session->userdata('mouza_pargona_code'))?>)</h6>
	</div>
	<canvas id="service_stack_chart" width="400" height="200"></canvas>
  </div>
  <br><br>
<!-- script for bar graph begins -->
<!-- Script for ServiceWise Stacked Bar Charts Begin-->
<script>
  let date_array = <?=json_encode($date_array)?>;
  let ekhajana_count = <?=json_encode($ekhajana_count)?>;
  //console.log(ekhajana_count);
  var ctx = $("#service_stack_chart");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: date_array,
      datasets: [{
        label: 'Ekhajana applications received',
        backgroundColor: "#159957",
        
        data: ekhajana_count,

      }, 
 ],
    },
    options: {
      tooltips: {
        displayColors: true,
        callbacks: {
          mode: 'x',
        },
      },
      scales: {
        xAxes: [{
          stacked: true,
          gridLines: {
            display: false,
          

          }
        }],
        yAxes: [{
          stacked: true,
          ticks: {
            beginAtZero: true,
          },
          type: 'linear',
          
        }]
      },
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        position: 'top'
      },
    }
  });
</script>

<style type="text/css">
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

<script src="<?= base_url(); ?>js/home/home.js"></script>
<script src="<?= base_url(); ?>assets/js/sha512.min.js"></script>

