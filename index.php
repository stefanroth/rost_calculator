<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function ($class) {
    $classFile = $class . '.php';
    if (is_file($classFile)) {
        include $classFile;
    } else {
        echo $classFile . ' not found';
    }
});

$messageCenter = new MessageCenter();
$messageCenter->add('Calculator started', MessageCenter::TYPE_INFO);
$calculator = (new Calculator())->setMessageCenter($messageCenter);
$vInput = isset($_POST['c_input']) ? $_POST['c_input'] : '';
$vOutput = $calculator->execute($vInput);
?>
<!doctype HTML>
<html>
    <head>
        <title>calculator</title>
        <meta charset="UTF-8">
        <style>
            *, textarea {
                font-family: helvetica, sans-serif;
                font-size: 14px;
                box-sizing: border-box;
            }

            body {
                width: 900px;
                margin: 0px auto;
            }

            h1 {
                font-size: 24px;
                color: steelblue;
                border-bottom: 1px solid steelblue;
            }

            textarea {
                width: 100%;
                height: 100px;
                padding: 10px;
            }

            .result {
                background-color: lightgrey;
                padding: 10px;
                margin-top: 50px;
            }

            .messages .message-info::before {
                content: 'INFO: ';
            }

            .messages .message-info {
                before: "Info: ";
                color: steelblue;
                padding: 10px;
            }

            .messages .message-warning::before {
                content: 'WARNING: ';
            }
            .messages .message-warning {
                color: steelblue;
                font-weight: bold;
                padding: 10px;
            }

            .messages .message-error::before {
                content: 'ERROR: ';
            }

            .messages .message-error {
                color: red;
                font-weight: bold;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <h1>Calculator</h1>
        <div class="messages">
            <?php foreach ($messageCenter->getMessages() as $message) : ?>
            <div class="message-<?=$message['type'];?>"><?=$message['message'];?></div>
            <?php endforeach; ?>
        </div>
        <div>
            <form method="POST">
                <div>
                    <textarea name="c_input"><?= $vInput ?></textarea>
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>
        </div>
        <div class="result"><?= $vOutput; ?></div>
    </body>
</html>