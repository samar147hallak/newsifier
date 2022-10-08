@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Articles</h2>
    <div class="row">
        
        <div class="col-md-12" style="margin-bottom:10px">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                         <h3>{{$data['header']}}</h3>
                        </div>
                        <div class="col-sm-6" style="text-align: end;">
                        by: {{$data->user_name}} - at {{$data->created_at}}
                        </div>
                    </div>
                   
                   
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($data['txt']->blocks as $block)
                            <div class="col-md-12">
                                @if($block->type == 'paragraph')
                                   <p>{{$block->data->text}}</p>
                               @elseif($block->type == 'gif')
                               <div class="simple-image {{ $block->data->withBorder == true ? 'withBorder' : ''}} {{ $block->data->withBackground == true ? 'withBackground' : ''}} {{ $block->data->stretched == true ? 'stretched' : ''}}">
                                   <img src="{{$block->data->url}}" alt="{{$block->data->caption}}" />
                                </div>
                                @endif
                            </div>
                        @endforeach      
                    </div>

                </div>
            </div>
        </div>
      
        
    </div>
</div>
@endsection
