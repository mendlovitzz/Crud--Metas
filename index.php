<?php
require_once('./crud.php');

$results = $con->query('select * from metas')->fetchAll();
$arraySituacao = [1 => 'Aberta', 2 => 'Em Andamento', 3=> 'Concluída'];

include_once('layout/_header.php');
?>
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between aling-items-center">
        <h5>Minhas Metas</h5>
        <a class="btn btn-success" href="cadastro.php">Adicionar</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($results as $item): ?>
                    <tr>
                        <td><?=$item['descricao']?> </td>
                        <td><?=$arraySituacao[$item['situacao']]?> </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="cadastro.php?id=<?=$item['id']?> ">Editar</a>
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    </div>
</div>
<?php include_once('layout/footer.php') ?>