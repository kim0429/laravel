@extends('layouts.app')
@section('content')
<script>
    function del_post(id){
        var r = confirm("게시물을 삭제하시겠습니까?");
        if (r == true) {
            window.location.href = "del/"+id;
        } 
    }
    
</script>
<div class="bg-white border p-3">
    <div class="h2 mb-3">
        공지
    </div>
    <div class="pb-2 view_title font-weight-bold">
        {{$id->title}}
    </div>
    <div class="smtext border-bottom pb-1">
        <span>
            {{-- {{dd($id)}} --}}
        <img class="icon_view rounded-circle mr-1" src="{{asset('avatar').'/'.$id->user->avatar}}" alt="{{$id->user->nickname}}"> 
        {{-- {{$user::find($id->user_id)->nickname}} --}}
        <b>{{$id->user->nickname}}</b>
        </span>
        <span class="tb_spr">l</span>
        조회수 {{$id->view}}
        <span class="tb_spr">l</span>
        {{$id->date}}
    
    </div>
    
    <div class="p-2 mt-3 view-content" style="min-height:200px;background:#f5f5f5">
        {!! $id->content !!}
    </div>
    
    @if ($id->user_id == Auth::id())
        <div class="mt-2">
            <a class="badge badge-secondary p-1 mr-1 badge-success badge-cursor" href="/notice/edit/{{$id->id}}">수정</a>
            <a class="badge badge-secondary p-1 badge-success badge-cursor" onclick="del_post({{$id->id}})">삭제</a>
        </div>
    @endif
    </div>
    <div>
        @comments([
                'model' => $id,
                'maxIndentationLevel' => 1
            ])
    </div>
@endsection