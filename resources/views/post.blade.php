@extends('layouts.web.app')
@section('content')

<div class="container">
    <div class="col-md-9">
        <div class="panel panel-default">
                <div class="col-md-12">
                        <div class="col-md-6 panel-heading">
                            <img width="50px" class="img-responsive pull-left" src="/upload/user.png" alt="">
                            <div class="col-md-6">publicado el {{date('d-m-y', strtotime($articulo->created_at))}} </div>
                            <div class="col-md-6"> por {{$articulo->user->username}}</div> 
                        </div>
                </div>
                <div class="panel">
            <div class="jumbotron whitefont col-md-12" style="background: url('{{asset($articulo->imageurl)}}') no-repeat center center;">
                <div class="container">
                    <div class="col-md-12">
                        <h2>{{$articulo->name}}</h2>
                    </div>
                    <div class="col-md-12">
                        <h4>{{$articulo->excerpt}}</h4>
                    </div>
                </div>
            </div>
            </div>
                    
            <div class="panel panel-body">
                {!!$articulo->body!!}
                <input type="hidden" id="post_id" value="{{$articulo->id}}">
            </div>
        </div>     
    </div>
    <div class="panel panel-default col-md-3">
        <h3 class="">Tambien puede interesarte</h3>
            @foreach($similarpost as $similar)
                <div class=" panel col-md-12"> 
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel panel-body">
                                <h4>{{str_limit($similar->name, 30)}}</h4>
                                    @if($similar->imageurl)
                                        <img class="rbarresize" width="200px" class=" img-responsive media-object" src="{{asset($similar->imageurl)}}"  alt="">
                                    @endif
                                    <p>{!! str_limit($similar->excerpt, 80)!!}</p>
                                    <div>
                                    <p><a href="#" class="btn btn-primary pull-right" role="button">Ver Noticia</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>  
            @endforeach
    </div>
    <div class="panel panel-default col-md-12">
        <h3 class="">Tambien puede interesarte</h3>
            @foreach($similarpost as $similar)
                <div class=" panel col-md-6"> 
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <div class="panel panel-body">
                            <h4>{{str_limit($similar->name, 30)}}</h4>
                                @if($similar->imageurl)
                                    <img class="rbarresize" width="200px" class=" img-responsive media-object" src="{{asset($similar->imageurl)}}"  alt="">
                                @endif
                                <p>{!! str_limit($similar->excerpt, 80)!!}</p>
                                <div>
                                <p><a href="#" class="btn btn-primary pull-right" role="button">Ver Noticia</a>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>  
            @endforeach
    </div>    
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> 
            <i class="fas fa-user" style="color: #04B486;"></i> Comentanos:</h3>
                <div class="panel-body">
                    <form id="frm-comment" action="/comments" method="post" style="display: block;">   
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" id="name" placeholder="Escribe tu nombre" class="form-control">
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" id="email" placeholder="Correo electronico" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="body" id="body" rows="5" placeholder="Escribe tu comentario..." class="form-control"></textarea>   
                                <input type="hidden" name="post_id" id="post_id" value="{{$articulo->id}}">
                                    <br>
                                    <input align="right" style="width:100px; height:40px" type="submit" class="btn btn-success form-control" value="Publicar" align="right" width="48" height="48" />
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div> 
         
<div class="col-md-12">
    <h1 class="cinzelfont whitefont"><i class="fas fa-comment" style="color: #04B486;"></i> Comentarios </h1>
        <div class="comments">
            <ul id="listComments" class="list-group ">
                        
            </ul>
        </div>
</div>

@endsection
@section('script')
	<script type="text/javascript">
			
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        $(document).ready(function(){
            var postId = $("#post_id").val();
            listarComentarios(postId);
        });

        function listarComentarios( _id ){
            $("#listComments").empty();
            $.ajax({
                url: '../get-comments/',
                type: 'GET',
                data: { id: _id },
                success: function(response)
                { 
                    if(response.length > 0 ){
                        $.each(response, function(i, value){
                            var elemento = $('<li class=" col-md-offset-2 col-md-10 list-group-item"'+
                                            '<div class=" col-md-10">'+
                                            '<div class="col-md-2">'+
                                            '<img width="100px" class="img-responsive center-block" src="https://cdn.dribbble.com/users/124355/screenshots/2199042/profile_1x.png" alt="">'+
                                            '<p class="text-center">'+ value.name +'</p>'+
                                            '</div>'+
                                            '<div class="panel panel-primary col-md-10">'+
                                            '<h4>'+ value.body +'</h4>'+
                                            '</div>'+
                                            '</div>'+
                                            '</li>');
                                            $("#listComments").append(elemento);
                             
                                                            });


                                            }

                else{

                        $.ajax({
                        url: '../get-comments/',
                        type: 'GET',
                        data: { id: _id },
                        success: function()
                        {
                        var elemento = $('<li class=" col-md-offset-2 col-md-10 list-group-item"'+
                                        '<div class="panel panel-primary col-md-12">'+
                                        '<h4 class="text-center">Esta noticia no tiene comentarios, se el primero en dejar el tuyo. </h4>'+    
                                        '</div>'+
                                        '</li>');
                                        $("#listComments").append(elemento);
                            
                                                    
                        

                        }
                                });     


                    }


                   
                    
                }
            });           
                

                                        }

        $('#frm-comment').on('submit', function(e){
            e.preventDefault();
            var data 	= $(this).serialize();
            var url 	= $(this).attr('action');
            var post 	= $(this).attr('method');
            var postId  = $("#post_id").val();
            console.log(data);
            $.ajax({
                type 	: post,
                url 	: url,
                data 	: data,
                dataType: 'json',
                success:function(data)
                { 
            console.log(data);                    
                    $("#name").val("");
                    $("#email").val("");
                    $("#body").val("");
                    listarComentarios(postId);
                }
            });
        });

	</script>
@endsection       