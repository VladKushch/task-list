<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="css/app.css">
        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
            <task-list></task-list>
        </div>
    <script src="js/app.js"></script>
    </body>
</html>
