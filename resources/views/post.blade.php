@extends('layouts/app')

@section('script')
<script>

function getQueryParams(qs) {
    qs = qs.split('+').join(' ');

    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
    }

    return params;
}
var query = getQueryParams(document.location.search);

var page = '';
if(query.page != undefined){
    page = '?page=' + query.page;
}


$(function(){
    
    $.getJSON('/api/posts/' + page ,function(resp){
        for(var index in resp.data){
            var obj = resp.data[index];
            $('#tbody').append( '<tr><td>' + obj.id + '</td><td><a href=" /posts/'+ obj.id + '">'+ obj.title + '</a></td>' +
                                '<td><button data-id="'+ obj.id +'" class="btn btn-sm btn-primary btn-del">刪除</button></td></tr>');
        }
        
        if(resp.next_page_url == null && resp.prev_page_url == null){
            $('#btn-next').hide();
            $('#btn-pre').hide();
        }
        else{
            if(resp.next_page_url == null){
                $('#btn-next').hide();
                $('#btn-pre').attr('href',resp.prev_page_url.replace('api/',''));
            }
            else if(resp.prev_page_url == null){
                $('#btn-pre').hide();
                $('#btn-next').attr('href',resp.next_page_url.replace('api/',''));
            }
        }
        
    })
    
    $(document).on('click','.btn-del',function(){
        if(confirm('Delete'+ $(this).data('id'))){
            location.href = '/posts/delete/'+ $(this).data('id');
        }
    })
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
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    
                </tbody>
            </table>
            <a href="" class="btn btn-primary" id="btn-pre">Previous</a>
            <a href="" class="btn btn-primary" id="btn-next">Next</a>
        </div>



        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Post</div>

                <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/api/posts">
                        {{ csrf_field() }}  

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="title" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Note</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="note" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Author</label>

                            <div class="col-md-6">
                                <input id="email" type="integer" class="form-control" name="author" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection