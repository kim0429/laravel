@extends('layouts.app')
@section('content')

  <div class="container">
      <div class="col-12 bg-white p-3 border">
            <div class="mb-3 mt-4">
            <i class="fa fa-pencil h5" aria-hidden="true"></i> 자유게시판
            <a href="{{route('post.freeboardPost')}}" class="btn btn-success p-1 float-right" style="font-size:12px;">
                <i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기
            </a>
            </div>
            {{-- {{$coms->commentable_id}} --}}
            {{-- {{dd($coms[1]->commentable_id)}} --}}
            
            
            
            <table class="w-100 mainboard">

                <thead class="headtable border-bottom border-top text-center">
                        <tr>
                            <td width='55'>번호</td>
                            <td width='120'>닉네임</td>
                            <td>제목</td>
                            <td width='100'>날짜</td>
                            <td width='55'>조회</td>
                        </tr>
                </thead>
                <tbody class="bodytable">
                    @foreach ($notice as $n)
                    <tr class="border-bottom table-tr">
                        <td class="listno">
                            <span class="badge badge-pill badge-success">공지</span>
                        </td>
                        <td class="smtext text-center">
                            {{$n->user->nickname}}
                        </td>
                        <td class="table_title font-weight-bold">
                            <a href="notice/{{$n->id}}" style="color:#0c9c1d">{{$n->title}}</a>
                                @php
                                // counting comments
                                    $arr = array_column(json_decode($notice_coms, true), 'commentable_id');
                                    if(in_array($n->id,$arr)){
                                       $a =  array_count_values($arr);
                                        echo "&nbsp;<span class='list_memo_count_span'>[".$a[$n->id]."]</span>";
                                    }
                                @endphp
                            
                        </td>
                        <td class="smtext">{{$n->date}}</td>
                        <td class="smtext text-center">{{$n->view}}</td>
                    </tr>
                    @endforeach
                    @foreach($data as $i)
                    <tr class="border-bottom table-tr">
                        <td class="listno">{{$i->id}}</td>
                        <td class="smtext text-center">
                            {{$i->user->nickname}}
                        </td>
                        <td class="table_title">
                            <a href="freeboard/{{$i->id}}">{{$i->title}}</a>
                                @php
                                // counting comments
                                    $arr = array_column(json_decode($coms, true), 'commentable_id');
                                    if(in_array($i->id,$arr)){
                                       $a =  array_count_values($arr);
                                        echo "&nbsp;<span class='list_memo_count_span'>[".$a[$i->id]."]</span>";
                                    }
                                @endphp
                            
                        </td>
                        <td class="smtext">{{$i->date}}</td>
                        <td class="smtext text-center">{{$i->view}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{$data->links()}}
            </div>
      </div>
  </div>
@endsection