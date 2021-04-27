@extends('layout')


@section('content')
 <!-- Page Header -->
 <header class="masthead" style="background-image: url('{{asset('noticias/portadas/'.$noticias->where('portada','<>','')->last()->portada)}}')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Ultimas Noticias</h1>
          <span class="subheading">Estas son las ultimas noticias</span>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($noticias as $noticia)  
        <div class="post-preview">
          <a href="{{route('noticia.show',$noticia->id)}}">
            <h2 class="post-title">
             {{$noticia->titulo}}
            </h2>
            <h3 class="post-subtitle">
             {{$noticia->subtitulo}}
            </h3>
          </a>
          <p class="post-meta">Publicado por
            <a href="#">{{$noticia->user->name}}</a>
            el {{$noticia->created_at}}</p>
        </div>
        <hr>
        @endforeach
     
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
  </div>
@endsection