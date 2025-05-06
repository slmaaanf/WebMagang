<nav class="bg-[#679CEB] py-3 shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-white font-bold text-2xl flex items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 mr-2">
            Telkom Internship
        </a>

        <!-- Hamburger Button (Mobile Only) -->
        <button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Menu Navbar -->
        <ul id="menu" class="hidden flex-col gap-4 absolute top-16 left-0 w-full bg-[#679CEB] lg:static lg:flex lg:flex-row lg:items-center lg:w-auto">
            <li>
                <a href="{{ route('contact') }}" class="block text-white hover:text-gray-200 px-4 py-2">Hubungi Kami</a>
            </li>
            @if(Auth::check() && Auth::user()->role == 'admin')
            <li>
                <a href="{{ route('admin.arsip') }}" 
                    class="block {{ request()->routeIs('admin.arsip') ? 'text-gray-700 font-semibold' : 'text-white' }} px-4 py-2">
                    Arsip
                </a>
            </li>
            @endif

            <li>
                <a href="{{ route('internships.index') }}" 
                    class="block {{ request()->routeIs('internships.index') ? 'text-gray-700 font-semibold' : 'text-white' }} px-4 py-2">
                   Program Magang
                </a>
            </li>

            @auth
                @switch(Auth::user()->role)
                    @case('admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" 
                                class="block {{ request()->routeIs('admin.dashboard') ? 'text-gray-700 font-semibold' : 'text-white' }} px-4 py-2">
                               Dashboard Admin
                            </a>
                        </li>
                        @break
                    @case('pembimbing')
                        <li>
                            <a href="{{ route('pembimbing.dashboard') }}" 
                                class="block {{ request()->routeIs('pembimbing.dashboard') ? 'text-gray-700 font-semibold' : 'text-white' }} px-4 py-2">
                               Dashboard Pembimbing
                            </a>
                        </li>
                        @break
                    @case('user')
                        <li>
                            <a href="{{ route('user.dashboard') }}" 
                                class="block {{ request()->routeIs('user.dashboard') ? 'text-gray-700 font-semibold' : 'text-white' }} px-4 py-2">
                               Dashboard User
                            </a>
                        </li>
                        @break
                @endswitch

                <!-- Profil Dropdown -->
                <li class="relative">
                    <button id="dropdownToggle" onclick="toggleDropdown()" class="flex items-center space-x-2 text-white focus:outline-none px-4 py-2">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : asset('images/profile/default.png') }}" 
                            class="rounded-full w-8 h-8" alt="Profil">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 hidden">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profil</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">Logout</button>
                        </form>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="block bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition-all duration-300">
                        Log in/Register
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Script Toggle -->
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    function toggleDropdown() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('hidden');
    }

    window.onclick = function(event) {
        const toggle = document.getElementById('dropdownToggle');
        const dropdown = document.getElementById('profileDropdown');

        if (!toggle.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    };
</script>

@push('styles')
<style>
    .text-gray-700 {
        color: #1a202c !important;
        font-weight: 600 !important;
    }
</style>
@endpush
