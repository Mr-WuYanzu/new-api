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
        <form action="/regist" method="post" enctype="multipart/form-data">
            @csrf
            <tr>
                <td>企业名称：</td>
                <td><input type="text" name="firm_name"></td>
            </tr>
            <tr>
                <td>合法人：</td>
                <td><input type="text" name="legal_person"></td>
            </tr>
            <tr>
                <td>税务号：</td>
                <td><input type="text" name="tax_no"></td>
            </tr>
            <tr>
                <td>对公账号：</td>
                <td><input type="text" name="pub_banknum"></td>
            </tr>
            <tr>
                <td>注册号：</td>
                <td><input type="text" name="reg_num"></td>
            </tr>
            <tr>
                <td>营业执照：</td>
                <td><input type="file" name="permit"></td>
            </tr>
            <tr>
                <td><input type="submit" value="注册" ></td>
            </tr>
        </form>
    </table>
</body>
</html>