@extends('layouts/app')

@section('script')
<script type="text/javascript">
    $(function() {
        // 設定 1 秒後執行 getUpdate
        setTimeout(getUpdate, 1000);

        // 偵測 Form 送出事件
        $('#chat-form').submit(function(event) {
            setTimeout(getUpdate, 1000);
            // 阻止 Form 透過預設方法送出，阻止元素发生默认的行为（例如，当点击提交按钮时阻止对表单的提交）
            event.preventDefault();

            // 取得使用者輸入的 Message
            var message = $('#message').val();
            console.log(message);
            
            $.post('/chat', {
                'message': message    //新增 'message' 的變數，並把使用者輸入的message的值給他。
            }, function(resp) {
                console.log(resp);
            });

            // 清空使用者輸入框
            $('#message').val('');
            // 游標對焦
            $('#message').focus();
        });
    });

    function getUpdate() {
        // 取得所有聊天記錄
        $.get('/chat/all', {}, function(resp) {
            console.log(resp);
            var str = '';
            for( var index in resp ) {     //列舉所有resp裡面所有資料。        
                var chat = resp[index];
                str += chat.author + ': ' + chat.message + "\n";
            }
            $('#chat-disp').val(str);
        });
        // 設定 1 秒後再呼叫一次自己
        //setTimeout(getUpdate, 1000);
    }
</script>
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Chat Room</div>
            <div class="panel-body">
                <form id="chat-form">
                    <div class="form-group">
                        <textarea class="form-control" rows="10" id="chat-disp" readonly="true"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" id="message" class="form-control">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection