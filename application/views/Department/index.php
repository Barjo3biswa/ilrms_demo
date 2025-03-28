<div class='container' style="margin-top:10px">

    <div class="bg-white">
        <div class="text-white bg-primary p-2 mb-2 rounded text-center" style="font-size: 18px;">
            Case wise Details
        </div>
        <div class="card-body">
            <div class='col-lg-12'>
                <?php echo form_open('location/add', array("class" => "form-horizontal")); ?>
                <div class="form-group">
                    <label for="loc_name" class="col-md-4 control-label"><span class="text-danger">*</span> District
                        Name</label>
                    <div class="col-md-8">
                        <select name="district" class="form-control">
                            <option value="" selected="true">--- Select District ---</option>
                            <?php foreach($location as $loc): ?>
                                <option value='<?=$loc['dist_code']?>'><?=$loc['loc_name']?></option>
                            <?php endforeach; ?>
<!--                            <option value="golaghat_test"> Golaghat</option>-->
<!--                            <option value="kamrup"> Kamrup</option>-->
                            <!-- <option value="05"> Barpeta </option>
                            <option value="Biswanath"> Biswanath </option>
                            <option value="Bongaigaon"> Bongaigaon </option>
                            <option value="Charaideo"> Charaideo </option>
                            <option value="Chirang"> Chirang </option>
                            <option value="Darrang"> Darrang </option>
                             <option value="Dhemaji"> Dhemaji </option>
                            <option value="Dhubri"> Dhubri </option>
                            <option value="Dibrugarh"> Dibrugarh </option>
                            <option value="Goalpara"> Goalpara </option>
                            <option value="Hojai"> Hojai </option>
                            <option value="Jorhat"> Jorhat </option>
                            <option value="KamrupMetro"> KamrupMetro </option>
                            <option value="Karimganj"> Karimganj </option>
                            <option value="Lakhimpur"> Lakhimpur </option>
                            <option value="Majuli"> Majuli </option>
                            <option value="Morigaon"> Morigaon </option>
                            <option value="Nagaon"> Nagaon </option>
                            <option value="Nalbari"> Nalbari </option>
                            <option value="Sibsagar"> Sibsagar </option>
                            <option value="Sonitpur"> Sonitpur </option>
                            <option value="SouthSalmara"> SouthSalmara </option>
                            <option value="Tinsukia"> Tinsukia </option>
                            <option value="Kokrajhar"> Kokrajhar </option> -->

                        </select>
                        <span class="text-danger"><?php echo form_error('district'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="locname_eng" class="col-md-4 control-label"><span class="text-danger">*</span> Service
                        Type</label>
                    <div class="col-md-8">
                        <select name="service_type" class="form-control">
                            <option value="" selected="true">--- Select District ---</option>
                            <option value="field"> Field Case</option>
                            <option value="office"> Office Case</option>
                            <option value="reclass"> Reclassification</option>
                            <option value="misc"> Misc Case</option>
                            <option value="allotment"> Allotment</option>
                        </select>
                        <span class="text-danger"><?php echo form_error('service_type'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dist_abbr" class="col-md-4 control-label"><span class="text-danger">*</span> Case Number</label>
                    <div class="col-md-8">
                        <input type="text" name="dist_code" value="<?php echo $this->input->post('dist_code'); ?>"
                               class="form-control" id="dist_code"/>
                        <span class="text-danger"><?php echo form_error('dist_code'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-success">Check Records</button>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="px-3 pb-3">
            <a href='<?php echo base_url(); ?>location'><button type="button" class="btn btn-info">Go Back</button></a>
        </div>
    </div>
</div>