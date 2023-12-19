<?php
require_once('./crud.php');
if(isset($_GET['exclude'])){
    $id= filter_input(INPUT_GET, 'exclude', FILTER_SANITIZE_NUMBER_INT);

    if($id)
        $con-> exec('DELETE FROM metas WHERE id=' . $id);
    
    header('Location: index.php');

}

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
                            <button class="btn btn-sm btn-danger" onclick="exclude(<?=$item['id']?>)">Excluir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    </div>
</div>

<script>
    function exclude(id){
        if(confirm("Deseja excluir essa meta ?")){
            window.location.href = "index.php?exclude=" + id;
        }
    }
</script>



<?php include_once('layout/footer.php') ?>