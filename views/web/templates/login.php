<form action="/login" method="post">
    {{@csrf_token}}
    <input type="text" name="login"><br>
    <input type="text" name="password"><br>
    <button type="submit">doLogin</button>
</form>