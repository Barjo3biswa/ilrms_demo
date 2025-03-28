$(document).ready(function (e) {
    //var baseurl = "http://10.177.15.206/location/";
    var baseurl = "http://141.148.207.152/ilrmsdemo/";
    $('.dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel',
        ]
    });

    $('.user_type1').prop('selectedIndex', 0);
    $('.districtselect1').prop('selectedIndex', 0);

    $('.user_type1').change(function (e) {
        $('.reset').prop('selectedIndex', 0);
    });
    $('.districtselect1').change(function (e) {
        var distCode = $(this).val();
        $.ajax({
            url: baseurl + "Location/getSubdivJson/" + distCode,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var subdivcode = JSON.parse(data);
                var template = "<option selected disabled>Select Sub Division</option>"
                for (var i = 0; i < subdivcode.length; i++) {
                    template += "<option value='" + subdivcode[i].subdiv_code + "'>" + subdivcode[i].loc_name + "</option>"
                }
                $('.subdivselect1').html(template);
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load Sub Division..!');
            }
        });
        dcadcCall();
    });
    $('.subdivselect1').change(function (e) {
        var subdivcode = $(this).val();
        var distcode = $('.districtselect1').val();
        $.ajax({
            url: baseurl + "Location/getCirCodeJson/" + distcode + '/' + subdivcode,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var circode = JSON.parse(data);
                var template = "<option selected disabled>Select Circle</option>";

                for (var i = 0; i < circode.length; i++) {
                    template += "<option value='" + circode[i].cir_code + "'>" + circode[i].loc_name + "</option>";
                }
                $('.circleselect1').html(template);
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load Circle..!');
            }
        });
    });

    $('.circleselect1').change(function (e) {
        var subdivcode = $('.subdivselect1').val();
        var distcode = $('.districtselect1').val();
        var circode = $(this).val();
        $.ajax({
            url: baseurl + "Location/getMouzaJson/" + distcode + '/' + subdivcode + '/' + circode,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var mouza = JSON.parse(data);
                var template = "<option selected disabled>Select Mouza</option>";

                for (var i = 0; i < mouza.length; i++) {
                    template += "<option value='" + mouza[i].mouza_pargona_code + "'>" + mouza[i].loc_name + "</option>";
                }
                $('.mouzaselect1').html(template);
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load Mouza..!');
            }
        });
        coCall();
    });

    $('.mouzaselect1').change(function (e) {
        var subdivcode = $('.subdivselect1').val();
        var distcode = $('.districtselect1').val();
        var circode = $('.circleselect1').val();
        var mouzacode = $(this).val();
        $.ajax({
            url: baseurl + "Location/getLotNoJSON/" + distcode + '/' + subdivcode + '/' + circode + "/" + mouzacode,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var lot = JSON.parse(data);
                var template = "<option selected disabled>Select Lot</option>";

                for (var i = 0; i < lot.length; i++) {
                    template += "<option value='" + lot[i].lot_no + "'>" + lot[i].loc_name + "</option>";
                }
                $('.lotselect1').html(template);
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load Lot..!');
            }
        });
    });

    $('.lotselect1').change(function (e) {
        var subdivcode = $('.subdivselect1').val();
        var distcode = $('.districtselect1').val();
        var circode = $('.circleselect1').val();
        var mouzacode = $('.mouzaselect1').val();
        var lot_no = $(this).val();
        $.ajax({
            url: baseurl + "Location/getlmUser/" + distcode + '/' + subdivcode + '/' + circode + "/" + mouzacode + "/" + lot_no,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var users = JSON.parse(data);
                var template = "<option selected disabled>Select User</option>"
                for (var i = 0; i < users.length; i++) {
                    template += "<option value='" + users[i].user_code + "'>" + users[i].user_name + '(' + users[i].user_code + ')' + "</option>"
                }
                $('.users').html(template);
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load User..!');
            }
        });
    });

    $('.user_type1').change(function () {
        if ($(this).val() == "D") {
            $(".subdivselect1").prop("disabled", true);
            $(".circleselect1").prop("disabled", true);
            $(".mouzaselect1").prop("disabled", true);
            $(".lotselect1").prop("disabled", true);
        } else if ($(this).val() == "C") {
            $(".subdivselect1").prop("disabled", false);
            $(".circleselect1").prop("disabled", false);
            $(".mouzaselect1").prop("disabled", true);
            $(".lotselect1").prop("disabled", true);
        } else if ($(this).val() == "L") {
            $(".subdivselect1").prop("disabled", false);
            $(".circleselect1").prop("disabled", false);
            $(".mouzaselect1").prop("disabled", false);
            $(".lotselect1").prop("disabled", false);
        }
    });

    function dcadcCall() {
        var distCode = $('.districtselect1').val();
        $.ajax({
            url: baseurl + "Location/getDcAdcUser/" + distCode,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var users = JSON.parse(data);
                var template = "<option selected disabled>Select User</option>"
                for (var i = 0; i < users.length; i++) {
                    template += "<option value='" + users[i].user_code + "'>" + users[i].user_name + '(' + users[i].user_code + ')' + "</option>"
                }
                $('.users').html(template);
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load User..!');
            }
        });
    };

    function coCall() {
        var distCode = $('.districtselect1').val();
        var subCode = $('.subdivselect1').val();
        var cirCode = $('.circleselect1').val();
        $.ajax({
            url: baseurl + "Location/getcoUser/" + distCode + '/' + subCode + '/' + cirCode,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var users = JSON.parse(data);
                console.log(users);
                var template = "<option selected disabled>Select User</option>"
                for (var i = 0; i < users.length; i++) {
                    template += "<option value='" + users[i].user_code + "'>" + users[i].user_name + '(' + users[i].user_code + ')' + "</option>"
                }
                $('.users').html(template);
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load User..!');
            }
        });
    };
});
