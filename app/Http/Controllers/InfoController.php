<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class InfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = Info::first();
        return view('admin.infos.form', compact('infos'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Info $info)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'required' => 'Vui lòng nhập :attribute',
            'image' => ':Attribute phải là ảnh',
            'mimes' => ':Attribute phải là định dạng jpeg, png, jpg, gif, svg',
            'max' => ':Attribute không được quá :max KB',
        ]);
        $info->update($validatedData);
        if ($request->hasFile('logo')) {
            $uploadedImage = Cloudinary::upload($request->file('logo')->getRealPath(), [
                'folder' => 'quizz_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => pathinfo($request->file('logo')->getClientOriginalName(), PATHINFO_FILENAME),
            ]);
            $info->logo = $uploadedImage->getSecurePath();
        }

        if ($request->hasFile('favicon')) {
            $uploadedImage = Cloudinary::upload($request->file('favicon')->getRealPath(), [
                'folder' => 'quizz_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => pathinfo($request->file('favicon')->getClientOriginalName(), PATHINFO_FILENAME),
            ]);
            $info->favicon = $uploadedImage->getSecurePath();
        }
        $info->updated_at = now('Asia/Ho_Chi_Minh');
        $info->save();
        return redirect()->route('infos.index')->with('success', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        //
    }
}
