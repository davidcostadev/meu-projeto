<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title.' - '.SITETITLE; //SITETITLE defined in index.php?></title>

    <?php
    Assets::css([
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css',
        Url::templatePath().'css/datepicker.css',
        Url::templatePath().'css/bootstrap-datetimepicker.min.css',
        Url::templatePath().'plugins/metisMenu/metisMenu.min.css',
        Url::templatePath().'dist/css/sb-admin-2.css',
        Url::templatePath().'dist/css/timeline.css',
        Url::templatePath().'css/page.css',
    ]);
    echo $css; //place to pass data / plugable hook zone
    ?>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php echo GOOGLE_ANALYTICS; ?>

    <?php 
    Assets::js([
        'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js',
        Url::templatePath().'js/bootstrap-datepicker.js',
        Url::templatePath().'js/bootstrap-datetimepicker.min.js',
        Url::templatePath().'js/typeahead.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
        Url::templatePath().'plugins/metisMenu/metisMenu.js',
        Url::templatePath().'js/page.js'
    ]);
    echo $js; //place to pass data / plugable hook zone

    ?>

</head>
<body class="login-page">
<?php echo $afterBody; //place to pass data / plugable hook zone?>
<div id='wrapper'>