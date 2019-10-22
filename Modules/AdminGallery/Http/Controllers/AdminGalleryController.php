<?php

namespace Modules\AdminGallery\Http\Controllers;

use App\Gallery;
use App\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Gallery::get();
        return view('admingallery::index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admingallery::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'gallery_name' => 'required',
            'description' => 'required'
        ];
        $request->validate($rules);
        $data = [
            'name' => $request->get('gallery_name'),
            'slug' => str_slug($request->get('gallery_name', '-')),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
        ];
        Gallery::insert($data);
        return redirect()->route('admingallery');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admingallery::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Gallery::where('id', $id)->first();
        return view('admingallery::edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'gallery_name' => 'required',
            'description' => 'required'
        ];
        $request->validate($rules);
        $data = [
            'name' => $request->get('gallery_name'),
            'slug' => str_slug($request->get('gallery_name', '-')),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
        ];
        Gallery::where('id', $id)->update($data);
        return redirect()->route('admingallery');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Gallery::where('id', $id)->delete();
        return redirect()->route('admingallery');
    }

    public function imagesIndex($id)
    {
        $data = Gallery::with('gallery_images')->where('id', $id)->get();
        return view('admingallery::image_index', compact('data'));
    }

    public function addImage($id)
    {
        return view('admingallery::add_image', compact('id'));
    }

    public function storeImages(Request $request, $id)
    {
        $request->validate(['image_caption' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);

        $data = [
            'caption' => $request->get('image_caption'),
            'gallery_id' => $request->get('id'),
        ];

        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $image) {
                $name = time() . '_' . str_random(5) . '_' . str_replace(' ', '_', $image->getClientOriginalName());
                $image->move(public_path() . '/images/', $name);
                $data['image'] = $name;
                GalleryImage::insert($data);
            }
        }
        return redirect()->route('admingallery');
    }

    public function deleteImage($id)
    {
        GalleryImage::where('id', $id)->delete();
        return redirect()->back();
    }

}
