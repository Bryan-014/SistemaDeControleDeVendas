<?php    
    $salgad = mysqli_query($connection, "select * from tbl_produtos where ativo = 1 and categoria = 'Salgado' and cod != '1'");
    $doce = mysqli_query($connection, "select * from tbl_produtos where ativo = 1 and categoria = 'Doce'");
?>
<div class="d-flex justify-content-center mt-4">
    <div class="card-container mt-2">
        <h3>Salgados</h3>
        <div class="table">
            <table>
                <tr>
                    <th>Cód</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                </tr>
                <?php
                    foreach ($salgad as $sab) {
                        ?>
                            <tr>
                                <td><?php echo($sab['cod'])?></td>
                                <td><?php echo($sab['descricao'])?></td>
                                <td>R$ <?php echo(number_format(floatval($sab['preco']), 2, ',', '.'))?></td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <div class="card-container mt-2">
        <h3>Doces</h3>
        <div class="table">
            <table>
                <tr>
                    <th>Cód</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                </tr>
                <?php
                    foreach ($doce as $sab) {
                        ?>
                            <tr>
                                <td><?php echo($sab['cod'])?></td>
                                <td><?php echo($sab['descricao'])?></td>
                                <td>R$ <?php echo(number_format(floatval($sab['preco']), 2, ',', '.'))?></td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <?
?>