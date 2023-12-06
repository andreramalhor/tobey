<div class="modal fade" id="modal_servico_adicionar" aria-hidden="true" style="display: none; color: black;">
  <div class="modal-dialog modal-lg">
    <form autocomplete="off" id="form-servico-adicionar">
      <div class="modal-content">
        <div class="modal-header bg-navy" style="padding: 8px 16px">
          <h5 class="modal-title">Adicionar Serviço</h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                  <label>Serviço</label>
                  <select class="form-control form-control-sm select2" id="adicionar_id_servprod">
                    <option>Carregando . . .</option> 
                  </select>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between" style="padding: 6px 12px">
          <a class="btn btn-default" data-bs-dismiss="modal">Cancel</a>
          <a class="btn btn-primary" data-bs-dismiss="modal" onclick="categoria_servico_adicionar()">Adicionar</a>
        </div>
      </div>
    </div>
  </form>
</div>

@push('js')
<script>
$('#modal_servico_adicionar').on('shown.bs.modal', categoria_servico_mostrar)

function categoria_servico_mostrar()
{
  // $('#overlay-pessoas').show()
  $("#adicionar_id_servprod").append('<option value="">Carregando . . . </option>')
  var url = "{{ route('cat.servicos.plucar') }}"
  var url = url.replace(':params', '?params='+params)

  var params = url+'?id_categoria={{ $categoria->id }}&Xid_categoria=!='

  axios.get(params)
  .then(function(response)
  {
    // console.log(response.data)
    $("#adicionar_id_servprod").empty().append('<option value="">Selecione . . . </option>')
    $.each( response.data, function(value, key)
    {
      $("#adicionar_id_servprod").append('<option value="'+key+'">'+value+'</option>')
    })
  })
@include('includes.catch', [ 'codigo_erro' => '2949604a' ] )
  .then( function(response)
  {
    $('.select2').select2({
      dropdownParent: $('#modal_servico_adicionar'),
    });
  })
}

function categoria_servico_adicionar()
{
  var url = "{{ route('cat.servicos.atualizar', ':idd') }}"
  var url = url.replace(':idd', $("#adicionar_id_servprod").val())

  var dados = {
    id_categoria: {{ $categoria->id }},
  }

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '6252443a' ] )
  .then( function(response)
  {
    $('#servicosMostrarServicos').empty()
    mostrarServicos(0)
    // $('#overlay-pessoas').hide()
  })
}

function categoria_servico_excluir(id)
{
  var url = "{{ route('cat.servicos.atualizar', ':idd') }}"
  var url = url.replace(':idd', id)

  var dados = {
    id_categoria: 0,
  }

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '9056669a' ] )
  .then( function(response)
  {
    $('#servicosMostrarServicos').empty()
    mostrarServicos(0)
    // $('#overlay-pessoas').hide()
  })
}

</script>
@endpush
