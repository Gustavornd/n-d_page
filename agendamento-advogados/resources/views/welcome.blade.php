@extends('layouts.app')

@section('content')
<div class="flex-grow flex flex-col justify-between" id="inicio">

    <!-- SEÇÃO PRINCIPAL (HERO SECTION) - Fundo Cinza Grafite (#2C2C2C), textura e grafismos geométricos de luxo (image_12.png) -->
    <section class="relative z-10 w-full flex-grow flex items-center bg-cinza-grafite bg-dark-luxury-lines overflow-hidden py-12 lg:py-16">
        
        <!-- Grafismos Geométricos Vetoriais (Dourado & Prata) fiéis ao protótipo de luxo -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden select-none" aria-hidden="true">
            <!-- Glows radiais sutis de iluminação ambiente -->
            <div class="absolute -top-32 -right-32 w-[650px] h-[650px] rounded-full bg-[radial-gradient(circle,rgba(212,175,55,0.14)_0%,transparent_65%)] blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] rounded-full bg-[radial-gradient(circle,rgba(132,132,132,0.10)_0%,transparent_70%)] blur-3xl"></div>
            <div class="absolute top-1/2 left-1/3 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-[radial-gradient(circle,rgba(212,175,55,0.06)_0%,transparent_60%)] blur-2xl"></div>

            <!-- SVG Vetorial com Linhas Geométricas e Curvas Douradas Concêntricas fiéis ao layout Dark-Luxury -->
            <svg class="w-full h-full absolute inset-0 opacity-50 lg:opacity-65" viewBox="0 0 1440 900" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
                <!-- Linhas Retas Prata e Dourada Diagonais -->
                <line x1="720" y1="0" x2="1480" y2="760" stroke="#848484" stroke-width="1.3" stroke-opacity="0.4" />
                <line x1="880" y1="0" x2="1560" y2="680" stroke="#B4B4B4" stroke-width="0.9" stroke-opacity="0.3" />
                <line x1="1440" y1="60" x2="820" y2="680" stroke="#848484" stroke-width="1.2" stroke-opacity="0.35" />
                <line x1="1440" y1="200" x2="980" y2="660" stroke="#B4B4B4" stroke-width="0.8" stroke-opacity="0.25" />
                
                <!-- Polígonos Geométricos (Losangos Prata e Dourado) -->
                <polygon points="1060,50 1380,240 1260,600 940,410" stroke="#848484" stroke-width="1.1" stroke-opacity="0.32" fill="none" />
                <polygon points="940,160 1260,350 1140,710 820,520" stroke="#D4AF37" stroke-width="0.85" stroke-opacity="0.28" fill="none" />

                <!-- Família de Curvas Douradas Concêntricas de Alto Padrão -->
                <path d="M 640 900 C 800 710, 1040 460, 1440 370" stroke="#D4AF37" stroke-width="2.0" stroke-opacity="0.48" />
                <path d="M 700 900 C 850 730, 1080 500, 1440 420" stroke="#D4AF37" stroke-width="1.4" stroke-opacity="0.38" />
                <path d="M 760 900 C 900 750, 1120 540, 1440 470" stroke="#D4AF37" stroke-width="1.0" stroke-opacity="0.30" />
                <path d="M 820 900 C 950 770, 1160 580, 1440 520" stroke="#D4AF37" stroke-width="0.8" stroke-opacity="0.24" />
                <path d="M 580 900 C 750 680, 1000 420, 1440 320" stroke="#D4AF37" stroke-width="0.9" stroke-opacity="0.26" />

                <!-- Linhas de Apoio Inferiores -->
                <line x1="-50" y1="360" x2="680" y2="920" stroke="#848484" stroke-width="0.8" stroke-opacity="0.18" />
                <path d="M0 640 C 240 670, 440 770, 580 900" stroke="#D4AF37" stroke-width="1.2" stroke-opacity="0.25" />
            </svg>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 w-full">
            <!-- Grid 50% / 50% Desktop -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                
                <!-- COLUNA DA ESQUERDA (Mensagem de Impacto) -->
                <div class="flex flex-col items-start text-left">
                    <!-- Badge Dourado -->
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-dourado-prestigio text-preto-absoluto text-[11px] sm:text-xs font-extrabold tracking-[0.2em] uppercase mb-6 shadow-[0_2px_12px_rgba(212,175,55,0.35)]">
                        ESCRITÓRIO DE ADVOCACIA
                    </div>

                    <!-- Headline Imponente em Fonte Serifada Luxuosa -->
                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-[44px] xl:text-[48px] font-bold leading-[1.14] tracking-wide text-off-white mb-6 uppercase">
                        SOLUÇÕES JURÍDICAS<br>
                        DE <span class="text-dourado-prestigio">ALTO PADRÃO</span><br>
                        PARA <span class="text-dourado-prestigio">PROTEGER SEU</span><br>
                        <span class="text-dourado-prestigio">PATRIMÔNIO</span> E SEUS<br>
                        <span class="text-dourado-prestigio">DIREITOS</span>
                    </h1>

                    <!-- Subtítulo em Fonte Sans-Serif Prata -->
                    <p class="text-prata-moderno text-base sm:text-lg font-normal leading-relaxed mb-8 max-w-xl">
                        Atendimento personalizado, ético e focado em resultados. Entre em contato conosco para agendar uma consulta com nossos especialistas.
                    </p>

                    <!-- Lista de Diferenciais com Checkmarks/Selo Dourados -->
                    <ul class="space-y-4 mb-2">
                        <li class="flex items-center gap-3.5">
                            <span class="flex-shrink-0 w-6 h-6 text-dourado-prestigio flex items-center justify-center drop-shadow-[0_0_8px_rgba(212,175,55,0.45)]">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 1.5l1.8 2.2 2.8-.4 1 2.6 2.7.9-.3 2.8 2.2 1.8-1.5 2.4 1.5 2.4-2.2 1.8.3 2.8-2.7.9-1 2.6-2.8-.4L12 22.5l-1.8-2.2-2.8.4-1-2.6-2.7-.9.3-2.8-2.2-1.8 1.5-2.4-1.5-2.4 2.2-1.8-.3-2.8 2.7-.9 1-2.6 2.8.4L12 1.5z" fill="#D4AF37" />
                                    <path d="M9.5 15.8l-3.3-3.3 1.4-1.4 1.9 1.9 5.8-5.8 1.4 1.4-7.2 7.2z" fill="#0D0D0D" />
                                </svg>
                            </span>
                            <span class="text-off-white text-sm sm:text-base font-medium tracking-wide">
                                Atendimento Especializado &amp; Exclusivo
                            </span>
                        </li>
                        <li class="flex items-center gap-3.5">
                            <span class="flex-shrink-0 w-6 h-6 text-dourado-prestigio flex items-center justify-center drop-shadow-[0_0_8px_rgba(212,175,55,0.45)]">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 1.5l1.8 2.2 2.8-.4 1 2.6 2.7.9-.3 2.8 2.2 1.8-1.5 2.4 1.5 2.4-2.2 1.8.3 2.8-2.7.9-1 2.6-2.8-.4L12 22.5l-1.8-2.2-2.8.4-1-2.6-2.7-.9.3-2.8-2.2-1.8 1.5-2.4-1.5-2.4 2.2-1.8-.3-2.8 2.7-.9 1-2.6 2.8.4L12 1.5z" fill="#D4AF37" />
                                    <path d="M9.5 15.8l-3.3-3.3 1.4-1.4 1.9 1.9 5.8-5.8 1.4 1.4-7.2 7.2z" fill="#0D0D0D" />
                                </svg>
                            </span>
                            <span class="text-off-white text-sm sm:text-base font-medium tracking-wide">
                                Confidencialidade e Segurança Absoluta
                            </span>
                        </li>
                        <li class="flex items-center gap-3.5">
                            <span class="flex-shrink-0 w-6 h-6 text-dourado-prestigio flex items-center justify-center drop-shadow-[0_0_8px_rgba(212,175,55,0.45)]">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 1.5l1.8 2.2 2.8-.4 1 2.6 2.7.9-.3 2.8 2.2 1.8-1.5 2.4 1.5 2.4-2.2 1.8.3 2.8-2.7.9-1 2.6-2.8-.4L12 22.5l-1.8-2.2-2.8.4-1-2.6-2.7-.9.3-2.8-2.2-1.8 1.5-2.4-1.5-2.4 2.2-1.8-.3-2.8 2.7-.9 1-2.6 2.8.4L12 1.5z" fill="#D4AF37" />
                                    <path d="M9.5 15.8l-3.3-3.3 1.4-1.4 1.9 1.9 5.8-5.8 1.4 1.4-7.2 7.2z" fill="#0D0D0D" />
                                </svg>
                            </span>
                            <span class="text-off-white text-sm sm:text-base font-medium tracking-wide">
                                Compromisso com o seu Caso
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- COLUNA DA DIREITA (O Formulário de Conversão - ESTILIZAR O EXISTENTE) -->
                <div class="flex flex-col items-center lg:items-end justify-center w-full">
                    <div class="w-full max-w-[500px] bg-preto-absoluto border-2 border-dourado-prestigio rounded-[28px] p-7 sm:p-9 shadow-[0_20px_50px_rgba(0,0,0,0.85),0_0_25px_rgba(212,175,55,0.22)] relative backdrop-blur-md">
                        
                        <!-- Título interno do card -->
                        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-dourado-prestigio text-center tracking-wide">
                            Fale com um Especialista
                        </h2>
                        
                        <!-- Descrição curta -->
                        <p class="text-xs sm:text-sm text-off-white text-center mt-2 mb-6 font-normal">
                            Preencha o formulário e nossa equipe entrará em contato brevemente.
                        </p>

                        <!-- Alerta de Sucesso -->
                        @if(session('sucesso'))
                            <div class="mb-5 p-3.5 rounded-xl bg-green-500/20 border border-green-500 text-green-200 text-center text-sm font-medium">
                                ✔ {{ session('sucesso') }}
                            </div>
                        @endif

                        <!-- Formulário de Agendamento/Contato Existente no Backend -->
                        <form action="{{ route('agendar') }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Nome Completo -->
                            <div>
                                <label for="nome" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    Nome Completo
                                </label>
                                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required placeholder="Ex: João Silva"
                                    class="w-full bg-[#181818] border @error('nome') border-red-500/80 focus:border-red-500 focus:ring-red-500/50 @else border-prata-moderno/40 focus:border-dourado-prestigio focus:ring-dourado-prestigio/50 @enderror text-off-white placeholder-prata-moderno rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 transition duration-200" />
                                @error('nome') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- E-mail -->
                            <div>
                                <label for="email" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    E-mail
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Ex: contato@email.com"
                                    class="w-full bg-[#181818] border @error('email') border-red-500/80 focus:border-red-500 focus:ring-red-500/50 @else border-prata-moderno/40 focus:border-dourado-prestigio focus:ring-dourado-prestigio/50 @enderror text-off-white placeholder-prata-moderno rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 transition duration-200" />
                                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="telefone" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    Telefone
                                </label>
                                <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}" required placeholder="Ex: (11) 99999-9999"
                                    class="w-full bg-[#181818] border @error('telefone') border-red-500/80 focus:border-red-500 focus:ring-red-500/50 @else border-prata-moderno/40 focus:border-dourado-prestigio focus:ring-dourado-prestigio/50 @enderror text-off-white placeholder-prata-moderno rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 transition duration-200" />
                                @error('telefone') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Área de Atendimento / Especialidade (Requerido pelo Backend e Testes) -->
                            <div id="areas-de-atuacao" class="scroll-mt-28">
                                <label for="servico_id" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    Área de Atendimento
                                </label>
                                <select id="servico_id" name="servico_id" required
                                    class="w-full bg-[#181818] border @error('servico_id') border-red-500/80 focus:border-red-500 focus:ring-red-500/50 @else border-prata-moderno/40 focus:border-dourado-prestigio focus:ring-dourado-prestigio/50 @enderror text-off-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 transition duration-200">
                                    <option value="" disabled {{ old('servico_id') ? '' : 'selected' }} class="bg-[#181818] text-prata-moderno">Selecione uma especialidade</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}" {{ old('servico_id') == $servico->id ? 'selected' : '' }} class="bg-[#181818] text-off-white">
                                            {{ $servico->titulo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('servico_id') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Data e Horário (Requeridos pelo Backend e Testes) -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label for="data" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                        Data
                                    </label>
                                    <input type="date" id="data" name="data" value="{{ old('data') }}" min="{{ date('Y-m-d') }}" required onclick="this.showPicker()"
                                        class="w-full bg-[#181818] border @error('data') border-red-500/80 focus:border-red-500 focus:ring-red-500/50 @else border-prata-moderno/40 focus:border-dourado-prestigio focus:ring-dourado-prestigio/50 @enderror text-off-white rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 transition duration-200 [color-scheme:dark]" />
                                    @error('data') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="horario" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                        Horário
                                    </label>
                                    <input type="time" id="horario" name="horario" value="{{ old('horario') }}" required step="3600" onclick="this.showPicker()"
                                        class="w-full bg-[#181818] border @error('horario') border-red-500/80 focus:border-red-500 focus:ring-red-500/50 @else border-prata-moderno/40 focus:border-dourado-prestigio focus:ring-dourado-prestigio/50 @enderror text-off-white rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 transition duration-200 [color-scheme:dark]" />
                                    @error('horario') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Mensagem (Área de texto descrita no layout de referência) -->
                            <div>
                                <label for="mensagem" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    Mensagem
                                </label>
                                <textarea id="mensagem" name="mensagem" rows="3" placeholder="Como podemos ajudar você?"
                                    class="w-full bg-[#181818] border @error('mensagem') border-red-500/80 focus:border-red-500 focus:ring-red-500/50 @else border-prata-moderno/40 focus:border-dourado-prestigio focus:ring-dourado-prestigio/50 @enderror text-off-white placeholder-prata-moderno rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 transition duration-200 resize-none">{{ old('mensagem') }}</textarea>
                                @error('mensagem') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Botão CTA em Gradiente Dourado: ENVIAR MENSAGEM → -->
                            <div class="pt-3">
                                <button type="submit"
                                    class="w-full py-3.5 rounded-xl bg-gradient-to-r from-dourado-prestigio via-[#ECCFA2] to-dourado-prestigio text-preto-absoluto font-extrabold text-sm sm:text-base tracking-wider uppercase shadow-[0_4px_20px_rgba(212,175,55,0.4)] hover:brightness-105 active:scale-[0.99] transition duration-200 flex items-center justify-center gap-2 cursor-pointer">
                                    <span>ENVIAR MENSAGEM →</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SEÇÃO SOBRE NÓS (NOSSA HISTÓRIA E ESPECIALISTAS) - Fundo Preto Absoluto (#0D0D0D) -->
    <section id="sobre-nos" class="relative z-10 w-full bg-[#0D0D0D] py-20 lg:py-28 border-t border-[#848484]/20 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">

            <!-- 4.1. Cabeçalho Institucional da Seção -->
            <div class="max-w-3xl mx-auto text-center">
                <span class="inline-block font-sans text-xs sm:text-sm font-bold uppercase tracking-[0.25em] text-[#D4AF37] mb-3">
                    TRADIÇÃO FAMILIAR &amp; EXCELÊNCIA JURÍDICA
                </span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-[#F9F9FB] tracking-wide mb-6">
                    Sobre a Nunes &amp; Durães Advocacia
                </h2>
                <div class="w-20 h-0.5 bg-[#D4AF37] mx-auto mb-6"></div>
                <p class="font-sans text-[#B4B4B4] text-base sm:text-lg leading-relaxed">
                    Com sede estrategicamente localizada no centro de Capitão Enéas – MG, o escritório Nunes &amp; Durães Advocacia une a solidez de uma tradição jurídica familiar a uma atuação técnica, moderna e combativa. Nosso compromisso é oferecer soluções jurídicas personalizadas, éticas e de alto padrão na defesa do patrimônio, da liberdade e dos direitos de nossos clientes em todas as instâncias.
                </p>
            </div>

            <!-- 4.3. Grid de Especialistas (3 Colunas no Desktop / 1 Coluna no Mobile) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-14">

                <!-- Card 1: Dr. Delssi Durães Oliveira -->
                <article class="group bg-[#2C2C2C] border border-[#848484]/20 hover:border-[#D4AF37] rounded-2xl p-6 shadow-xl transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[3/4] w-full overflow-hidden rounded-lg bg-[#0D0D0D] border border-[#D4AF37]/30 group-hover:border-[#D4AF37] border-b-2 border-b-[#D4AF37] transition-colors duration-300 mb-6">
                        <!-- TODO: Substituir filler.jpeg pela foto oficial do(a) advogado(a) -->
                        <img src="{{ asset('assets/filler.jpeg') }}"
                             alt="Dr. Delssi Durães Oliveira - Nunes & Durães Advocacia"
                             class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2C2C2C] via-transparent to-transparent opacity-80 pointer-events-none"></div>
                    </div>

                    <div class="flex flex-col flex-grow">
                        <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#F9F9FB] group-hover:text-[#D4AF37] transition-colors duration-300">
                            Dr. Delssi Durães Oliveira
                        </h3>
                        <p class="font-sans text-xs sm:text-sm font-semibold tracking-wider text-[#D4AF37] mt-1 mb-4 uppercase">
                            OAB/MG 129.637
                        </p>

                        <div class="flex flex-wrap gap-2 mb-5">
                            <span class="font-sans text-xs font-medium px-3 py-1 rounded-full bg-[#0D0D0D] text-[#D4AF37] border border-[#D4AF37]/40">
                                Direito Civil
                            </span>
                            <span class="font-sans text-xs font-medium px-3 py-1 rounded-full bg-[#0D0D0D] text-[#D4AF37] border border-[#D4AF37]/40">
                                Direito Criminal
                            </span>
                            <span class="font-sans text-xs font-medium px-3 py-1 rounded-full bg-[#0D0D0D] text-[#D4AF37] border border-[#D4AF37]/40">
                                Direito Público e Eleitoral
                            </span>
                        </div>

                        <p class="font-sans text-sm text-[#B4B4B4] leading-relaxed">
                            Advogado de atuação contundente e vasta experiência nos tribunais, conduzindo desde defesas criminais complexas até grandes litígios cíveis e disputas patrimoniais. Ex-Procurador-Geral do Município de Francisco Sá/MG, possui expressivo histórico de atuação na Vara de Execuções Penais, em demandas contra grandes concessionárias e prefeituras perante o TRE-MG, além de impetração de Habeas Corpus e Recursos Extraordinários junto ao Supremo Tribunal Federal (STF).
                        </p>
                    </div>
                </article>

                <!-- Card 2: Dra. Gerlice Correia Nunes Oliveira -->
                <article class="group bg-[#2C2C2C] border border-[#848484]/20 hover:border-[#D4AF37] rounded-2xl p-6 shadow-xl transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[3/4] w-full overflow-hidden rounded-lg bg-[#0D0D0D] border border-[#D4AF37]/30 group-hover:border-[#D4AF37] border-b-2 border-b-[#D4AF37] transition-colors duration-300 mb-6">
                        <!-- TODO: Substituir filler.jpeg pela foto oficial do(a) advogado(a) -->
                        <img src="{{ asset('assets/filler.jpeg') }}"
                             alt="Dra. Gerlice Correia Nunes Oliveira - Nunes & Durães Advocacia"
                             class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2C2C2C] via-transparent to-transparent opacity-80 pointer-events-none"></div>
                    </div>

                    <div class="flex flex-col flex-grow">
                        <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#F9F9FB] group-hover:text-[#D4AF37] transition-colors duration-300">
                            Dra. Gerlice Correia Nunes Oliveira
                        </h3>
                        <p class="font-sans text-xs sm:text-sm font-semibold tracking-wider text-[#D4AF37] mt-1 mb-4 uppercase">
                            OAB/MG 188.944
                        </p>

                        <div class="flex flex-wrap gap-2 mb-5">
                            <span class="font-sans text-xs font-medium px-3 py-1 rounded-full bg-[#0D0D0D] text-[#D4AF37] border border-[#D4AF37]/40">
                                Direito Trabalhista
                            </span>
                            <span class="font-sans text-xs font-medium px-3 py-1 rounded-full bg-[#0D0D0D] text-[#D4AF37] border border-[#D4AF37]/40">
                                Direito Previdenciário
                            </span>
                        </div>

                        <p class="font-sans text-sm text-[#B4B4B4] leading-relaxed">
                            Aprovada no XXIV Exame de Ordem Unificado, atua na linha de frente da defesa dos direitos do trabalhador e do segurado. Com sólida vivência em procedimentos investigatórios, administrativos e contenciosos perante o Ministério Público de Minas Gerais (MPMG) e tribunais regionais, conduz uma advocacia firme e estratégica voltada à concessão de benefícios junto ao INSS, revisões de aposentadorias e reparação rigorosa de passivos trabalhistas.
                        </p>
                    </div>
                </article>

                <!-- Card 3: Dra. Rosevania Correia Nunes da Mata -->
                <article class="group bg-[#2C2C2C] border border-[#848484]/20 hover:border-[#D4AF37] rounded-2xl p-6 shadow-xl transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[3/4] w-full overflow-hidden rounded-lg bg-[#0D0D0D] border border-[#D4AF37]/30 group-hover:border-[#D4AF37] border-b-2 border-b-[#D4AF37] transition-colors duration-300 mb-6">
                        <!-- TODO: Substituir filler.jpeg pela foto oficial do(a) advogado(a) -->
                        <img src="{{ asset('assets/filler.jpeg') }}"
                             alt="Dra. Rosevania Correia Nunes da Mata - Nunes & Durães Advocacia"
                             class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2C2C2C] via-transparent to-transparent opacity-80 pointer-events-none"></div>
                    </div>

                    <div class="flex flex-col flex-grow">
                        <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#F9F9FB] group-hover:text-[#D4AF37] transition-colors duration-300">
                            Dra. Rosevania Correia Nunes da Mata
                        </h3>
                        <p class="font-sans text-xs sm:text-sm font-semibold tracking-wider text-[#D4AF37] mt-1 mb-4 uppercase">
                            OAB/MG 202.752
                        </p>

                        <div class="flex flex-wrap gap-2 mb-5">
                            <span class="font-sans text-xs font-medium px-3 py-1 rounded-full bg-[#0D0D0D] text-[#D4AF37] border border-[#D4AF37]/40">
                                Direitos dos Servidores Públicos
                            </span>
                            <span class="font-sans text-xs font-medium px-3 py-1 rounded-full bg-[#0D0D0D] text-[#D4AF37] border border-[#D4AF37]/40">
                                Direito Administrativo
                            </span>
                        </div>

                        <p class="font-sans text-sm text-[#B4B4B4] leading-relaxed">
                            Inscrita na 11ª Subseção da OAB/MG após aprovação no XXIX Exame de Ordem, é a especialista do escritório dedicada à defesa funcional. Com trajetória prévia no serviço público do Estado de Minas Gerais na área da educação, conhece profundamente o funcionamento da Administração Pública. Sua atuação técnica foca na proteção de servidores em Processos Administrativos Disciplinares (PADs), garantia de progressões de carreira, revisões salariais e combate a ilegalidades estatais.
                        </p>
                    </div>
                </article>

            </div>

            <!-- 4.4. Bloco de Localização e Expediente (Abaixo dos Cards) -->
            <div class="mt-12 bg-[#2C2C2C] border border-[#848484]/20 rounded-2xl p-6 sm:p-8 shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center text-center md:text-left">
                    <div class="flex flex-col md:flex-row items-center gap-3.5">
                        <span class="flex-shrink-0 w-10 h-10 rounded-full bg-[#0D0D0D] border border-[#D4AF37]/40 flex items-center justify-center text-[#D4AF37]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <div>
                            <span class="block font-sans text-xs uppercase tracking-wider text-[#D4AF37] font-semibold">Endereço</span>
                            <span class="font-sans text-sm text-[#F9F9FB]">Av. Presidente Costa e Silva, 346 - Centro, Capitão Enéas - MG (CEP 39472-000)</span>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-3.5">
                        <span class="flex-shrink-0 w-10 h-10 rounded-full bg-[#0D0D0D] border border-[#D4AF37]/40 flex items-center justify-center text-[#D4AF37]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <div>
                            <span class="block font-sans text-xs uppercase tracking-wider text-[#D4AF37] font-semibold">Expediente</span>
                            <span class="font-sans text-sm text-[#F9F9FB]">Segunda a Quinta-feira, das 08h00 às 17h00</span>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-3.5">
                        <span class="flex-shrink-0 w-10 h-10 rounded-full bg-[#0D0D0D] border border-[#D4AF37]/40 flex items-center justify-center text-[#D4AF37]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </span>
                        <div>
                            <span class="block font-sans text-xs uppercase tracking-wider text-[#D4AF37] font-semibold">Contato / WhatsApp</span>
                            <a href="tel:38998414101" class="font-sans text-sm text-[#F9F9FB] hover:text-[#D4AF37] transition-colors duration-200">(38) 99841-4101</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- RODAPÉ (FOOTER) - Fundo Preto Absoluto fiel a image_12.png -->
    <footer id="contato" class="relative z-10 bg-preto-absoluto border-t border-[#1C1C1C] py-10 px-6 sm:px-12 text-center text-prata-moderno scroll-mt-28">
        <div class="max-w-7xl mx-auto flex flex-col items-center justify-center space-y-4">
            
            <!-- Logotipo de apoio centralizado: N/D NUNES & DURÃES ADVOCACIA -->
            <div class="flex flex-col items-center justify-center">
                <span class="font-serif font-bold text-2xl tracking-[0.25em] text-dourado-prestigio uppercase">
                    N / D
                </span>
                <span class="font-serif text-xs sm:text-sm tracking-[0.22em] text-dourado-prestigio uppercase font-medium mt-0.5">
                    NUNES &amp; DURÃES ADVOCACIA
                </span>
            </div>

            <!-- Contatos na mesma linha em Prata/Off-White com ícones discretos -->
            <div class="flex flex-wrap items-center justify-center gap-5 sm:gap-8 text-sm text-off-white/90 pt-1">
                <a href="mailto:contato@nuneseduraes.com.br" class="inline-flex items-center gap-2 hover:text-dourado-prestigio transition-colors duration-200">
                    <span class="text-dourado-prestigio text-base">✉</span>
                    <span>contato@nuneseduraes.com.br</span>
                </a>
                <span class="text-prata-moderno/40 hidden sm:inline">•</span>
                <a href="tel:38998414101" class="inline-flex items-center gap-2 hover:text-dourado-prestigio transition-colors duration-200">
                    <span class="text-dourado-prestigio text-base">☏</span>
                    <span>(38) 99841-4101</span>
                </a>
            </div>

            <!-- Endereço e Horário de Atendimento no Rodapé -->
            <div class="text-xs sm:text-sm text-[#B4B4B4] space-y-1">
                <p>Avenida Presidente Costa e Silva, 346 - Centro, Capitão Enéas - MG, CEP: 39472-000</p>
                <p class="text-[#848484]">Horário de Atendimento: Segunda a Quinta-feira, das 08h00 às 17h00</p>
            </div>

            <!-- Direitos Autorais no Rodapé Inferior -->
            <div class="pt-4 border-t border-[#181818] w-full max-w-md text-center">
                <p class="text-xs text-prata-moderno font-light tracking-wide">
                    &copy; 2026 Nunes &amp; Durães Advocacia. Todos os direitos reservados.
                </p>
            </div>

        </div>
    </footer>

</div>
@endsection
