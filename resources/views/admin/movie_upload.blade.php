@extends('layouts/admin_template')
@section('content')

  <div class="container">
      <div class="row">
          <div class="col-12">
              <h2>영화 업로드</h2>
              <hr>
              <form action="{{route('upload_movie')}}" class="form-group" method="POST">
                @csrf
                <div><input name="id" class="form-control mb-2" type="text" placeholder="영화 아이디"></div>
                <div><input name="link" class="form-control mb-2" type="text" placeholder="동영상 링크"></div>
                <div><input type="submit" class="btn btn-primary" name="submit" value="업로드"></div>
              </form>
          </div>
      </div>
  </div>
@endsection