@extends('layouts.app')
@section('content')

  @foreach($data as $i)
  <div class="rounded p-2 mb-2" style="border:solid 1px #bbbbbb;">
    <div class="container">
        <div class="row pad-remove">
        <div class="col-lg-2 col-sm-5 col-6">
            <a href="/watch/{{$i->id}}"><img class="dis-img" src="{{asset('/movie_poster/'.$i->poster)}}" alt="{{$i->title}}"></a>
        </div>
        <div class="col-lg-10 col-sm-7 col-6 p-3">
            <div class="custom-h3">{{$i->title}} <b class="small text-muted">({{$i->date}})</b></div>
            <div class="genre-box kr-font">
                @php
                    $genres = explode(',',$i->genre);
                @endphp

                @foreach($genres as $g)
                <span>{{$g}}</span>
                @endforeach
           
            </div>
            
            @if($i->tagline)
            <div class="h6 text-muted mt-3 m-0 tagline-font">"{{$i->tagline}}"</div>
            @endif
            <div class="movie-overview ss-hide">
            {{$i->overview}}
            </div>
            <div>
            <a href="/watch/{{$i->id}}" class="btn btn-success mt-3 watch-btn"><i class="fa fa-play mr-1" aria-hidden="true"></i> Watch</a>
            </div>
        </div>
        </div>
    </div>
    </div>
  @endforeach
@endsection