<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
    <title>Login</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-size-base leading-default text-slate-500">
    <main class="mt-0 transition-all duration-200 ease-in-out">
        <section>
            <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
                <div class="container z-1">
                    <div class="flex flex-wrap -mx-3">
                        <div
                            class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                                <div class="p-6 pb-0 mb-0">
                                    <h4 class="font-bold">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                    @if ($message = Session::get('message'))
                                        <div class="text-pink-900 text-sm text-center bg-blue-100 p-2">
                                            {{ $message }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-auto p-6">
                                    <form role="form" action="{{ route('auth.login') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <input
                                                type="email" placeholder="Email"
                                                name="email"
                                                class="focus:shadow-primary-outline text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                                            />
                                            @error('name')
                                                <small class=" text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-4">
                                            <input
                                                type="password" placeholder="Password"
                                                name="password"
                                                class="focus:shadow-primary-outline text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                                            />
                                            @error('password')
                                                <small class=" text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div>
                                            <a href="" class=" hover:text-indigo-400 cursor-pointer font-semibold text-transparent bg-clip-text bg-gradient-to-tl from-blue-500 to-violet-500">
                                                Forgot password
                                            </a>
                                        </div>
                                        
                                        <div class="text-center">
                                            <button type="submit"
                                                class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                                                Sign in
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="border-black/12.5 rounded-b-2xl border-t-0 border-solid p-6 text-center pt-0 px-1 sm:px-6">
                                    <p class="mx-auto mb-6 leading-normal text-size-sm">Don't have an account?
                                        <a
                                            href="{{ route('register') }}"
                                            class="font-semibold text-transparent bg-clip-text bg-gradient-to-tl from-blue-500 to-violet-500">
                                            Sign up
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div
                            class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex">
                            <div
                                class="relative flex flex-col justify-center h-full bg-cover px-24 m-4 overflow-hidden bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg')] rounded-xl ">
                                <span
                                    class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-blue-500 to-violet-500 opacity-60"></span>
                                <h4 class="z-20 mt-12 font-bold text-white">"Attention is the new currency"</h4>
                                <p class="z-20 text-white ">The more effortless the writing looks, the more effort the
                                    writer actually put into the process.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>