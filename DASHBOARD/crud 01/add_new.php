<?php
include "db_conn.php";

if (isset($_POST['submit'])) {
    $NOME = $_POST['NOME'];
    $QUANT = $_POST['QUANT'];
    $UNI_MEDIDA = $_POST['UNI_MEDIDA'];
    $CAPACIDADE = $_POST['CAPACIDADE'];
    $LOCAL = $_POST['LOCAL'];

    $sql = "INSERT INTO `crud-01`(`ID`, `NOME`, `QUANT`, `CAPACIDADE`, `LOCAL`, `UNI_MEDIDA`) VALUES ('NULL','$NOME','$QUANT','$CAPACIDADE','$LOCAL','$UNI_MEDIDA')";
    $result = "mysqli_query($conn, $sql)";

    if($result){
        header("location: vidrarias.php?msg=Nova Vidraria Cadastrada Com Sucesso!");
    }
    else{
        echo "Failed: " . mysqli_error($conn);
    }
}


?>

















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserindo Dados</title>

    <!-- BOOTSTRAP CONNECT -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>


    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        Inserindo Vidrarias à tabela.
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>ADD NOVOS DADOS</h3>
            <p class="text-muted">Complete o formulário para adicionar a nova Vidraria</p>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="inserir.php" method="POST" style="widht:50vh; min-widht:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label"> Nome</label>
                    <input type="text" class="form-control" name=NOME" placeholder="Pipeta Volumétrica">
                </div>

                <div class="col">
                    <label class="form-label"> Quantidade</label>
                    <input type="number" class="form-control" name="QUANT">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label"> Capacidade de Armazenamento</label>
                    <input type="number" class="form-control" name=CAPACIDADE" placeholder="80">
                </div>

                <div class="col">
                    <label class="form-label"> Unidade de Medida</label>
                    <input type="text" class="form-control" name=UNI_MEDIDA" placeholder="Ml">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Localização</label>
                    <input type="text" class="form-control" name=LOCAL" placeholder="A01">
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="Submit">Inserir</button>
                <a href="vidrarias.php" class="btn btn-danger">Cancelar</a>
            </div>

        </form>
    </div>


    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>