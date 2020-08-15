<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Article;


use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index ()
    {

        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::latest()->get();
        }

        
        //dd('$articleId');
        return view('articles.index', ['articles'=> $articles]);
    }

    public function show(Article $article)
    {
        //die("hello");
        //$article = Article::findorfail($id);
        //Article::where('id',1)->first();  -- This thing is implementing by (Article $article) this 
        return view('articles.show', ['article'=> $article]);
    }

    public function create()
    {
        //$tags = Tag::all();
        return view('articles.create', [
            'tags' => Tag::all()  
        ]);
    }

    /*public function store()
    {
        //persist the new article die('hello');
        //dump(request()->all());
        // security 
        // clean up 

        Article::create(request()->validate([
            'title'=> 'required',
            'excerpt'=> 'required',
            'body'=> 'required'

        ]));

        /*$article = new Article();
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();*/

        //Article::create($validatedAttributes);
        /*([
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body')
        // ]);

        return redirect('/articles');
    }*/
    public function store()
    {
        $this-> validateArticle();

        
        $article = new Article(request(['title','excerpt','body']));
        $article->user_id = 1;
        $article->save();
        $article->tags()->attach(request('tags'));
        return redirect(route('articles.index'));
        //auth()->user()->articles()->create($article);
        //return redirect('/articles');
        //dd(request()->all());
    }
    
    public function edit(Article $article)
    {
        //$article= Article::find($id);
        return view('articles.edit', compact('article'));
    }
    
    public function update(Article $article)
    {
        /*$article->update(request()->validate([
            'title'=> 'required',
            'excerpt'=> 'required',
            'body'=> 'required'

        ]));

        //$article = Article::find($id);

        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();*/
        $article->update($this->validateArticle());
        return redirect($article->path());
        //return redirect(route('articles.show', $article));
        //return redirect('/articles/'. $article->id);
    }

    protected function validateArticle()
    {
        return request()->validate([
            'title'=> 'required',
            'excerpt'=> 'required',
            'body'=> 'required',
            'tags'=> 'exists:tags,id'
        ]);
    }
    /*    
    
    public function destroy()
    {

    }
    */

}
