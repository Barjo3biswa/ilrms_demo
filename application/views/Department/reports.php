<style>
	:root {
		--loader-size: 50px;
		--dot-size: 6px;
		--loader-bg: #e1e6e2;
		--dot-color: black;
	}

	.loader {
		position: fixed;
		display: flex;
		justify-content: center;
		align-items: center;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		background-color: rgba(1, 18, 64, 0.2);
		transition: opacity 0.3s ease-out, top 0.3s step-end;
		z-index: 99;
	}

	.loader.trans {
		transition: opacity 0.5s ease-out, top 0.5s step-start;
		opacity: 1;
		top: 0;
	}

	.loader .loaderview {
		position: center;
		display: flex;
		justify-content: center;
		align-items: center;
		width: auto;
		height: auto;
		padding: 10px 40px;
		border-radius: 5px;
		top: 0;
		left: 0;
		z-index: 100;
		flex-flow: column;
		background-color: var(--loader-bg);
	}

	h1 {
		color: var(--dot-color);
		font-size: 1.2em;
		animation: fading 1.5s ease-in-out infinite;
		font-family: "Comfortaa", cursive;
	}

	.Loader-box {
		margin: 20px;
		flex: 0 0 auto;
		height: var(--loader-size);
		width: var(--loader-size);
	}

	.box {
		position: absolute;
		height: var(--loader-size);
		width: var(--loader-size);
		animation: rotating 4s ease-in infinite;
		animation-delay: calc(var(--id) * 0.5s);
	}

	.dot {
		background-color: var(--dot-color);
		height: var(--dot-size);
		width: var(--dot-size);
		border-radius: 100%;
	}

	@keyframes rotating {
		0% {
			opacity: 0;
			transform: rotateZ(0);
		}
		25% {
			opacity: 100%;
			transform: rotateZ(160deg);
		}

		75% {
			opacity: 200%;
			opacity: 100;
		}
		80% {
			transform: rotateZ(300deg);
			opacity: 100;
		}
		100% {
			transform: rotateZ(350deg);
			opacity: 0;
		}
	}

	@keyframes fading {
		0% {
			opacity: 40%;
		}
		50% {
			opacity: 90%;
		}
		100% {
			opacity: 40%;
		}
	}
</style>

<div class="hide loader" id="loader" style="display:none">
	<div class="loaderview">
		<h1>Don't refresh the page until the process is completed...</h1>
		<div class="Loader-box">
			<div class="box" style="--id:1">
				<div class="dot"></div>
			</div>
			<div class="box" style="--id:2">
				<div class="dot"></div>
			</div>
			<div class="box" style="--id:3">
				<div class="dot"></div>
			</div>
			<div class="box" style="--id:4">
				<div class="dot"></div>
			</div>
			<div class="box" style="--id:5">
				<div class="dot"></div>
			</div>
		</div>
	</div>
</div>


<div class='container ' style="margin-top:10px">
	<div class='col-lg-12'>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="bg-white shadow-lg rounded p-2 card-info">
						<div class="card-header text-danger text-bold">
							<h6>Village Wise Report Data</h6>
						</div>
						<div class="card-body">
							
							<div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span> Select District :</label>
								</div>
								<div class="col-sm-8">
									<select class="form-control districtselect1 reset" name='dist_code' required>
										<option disabled selected>Select District</option>
										<option value='10'>ছিৰাং ( Chirang )</option>
										<option value='06'>নলবাৰী ( Nalbari )</option>
										<option value='08'>দৰং ( Darrang )</option>
										<option value='07'>কামৰূপ ( Kamrup )</option>
										<option value='33'>নগাওঁ ( Nagaon )</option>
										<option value='14'>গোলাঘাট ( Golaghat )</option>
										<option value='01'>কোকৰাঝাৰ (Kokrajhar)</option>
										<option value='02'>ধুবুৰী ( Dhubri )</option>
										<option value='03'>গোৱালপাৰা ( Goalpara )</option>
										<option value='05'>বৰপেটা ( Barpeta )</option>
										<option value='13'>বঙাইগাঁও ( Bongaigaon )</option>
										<option value='15'>যোৰহাট ( Jorhat )</option>
										<option value='17'>ডিব্ৰুগড় ( Dibrugarh )</option>
										<option value='21'>করিমগঞ্জ ( Karimganj )</option>
										<option value='24'>কামৰূপ মহানগৰ ( Kamrup Metro )</option>
										<option value='32'>মৰিগাওঁ ( Morigaon )</option>
										<option value='36'>হোজাই ( Hojai )</option>
										<option value='38'>দক্ষিণ শালমাৰা ( South Salmara )</option>
										<option value='39'>বজালী ( Bajali )</option>
										<option value='22'>Hailakandi</option>
										<option value='23'>Cachar</option>
										<option value='27'>Udalguri</option>
										<option value='12'>লক্ষীমপূৰ ( Lakhimpur )</option>
										<option value='16'>শিৱসাগৰ ( Sibsagar )</option>
										<option value='18'>তিনিচুকীয়া ( Tinsukia )</option>
										<option value='34'>মাজুলী ( Majuli )</option>
										<option value='37'>চৰাইদেউ ( Charaideo )</option>
										<option value='11'>শোণিতপুৰ ( Sonitpur )</option>
										<option value='25'>ধেমাজি ( Dhemaji )</option>
										<option value='35'>বিশ্বনাথ ( Biswanath )</option>
									</select>
									<span class="text-danger"><?php echo form_error('dist_code'); ?></span>
								</div>
							</div>
							<!-- <div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span> Select Sub Division :</label>
								</div>
								<div class="col-sm-8">
									<select class="form-control subdivselect1 reset" name='subdiv_code'>
										<option value='0'>Select</option>
									</select>
									<span class="text-danger"><?php echo form_error('subdiv_code'); ?></span>
								</div>
							</div> -->
							<div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span> Select Circle :</label> :
								</div>
								<div class="col-sm-8">
									<select class="form-control circleselect1 reset" name='cir_code'>
										<option value='0'>Select</option>
									</select>
									<span class="text-danger"><?php echo form_error('cir_code'); ?></span>
								</div>
							</div>
							<!-- <div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span> Select Mouza :</label>
								</div>
								<div class="col-sm-8">
									<select class="form-control mouzaselect1 reset" name='mouza_code'>
										<option value='0'>Select</option>
									</select>
									<span class="text-danger"><?php echo form_error('mouza_code'); ?></span>
								</div>
							</div> -->

							<!-- <div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span> Select Lot :</label>
								</div>
								<div class="col-sm-8">
									<select class="form-control lotselect1 reset" name='lot_code'>
										<option value='0'>Select Lot</option>
									</select>
									<span class="text-danger"><?php echo form_error('lot_code'); ?></span>
								</div>
							</div> -->
							
						</div>
						<div class="card-footer text-center">
							<button type="submit" id="report_form_submit" class="btn btn-success">Fetch Village List</button>
						</div>
                            <div id="village_list">
                            </div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script>

$(document).ready(function (e) {
    var baseurl = "<?php echo base_url(); ?>";
    
    $('.dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel',
        ]
    });


$('.districtselect1').change(function (e) {
        var distCode = $(this).val();
        $.ajax({
            url: baseurl + "AdlrReportController/getCircleJson/" + distCode,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var circode = JSON.parse(data);
                var template = "<option selected disabled>Select Circle</option>"
                for (var i = 0; i < circode.length; i++) {
                    template += "<option value='" + circode[i].cir_code + "_" + circode[i].subdiv_code + "'>" + circode[i].loc_name + "</option>"
                }
                $('.circleselect1').html(template);
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load Circle..!');
            }
        });
    });


$('#report_form_submit').on('click', () => {

        var dist_code = $('.districtselect1').val();
        var subdivCir = $('.circleselect1').val();

		if (dist_code === null || subdivCir === null) {
			alert("Please Select District and Circle !!!");
			return;
		}

        var parts = subdivCir.split("_");
        var cir_code = parts[0]; 
        var subdiv_code = parts[1]; 

        $.blockUI({
            message: $('#displayBox'),
            css: {
                border:'none',
                backgroundColor:'transparent'
            }
        });
        $.ajax({
            url: baseurl + "AdlrReportController/viewReportDetails" ,
            type: "POST",
            data : {dist_code : dist_code , subdiv_code : subdiv_code,cir_code : cir_code},
            error: function() {
                $.unblockUI();
                Swal.fire({
                    title: "Failed",
                    text: "Error",
                    icon: "warning",
                    timer: 50000
                });
            },
            
            success: function(data) {
                $.unblockUI();
                $("#village_list").html(data); 
            }
        });
});

});





</script>

