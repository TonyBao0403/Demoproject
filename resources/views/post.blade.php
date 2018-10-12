@extends('layouts/app')

@section('script')
<script>
    $.getJSON('/api/posts/',function(data){
        for(var index in data){
            var obj = data[index];
            $('#tbody').append( '<tr><td>' + obj.id + '</td><td><a href=" /posts/'+ obj.id + '">'+ obj.title + '</a></td></tr>');
        }
        
    })
</script>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
        <h1>All My List</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    
                </tbody>
            </table>
        </div>
    </div>

@endsection