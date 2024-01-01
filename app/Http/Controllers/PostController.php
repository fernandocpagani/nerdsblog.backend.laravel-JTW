<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Post;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Routing\Controller as BaseController;

class PostController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function search(Request $request) {
        $search = $request->input('search');
        if($search){
            $posts = Post::with('user')->where('title', 'like', '%'.$search.'%')->orWhere('category', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->get();
        }else{
          $posts = Post::all();
        }
        return  response()->json($posts);  
    }

    public function showAllPosts(){
        return response()->json(Post::with('user')->orderBy("id", "desc")->get());
    }

    public function registerPost(Request $request){

        $this->validate($request, [
            'title' =>'required|max:100',
            'image' =>'required',
            'category' =>'required',
            'description' =>'required',           
            'reference' =>'required',           
            ]);

        $post = new Post;
        $post->title = $request->title;
        $post->image = $request->image;
        $post->category = $request->category;
        $post->description = $request->description;        
        $post->reference = $request->reference;        
        $post->user_id = $request->user_id;     

        $post->save();
        return response()->json($post);
    }

    public function showPost($id){
        return response()->json(Post::find($id));
    }

    public function updatePost($id, Request $request){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->image = $request->image;
        $post->category = $request->category;
        $post->description = $request->description;           
        $post->reference = $request->reference;           

        $post->save();

        return response()->json($post);
    }

    public function deletePost($id){
        $usuario = Post::find($id);
        $usuario->delete();
        return response()->json("deletado com sucesso", 200);
    }
}
