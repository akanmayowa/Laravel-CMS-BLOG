<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css"
        @toastr_css
        @livewireStyles
      <script src="{{ mix('js/app.js') }}" defer></script>
      <script src="{{ asset('js/toastr.min.js')}}"></script>
      <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
      @yield('styles')
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow flex justify-items-start ">



                    <div class="py-6 px-3   items-start ">
                        {{ $header }}
                    </div>

                    <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('post.index') }}"> All Post</a>
                     </div>


                     <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('post.trashed') }}"> Trashed Post</a>
                     </div>



                    <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                       <a href="{{ route('post.create') }}">New Post</a>
                    </div>


                    <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('category.create') }}"> New Category</a>
                     </div>

                     <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('category.index') }}"> Categories</a>
                     </div>


                     <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('tag.index') }}"> Tag</a>
                     </div>

                     <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('tag.create') }}">New Tag</a>
                     </div>

                     @if(Auth::user()->admin)
                     <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('users.index') }}"> Users</a>
                     </div>

                     <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('users.create') }}">New User</a>
                     </div>

                     @endif


                     <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('users.profile') }}">Profile</a>
                     </div>


                     @if(Auth::user()->admin)
                     <div class="font-bold leading-5  py-6 px-3   items-start text-1xl">
                        <a href="{{ route('settings.settings') }}">Settings</a>
                     </div>
                     @endif

                     </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
        @yield('scripts')
        @stack('modals')

        @livewireScripts
        <script>
            @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.success("{{ Session::get('success') }}");
            @endif



            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.info("{{ Session::get('info') }}");
            @endif

            </script>


    </body>
    @jquery
    @toastr_js
    @toastr_render

</html>
