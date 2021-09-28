<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Recruitment;
use App\Models\Categories;
use App\Models\RecruitmentCategory;

class RecruitmentController extends Controller
{
    protected function module(){
        return [
            'name' => 'Tuyển dụng',
            'module' => 'recruitment',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tên tuyển dụng', 
                    'with' => '',
                ], 
                'category' => [
                    'title' => 'Danh mục', 
                    'with' => '',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '100px',
                ],
            ]
        ];
    }

    protected function fields()
    {
        return [
            'name' => 'required',
            'name_en' => 'required',
            'salary_from' => 'required',
            'image' => 'required',
        ];
    }


    protected function messages()
    {
        return [
            'name.required' => 'Tên tuyển dụng tiếng việt không được bỏ trống.',
            'name_en.required' => 'Tên tuyển dụng tiếng anh không được bỏ trống.',
            'salary_from.required' => 'Bạn chưa nhập mức lương.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho tuyển dụng.',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request) {
        if ($request->ajax()) {
            $list_recruitment = Recruitment::orderBy('created_at', 'DESC')->get();
        
            return Datatables::of($list_recruitment)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    $url = explode("/",url('/'));
                    $url = $url[0].'//'.$url[2];
                    return '<img src="' . $url.$data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('name', function ($data) {
                        return '<p>Tiếng việt: ' . $data->name . '</p><p>Tiếng anh: ' . $data->name_en . '</p>'
                        .'<a href="'.route('home.single-recruitment', $data->slug).'" target="_blank">'.route('home.single-recruitment', $data->slug).'</a>';
                })->addColumn('category', function ($data) {
                    $label = null;
                    if(count($data->category)){
                        foreach ($data->category as $item) {
                            $label = $label. '<span class="label label-success">'.$item->name.'</span><br>';
                        }
                    }
                    return $label;
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('recruitment.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('recruitment.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'category', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
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
        $data['categories'] = Categories::where('type', 'recruitment_category')->get();
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
        if (!empty($request->salary_to)) {
            if ($request->salary_from > $request->salary_to) {
                return redirect()->back()->withInput()->withErrors(['Mức lương sau không thể nhỏ hơn mức lương trước']);
            }
        }

        $input = $request->all();
        $input['slug'] = $this->createSlug(str_slug($request->name));
        $input['status'] = $request->status == 1 ? 1 : null;
        $input['office_area'] = $request->office_area;

        $recruitment = Recruitment::create($input);

        if(!empty($request->category)){
            foreach ($request->category as $item) {
                RecruitmentCategory::create(['id_category'=> $item, 'id_recruitment'=> $recruitment->id]);
            }
        }

        flash('Thêm mới thành công.')->success();

        return redirect()->route($this->module()['module'].'.index', $recruitment);
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
        $data['categories'] = Categories::where('type', 'recruitment_category')->get();
        $data['data'] = Recruitment::findOrFail($id);
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
        if (!empty($request->salary_to)) {
            if ($request->salary_from > $request->salary_to) {
                return redirect()->back()->withInput()->withErrors(['Mức lương sau không thể nhỏ hơn mức lương trước']);
            }
        }

        $input = $request->all();
        $input['status'] = $request->status == 1 ? 1 : null;
        $input['office_area'] = $request->office_area;
        $input['office_area_en'] = $request->office_area;

        $recruitment = Recruitment::find($id)->update($input);

        if(!empty($request->category)){
            RecruitmentCategory::where('id_recruitment', $id )->delete();
            foreach ($request->category as $item) {
                RecruitmentCategory::create(['id_category'=> $item, 'id_recruitment'=> $id]);
            }
        }

        flash('Cập nhật thành công.')->success();

        return redirect()->route($this->module()['module'].'.index', $recruitment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        flash('Xóa thành công.')->success();

        Recruitment::destroy($id);

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Recruitment::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }

    public function getAjaxSlug(Request $request)
    {
        $slug = str_slug($request->slug);
        $id = $request->id;
        $post = Recruitment::find($id);
        $post->slug = $this->createSlug($slug, $id);
        $post->save();
        return $this->createSlug($slug, $id);
    }

    public function createSlug($slugPost, $id = null)
    {
        $slug = $slugPost;
        $index = 1;
        $baseSlug = $slug;
        while ($this->checkIfExistedSlug($slug, $id)) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        return $slug;
    }


    public function checkIfExistedSlug($slug, $id = null)
    {
        if($id != null) {
            $count = Recruitment::where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Recruitment::where('slug', $slug)->count();
            return $count > 0;
        }
    }
}