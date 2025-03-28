<div class="my-5">
    <div class="col-6 m-auto bg-white p-0 rounded">
        <?php if($this->session->flashdata('message')){
            echo "<div class='bg-danger p-2 my-3 rounded center' style='font-size: 18px; color: white'>".$this->session->flashdata('message')."</div>";
        }?>
        <div class="card-header bold">
            Case Search
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url();?>index.php/DepartmentController/getCaseDetails">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select District
                        <span style="color: red">*</span></label>
                    <select class="form-control" name="dist_code" required>
                        <option disabled selected>---Select District---</option>
                        <option value='10'>ছিৰাং ( Chirang )</option>
                        <option value='06'>নলবাৰী ( Nalbari )</option>
                        <option value='08'>দৰং ( Darrang )</option>
                        <option value='07'>কামৰূপ ( Kamrup )</option>
                        <option value='33'>নগাওঁ ( Nagaon )</option>
                        <option value='14'>গোলাঘাট ( Golaghat )</option>
                        <option value='01'>কোকৰাঝাৰ (Kokrajhar)</option>
                        <option value='02'>ধুবুৰী ( Dhubri )</option>
                        <option value='03'>গোৱালপাৰা ( Goalpara )</option>
                        <option value='05'>বৰপেটা  ( Barpeta )</option>
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
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Service Type
                        <span style="color: red">*</span></label>
                    <select class="form-control" name="case_type" required>
                        <option selected disabled> ---Select Service Type---</option>
                        <option value="field"> Field Mutation/Partition Case</option>
                        <option value="office"> Office Mutation/Partition Case</option>
                        <option value="conv"> Conversion Case</option>
                        <option value="RC"> Reclassification</option>
                        <option value="MI"> Misc Case</option>
                        <option value="AL"> Allotment</option>
                        <option value="NR"> NR Case</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Case No <span style="color: red">*</span> </label>
                    <input type="text" name="case_no" class="form-control"
                           placeholder="Enter Case No" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary rounded p-1">View Case Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>application/views/js/department.js"></script>