@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Articles</h2>
    <div class="row">
         @if(count($data)==0)
            <div class="card">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <h5>There is no articles to show</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @foreach($data as $article)
        <div class="col-md-6" style="margin-bottom:10px">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                         <h3>{{$article['header']}}</h3>
                        </div>
                        <div class="col-sm-6" style="text-align: end;">
                        by: {{$article['user_name']}} - at {{$article['created_at']}}
                        </div>
                    </div>
                   
                   
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                           {{$article['txt']}}
                            <a href="/article/{{$article['id']}}">read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
@endsection
