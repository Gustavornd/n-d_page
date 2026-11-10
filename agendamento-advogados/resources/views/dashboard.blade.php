<x-app-layout>
    <x-slot name="header">
        <h2 class="text-bright-lemon text-3xl">
            {{ __('Gestão de Agendamentos') }}
        </h2>
    </x-slot>

    <div>
        <div>
            <!-- Dashboard Section -->
            <div x-show="activeSection === 'dashboard'" class="space-y-6 p-4">
                <header>
                    <h1 class="text-2xl font-bold text-bright-amber">Bem vindo(a),
                        {{ Auth::user()?->name ?? 'Visitante' }}!
                    </h1>
                    @if(Auth::user()?->isAdmin())
                        <p class="text-bright-lemon">Visão Geral do Escritório (Todas as Sedes e Advogados):</p>
                    @else
                        <p class="text-bright-lemon">Você está visualizando a sua pauta pessoal de agendamentos (Dr(a). {{ Auth::user()?->name }}).</p>
                    @endif
                </header>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-dust-grey p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-graphite">Pendentes:</h2>
                        <p class="text-2xl text-right font-bold text-blue-700">{{ $stats['pendentes'] }}</p>
                    </div>
                    <div class="bg-dust-grey p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-graphite">Concluídos:</h2>
                        <p class="text-2xl text-right font-bold text-green-600">{{ $stats['concluidos'] }}</p>
                    </div>
                    <div class="bg-dust-grey p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700">Cancelados:</h2>
                        <p class="text-2xl text-right font-bold text-red-600">{{ $stats['cancelados'] }}</p>
                    </div>
                </div>
            </div>

            <div class="py-10 px-4">
                @if(session('sucesso'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('sucesso') }}</div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Barra de pesquisa e filtros -->
                <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex flex-wrap items-center gap-3">
                    <input type="text" name="busca" placeholder="Buscar por nome, email ou mensagem..."
                        value="{{ request('busca') }}" class="w-80 px-3 py-2 border rounded-lg bg-dust-grey text-graphite">

                    @if(Auth::user()?->isAdmin())
                        <!-- Filtro por Sede -->
                        <select name="sede" class="px-3 py-2 border rounded-lg bg-dust-grey text-graphite">
                            <option value="">Todas as Sedes</option>
                            <option value="capitao_eneas" {{ request('sede') === 'capitao_eneas' ? 'selected' : '' }}>Capitão Enéas</option>
                            <option value="montes_claros" {{ request('sede') === 'montes_claros' ? 'selected' : '' }}>Montes Claros</option>
                        </select>

                        <!-- Filtro por Advogado -->
                        <select name="advogado_id" class="px-3 py-2 border rounded-lg bg-dust-grey text-graphite">
                            <option value="">Todos os Advogados</option>
                            @foreach($advogados as $adv)
                                <option value="{{ $adv->id }}" {{ request('advogado_id') == $adv->id ? 'selected' : '' }}>
                                    {{ $adv->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    <button type="submit"
                        class="border border-bright-lemon bg-bright-amber text-carbon-black rounded-md px-4 py-2 transition duration-500 ease select-none hover:bg-bright-lemon focus:outline-none focus:shadow-outline">Buscar</button>
                    <a href="{{ route('dashboard') }}" class="text-bright-lemon underline">Limpar</a>
                </form>

                <!-- Tabela de agendamentos -->
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-graphite text-bright-lemon uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Data / Hora</th>
                                <th class="py-3 px-6 text-left">Sede</th>
                                <th class="py-3 px-6 text-left">Advogado Responsável</th>
                                <th class="py-3 px-6 text-left">Cliente</th>
                                <th class="py-3 px-6 text-left">Serviço</th>
                                <th class="py-3 px-6 text-left">Mensagem</th>
                                <th class="py-3 px-6 text-left">Status</th>
                                <th class="py-3 px-6 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @forelse($agendamentos as $agendamento)
                                <tr class="border-b border-gray-500 bg-dust-grey hover:bg-gray-100 text-carbon-black">
                                    <td class="py-3 px-6 text-left">{{ date('d/m/Y', strtotime($agendamento->data)) }} às
                                        {{ $agendamento->horario }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $agendamento->sede === 'montes_claros' ? 'bg-purple-100 text-purple-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ $agendamento->nome_sede }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="font-medium text-carbon-black">{{ $agendamento->advogado?->name ?? 'Não atribuído' }}</div>
                                        @if(Auth::user()?->isAdmin() && isset($advogados))
                                            <form method="POST" action="{{ route('agendamentos.reatribuir', $agendamento->id) }}" class="mt-1">
                                                @csrf @method('PATCH')
                                                <select name="advogado_id" onchange="this.form.submit()" class="text-xs py-1 px-2 border rounded bg-white text-gray-700">
                                                    <option value="" disabled {{ !$agendamento->advogado_id ? 'selected' : '' }}>Reatribuir...</option>
                                                    @foreach($advogados as $adv)
                                                        <option value="{{ $adv->id }}" {{ $agendamento->advogado_id == $adv->id ? 'selected' : '' }}>
                                                            {{ $adv->name }} ({{ $adv->sede_padrao === 'montes_claros' ? 'Montes Claros' : 'Capitão Enéas' }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div>{{ $agendamento->nome }}</div>
                                        <div>{{ $agendamento->email }}</div>
                                        <div>{{ $agendamento->telefone }}</div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="font-semibold">{{ $agendamento->servico->titulo ?? 'N/A' }}</div>
                                    </td>
                                    <td class="py-3 px-6 text-left max-w-xs">
                                        @if(filled($agendamento->mensagem))
                                            <div class="max-w-xs text-sm text-carbon-black whitespace-pre-line break-words">{{ $agendamento->mensagem }}</div>
                                        @else
                                            <span class="text-xs text-gray-500 italic">Sem mensagem</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($agendamento->status == 'pendente') bg-blue-500 text-white
                                            @elseif($agendamento->status == 'concluido') bg-green-500 text-white
                                            @else bg-red-500 text-white @endif">
                                            {{ ucfirst($agendamento->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-left pl-10">
                                        <div class="flex items-center gap-1">
                                            @if($agendamento->status == 'pendente')
                                                <form method="POST"
                                                    action="{{ route('agendamentos.status', $agendamento->id) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="concluido">
                                                    <button type="submit" title="Concluir agendamento">
                                                        <div class="bg-green-300 mr-3 rounded-full">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-6 text-green-800">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m4.5 12.75 6 6 9-13.5" />
                                                            </svg>
                                                        </div>
                                                    </button>
                                                </form>
                                                <form method="POST"
                                                    action="{{ route('agendamentos.status', $agendamento->id) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelado">
                                                    <button type="submit" title="Cancelar agendamento">
                                                        <div class="bg-red-300 mr-3 rounded-full">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-6 text-red-800">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 18 18 6M6 6l12 12" />
                                                            </svg>
                                                        </div>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="py-3 px-6 text-left" colspan="8">Nenhum agendamento encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-4 p-4">
                    {{ $agendamentos->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>