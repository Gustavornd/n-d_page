<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MTD ADVOGADOS | Direito & Prestígio</title>
    <meta name="description" content="Soluções jurídicas de alto padrão para proteger seu patrimônio e seus direitos. Atendimento personalizado, ético e focado em resultados.">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_mtd_gold.png') }}">

    <!-- Google / Bunny Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cinzel:400,600,700,800,900|cormorant-garamond:400,500,600,700|playfair-display:400,600,700|figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0D0D0D] text-[#F9F9FB] font-sans antialiased selection:bg-[#D4AF37] selection:text-[#0D0D0D]" x-data="{ mobileMenuOpen: false, showAgendamentoModal: false, selectedService: '' }">

    <!-- ========================================== -->
    <!-- 1. CABEÇALHO (HEADER) - Fundo Preto Absoluto -->
    <!-- ========================================== -->
    <header class="bg-[#0D0D0D] border-b border-[#2C2C2C] sticky top-0 z-50 backdrop-blur-md bg-opacity-95 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 lg:h-24 flex items-center justify-between">
            
            <!-- ESQUERDA: Logotipo Dourado MTD + MTD ADVOGADOS -->
            <a href="#inicio" class="flex items-center gap-3.5 group cursor-pointer focus:outline-none">
                <img src="{{ asset('assets/logo_mtd_gold.png') }}" alt="Logotipo MTD Advogados" class="h-10 lg:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-[0_2px_8px_rgba(212,175,55,0.35)]">
                <span class="font-cinzel text-[#D4AF37] font-bold text-lg sm:text-xl lg:text-2xl tracking-[0.14em] leading-none transition-colors duration-300 group-hover:text-[#F3E5AB]">
                    MTD ADVOGADOS
                </span>
            </a>

            <!-- CENTRO: Menu de Navegação Horizontal -->
            <nav class="hidden md:flex items-center space-x-8 lg:space-x-12 text-sm font-medium">
                <a href="#inicio" class="text-[#F9F9FB] hover:text-[#D4AF37] transition duration-200 tracking-wide">
                    Início
                </a>
                <a href="#sobre" class="text-[#F9F9FB] hover:text-[#D4AF37] transition duration-200 tracking-wide">
                    Sobre Nós
                </a>
                <a href="#areas" class="text-[#F9F9FB] hover:text-[#D4AF37] transition duration-200 tracking-wide">
                    Áreas de Atuação
                </a>
                <a href="#contato" class="text-[#F9F9FB] hover:text-[#D4AF37] transition duration-200 tracking-wide">
                    Contato
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="text-[#D4AF37] hover:text-white transition duration-200 tracking-wide text-xs uppercase font-semibold border-b border-[#D4AF37]/50">
                        Painel
                    </a>
                @endauth
            </nav>

            <!-- DIREITA: Botão com borda fina dourada (outline) contendo o telefone -->
            <div class="hidden sm:flex items-center gap-4">
                <a href="tel:11999999999" class="border border-[#D4AF37] text-[#D4AF37] hover:bg-[#D4AF37] hover:text-[#0D0D0D] transition-all duration-300 font-medium text-sm px-6 py-2 rounded-full tracking-wider shadow-[0_0_12px_rgba(212,175,55,0.12)] hover:shadow-[0_0_20px_rgba(212,175,55,0.35)]">
                    (11) 99999-9999
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-[#D4AF37] p-2 focus:outline-none" aria-label="Menu principal">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-[#0D0D0D] border-b border-[#D4AF37]/30 px-6 py-5 space-y-4">
            <a href="#inicio" @click="mobileMenuOpen = false" class="block text-[#F9F9FB] hover:text-[#D4AF37] font-medium">Início</a>
            <a href="#sobre" @click="mobileMenuOpen = false" class="block text-[#F9F9FB] hover:text-[#D4AF37] font-medium">Sobre Nós</a>
            <a href="#areas" @click="mobileMenuOpen = false" class="block text-[#F9F9FB] hover:text-[#D4AF37] font-medium">Áreas de Atuação</a>
            <a href="#contato" @click="mobileMenuOpen = false" class="block text-[#F9F9FB] hover:text-[#D4AF37] font-medium">Contato</a>
            <a href="tel:11999999999" class="inline-block border border-[#D4AF37] text-[#D4AF37] px-5 py-2 rounded-full text-sm font-medium">(11) 99999-9999</a>
        </div>
    </header>

    <!-- ========================================================================= -->
    <!-- 2. SEÇÃO PRINCIPAL (HERO SECTION) - Fundo Cinza Grafite (#2C2C2C)         -->
    <!--    Com grafismos geométricos e linhas finas em dourado e prata            -->
    <!-- ========================================================================= -->
    <section id="inicio" class="relative bg-[#2C2C2C] overflow-hidden py-16 lg:py-24 min-h-[calc(100vh-96px)] flex items-center">
        
        <!-- Background Geométrico Vetorial de Linhas Douradas e Prateadas -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden select-none" aria-hidden="true">
            <!-- Radial Glow de Iluminação Superior Direita -->
            <div class="absolute -top-32 -right-32 w-[700px] h-[700px] rounded-full bg-[radial-gradient(circle,rgba(212,175,55,0.14)_0%,transparent_65%)] blur-3xl"></div>
            <!-- Radial Glow de Apoio Inferior Esquerda -->
            <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] rounded-full bg-[radial-gradient(circle,rgba(132,132,132,0.08)_0%,transparent_70%)] blur-3xl"></div>
            
            <!-- SVG Vetorial com as Linhas Geométricas do Protótipo -->
            <svg class="w-full h-full object-cover absolute inset-0 opacity-45 lg:opacity-60" viewBox="0 0 1440 900" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <!-- Linhas Diagonais e Facetas Geométricas Prata -->
                <line x1="720" y1="0" x2="1480" y2="760" stroke="#848484" stroke-width="1.4" stroke-opacity="0.35" />
                <line x1="880" y1="0" x2="1560" y2="680" stroke="#B4B4B4" stroke-width="0.9" stroke-opacity="0.25" />
                <line x1="1440" y1="60" x2="820" y2="680" stroke="#848484" stroke-width="1.2" stroke-opacity="0.3" />
                <line x1="1440" y1="200" x2="980" y2="660" stroke="#B4B4B4" stroke-width="0.8" stroke-opacity="0.25" />
                
                <!-- Polígonos Geométricos Finos -->
                <polygon points="1060,50 1380,240 1260,600 940,410" stroke="#848484" stroke-width="1.1" stroke-opacity="0.28" fill="none" />
                <polygon points="940,160 1260,350 1140,710 820,520" stroke="#D4AF37" stroke-width="0.85" stroke-opacity="0.22" fill="none" />

                <!-- Família de Curvas Douradas Concêntricas (como no protótipo) -->
                <path d="M 640 900 C 800 710, 1040 460, 1440 370" stroke="#D4AF37" stroke-width="2.0" stroke-opacity="0.45" />
                <path d="M 700 900 C 850 730, 1080 500, 1440 420" stroke="#D4AF37" stroke-width="1.4" stroke-opacity="0.35" />
                <path d="M 760 900 C 900 750, 1120 540, 1440 470" stroke="#D4AF37" stroke-width="1.0" stroke-opacity="0.28" />
                <path d="M 820 900 C 950 770, 1160 580, 1440 520" stroke="#D4AF37" stroke-width="0.8" stroke-opacity="0.22" />
                <path d="M 580 900 C 750 680, 1000 420, 1440 320" stroke="#D4AF37" stroke-width="0.9" stroke-opacity="0.25" />
                
                <!-- Linhas Sutis no Lado Esquerdo -->
                <line x1="-50" y1="360" x2="680" y2="920" stroke="#848484" stroke-width="0.8" stroke-opacity="0.15" />
                <path d="M0 640 C 240 670, 440 770, 580 900" stroke="#D4AF37" stroke-width="1.2" stroke-opacity="0.22" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full relative z-10">
            <!-- Grid 50% / 50% no Desktop -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                
                <!-- ============================================== -->
                <!-- COLUNA DA ESQUERDA (Mensagem de Impacto)       -->
                <!-- ============================================== -->
                <div class="flex flex-col items-start text-left">
                    
                    <!-- Badge Superior Dourado -->
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-[#D4AF37] text-[#0D0D0D] text-[11px] font-extrabold tracking-[0.2em] uppercase mb-6 shadow-[0_2px_12px_rgba(212,175,55,0.35)]">
                        ESCRITÓRIO DE ADVOCACIA
                    </div>

                    <!-- Título Principal (Headline) Imponente em Fonte Serifada Luxuosa -->
                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-[45px] xl:text-[48px] font-bold leading-[1.16] tracking-wide text-[#F9F9FB] mb-6 uppercase">
                        SOLUÇÕES JURÍDICAS<br>
                        DE <span class="text-[#D4AF37]">ALTO PADRÃO</span><br>
                        PARA <span class="text-[#D4AF37]">PROTEGER SEU</span><br>
                        <span class="text-[#D4AF37]">PATRIMÔNIO</span> E SEUS<br>
                        <span class="text-[#D4AF37]">DIREITOS</span>
                    </h1>

                    <!-- Subtítulo em Fonte Sans-Serif, Cor Prata -->
                    <p class="text-[#848484] text-base lg:text-lg font-normal leading-relaxed mb-8 max-w-xl">
                        Atendimento personalizado, ético e focado em resultados. Entre em contato conosco para agendar uma consulta com nossos especialistas.
                    </p>

                    <!-- Lista de Diferenciais com Checkmarks Dourados em Formato Roseta -->
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3.5">
                            <span class="flex-shrink-0 w-6 h-6 text-[#D4AF37] flex items-center justify-center drop-shadow-[0_0_8px_rgba(212,175,55,0.45)]">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 1.5l1.8 2.2 2.8-.4 1 2.6 2.7.9-.3 2.8 2.2 1.8-1.5 2.4 1.5 2.4-2.2 1.8.3 2.8-2.7.9-1 2.6-2.8-.4L12 22.5l-1.8-2.2-2.8.4-1-2.6-2.7-.9.3-2.8-2.2-1.8 1.5-2.4-1.5-2.4 2.2-1.8-.3-2.8 2.7-.9 1-2.6 2.8.4L12 1.5z" fill="#D4AF37" />
                                    <path d="M9.5 15.8l-3.3-3.3 1.4-1.4 1.9 1.9 5.8-5.8 1.4 1.4-7.2 7.2z" fill="#0D0D0D" />
                                </svg>
                            </span>
                            <span class="text-[#F9F9FB] text-sm sm:text-base font-medium tracking-wide">
                                Atendimento Especializado &amp; Exclusivo
                            </span>
                        </li>

                        <li class="flex items-center gap-3.5">
                            <span class="flex-shrink-0 w-6 h-6 text-[#D4AF37] flex items-center justify-center drop-shadow-[0_0_8px_rgba(212,175,55,0.45)]">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 1.5l1.8 2.2 2.8-.4 1 2.6 2.7.9-.3 2.8 2.2 1.8-1.5 2.4 1.5 2.4-2.2 1.8.3 2.8-2.7.9-1 2.6-2.8-.4L12 22.5l-1.8-2.2-2.8.4-1-2.6-2.7-.9.3-2.8-2.2-1.8 1.5-2.4-1.5-2.4 2.2-1.8-.3-2.8 2.7-.9 1-2.6 2.8.4L12 1.5z" fill="#D4AF37" />
                                    <path d="M9.5 15.8l-3.3-3.3 1.4-1.4 1.9 1.9 5.8-5.8 1.4 1.4-7.2 7.2z" fill="#0D0D0D" />
                                </svg>
                            </span>
                            <span class="text-[#F9F9FB] text-sm sm:text-base font-medium tracking-wide">
                                Confidencialidade e Segurança Absoluta
                            </span>
                        </li>

                        <li class="flex items-center gap-3.5">
                            <span class="flex-shrink-0 w-6 h-6 text-[#D4AF37] flex items-center justify-center drop-shadow-[0_0_8px_rgba(212,175,55,0.45)]">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 1.5l1.8 2.2 2.8-.4 1 2.6 2.7.9-.3 2.8 2.2 1.8-1.5 2.4 1.5 2.4-2.2 1.8.3 2.8-2.7.9-1 2.6-2.8-.4L12 22.5l-1.8-2.2-2.8.4-1-2.6-2.7-.9.3-2.8-2.2-1.8 1.5-2.4-1.5-2.4 2.2-1.8-.3-2.8 2.7-.9 1-2.6 2.8.4L12 1.5z" fill="#D4AF37" />
                                    <path d="M9.5 15.8l-3.3-3.3 1.4-1.4 1.9 1.9 5.8-5.8 1.4 1.4-7.2 7.2z" fill="#0D0D0D" />
                                </svg>
                            </span>
                            <span class="text-[#F9F9FB] text-sm sm:text-base font-medium tracking-wide">
                                Compromisso com o seu Caso
                            </span>
                        </li>
                    </ul>

                </div>

                <!-- ============================================== -->
                <!-- COLUNA DA DIREITA (O Formulário de Conversão)  -->
                <!-- ============================================== -->
                <div class="flex flex-col items-center lg:items-end justify-center w-full" id="contato">
                    <div class="w-full max-w-[480px] bg-[#0D0D0D] border-2 border-[#D4AF37] rounded-[28px] p-7 sm:p-9 shadow-[0_20px_50px_rgba(0,0,0,0.85),0_0_30px_rgba(212,175,55,0.22)] relative backdrop-blur-md">
                        
                        <!-- Título Interno -->
                        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#D4AF37] text-center tracking-wide">
                            Fale com um Especialista
                        </h2>

                        <!-- Descrição Curta -->
                        <p class="text-xs sm:text-sm text-[#F9F9FB] text-center mt-2 mb-6 font-normal">
                            Preencha o formulário e nossa equipe entrará em contato brevemente.
                        </p>

                        <!-- Feedback de Sucesso -->
                        @if(session('sucesso'))
                            <div class="mb-5 p-3.5 rounded-xl bg-[#D4AF37]/15 border border-[#D4AF37] text-[#F9F9FB] text-center text-xs sm:text-sm font-medium animate-pulse">
                                ✔ {{ session('sucesso') }}
                            </div>
                        @endif

                        <!-- Feedback de Erro Geral -->
                        @if($errors->any())
                            <div class="mb-5 p-3 rounded-xl bg-red-950/60 border border-red-500/50 text-red-200 text-xs">
                                <ul class="list-disc pl-4 space-y-1">
                                    @foreach($errors->all() as $erro)
                                        <li>{{ $erro }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulário de Conversão -->
                        <form action="{{ route('contato') }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Campo Nome Completo -->
                            <div>
                                <label for="hero_nome" class="block text-xs font-medium text-[#F9F9FB] mb-1.5 tracking-wide">
                                    Nome Completo
                                </label>
                                <input type="text" 
                                       id="hero_nome" 
                                       name="nome" 
                                       value="{{ old('nome') }}" 
                                       required 
                                       placeholder="Ex: João Silva" 
                                       class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] placeholder-[#848484] rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37] transition duration-200">
                                @error('nome') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Campo E-mail -->
                            <div>
                                <label for="hero_email" class="block text-xs font-medium text-[#F9F9FB] mb-1.5 tracking-wide">
                                    E-mail
                                </label>
                                <input type="email" 
                                       id="hero_email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       placeholder="Ex: contato@email.com" 
                                       class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] placeholder-[#848484] rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37] transition duration-200">
                                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Campo Telefone -->
                            <div>
                                <label for="hero_telefone" class="block text-xs font-medium text-[#F9F9FB] mb-1.5 tracking-wide">
                                    Telefone
                                </label>
                                <input type="text" 
                                       id="hero_telefone" 
                                       name="telefone" 
                                       value="{{ old('telefone') }}" 
                                       required 
                                       placeholder="Ex: (11) 99999-9999" 
                                       class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] placeholder-[#848484] rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37] transition duration-200">
                                @error('telefone') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Campo Mensagem -->
                            <div>
                                <label for="hero_mensagem" class="block text-xs font-medium text-[#F9F9FB] mb-1.5 tracking-wide">
                                    Mensagem
                                </label>
                                <textarea id="hero_mensagem" 
                                          name="mensagem" 
                                          rows="3" 
                                          required
                                          placeholder="Como podemos ajudar você?" 
                                          class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] placeholder-[#848484] rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37] transition duration-200 resize-none">{{ old('mensagem') }}</textarea>
                                @error('mensagem') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Botão CTA Chamativo em Gradiente Dourado -->
                            <div class="pt-2">
                                <button type="submit" 
                                        class="w-full py-4 rounded-lg bg-gradient-to-r from-[#D4AF37] via-[#F3E5AB] to-[#C5A028] text-[#0D0D0D] font-extrabold text-sm sm:text-base tracking-wider uppercase shadow-[0_4px_20px_rgba(212,175,55,0.4)] hover:brightness-105 active:scale-[0.99] transition duration-200 flex items-center justify-center gap-2">
                                    <span>ENVIAR MENSAGEM →</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Link discreto de agendamento online com data e horário fora do card -->
                    <div class="mt-4 text-center">
                        <button type="button" @click="showAgendamentoModal = true" class="text-xs text-[#848484] hover:text-[#D4AF37] transition inline-flex items-center gap-1.5 underline underline-offset-4">
                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Prefere agendar consulta com data e horário definidos?</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SEÇÃO SOBRE NÓS (#sobre) - Fundo Preto Absoluto (#0D0D0D)                -->
    <!-- ========================================================================= -->
    <section id="sobre" class="bg-[#0D0D0D] py-20 lg:py-28 border-t border-[#2C2C2C]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                
                <div>
                    <span class="text-[#D4AF37] font-serif text-xs uppercase tracking-[0.25em] font-semibold block mb-3">
                        SOBRE A MTD ADVOGADOS
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#F9F9FB] leading-tight mb-6">
                        Compromisso Inegociável com a Defesa dos Seus <span class="text-[#D4AF37]">Interesses Mais Preciosos</span>
                    </h2>
                    <p class="text-[#848484] text-base leading-relaxed mb-6">
                        Fundado com o propósito de elevar a advocacia a um patamar de distinção e resultado, o escritório <strong class="text-[#F9F9FB]">MTD ADVOGADOS DIREITO &amp; PRESTÍGIO</strong> atua na assessoria jurídica estratégica e contenciosa de alta complexidade.
                    </p>
                    <p class="text-[#848484] text-base leading-relaxed mb-8">
                        Combinamos rigor técnico, sigilo absoluto e visão personalizada para cada cliente, assegurando a máxima blindagem patrimonial, resolução corporativa e proteção de direitos individuais.
                    </p>

                    <div class="grid grid-cols-3 gap-6 pt-4 border-t border-[#2C2C2C]">
                        <div>
                            <span class="block font-serif text-2xl lg:text-3xl font-bold text-[#D4AF37]">15+</span>
                            <span class="text-xs text-[#848484] uppercase tracking-wider">Anos de Excelência</span>
                        </div>
                        <div>
                            <span class="block font-serif text-2xl lg:text-3xl font-bold text-[#D4AF37]">98%</span>
                            <span class="text-xs text-[#848484] uppercase tracking-wider">Casos de Êxito</span>
                        </div>
                        <div>
                            <span class="block font-serif text-2xl lg:text-3xl font-bold text-[#D4AF37]">100%</span>
                            <span class="text-xs text-[#848484] uppercase tracking-wider">Confidencialidade</span>
                        </div>
                    </div>
                </div>

                <div class="relative flex justify-center">
                    <div class="w-full max-w-md bg-[#2C2C2C] p-8 rounded-2xl border border-[#D4AF37]/40 shadow-[0_10px_35px_rgba(0,0,0,0.7)] text-center relative overflow-hidden">
                        <div class="absolute -top-16 -right-16 w-36 h-36 bg-[#D4AF37]/10 rounded-full blur-xl"></div>
                        <img src="{{ asset('assets/logo_mtd_gold.png') }}" alt="Emblema MTD" class="h-28 mx-auto mb-6 object-contain drop-shadow-[0_0_15px_rgba(212,175,55,0.4)]">
                        <h3 class="font-serif text-xl font-bold text-[#D4AF37] tracking-wider mb-2">DIREITO &amp; PRESTÍGIO</h3>
                        <p class="text-xs text-[#848484] leading-relaxed">
                            "A advocacia de alta performance não se limita a resolver litígios; ela antecipa riscos e constrói legados duradouros."
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SEÇÃO ÁREAS DE ATUAÇÃO (#areas) - Fundo Cinza Grafite (#2C2C2C)           -->
    <!-- Carrega dinamicamente os serviços ativos cadastrados no backend           -->
    <!-- ========================================================================= -->
    <section id="areas" class="bg-[#2C2C2C] py-20 lg:py-28 relative border-t border-[#0D0D0D]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-[#D4AF37] font-serif text-xs uppercase tracking-[0.25em] font-semibold block mb-3">
                    ESPECIALIDADES JURÍDICAS
                </span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#F9F9FB] leading-tight mb-4">
                    Áreas de Atuação Especializadas
                </h2>
                <p class="text-[#848484] text-base leading-relaxed">
                    Atuação focada e multidisciplinar, estruturada para atender as demandas mais exigentes com eficiência e solidez jurídica.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($servicos as $servico)
                    <div class="bg-[#0D0D0D] border border-[#D4AF37]/30 hover:border-[#D4AF37] rounded-2xl p-7 transition duration-300 shadow-[0_10px_25px_rgba(0,0,0,0.5)] flex flex-col justify-between group">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-[#2C2C2C] border border-[#D4AF37]/50 flex items-center justify-center text-[#D4AF37] mb-5 group-hover:bg-[#D4AF37] group-hover:text-[#0D0D0D] transition-all duration-300">
                                <svg class="w-6 h-6 stroke-current fill-none stroke-[1.8]" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l9-4 9 4v6c0 5.55-3.84 10.74-9 12-5.16-1.26-9-6.45-9-12V6z" />
                                </svg>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-[#F9F9FB] group-hover:text-[#D4AF37] transition duration-200 mb-3">
                                {{ $servico->titulo }}
                            </h3>
                            <p class="text-[#848484] text-sm leading-relaxed mb-6">
                                {{ $servico->descricao ?? 'Assessoria e consultoria jurídica personalizada, com dedicação exclusiva e estratégica para o seu caso.' }}
                            </p>
                        </div>
                        
                        <div class="pt-4 border-t border-[#2C2C2C]">
                            <button type="button" @click="selectedService = '{{ $servico->id }}'; showAgendamentoModal = true" class="text-xs font-semibold text-[#D4AF37] hover:text-[#F9F9FB] inline-flex items-center gap-1.5 transition">
                                <span>Agendar Consulta</span>
                                <span>→</span>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-[#0D0D0D] border border-[#2C2C2C] rounded-2xl">
                        <p class="text-[#848484]">Nenhuma especialidade cadastrada no momento. Entre em contato diretamente para consultar nossa equipe.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. RODAPÉ (FOOTER) - Fundo Preto Absoluto (#0D0D0D)                       -->
    <!-- ========================================================================= -->
    <!-- 3. RODAPÉ (FOOTER) - Fundo Preto Absoluto (#0D0D0D)                       -->
    <!-- ========================================================================= -->
    <footer class="bg-[#0D0D0D] border-t border-[#2C2C2C] py-12 lg:py-14">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col items-center justify-center text-center">
            
            <!-- Logotipo de Apoio "M/T/D ADVOGADOS" em Dourado -->
            <div class="flex flex-col items-center justify-center mb-6">
                <div class="font-cinzel text-[#D4AF37] text-2xl sm:text-3xl font-bold tracking-[0.25em] leading-none">
                    M/T/D
                </div>
                <div class="font-cinzel text-[#D4AF37] text-xs sm:text-sm tracking-[0.35em] uppercase font-semibold mt-2">
                    ADVOGADOS
                </div>
            </div>

            <!-- Contatos na Mesma Linha em Prata/Off-White com Ícones Discretos -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-sm text-[#848484] mb-6">
                <a href="mailto:mtd.contato@email.com" class="inline-flex items-center gap-2.5 text-[#F9F9FB] hover:text-[#D4AF37] transition duration-200">
                    <svg class="w-4 h-4 text-[#D4AF37]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                    <span>mtd.contato@email.com</span>
                </a>

                <a href="https://wa.me/5511999999999" target="_blank" rel="noopener" class="inline-flex items-center gap-2.5 text-[#F9F9FB] hover:text-[#D4AF37] transition duration-200">
                    <svg class="w-4 h-4 text-[#D4AF37]" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M9.53 7.03C9.36 7.03 9.09 7.09 8.87 7.33C8.65 7.57 8.02 8.16 8.02 9.36C8.02 10.56 8.9 11.72 9.02 11.89C9.14 12.05 10.73 14.5 13.16 15.56C13.74 15.81 14.19 15.96 14.54 16.07C15.13 16.26 15.66 16.23 16.09 16.17C16.57 16.1 17.56 15.57 17.77 14.98C17.98 14.4 17.98 13.89 17.91 13.79C17.85 13.68 17.69 13.62 17.43 13.49C17.18 13.36 15.95 12.75 15.72 12.67C15.5 12.58 15.33 12.54 15.17 12.79C15 13.03 14.53 13.62 14.39 13.79C14.25 13.95 14.11 13.98 13.86 13.85C13.61 13.72 12.81 13.46 11.86 12.61C11.12 11.95 10.62 11.14 10.48 10.89C10.34 10.64 10.46 10.51 10.59 10.38C10.7 10.27 10.84 10.09 10.96 9.94C11.08 9.8 11.12 9.69 11.21 9.53C11.29 9.36 11.25 9.22 11.19 9.1C11.12 8.97 10.62 7.76 10.42 7.25C10.22 6.77 10.02 6.83 9.86 6.82C9.72 6.82 9.55 6.82 9.53 7.03Z"/>
                    </svg>
                    <span>(11) 99999-9999</span>
                </a>
            </div>

            <!-- Direitos Autorais no Rodapé Inferior -->
            <p class="text-xs text-[#848484] tracking-wide">
                © 2026 MTD Advogados. Todos os direitos reservados.
            </p>

        </div>
    </footer>

    <!-- ========================================================================= -->
    <!-- MODAL DE AGENDAMENTO DE CONSULTA ONLINE                                  -->
    <!-- Totalmente integrado ao sistema de Agendamento, Expedientes e Servicos    -->
    <!-- ========================================================================= -->
    <div x-show="showAgendamentoModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
        
        <div @click.away="showAgendamentoModal = false" 
             class="w-full max-w-lg bg-[#0D0D0D] border-2 border-[#D4AF37] rounded-3xl p-6 sm:p-8 shadow-[0_25px_60px_rgba(0,0,0,0.95),0_0_35px_rgba(212,175,55,0.3)] relative">
            
            <!-- Fechar Modal -->
            <button @click="showAgendamentoModal = false" class="absolute top-5 right-5 text-[#848484] hover:text-[#D4AF37] transition text-xl font-bold p-1">
                ✕
            </button>

            <div class="text-center mb-6">
                <span class="text-[#D4AF37] font-serif text-[10px] uppercase tracking-[0.25em] font-semibold block mb-1">
                    AGENDAMENTO EXCLUSIVO
                </span>
                <h3 class="font-serif text-2xl font-bold text-[#F9F9FB]">
                    Agendar Consulta com Especialista
                </h3>
                <p class="text-xs text-[#848484] mt-1.5">
                    Escolha a data, horário e especialidade desejada para o seu atendimento.
                </p>
            </div>

            <form action="{{ route('agendar') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-medium text-[#F9F9FB] mb-1">Nome Completo</label>
                    <input type="text" name="nome" value="{{ old('nome') }}" required placeholder="Seu nome"
                           class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] placeholder-[#848484] rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#F9F9FB] mb-1">E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="seu@email.com"
                               class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] placeholder-[#848484] rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#F9F9FB] mb-1">Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone') }}" required placeholder="(11) 99999-9999"
                               class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] placeholder-[#848484] rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#F9F9FB] mb-1">Área de Atendimento</label>
                    <select name="servico_id" required x-model="selectedService"
                            class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37]">
                        <option value="" disabled selected>Selecione uma especialidade</option>
                        @foreach ($servicos as $servico)
                            <option value="{{ $servico->id }}" {{ old('servico_id') == $servico->id ? 'selected' : '' }}>
                                {{ $servico->titulo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#F9F9FB] mb-1">Data</label>
                        <input type="date" name="data" value="{{ old('data') }}" required
                               onclick="this.showPicker()"
                               class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#F9F9FB] mb-1">Horário</label>
                        <input type="time" name="horario" value="{{ old('horario') }}" required step="3600"
                               onclick="this.showPicker()"
                               class="w-full bg-[#181818] border border-[#848484]/50 focus:border-[#D4AF37] text-[#F9F9FB] rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#D4AF37]">
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" 
                            class="w-full py-3.5 rounded-lg bg-gradient-to-r from-[#D4AF37] via-[#F3E5AB] to-[#C5A028] text-[#0D0D0D] font-extrabold text-sm tracking-wider uppercase shadow-[0_4px_15px_rgba(212,175,55,0.4)] hover:brightness-105 active:scale-[0.99] transition duration-200">
                        CONFIRMAR AGENDAMENTO →
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>