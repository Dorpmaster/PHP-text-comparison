<?php
mb_internal_encoding('UTF-8');

require(__DIR__ . '/src/autoload.php');
require(__DIR__ . '/src/bootstrap.php');

use Diff\Processor\AnalyseForm;

$analyseForm = new AnalyseForm();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Test 1</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Custom styles for this project. -->
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Test 1</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li <?php print (AnalyseForm::isActiveVersion('a') ? 'class="active"' : ''); ?>><a
                        href="index.php?version=a">Version A</a></li>
                <li <?php print (AnalyseForm::isActiveVersion('b') ? 'class="active"' : ''); ?>><a
                        href="index.php?version=b">Version B</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <h1>Test 1: Analyse and compare two texts</h1>

        <p>Text 1 is written by our freelancing writer.<br>Text 2 is a better version of the same text,
            edited by our proofreaders.<br>This service displays Text 2 and mark what is changed.
        </p>
    </div>

    <form action="index.php#prText" method="post">
        <div class="form-group">
            <label for="flText">Text 1</label>
            <textarea class="form-control" rows="10" name="flText"
                      id="flText"><?php print $analyseForm->getFlText(); ?></textarea>
        </div>
        <div class="form-group">
            <label for="prText">Text 2</label>
            <textarea class="form-control" rows="10" name="prText"
                      id="prText"><?php print $analyseForm->getPrText(); ?></textarea>
        </div>
        <div class="form-group">
            <label for="granularity">Granularity:</label>
            <label class="radio-inline">
                <input type="radio" name="granularity" id="granularity0" value="0" <?php print($analyseForm::isActiveGranularity(0) ? 'checked' : ''); ?>> Word
            </label>
            <label class="radio-inline">
                <input type="radio" name="granularity" id="granularity1" value="1" <?php print($analyseForm::isActiveGranularity(1) ? 'checked' : ''); ?>> Character
            </label>
        </div>
        <input type="submit" class="btn btn-default" value="Compare">
        <input type="hidden" value="<?php print AnalyseForm::getActiveVersion(); ?>" name="version">
    </form>

    <div id="compared-text"><?php print $analyseForm->compare(); ?></div>

</div>
<!-- /.container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/analyse.js"></script>
</body>
</html>