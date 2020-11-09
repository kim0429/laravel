@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        계정
    </div>
    <div class="card-body text-center">
        @php
            $user = Auth::user()
        @endphp
        <div>
        <img src="/avatar/{{$user->avatar}}" alt="..." class="img-thumbnail" style="max-height:250px">
        </div>
        <div class="mt-3 mb-5">
                <div class="m-3">
                    <a class="custom-link1 font-weight-bold" data-toggle="collapse" data-target="#profile_change" aria-expanded="false">
                        <i class="fa fa-pencil" aria-hidden="true"></i> 이미지 변경
                    </a>
                </div>
              <div class="collapse" id="profile_change">
 
                <div style="max-width:300px" class="mx-auto border rounded p-3 bg-light">
                    <label for="avatar" class="kr-font font-weight-bold">
                        프로필 사진 변경
                    </label>
                        <form method="POST" action="/profile" class="form-group" enctype="multipart/form-data">
                            @csrf
                        <input type="file" name="avatar" class="form-control-file border p-1 rounded @error('avatar') is-invalid @enderror" required>

                        <input type="submit" class="btn btn-sm btn-primary mt-3" value="이미지 변경">
                             @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                        </form>
                </div>
               
              </div>

            
            
        
        </div>
        <hr>
        <div class="text-left mt-3">
            <div class="h4 font-weight-bold kr-font p-2">
                회원 정보
            </div>
            <div>
                @if(session('profile_edit'))
                <script type="application/javascript" src="{{asset('js/success-update-profile.js')}}"></script>
                @endif
            <form action="profile_edit" method="POST">
                @csrf
                <table class="table">
                    <tbody>
                        <tr>
                            <td>아이디</td>
                            <td>{{$user->username}}</td>
                        </tr>
                        <tr>
                            <td>닉네임</td>
                            <td>{{$user->nickname}}</td>
                        </tr>
                    <tr>
                        <td>이름</td>
                        <td> 
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" required>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>이메일</td>
                        <td>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" required>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>가입 날짜</td>
                        <td>{{$user->created_at}}</td>
                    </tr>
                    </tbody>
                    </table>
                    <div class="form-group row mb-0">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                정보 수정
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <div class="card mt-3">
    <div class="card-header">
        비밀번호 변경
    </div>
    <div class="card-body">
    @if(session('success_pass_update'))
    <script type="application/javascript" src="{{asset('js/success-update-pass.js')}}"></script>
    @endif

    
    <form method="POST" action="update">
            @csrf 

             

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">현재 비밀번호</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current-password" required>
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">새로운 비밀번호</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">새로운 비밀번호 확인</label>

                <div class="col-md-6">
                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="current-password" required>
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        비밀번호 변경
                    </button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection