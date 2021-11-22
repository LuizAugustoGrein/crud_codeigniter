<script>
    function confirmar(){
        if(!confirm("Deseja excluir?")){
            return false;
        }
        return true;
    }
</script>

<div class="row my-3">
    <a href="../" class="btn btn-info" style="margin-right: 5px">Voltar</a>
    <a href="/produtos/create" class="btn btn-primary">Novo Produto</a>
</div>

<h2>Listagem de Produtos</h2>
<div class="clear"></div>

<table class="table">
    <tr class="text-center">
        <th>Nome</th>
        <th>Valor de Custo</th>
        <th>Valor de Venda</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>
    <?php 
        if(!empty($produtos) && is_array($produtos)): 
            foreach($produtos as $produtos_item):
    ?>

        <tr>
            <td>
                <?php echo $produtos_item['nome'] ?>
            </td>
            <td>
                <?php echo $produtos_item['valor_custo'] ?>
            </td>
            <td>
                <?php echo $produtos_item['valor_venda'] ?>
            </td>
            <td>
                <?php echo $produtos_item['quantidade'] ?>
            </td>
            <td class="text-center">
                <a class="btn btn-success" href="<?php echo "/produtos/view/".$produtos_item['id'] ?>">Visualizar</a>
                <a class="btn btn-warning" href="/produtos/edit/<?php echo $produtos_item['id'] ?>">Editar</a>
                <a class="btn btn-danger" href="/produtos/delete/<?php echo $produtos_item['id'] ?>" onclick="return confirmar()">Excluir</a>
            </td>
        </tr>

    <?php 
            endforeach;
        else:
    ?>
        <tr>
            <td colspan="2">Nenhum registro encontrado!</td>
        </tr>
    <?php 
        endif;
    ?>
</table>