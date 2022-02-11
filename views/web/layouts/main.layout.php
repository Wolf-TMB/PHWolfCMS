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
    <div class="main flex-column d-flex" style="min-height: 100vh">
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
    .main {
        /*background: url("https://images.vexels.com/media/users/3/143710/raw/a084848f4e6e545b9e7b16d102b6f866-colorful-abstract-background.jpg") no-repeat; */
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
    .news_img {
        object-fit: cover;
        width: 100%;
        height: 30vh;
    }
    .grad_border {
        -webkit-border-radius: 15px;
        -webkit-border-image: -webkit-gradient(linear, 0 0, 0 100%, from(#302b63), to(#24243e)) 1 100%;
    }
</style>
<script>
    // import 'bootstrap';
    // let cImages = document.getElementById('cImages');
    // let buttonLeft = document.getElementById('prev');
    // let buttonNext = document.getElementById('next');

    // let to1 = document.getElementById('to1');
    // let to2 = document.getElementById('to2');
    // let to3 = document.getElementById('to3');

    // let ind = document.getElementById('ind');

    // buttonLeft.addEventListener('click', () => {
    //     for (let i = 0; i < cImages.children.length; i++) {
    //         if (cImages.children[i].className.split(' ').includes('active')) {
    //             let idx = 0;
    //             if (i === 0) idx = 2;
    //             if (i === 1) idx = 0;
    //             if (i === 2) idx = 1;
    //             cImages.children[i].classList.remove('active');
    //             cImages.children[idx].classList.add('active');
    //             ind.children[i].classList.remove('active');
    //             ind.children[idx].classList.add('active');
    //             return;
    //         }
    //     }
    // });
    // buttonNext.addEventListener('click', () => {
    //     for (let i = 0; i < cImages.children.length; i++) {
    //         if (cImages.children[i].className.split(' ').includes('active')) {
    //             let idx = 0;
    //             if (i === 0) idx = 1;
    //             if (i === 1) idx = 2;
    //             if (i === 2) idx = 0;
    //             cImages.children[i].classList.remove('active');
    //             cImages.children[idx].classList.add('active');
    //             ind.children[i].classList.remove('active');
    //             ind.children[idx].classList.add('active');
    //             return;
    //         }
    //     }
    // })

    // to1.addEventListener('click', () => {
    //     cImages.children[1].classList.remove('active');
    //     cImages.children[1].classList.add('active');
    //     ind.children[1].classList.remove('active');
    //     ind.children[1].classList.add('active');
    // })
    // to2.addEventListener('click', () => {
    //     cImages.children[2].classList.remove('active');
    //     cImages.children[2].classList.add('active');
    //     ind.children[2].classList.remove('active');
    //     ind.children[2].classList.add('active');
    // })
    // to3.addEventListener('click', () => {
    //     cImages.children[3].classList.remove('active');
    //     cImages.children[3].classList.add('active');
    //     ind.children[3].classList.remove('active');
    //     ind.children[3].classList.add('active');
    // })
</script>
</html>