<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="og:title" content="WilyCraft">
    <meta property="og:description" content="Лучшие оптимизированные Minecraft серверы">
    <meta property="og:image" content="/resources/img/test.png">

    <title><?= /** @var string $title */ $title ?></title>
    <link rel="stylesheet" href="/resources/css/style.css">

    <link rel="apple-touch-icon" sizes="180x180" href="/resources/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/resources/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/resources/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/resources/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/resources/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#422040">

    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="main flex-column d-flex">
        {{block:navbar}}
        <div class="body container flex-grow-1 mt-5">
            <div class="row">
                {{content}}
                {{block:sidebar}}
            </div>
        </div>
        <div>
            {{block:footer}}
        </div>
    </div>
</body>
<style>

    .wc-transition-500ms {
        transition: 500ms;
        transition-timing-function: ease-in-out;
    }

    .wc-pb-2px {
        padding-bottom: 2px
    }

    .wc-image-white {
        filter: brightness(0) invert(1);
    }

    .wc-h-40px {
        height: 40px;
    }
    .wc-h-10px {
        height: 10px;
    }

    .ms-6 {
        margin-left: 6rem;
    }

    .z-10 {
        z-index: 10;
    }

    .wc-cur-pointer {
        cursor: pointer;
    }

    .wc-pd-8-24 {
        padding: 8px 24px;
    }

    .wc-obj-fit-cover {
        object-fit: cover;
    }

    .wc-wh-15px {
        width: 15px !important;
        height: 15px !important;
    }

    .wc-wh-1rem {
        width: 1rem;
        height: 1rem;
    }
    .wc-wh-1_5rem {
        width: 1.5rem;
        height: 1.5rem;
    }

    .wc-h-30vh {
        height: 30vh;
    }

    .wc-background-gradient {
        background: linear-gradient(to right, #252449,#24243e);
    }

    .wc-start-gradient {
        background: linear-gradient(to right,#8A2387,#F27121);
    }

    .wc-offline-gradient {
        background: linear-gradient(to right,#ff9966,#ff5e62);
    }

    .main {
        min-height: 100vh
    }
    .navbar {
        background: linear-gradient(to right, #252449,#24243e);
    }
    .body {
        width: 100%;
        height: 100%;
    }
    .footer {
        height: 5vh;
    }
    .cimg {
        border-radius: 15px;
    }

    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f8f9fa;
    }

    ::-webkit-scrollbar-thumb {
        background: #212529;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
</html>