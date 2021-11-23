<div class="view">
    <div class="row">
        <a href="/fluxoestoques" class="btn btn-info" style="margin-right: 10px">Voltar</a>
    </div>

    <h2>
        <?php 
            if($fluxoestoques['entrada_saida'] == "e")
                echo "Entrada de Estoque";
            else
                echo "Saída de Estoque";
        ?>
    </h2>

    <span class="bold">ID:</span>
    <span><?php echo $fluxoestoques['id']; ?></span>
    <hr>
    <span class="bold">Produto:</span>
    <span>
        <?php
            foreach($produtos as $produto_item):
                if($produto_item['id'] == $fluxoestoques['produto_id']):
                    echo $produto_item['nome'];
                    break;
                endif;
            endforeach;
        ?>
    </span>
    <hr>
    <span class="bold">Momento:</span>
    <span><?php echo date("d/m/Y H:i:s",strtotime($fluxoestoques['momento']));?></span>
    <hr>
    <span class="bold">Quantidade:</span>
    <span><?php echo $fluxoestoques['quantidade'] ?></span>
    <hr>
    <span class="bold">Criado em:</span>
    <span><?php echo date("d/m/Y H:i:s",strtotime($fluxoestoques['created_at']));?></span>
    <hr>
    <span class="bold">Última Atualização:</span>
    <span><?php echo date("d/m/Y H:i:s",strtotime($fluxoestoques['updated_at']));?></span>
</div>