@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Good Bye') }}</div>

                <div class="card-body">
                    @if (session('short_url'))
                        <span class="text-success">You will be redirected in 7 seconds. Here is your short link </span><a href="{{ session('short_url') }}">{{ url(session('short_url')) }}</a>
                    @endif
                </div>
                @if (session('short_url'))
                    <script>
                    setTimeout(function() {
                        window.location.href = "{{ session('short_url') }}"
                    }, 7000); 
                    </script>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
