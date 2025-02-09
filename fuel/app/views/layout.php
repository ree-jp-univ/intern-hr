<html lang="ja">

<head>
    <style>
        body {
            background-color: #fdfbf8;
            color: #373530
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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

        .btn-accent {
            padding: 10px;
            background-color: #c19138;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-accent:hover {
            background-color: #7b5c24;
        }

        .spinner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
            margin: 0 auto;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #447ACB;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            animation: spin 1s linear infinite;
        }

        .w-full {
            width: 100%;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <?php echo $header; ?>
    <?php echo $content; ?>
    <?php if (!is_null($footer)) {
        echo $footer;
    } ?>
</body>

</html>