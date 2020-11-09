@extends('layouts/admin_template')
@section('content')

  <div class="container">
      <div class="row">
        
        <div class="col-3 p-0">
            <div class="card text-white bg-primary m-1 col-xs-3">
                <div class="card-header h5 text-center">오늘 방문자</div>
                <div class="card-body h5 text-center">
                {{number_format($today_visit)}}
                </div>
            </div>
        </div>
        <div class="col-3 p-0">
            <div class="card text-white bg-success  m-1 col-xs-3">
                <div class="card-header h5 text-center">전체 방문자</div>
                <div class="card-body h5 text-center">
                {{number_format($total_visit)}}
                </div>
            </div>
        </div>
        <div class="col-3 p-0">
            <div class="card text-white bg-danger  m-1 col-xs-3">
                <div class="card-header h5 text-center">영화</div>
                <div class="card-body h5 text-center">
                {{number_format($total_movie)}}
                </div>
            </div>
        </div>
        <div class="col-3 p-0">
            <div class="card text-white bg-info  m-1 col-xs-3">
                <div class="card-header h5 text-center">회원수</div>
                <div class="card-body h5 text-center">
                {{number_format($total_user)}}
                </div>
            </div>
        </div>
        <div class="col-3 p-0">
            <div class="card text-white bg-dark m-1 col-xs-3">
                <div class="card-header h5 text-center">오늘 가입자</div>
                <div class="card-body h5 text-center">
                {{number_format($new_user)}}
                </div>
            </div>
        </div>
        <div class="col-3 p-0">
            <div class="card text-white bg-primary  m-1 col-xs-3">
                <div class="card-header h5 text-center">전제 게시물</div>
                <div class="card-body h5 text-center">
                {{number_format($total_post)}}
                </div>
            </div>
        </div>
        <div class="col-3 p-0">
            <div class="card text-white bg-primary  m-1 col-xs-3">
                <div class="card-header h5 text-center">전제 댓글</div>
                <div class="card-body h5 text-center">
                {{number_format($total_comment)}}
                </div>
            </div>
        </div>
        
        
        
      </div>
  </div>
@endsection