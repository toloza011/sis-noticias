@extends('layout')

@section('content')
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-md-10 mx-auto">
          <div class="site-heading">
            <div class="">
                <div class="card text-dark">
                    <div class="card-header text-dark text-center">
                       Crear Noticia
                    </div>
                    <div class="card-body">
                        <form action="{{route('noticia.update',$noticia->id)}}" enctype="multipart/form-data" class="text-left" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="titulo">Titulo</label>
                                <input type="text" class="form-control" value="{{$noticia->titulo}}" placeholder="Ingrese el titulo de la noticia..." name="titulo" id="titulo">
                            </div>
                            <div class="form-group">
                                <label for="titulo">Subtitulo</label>
                                <input type="text" class="form-control" value="{{$noticia->subtitulo}}" placeholder="Ingrese el subtitulo de la noticia..." name="subtitulo" id="subtitulo">
                            </div>
                            <div class="form-group">
                                <label for="portada">Actualizar portada</label>
                                <input type="file" class="form-control" name="portada" id="portada">
                            </div>
                            <div class="form-group">
                                <label for="contenido">Contenido</label>
                                <textarea class="form-control" id="contenido" name="contenido">{{$noticia->contenido }}</textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

@endsection

 @section('scripts')
 <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

 <script >
 CKEDITOR.replace( 'contenido', {
    filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    });
  
</script>


 @endsection


