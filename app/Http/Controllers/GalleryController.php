<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request['query'];
        $page = $request['page'];

        $galleries = Gallery::with('user', 'images')
                                ->whereHas('user', function($galleries) use ($searchTerm) {
                                    $galleries->where('title', 'like', '%'.$searchTerm.'%')
                                        ->orWhere('description', 'like', '%'.$searchTerm.'%')
                                        ->orWhere('first_name', 'like', '%'.$searchTerm.'%')
                                        ->orWhere('last_name', 'like', '%'.$searchTerm.'%');                                    ;
                                })
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);
               

        return response()->json($galleries);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $gallery = Gallery::with('user', 'images', 'comments.user')->findOrFail($gallery->id);

        return response()->json($gallery);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }

    public function galleriesByUserId($id)
    {
        $galleries = Gallery::with('user', 'images')
            ->where('user_id', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        //return response()->json($galleries);
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    }
}
