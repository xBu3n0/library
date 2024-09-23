<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <h2>Bem vindo ao sistema</h2>
        <p class="font-bold text-sm">Seja bem vindo {{ $user->name }}</p>
    </body>
</html>
