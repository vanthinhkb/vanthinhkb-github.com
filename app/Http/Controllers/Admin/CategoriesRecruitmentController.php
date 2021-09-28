<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;


class CategoriesRecruitmentController extends Controller
{
    protected function fields()
    {
        return [
            'name' => "required",
            'name_en' => "required",
            'slug' => "required",
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề tiếng việt không được bỏ trống.', 
            'name_en.required' => 'Tiêu đề tiếng anh không được bỏ trống.', 
            'slug.required' => 'Đường dẫn tĩnh không được bỏ trống.',
        ];
    }


    protected function module(){
        return [
            'name' => 'Danh mục tuyển dụng',
            'module' => 'categories-recruitment',
            'table' =>[
                'name' => [
                    'title' => 'Tiêu đề', 
                    'with' => '',
                ],
                'slug' => [
                    'title' => 'Liên kết', 
                    'with' => '',
                ],
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['module'] = $this->module();
        $data['data'] = Categories::where('type', 'recruitment_category')->get();
        return view("backend.{$this->module()['module']}.list", $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['module'] = $this->module();
        $data['categories'] = Categories::where('type', 'post_category')->get();

        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->fields(), $this->messages());
        $post_check_sulg = Categories::where('slug', $request->slug)->where('type', 'recruitment_category')->first();
        if (!empty($post_check_sulg)) {
            return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);
        }
        $input = $request->all();
        $input['type'] = 'recruitment_category';

        $data = Categories::create($input);
        flash('Thêm mới thành công.')->success();
        return redirect()->route("{$this->module()['module']}.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);
        
        $data['data'] = Categories::findOrFail($id);
        return view("backend.{$this->module()['module']}.create-edit", $data);
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
        $this->validate($request, $this->fields(), $this->messages());
        $post_check_sulg = Categories::where('slug', $request->slug)->where('id', '!=', $id)->where('type', 'recruitment_category')->first();
        if (!empty($post_check_sulg)) {
            return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);
        }
        $input = $request->all();
        $input['type'] = 'recruitment_category';

        $data = Categories::findOrFail($id)->update($input);
        flash('Sửa thành công.')->success();
        return redirect()->route("{$this->module()['module']}.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::destroy($id);
        flash('Xóa thành công.')->success();
        return redirect()->back();
    }
}
