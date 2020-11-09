@extends('layouts.app')
@section('content')

    <div class="mt-3"> <!--Center Content-->
      <div class="h1 mb-3 border-bottom p-2 font-weight-bold kr-font">{{$movie_data->title}}</div>
      <div class="watch-poster">
        <img src="{{asset('/movie_poster/'.$movie_data->poster)}}" alt="{{$movie_data->title}}">
        <div class="h5 text-muted mt-3 mb-3">
            @if($movie_data->tagline)
            <em>
            "{{$movie_data->tagline}}"
            </em>
            @endif
        </div>
      </div>
      <div class="mt-3 border-bottom p-2">

        <div class="genre-box pt-2 pb-2">
            @php
            $genres = explode(',',$movie_data->genre);
            @endphp

            @foreach($genres as $g)
            <span>{{$g}}</span>
            @endforeach
        </div>
        <div class="h3 mt-3">개요</div>
        <p>
            {{$movie_data->overview}}
        </p>

      </div>
      <div class="mt-3 mb-5 w-100" style="text-align:center">
        {{$movie_data->movie_link}}
      </div>
      <div>
        @comments([
            'model' => $movie_data,
            'maxIndentationLevel' => 1
        ])
      </div>
     
    </div>
    

@endsection