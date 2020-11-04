<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TemVaga! - Sistema Gerenciador de Vagas de Estacionamento</title>
        <link rel="stylesheet" href="static/css/bootstrap-4.3.1.min.css">
        <link rel="stylesheet" href="static/css/font-awesome-4.7.0.min.css">
        <link rel="stylesheet" type="text/css" href="static/css/default.css">
        <link rel="shortcut icon" href="static/img/favicon.png" type="image/png" />
        <style>
        .nav .nav-link i {
            display: inline-block;
            width: 20px;
        }

        .brand:hover {
            text-decoration: none;
        }
        </style>
<?php if ($controller == "shoppings" && $action == "show"): ?>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
        <style>#mapid { height: 500px; background: #f6f6f6; }</style>
        <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
<?php endif; ?>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-2 bg-light border-right border-bottom p-0">
                    <div class="bg-dark p-3 border-bottom">
                        <a href="index.php" class="h5 m-0 d-block text-center text-light brand">
                            <img src="static/img/logo.svg" alt="" width="41"> TemVaga!
                        </a>
                    </div>
                    <ul class="nav flex-column p-3">
                        <h5 class="mt-2">
                            <i class="fa fa-caret-square-o-right"></i> Shoppings
                        </h5>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="fa fa-eye"></i>
                                Visualizar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=shoppings&action=insert">
                                <i class="fa fa-plus-square-o"></i>
                                Adicionar
                            </a>
                        </li>
<?php if ($controller == "vagas"): ?>
                        <h5 class="mt-2">
                            <i class="fa fa-caret-square-o-right"></i> Vagas
                        </h5>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=vagas&action=show&shopping_id=<?php echo $_GET["shopping_id"]; ?>">
                                <i class="fa fa-eye"></i>
                                Visualizar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=vagas&action=insert&shopping_id=<?php echo $_GET["shopping_id"]; ?>">
                                <i class="fa fa-plus-square-o"></i>
                                Adicionar
                            </a>
                        </li>
<?php endif; ?>
                        <h5 class="mt-2">
                            <i class="fa fa-caret-square-o-right"></i> Clientes
                        </h5>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?controller=clientes&action=show">
                                <i class="fa fa-eye"></i>
                                Visualizar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=clientes&action=insert">
                                <i class="fa fa-plus-square-o"></i>
                                Adicionar
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-10 p-0">
<?php require_once("routes.php"); ?>
                </div>
            </div>
        </div>
<?php if ($action == "show"): ?>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Apagar registro?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <p class="m-0">Você deseja realmente <b>apagar</b> este registro?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger btn-ok">Apagar</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery.min.js"></script>
        <script src="static/js/bootstrap-4.3.1.bundle.min.js"></script>

        <script type="text/javascript">
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
        </script>
<?php endif; ?>
    <p class="m-0 p-4 text-center bg-light">
    Sistema desenvolvido na disciplina de Projeto de Software II, curso Técnico Subsequente em Informática, IFCE-Iguatu.<br/>
    <b>Equipe:</b><br/>
    <i>Francisco das Chagas</i><br/>
    <i>José Edcarlos</i><br/>
    <i>Saulo Silva</i><br/>
    <a href="https://github.com/fchagas97/gerenciador-de-vagas/">Código-fonte</a>
    </p>
    </body>
</html>
