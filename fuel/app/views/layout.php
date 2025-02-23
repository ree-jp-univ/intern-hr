<html lang="ja">

<head>
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