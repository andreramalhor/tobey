<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Serviços</h3>
            </div>
            <div class="card-body p-0">
                <div class="row p-2">
                    <div class="offset-md-8 col-md-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right" placeholder="Pesquisar" wire:model.live="pesquisar">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary btn-block btn-sm float-right" wire:click="create"><i class="fa fa-plus"></i> Novo serviço</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"></th>
                            <th class="text-left">Nome</th>
                            <th class="text-left">E-mail</th>
                            <th class="text-left">Endereço</th>
                            <th class="text-left">Telefone</th>
                            <th class="text-left">Tipos</th>
                            <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($servicos as $ciclo)
                        <tr wire:key="{{ $ciclo->id }}">
                            <td class="p-1 text-center">{{ $ciclo->id }}</td>
                            <td class="p-1 text-center">
                                <img class="direct-chat-img rounded-3" src="{{ $ciclo->src_foto }}">
                            </td>
                            <td class="p-1 text-left">{{ $ciclo->nome }}</td>
                            <td class="p-1 text-left">{{ $ciclo->email }}</td>
                            <td class="p-1 text-left">{{ $ciclo->endereco }}</td>
                            <td class="p-1 text-left">{{ $ciclo->fone }}</td>
                            <td class="p-1 text-left">
                                {{-- @foreach($ciclo->kjahdkwkbewtoip->sortby('id') as $tipo)
                                <small class="badge bg-{{ $tipo->color }}">{{ $tipo->nome }}</small>
                                @endforeach --}}
                            </td>
                            <td class="p-1 text-right">
                                <x-icon.view click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.edit click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.delete click="{{ $ciclo->id }}" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center"><small>Não há servicos cadastrados</small></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $servicos->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.catalogo.servico.criar')
    @include('livewire.catalogo.servico.editar')
    @include('livewire.catalogo.servico.mostrar')
</div>


{{--

    CRUD

create    criar
read      mostrar
update    atualizar
delete    deletar


# create (criar)
store (armazenar ou salvar)
# edit (editar)
update (atualizar)
# show (mostrar ou exibir)
destroy (destruir, remover ou deletar)

 --}}