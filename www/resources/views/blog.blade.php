<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Blog Vicente</title>

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div>
    <div class="container mx-auto">
        @yield('navbar',View::make('components.blog-navbar'))

        <div class="grid gap-4 grid-cols-3">
            @foreach ($posts as $post)
                <div class="container {{$loop->first ? 'col-span-3' : ''}} mx-auto border border-primary p-5">
                    <h1 class="font-black text-2xl "> {{ $post->title }}</h1>
                    <p class="font-normal mt-4 text-brown overflow-ellipsis truncate "> {{$post->description}}</p>
                    <a class="flex flex-1 justify-end " href="{{ url('/posts/'.$post->id) }}">
                        <p class="text-blue-400 font-bold mr-5">Read full</p>
                        <div class="w-5">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right"
                                 class="svg-inline--fa fa-arrow-right fa-w-14" role="img"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 448 512">
                                <path fill="#569BED"
                                      d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path>
                            </svg>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @yield('navbar',View::make('components.blog-footer'))
</div>


</body>
</html>
