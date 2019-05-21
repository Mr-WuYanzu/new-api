<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
</head>
<body>
    <table>
        <form action="/register" method="post" enctype="multipart/form-data">
            @csrf
            <tr>
                <td>用户名：</td>
                <td><input type="text" name="firm_name"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="text" name="legal_person"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </form>
    </table>
</body>
</html>