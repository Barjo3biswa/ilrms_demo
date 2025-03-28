 var baseurl = 'https://basundhara.assam.gov.in/ilrmsdemo/'


$('.lotselect').change(function (e) {
    var subdivcode = $('#subdiv_code').val();
    var distcode = $('#dist_code').val();
    var circode = $('#cir_code').val();
    var mouzacode = $('#mouza_code').val();
    var lotcode = $(this).val();
    $.ajax({
        url: baseurl + "jamaWasilController/getVillageCodeJSON/" + distcode + '/' + subdivcode + '/' + circode + "/" + mouzacode + "/" + lotcode,
        success: function (data) {
            var lot = JSON.parse(data);
            var template = "<option selected disabled>--SELECT-VILLAGE--</option>";

            for (var i = 0; i < lot.length; i++) {
                template += "<option value='" + lot[i].vill_townprt_code + "'>" + lot[i].loc_name + "</option>";
            }
            console.log(template);
            $('.villageselect').html(template);
        }
    });
});
