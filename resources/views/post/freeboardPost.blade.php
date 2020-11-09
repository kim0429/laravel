@extends('layouts.app')
@section('content')
<div class="h3 mt-3 kr-font mb-4">
    자유게시판
</div>

<div>
    <form method="POST" action="{{route('post.freeboardPosting')}}" >
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="제목" required>
        </div>
        <div class="form-group">
            <textarea class="form-control" id="content" name="content" required></textarea>
      
        </div>
        <div>
            <button type="submit" class="btn btn-success font-weight-bold">게시물 등록</button>
        </div>
    </form>
</div>


<script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace( 'content',{
    filebrowserUploadUrl: "{{route('post.upload_image', ['_token' => csrf_token() ])}}",
    filebrowserBrowseUrl: "{{asset('uplodate_post')}}",
    filebrowserUploadMethod: 'form',
    disallowedContent: 'img{width,height};'
});
</script>

@endsection