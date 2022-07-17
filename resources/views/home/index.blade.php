<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>{{ $pageName }}</title>
</head>
<body>
  <main class="w-screen h-screen bg-blue-500">
    <div class="p-10 grid grid-cols-4 gap-6 self-center justify-items-center">
      @foreach( $characters as $character)
        <article class="w-80 p-8 bg-white rounded-none transition duration-300 ease-in-out hover:scale-105 hover:drop-shadow-2xl">
          <img src="{{ $character->avatar }}" alt="{{ $character->name }}" class="h-64 mx-auto">
          <div class="text-center">
            <h3 class="text-center text-3xl font-bold">{{ $character->name }}</h3>
          </div>
          <div class="mt-4 text-center">
            <a href="#" class="rounded-xl bg-red-500 hover:bg-red-700 px-20 py-2 text-sm text-white">Info completa</a>
          </div>
        </article>
      @endforeach
    </div>
    <div class="flex justify-center items-center py-2">{{ $characters->links() }}</div>
  </main>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>