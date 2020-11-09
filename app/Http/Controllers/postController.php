<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\FreeboardModel;
use App\notice;
use App\CommentModel;
use Auth;
use App\User;
use Image;
use File;


class postController extends Controller
{

    public function freeboard(FreeboardModel $freeboard,CommentModel $com){
        $data = $freeboard::orderBy('id','DESC')->paginate(20);
        $notice = notice::orderBy('id','DESC')->get();
        $coms = $com::select('commentable_id')->where('commentable_type','App\FreeboardModel')->get();
        $notice_coms = $com::select('commentable_id')->where('commentable_type','App\notice')->get();
        // $users = $u::select('nickname','id')->get();
        //return dd($users);
        // return dd($data);
        return view('board.freeboard',compact('data','coms','notice','notice_coms'));
    }
    function freeboardView(FreeboardModel $id){
        // page view cookie
        $post_id =  $id->id;
        if(empty($_COOKIE['post_'.$post_id])){
            $board = new FreeboardModel;
            $board::where('id',$post_id)->increment('view');
            setcookie('post_' . $post_id, TRUE, time() + (60 * 60 * 24), '/');
        }
        // dd($user);
        return view('view',compact('id'));
    }
    public function freeboardPost(){
        return view('post.freeboardPost');
    }
    public function edit($id){
        //return $id;
        $post_id = new FreeboardModel;
        $a = $post_id->find($id);
        if($a->user_id == Auth::user()->id){
            return view('edit',compact('a'));
            
        }else{
             return redirect()->back();
         }

    }
    // edit post
    public function freeboardEditing(Request $id){
        $a = new FreeboardModel;
        $post_info = $a->find($id->post_id);
        if($post_info->user_id == Auth::user()->id){
            $a->where('id',$id->post_id)->update([
                'title'=>$id->title,
                'content'=>$id->content
            ]);
            return redirect('freeboard/'.$id->post_id);
        }else{
            return redirect()->back();
        }
        // return $id->post_id;
        
    }
    public function freeboardPosting(Request $req){
        $validatedData = Validator::make($req->all(), [
            'title'=>'required|max:100',
            'content'=>'required'
        ]);
        if($validatedData->fails()){
            redirect()->back();
        }else{
            $freeboard = new FreeboardModel;
            $freeboard->user_id = Auth::user()->id;
            $freeboard->title = $req->title;
            $freeboard->content = $req->content;
            $freeboard->save();
            $last_id = $freeboard->id;
            // return $last_id;
            return redirect('freeboard/'.$last_id);
        }
        
    }
    function upload_image(Request $req){
        $validatedImage = Validator::make($req->all(),[
            'upload'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($req->hasFile('upload')){
            
             $upload = $req->file('upload');
            $filename = time().'.'.$upload->extension();
        
            Image::make($upload)->resize(700,null,function($constraint){$constraint->aspectRatio();$constraint->upsize();})->save(public_path('/upload_post/'.$filename));
   
            $CKEditorFuncNum = $req->input('CKEditorFuncNum');
            $url = asset('upload_post/'.$filename); 
            $msg = '이미지 업로드 성공'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
    function del_post($id){
        $board = new FreeboardModel;
        $poster = $board->find($id);
        if($poster->user_id == Auth::user()->id){
            $poster->delete();
            return redirect('freeboard');
        }
    }
    function noticeView(notice $id){
        $notice_id =  $id->id;
        if(empty($_COOKIE['notice_'.$notice_id])){
            $notice = new notice;
            $notice::where('id',$notice_id)->increment('view');
            setcookie('notice_' . $notice_id, TRUE, time() + (60 * 60 * 24), '/');
        }
        return view('notice',compact('id'));
    }
    function noticeEdit($id){
        $post_id = new notice;
        $a = $post_id->find($id);
        if($a->user_id == Auth::user()->id){
            return view('notice_edit',compact('a'));
            
        }else{
             return redirect()->back();
         }
    }
    public function noticeEditing(Request $id){
        $a = new notice;
        $post_info = $a->find($id->post_id);
        if($post_info->user_id == Auth::user()->id){
            $a->where('id',$id->post_id)->update([
                'title'=>$id->title,
                'content'=>$id->content
            ]);
            return redirect('notice/'.$id->post_id);
        }else{
            return redirect()->back();
        }
    }
    function del_notice($id){
        $board = new notice;
        $poster = $board->find($id);
        if($poster->user_id == Auth::user()->id){
            $poster->delete();
            return redirect('freeboard');
        }
    }
}
