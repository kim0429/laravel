@extends('layouts.app')
@section('content')
<div class="h3 mt-3 kr-font mb-4">
    공지 수정
</div>

<div>
    <form method="POST" action="{{route('notice.edit.noticeEditing')}}" >
        @csrf
        <input type="hidden" name="post_id" value="{{$a->id}}">
        <div class="form-group">
        <input type="text" class="form-control" name="title" placeholder="제목" value="{{$a->title}}" required>
        </div>
        <div class="form-group">
         <textarea class="form-control" id="content" name="content" required>{{$a->content}}</textarea>
      
        </div>
        <div>
            <button type="submit" class="btn btn-success font-weight-bold">공지 수정</button>
        </div>
    </form>
</div>


<script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace( 'content',{
    filebrowserUploadUrl: "{{route('post.upload_image', ['_token' => csrf_token() ])}}",
    filebrowserBrowseUrl: "{{asset('uplodate_post')}}",
    filebrowserUploadMethod: 'form'
});
</script>


@endsection