<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Posts</title>

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div>
    <div class="container mx-auto ">
        @yield('navbar',View::make('components.blog-navbar'))
        <div class="flex justify-center items-center ">
            <div class="container col-span-3  mx-auto border border-primary p-5">
                <img class="w-full h-96 object-cover" src="{{$post->photo_url}}"  alt="{{$post->title}}"/>
                <h1 class="font-black text-2xl"> {{ $post->title }}</h1>
                <p class="font-normal mt-4 text-brown"> {{$post->description}}</p>
            </div>
        </div>
    </div>
    @yield('navbar',View::make('components.blog-footer'))
</div>
</body>
</html>
