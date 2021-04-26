@extends('layout')

@section('content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('{{asset('noticias/portadas/'.$noticia->portada)}}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$noticia->titulo}}</h1>
            <h2 class="subheading">{{$noticia->subtitulo}}</h2>
            <span class="meta">Publicado por
              <a href="#">{{$noticia->user->name}}</a>
              el {{$noticia->created_at}}</span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            {!!$noticia->contenido!!}
        </div>
      </div>
    </div>
  </article>

  <hr>

@endsection