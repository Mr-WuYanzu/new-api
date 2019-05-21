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
<p id="p"></p>
<script>
    $.ajax({
        url:'http://api.reg.com/firm/list_do',
        dataType:'json',
        success:function(res){
            if(res.errno==60023){
                alert(res.msg);
                location.href='/reg';
            }else if(res.errno==60025){
                $('#p').text(res.msg);
            }else if(res.errno==0){
                $('#p').empty();
                var reg='<p>appid：'+res.data.data.appid+'</p><p>key：'+res.data.data.key+'</p>';
                $('body').append(reg);
                clearInterval(begin);
            }
        }
    })
    var begin;
    begin=setInterval(function(){
        $.ajax({
            url:'http://api.reg.com/firm/list_do',
            dataType:'json',
            success:function(res){
                if(res.errno==60023){
                    alert(res.msg);
                    location.href='/reg';
                }else if(res.errno==60025){
                    $('#p').text(res.msg);
                }else if(res.errno==0){
                    $('#p').empty();
                    var reg='<p>appid：'+res.data.data.appid+'</p><p>key：'+res.data.key+'</p>';
                    $('body').append(reg);
                    clearInterval(begin);
                }
            }
        })
    },3000);


</script>
</body>
</html>