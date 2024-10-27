<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <style>
        #toast {
            display: none;
            position: absolute;
            width: fit-content;
            padding: 2em;
            background-color: rgb(12, 64, 109);
            color: white;
            z-index: 1;
            border-radius: 5px;
            margin-inline: auto;
            left: 0;
            right: 0;
            top: 5em;
            animation: fade-out 1.5s ease-in 1s 1;
            animation-iteration-count: 1; 
        }
        @keyframes fade-out {
            0% {opacity: 1}
            100% {opacity: 0;}
        }
    </style>
</head>

<body>
    <div id="toast">Hier sind die Daten!</div>
    <div style="display: flex; flex-direction: column; width: 50%; height: 50vh; margin: 0 auto; flex-grow: 1; gap: 1em;">
        <div id="dataDisplay" style="flex: 1 1 50%; background-color: lightgrey; border: solid 1px grey; border-radius: 10px; padding: 1em;">kjhsafjksadjhkf</div>

        <button type="submit" id="button">Hole Daten</button>
    </div>
    <script>
        $('#button').on('click', function(event) {
            event.preventDefault();
            let jqXHR = "";
            $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: 'blub'
                })
                .done(function(result, jqXHR) {
                    let returnedData = JSON.parse(result);
                    let objectData = '';

                    for (let person in returnedData){
                        objectData += '<b>' + person + '</b>: <br>';
                        for (let returnedDetail in returnedData[person]){
                            objectData += returnedDetail + ' -  ' + returnedData[person][returnedDetail] + '<br>';
                        }
                    }
                    $('#toast').css('display', 'block');
                    setTimeout(function(){$('#toast').css('display', 'none')}, 2500);
                    let text = 'Ich habe Daten erhalten. Und zwar: <p>' + objectData;
                    $('#dataDisplay').html(text);
                })
                .fail(function(result,jqXHR) {
                    $('#dataDisplay').text('Hier kam nichts an.');
                    console.log(jqXHR);

                })

        });
    </script>
</body>

</html>