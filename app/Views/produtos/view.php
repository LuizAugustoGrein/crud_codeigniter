<div class="view">
    <div class="row">
        <a href="/produtos" class="btn btn-info" style="margin-right: 10px">Voltar</a>
    </div>

    <h2><?php echo $produtos['nome'] ?></h2>

    <span class="bold">ID:</span>
    <span><?php echo $produtos['id'] ?></span>
    <hr>
    <span class="bold">Descrição:</span>
    <span><?php echo $produtos['descricao'] ?></span>
    <hr>
    <span class="bold">Valor de Custo:</span>
    <span><?php echo $produtos['valor_custo'] ?></span>
    <hr>
    <span class="bold">Valor de Venda:</span>
    <span><?php echo $produtos['valor_venda'] ?></span>
    <hr>
    <span class="bold">Quantidade:</span>
    <span><?php echo $produtos['quantidade'] ?></span>
    <hr>
    <span class="bold">Criado em:</span>
    <span><?php echo date("d/m/Y H:i:s",strtotime($produtos['created_at']));?></span>
    <hr>
    <span class="bold">Última Atualização:</span>
    <span><?php echo date("d/m/Y H:i:s",strtotime($produtos['updated_at']));?></span>
</div>