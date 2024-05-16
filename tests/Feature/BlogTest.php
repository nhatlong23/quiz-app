<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Models\Blog;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    // public function testCreateBlog()
    // {
    //     $data = [
    //         'title' => 'Blog 1',
    //         'content' => 'Blog 1 content',
    //         'slug' => 'blog-1',
    //         'images' => 'default.jpg',
    //         'status' => 1,
    //     ];

    //     $response = $this->post('/blogs', $data);

    //     $this->assertDatabaseHas('blogs', [
    //         'title' => 'Blog 1',
    //         'slug' => 'blog-1',
    //         'images' => 'default.jpg',
    //         'content' => 'Blog 1 content',
    //         'status' => 1,
    //     ]);

    //     Session::flash('success', 'Thêm blog thành công');
    //     $response->assertRedirect(route('blogs.index'));
    // }

    public function testUpdateBlog()
    {
        $blog = Blog::factory()->create();

        $data = [
            'title' => 'Blog 2',
            'content' => 'Blog 2 content',
            'slug' => 'blog-2',
            'images' => 'default.jpg',
            'status' => 0,
        ];

        $response = $this->patch('/blogs/' . $blog->id, $data);

        $this->assertDatabaseHas('blogs', [
            'title' => 'Blog 2',
            'content' => 'Blog 2 content',
            'images' => 'default.jpg',
            'slug' => 'blog-2',
        ]);

        Session::flash('success', 'Cập nhật blog thành công');
        $response->assertRedirect(route('blogs.index'));
    }

    public function testDeleteBlog()
    {
        $blog = Blog::factory()->create([
            'images' => 'default.jpg',
        ]);
        $response = $this->delete('/blogs/' . $blog->id);

        $this->assertDatabaseMissing('blogs', [
            'id' => $blog->id,
        ]);

        Session::flash('success', 'Xóa blog thành công');
        $response->assertRedirect(route('blogs.index'));
    }
}
