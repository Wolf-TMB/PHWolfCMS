<form action="/test1?get=123" method="post">
    {{@csrf_token}}
    <input name="t" type="text">
    <button type="submit">send</button>
</form>