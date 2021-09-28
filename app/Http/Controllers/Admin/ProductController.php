<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use App\Models\ProductCategory;
use DataTables;
use Carbon\Carbon;

class ProductController extends Controller
{
    protected function module(){
        return [
            'name' => 'Sản phẩm',
            'module' => 'products',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tên sản phẩm', 
                    'with' => '',
                ],
                'price' => [
                    'title' => 'Giá', 
                    'with' => '200px',
                ],
                'category' => [
                    'title' => 'Danh mục sản phẩm', 
                    'with' => '200px',
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
            'image' => 'required',
            'category' => 'required',
            // 'code' => 'unique:products,code,'.request()->code.',id,status,1',
        ];
    }


    protected function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm tiếng việt không được bỏ trống.',
            'name_en.required' => 'Tên sản phẩm tiếng anh không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho sản phẩm.',
            'category.required' => 'Bạn chưa chọn danh mục sản phẩm.',
            // 'code.unique' => 'Mã sản phẩm đã tồn tại',
        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $list_products = Products::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })
                ->addColumn('image', function ($data) {
                    $url = explode("/",url('/'));
                    $url = $url[0].'//'.$url[2];
                    return '<img src="' . $url . $data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })
                ->addColumn('name', function ($data) {
                    return '<p>Tiếng việt: ' . $data->name . '</p><p>Tiếng anh: ' . $data->name_en . '</p>'
                    .'<a href="'.route('home.SingleProduct', $data->slug).'" target="_blank">'.route('home.SingleProduct', $data->slug).'</a>';
                })
                ->addColumn('price', function ($data) {
                    return 'Giá bán: '. ($data->price != 0 ? number_format($data->price, 0, '.', '.').' đ' : $data->price);
                })
                ->addColumn('category', function ($data) {
                    $label = null;
                    if(count($data->category)){
                        foreach ($data->category as $item) {
                            $label = $label. '<span class="label label-success">'.$item->name.'</span><br>';
                        }
                    }
                    return $label;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    if ($data->hot) {
                        $status = $status . ' <span class="label label-primary">Sản phẩm nổi bật</span>';
                    }
                    if ($data->status_product) {
                        $status = $status . ' <span class="label label-warning">Sản phẩm còn hàng</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('products.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('products.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })
                ->rawColumns(['checkbox', 'image', 'status', 'action', 'name', 'category', 'price'])
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
        $data['categories'] = Categories::where('type', 'product_category')->get();
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
        if ($request->checkprice == 0) {
            if ($request->price == null) {
                return redirect()->back()->withInput()->withErrors(['Bạn chưa nhập giá bán.']);
            } elseif ($request->price <= 0) {
                return redirect()->back()->withInput()->withErrors(['Giá bán phải lớn hơn 0.']);
            }
        }
        $input = $request->all();
        $input['slug'] = $this->createSlug(str_slug($request->name));
        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;
        $input['status'] = $request->status == 1 ? 1 : null;
        $input['hot'] = $request->hot == 1 ? 1 : null;
        $input['status_product'] = $request->status_product == 1 ? 1 : null;
        if ($request->checkprice == 0 && !empty($request->price)) {
            $input['price'] = $request->price;
        } else {
            $input['price'] = $request->contact;
        }
        $input['checkprice'] = $request->checkprice == 1 ? 1 : 0;

        $product = Products::create($input);

        if(!empty($request->category)){
            foreach ($request->category as $item) {
                ProductCategory::create(['id_category'=> $item, 'id_product'=> $product->id]);
            }
        }

        flash('Thêm mới thành công.')->success();

        return redirect()->route($this->module()['module'].'.index', $product);
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
        $data['categories'] = Categories::where('type','product_category')->get();
        $data['data'] = Products::findOrFail($id);
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
        if ($request->checkprice == 0) {
            if ($request->price == null) {
                return redirect()->back()->withInput()->withErrors(['Bạn chưa nhập giá bán.']);
            } elseif ($request->price <= 0) {
                return redirect()->back()->withInput()->withErrors(['Giá bán phải lớn hơn 0.']);
            }
        }
        $input = $request->all();
        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;
        $input['status'] = $request->status == 1 ? 1 : null;
        $input['hot'] = $request->hot == 1 ? 1 : null;
        $input['status_product'] = $request->status_product == 1 ? 1 : null;
        if ($request->checkprice == 0 && !empty($request->price)) {
            $input['price'] = $request->price;
        } else {
            $input['price'] = $request->contact;
        }
        $input['checkprice'] = $request->checkprice == 1 ? 1 : 0;

        $product = Products::findOrFail($id)->update($input);

        if(!empty($request->category)){
            ProductCategory::where('id_product', $id )->delete();
            foreach ($request->category as $item) {
                ProductCategory::create(['id_category'=> $item, 'id_product'=> $id ]);
            }
        }

        flash('Cập nhật thành công.')->success();

        return redirect()->route($this->module()['module'].'.index', $product);

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

        Products::destroy($id);
        ProductCategory::where('id_product',$id)->delete();

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Products::destroy($id);
                ProductCategory::where('id_product',$id)->delete();
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
        $post = Products::find($id);
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
            $count = Products::where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Products::where('slug', $slug)->count();
            return $count > 0;
        }
    }
}
