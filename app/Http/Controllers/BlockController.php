<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blocks_list = Block::orderBy('id', 'desc')->get();
        return view('admin.blocks.index', compact('blocks_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blocks.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'name' => 'required|unique:class|max:100',
                'desc' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên lớp học',
                'name.unique' => 'Tên lớp học đã tồn tại',
                'name.max' => 'Tên lớp học không được quá 100 ký tự',
                'desc.required' => 'Vui lòng nhập mô tả lớp học',
                'desc.max' => 'Mô tả lớp học không được quá 255 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái lớp học',
            ]
        );
        $blocks = new Block();
        $blocks->fill($validateData);
        $blocks->created_at = now('Asia/Ho_Chi_Minh');

        toastr()->success("Thêm thành công lớp học: $blocks->name");
        $blocks->save();
        return redirect()->route('blocks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blocks_list = Block::orderBy('id', 'DESC')->get();
        $blocks = Block::findOrFail($id);
        return view('admin.blocks.form', compact('blocks', 'blocks_list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate(
            [
                'name' => 'required|max:100',
                'desc' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên lớp học',
                'name.max' => 'Tên lớp học không được quá 100 ký tự',
                'desc.required' => 'Vui lòng nhập mô tả lớp học',
                'desc.max' => 'Mô tả lớp học không được quá 255 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái lớp học',
            ]
        );
        $blocks = Block::findOrFail($id);
        $fields = [
            'name' => 'Tên khối học',
            'desc' => 'Mô tả khối học',
            'status' => 'Trạng thái',
        ];

        foreach ($fields as $field => $label) {
            if ($blocks->$field != $validateData[$field]) {
                if ($field === 'status') {
                    $statusText = $validateData[$field] == 1 ? 'Hiển thị' : 'Ẩn';
                    toastr()->success("Thay đổi $label thành $statusText");
                } else {
                    toastr()->success("Thay đổi $label thành " . $validateData[$field]);
                }
            }
        }

        $blocks->fill($validateData);
        $blocks->updated_at = now('Asia/Ho_Chi_Minh');

        $blocks->save();
        return redirect()->route('blocks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $blocks = Block::findOrFail($id);
            $blocks_name = $blocks->name;
            $blocks->delete();
            toastr()->warning("Xóa thành công lớp học: $blocks_name");
        } catch (ModelNotFoundException $exception) {
            toastr()->warning("Không tìm thấy lớp học");
        }
        return redirect()->route('blocks.index');
    }

    public function updateStatusBlocks(Request $request)
    {
        $block = Block::findOrFail($request->id);
        $status = $request->checked ? 1 : 0;
        $block->status = $status;
        $block->updated_at = now('Asia/Ho_Chi_Minh');
        $block->save();
    
        return $status;
    }
}
