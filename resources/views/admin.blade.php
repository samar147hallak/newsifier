@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
          <h2>My Articles</h2>
        </div>
        <div class="col-md-6" style="text-align: end;">
        <a class="btn btn-default" href="{{ route('add') }}">Add new article</a>
        </div>
    </div>
  
    <div class="row ">
         @if(count($data)==0)
            <div class="card">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <h5>There is no articles to show, Click 
                        <a  href="{{ route('add') }}">here</a> to add a new article.
                        </h5>
                       
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
                         at {{$article['created_at']}}
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
