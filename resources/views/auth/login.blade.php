<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <title>Sign In - Obito Online Learning Platform</title>
    <meta name="description"
        content="Obito is an innovative online learning platform that empowers students and professionals with high-quality, accessible courses.">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/logos/logo-64.png">
    <link rel="apple-touch-icon" href="assets/images/logos/logo-64.png">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Obito Online Learning Platform - Learn Anytime, Anywhere">
    <meta property="og:description"
        content="Obito is an innovative online learning platform that empowers students and professionals with high-quality, accessible courses.">
    <meta property="og:image" content="https://obito-platform.netlify.app/assets/images/logos/logo-64-big.png">
    <meta property="og:url" content="https://obito-platform.netlify.app">
    <meta property="og:type" content="website">
</head>

<body>
    <nav id="nav-guest" class="flex w-full bg-white border-b border-obito-grey">
        <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
            <div class="flex items-center gap-[50px]">
                <a href="{{ route('front.index') }}" class="flex shrink-0">
                    <img src="{{ asset('assets/images/logos/logo.svg') }}" class="flex shrink-0" alt="logo">
                </a>
                <ul class="flex items-center gap-10">
                    <li class="hover:font-semibold transition-all duration-300">
                        <a href="{{ route('front.index') }}">Home</a>
                    </li>
                    <li class="hover:font-semibold transition-all duration-300">
                        <a href="{{ route('front.pricing') }}">Pricing</a>
                    </li>
                    <li class="hover:font-semibold transition-all duration-300">
                        <a href="#">Features</a>
                    </li>
                    <li class="hover:font-semibold transition-all duration-300">
                        <a href="#">Testimonials</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-5 justify-end">
                <a href="#" class="flex shrink-0">
                    <img src="{{ asset('assets/images/icons/device-message.svg') }}" class="flex shrink-0"
                        alt="icon">
                </a>
                <div class="h-[50px] flex shrink-0 bg-obito-grey w-px"></div>
                <div class="flex items-center gap-3">
                    <a href="signup.html"
                        class="rounded-full border border-obito-grey py-3 px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <span class="font-semibold">Sign Up</span>
                    </a>
                    <a href="signin.html"
                        class="rounded-full py-3 px-5 gap-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                        <span class="font-semibold text-white">My Account</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main class="relative flex flex-1 h-full">
        <section class="flex flex-1 items-center py-5 px-5 pl-[calc(((100%-1280px)/2)+75px)]">
            <form method="POST" action="{{ route('login') }}"
                class="flex flex-col h-fit w-[510px] shrink-0 rounded-[20px] border border-obito-grey p-5 gap-5 bg-white">
                @csrf
                <h1 class="font-bold text-[22px] leading-[33px] mb-5">Welcome Back, <br>Let’s Upgrade Skills</h1>
                <div class="flex flex-col gap-2">
                    <p>Email Address</p>
                    <label class="relative group">
                        <input type="email" name="email"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your valid email address">
                        <img src="{{ asset('assets/images/icons/sms.svg') }}"
                            class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5"
                            alt="icon">
                    </label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-3">
                    <p>Password</p>
                    <label class="relative group">
                        <input type="password" name="password" required autocomplete="current-password"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your password">
                        <img src="{{ asset('assets/images/icons/shield-security.svg') }}"
                            class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5"
                            alt="icon">

                    </label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <a href="{{ route('password.request') }}" class="text-sm text-obito-green hover:underline">Forgot My
                        Password</a>
                </div>
                <button type="submit"
                    class="flex items-center justify-center gap-[10px] rounded-full py-[14px] px-5 bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                    <span class="font-semibold text-white">Sign In to My Account</span>
                </button>
            </form>
        </section>
        <div class="relative flex w-1/2 shrink-0">
            <div id="background-banner" class="absolute flex w-full h-full overflow-hidden">
                <img src="{{ asset('assets/images/backgrounds/banner-subscription.png') }}"
                    class="w-full h-full object-cover" alt="banner">
            </div>
        </div>
    </main>

    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
    
</body>

</html>
