@extends('layouts/app')

@section('script')
<script>
$(function() {
    /*$(document).on('click', '.btn-add-cart', function() {
        var id = $(this).data('id');
        console.log(id + ' clicked');
        $.get('/products/add_cart/' + id, {}, function(resp) {
            if( resp.status ) {
                alert('加入購物車成功');
            }
        });
    });*/
    var btn;
    $(document).on('click','.btn-add-cart',function(){
        $id = $(this).data('id');
        $sum = $('input[name="'+ $id +'"]').val();
       if(isNaN($sum) || $sum== 0){
           alert("請輸入數字 或 輸入不可為0");
       }
       else{
        $.get('/products/add_cart/'+ $id + '/Num/' + $sum , {} , function(resp){
            if(resp.status){
                alert("加入購物車成功");
                //$('#' + $id + '').text("取消").css({'background-color':'red'});
                console.log('選取數量 : ' + $sum);
                console.log('產品編號 : ' + $id);
                console.log('取消產品 : ' + $id);
                //$('#btn-buy').show();
            }
            else{
                alert("請輸入數量!!!");
            }
            console.log(resp.arr_pro);
        }).fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Please input amount!!!');
        }) 
       }
       $('input[name="'+ $id +'"]').val(""); 
    })
    /*if(btn == 0){
        $('#btn-buy').show();
    }
    else {
        $('#btn-buy').hide();
    }*/
    $.getJSON('/api/products', function(resp) {
        for( var index in resp ) {
            var obj = resp[index];
            $('#tbody').append('<tr><td>' + obj.id + '</td><td>'+obj.name+'</td><td>'+obj.price+'</td>' + 
                                '<td><input type="text" name="' + obj.id + '" placeholder="輸入數量"></input>' + 
                                '<button id="'+ obj.id +'" data-id="'+ obj.id +'" class="btn btn-sm btn-primary btn-add-cart" style="margin-left:10px">加入購物車</button></td></tr>');
        }
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>All Products</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width:70px">#</th>
                    <th >商品名稱</th>
                    <th style="width:100px">
                        價格
                    </th>
                    <th style="width:300px ">加入購物車</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
        <a href="/cart" class="btn btn-primary" id="btn-buy">結帳</a>
        <!--<a href="/products/test/" class="btn btn-primary" id="btn-buy">新增產品</a>      新增刪除產品資料用-->
    </div>
</div>

@endsection