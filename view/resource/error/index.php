<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET["error"]?></title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        body > div[style="text-align:right;position:fixed;bottom:3px;right:3px;width:100%;z-index:999999;cursor:pointer;line-height:0;display:block;"]{
            display: none !important;
        }
        body > div *{
            text-align: center;
            font-weight: 600;
        }
        body > div h1{
            margin: 30px 0;
            animation: errorTitle ease 1.5s infinite;
        }
        .adv{
            color: rgba(245,245,245,0.8);
        }
        .moji{
            position: fixed;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            color: grey;
        }
        @keyframes errorTitle{
            10%, 60%, 80%{
                color: black;
            }
            30%, 70%, 100%{
                color: rgba(245,245,245,0.8);
            }
        }
    </style>
</head>
<body>
    <div>
        <h1 class="adv"><?php echo $_GET["error"]?></h1>
        <h4><?php echo $_GET["text"]?></h4>
    </div>
    <div>
        <?php $arr = ["(-_-;)・・・", "(・_・;)", "Σ(O_O)", "ＵＴｪＴＵ", "(っ˘ڡ˘ς)", "( ಠ ʖ̯ ಠ)", "(￣^￣)ゞ", "( . •́ _ʖ •̀ .)"]?>
        <div class="moji"><?php echo $arr[rand(0, count($arr)-1)]?></div>
    </div>
</body>
</html>