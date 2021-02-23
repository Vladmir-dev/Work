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

    </style>




</head>

<body>
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                MoMo Trans App
            </div>

            <div class="links">
                <form id="myForm" name="myForm" action="{{ route('paymomo') }}" class="form-outer">
                    <label>MTN Mob Number:</label><br>
                    <input type='text' id='speechText' name="amount"> <br> <br>
                    <label>Amount to Transfer:</label><br>
                    <input type="text" name="momo_amount" id='momo_amount'> <br> <br>
                    <br><br>
                    <div class='search_container'>
                        <!-- Search box-->
                        <input type="tel" name="momo_number" id="momo_number"> &nbsp;
                        <input type='button' id='start' value='Start' onclick='startRecording();'>
                    </div>
                    <br><br>

                    <input type="submit" value="submit" class="btn btn-primary">
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

    var amountRecognition = new webkitSpeechRecognition();
    amountRecognition.onresult = function(event2) {
        // console.log('result');
        var saidAmount = "";
        for (var i2 = event2.resultIndex; i2 < event2.results.length; i2++) {
            if (event2.results[i2].isFinal) {
                saidAmount = event2.results[i2][0].transcript;
            } else {
                saidAmount += event2.results[i2][0].transcript;
            }
        }

        document.getElementById('momo_amount').value = saidAmount;
        saveSaid = saidAmount;
    }

    var conv_number = window.st;
    // var ns_number = document.write(m_number.replace(/\s/g, '') );
    // var conv_number = parseFloat(ns_number);

    var conv_amount = window.sa;
    // var ns_amount = document.write(amount.replace(/\s/g, '') );
    // var conv_amount = parseFloat(ns_amount);

    const speakout = new SpeechSynthesisUtterance(
        'What\'s the number that you want to send money to?'
    );

    speakout.rate = 2.0;
    speechSynthesis.speak(speakout)
    speakout.onend = function() {
        var listenAudio = new Audio('http://127.0.0.1:8000/assets/audio/listening.mp3');
        listenAudio.play();
        setTimeout(function() {
            recognition.start();
            setTimeout(function() {
                recognition.onend = function() {
                    var listenAudio1 = new Audio('http://127.0.0.1:8000/assets/audio/listening.mp3');
                    listenAudio1.play();
                };
                
                setTimeout( function() {
                    const amountSpeakOut = new SpeechSynthesisUtterance(
                        'How much do you wish to send'
                    );
                    amountSpeakOut.rate = 2.0;
                    speechSynthesis.speak(amountSpeakOut)
                    amountSpeakOut.onend = function() {
                        var listenAudio2 = new Audio('http://127.0.0.1:8000/assets/audio/listening.mp3');
                        listenAudio2.play();
                        setTimeout(function () {
                            amountRecognition.start();
                            setTimeout( function(){
                                amountRecognition.onend = function() {
                                    var listenAudio3 = new Audio('http://127.0.0.1:8000/assets/audio/listening.mp3');
                                    listenAudio3.play();


                                    setTimeout( function() {

                                        console.log(document.getElementById('speechText').value);
                                        console.log(document.getElementById('momo_amount').value);
                                        var numm = ""+document.getElementById('speechText').value+"";
                                        var ns_number = numm.split(" ").join("");
                                        var amtt = ""+document.getElementById('momo_amount').value+"";
                                        var ns_amt = amtt.split(" ").join("");
                                        // var conv_number = Number(ns_number);
                                        console.log(ns_number);
                                        console.log()
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                        'content')
                                                }
                                            });
                                            let myForm = document.getElementById('myForm');
                                            let formData = new FormData(myForm);
                                            formData.append('s_amount', console.log(document.getElementById('momo_amount').value));
                                            formData.append('s_number', ns_number);
                                            // console.log(formData);
                                            $.ajax({
                                                type: 'POST',
                                                url: "{{ route('paymomo') }}",
                                                data: formData,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(data) {

                                                    console.log('Success', data);

                                                },
                                                error: function(data) {
                                                    console.log('Error:', data);
                                                }
                                            });
                                        

                                    }, 2100);


                                };
                            }, 2100);
                        }, 2000);
                    }
                }, 1700);

                // setTimeout(function() {
                //     var number = document.getElementById('speechText').value;
                //     var ns_number = document.write( number.replace(/\s/g, '') );
                //     var conv_number = parseFloat(ns_number);
                //     console.log(conv_number);

                //     // if (typeof conv_amount == 'number') {
                //     //     // console.log('yeyyy!');
                //     //     $.ajaxSetup({
                //     //         headers: {
                //     //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                //     //                 'content')
                //     //         }
                //     //     });
                //     //     let myForm = document.getElementById('myForm');
                //     //     let formData = new FormData(myForm);
                //     //     formData.append('s_amount', conv_amount);
                //     //     // console.log(formData);
                //     //     $.ajax({
                //     //         type: 'POST',
                //     //         url: "{{ route('paymomo') }}",
                //     //         data: formData,
                //     //         cache: false,
                //     //         contentType: false,
                //     //         processData: false,
                //     //         success: function(data) {

                //     //             console.log('Success', data);

                //     //         },
                //     //         error: function(data) {
                //     //             console.log('Error:', data);
                //     //         }
                //     //     });
                //     // } else {
                //     //     console.log('Please Enter a Number!');
                //     // }

                // }, 7700);



            }, 8600);
        }, 1000);

    };


    // function startRecording() {
    //     recognition.start();
    // }

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

</html>
