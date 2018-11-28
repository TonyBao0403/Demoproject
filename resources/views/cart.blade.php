@extends('layouts/app')

@section('script')
<script>
$(function() {
    
    /*$(document).on('click','.btn-del',function(){
        var id = $(this).data('id');
        console.log(id);
        $.get('/products/add_cart/'+ id, {} , function(resp){
            if(resp.status){
                alert("加入購物車");
            }
        })
    })*/

    var sum=0;   //顯示總額
    var txt="";
    $(document).on('click','.btn-del',function(){
        $id = $(this).data('id');
        $name = $(this).data('name');
        console.log("刪除 " + $name);
        if(confirm("確定要刪除此商品 "+ $name +" 嗎???")){
            location.href = '/products/delete/' + $id;
        }
    });

    try{
        $.getJSON('/products/list_cart', function(resp) {
            for( var index in resp ) {
                var obj = resp[index];
                sum = sum + obj.price * obj.amount;
                console.log(sum);
                $('#tbody').append('<tr><td>' + obj.id + '</td><td>' + obj.name + '</td><td>' + obj.amount + '</td><td>'+ obj.price +'</td><td>'+ obj.price * obj.amount +'</td>' +  
                                    '<td><button id="'+ obj.id +'" data-id="'+ obj.id +'" data-name="'+ obj.name +'" class="btn btn-primary btn-del">刪除</button></td></tr>');
                
            }
            $('#sum').append(sum);
        });
    }
    catch(err){
        txt+="Error description: " + err.message + "\n\n";
        alert(txt);
    }
    
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>購物車</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>商品名稱</th>
                    <th>數量</th>
                    <th>單價</th>
                    <th>總額</th>
                    <th style="width:100px">刪除訂單</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
        <div >
            <h3 id="sum">商品金額總共 :  </h3>
        </div>
        <a href="/products" class="btn btn-danger">繼續購物</a>
    </div>
</div>

@endsection