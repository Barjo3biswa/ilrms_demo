<style>
    .dataTables_filter{
        margin-bottom: 20px; /* Table Filter Margin */
    }
</style>

<div class="p-2 bg-success text-center text-white h5 shadow-sm border border-white rounded"><b>Notified Villages</b></div>

<div class="container-fluid">
    <div class="dash_content_area">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <table class="table" id='dataTable'>
                    <thead class="mt-3">
                    <tr class="bg-gradient-success">
                        <th style="text-align: center;">District</th>
                        <th style="text-align: center;">Sub-Division</th>
                        <th style="text-align: center;">Circle</th>
                        <th style="text-align: center;">Mouza</th>
                        <th style="text-align: center;">Lot No</th>
                        <th style="text-align: center;">Village</th>
                        <th style="text-align: center;">View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($villages as $village): ?>
                        <tr>
                            <td style="text-align: center;"><?=$this->utilclass->getDistrictName($village->dist_code)?></td>
                            <td style="text-align: center;"><?=$this->utilclass->getSubDivName($village->dist_code, $village->subdiv_code)?></td>
                            <td style="text-align: center;"><?=$this->utilclass->getCircleName($village->dist_code, $village->subdiv_code, $village->cir_code)?></td>
                            <td style="text-align: center;"><?=$this->utilclass->getMouzaName($village->dist_code, $village->subdiv_code, $village->cir_code, $village->mouza_pargona_code)?></td>
                            <td style="text-align: center;"><?=$this->utilclass->getLotName($village->dist_code, $village->subdiv_code, $village->cir_code, $village->mouza_pargona_code, $village->lot_no)?></td>
                            <td style="text-align: center;"><?=$this->utilclass->getVillageName($village->dist_code, $village->subdiv_code, $village->cir_code, $village->mouza_pargona_code, $village->lot_no, $village->vill_townprt_code)?></td>
                            <td style="text-align: center;">
                                <a class="btn btn-sm btn-info text-white" href=<?=base_url('index.php/nc_village/NcDlrController/getPendingVillage?application_no=') . $village->application_no . '&d=' . $village->dist_code?>> View <i class=" fa fa-chevron-right"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>

            </div> <!---// end of class row ---->
        </div> <!---// end of class col-lg-12 col-md-12 col-sm-12 col-xs-12 ---->
    </div> <!---// end of class dash_content_area ---->
</div> <!---// end of class container-fluid ---->

<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "pageLength": 50,
            "order": [1, "asc"],
            'language': {
                "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
            },
            "autoWidth": false,
            "deferRender": true,
            initComplete: function () {
                this.api()
                    .columns([0,1,2,3,4,5])
                    .every(function () {
                        var column = this;
                        var select = $('<select><option value=""> Show All</option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                    });
            },
        });
    });
</script>