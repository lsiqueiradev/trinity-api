<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name')}}</title>

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
        <img src="{{ asset('storage/images/icon.png'); }}" class="w-16 h-16 rounded-md" alt="Image"/>
        <h1 class="text-4xl font-medium mt-4">atualizar senha</h1>
        <p class="text-slate-500 mt-2">deve incluir pelo menos uma letra maiúscula, um número e ter pelo menos 8 caracteres</p>

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-6 rounded relative" role="alert">
            <strong class="font-bold">Caramba!</strong>
            <span class="block sm:inline">{{ implode('', $errors->all(':message')) }}</span>
        </div>
        @endif

        <form action="{{ route('password.store') }}" method="POST" class="my-6 mb-2">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ $request->input('email') }}">
            <div class="flex flex-col space-y-5">
                <label for="password">
                    <p class="font-medium text-slate-700 pb-2">senha</p>
                    <input id="password" name="password" type="password"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="insira sua senha">

                </label>
                <label for="password_confirmation">
                    <p class="font-medium text-slate-700 pb-2">cofirmar senha</p>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="insira sua senha novamente">
                </label>

                <button
                    class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                    </svg>

                    <span>atualizar</span>
                </button>
            </div>
        </form>
    </div>
</body>

</html>
