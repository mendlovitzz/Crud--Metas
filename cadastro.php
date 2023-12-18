<?php

require_once('crud.php');
$id =0;
$descricao='';
$situacao= 1;


if(isset($_GET['id'])){
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    if(!$id){
        header('Location : index.php');
        exit;
    }

    $stm = $con->prepare('SELECT * FROM metas WHERE id=:id');
    $stm->bindValue('id', $id);
    $stm->execute();
    $result = $stm->fetch();

    if(!$result){
        header('Location :index.php');
        exit;
    }
    $descricao= $result['descricao'];
    $situacao = $result ['situacao'];

}

if(isset($_POST['id'])){
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $situacao = filter_input(INPUT_POST, "situacao", FILTER_SANITIZE_NUMBER_INT);

    if(!$id){
        $stm = $con-> prepare("INSERT INTO metas (descricao, situacao) VALUES(:descricao, :situacao) ");
    }else{
       $stm = $con-> prepare("UPDATE metas SET descricao=:descricao, situacao=: situacao WHERE id=:id ");
        $stm->bindValue(':id', $id);
    }

    $stm = $con-> prepare("INSERT INTO metas (descricao, situacao) VALUES(:descricao, :situacao) ");
    $stm->bindValue(':descricao', $descricao);
    $stm->bindValue('situacao', $situacao);
    $stm-> execute();

    header('Location: index.php');
}

include_once('layout/_header.php');

?>
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between aling-items-center">
        <h5> <?= $id?'Editar Meta: ' . $id:'Adicionar Meta'?></h5>
       
    </div>
    <form method="post" autocomplete="off" >
        <div class="card-body">
            <input type="hidden" name="id" value= "<?= $id ?>">
            <div class="form-group">
                <label for="descricao" value="<? $descricao ?>" >Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required >
            </div>
            <div class="form-group">
                <label for="situacao"">Situação</label>
                <select class="form-select" name="situacao" id="situacao">
                    <option value="1" <?=$situacao == 1??'selected'?> >Aberta</option>
                    <option value="2" <?=$situacao == 2??'selected'?> >Em Andamento</option>
                    <option value="3" <?=$situacao == 3??'selected'?> >Realizada</option>
                </select>
            </div>
        </div>
        <div class="card-footer  d-flex justify-content-between aling-items-center">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a class="btn-primary" href="index.php" >Voltar</a>
        </div>

    </form>
</div>
<?php include_once('layout/footer.php') ?>