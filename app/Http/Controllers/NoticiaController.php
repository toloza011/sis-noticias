<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Error\Notice;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::orderBy('created_at','desc')->get();
        return view('home',compact('noticias'));
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $noticia = new Noticia();
        $noticia->titulo = $request->titulo;
        $noticia->subtitulo = $request->subtitulo;

        $noticia->contenido = $request->contenido;
        
        if($request->hasFile('portada')){
            $portada = $request->file('portada');
            $imageName = time().'.'.$portada->extension(); 
        
            $imagenPath = $portada->move(public_path('noticias\portadas'),$imageName); 
    
            $noticia->portada = $imageName;
        }else{
            $noticia->portada = null;
        }
        
       

        $noticia->user_id = Auth::user()->id;

        $noticia->save();

        return redirect()->route('noticia.index')->with('notice_success','Noticia publicada exitosamente!');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = Noticia::find($id);
        return view('noticias.show',compact('noticia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia = Noticia::find($id);

        return view('noticias.edit',compact('noticia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $noticia = Noticia::find($id);
        if($request->file('portada')){
            $portada = $request->file('portada');
        
            $imageName = time().'.'.$portada->extension(); 
            
            $imagenPath = $portada->move(public_path('noticias\portadas'),$imageName); 
    
            $noticia->portada = $imageName;
        }
        $noticia->update([
            'titulo' => $request->titulo,
            'subtitulo' => $request->subtitulo,
            'contenido' => $request->contenido
        ]);
        return redirect()->route('noticia.index')->with('notice_success','Noticia actualizada exitosamente!');

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id)->delete();
        return response()->json([
            'message' => 'Noticia eliminada exitosamente',
            'status' => 200
        ]);
    }

    
}
