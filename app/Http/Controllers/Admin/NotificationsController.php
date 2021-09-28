<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\ApplyNotification;
use DataTables;
use File, DB;
use App\User;

class NotificationsController extends Controller
{
    protected function module(){
        return [
            'name' => 'Thông báo',
            'module' => 'notifications',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh',
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tiêu đề',
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
            'title' => 'required',
            'title_en' => 'required',
            'content' => 'required',
            'content_en' => 'required',
        ];
    }


    protected function messages()
    {
        return [
            'title.required' => 'Tiêu đề tiếng việt không được bỏ trống.',
            'title_en.required' => 'Tiêu đề tiếng anh không được bỏ trống.',
            'content.required' => 'Nội dung tiếng việt không được bỏ trống.',
            'content_en.required' => 'Nội dung tiếng anh không được bỏ trống.',
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
            $list_notifications = Notifications::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_notifications)
                    ->addColumn('checkbox', function ($data) {
                        return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                    })->addColumn('image', function ($data) {
                        return '<img src="' . $data->image . '" class="img-thumbnail" width="50px" height="50px">';
                    })->addColumn('name', function ($data) {
                        return '<p>Tiếng việt: ' . $data->title . '</p><p>Tiếng anh: ' . $data->title_en . '</p>';
                    })->addColumn('status', function ($data) {
                        if ($data->status == 1) {
                            $status = ' <span class="label label-success">Hiển thị</span>';
                        } else {
                            $status = ' <span class="label label-danger">Không hiển thị</span>';
                        }
                        return $status;
                    })->addColumn('action', function ($data) {
                        return '<a href="' . route('notifications.edit', ['id' => $data->id ]) . '" title="Sửa">
                                <i class="fa fa-pencil fa-fw"></i> Sửa
                            </a> &nbsp; &nbsp; &nbsp;
                                <a href="javascript:;" class="btn-destroy"
                                data-href="' . route('notifications.destroy', $data->id) . '"
                                data-toggle="modal" data-target="#confim">
                                <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                            ';
                    })->rawColumns(['checkbox', 'action', 'name', 'image', 'status'])
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

        $input = $request->all();
        $input['status'] = $request->status == 1 ? 1 : null;

        $notifications = Notifications::create($input);

        flash('Thêm mới thành công.')->success();

        return redirect()->route($this->module()['module'].'.edit', $notifications);
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
        $data['data'] = Notifications::findOrFail($id);
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

        $input = $request->all();
        $input['status'] = $request->status == 1 ? 1 : null;

        $notifications = Notifications::findOrFail($id)->update($input);

        flash('Cập nhật thành công.')->success();

        return redirect()->back();

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

        Notifications::destroy($id);

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Notifications::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function notification()
    {
        return view('backend.notifications.home');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function storeToken(Request $request)
    {
        // $data = ApplyNotification::where('device_token', $request->token)->first();

        // if (!empty($data)) {
        //     $data->device_token = $request->token;
        //     $data->save();
        // } else {
        //     ApplyNotification::create(['device_token'=>$request->token]);
        // }
        \Auth::user()->update(['device_token'=>$request->token]);

        return response()->json(['token saved successfully.']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendWebNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        // $FcmToken  = ApplyNotification::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAji9nYlg:APA91bHronCjH-lLDf5FWzroIwNW9Uy_zX2YfCbsL30BkGl18B8PgP1OuvEDx0JfXEBeZ34mPmMwB3XdgXG9FZtfGLzU1ifT7V2zcc6Znfn_q4R_DFKyf6cAxbxtbGyU21c1UZAWOSB3';

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->desc,
                'icon' => "https://img.icons8.com/bubbles/50/000000/user.png",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization:key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $result  = curl_exec($ch);

        if ($result  === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        curl_close($ch);

        dd($result );

        return redirect()->back();
    }

}
