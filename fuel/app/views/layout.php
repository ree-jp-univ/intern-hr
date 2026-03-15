<html lang="ja">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo \Fuel\Core\Asset::css('layout.css'); ?>
</head>

<body>
    <?php echo $header; ?>
    <?php echo $content; ?>
    <?php if (!is_null($footer)) {
        echo $footer;
    } ?>
</body>

</html>