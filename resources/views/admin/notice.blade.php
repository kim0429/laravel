@extends('layouts.admin_template')
@section('content')
<div class="h3">
공지 업로드
</div>
<form method="POST" action="{{route('admin.board_notice_upload')}}">
    @csrf
    <div>
        <input type="text" name="title" class="form-control" placeholder="제목">
    </div>
    <div class="pt-3">
        <textarea name="content" id="notice_content"></textarea>
    </div>
    <div class="pt-2">
        <input type="submit" class="btn btn-success font-weight-bold" value="공지 등록">
    </div>
</form>
<div>
    <table border=1 class="mt-3 w-100">
        <tr>
            <td>id</td>
            <td>제목</td>
        </tr>
        
        @foreach ($a as $i)
            <tr>
                <td>{{$i->id}}</td>
                <td><a href="notice/{{$i->id}}">{{$i->title}}</a></td>
            </tr>
        @endforeach
    </table>
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