<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu - Dallas Fried Chicken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">
    <nav class="bg-white sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('user.dashboard') }}">
                        <img src="{{ asset('storage/images/logo.png') }}" class="h-16" alt="Logo" />
                    </a>
                </div>

                <div class="hidden md:flex space-x-12">
                    <a href="{{ route('menus.user') }}"
                        class="text-gray-700 font-medium hover:text-blue-600 transition">Menu</a>
                    <a href="{{ route('promo.index') }}"
                        class="text-gray-700 font-medium hover:text-blue-600 transition">Promo</a>
                    <a href="{{ route('kontak.index') }}"
                        class="text-gray-700 font-medium hover:text-blue-600 transition">Kontak</a>
                </div>

                @auth
                <div class="flex items-center space-x-6 relative">
                    @php
                    $cart = session()->get('cart');
                    $cartCount = $cart ? array_sum(array_column($cart, 'quantity')) : 0;
                    @endphp

                    <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 
                        1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 
                        0 2 2 0 014 0z" />
                        </svg>
                        @if($cartCount > 0)
                        <span
                            class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-bounce">{{
                            $cartCount }}</span>
                        @endif
                    </a>

                    <div class="relative inline-block text-left">
                        <button id="userMenuButton"
                            class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition focus:outline-none">
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="userDropdown"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-40 transition-all duration-200 transform opacity-0 scale-95">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="userMenuButton">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"
                                    role="menuitem"><i class="fas fa-user-circle mr-2"></i>Profile</a>
                                <a href="{{ route('orders.history') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"
                                    role="menuitem"><i class="fas fa-history mr-2"></i>Riwayat Pesanan</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"
                                        role="menuitem">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}"
                    class="text-gray-700 font-medium hover:text-blue-600 transition">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Menu Makanan</h2>
                <p class="text-sm text-gray-500">Dallas Fried Chicken</p>
            </div>
            <nav class="p-4 bg-white shadow-md rounded-lg">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Menu Paket</h3>
                <div class="space-y-3">
                    <a href="{{ route('menus.filter', 'karbo') }}"
                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out">
                        <!-- Icon SVG Karbo -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" viewBox="0 0 24 24"
                            fill="currentColor">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>rice-cracker</title>
                                <desc>Created with sketchtool.</desc>
                                <g id="food" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="rice-cracker" fill="currentColor" fill-rule="nonzero">
                                        <path
                                            d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M7,18.245371 L7,13 C7,11.8954305 7.8954305,11 9,11 L15,11 C16.1045695,11 17,11.8954305 17,13 L17,18.245371 C18.828925,16.7792499 20,14.5263846 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,14.5263846 5.17107503,16.7792499 7,18.245371 Z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        Karbo
                    </a>
                    <a href="{{ route('menus.filter', 'ayam') }}"
                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out">
                        <!-- Icon SVG Ayam -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" viewBox="0 0 70 70"
                            fill="currentColor">
                            <g>
                                <path d="M62.131,8.45c-3.445-3.446-8.139-5.344-13.215-5.344c-5.678,0-11.348,2.413-15.554,6.619
                C26.787,16.3,19.139,31.689,20.874,41.44l-7.891,7.891c-2.729-1.6-6.083-1.244-8.414,1.086c-2.717,2.717-2.726,7.131-0.02,9.84
                c0.886,0.885,1.969,1.506,3.15,1.814c0.316,1.184,0.941,1.927,1.815,2.8c1.315,1.314,3.067,1.712,4.933,1.712
                c0.016,0,0.031,0,0.047,0c1.861,0,3.604-0.372,4.91-1.677c2.08-2.08,2.486-5.259,1.21-7.813l7.712-7.619
                c1.149,0.281,2.419,0.469,3.802,0.469c9.404,0,22.688-6.707,28.727-12.747c3.987-3.986,6.328-9.143,6.594-14.54
                C67.719,17.186,65.829,12.148,62.131,8.45z M16.605,55.63c-0.781,0.779-0.781,2.047-0.001,2.828
                c0.911,0.91,1.098,2.842-0.027,3.965c-0.555,0.557-1.312,0.869-2.103,0.854c-0.807-0.006-1.563-0.32-2.131-0.889
                c-0.558-0.557-0.878-1.324-0.88-2.105c-0.003-1.102-0.896-1.992-1.997-1.994c-0.79-0.002-1.532-0.309-2.089-0.865
                c-1.146-1.146-1.138-3.021,0.02-4.178c1.236-1.238,3.025-1.176,4.35,0.148c0.375,0.375,0.884,0.586,1.414,0.586
                s1.039-0.211,1.414-0.586l7.848-7.846c0.337,0.52,0.716,1.01,1.158,1.451c0.276,0.277,0.575,0.531,0.887,0.77L16.605,55.63z
                M63.454,22.471c-0.217,4.403-2.144,8.636-5.427,11.919c-5.475,5.474-17.714,11.597-25.898,11.597
                c-2.59,0-4.515-0.611-5.72-1.816c-5.414-5.416,2.362-24.198,9.781-31.618c3.462-3.462,8.101-5.447,12.726-5.447
                c4.008,0,7.696,1.481,10.387,4.172C62.192,14.167,63.667,18.143,63.454,22.471z"></path>
                                <path d="M54.475,11.944c-0.491-0.249-1.095-0.05-1.344,0.441c-0.249,0.493-0.051,1.095,0.441,1.344
                c0.921,0.465,1.757,1.069,2.483,1.796c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293
                c0.391-0.391,0.391-1.023,0-1.414C56.593,13.234,55.585,12.504,54.475,11.944z"></path>
                                <path d="M47.407,10.729c-3.204,0.358-6.274,1.861-8.645,4.232c-2.686,2.685-5.54,7.548-7.104,12.104
                c-0.179,0.522,0.1,1.091,0.622,1.271c0.107,0.036,0.217,0.054,0.324,0.054c0.415,0,0.804-0.261,0.946-0.676
                c1.473-4.293,4.136-8.849,6.625-11.338c2.051-2.052,4.697-3.351,7.453-3.658c0.549-0.062,0.943-0.557,0.883-1.105
                C48.451,11.064,47.961,10.667,47.407,10.729z"></path>
                                <path d="M9.724,52.583c-0.004,0-0.008,0-0.011,0c-0.567,0-1.668,0.747-2.201,1.974c-0.221,0.506,0.012,1.315,0.519,1.536
                c0.13,0.057,0.265,0.174,0.397,0.174c0.387,0,0.754-0.189,0.918-0.566c0.132-0.301,0.334-0.344,0.421-0.354
                c0.537-0.023,0.963-0.842,0.957-1.383C10.718,53.415,10.271,52.583,9.724,52.583z"></path>
                            </g>
                        </svg>
                        Ayam
                    </a>

                    <a href="{{ route('menus.filter', 'burger') }}"
                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out">
                        <!-- Icon SVG Ayam Baru -->
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3">
                            <path
                                d="M21 12.6L20.3086 13.2568C19.5652 13.9631 18.4081 13.9926 17.6295 13.3253L16.8016 12.6156C16.0526 11.9737 14.9474 11.9737 14.1984 12.6156L13.3016 13.3844C12.5526 14.0263 11.4474 14.0263 10.6984 13.3844L9.80158 12.6156C9.0526 11.9737 7.9474 11.9737 7.19842 12.6156L6.37045 13.3253C5.5919 13.9926 4.4348 13.963 3.69138 13.2568L3 12.6M12 4C6.73593 4 4.5508 5.71052 3.64374 7.13061C3.04915 8.06149 3.89543 9 5 9H19C20.1046 9 20.9508 8.06149 20.3563 7.13061C19.4492 5.71052 17.2641 4 12 4ZM4.5 17H19.5C20.3284 17 21 17.6716 21 18.5V18.5C21 19.3284 20.3284 20 19.5 20H4.5C3.67157 20 3 19.3284 3 18.5V18.5C3 17.6716 3.67157 17 4.5 17Z"
                                stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Burger
                    </a>

                    <a href="{{ route('menus.filter', 'nugget') }}"
                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out">
                        <!-- Icon SVG Nugget -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm0-4.5c-3.037 0-5.5-2.463-5.5-5.5s2.463-5.5 5.5-5.5 5.5 2.463 5.5 5.5-2.463 5.5-5.5 5.5z" />
                        </svg>
                        Nugget
                    </a>
                    <a href="{{ route('menus.filter', 'minuman') }}"
                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out">
                        <!-- Icon SVG Minuman -->
                        <svg viewBox="-2 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                            class="h-6 w-6 mr-3">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>drink_round [#686]</title>
                                <desc>Created with Sketch.</desc>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Dribbble-Light-Preview" transform="translate(-142.000000, -5159.000000)"
                                        fill="#000000">
                                        <g id="icons" transform="translate(56.000000, 160.000000)">
                                            <path
                                                d="M95.426,5017 L92.573,5017 C92.08,5017 91.66,5016.64 91.585,5016.152 L90.331,5008 L97.668,5008 L96.414,5016.152 C96.339,5016.64 95.92,5017 95.426,5017 L95.426,5017 Z M95,5006 L95,5002 C95,5001.448 95.447,5001 96,5001 L98,5001 C98.552,5001 99,5000.552 99,5000 C99,4999.448 98.552,4999 98,4999 L95,4999 C93.895,4999 93,4999.895 93,5001 L93,5006 L87,5006 C86.447,5006 86,5006.448 86,5007 C86,5007.552 86.447,5008 87,5008 L88.307,5008 L89.739,5017.304 C89.889,5018.28 90.728,5019 91.716,5019 L96.284,5019 C97.271,5019 98.111,5018.28 98.261,5017.304 L99.692,5008 L101,5008 C101.552,5008 102,5007.552 102,5007 C102,5006.448 101.552,5006 101,5006 L95,5006 Z" />
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        Minuman
                    </a>

                    <a href="{{ route('menus.filter', 'paket') }}"
                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out">
                        <!-- Icon SVG Paket Baru -->
                        <svg class="h-6 w-6 mr-3" height="200px" width="200px" version="1.1" id="_x32_"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <style type="text/css">
                                    .st0 {
                                        fill: #000000;
                                    }
                                </style>
                                <g>
                                    <path class="st0"
                                        d="M276.508,389.928H69.71c-12.684,0-22.972,8.194-22.972,18.301v0.536c0,10.107,10.284,18.293,22.972,18.293 h206.798c12.692,0,22.98-8.186,22.98-18.293v-0.536C299.487,398.122,289.199,389.928,276.508,389.928z">
                                    </path>
                                    <path class="st0"
                                        d="M97.89,283.859c-3.644,0-6.596,2.955-6.596,6.599c0,3.651,2.952,6.606,6.596,6.606 c3.651,0,6.61-2.955,6.61-6.606C104.501,286.814,101.541,283.859,97.89,283.859z">
                                    </path>
                                    <path class="st0"
                                        d="M147.41,283.859c-3.648,0-6.608,2.955-6.608,6.599c0,3.651,2.96,6.606,6.608,6.606 c3.643,0,6.599-2.955,6.599-6.606C154.009,286.814,151.053,283.859,147.41,283.859z">
                                    </path>
                                    <path class="st0"
                                        d="M124.301,264.054c-3.647,0-6.599,2.948-6.599,6.599c0,3.651,2.952,6.606,6.599,6.606 c3.644,0,6.599-2.955,6.599-6.606C130.9,267.002,127.945,264.054,124.301,264.054z">
                                    </path>
                                    <path class="st0"
                                        d="M160.611,262.406c0,3.644,2.956,6.592,6.6,6.592c3.647,0,6.603-2.948,6.603-6.592 c0-3.651-2.956-6.599-6.603-6.599C163.567,255.808,160.611,258.755,160.611,262.406z">
                                    </path>
                                    <path class="st0"
                                        d="M191.967,298.712c3.655,0,6.607-2.955,6.607-6.606c0-3.644-2.952-6.599-6.607-6.599 c-3.643,0-6.602,2.955-6.602,6.599C185.364,295.757,188.323,298.712,191.967,298.712z">
                                    </path>
                                    <path class="st0"
                                        d="M213.427,277.185c3.644,0,6.595-2.963,6.595-6.614c0-3.644-2.952-6.6-6.595-6.6 c-3.647,0-6.607,2.956-6.607,6.6C206.82,274.222,209.78,277.185,213.427,277.185z">
                                    </path>
                                    <path class="st0"
                                        d="M246.434,298.712c3.644,0,6.603-2.955,6.603-6.606c0-3.644-2.959-6.599-6.603-6.599 c-3.64,0-6.603,2.955-6.603,6.599C239.831,295.757,242.794,298.712,246.434,298.712z">
                                    </path>
                                    <path class="st0"
                                        d="M301.577,365.195c0.707-0.204,1.519-0.34,2.627-0.34c4.55,0,8.243-3.688,8.243-8.247 c0-4.558-3.693-8.254-8.247-8.254c-2.907,0-5.662,0.446-8.153,1.27c-2.177,0.725-4.142,1.73-5.843,2.864 c-2.982,1.988-5.197,4.294-7.034,6.372c-1.38,1.565-2.562,3.024-3.647,4.249c-1.61,1.86-2.99,3.144-4.222,3.885 c-0.624,0.363-1.214,0.635-1.913,0.831c-0.695,0.197-1.519,0.333-2.615,0.333c-1.274,0-2.177-0.174-2.952-0.431 c-0.676-0.219-1.274-0.521-1.916-0.944c-1.115-0.726-2.358-1.92-3.787-3.545c-1.07-1.21-2.241-2.654-3.606-4.226 c-2.045-2.314-4.551-4.96-8.092-7.106c-1.761-1.074-3.772-1.981-5.983-2.608c-2.204-0.62-4.592-0.945-7.09-0.945 c-2.906,0-5.658,0.438-8.152,1.27c-2.181,0.725-4.139,1.73-5.84,2.864c-2.993,1.988-5.2,4.294-7.034,6.372 c-1.387,1.565-2.562,3.024-3.651,4.249c-1.621,1.86-2.982,3.144-4.218,3.885c-0.627,0.363-1.217,0.635-1.912,0.831 c-0.695,0.197-1.523,0.333-2.62,0.333c-1.277,0-2.176-0.174-2.948-0.431c-0.68-0.227-1.278-0.528-1.92-0.944 c-1.107-0.726-2.347-1.92-3.779-3.545c-1.078-1.21-2.242-2.654-3.606-4.211c-2.044-2.328-4.558-4.974-8.088-7.12 c-1.765-1.074-3.772-1.981-5.986-2.608c-2.204-0.62-4.596-0.953-7.09-0.945c-2.906-0.008-5.662,0.438-8.149,1.27 c-2.176,0.717-4.138,1.723-5.846,2.864c-2.982,1.988-5.193,4.286-7.038,6.372c-1.376,1.565-2.548,3.024-3.633,4.249 c-1.621,1.86-2.997,3.144-4.225,3.885c-0.62,0.363-1.209,0.635-1.908,0.831c-0.707,0.197-1.527,0.333-2.623,0.333 c-1.278,0-2.177-0.174-2.952-0.431c-0.673-0.227-1.274-0.528-1.908-0.952c-1.116-0.718-2.352-1.913-3.788-3.537 c-1.078-1.218-2.242-2.661-3.606-4.211c-2.045-2.328-4.558-4.974-8.096-7.12c-1.754-1.074-3.768-1.981-5.972-2.608 c-2.211-0.62-4.599-0.953-7.098-0.945c-2.906-0.008-5.654,0.438-8.152,1.27c-2.177,0.717-4.131,1.723-5.836,2.857 c-2.99,1.996-5.193,4.294-7.041,6.38c-1.38,1.565-2.555,3.024-3.632,4.249c-1.622,1.86-2.993,3.144-4.226,3.885 c-0.624,0.363-1.214,0.635-1.913,0.831c-0.703,0.197-1.519,0.325-2.615,0.333c-1.281-0.008-2.177-0.174-2.956-0.431 c-0.672-0.227-1.274-0.528-1.909-0.952c-1.112-0.726-2.358-1.905-3.78-3.537c-1.077-1.218-2.249-2.661-3.613-4.219 c-2.041-2.32-4.558-4.966-8.088-7.113c-1.758-1.074-3.768-1.981-5.98-2.608c-2.203-0.62-4.596-0.953-7.098-0.945 c-4.551,0-8.247,3.696-8.247,8.254c0,4.558,3.696,8.247,8.247,8.247c1.286,0,2.185,0.182,2.952,0.431 c0.68,0.234,1.274,0.53,1.916,0.953c1.108,0.725,2.348,1.904,3.784,3.538c1.07,1.209,2.242,2.66,3.602,4.218 c2.049,2.321,4.558,4.966,8.089,7.12c1.761,1.066,3.776,1.973,5.982,2.593c2.204,0.627,4.593,0.952,7.098,0.952 c2.899,0.008,5.65-0.438,8.145-1.262c2.176-0.734,4.138-1.732,5.836-2.866c2.989-1.988,5.2-4.308,7.044-6.38 c1.376-1.564,2.555-3.016,3.636-4.256c1.622-1.851,2.986-3.137,4.222-3.878c0.623-0.362,1.209-0.634,1.916-0.831 c0.696-0.196,1.512-0.333,2.62-0.333c1.273,0,2.174,0.182,2.948,0.431c0.672,0.234,1.273,0.53,1.912,0.953 c1.116,0.725,2.355,1.904,3.784,3.538c1.07,1.209,2.241,2.66,3.606,4.218c2.049,2.321,4.558,4.966,8.092,7.12 c1.762,1.074,3.772,1.973,5.976,2.593c2.211,0.627,4.6,0.952,7.098,0.952c2.899,0.008,5.658-0.438,8.145-1.262 c2.185-0.734,4.142-1.732,5.843-2.866c2.989-1.988,5.201-4.308,7.034-6.38c1.387-1.564,2.563-3.016,3.648-4.256 c1.622-1.851,2.989-3.137,4.222-3.878c0.62-0.362,1.213-0.634,1.913-0.831c0.695-0.196,1.516-0.333,2.622-0.333 c1.274,0,2.174,0.182,2.94,0.431c0.68,0.234,1.282,0.53,1.921,0.953c1.107,0.725,2.35,1.904,3.782,3.538 c1.074,1.209,2.246,2.66,3.606,4.218c2.048,2.321,4.558,4.966,8.092,7.12c1.761,1.074,3.772,1.973,5.979,2.593 c2.212,0.627,4.596,0.952,7.098,0.952c2.899,0.008,5.654-0.438,8.142-1.262c2.184-0.734,4.142-1.732,5.847-2.866 c2.986-1.988,5.201-4.308,7.034-6.38c1.38-1.564,2.559-3.016,3.64-4.256c1.618-1.851,2.994-3.137,4.23-3.878 c0.616-0.362,1.209-0.634,1.908-0.831c0.703-0.196,1.52-0.333,2.623-0.333c1.274,0,2.17,0.182,2.948,0.431 c0.673,0.234,1.278,0.53,1.909,0.953c1.119,0.725,2.354,1.904,3.791,3.538c1.077,1.209,2.241,2.668,3.613,4.218 c2.041,2.328,4.554,4.966,8.084,7.12c1.761,1.074,3.772,1.973,5.983,2.593c2.207,0.627,4.6,0.96,7.098,0.96 c2.903,0,5.662-0.446,8.141-1.27c2.181-0.726,4.146-1.732,5.847-2.866c2.99-1.988,5.204-4.308,7.038-6.38 c1.376-1.564,2.559-3.016,3.636-4.256c1.621-1.851,2.993-3.137,4.225-3.878C300.285,365.656,300.871,365.384,301.577,365.195z">
                                    </path>
                                    <path class="st0"
                                        d="M487.414,120.295h-73.641l15.455-71.07l54.108-31.416L472.998,0l-61.969,35.981l-18.331,84.314H227.407 l8.629,112.404c-19.544-7.416-41.616-11.709-64.997-11.709c-36.397,0.016-69.616,10.356-95.094,26.827 c-12.741,8.248-23.565,18.044-31.82,29.012c-6.388,8.489-11.218,17.711-14.082,27.409h-0.578l-1.44,8.594 c-0.042,0.265-0.075,0.423-0.094,0.507l-0.008,0.045c-0.037,0.09-0.117,0.317-0.234,0.71c-0.118,0.386-0.254,0.915-0.344,1.421 c-0.143,0.764-0.208,1.451-0.238,2.064c-0.034,0.62-0.046,1.202-0.046,1.882c0.008,3.303,0.457,6.546,1.554,9.653 c0.816,2.321,2.014,4.55,3.587,6.508c2.343,2.963,5.521,5.238,8.908,6.584c3.402,1.368,6.974,1.912,10.576,1.912h238.697 c3.205,0,6.376-0.43,9.437-1.482c2.287-0.794,4.509-1.95,6.482-3.485c2.978-2.297,5.306-5.457,6.709-8.882 c1.417-3.447,1.992-7.098,1.992-10.81c-0.004-0.96-0.015-1.724-0.098-2.668c-0.064-0.696-0.216-1.58-0.412-2.314 c-0.151-0.552-0.291-0.93-0.333-1.066l-0.011-0.037c-0.011-0.046-0.049-0.19-0.106-0.545v0.008 c-2.15-12.858-7.85-25.05-16.089-36.011c-10.084-13.372-23.955-25.028-40.498-34.22l-7.808-101.716h215.528l-23.577,307.043 H309.114c-2.351-2.615-5.348-4.838-8.784-6.289c-3.556-1.519-7.484-2.229-11.535-2.222H53.337c-4.8-0.014-9.441,0.998-13.462,3.137 c-3.013,1.588-5.613,3.772-7.654,6.252c-3.076,3.727-4.94,7.997-6.074,12.329c-1.126,4.346-1.556,8.814-1.56,13.335v2.472 c-0.004,9.645,3.942,18.474,10.269,24.786c6.308,6.327,15.137,10.273,24.783,10.266h222.797c9.645,0.008,18.47-3.938,24.782-10.266 c6.327-6.312,10.273-15.14,10.269-24.786v-2.472c0-1.996-0.087-3.984-0.272-5.95h143.453L487.414,120.295z M254.941,265.097 c10.95,7.083,19.968,15.36,26.552,24.114c6.588,8.76,10.722,17.945,12.238,27.024v0.008c0.178,1.058,0.374,1.965,0.597,2.759 c0.03,0.084,0.057,0.166,0.076,0.249c0,0.076,0.008,0.122,0.008,0.212c0,1.406-0.204,2.298-0.37,2.774 c-0.132,0.363-0.23,0.492-0.28,0.552c-0.083,0.09-0.068,0.12-0.51,0.325c-0.431,0.174-1.36,0.416-2.868,0.416H51.685 c-1.346,0-2.226-0.189-2.706-0.363c-0.367-0.121-0.507-0.219-0.575-0.272c-0.087-0.091-0.121-0.068-0.314-0.491 c-0.151-0.355-0.344-1.096-0.408-2.238l0.657-3.93c1.516-9.079,5.651-18.263,12.239-27.024 c9.864-13.138,25.255-25.164,44.338-33.774c19.076-8.625,41.776-13.863,66.123-13.856 C203.495,241.566,233.043,250.909,254.941,265.097z M296.891,476.949c-0.004,4.021-1.602,7.574-4.233,10.22 c-2.65,2.638-6.202,4.233-10.224,4.241H59.637c-4.029-0.008-7.574-1.603-10.22-4.241c-2.634-2.646-4.233-6.198-4.237-10.22v-2.472 c0-2.82,0.257-5.353,0.711-7.393c0.344-1.527,0.79-2.774,1.262-3.689c0.351-0.695,0.71-1.202,1.047-1.587 c0.521-0.582,0.96-0.9,1.663-1.209c0.703-0.303,1.758-0.574,3.473-0.582h235.458c2.048,0.008,3.118,0.378,3.825,0.748 c0.533,0.295,0.93,0.604,1.391,1.156c0.665,0.801,1.436,2.23,1.992,4.407c0.567,2.147,0.896,4.974,0.888,8.149V476.949z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        Paket
                    </a>

                    <a href="{{ route('menus.filter', 'promo') }}"
                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out">
                        <!-- Icon SVG Paket -->
                        <svg class="h-6 w-6 mr-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M10 8.99998C10.5523 8.99998 11 9.44769 11 9.99998C11 10.5523 10.5523 11 10 11C9.44775 11 9.00004 10.5523 9.00004 9.99998C9.00004 9.44769 9.44775 8.99998 10 8.99998Z"
                                    fill="#000000"></path>
                                <path
                                    d="M13 14C13 14.5523 13.4478 15 14 15C14.5523 15 15 14.5523 15 14C15 13.4477 14.5523 13 14 13C13.4478 13 13 13.4477 13 14Z"
                                    fill="#000000"></path>
                                <path
                                    d="M10.7071 14.7071L14.7071 10.7071C15.0977 10.3166 15.0977 9.6834 14.7071 9.29287C14.3166 8.90235 13.6835 8.90235 13.2929 9.29287L9.29293 13.2929C8.90241 13.6834 8.90241 14.3166 9.29293 14.7071C9.68346 15.0976 10.3166 15.0976 10.7071 14.7071Z"
                                    fill="#000000"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16.3117 4.07145L15.1708 4.34503L14.5575 3.34485C13.3869 1.43575 10.6131 1.43575 9.44254 3.34485L8.82926 4.34503L7.68836 4.07145C5.51069 3.54925 3.54931 5.51063 4.07151 7.6883L4.34509 8.8292L3.34491 9.44248C1.43581 10.6131 1.43581 13.3869 3.34491 14.5575L4.34509 15.1708L4.07151 16.3117C3.54931 18.4893 5.51069 20.4507 7.68836 19.9285L8.82926 19.6549L9.44254 20.6551C10.6131 22.5642 13.3869 22.5642 14.5575 20.6551L15.1708 19.6549L16.3117 19.9285C18.4894 20.4507 20.4508 18.4893 19.9286 16.3117L19.655 15.1708L20.6552 14.5575C22.5643 13.3869 22.5643 10.6131 20.6552 9.44248L19.655 8.8292L19.9286 7.6883C20.4508 5.51063 18.4894 3.54925 16.3117 4.07145ZM11.1475 4.3903C11.5377 3.75393 12.4623 3.75393 12.8525 4.3903L13.8454 6.00951C14.0717 6.37867 14.51 6.56019 14.9311 6.45922L16.7781 6.01631C17.504 5.84225 18.1578 6.49604 17.9837 7.22193L17.5408 9.06894C17.4398 9.49003 17.6213 9.92827 17.9905 10.1546L19.6097 11.1475C20.2461 11.5377 20.2461 12.4623 19.6097 12.8525L17.9905 13.8453C17.6213 14.0717 17.4398 14.5099 17.5408 14.931L17.9837 16.778C18.1578 17.5039 17.504 18.1577 16.7781 17.9836L14.9311 17.5407C14.51 17.4398 14.0717 17.6213 13.8454 17.9904L12.8525 19.6097C12.4623 20.246 11.5377 20.246 11.1475 19.6097L10.1547 17.9904C9.92833 17.6213 9.49009 17.4398 9.069 17.5407L7.22199 17.9836C6.4961 18.1577 5.84231 17.5039 6.01637 16.778L6.45928 14.931C6.56026 14.5099 6.37873 14.0717 6.00957 13.8453L4.39036 12.8525C3.75399 12.4623 3.75399 11.5377 4.39036 11.1475L6.00957 10.1546C6.37873 9.92827 6.56026 9.49003 6.45928 9.06894L6.01637 7.22193C5.84231 6.49604 6.4961 5.84225 7.22199 6.01631L9.069 6.45922C9.49009 6.56019 9.92833 6.37867 10.1547 6.00951L11.1475 4.3903Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                        Promo
                    </a>

                </div>
            </nav>


        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-8">
            @if($menus->count() > 0)
            <h1 class="text-2xl font-bold mb-6">
                @if(request()->routeIs('menus.user'))
                Semua Menu
                @else
                Menu {{ ucfirst($menus->first()->category) }}
                @endif
            </h1>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($menus as $menu)
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                        class="h-40 w-full object-contain rounded-md bg-white">
                    <h3 class="text-xl font-semibold text-gray-900 mt-4">{{ $menu->name }}</h3>
                    <p class="text-gray-600 mt-2">{{ \Illuminate\Support\Str::words($menu->description, 8, '...') }}</p>

                    @if($menu->category === 'promo')
                    <p class="text-gray-800 line-through text-sm">
                        Rp {{ number_format($menu->price * 1.2, 0, ',', '.') }}
                    </p>
                    <p class="text-gray-500 font-semibold">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                    </p>
                    @else
                    <p class="text-gray-900 font-semibold">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                    </p>
                    @endif

                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('menus.show', $menu->id) }}"
                            class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">Detail</a>
                        <button type="submit" form="add-to-cart-{{ $menu->id }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah</button>

                        <form id="add-to-cart-{{ $menu->id }}" action="{{ route('cart.add', $menu->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center mt-20">
                <h2 class="text-xl font-semibold text-gray-700">Menu tidak ditemukan.</h2>
                <p class="text-gray-500">Silakan pilih kategori lain atau kembali ke semua menu.</p>
            </div>
            @endif
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userMenuButton = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');

            // Pastikan elemen yang diperlukan ada
            if (userMenuButton && userDropdown) {
                // Event untuk toggle dropdown saat tombol diklik
                userMenuButton.addEventListener('click', function (event) {
                    event.stopPropagation(); // Cegah event klik menyebar ke luar
                    userDropdown.classList.toggle('hidden'); // Toggle visibilitas dropdown
                    userDropdown.classList.toggle('opacity-100'); // Tambahkan efek transisi opasitas
                    userDropdown.classList.toggle('scale-100'); // Tambahkan efek transisi skala
                });

                // Event untuk menutup dropdown saat klik di luar
                window.addEventListener('click', function (e) {
                    // Tutup dropdown hanya jika klik terjadi di luar tombol atau dropdown
                    if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                        userDropdown.classList.remove('opacity-100', 'scale-100'); // Menghapus efek transisi saat menutup
                    }
                });
            }
        });
    </script>


</body>


</html>