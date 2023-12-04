<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>

        Ciao Admin!

    </h1>

    <p>
        Hai ricevuto un nuovo messaggio da: <br>
        Name: {{ $lead->name }} <br>
        Email: {{ $lead->email }}
    </p>

<x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="'https://www.google.com/'">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

    <p>
        Message: <br>
        {{ $lead->message }}
    </p>
</body>

</html>
