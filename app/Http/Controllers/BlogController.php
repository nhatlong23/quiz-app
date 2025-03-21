<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class BlogController extends Controller
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
                'tags' => 'nullable',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'slug.required' => 'Vui lòng nhập slug',
                'content.required' => 'Vui lòng nhập nội dung',
                'image.mimes' => 'Hình ảnh không đúng định dạng',
                'image.max' => 'Hình ảnh không quá 10MB',
            ]
        );

        $users_id = auth()->user()->id;
        $tags = $request->tags;

        $blog = new Blog();
        $blog->fill($validateData);
        $blog->users_id = $users_id;
        $blog->tags = $tags;
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

        toastr()->success("Thêm thành công blog: $blog->title và chờ duyệt từ admin");
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
                'tags' => 'nullable',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'slug.required' => 'Vui lòng nhập slug',
                'content.required' => 'Vui lòng nhập nội dung',
                'image.mimes' => 'Hình ảnh không đúng định dạng',
                'image.max' => 'Hình ảnh không quá 10MB',
                'status.required' => 'Vui lòng chọn trạng thái',
            ]
        );

        $blog = Blog::findOrFail($id);
        $blog->fill($validateData);
        $blog->tags = $request->tags;
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

    public function review_comment()
    {
        $comment_list = Comment::with('blog')->orderBy('id', 'desc')->get();
        return view('admin.blogs.comment', compact('comment_list'));
    }

    public function updateStatusComments(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        $status = $request->checked ? 1 : 0;
        $comment->status = $status;
        $comment->updated_at = now('Asia/Ho_Chi_Minh');
        $comment->save();

        return $comment;
    }

    public function reply_comment(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->content = $data['content_reply'];
        $comment->blogs_id = $data['blog_id_reply'];
        $comment->parent_comment_id = $data['parent_comment_id'];
        $comment->status = 1;
        $comment->name = auth()->user()->name;
        $comment->email = auth()->user()->email;
        $comment->updated_at = now('Asia/Ho_Chi_Minh');
        $comment->save();

        return redirect()->back();
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
