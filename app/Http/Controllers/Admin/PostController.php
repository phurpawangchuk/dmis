<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePostRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('posts_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        //$queryBuilder = $queryBuilder->Where('email', 'like', '%' . $request['search'] . '%')
        $perPage = 10;  $page = 1;
        $posts = Post::where('author','=',auth()->id())->paginate($perPage);
        $currentpage = $posts->currentPage();
      
        if($currentpage > 1){ 
            $page = $perPage * ($currentpage - 1);
        }
        Session::put('pages',$page);
        return view('admin.posts.index',compact('posts','perPage'));
    }

    public function verify(Request $request)
    {
        abort_if(Gate::denies('post_verify'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $posts = Post::paginate(10)->appends($request->query());
        return view('admin.posts.verify',compact('posts'));
    }

    public function approve(Request $request)
    {
        abort_if(Gate::denies('post_approve'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $posts = Post::paginate(10)->appends($request->query());
        return view('admin.posts.approve',compact('posts'));
    }

     /* Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());
        
        return redirect()->route('admin.posts.index')->with(['status-success' => "New Post created successfully"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.posts.edit',compact('post'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->all());
       // $post->update(array_filter($request->validated()));
        return redirect()->route('admin.posts.index')->with(['status-success' => "Post Updated successfully"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $post->delete();
        return redirect()->back()->with(['status-success' => "Post Deleted successfully"]);
    }
}
