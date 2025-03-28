<!-- -js- 29-aug-2022 -->
<?php if ($vlb_enc) { ?>
    <div class="container bg-white p-4">
        <div class="row justify-content-center">
            <span class="alert alert-info text-danger col-md-8 text-center">
                <strong>
                    <u>
                        Land Bank Details for - Village/Town:
                        <?= $this->utilclass->getDistrictName($vlb_enc->dist_code) ?>,
                        Year:
                        <?= $vlb_enc->year ?>, Dag-No:
                        <?= $vlb_enc->dag_no ?>
                    </u>
                </strong>
            </span>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <!-- table VLB -->
                <table class="table table-bordered">

                    <tr>
                        <th>Type of Govt. Land</th>
                        <td class="text-center">
                            <?php
                            foreach (json_decode(LB_NATURE_OF_RESERVATION) as $land_nature) {
                                if ($land_nature->CODE == $vlb_enc->nature_of_reservation) {
                                    echo $land_nature->NAME;
                                }
                            }
                            ?>
                        </td>

                        <th>Whether Encroached</th>
                        <td class="text-center">
                            <?php
                            if ($vlb_enc->whether_encroached == 'Y') {
                                echo "Yes";
                            } else {
                                echo "No";
                            } ?>
                        </td>
                        
                    </tr>

    

                    <tr>
                        <th class="text-danger">Encroached Area</th>
                        <td>
                            <strong class="input-group-addon p-2"><?= $vlb_enc->en_area_b ?></strong><span class="input-group-addon">Bigha</span>
                        </td>
                        <td>
                            <strong class="input-group-addon p-2"><?= $vlb_enc->en_area_k ?></strong><span class="input-group-addon">Katha</span>
                        </td>
                        <td>
                            <strong class="input-group-addon p-2"><?= $vlb_enc->en_area_lc ?></strong><span class="input-group-addon">Lessa</span>
                        </td>
                        <?php if ((in_array($vlb_enc->dist_code, BARAK_VALLEY))) : ?>

                            <td>
                                <strong class="input-group-addon p-2"><?= $vlb_enc->en_area_g ?></strong><span class="input-group-addon">Ganda</span>
                            </td>
                            <td>
                                <strong class="input-group-addon p-2"><?= $vlb_enc->en_area_kr ?></strong><span class="input-group-addon">Kranti</span>
                            </td>
                        <?php endif; ?>
                    </tr>
                </table>
                <!-- table VLB end -->
         
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th colspan="12" class="text-center">Encroacher Details</th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Father's Name</th>
                <th>Gender</th>
                <th>Encroached From</th>
                <th>Encroached To</th>
                <th>Landless Indigenous</th>
                <th>Landless</th>
                <th>Caste</th>
                <th>Erosion Affected</th>
                <th>Landslide Prone</th>
                <th>Type of Land Use</th>
            </tr>
            <?php
            foreach ($vlb_enc_details as $data) :
            ?>
                <tr>
                    <td><?= $data->name ?></td>
                    <td><?= $data->fathers_name ?></td>
                    <td>
                        <?php if ($data->gender == '1') {
                            echo "Male";
                        } elseif (
                            $data->gender ==
                            '2'
                        ) {
                            echo "Female";
                        } ?>
                    </td>
                    <td><?= $data->encroachment_from ?></td>
                    <td><?= $data->encroachment_to ?></td>
                    <td>
                        <?php if ($data->landless_indigenous == 'Y') {
                            echo "Yes";
                        } else {
                            echo
                            "No";
                        } ?>
                    </td>
                    <td><?php if ($data->landless == 'Y') {
                            echo "Yes";
                        } else {
                            echo "No";
                        } ?></td>
                    <td>
                        <?php
                        foreach (json_decode(CASTE) as $caste) {
                            if ($caste->CODE == $data->caste) {
                                echo $caste->NAME;
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php if ($data->erosion == 'Y') {
                            echo "Yes";
                        } elseif (
                            $data->erosion ==
                            'N'
                        ) {
                            echo "No";
                        } ?>
                    </td>
                    <td>
                        <?php if ($data->landslide == 'Y') {
                            echo "Yes";
                        } elseif (
                            $data->landslide
                            == 'N'
                        ) {
                            echo "No";
                        } ?>
                    </td>
                    <td>
                        <?php
                        foreach (json_decode(LB_ENC_TYPE_OF_LAND_USE) as $key) {
                            if ($data->type_of_land_use == $key->CODE) {
                                echo $key->NAME;
                            }
                        } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    </div>
<?php } else { ?>
    <div class="container bg-white p-4">
        <div class="row justify-content-center">
            <span class="alert alert-danger col-md-8 text-center">
                <strong>
                    <u>
                        <?= $empty_err ?>
                    </u>
                </strong>
            </span>
        </div>
    </div>
<?php } ?>