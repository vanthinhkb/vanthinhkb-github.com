<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use App\Models\Order;
use App\Models\Logs;
use Carbon\Carbon;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->startdate){
            $stdf = $request->startdate;         
            $endf = $request->enddate;         
            $start_format = Carbon::parse($request->startdate);
            $start_format->format('Y-m-d');
            $end_format = Carbon::parse($request->enddate);
            $end_format->format('Y-m-d');
            $data = Account::where('status',1)->whereBetween('created_at', [$start_format, $end_format])->get();
            return view('backend.account.list', compact('data','stdf','endf'));
        }
        
        $data = Account::all();
        return view('backend.account.list', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::destroy($id);
        flash('Xóa thành công.')->success();
        return back();
    }

    public function lockMember($id){
        Account::find($id)->update(['status'=>1]);
        flash('Đã khóa thành công.')->success();
        return back();
    }

    public function unlocklockMember($id){
        Account::find($id)->update(['status'=>0]);
        flash('Mở khóa thành công.')->success();
        return back();
    }
    
    public function accountDetail($id) {
        $data = Account::find($id);
        return view('backend.account.detail', compact('data'));
    }
    
}
