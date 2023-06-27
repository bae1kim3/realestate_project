<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @livewireStyles

    <style>
        footer {
            width: 100%;
            height: 150px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            color: white;
            background-color: #215083;
            margin-top: 30px;
            font-size:13px;
        }

        footer>h4 {
            text-align: center;
            margin-top: 70px;
        }

        #top {
            font-weight: bold;
        }

        footer>ul {
            margin-top: 25px;
            text-align: center;
        }

        #copyright {
            width: 100%;
            height: 50px;
            text-align: center;
            color: white;
            background-color: rgb(6, 56, 67);
        }

        #copyright>p {
            padding: 15px;
        }

        ul {
            list-style: none;
        }
    </style>
</head>

<body>
    <div id="footer">
        <footer>
            <h4>B1K3</h4>
            <ul>
                <li id="top">B1K3</li>
                <li>JOO YOUNG KIM</li>
                <li>MIN GUE KIM</li>
                <li>CHANG HYEUN BAE</li>
                <li>YEONG BEOM KIM</li>
            </ul>
            <ul>
                <li>👋🏻</li>
                <li>IMPLEMENTS</li>
                <li>GREEN ART COMPUTER 506</li>
                <li>010-1234-5678</li>
                <li>abcde@example.com</li>
            </ul>
        </footer>
        <div id="copyright">
            <p>@copyright 2023 B1K3</p>
        </div>
    </div>

</body>

</html>
