<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Asimov Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <p>ERROS HERE:</p>

    </body>
    <script>
        function makePost(){
    fetch('api/v1/bookings', {
        method: 'post',
        body: {
            "email":"test@emailm.com",
            "hour":15,
            "date":"00-12-01"
            },
            headers: {
            'Content-Type': 'application/json',
        },
        }).then(res=>{
            console.log('IM IN THEN')
            console.log(res)
            res.json().then(data=>{
                console.log('IM IN RES JSON')
                console.log(data)
            })
            // res.json().then(data=>{
            //     console.log(data)
            // }).catch(twoerr=>{
            //     console.log(twoerr)
            //})
        }).catch(err=>{
            console.log('erros')
            console.log(err)
        })
    }
    makePost()
    </script>
</html>
