<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Models\Block;

class BlockTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateBlock()
    {
        $data = [
            'name' => 'Block 1',
            'desc' => 'Block 1 description',
            'status' => 1,
        ];

        $response = $this->post('/blocks', $data);

        $this->assertDatabaseHas('blocks', [
            'name' => 'Block 1',
            'desc' => 'Block 1 description',
        ]);

        Session::flash('success', 'Thêm khối thành công');

        $response->assertRedirect(route('blocks.index'));
    }

    public function testUpdateBlock()
    {
        $block = Block::factory()->create();

        $data = [
            'name' => 'Block 2',
            'desc' => 'Block 2 description',
            'status' => 0,
        ];

        $response = $this->patch('/blocks/' . $block->id, $data);

        $this->assertDatabaseHas('blocks', [
            'name' => 'Block 2',
            'desc' => 'Block 2 description',
        ]);

        Session::flash('success', 'Cập nhật khối thành công');

        $response->assertRedirect(route('blocks.index'));
    }

    public function testDeleteBlock()
    {
        $block = Block::factory()->create();

        $response = $this->delete('/blocks/' . $block->id);

        $this->assertDatabaseMissing('blocks', [
            'id' => $block->id,
        ]);

        Session::flash('success', 'Xóa khối thành công');

        $response->assertRedirect(route('blocks.index'));
    }

}
