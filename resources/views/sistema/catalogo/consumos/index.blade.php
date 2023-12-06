@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
      <div class="overlay" id="overlay-produtos">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Produtos</h3>
        @can('Permissões.Criar')
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" href="{{ route('cat.produtos.adicionar') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        @endcan
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle" id="tabela-produtos">
          <thead>
            <tr>
              <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">Carregando...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    produtos_tabelar()
  });

  function produtos_tabelar()
  {
    $('#overlay-produtos').show();

    axios.get("{{ route('cat.produtos.tabelar') }}")
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-produtos').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '5353347a' ] )
    .then( function(response)
    {
      $('#overlay-produtos').hide();
    })
  }

  function produtos_excluir(id)
  {
    $('#overlay-produtos').show();

    var url = "{{ route('cat.produtos.excluir', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '8988092a' ] )
    .then( function(response)
    {
      produtos_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-produtos').hide();
    })
  }


// ------------------------------------------------------------------------------------------------------------------------------------------------------------ COPIAR DEPOIS EXCLUIR
  // function produtos_restaurar(id)
  // {
  //   $('#overlay-produtos').show();

  //   {{-- var url = "{{ route('cat.produtos.restaurar', ':id') }}"; --}}
  //   var url = url.replace(':id', id);
    
  //   axios.post(url)
  //   .then(function(response)
  //   {
  //     console.log(response.data)
  //     toastrjs(response.data.type, response.data.message)
  //   })
  {{-- @include('includes.catch', [ 'codigo_erro' => '4558447a' ] ) --}}
  //   .then( function(response)
  //   {
  //     produtos_tabelar()
  //   })
  //   .then( function(response)
  //   {
  //     $('#overlay-produtos').hide();
  //   })
  // }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
