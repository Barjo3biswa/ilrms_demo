var baseurl = $('#base_url').val();

$(document).ready(function() {
    $('.js-single').select2();
});

function lotOnChange() {
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border: 'none',
            backgroundColor: 'transparent'
        }
    });

    $('#village').empty();
    $('#village').append('<option value="00" selected>-VILLAGE-</option>');

    var book_no = $('#book_no').val();
    if (!book_no || book_no == 0) {
        $.unblockUI();
        alert("Please Enter Book Number");
        return;
    }
    var page_no = $('#page_no').val();
    if (!page_no || page_no == 0) {
        $.unblockUI();
        alert("Please Enter Page Number");
        return;
    }
    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_pargona_code = $('#mouza_pargona_code').val();
    var lot_no = $('#lot_no').val();

    if (subdiv_code == '00') {
        $.unblockUI();
        alert("Please select a Subdivision...!!");
        return;
    }
    if (cir_code == '00') {
        $.unblockUI();
        alert("Please select a Circle...!!");
        return;
    }
    if (mouza_pargona_code == '00') {
        $.unblockUI();
        alert("Please select a Mouza...!!");
        return;
    }
    if (lot_no == '00') {
        $.unblockUI();
        alert("Please select a Mouza...!!");
        return;
    }

    const application = {
        dist_code: dist_code,
        subdiv_code: subdiv_code,
        cir_code: cir_code,
        mouza_pargona_code: mouza_pargona_code,
        lot_no: lot_no,
    };

    $.ajax({
        url: baseurl + "/EkhajanaMouzadarCfr/getVillageList",
        type: 'POST',
        data: JSON.stringify(application),
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            $.unblockUI();
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                $('#village').append('<option value="' + data[i].vill_townprt_code + '">' + data[i].loc_name + '</option>');
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!'); 
        }
    });
}

function VillageOnChange() {
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border: 'none',
            backgroundColor: 'transparent'
        }
    });

    $('#patta_type_code').empty();
    $('#patta_type_code').append('<option value="00" selected>-PATTA-TYPE-</option>');

    const application = {};

    $.ajax({
        url: baseurl + "/EkhajanaMouzadarCfr/getPattaTypes",
        type: 'POST',
        data: JSON.stringify(application),
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            $.unblockUI();
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                $('#patta_type_code').append('<option value="' + data[i].type_code + '">' + data[i].patta_type + '</option>');
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!'); 
        }
    });
}

function PattaTypeOnChange() {
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border: 'none',
            backgroundColor: 'transparent'
        }
    });

    $('#patta_no').empty();
    $('#patta_no').append('<option value="00" selected>-PATTA-NUMBER-</option>');

    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_pargona_code = $('#mouza_pargona_code').val();
    var lot_no = $('#lot_no').val();
    var vill_townprt_code = $('#village').val();

    const application = {
        dist_code: dist_code,
        subdiv_code: subdiv_code,
        cir_code: cir_code,
        mouza_pargona_code: mouza_pargona_code,
        lot_no:lot_no,
        vill_townprt_code:vill_townprt_code
    };

    $.ajax({
        url: baseurl + "/EkhajanaMouzadarCfr/allPattaNumbers",
        type: 'POST',
        data: JSON.stringify(application),
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            $.unblockUI();
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                $('#patta_no').append('<option value="' + data[i].patta_no + '">' + data[i].patta_no + '</option>');
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!'); 
        }
    });
}

function PattaNumberOnChange() {
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border: 'none',
            backgroundColor: 'transparent'
        }
    });

    $('#pdar_id_kpph').empty();
    $('#pdar_id_kpph').append('<option value="00" selected>--কাৰ পৰা পোৱা হল--</option>');

    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_pargona_code = $('#mouza_pargona_code').val();
    var lot_no = $('#lot_no').val();
    var vill_townprt_code = $('#village').val();
    var patta_type_code = $('#patta_type_code').val();
    var patta_no = $('#patta_no').val();

    const application = {
        dist_code: dist_code,
        subdiv_code: subdiv_code,
        cir_code: cir_code,
        mouza_pargona_code: mouza_pargona_code,
        lot_no:lot_no,
        vill_townprt_code:vill_townprt_code,
        patta_type_code:patta_type_code,
        patta_no:patta_no
    };

    $.ajax({
        url: baseurl + "/EkhajanaMouzadarCfr/getPattadars",
        type: 'POST',
        data: JSON.stringify(application),
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            $.unblockUI();
            console.log(data);
            $('#pdar_id_kpph').append('<option value="NA">NA</option>');
            for (var i = 0; i < data.length; i++) {                
                $('#pdar_id_kpph').append('<option value="' + data[i].pdar_id + '">' + data[i].pdar_name + '</option>');
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!'); 
        }
    });
}

function pattadarKPPHonChnage(){
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border: 'none',
            backgroundColor: 'transparent'
        }
    });
    
    const selectedValue = $('#pdar_id_kpph').val();
    if (selectedValue === 'NA') {
        $('#pdar_id_kpph_name_container').html('<input type="text" id="pdar_id_kpph_name" class="form-control" placeholder="-Enter (কাৰ বাবে পোৱা হল)-">');
        $.unblockUI();
    } else {
        $('#pdar_id_kpph_name_container').empty();
    }

    // Trigger changes for pdar_id_kbph dropdown if necessary
    $('#pdar_id_kbph').empty().append('<option value="00" selected>--কাৰ বাবে পোৱা হল--</option>');

    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_pargona_code = $('#mouza_pargona_code').val();
    var lot_no = $('#lot_no').val();
    var vill_townprt_code = $('#village').val();
    var patta_type_code = $('#patta_type_code').val();
    var patta_no = $('#patta_no').val();

    const application = {
        dist_code: dist_code,
        subdiv_code: subdiv_code,
        cir_code: cir_code,
        mouza_pargona_code: mouza_pargona_code,
        lot_no: lot_no,
        vill_townprt_code: vill_townprt_code,
        patta_type_code: patta_type_code,
        patta_no: patta_no
    };

    $.ajax({
        url: baseurl + "/EkhajanaMouzadarCfr/getPattadars",
        type: 'POST',
        data: JSON.stringify(application),
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            $.unblockUI();
            $('#pdar_id_kbph').append('<option value="NA">NA</option>');
            for (var i = 0; i < data.length; i++) {
                $('#pdar_id_kbph').append('<option value="' + data[i].pdar_id + '">' + data[i].pdar_name + '</option>');
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not complete your request. Please try again later.');
        }
    });
}

function pattadarKBPHonChange(){
    const selectedValue = $('#pdar_id_kbph').val();
    if (selectedValue === 'NA') {
        $('#pdar_id_kbph_name_container').html('<input type="text" id="pdar_id_kbph_name" class="form-control" placeholder="-Enter (কাৰ বাবে পোৱা হল)-">');
    } else {
        $('#pdar_id_kbph_name_container').empty();
    }
    $('#add_more_buuton').show(200);
}

function isDuplicateEntry(data) {
    var isDuplicate = false;

    $("#land_details_table tbody tr").each(function () {
        var rowBookNo = $(this).find("input[name='book_no[]']").val();
        var rowPageNo = $(this).find("input[name='page_no[]']").val();
        var rowLotNo = $(this).find("input[name='lot_no[]']").val();
        var rowVillage = $(this).find("input[name='village[]']").val();
        var rowPattaTypeCode = $(this).find("input[name='patta_type_code[]']").val();
        var rowPattaNo = $(this).find("input[name='patta_no[]']").val();
        var rowPdarIdKpph = $(this).find("input[name='pdar_id_kpph[]']").val();
        var rowPdarIdKbph = $(this).find("input[name='pdar_id_kbph[]']").val();

        if (
            rowBookNo === data.book_no &&
            rowPageNo === data.page_no &&
            rowLotNo === data.lot_no &&
            rowVillage === data.village &&
            rowPattaTypeCode === data.patta_type_code &&
            rowPattaNo === data.patta_no &&
            rowPdarIdKpph === data.pdar_id_kpph &&
            rowPdarIdKbph === data.pdar_id_kbph
        ) {
            isDuplicate = true;
            return false; // Exit loop
        }
    });

    return isDuplicate;
}


function finalSubmit() {
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border: 'none',
            backgroundColor: 'transparent'
        }
    });

    var formData = new FormData();
    $("#land_details_table tbody tr").each(function () {
        $(this).find("input").each(function () {
            formData.append($(this).attr('name'), $(this).val());
        });
    });

    var fileInput = document.getElementById('uploadFile1');
    if (fileInput.files.length > 0) {
        formData.append('cfr_carbon_copy', fileInput.files[0]);
    } else {
        $.unblockUI();
        alert("Please upload the CFR Carbon Copy file.");
        return;
    }

    $.ajax({
        url: baseurl + "/EkhajanaMouzadarCfr/submitCfrDetails",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $.unblockUI();
            console.log(response);
            const data = JSON.parse(response);
            if (data.result === 'SERVER-ERROR') {
                alert(data.msg);
                return;
            }
            if (data.result === 'VALIDATION-ERROR') {
                alert(data.msg);
                return;
            }
            if (data.result === 'SUCCESS') {
                Swal.fire({
                    title: data.msg,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'BACK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = baseurl + "/EkhajanaMouzadarCfr/index";
                    }
                });
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not complete your request. Please try again later.');
            console.error(jqXHR, exception);
        }
    });
}


function onClickAddPatta() {
    var book_no = $('#book_no').val();
    if (!book_no || book_no === "00") {
        alert("Please Enter Book Number");
        return;
    }

    var page_no = $('#page_no').val();
    if (!page_no || page_no === "00") {
        alert("Please Enter Page Number");
        return;
    }

    var mouza_pargona_code = $('#mouza_pargona_code').val();
    if (mouza_pargona_code === "00") {
        alert("Please select a Mouza...!!");
        return;
    }

    var lot_no = $('#lot_no').val();
    if (lot_no === "00") {
        alert("Please select a Lot...!!");
        return;
    }

    var village = $('#village').val();
    if (village === "00" || village === "00000") {
        alert("Please select a Village...!!");
        return;
    }

    var patta_type_code = $('#patta_type_code').val();
    if (patta_type_code === "00") {
        alert("Please select a Patta Type...!!");
        return;
    }

    var patta_no = $('#patta_no').val();
    if (patta_no === "00") {
        alert("Please select a Patta Number...!!");
        return;
    }

    var pdar_id_kpph = $('#pdar_id_kpph').val();
    if (!pdar_id_kpph) {
        alert("Please Enter 'কাৰ পৰা পোৱা হল'");
        return;
    }

    if(pdar_id_kpph == 'NA'){
        var pdar_id_kpph_text = $('#pdar_id_kpph_name').val();
    }else{
        var pdar_id_kpph_text = $('#pdar_id_kpph option:selected').text();  // Get the text value
    }

    
    var pdar_id_kbph = $('#pdar_id_kbph').val();
    if (!pdar_id_kbph) {
        alert("Please Enter 'কাৰ বাবে পোৱা হল'");
        return;
    }

    if(pdar_id_kbph == 'NA'){
        var pdar_id_kbph_text = $('#pdar_id_kbph_name').val();
    }else{
        var pdar_id_kbph_text = $('#pdar_id_kbph option:selected').text();  // Get the text value
    }
    

    var formData = new FormData();
    formData.append("book_no", book_no);
    formData.append("page_no", page_no);
    formData.append("dist_code", $('#dist_code').val());
    formData.append("subdiv_code", $('#subdiv_code').val());
    formData.append("cir_code", $('#cir_code').val());
    formData.append("mouza_pargona_code", mouza_pargona_code);
    formData.append("lot_no", lot_no);
    formData.append("village", village);
    formData.append("patta_type_code", patta_type_code);
    formData.append("patta_no", patta_no);
    formData.append("pdar_id_kpph", pdar_id_kpph);
    formData.append("pdar_id_kpph_text", pdar_id_kpph_text);  // Pass the text value
    formData.append("pdar_id_kbph", pdar_id_kbph);
    formData.append("pdar_id_kbph_text", pdar_id_kbph_text);  // Pass the text value

    $.ajax({
        url: baseurl + "/EkhajanaMouzadarCfr/checkOfflineCollectedPattaDetails",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            if ($('#displayBoxEK').length > 0) {
                $.blockUI({
                    message: $('#displayBoxEK'),
                    css: {
                        border: 'none',
                        backgroundColor: 'transparent'
                    }
                });
            }
        },
        success: function (response) {
            $.unblockUI();
            const data = JSON.parse(response);
            if(data.result === "SUCCESS"){
                alert(data.msg);
                var formElement = document.getElementById('cfr_data');
                if (!formElement) {
                    alert("Form element not found!");
                    return;
                }

                var formDataObject = new FormData(formElement);
                var formObject = {};
                formDataObject.forEach((value, key) => {
                    formObject[key] = value;
                });

                var lot_name = $('#lot_no option:selected').text();
                var village_name = $('#village option:selected').text();
                var patta_type_name = $('#patta_type_code option:selected').text();
                formObject = {
                    ...formObject,
                    book_no: book_no,
                    page_no: page_no,
                    lot_name: lot_name,
                    village_name: village_name,
                    patta_type_name: patta_type_name,
                    lot_no: lot_no,
                    village: village,
                    patta_type_code: patta_type_code,
                    patta_no: patta_no,
                    pdar_id_kpph: pdar_id_kpph,
                    pdar_id_kpph_text: pdar_id_kpph_text,
                    pdar_id_kbph: pdar_id_kbph,
                    pdar_id_kbph_text: pdar_id_kbph_text
                };

                if (isDuplicateEntry(formObject)) {
                    alert("This entry already exists!");
                    return;
                }

                populateLandDetailsTable(formObject);
                $('#all_patta_table').show();
                $.unblockUI();
            } else if(data.result === "ERROR") {
                alert(data.msg);
            } else {
                alert("Unexpected response!");
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not complete your request. Please try again later.');
            console.error(jqXHR, exception);
        }
    });
}


function populateLandDetailsTable(data) {
    var html = "<tr id='tr" + data.id + "'>";
    html += "<input type='hidden' name='dist_code[]' value='" + data.dist_code + "'>";
    html += "<input type='hidden' name='subdiv_code[]' value='" + data.subdiv_code + "'>";
    html += "<input type='hidden' name='cir_code[]' value='" + data.cir_code + "'>";
    html += "<td><input type='number' readonly class='form-control' name='book_no[]' value='" + data.book_no + "'></td>";
    html += "<td><input type='text' readonly class='form-control' name='page_no[]' value='" + data.page_no + "'></td>";
    html += "<input type='hidden' name='mouza_pargona_code[]' value='" + data.mouza_pargona_code + "'>";
    html += "<td><input type='text' readonly class='form-control' name='mouza_name' value='" + data.mouza_name + "'></td>";
    html += "<input type='hidden' name='lot_no[]' value='" + data.lot_no + "'>";
    html += "<td><input type='text' readonly class='form-control' name='lot_name' value='" + data.lot_name + "'></td>";
    html += "<input type='hidden' name='village[]' value='" + data.village + "'>";
    html += "<td><input type='text' readonly class='form-control' name='village_name' value='" + data.village_name + "'></td>";
    html += "<input type='hidden' name='patta_type_code[]' value='" + data.patta_type_code + "'>";
    html += "<td><input type='text' readonly class='form-control' name='patta_type_name' value='" + data.patta_type_name + "'></td>";
    html += "<td><input type='text' readonly class='form-control' name='patta_no[]' value='" + data.patta_no + "'></td>";
    // Add pdar_id_kpph with hidden field, readonly input, and visible text
    html += "<input type='hidden' name='pdar_id_kpph[]' value='" + data.pdar_id_kpph + "'>";
    html += "<td><div>" + data.pdar_id_kpph_text + "</div><input type='text' readonly class='form-control' name='pdar_id_kpph_text[]' value='" + data.pdar_id_kpph_text + "' style='display:none;'></td>";
    // Add pdar_id_kbph with hidden field, readonly input, and visible text
    html += "<input type='hidden' name='pdar_id_kbph[]' value='" + data.pdar_id_kbph + "'>";
    html += "<td><div>" + data.pdar_id_kbph_text + "</div><input type='text' readonly class='form-control' name='pdar_id_kbph_text[]' value='" + data.pdar_id_kbph_text + "' style='display:none;'></td>";
    html += "<td><button type='button' class='btn btn-danger btn-sm remove-row' onclick='removeRow(this)'><i class='fas fa-trash-alt'></i></button></td>";
    html += "</tr>";

    $("#land_details_table").find("tbody").append(html);
    $('#land_details_table').show();
    $('#finalSubmit_btn').show();
}



function removeRow(button) {
    $(button).closest('tr').remove();
    if ($("#land_details_table tbody tr").length === 0) {
        $('#land_details_table').hide();
        $('#finalSubmit_btn').hide();
    }
}