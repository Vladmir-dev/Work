<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <script src="{{ asset('assets/js/jquery-3.2.1.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href='{{ asset('assets/css/style.css') }}' rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fbca07;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        input {
            background-color: #fbca078c;
        }

    </style>


</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <img src="{{ asset('assets/Images/logo.png') }}" alt="MTN-Logo" width="200px" height="200px">
            <div class="title m-b-md">
                MoMo Trans App
            </div>

            <div class="links">
                <form id="myForm" name="myForm" action="{{ route('paymomo') }}" class="form-outer">
                    <div class='search_container'>
                        <input type='text' id='speechText' name="amount">
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

<script type='text/javascript'>
    var recognition = new webkitSpeechRecognition();

    recognition.onresult = function(event) {
        // console.log('result');
        var saidText = "";

        for (var i = event.resultIndex; i < event.results.length; i++) {
            if (event.results[i].isFinal) {
                saidText = event.results[i][0].transcript;
            } else {
                saidText += event.results[i][0].transcript;
            }
        }

        document.getElementById('speechText').value = saidText;
        saveSaid = saidText;
    }

    const speakout = new SpeechSynthesisUtterance(
        'Hey... Welcome back to MoMo Trans App. ... If you want to transfer money say . One, .. If you want to check your account balance say . Two'
    );

    speakout.rate = 0.8;
    speechSynthesis.speak(speakout);
    speakout.onend = function() {
        var listenAudio = new Audio('http://127.0.0.1:8000/assets/audio/listening.mp3');
        listenAudio.play();
        setTimeout(function() {
            recognition.start();
            console.log('Recorgnition Started!');
            setTimeout(function() {
                console.log('test');
                recognition.onend = function() {
                    console.log('ended Recorgnition!');
                };
                console.log('tested');
                setTimeout(function() {
                    var amount = document.getElementById('speechText').value;
                    var conv_amount = parseFloat(amount);
                    if (conv_amount === 1 || conv_amount === 'one') {
                        // console.log('its a one/1 selected');
                        window.location = "{{ route('sendMoney') }}";
                    } else if (conv_amount === 2 || conv_amount === 'two') {
                        // console.log('its a two/2 selected');
                        window.location = "{{ route('cb') }}";
                    } else {
                        console.log('Invalid Selection');
                        // const speak_invalid = new SpeechSynthesisUtterance(
                        //     'Invalid Selection!'
                        // );
                        // speak_invalid.rate = 0.8;
                        // speechSynthesis.speak(speak_invalid)
                        // speak_invalid.onend = function() {
                        // }
                    }

                }, 1600);

            }, 1400);
            
        }, 1000);

    };


</script>

</html>
