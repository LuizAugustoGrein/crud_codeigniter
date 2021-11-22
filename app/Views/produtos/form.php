<div class="row">
    <a href="/produtos" class="btn btn-info" style="margin-right: 10px">Voltar</a>
</div>

<h2><?php echo isset($id) ? "Editar Produto" : "Novo Produto" ?></h2>

<?php echo \Config\Services::validation()->listErrors(); ?>

<form action="/produtos/store" method="post">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo isset($nome) ? $nome : set_value('nome') ?>">
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" cols="30" rows="10" name="descricao" id="descricao"><?php echo isset($descricao) ? $descricao : set_value('descricao') ?></textarea>
    </div>

    <div class="form-group">
        <label for="valor_custo">Valor de Custo</label>
        <input type="number" class="form-control" name="valor_custo" id="valor_custo" step="0.01" value="<?php echo isset($valor_custo) ? $valor_custo : set_value('valor_custo') ?>">
    </div>

    <div class="form-group">
        <label for="valor_venda">Valor de Venda</label>
        <input type="number" class="form-control" name="valor_venda" id="valor_venda" step="0.01" value="<?php echo isset($valor_venda) ? $valor_venda : set_value('valor_venda') ?>">
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade</label>
        <input type="number" class="form-control" name="quantidade" id="quantidade" step="0.01" value="<?php echo isset($quantidade) ? $quantidade : set_value('quantidade') ?>">
    </div>

    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : set_value('id') ?>">

    <div class="form-group text-center">
        <input type="submit" value="<?php echo isset($id) ? "Editar" : "Adicionar" ?>" class="btn btn-primary">
    </div>
</form>