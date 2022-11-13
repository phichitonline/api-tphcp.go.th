<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API Service</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    @livewireStyles

</head>
<body>
    <div class="w-full mt-10 mx-auto text-center">
        <h1>ข้อมูลผู้ป่วย</h1>
    </div>

    <div class="w-7/12 mt-10 mx-auto rounded p-2">
        <livewire:patients />
    </div>

    @livewireScripts

</body>
</html>
