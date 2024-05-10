<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs_list = Blog::orderBy('id', 'desc')->get();
        return view('admin.blogs.index', compact('blogs_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'title' => 'required',
                'slug' => 'required',
                'content' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
                'status' => 'required|in:0,1',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'slug.required' => 'Vui lòng nhập slug',
                'content.required' => 'Vui lòng nhập nội dung',
                'image.mimes' => 'Hình ảnh không đúng định dạng',
                'image.max' => 'Hình ảnh không quá 10MB',
                'status.required' => 'Vui lòng chọn trạng thái',
                'status.in' => 'Trạng thái không hợp lệ',
            ]
        );

        $blog = new Blog();
        $blog->fill($validateData);
        $blog->created_at = now('Asia/Ho_Chi_Minh');

        if ($request->hasFile('images')) {
            $uploadedImage = Cloudinary::upload($request->file('images')->getRealPath(), [
                'folder' => 'quizz_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => pathinfo($request->file('images')->getClientOriginalName(), PATHINFO_FILENAME),
            ]);
            $blog->images = $uploadedImage->getSecurePath();
        }

        $blog->save();

        toastr()->success("Thêm thành công blog: $blog->title");
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $blogs = Blog::where('slug', $slug)->first();
        return view('admin.blogs.show', compact('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blogs_list = Blog::orderBy('id', 'desc')->get();
        $blogs = Blog::findOrFail($id);

        return view('admin.blogs.form', compact('blogs_list', 'blogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate(
            [
                'title' => 'required',
                'slug' => 'required',
                'content' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
                'status' => 'required|in:0,1',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'slug.required' => 'Vui lòng nhập slug',
                'content.required' => 'Vui lòng nhập nội dung',
                'image.mimes' => 'Hình ảnh không đúng định dạng',
                'image.max' => 'Hình ảnh không quá 10MB',
                'status.required' => 'Vui lòng chọn trạng thái',
                'status.in' => 'Trạng thái không hợp lệ',
            ]
        );

        $blog = Blog::findOrFail($id);
        $blog->fill($validateData);
        $blog->updated_at = now('Asia/Ho_Chi_Minh');

        if ($request->hasFile('images')) {
            $uploadedImage = Cloudinary::upload($request->file('images')->getRealPath(), [
                'folder' => 'quizz_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => pathinfo($request->file('images')->getClientOriginalName(), PATHINFO_FILENAME),
            ]);
            $blog->images = $uploadedImage->getSecurePath();
        }

        $blog->save();

        toastr()->success("Cập nhật thành công blog: $blog->title");
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        toastr()->success("Xóa thành công blog: $blog->title");
        return redirect()->route('blogs.index');
    }

    public function updateStatusBlogs(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $status = $request->checked ? 1 : 0;
        $blog->status = $status;
        $blog->updated_at = now('Asia/Ho_Chi_Minh');
        $blog->save();

        return $blog;
    }
}
