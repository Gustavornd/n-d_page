<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-bright-lemon">{{__('Editar Serviço')}}</h2>
    </x-slot>

    <div>
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full max-w-[550px] bg-graphite border rounded-lg border-bright-lemon p-4">
                <form action="{{ route('servicos.update', $servico->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="mb-3 block text-base font-medium text-bright-lemon">Título do Serviço</label>
                        <input type="text" name="titulo" value="{{ old('titulo', $servico->titulo) }}" required
                            class="w-full px-3 py-2 border rounded-lg bg-dust-grey text-graphite">
                        @error('titulo') <span>{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-5">
                        <input type="checkbox" name="ativa" id="ativa" value="1" {{ old('ativa', $servico->ativa) ? 'checked' : '' }}>
                        <label for="ativa" class="mb-3 text-base font-medium text-bright-lemon">Exibir publicamente no formulário (Ativo)</label>
                    </div>

                    <div>
                        <a href="{{ route('servicos.index') }}" class="text-bright-lemon underline">Cancelar</a>
                        <button type="submit" class="border border-bright-lemon bg-bright-amber text-carbon-black rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-bright-lemon focus:outline-none focus:shadow-outline">
                            Salvar Serviço</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>