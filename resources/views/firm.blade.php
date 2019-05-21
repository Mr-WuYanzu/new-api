<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/app.js"></script>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<table border="1">

        <tr>
            <td>企业名称：</td>
            <td>税务号：</td>
            <td>合法人：</td>
            <td>对公账号：</td>
            <td>注册号：</td>
            <td>营业执照：</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->firm_name}}</td>
            <td>{{$v->tax_no}}</td>
            <td>{{$v->legal_person}}</td>
            <td>{{$v->pub_banknum}}</td>
            <td>{{$v->reg_num}}</td>
            <td><img src="/{{$v->permit}}" alt="" width="80" height="80"></td>
            <td uid="{{$v->id}}">
                <button class="t">通过</button>
                <button class="b">驳回</button>
            </td>
        </tr>
        @endforeach
</table>
{{ $data->links() }}
<script>
    $('.t').click(function(){
        var id=$(this).parent('td').attr('uid');
        $.ajax({
            url:'http://api.reg.com/admin/update?uid='+id,
            dataType:'json',
            success:function(res){
                if(res.errno==0){
                    alert(res.msg);
                        window.location.reload();

                }

            }
        })
    })
    $('.b').click(function(){
        var id=$(this).parent('td').attr('uid');
        $.ajax({
            url:'http://api.reg.com/admin/del?uid='+id,
            dataType:'json',
            success:function(res){
                if(res.errno==0){
                    alert('OK');
                    window.location.reload();
                }
            }
        })
    })
</script>
</body>
</html>