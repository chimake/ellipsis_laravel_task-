@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View Short Link Information') }} <a href="{{ route('short.update',$short_url_info->id) }}" class="btn btn-success float-end">Update Short Link</a></div>

                <div class="card-body">
                 
                        <div class="row">
                            <strong>Original URL:</strong> {{ $short_url_info->original_url}}
                            
                        </div>
                        <div class="row">
                            <strong>Short URL:</strong> {{ url($short_url_info->short_url) }}
                            
                        </div>
                        <div class="row">
                            <strong>Status:</strong>
                             @if ($short_url_info->status == true)
                                Active
                            @else
                            In-active
                            @endif

                            
                        </div>
                        <div class="row">
                            <strong>Expiry Date:</strong> {{ $short_url_info->expiry_date }}
                            
                        </div>
        
                        
                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
