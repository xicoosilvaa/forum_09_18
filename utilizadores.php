<?php
    include_once('verificar_sessao.php');
    include_once('bd.php');
    if (!isset($_SESSION['utilizador'])) {
        $_SESSION['erro'] = 'Inicie a sessão';
        header('Location: login.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum</title>
    <?php require_once('metadados.php') ?>
</head>
<body>
    <div class="container">
        <?php include_once('header.php'); ?>
        <?php include_once('navegacao.php'); ?>
        <table class="table table-sm table-striped table-hover table-bordered mt-2">
            <thead class="px-3">
                <tr>
                    <th scope="col">Utilizadores</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ativo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT idutilizador, utilizador, tipo, ativo, dataregisto';
                $sql .= ' FROM t_utilizador';
                $sql .= ' ORDER BY idutilizador ASC';
                $rs = consultarBD($sql);
                foreach ($rs as $registo) {
                    $id_utilizador = $registo['idutilizador'];
                    $dataregisto = date_format(date_create($registo['dataregisto']),"d/m/Y H:i:s");
                    $utilizador = $registo['utilizador'];
                    $tipo = $registo['tipo'];
                    $ativo = $registo['ativo'];
                ?>   
                    <tr>
                        <td class="p-2">
                            <p>
                                <a class="link-offset-3-hover link-underline 
                                    link-underline-opacity-0 link-underline-opacity-75-hover" 
                                    href="topico.php?id_topico=<?php echo $id_topico; ?>" >
                                    <?php echo $utilizador; ?>
                                </a>
                            </p>
                        </td>
                        <td class="p-2">
                            <p>
                                <a class="link-offset-3-hover link-underline 
                                    link-underline-opacity-0 link-underline-opacity-75-hover" 
                                    href="topico.php?id_topico=<?php echo $id_topico; ?>" >
                                    <?php echo $tipo; ?>
                                </a>
                            </p>
                        </td>
                        <td class="p-2">
                            <p>
                                <a class="link-offset-3-hover link-underline 
                                    link-underline-opacity-0 link-underline-opacity-75-hover" 
                                    href="topico.php?id_topico=<?php echo $id_topico; ?>" >
                                    <?php 
                                    if ($registo['ativo'] == 1){
                                        echo "Sim";
                                    }
                                    else{
                                        echo "Não";
                                    }
                                    ?>
                                </a>
                            </p>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <?php include_once('footer.php'); ?>
    </div>
</body>
</html>
