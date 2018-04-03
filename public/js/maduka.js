// API url
var API_URL = "http://htools-tz-pharmacy-reporting-tool-api.dokku-1.codefortanzania.org/api/";
//var API_URL = "http://127.0.0.1:8090/api/";

$(function(){
    getRegions();
});

$('#hakiki-duka-la-dawa-button').click(function(){
    $('#container-fluid-hakiki').slideUp("slow");
    $('#hakiki-form-and-results').slideDown("slow");
});

$('#close-hakiki-form').click(function(){
    $('#container-fluid-hakiki').slideDown("slow");
    $('#hakiki-form-and-results').slideUp("slow");
});

$('#ripoti-duka-la-dawa-button').click(function(){
    $('#container-fluid-ripoti').slideUp("slow");
    $('#ripoti-form-and-results').slideDown("slow");
});

$('#close-ripoti-form').click(function(){
    $('#container-fluid-ripoti').slideDown("slow");
    $('#ripoti-form-and-results').slideUp("slow");
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href");
    if(target == "#ripoti-tab"){
        $('#motto-hakiki').slideUp("slow");
        $('#motto-ripoti').slideDown("slow");
    }
    else if(target == "#hakiki-tab"){
        $('#motto-ripoti').slideUp("slow");
            $('#motto-hakiki').slideDown("slow");
    }
});

// Pharmacy verification
$('#pharmacy-regno').val("");

$('#pharmacy-regno').keyup(function(){
    if($('#pharmacy-regno').val().length >= 5)
        $('#hakiki-button').prop('disabled', false);
    else 
        $('#hakiki-button').prop('disabled', true);
});

$('#hakiki-button').click(function(){
    var url = API_URL + "pharmacies?registration_number=" + $('#pharmacy-regno').val();

    $.ajax({
        dataType: "json",
        url: url,
        cache: true,
        success: function(data){
            console.log(data);
            var pharmacy = data.pharmacy;

            $('.pharmacy-registration-number').html($('#pharmacy-regno').val());

            if(pharmacy){
                // Preparing values
                $('#pharmacy-name').html(pharmacy.name);
                $('#pharmacist-name').html(pharmacy.pharmacist);
                $('#pharmacy-location').html(pharmacy.location + " - (" + pharmacy.district + ", " + pharmacy.region +")");
                $('#pharmacy-registration-date').html(pharmacy.registration_date);

                $('#hakiki-form').hide();
                $('#hakiki-results-found').show();
            }
            else{
                $('#hakiki-form').hide();
                $('#hakiki-results-not-found').show();
            }
        },
        error: function(e){
            console.log(e.message);
        }
    });
});

$('.hakiki-duka-jingine-button').click(function(){
    $('#pharmacy-regno').val("");
    $('#hakiki-button').prop('disabled', true);

    $('#hakiki-results-found').hide();
    $('#hakiki-results-not-found').hide();
    $('#hakiki-form').show();
});

// Pharmacy Reporting
var gender_error = true;
var location_error = true;
var message_error = true;

$("#gender").val($("#gender option:first").val());
$('#location').val("");
$('#message').val("");


$('#gender').change(function(){
    if($('#gender').val() == 0)
        gender_error = true;
    else gender_error = false;

    validateRipotiForm();
});


$('#pharmacy_regno').keyup(function(){
    if($('#pharmacy_regno').val().length >= 3)
        location_error = false;
    else 
        location_error = true;

    validateRipotiForm();
});

$('#message').keyup(function(){
    if($('#message').val().length >= 3)
        message_error = false;
    else 
        message_error = true;

    validateRipotiForm();
});

function validateRipotiForm(){
    if(!gender_error && !location_error && !message_error){
        $('#ripoti-button').prop('disabled', false);
    }
    else $('#ripoti-button').prop('disabled', true);
}



$('#ripoti-button').click(function(){
    var url = API_URL + "reports";

    var data = {
        gender: $('#gender').val(),
        pharmacy_registration_number: $('#pharmacy_regno').val(),
        message: $('#message').val()
    };

    $.ajax({
        url: url,
        type: "POST",
        data: data,
        success: function(data){
            $('#ripoti-form').hide();
            $('#ripoti-results').show();
        },
        error: function(e){
            console.log(e.message);
        }
    });
});

$('.ripoti-tatizo-jingine-button').click(function(){
    $("#gender").val($("#gender option:first").val());
    $('#location').val("");
    $('#message').val("");

    $('#ripoti-form').show();
    $('#ripoti-results').hide()
});

// Pharmacy LookUp
var region_error = true;
var district_error = true;
var ward_error = true;
var tafuta_pharmacy_name_error = true;

function validateTafutaForm(){
    if((!region_error && !district_error && !ward_error) || !tafuta_pharmacy_name_error){
        $('#tafuta-button').prop('disabled', false);
    }
    else $('#tafuta-button').prop('disabled', true);
}

// Function to fetch regions.
var getRegions = function(){
    let type = "GET";
    let url =  "/admin/operations/getregions";

    $.ajax({
        type: type,
        url: url,
        success: function (data) {
            if(data.success){
                $('#region').append(data.message);
                $("#region").prop( "disabled", false);
            }
            else{
                //$("#error-message span").html(data.message);
                //$("#error-message").show();
            }
        },
        error: function (data) {
            //$("#error-message span").html("Something went wrong, try to add new owner again.");
            //$("#error-message").show();
        }
    });
}

// Region is changed to fetch Districts.
$('#region').change(function(){
    // Disable District select
    $('#district').html("<option value='0'>Choose District</option>");
    $("#district").prop( "disabled", true);

    // Disable Ward select
    $('#ward').html("<option value='0'>Choose Ward</option>");
    $("#ward").prop( "disabled", true);

    // Set errors.
    if($('#region').val() == 0){
        region_error = true;
        district_error = true;
        ward_error = true;
    }
    else region_error = false;

    var formData = "region_id=" + $('#region').val();

    let type = "GET";
    let url =  "/admin/operations/getdistricts";

    $.ajax({
        type: type,
        url: url,
        data: formData,
        success: function (data) {
            if(data.success){
                $('#district').append(data.message);
                $("#district").prop( "disabled", false);
            }
            else{
                //$("#error-message span").html(data.message);
                //$("#error-message").show();
            }
        },
        error: function (data) {
            //$("#error-message span").html("Something went wrong, try to add new owner again.");
            //$("#error-message").show();
        }
    });

    validateTafutaForm();
});

// District is changed to fetch Wards.
$('#district').change(function(){
    // Disable Ward select
    $('#ward').html("<option value='0'>Choose Ward</option>");
    $("#ward").prop( "disabled", true);

    // Set errors.
    if($('#district').val() == 0){
        district_error = true;
        ward_error = true;
    }
    else district_error = false;

    var formData = "district_id=" + $('#district').val();

    let type = "GET";
    let url =  "/admin/operations/getwards";
    

    $.ajax({
        type: type,
        url: url,
        data: formData,
        success: function (data) {
            if(data.success){
                $('#ward').append(data.message);
                $("#ward").prop( "disabled", false);
            }
            else{
                //$("#error-message span").html(data.message);
                //$("#error-message").show();
            }
        },
        error: function (data) {
            //$("#error-message span").html("Something went wrong, try to add new owner again.");
            //$("#error-message").show();
        }
    });

    validateTafutaForm();
});

$('#ward').change(function(){
    if($('#ward').val() == 0){
        ward_error = true;
    }
    else ward_error = false;

    validateTafutaForm();
});

$('#tafuta-pharmacy-name').keyup(function(){
    if($('#tafuta-pharmacy-name').val().length >= 3)
        tafuta_pharmacy_name_error = false;
    else 
        tafuta_pharmacy_name_error = true;

    validateTafutaForm();
});

$('#tafuta-button').click(function(){
    var url = API_URL + "lookup?region=" + $('#region').val() + "&district=" + $('#district').val() + "&ward=" + $('#ward').val() + "&name=" + $('#tafuta-pharmacy-name').val();

    $.ajax({
        dataType: "json",
        url: url,
        cache: true,
        success: function(data){
            console.log(data);
            if(data.status == 200){
                $('.tafuta-query').html(data.tafuta_query);
                $('#tafuta-results-data').html(data.table_data);
                $('#tafuta-form').hide();
                $('#tafuta-results-found').show();
            }
            else{
                $('#tafuta-form').hide();
                $('#tafuta-results-not-found').show();
            }
        },
        error: function(e){
            console.log(e.message);
        }
    });
});

$('.tafuta-duka-jingine-button').click(function(){
   // $('#pharmacy-regno').val("");
    $('#tafuta-button').prop('disabled', true);

    $('#tafuta-results-found').hide();
    $('#tafuta-results-not-found').hide();
    $('#tafuta-form').show();
});