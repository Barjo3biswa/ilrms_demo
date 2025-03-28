<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/ol/ol.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/ol/ol.css') ?>">
<script src="<?php echo base_url('js/sweetalert2.all.min.js') ?>"></script>
<button id="loader2" class="btn btn-primary">
    <span class="spinner-border spinner-border-sm"></span>
    Loading..
</button>
<style>
    #loader2 {
        position: fixed;
        z-index: 999999;
        /* High z-index so it is on top of the page */
        top: 50%;
        right: 50%;
        /* or: left: 50%; */
        margin-top: -..px;
        /* half of the elements height */
        margin-right: -..px;
        /* half of the elements width */
    }
</style>
<script>
    function alpineData() {
        return {
            'villVector': '',
            'location': '',
            'application_no': '',
            'dist_code': '',
            'bigha': 1337.803776,
            'katha': 267.5607552,
            'lessa': 13.37803776,
            'dags': [],
            'chitha_dags': [],
            init() {
                var location = '<?= json_encode($location) ?>';
                var location = JSON.parse(location);
                this.location = location;
                this.application_no = <?= json_encode($application_no) ?>;
                this.dist_code = <?= json_encode($dist_code) ?>;
                var self = this;
                $.post("<?= base_url()?>index.php/nc_village/NcCommonMyController/viewBhunaksaMapPost", {
                    location: "<?= $location ?>"
                }, function(data) {
                    var format = new ol.format.GeoJSON();
                    var features = format.readFeatures(data);
                    if(features.length == 0)
                    {
                        swal.fire({
                            title: "The village map was not found on the Bhunaksha portal.",
                            icon: "info",
                        });
                    }
                    villVector = new ol.layer.Vector({  // Initialize within the callback
                        source: new ol.source.Vector({
                            format: format
                        }),

                        style: function (feature, resolution) {
                            var textValue = feature.get('kide'); // Get the text from the feature
                            var intValue = parseInt(textValue); // Convert to integer
                            var style = new ol.style.Style({
                                fill: new ol.style.Fill({
                                    color: 'rgba(201, 199, 77)'
                                }),
                                stroke: new ol.style.Stroke({
                                    color: '#17202A',
                                    width: 1
                                }),
                                text: new ol.style.Text({
                                    font: '12px Verdana',
                                    text: intValue.toString(),
                                    fill: new ol.style.Fill({color: 'black'}),
                                    stroke: new ol.style.Stroke({color: 'white', width: 0.5})
                                })

                            });
                            return [style];
                        }
                    });

                    villVector.getSource().addFeatures(features);  // Add features to initialized layer

                    map = new ol.Map({  // Initialize map after villVector
                        layers: [villVector],
                        target: 'map',
                        view: new ol.View({
                            zoom: 4,
                            minZoom: 0,
                            maxZoom: 100
                        })
                    });

                    map.getView().fit(villVector.getSource().getExtent(), {
                        size: map.getSize(),
                        maxZoom: 18  // Adjust the fit to not zoom in too much
                    });

                    // Create a popup overlay
                    popup = new ol.Overlay({
                        element: document.getElementById('popup'),
                        positioning: 'bottom-center',
                        stopEvent: false,
                        offset: [0, -10]
                    });
                    map.addOverlay(popup);

                    // Add hover event to show popup
                    map.on('pointermove', function(evt) {
                        var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                            return feature;
                        });

                        if (feature) {
                            var coordinates = feature.getGeometry().getCoordinates();
                            var textValue = feature.get('kide'); // Get the text from the feature
                            var intValue = parseInt(textValue); // Convert to integer
                            var areaValue = parseFloat(feature.get('Area')).toFixed(4); // Format to 4 decimal places
                            var content = "Dag No: " + intValue + "<br>Area (sq Meter): " + areaValue;
                            $(popup.getElement()).popover('dispose');
                            $(popup.getElement()).popover({
                                placement: 'top',
                                html: true,
                                content: content
                            });
                            popup.setPosition(evt.coordinate);
                            $(popup.getElement()).popover('show');
                        } else {
                            $(popup.getElement()).popover('dispose');
                        }
                    });
                });

                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonMyController/getBhunaksaMapDags',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'location':self.location,
                    },
                    success: function(data2) {
                        self.dags = data2.plotInfo;
                    }
                });

                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonMyController/getChithaDags',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code':self.dist_code,
                        'application_no':self.application_no,
                    },
                    success: function(data3) {
                        self.chitha_dags = data3;
                        $('#loader2').addClass('invisible');
                    }
                });
            },
            convertSqMeter(b,k,l)
            {
                var self = this;
                var bigha_sq_m = self.bigha*b;
                var katha_sq_m = self.katha*k;
                var lessa_sq_m = self.lessa*l;
                return total_sqm=parseFloat(bigha_sq_m+katha_sq_m+lessa_sq_m).toFixed(4);
            }
        }
    }
</script>
<style>
    #map {
        width: 100%;  /* or a specific pixel width like 600px */
        height: 800px;  /* or any height you prefer */
    }
</style>
<div x-data="alpineData()">
    <div id="popup"></div>
    <table class="table table-striped table-bordered">
        <thead>
        <th class="text-center" colspan="6" style="background-color: #136a6f; color: #fff">
            Map Details
        </th>
        </thead>
        <tbody>
        <tr>
            <td width="20%">Village Name</td>
            <td width="20%" style="color:red"><?=$data['vill_name']?></td>
            <td width="15%">Total Dags</td>
            <td width="15%" style="color:red"><?=$data['dags']?></td>
            <td width="15%">Area (sq km)</td>
            <td width="15%" style="color:red"><?= $data['area']?></td>
        </tr>
        </tbody>
    </table>
<div class="border border-primary m-2">
<div id="map"></div>
</div>
    <div class="m-2">

    <table class="table table-striped table-bordered">
        <tr>
            <td width="50%">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="6" style="background-color: #136a6f; color: #fff">
                            Chitha Dags Details
                        </th>
                    </tr>
                    <tr>
                        <th width="10%">#</th>
                        <th width="30%" >Dag No.</th>
                        <th width="60%">Dag Area (Square Meter)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template x-for="(cdag,indexc) in chitha_dags" :key="indexc">
                        <tr>
                            <td x-text="++indexc"></td>
                            <td x-text="Math.round(cdag.dag_no)"></td>
                            <td x-text="convertSqMeter(cdag.dag_area_b,cdag.dag_area_k,cdag.dag_area_lc)"></td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </td>
            <td width="50%">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="6" style="background-color: #136a6f; color: #fff">
                        Bhunaksha Dags Details
                        </th>
                    </tr>
                    <tr>
                        <th width="10%">#</th>
                        <th width="30%" >Dag No.</th>
                        <th width="60%">Dag Area (Square Meter)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template x-for="(dag,index) in dags" :key="index">
                        <tr>
                            <td x-text="++index"></td>
                            <td x-text="Math.round(dag.plotNo)"></td>
                            <td x-text="parseFloat(dag.plotArea).toFixed(4)"></td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    </div>
</div>