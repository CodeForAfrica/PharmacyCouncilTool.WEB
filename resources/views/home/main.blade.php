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
    </script>
</body>
</html>