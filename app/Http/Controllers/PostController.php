<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Validator;

use App\Models\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'post_author' => 'required',
            'post_content' => 'required',
        ]);
        
        if ($validator->fails()) {
            # Bad request，請求驗證失敗
            return response()->json(['status' => 1, 'message' => ''], 400);
        }

        // $post = new Post;
        // $post->post_author = $request->post_author;
        // $post->post_content = $request->post_content;

        // $post->save();

        return response()->json(['status' => 0, 'message' => ''], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if ($post) {
           return response()->json(['status' => 0, 'message' => '' , 'data' => $post], 200);
        } else {
            # 404：Not found，請求資源不存在
            return response()->json(['status' => 1, 'message' => 'Not found' ], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        # 403：Forbidden，用戶認證通過但是沒有權限執行該操作
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # 403：Forbidden，用戶認證通過但是沒有權限執行該操作
    }
}
