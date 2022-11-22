<?php

if (isset($explode[1])) {

    $idProduto = $explode[1];

    if (is_numeric($idProduto) && $idProduto != "") {
        $produto = $i->Produtos->getProdutoById($idProduto);
        if ($produto == false) {
            echo '<script>
    location.href = "../home";
</script>';
        }
    } else {
        echo '<script>
    location.href = "../home";
</script>';
    }
} else {
    echo '<script>
    location.href = "../home";
</script>';
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title><?= $produto->nome; ?></title>
</head>

<body>


    <div class="container">

        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">InfoProdutos</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="home">Home</a>
                <a class="p-2 text-dark" href="#">Contato</a>
                <a class="p-2 text-dark" href="#">Cadastrar-se</a>
            </nav>
            <a class="btn btn-outline-primary" href="#">Login</a>
        </div>


        <div class="row">

            <div class="col-md-6">
                <img src="../img/produtos/<?= $produto->img; ?>" width="80%" title="" alt="">
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col text-center">
                                <?= $produto->nome; ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">HASH</th>
                            <td>
                                <?= $produto->hash_file; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"> R$ </th>
                            <td>
                                <?= $produto->valor; ?>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>

                <div class="row">

                    <div class="col-md-12">

                        <a href="../control/produto.php?id=<?= $produto->id; ?>" class="btn btn-lg btn-success">Comprar</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>