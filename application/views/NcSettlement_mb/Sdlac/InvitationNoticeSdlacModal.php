<!-- View Minutes Modal -->
<div class="modal fade" id="viewProposalMinutesSdlacModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title text-primary">Meeting Notice Proposal No :<span></span></h4>
            </div>
            <input type="text" class="form-control" id="meeting_proposal_id">
            <div class="modal-body">
                Minutes Against Case
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- Minutes Modal End -->



<script>
       $(document).on('click', '#searchZonalDetailsModalYes', function() {

        const applicant = {
            villageName: $("#village_name_search").val(),
            dagNo: $("#dag_no_search").val(),
        };

        console.log(applicant);

        $.ajax({
            url: '<?php echo base_url() . "index.php/ZoneInformationController/searchZonalValueByDag" ?>',
            type: "post",
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data.responseType == 1) {
                    showWarningMessage(data.message);
                } else if (data.responseType == 2) {

                    $('#searchProIdModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    var table = '';
                    var sl = 1;
                    $.each(data.proposalIds, function(i, val) {

                        table +=
                         '<div class ="container bg-yellow">' +
                            '<div class ="">' +
                            '<span class=" mr-2" style="font-size: 20px">' + 'Zone: ' +  val.zone_code + '</span>' +
                             '<span class=" ml-2" style="font-size: 20px">' + 'Subclass: ' +  val.subclass_code + '</span>' +
                            '</div>' +
                            '<div class ="">' +
                            '<span style="font-size: 20px; color: blue">' + 'Zonal Value : '  +'Rs. '+ val.land_rate + '</span>' +
                            '</div>' +
                           '</div>' ;
                        sl = sl + 1;
                    });
                    $('#zonalValueSearchTableTbody').html(table);
                } else if (data.responseType == 3) {
                    $('#searchProIdModal').modal('hide');
                    showErrorMessage("Data not found !");
                } else {
                    showErrorMessage("SOMETHING WENT WRONG");
                }
            },
            data: JSON.stringify(applicant)

        });
    });
</script>