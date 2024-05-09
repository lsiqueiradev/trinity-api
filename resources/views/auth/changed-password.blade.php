<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    'sans': 'Kanit, Helvetica, Arial, sans-serif',
                }
            }
        }
    </script>
</head>
<!-- component -->

<body class="antialiased bg-slate-200 px-4">
    <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
        <img src="{{ asset('images/icon.png') }}" class="w-16 h-16 rounded-md" alt="Image" />
        <h1 class="text-4xl font-medium mt-4">senha atualizada com senha</h1>
        <p class="text-slate-500 mt-2">volte ao app para realizar o login</p>
    </div>
</body>

</html>
