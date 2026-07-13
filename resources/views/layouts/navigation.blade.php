<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-2">
                <!-- Logo -->
                <img src="{{ asset('images/logo.png') }}" alt="RencanaKarierku Logo" class="w-8 h-8 object-contain">

                <a href="{{ url('/') }}" class="font-bold text-xl tracking-tight text-slate-900">
                    Rencana<span class="text-primary-600">Karierku</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex gap-8">
                <a href="{{ url('/') }}" class="text-sm font-medium {{ request()->is('/') ? 'text-primary-600 font-bold' : 'text-slate-600 hover:text-primary-600' }} transition-colors">Home</a>
                <a href="{{ route('perjalananku.index') }}" class="text-sm font-medium {{ request()->routeIs('perjalananku.*') || request()->routeIs('asesmen.*') || request()->routeIs('eksplorasi.*') || request()->routeIs('keputusan.*') ? 'text-primary-600 font-bold' : 'text-slate-600 hover:text-primary-600' }} transition-colors">Perjalananku</a>
                <a href="{{ route('contact') }}" class="text-sm font-medium {{ request()->routeIs('contact') ? 'text-primary-600 font-bold' : 'text-slate-600 hover:text-primary-600' }} transition-colors">Contact</a>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-slate-600 bg-transparent hover:text-primary-600 focus:outline-none transition-colors">
                            <div>{{ Auth::user()?->name ?? 'Budi Santoso' }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('hasilkeputusan')">
                            {{ __('Riwayat') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('perjalananku.index')" :active="request()->routeIs('perjalananku.*') || request()->routeIs('asesmen.*') || request()->routeIs('eksplorasi.*') || request()->routeIs('keputusan.*')">
                {{ __('Perjalananku') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()?->name ?? 'Budi Santoso' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()?->email ?? 'budi@example.com' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('hasilkeputusan')">
                    {{ __('Riwayat') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
