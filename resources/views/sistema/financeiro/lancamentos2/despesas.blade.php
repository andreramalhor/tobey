@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('lancamento.lancar_d_gerais') }}" autocomplete="off" id="form_lancdespesa">
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lançar Despesa</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <div class="col-12">
                <div class="form-group">
                  <label>Contas Nivel 1</label>
                  <select class="form-control form-control-sm select2" id="conta_nivel_1" onchange="contas(2, this.value, '#conta_nivel_2')"></select>
                </div>
              </div>
              <div class="col-12" id="div_conta_nivel_2" style="display: none">
                <div class="form-group">
                  <label>Contas Nivel 2</label>
                  <select class="form-control form-control-sm select2" id="conta_nivel_2" onchange="contas(3, this.value, '#conta_nivel_3')"></select>
                </div>
              </div>
              <div class="col-12" id="div_conta_nivel_3" style="display: none">
                <div class="form-group">
                  <label>Contas Nivel 3</label>
                  <select class="form-control form-control-sm select2" id="conta_nivel_3" onchange="contas(4, this.value, '#conta_nivel_4')"></select>
                </div>
              </div>
              <div class="col-12" id="div_conta_nivel_4" style="display: none">
                <div class="form-group">
                  <label>Contas Nivel 4</label>
                  <select class="form-control form-control-sm select2" id="conta_nivel_4" onchange="contas(5, this.value, '#conta_nivel_5')"></select>
                </div>
              </div>
              <div class="col-12" id="div_conta_nivel_5" style="display: none">
                <div class="form-group">
                  <label>Contas Nivel 5</label>
                  <select class="form-control form-control-sm select2" id="conta_nivel_5" onchange="contas(6, this.value, '#conta_nivel_6')"></select>
                </div>
              </div>
            </div>
            <div class="col-8">
              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <label>Banco</label>
                    <select class="form-control form-control-sm" id="id_banco" name="id_banco">
                      @foreach($bancos as $banco)
                        @if( isset(Auth::User()->abcde->first()->id_banco) && Auth::User()->abcde->first()->id_banco == $banco->id )
                          <option value="{{ $banco->id }}" selected>{{ $banco->nome }}</option>
                        @else
                          <option value="{{ $banco->id }}">{{ $banco->nome }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>N Caixa</label>
                    <input type="text" class="form-control form-control-sm" name="id_caixa"  id="id_caixa" value="">
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>Num Documento</label>
                    <input type="text" class="form-control form-control-sm" name="num_documento"  id="num_documento" value="">
                  </div>
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label>Cliente</label>
                    <select class="form-control form-control-sm select2" id="id_cliente" name="id_cliente">
                      <option value=""></option>
                      @foreach($pessoas->sortBy('nome') as $pessoa)
                        <option value="{{ $pessoa->id }}">{{ $pessoa->nome }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-10">
                  <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" class="form-control form-control-sm" name="informacao"  id="informacao" value="">
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>Parcela</label>
                    <input type="text" class="form-control form-control-sm text-center" name="parcela"  id="parcela" value="01/01">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Data de Vencimento</label>
                    <input type="date" class="form-control form-control-sm text-center" name="dt_vencimento"  id="dt_vencimento" value="{{ \Carbon\Carbon::Today()->format('Y-m-d') }}">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Data de Pagamento</label>
                    <input type="date" class="form-control form-control-sm text-center" name="dt_recebimento"  id="dt_recebimento" value="{{ \Carbon\Carbon::Today()->format('Y-m-d') }}">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Data de Confirmação</label>
                    <input type="date" class="form-control form-control-sm text-center" name="dt_confirmacao"  id="dt_confirmacao" value="">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control form-control-sm text-right" name="vlr_bruto"  id="vlr_bruto" placeholder="0,00" value="0" onchange="valor_final()">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Desc./Acrs.</label>
                    <input type="text" class="form-control form-control-sm text-right" name="vlr_dsc_acr"  id="vlr_dsc_acr" placeholder="0,00" value="0" onchange="valor_final()">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Valor Final</label>
                    <input type="text" class="form-control form-control-sm text-right" name="vlr_final"  id="vlr_final" placeholder="0,00" value="0" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-default btn-sm" href="{{ route('lancamento.index') }}" >Cancelar</button>
          <button type="submit" id="salvar_submit" class="btn btn-primary btn-sm float-right">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="tipo"                       value="D">
  <input type="hidden" name="id_forma_pagamento"         value="1">
  <input type="hidden" name="descricao"                  value="Dinheiro">
  <input type="hidden" name="id_usuario_lancamento"      value="{{ Auth::User()->id }}">
  <input type="hidden" name="id_usuario_confirmacao"     value="{{ Auth::User()->id }}">
  <input type="hidden" name="id_caixa"                   value="{{ Auth::User()->abcde->first()->id ?? null }}">
  <input type="hidden" name="id_lancamento_origem"       value="">
  <input type="hidden" name="origem"                     value="">
  <input type="hidden" name="status"                     value="">
  <input type="hidden" name="id_conta" id="id_conta"     value="">
</form>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    $("#vlr_bruto, #vlr_final").inputmask('decimal', {
      'alias': 'numeric',
      'groupSeparator': '.',
      'autoGroup': true,
      'digits': 2,
      'radixPoint': ",",
      'digitsOptional': false,
      'allowMinus': false,
      'placeholder': '0,00',
    });

    $("#vlr_dsc_acr").inputmask('decimal', {
      'alias': 'numeric',
      'groupSeparator': '.',
      'autoGroup': true,
      'digits': 2,
      'radixPoint': ",",
      'digitsOptional': false,
      'allowMinus': true,
      'placeholder': '0,00',
    });

    contas(1, 2, '#conta_nivel_1');
    descobrir_id_caixa()
  });

  function contas(nivel, conta_pai, field)
  {
    axios.post( "{{ route('contabil.search') }}", {
      conta_pai  : conta_pai,
      nivel      : nivel,
      _token     : $('meta[name="csrf-token"]').attr('content'),
    })
    .then(function(response)
    {
      // console.log(response.data)
      if((response.data).length > 0)
      {
        $(field).empty();
        $(field).append('<option value="">Selecione . . .</option>');
        response.data.forEach((obj, i) => {
          $(field).append('<option value='+obj.id+'>'+obj.conta+' - '+obj.descricao+'</option>');
        });

        $('#div_conta_nivel_'+nivel+'').show();
        $(field).select2();
        $('#id_conta').val('');
      }
      else
      {
        $('#id_conta').val( $('#conta_nivel_'+(nivel-1)).val() );
      }
    })
@include('includes.catch', [ 'codigo_erro' => '1575456a' ] )
  }

  $('#id_banco').on('change', function()
  {
    descobrir_id_caixa()
  })

  function descobrir_id_caixa()
  {
    var id_banco = $('#id_banco').val();

    url = "{{ route('fin.banco.CaixaAberto', ':id') }}";
    url = url.replace(':id', id_banco );

    axios.get(url)
    .then( function(response)
    {
      // console.log(response.data)
      $('#id_caixa').val(response.data);
    })    
  }
    
  function valor_final()
  {
    var vlr_bruto   = Number(parseFloat($('#vlr_bruto').val().replace(".", "").replace(".", "").replace(".", "").replace(".", "").replace(",", "") / 100).toFixed(2));
    var vlr_dsc_acr = Number(parseFloat($('#vlr_dsc_acr').val().replace(".", "").replace(".", "").replace(".", "").replace(".", "").replace(",", "") / 100).toFixed(2));

    var vlr_final   = vlr_bruto + vlr_dsc_acr;

    $("#vlr_final").inputmask('setvalue', vlr_final);
  }
  
  $( "#salvar_submit" ).click(function()
  {
    var dados = $("#form_lancdespesa").serialize();

    axios.post("{{ route('lancamento.lancar_d_gerais') }}", dados)
    .then(function(response)
    {
      // console.log(response)
      window.location.href = response.data.redirect;
    })
@include('includes.catch', [ 'codigo_erro' => '9295585a' ] )
  })
</script>
@endpush