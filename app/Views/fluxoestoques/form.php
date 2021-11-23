<div class="row">
    <a href="/fluxoestoques" class="btn btn-info" style="margin-right: 10px">Voltar</a>
</div>

<h2><?php echo isset($id) ? "Editar Fluxo de Estoque" : "Novo Fluxo de Estoque" ?></h2>

<?php echo \Config\Services::validation()->listErrors(); ?>

<form action="/fluxoestoques/store" method="post">

    <div class="form-group">
        <label for="produto_id">Produto</label>
        <select name="produto_id" id="produto_id" class="form-control" <?php echo isset($id) ? "readonly" : "" ?>>
            <?php if(!empty($produtos) && is_array($produtos)): ?>
                <?php foreach($produtos as $produtos_item): ?>
                    <?php if($produtos_item['id'] == @$produto_id): ?>
                        <option selected value="<?php echo $produtos_item['id'] ?>"><?php echo $produtos_item['nome'] ?></option>
                    <?php else: ?>
                        <option value="<?php echo $produtos_item['id'] ?>"><?php echo $produtos_item['nome'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="entrada_saida">Fluxo</label>
        <select name="entrada_saida" id="entrada_saida" class="form-control">
            <?php if(isset($entrada_saida)): ?>
                <?php if($entrada_saida == "e"): ?>
                    <option selected value="e">Entrada</option>
                    <option value="s">Saída</option>
                <?php else: ?>
                    <option value="e">Entrada</option>
                    <option selected value="s">Saída</option>
                <?php endif; ?>
            <?php else: ?>
                <option value="e">Entrada</option>
                <option value="s">Saída</option>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade</label>
        <input type="number" class="form-control" name="quantidade" id="quantidade" step="0.01" value="<?php echo isset($quantidade) ? $quantidade : set_value('quantidade') ?>">
    </div>

    <div class="form-group">
        <label for="momento">Momento</label>
        <input type="datetime-local" class="form-control" name="momento" id="momento"
        value="<?php echo isset($quantidade) ? str_replace(' ','T',$momento) : set_value('momento') ?>">
    </div>

    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : set_value('id') ?>">

    <div class="form-group text-center">
        <input type="submit" value="<?php echo isset($id) ? "Editar" : "Adicionar" ?>" class="btn btn-primary">
    </div>
</form>