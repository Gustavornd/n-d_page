<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-bright-lemon">{{__('Adicionar novo serviço')}}</h2>
    </x-slot>

    <div>
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full max-w-[550px] bg-graphite border rounded-lg border-bright-lemon p-4">
                <form action="{{ route('servicos.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label class="mb-3 block text-base font-medium text-bright-lemon">Título do serviço</label>
                        <input type="text" name="titulo"
                            class="w-full px-3 py-2 border rounded-lg bg-dust-grey text-graphite"
                            placeholder="Insira novo serviço." value="{{ old('titulo') }}" required>
                    </div>

                    <div class="mb-5">
                        <input type="checkbox" name="ativa" id="ativa" value="1" {{ old('ativa', '1') ? 'checked' : '' }}>
                        <label for="ativa" class="mb-3 text-base font-medium text-bright-lemon">Exibir publicamente no
                            formulário (Ativo)</label>
                    </div>

                    <div>
                        <a href="{{ route('servicos.index') }}" class="text-bright-lemon underline">Cancelar</a>
                        <button type="submit"
                            class="border border-bright-lemon bg-bright-amber text-carbon-black rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-bright-lemon focus:outline-none focus:shadow-outline">
                                Salvar Serviço</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

</x-app-layout>