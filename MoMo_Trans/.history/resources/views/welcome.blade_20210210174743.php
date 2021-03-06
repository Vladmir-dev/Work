<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href='{{ asset('assets/css/style.css') }}' rel='stylesheet' type='text/css'>
		<script src="{{ asset('assets/js/jquery-3.2.1.js') }}"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
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

            .links > a {
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
        </style>

        <script type='text/javascript'>

            var recognition = new webkitSpeechRecognition();

            recognition.onresult = function (event) {
                console.log('result');
                var saidText = "";
                for (var i = event.resultIndex; i < event.results.length; i++) {
                    if (event.results[i].isFinal) {
                        saidText = event.results[i][0].transcript;
                    } else {
                        saidText += event.results[i][0].transcript;
                    }
                }

                document.getElementById('speechText').value = saidText;
            }

            function startRecording() {
                recognition.start();
            }

            // Search Posts
            // function searchPosts(saidText) {

            // 	$.ajax({
            // 		url: 'getData.php',
            // 		type: 'post',
            // 		data: { speechText: saidText },
            // 		success: function (response) {
            // 			$('.container').empty();
            // 			$('.container').append(response);
            // 		}
            // 	});
            // }

        </script>
    
    
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
                <div class="title m-b-md">
                    MoMo Trans App
                </div>

                <div class="links">
                    <form action="{{ route('paymomo') }}" class="form-outer">
                        <label>MTN Mob Number:</label><br>
                        <input type="tel" name="momo_number" id="momo_number"> <br> <br>
                        <label>Amount to Transfer:</label><br>
                        <input type="number" name="momo_amount" id="momo_amount"> <br> <br>

                        <br><br>
                        <div class='search_container'>
                            <!-- Search box-->
                            <input type='text' id='speechText'> &nbsp; <input type='button' id='start' value='Start'
                                onclick='startRecording();'>
                        </div>
                        <br><br>

                        <input type="submit" value="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        var to_speak = new SpeechSynthesisUtterance('Hello world!');
        window.speechSynthesis.speak(to_speak);
    </script>
</html>
