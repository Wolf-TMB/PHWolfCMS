<div>
    <br>
    content
    <br>

</div>

<div class="col-12">
    <div class="offset-md-4 col-md-4">
        <?php
        global $app;
        $app->html->form()
            ->action('/')
            ->method('POST')
            ->inputText('login', 'login', true, 'Логин:', true)
            ->inputPassword('password', 'password', true, 'Пароль:', true)
            ->select('testSelect', 'testSelect', array(
                '1' => 213,
                '2' => '23',
                '3' => ['231', 'options' => ['selected']]
            ), true, 'Нужно шо то выбрать', true)
            ->print();
        ?>
        <form action="/" method="POST">
            <div class=" mb-3">
                <label for="login" class=" form-label">Логин:</label>
                <input type="text" id="login" class=" form-control">
            </div>
            <div class=" mb-3">
                <label for="password" class=" form-label">Пароль:</label>
                <input type="password" id="password" class=" form-control">
            </div>
            <div class=" mb-3">
                <label for="testSelect" class=" form-label">Нужно шо то выбрать</label>
                <select type="testSelect" id="testSelect" class=" form-select">
                    <option value="1">213</option>
                    <option value="2">23</option>
                    <option value="3" selected="">231</option>
                </select>
            </div>
        </form>
    </div>
</div>

