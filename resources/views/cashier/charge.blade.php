<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    </script>
</head>
<body>
<div id="app"></div>

<script src="{{ asset('js/init.js') }}"></script>
<script>
    function onBodyLoaded() {
        setTimeout(function () {
            var form = document.getElementById('form');
//            form.submit();
        }, 2000);
    }

    axios.post('{{ url('api/queryUserInfo') }}', {
        'streamingNO': '',
        'timeStamp': '',
        'devNO': '',
        'CARegionCode': '',
    })
        .then(function (response) {
            console.log(response);

        })
        .catch(function (response) {
            console.log(response);
        });

    axios.post('{{ url('api/queryUserInfo') }}', {
        'streamingNO': '',
        'timeStamp': '',
        'devNO': '',
        'CARegionCode': '',
    })
        .then(function (response) {
            console.log(response);

        })
        .catch(function (response) {
            console.log(response);
        });

</script>

</body>
</html>
