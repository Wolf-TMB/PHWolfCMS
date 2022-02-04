<form action="/register" method="post">
    {{@csrf_token}}
    <input type="text" name="login"><br>
    <input type="email" name="email"><br>
    <input type="text" name="password"><br>
    <input type="text" name="password2"><br>
    <button type="submit">doRegister</button>
</form>