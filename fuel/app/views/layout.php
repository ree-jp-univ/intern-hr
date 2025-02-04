<html>

<head>
    <style>
        body {
            background-color: #fdfbf8;
            color: #373530
        }

        .btn-primary {
            padding: 10px;
            background-color: #447ACB;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #2A4C80;
        }
    </style>
</head>

<body>
    <?php echo $header; ?>
    <?php echo $content; ?>
    <?php if (!is_null($footer)){
        echo $footer;
    } ?>
</body>

</html>