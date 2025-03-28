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

		<?php echo form_open('DepartmentController/history', array("class" => "form-horizontal")); ?>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 offset-2">
					<div class="bg-white shadow-lg rounded p-2 card-info">
						<div class="card-header text-danger text-bold">
							<h6>Login History Details</h6>
						</div>
						<div class="card-body">
							<div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span>User Type :</label>
								</div>
								<div class="col-sm-8">
									<select class="form-control user_type1" name="user_type" required>
										<option disabled selected value='0'>Select User Type</option>
										<option value="C">CO</option>
										<option value="L">LM</option>
										<!--                    <option value="D">ADC/DC</option>-->
									</select>
									<span class="text-danger"><?=form_error('user_type')?></span>
								</div>
							</div>
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
							<div class="row pt-2">
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
							</div>
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
							<div class="row pt-2">
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
							</div>

							<div class="row pt-2">
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
							</div>

							<div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span> User List :</label>
								</div>
								<div class="col-sm-8">
									<select class="form-control users reset" name='users' required>
										<option value='0'>Select User</option>
									</select>
								</div>
							</div>
							<div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span> Date From :</label>
								</div>
								<div class="col-sm-8">
									<input type="date" name="from_date" class="form-control date_history"
										   placeholder="Select Start Date" max="<?= date('Y-m-d'); ?>" required>
									<span class="text-danger"><?php echo form_error('from_date'); ?></span>
								</div>
							</div>
							<div class="row pt-2">
								<div class="col-sm-4">
									<label class="mb-0 mt-1 font-weight-normal">
										<span class="text-danger">*</span> Date Upto </label>
								</div>
								<div class="col-sm-8">
                                                                    <input type="date" name="upto_date" class="form-control date_history"
                                                                      placeholder="Select End Date" max="<?= date('Y-m-d'); ?>" required>
							 	    <span class="text-danger"><?php echo form_error('upto_date'); ?></span>
								</div>
							</div>
						</div>
						<div class="card-footer text-center">
							<button type="submit" id="history_form_submit" class="btn btn-success">Check Records</button>
						</div>
						<?=form_close()?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/department.js'); ?>"></script>

