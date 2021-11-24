<script>
    function confirmar(){
        if(!confirm("Deseja excluir?")){ return false } else { return true };
    }
</script>

<div class="row my-3">
    <a href="../" class="btn btn-info" style="margin-right: 5px">Página Inicial</a>
    <a href="/fluxoestoques/create" class="btn btn-primary">Novo Fluxo de Estoque</a>
</div>

<h2>Listagem de Fluxo de Estoque</h2>
<div class="clear"></div>

<table class="table">
    <tr class="text-center">
        <th>Momento</th>
        <th>Produto</th>
        <th>Fluxo</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>
    <?php if(!empty($fluxoestoques) && is_array($fluxoestoques)): ?>
        <?php foreach($fluxoestoques as $fluxo_item): ?>
            <tr>
                <td><?php echo date("d/m/Y - H:i:s",strtotime($fluxo_item['momento'])); ?></td>
                <td>
                    <?php 
                        foreach($produtos as $produto_item):
                            if($produto_item['id'] == $fluxo_item['produto_id']):
                                echo $produto_item['nome'];
                                break;
                            endif;
                        endforeach;
                    ?>
                </td>
                <td>
                    <?php
                        if($fluxo_item['entrada_saida'] == "e")
                            echo "Entrada";
                        else
                            echo "Saída";
                    ?>
                </td>
                <td><?php echo $fluxo_item['quantidade'] ?></td>
                <td class="text-center">
                    <a class="btn btn-success" href="<?php echo "/fluxoestoques/view/".$fluxo_item['id'] ?>">Visualizar</a>
                    <a class="btn btn-warning" href="/fluxoestoques/edit/<?php echo $fluxo_item['id'] ?>">Editar</a>
                    <a class="btn btn-danger" href="/fluxoestoques/delete/<?php echo $fluxo_item['id'] ?>" onclick="return confirmar()">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">Nenhum registro encontrado!</td>
        </tr>
    <?php endif; ?>
</table>