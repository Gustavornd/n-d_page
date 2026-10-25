<nav x-data="{ open: false }" class="bg-preto-absoluto border-b border-[#222222] sticky top-0 z-50 backdrop-blur-md bg-preto-absoluto/95">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Esquerda: Logotipo ND + Nunes & Durães ADVOCACIA -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <img src="{{ asset('assets/logo_nd_gold.png') }}" alt="Logo Nunes & Durães"
                        class="h-10 sm:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-[0_0_10px_rgba(212,175,55,0.3)]">
                    <div class="flex flex-col">
                        <span class="font-serif font-bold text-base sm:text-lg tracking-wider text-dourado-prestigio uppercase leading-tight">
                            Nunes &amp; Durães
                        </span>
                        <span class="font-sans text-[9px] sm:text-[10px] tracking-[0.28em] text-prata-moderno uppercase -mt-0.5 font-medium">
                            ADVOCACIA
                        </span>
                    </div>
                </a>
            </div>

            <!-- Centro: Menu de navegação horizontal discreto -->
            <div class="hidden md:flex items-center space-x-7 lg:space-x-9">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium tracking-wide transition-colors duration-200 {{ request()->routeIs('home') ? 'text-dourado-prestigio font-semibold' : 'text-off-white hover:text-dourado-prestigio' }}">
                    {{ __('Início') }}
                </a>
                <a href="{{ route('home') }}#sobre-nos"
                    class="text-sm font-medium tracking-wide text-off-white hover:text-dourado-prestigio transition-colors duration-200">
                    {{ __('Sobre Nós') }}
                </a>
                <a href="{{ route('home') }}#areas-de-atuacao"
                    class="text-sm font-medium tracking-wide text-off-white hover:text-dourado-prestigio transition-colors duration-200">
                    {{ __('Áreas de Atuação') }}
                </a>
                <a href="{{ route('home') }}#contato"
                    class="text-sm font-medium tracking-wide text-off-white hover:text-dourado-prestigio transition-colors duration-200">
                    {{ __('Contato') }}
                </a>

                @auth
                    <a href="{{ route('servicos.index') }}"
                        class="text-sm font-medium tracking-wide transition-colors duration-200 {{ request()->routeIs('servicos.*') ? 'text-dourado-prestigio font-semibold' : 'text-prata-moderno hover:text-dourado-prestigio' }}">
                        {{ __('Serviços') }}
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-medium tracking-wide transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-dourado-prestigio font-semibold' : 'text-prata-moderno hover:text-dourado-prestigio' }}">
                        {{ __('Gestão') }}
                    </a>
                @endauth
            </div>

            <!-- Direita: Telefone em botão outline dourado + Área de Acesso -->
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <a href="tel:11999999999"
                    class="inline-flex items-center px-4 sm:px-5 py-2 rounded-full border border-dourado-prestigio text-dourado-prestigio text-xs sm:text-sm font-medium tracking-wider hover:bg-dourado-prestigio hover:text-preto-absoluto transition-all duration-300 shadow-[0_0_12px_rgba(212,175,55,0.15)]">
                    (11) 99999-9999
                </a>

                @auth
                    <!-- Dropdown de Usuário Logado -->
                    <x-dropdown align="right" width="48" contentClasses="py-1 bg-[#181818] border border-dourado-prestigio/30 shadow-2xl">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-1.5 border border-prata-moderno/40 text-xs font-medium rounded-full text-off-white bg-cinza-grafite hover:border-dourado-prestigio hover:text-dourado-prestigio focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1.5">
                                    <svg class="fill-current h-3.5 w-3.5 text-dourado-prestigio" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')" class="!text-off-white hover:!bg-cinza-grafite hover:!text-dourado-prestigio">
                                {{ __('Gestão') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('servicos.index')" class="!text-off-white hover:!bg-cinza-grafite hover:!text-dourado-prestigio">
                                {{ __('Serviços') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')" class="!text-off-white hover:!bg-cinza-grafite hover:!text-dourado-prestigio">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="!text-red-400 hover:!bg-cinza-grafite" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-xs text-prata-moderno hover:text-dourado-prestigio transition-colors duration-200 ml-1" title="Área Restrita">
                        Entrar
                    </a>
                @endauth
            </div>

            <!-- Botão Mobile Hamburguer -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-dourado-prestigio hover:bg-cinza-grafite focus:outline-none transition duration-150 ease-in-out">
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

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-[#121212] border-t border-[#222222]">
        <div class="pt-3 pb-4 px-4 space-y-2">
            <a href="{{ route('home') }}"
                class="block py-2 text-base font-medium {{ request()->routeIs('home') ? 'text-dourado-prestigio font-semibold' : 'text-off-white hover:text-dourado-prestigio' }}">
                {{ __('Início') }}
            </a>
            <a href="{{ route('home') }}#sobre-nos" @click="open = false"
                class="block py-2 text-base font-medium text-off-white hover:text-dourado-prestigio">
                {{ __('Sobre Nós') }}
            </a>
            <a href="{{ route('home') }}#areas-de-atuacao" @click="open = false"
                class="block py-2 text-base font-medium text-off-white hover:text-dourado-prestigio">
                {{ __('Áreas de Atuação') }}
            </a>
            <a href="{{ route('home') }}#contato" @click="open = false"
                class="block py-2 text-base font-medium text-off-white hover:text-dourado-prestigio">
                {{ __('Contato') }}
            </a>

            @auth
                <a href="{{ route('servicos.index') }}"
                    class="block py-2 text-base font-medium text-prata-moderno hover:text-dourado-prestigio">
                    {{ __('Serviços') }}
                </a>
                <a href="{{ route('dashboard') }}"
                    class="block py-2 text-base font-medium text-prata-moderno hover:text-dourado-prestigio">
                    {{ __('Gestão') }}
                </a>
            @endauth

            <div class="pt-3 pb-1 border-t border-[#222222] flex flex-col gap-3">
                <a href="tel:11999999999"
                    class="text-center py-2.5 rounded-full border border-dourado-prestigio text-dourado-prestigio text-sm font-medium tracking-wider">
                    (11) 99999-9999
                </a>

                @auth
                    <div class="text-xs text-prata-moderno px-1">Logado como: <strong class="text-off-white">{{ Auth::user()->name }}</strong></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-400 hover:underline">Sair do sistema</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-xs text-center text-prata-moderno hover:text-dourado-prestigio">
                        Entrar no Painel Administrativo
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>