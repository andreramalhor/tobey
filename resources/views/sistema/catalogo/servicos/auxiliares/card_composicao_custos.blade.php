<div class="card">
  <div class="card-header">
    <h3 class="card-title">Composição dos Custos</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label class="col-form-label">Valor de Mercado</label>
          <input type="text" class="form-control form-control-sm" name="vlr_mercado" value="{{ $servico->vlr_mercado ?? 0}}">
        </div>
      </div>
      
      <div class="col-6">
        <div class="form-group">
          <label class="col-form-label">Valor em Nota</label>
          <input type="text" class="form-control form-control-sm" name="vlr_nota" value="{{ $servico->vlr_nota ?? 0}}">
        </div>
      </div>
      
      <div class="col-6">
        <div class="form-group">
          <label class="col-form-label">Valor de Frete</label>
          <input type="text" class="form-control form-control-sm" name="vlr_frete" value="{{ $servico->vlr_frete ?? 0}}">
        </div>
      </div>
      
      <div class="col-6">
        <div class="form-group">
          <label class="col-form-label">Valor da Comissão</label>
          <input type="text" class="form-control form-control-sm" name="vlr_comissao" value="{{ $servico->vlr_comissao ?? 0}}">
        </div>
      </div>
            
      <div class="col-6">
        <label class="col-form-label">Custo do Serviço</label>
        <input type="text" class="form-control form-control-sm" name="vlr_custo" value="{{ $servico->vlr_custo ?? 0}}">
      </div>
      
      <div class="col-6">
        <div class="form-group">
          <label class="col-form-label">Custo do Estoque</label>
          <input type="text" class="form-control form-control-sm" name="vlr_custo_estoque" value="{{ $servico->vlr_custo_estoque ?? 0}}" disabled>
        </div>
      </div>
      
      <div class="col-6">
        <div class="form-group">
          <label class="col-form-label">Percentual (padrão) de Comissão</label>
          <input type="text" class="form-control form-control-sm" name="prc_comissao" value="{{ $servico->prc_comissao ?? 0}}">
        </div>
      </div>
      
      <div class="col-6">
        <div class="form-group">
          <label class="col-form-label">Custo Adicional</label>
          <input type="text" class="form-control form-control-sm" name="cst_adicional" value="{{ $servico->cst_adicional ?? 0}}">
        </div>
      </div>
      
    </div>
  </div>
</div>