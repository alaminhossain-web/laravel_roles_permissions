<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view articles', only: ['index']),
            new Middleware('permission:edit articles', only: ['edit']),
            new Middleware('permission:create articles', only: ['create']),
            new Middleware('permission:delete articles', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(25);
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:5',
            'author' => 'required|min:5'

        ]);
        if($validator->passes()){
            $article = new Article();

           
            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();

           
            toastr()->success('Article Created successfully!');
            return back();
            
        }else{
            return back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3'
        ]);
    
        $article = Article::findOrFail($id);
        $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();
    
        toastr()->warning('Article Updated successfully!');
    
        return redirect('/article');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        if($article == null)
        {
            return response()->json([
                'status' => false
            ]);
        }
        $article->delete();
        toastr()->error('Article Deleted successfully!');

        return response()->json([
            'status'=>true
        ]);
    }
}
