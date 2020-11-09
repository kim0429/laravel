<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FreeboardModel;
use App\notice;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    //
    function __construct(){
        $this->middleware('admin');
    }
    function index(){
        //$today_view = Visitor::all()->get();
        // return $today_view; 
        $today_visit = DB::table('visitor')->whereDate('date', DB::raw('CURDATE()'))->count();
        $total_visit = DB::table('visitor')->count();
        $total_movie = DB::table('movie')->count();
        $total_user = DB::table('users')->count();
        $new_user = DB::table('users')->whereDate('created_at', DB::raw('CURDATE()'))->count();
        $total_post = DB::table('freeboard')->count();
        $total_comment = DB::table('comments')->count();
        // return dd($new_user);
        return view('admin.index',compact(
            'today_visit',
            'total_visit',
            'total_movie',
            'total_user',
            'new_user',
            'total_post',
            'total_comment'
        ));
    }
    function board_notice(){
        $a = notice::orderBy('id','DESC')->get();
        return view('admin.notice',compact('a'));
    }
    function board_notice_upload(Request $req){
        $validatedData = Validator::make($req->all(), [
            'title'=>'required|max:100',
            'content'=>'required'
        ]);
        if($validatedData->fails()){
            redirect()->back();
        }else{
            $notice = new notice;
            $notice->user_id = Auth::user()->id;
            $notice->title = $req->title;
            $notice->content = $req->content;
            $notice->save();
            $last_id = $notice->id;
            // return $last_id;
            return redirect('notice/'.$last_id);
        }
        
    }
}
