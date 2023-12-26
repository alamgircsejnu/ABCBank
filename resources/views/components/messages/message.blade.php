@if(session('response'))
    @if(session('response')['error'])
        <div class="text-red-700 my-3 text-center">{!! session('response')['message'] !!}</div>
    @else
        <div class="text-green-700 my-3 text-center">{!! session('response')['message'] !!}</div>
    @endif
@endif
