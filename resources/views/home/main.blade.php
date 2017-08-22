<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Maduka ya Dawa - Code for Tanzania</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet"> 

    <link href="{{ asset('css/maduka.custom.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    
    @include('home.includes.jumbotron')

    @include('home.includes.kuhakiki')

    @include('home.includes.kuripoti')

    @include('home.includes.simuzamkononi')

    @include('home.includes.footer')

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    <script>
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
            var url = "http://127.0.0.1:8090/api/pharmacies?registration_number=" + $('#pharmacy-regno').val();

            $.ajax({
                dataType: "json",
                url: url,
                cache: true,
                success: function(data){
                    var pharmacy = data.pharmacies[0];
                    if(pharmacy){
                        console.log('FOUND');
                        // Preparing values
                        $('.pharmacy-registration-number').html(pharmacy.registration_number);
                        $('#pharmacy-name').html(pharmacy.name);
                        $('#pharmacist-name').html(pharmacy.pharmacist);
                        $('#pharmacy-location').html(pharmacy.location);
                        $('#pharmacy-registration-date').html(pharmacy.date_registered);

                        $('#hakiki-form').hide();
                        $('#hakiki-results-found').show();
                    }
                    else{
                        console.log('NOT FOUND');

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

        
        $('#location').keyup(function(){
            if($('#location').val().length >= 3)
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
            var url = "http://127.0.0.1:8090/api/reports";

            var data = {
                gender: $('#gender').val(),
                location: $('#location').val(),
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
    </script>
</body>
</html>