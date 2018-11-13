@extends('layouts/app')

@section('script')
<script>
var post_id = {{ $id }};
    $.getJSON('/api/posts/'+ post_id ,function(data){
        console.log(data);
        $('#title').append(data.title);
        $('#body').append('<h3 style="color:Blue">Author : </h3>' + data.author + '<br>','<h3 style="color:Blue">Note : </h3>'+ data.note);
        $('#body').append('<hr>' + data.created_at);
        
    })
</script>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 id ="title" style="color:red"></h1>
                    </div>

                    <div class="panel-body" id="body">
                    </div>
            </div>
        </div>
    </div>

@endsection