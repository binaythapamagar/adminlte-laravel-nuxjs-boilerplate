<?php

namespace Modules\AdminSettings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Utils\Options;

class AdminSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
         
        return view('adminsettings::config');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('adminsettings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    { 
        //
        $request->validate([
            'system_name'           => 'required',
            'system_slogan'         => 'required',
            'system_email'          => 'required',
            'system_feedback_email' => 'required',
            'system_telephone_no'   => 'required',
            'system_address'        => 'required',
            'system_mobile'         => 'required',
        ]);

        // site config data
        $siteconfig = [
            'system_name'    => $request->get('system_name'),
            'system_email'   => $request->get('system_email'),
            'system_slogan'  => $request->get('system_slogan'),
            'system_address' => $request->get('system_address'),

        ];

        Options::update('siteconfig', $siteconfig);
        Options::update('system_feedback_email', $request->get('system_feedback_email'));
        Options::update('system_telephone_no', $request->get('system_telephone_no'));
        Options::update('system_mobile', $request->get('system_mobile'));

        Options::update('system_address', $request->get('system_address')); 
        if ($request->hasFile('logo')) { 
            $image = $request->file('logo');
            $brand_image = time() . '-' . rand(111111, 999999) . '.' . $image->getClientOriginalExtension();

            $path = public_path() . "/uploads/config/";

            $image->move($path, $brand_image);
            Options::update('brand_image', $brand_image);
        }
        
        return redirect()->route('admin.settings');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function socialStore(Request $request)
    { 
        $validator = [
            'facebook_url'=>'required',
            'instagram_url'=>'required',
            'twitter_url'=>'required',
            'youtube_url'=>'required',
            'whatsapp_number'=>'required',
            'viber_number'=>'required'
        ];
 
        Options::update('facebook_url', $request->get('facebook_url'));
        Options::update('instagram_url', $request->get('instagram_url'));
        Options::update('twitter_url', $request->get('twitter_url'));
        Options::update('youtube_url', $request->get('youtube_url')); 
        Options::update('whatsapp_number', $request->get('whatsapp_number')); 
        Options::update('viber_number', $request->get('viber_number')); 

        return redirect()->route('admin.settings'); 
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('adminsettings::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
