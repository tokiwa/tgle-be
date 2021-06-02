<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>submit</title>
</head>
<body >
<p id="p1"></p>
<p id="p2"></p>
<p id="p3"></p>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function() {
        $("#button1").click(function() {
            var json1 = {
                "bangou": "10",
                "name": "鈴木"
            };
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({
                url:"http://localhost:8000/test1",
                type:"post",
                contentType: "application/json",
                data:JSON.stringify(json1),
                dataType:"json",
            }).done(function(data1,textStatus,jqXHR) {
                $("#p1").text(jqXHR.status); //例：200
                console.log(data1.code); //1
                console.log(data1.name); //eigyou
                $("#p2").text(JSON.stringify(data1));
            }).fail(function(jqXHR, textStatus, errorThrown){
                $("#p1").text("err:"+jqXHR.status); //例：404
                $("#p2").text(textStatus); //例：error
                $("#p3").text(errorThrown); //例：NOT FOUND
            }).always(function(){
            });
        });
    });
</script>
<input type="button" value="ajaxで送信" id="button1">
</html>
