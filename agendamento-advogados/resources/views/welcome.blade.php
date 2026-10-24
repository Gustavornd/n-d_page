<x-app-layout>
    <div class="relative bg-cinza-grafite overflow-hidden min-h-[calc(100vh-64px)] flex items-center py-12 lg:py-20">
        
        <!-- Grafismos Geométricos Vetoriais (Dourado & Prata) fiéis ao protótipo de luxo -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden select-none" aria-hidden="true">
            <!-- Glows radiais -->
            <div class="absolute -top-32 -right-32 w-[650px] h-[650px] rounded-full bg-[radial-gradient(circle,rgba(212,175,55,0.15)_0%,transparent_65%)] blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] rounded-full bg-[radial-gradient(circle,rgba(132,132,132,0.10)_0%,transparent_70%)] blur-3xl"></div>
            
            <!-- SVG Vetorial com Linhas Geométricas do Protótipo -->
            <svg class="w-full h-full object-cover absolute inset-0 opacity-40 lg:opacity-55" viewBox="0 0 1440 900" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <line x1="720" y1="0" x2="1480" y2="760" stroke="#848484" stroke-width="1.4" stroke-opacity="0.35" />
                <line x1="880" y1="0" x2="1560" y2="680" stroke="#B4B4B4" stroke-width="0.9" stroke-opacity="0.25" />
                <line x1="1440" y1="60" x2="820" y2="680" stroke="#848484" stroke-width="1.2" stroke-opacity="0.3" />
                <line x1="1440" y1="200" x2="980" y2="660" stroke="#B4B4B4" stroke-width="0.8" stroke-opacity="0.25" />
                
                <polygon points="1060,50 1380,240 1260,600 940,410" stroke="#848484" stroke-width="1.1" stroke-opacity="0.28" fill="none" />
                <polygon points="940,160 1260,350 1140,710 820,520" stroke="#D4AF37" stroke-width="0.85" stroke-opacity="0.22" fill="none" />

                <!-- Família de Curvas Douradas Concêntricas -->
                <path d="M 640 900 C 800 710, 1040 460, 1440 370" stroke="#D4AF37" stroke-width="2.0" stroke-opacity="0.45" />
                <path d="M 700 900 C 850 730, 1080 500, 1440 420" stroke="#D4AF37" stroke-width="1.4" stroke-opacity="0.35" />
                <path d="M 760 900 C 900 750, 1120 540, 1440 470" stroke="#D4AF37" stroke-width="1.0" stroke-opacity="0.28" />
                <path d="M 820 900 C 950 770, 1160 580, 1440 520" stroke="#D4AF37" stroke-width="0.8" stroke-opacity="0.22" />
                <path d="M 580 900 C 750 680, 1000 420, 1440 320" stroke="#D4AF37" stroke-width="0.9" stroke-opacity="0.25" />

                <line x1="-50" y1="360" x2="680" y2="920" stroke="#848484" stroke-width="0.8" stroke-opacity="0.15" />
                <path d="M0 640 C 240 670, 440 770, 580 900" stroke="#D4AF37" stroke-width="1.2" stroke-opacity="0.22" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full relative z-10">
            <!-- Grid 50% / 50% -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                
                <!-- COLUNA DA ESQUERDA: Mensagem de Impacto da Nunes & Durães Advocacia -->
                <div class="flex flex-col items-start text-left">
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-dourado-prestigio text-preto-absoluto text-[11px] font-extrabold tracking-[0.2em] uppercase mb-6 shadow-[0_2px_12px_rgba(212,175,55,0.35)]">
                        ESCRITÓRIO DE ADVOCACIA
                    </div>

                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-[44px] font-bold leading-[1.16] tracking-wide text-off-white mb-6 uppercase">
                        SOLUÇÕES JURÍDICAS<br>
                        DE <span class="text-dourado-prestigio">ALTO PADRÃO</span><br>
                        PARA <span class="text-dourado-prestigio">PROTEGER SEU</span><br>
                        <span class="text-dourado-prestigio">PATRIMÔNIO</span> E SEUS<br>
                        <span class="text-dourado-prestigio">DIREITOS</span>
                    </h1>

                    <p class="text-prata-moderno text-base lg:text-lg font-normal leading-relaxed mb-8 max-w-xl">
                        Atendimento personalizado, ético e focado em resultados. Solicite seu agendamento de consulta diretamente com a equipe da <strong class="text-off-white">Nunes &amp; Durães Advocacia</strong> através do formulário ao lado.
                    </p>

                    <!-- Lista de Diferenciais com Selos de Roseta Dourados -->
                    <ul class="space-y-4 mb-6">
                        <li class="flex items-center gap-3.5">
                            <span class="flex-shrink-0 w-6 h-6 text-dourado-prestigio flex items-center justify-center drop-shadow-[0_0_8px_rgba(212,175,55,0.45)]">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
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
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
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
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
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

                <!-- COLUNA DA DIREITA: Card de Agendamento Oficial da Nunes & Durães -->
                <div class="flex flex-col items-center lg:items-end justify-center w-full">
                    <div class="w-full max-w-[500px] bg-preto-absoluto border-2 border-dourado-prestigio rounded-[28px] p-7 sm:p-9 shadow-[0_20px_50px_rgba(0,0,0,0.85),0_0_30px_rgba(212,175,55,0.22)] relative backdrop-blur-md">
                        
                        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-dourado-prestigio text-center tracking-wide">
                            Fale com um Especialista
                        </h2>
                        <p class="text-xs sm:text-sm text-off-white text-center mt-2 mb-6 font-normal">
                            Preencha os dados abaixo para solicitar seu atendimento jurídico.
                        </p>

                        <!-- Alerta de Sucesso -->
                        @if(session('sucesso'))
                            <div class="mb-5 p-3.5 rounded-xl bg-green-500/20 border border-green-500 text-green-200 text-center text-sm font-medium">
                                ✔ {{ session('sucesso') }}
                            </div>
                        @endif

                        <!-- Formulário Real de Agendamento (route: agendar) -->
                        <form action="{{ route('agendar') }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Nome Completo -->
                            <div>
                                <label for="nome" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    Nome Completo
                                </label>
                                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required placeholder="Ex: João Silva"
                                    class="w-full bg-[#181818] border border-prata-moderno/50 focus:border-dourado-prestigio text-off-white placeholder-prata-moderno rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-dourado-prestigio transition duration-200" />
                                @error('nome') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- E-mail -->
                            <div>
                                <label for="email" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    E-mail
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Ex: contato@email.com"
                                    class="w-full bg-[#181818] border border-prata-moderno/50 focus:border-dourado-prestigio text-off-white placeholder-prata-moderno rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-dourado-prestigio transition duration-200" />
                                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="telefone" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    Telefone
                                </label>
                                <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}" required placeholder="Ex: (11) 99999-9999"
                                    class="w-full bg-[#181818] border border-prata-moderno/50 focus:border-dourado-prestigio text-off-white placeholder-prata-moderno rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-dourado-prestigio transition duration-200" />
                                @error('telefone') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Área de Atendimento / Especialidade -->
                            <div>
                                <label for="servico_id" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                    Área de Atendimento
                                </label>
                                <select id="servico_id" name="servico_id" required
                                    class="w-full bg-[#181818] border border-prata-moderno/50 focus:border-dourado-prestigio text-off-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-dourado-prestigio transition duration-200">
                                    <option value="" disabled selected class="bg-[#181818] text-prata-moderno">Selecione uma especialidade</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}" {{ old('servico_id') == $servico->id ? 'selected' : '' }} class="bg-[#181818] text-off-white">
                                            {{ $servico->titulo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('servico_id') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Data e Horário -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label for="data" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                        Data
                                    </label>
                                    <input type="date" id="data" name="data" value="{{ old('data') }}" required onclick="this.showPicker()"
                                        class="w-full bg-[#181818] border border-prata-moderno/50 focus:border-dourado-prestigio text-off-white rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-dourado-prestigio transition duration-200" />
                                    @error('data') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="horario" class="block text-xs font-medium text-off-white mb-1.5 tracking-wide">
                                        Horário
                                    </label>
                                    <input type="time" id="horario" name="horario" value="{{ old('horario') }}" required step="3600" onclick="this.showPicker()"
                                        class="w-full bg-[#181818] border border-prata-moderno/50 focus:border-dourado-prestigio text-off-white rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-dourado-prestigio transition duration-200" />
                                    @error('horario') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Botão CTA em Gradiente Dourado -->
                            <div class="pt-3">
                                <button type="submit"
                                    class="w-full py-3.5 rounded-lg bg-gradient-to-r from-dourado-prestigio via-dourado-light to-dourado-dark text-preto-absoluto font-extrabold text-sm sm:text-base tracking-wider uppercase shadow-[0_4px_20px_rgba(212,175,55,0.4)] hover:brightness-105 active:scale-[0.99] transition duration-200 flex items-center justify-center gap-2">
                                    <span>SOLICITAR ATENDIMENTO →</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
