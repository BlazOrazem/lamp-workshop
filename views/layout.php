<?php if(!defined('ALLOW_INCLUDE')) die('Forbidden!'); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$pageTitle?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
</head>

<body>
<?php if (isset($_SESSION['user_id'])) : ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin/">Delavnice</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li<?php if ($method == 'runIndex'): ?> class="active"<?php endif; ?>>
                        <a href="/admin/">Domov</a>
                    </li>
                    <li<?php if ($method == 'runNew'): ?> class="active"<?php endif; ?>>
                        <a href="/admin/new">Dodaj delavnico</a>
                    </li>
                    <li<?php if ($method == 'runEdit'): ?> class="active"<?php endif; ?>>
                        <a href="/admin/edit">Urejaj delavnice</a>
                    </li>
                    <li<?php if ($method == 'runParticipants'): ?> class="active"<?php endif; ?>>
                        <a href="/admin/participants">Pregled prijav</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/admin/logout">Odjava <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php endif; ?>

<div id="content" class="container alert alert-info">
    <h1><?=$pageTitle?></h1>
    <?=$content?>
</div>

<script src="/js/jquery-2.2.2.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</body>
</html>