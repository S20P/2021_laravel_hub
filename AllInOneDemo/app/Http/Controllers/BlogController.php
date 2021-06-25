<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function all()
    {
        $blogs = Blog::withTrashed()->get();

        return response()->json($blogs, 200);

    }

    public function list()
    {
        return response()->json(Blog::all(), 200);
    }

    public function store(Request $request)
    {

        $store = [

            'title' => $request->post('title'),

            'content' => $request->post('content'),

            'author' => $request->post('author') ?? "Anonymous",

        ];

        $result = Blog::create($store);

        return response()->json($result, 200);
    }

    public function delete(int $id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();

        return response()->json(['deleted_at' => $blog->deleted_at], 200);

    }

    public function restore(int $id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);

        $blog->restore();

        return response()->json($blog, 200);
    }

    public function onlyTrashed()
    {
        $blog = Blog::onlyTrashed()->get();

        return response()->json($blog, 200);
    }
}
