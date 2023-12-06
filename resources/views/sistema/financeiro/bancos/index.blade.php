@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
      <div class="overlay" id="overlay-bancos">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Bancos</h3>
        @can('Bancos.Criar')
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" href="{{ route('fin.bancos.adicionar') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        @endcan
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle" id="tabela-bancos">
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
    bancos_tabelar()
  });

  function bancos_tabelar()
  {
    $('#overlay-bancos').show();

    axios.get("{{ route('fin.bancos.tabelar') }}")
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-bancos').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '7196547a' ] )
    .then( function(response)
    {
      $('#overlay-bancos').hide();
    })
  }

  function bancos_excluir(id)
  {
    $('#overlay-bancos').show();

    var url = "{{ route('fin.bancos.excluir', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '7614692a' ] )
    .then( function(response)
    {
      bancos_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-bancos').hide();
    })
  }

  function bancos_restaurar(id)
  {
    $('#overlay-bancos').show();

    var url = "{{ route('fin.bancos.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '7922048a' ] )
    .then( function(response)
    {
      bancos_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-bancos').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection