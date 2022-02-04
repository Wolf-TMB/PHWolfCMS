<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= /** @var string $title */ $title ?></title>
    <link rel="stylesheet" href="/resources/css/style.css">
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid p-0 d-flex flex-column" style="min-height: 100vh;">
        {{block:navbar}}
        <div class="col-12 d-flex flex-row flex-grow-1" style="height: 100%;">
            <div class="flex-grow-1">
                {{content}}
            </div>
            <div class="d-flex flex-column">
                {{block:sidebar}}
            </div>
        </div>
    </div>
</body>
</html>