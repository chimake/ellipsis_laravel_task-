@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Short Link') }}</div>

                <div class="card-body">
                    <form action="{{ route('update.short.url') }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="url" name="original_url" id="original_url" placeholder="Original Url" value="{{ $short_url_info->original_url}}" />
                            
                        </div>
                        <div class="row">
                            <input type="text" name="exp_time_number" id="exp_time_number" placeholder="Expiry Time Number">
                           
                            <select name="exp_time_duration" id="exp_time_duration">
                                <option value="">Select Expiry Time Duration</option>
                                <option value="hour">Hour(s)</option>
                                <option value="minute">Minute(s)</option>
                                <option value="sec">Sec(s)</option>
                            </select>
                        </div>
                        <input type="hidden" name="url_id" value="{{ $short_url_info->id }}">
                                
                         
                        
                        <button type="submit">Short</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
