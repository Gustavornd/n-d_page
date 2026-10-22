<nav x-data="{ open: false }" class="bg-carbon-black border-b border-white-500">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo_escritorio.jpg') }}" alt="Logo do Escritório"
                            class="block h-9 w-9 rounded-full fill-current object-cover">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex ">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                        class="{{ request()->routeIs('home') ? '!text-bright-amber' : '!text-dust-grey hover:!text-bright-amber' }}">
                        {{ __('Início') }}
                    </x-nav-link>
                </div>

                @auth
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('servicos.index')" :active="request()->routeIs('servicos.*')"
                            class="{{ request()->routeIs('servicos.*') ? '!text-bright-amber' : '!text-dust-grey hover:!text-bright-amber' }}">
                            {{ __('Serviços') }}
                        </x-nav-link>
                    </div>
                @endauth

                <!-- Botão de Gestão visível APENAS para usuários logados -->
                @auth
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="{{ request()->routeIs('dashboard') ? '!text-bright-amber' : '!text-dust-grey hover:!text-bright-amber' }}">
                            {{ __('Gestão') }}
                        </x-nav-link>
                    </div>
                @endauth

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48" class="text-bright-amber">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-carbon-black bg-bright-amber hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()?->name ?? 'Visitante' }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @auth
                            <!-- Aparece se estiver Logado -->
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <!-- Aparece se for Visitante -->
                            <x-dropdown-link :href="route('login')">
                                {{ __('Entrar') }}
                            </x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-bright-amber hover:text-bright-lemon hover:bg-bright-lemon focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 text-bright-amber">

            @auth
                <x-responsive-nav-link :href="route('servicos.index')" :active="request()->routeIs('servicos.*')"
                    class="text-bright-amber">
                    {{ __('Serviços') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="text-bright-amber">
                    {{ __('Gestão') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-bright-amber">{{ Auth::user()?->name ?? 'Visitante' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()?->email }}</div>
            </div>

            <div class="mt-3 space-y-1 text-bright-amber">
                @auth
                    <!-- Aparece se estiver Logado (Mobile) -->
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-bright-amber">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}" class="text-bright-amber">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <!-- Aparece se for Visitante (Mobile) -->
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Entrar') }}
                    </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>