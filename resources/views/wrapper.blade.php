@extends('statamic::layout')
@section('title', __('SkynetA11y PDF Remediation'))
@section('wrapper_class', 'max-w-full')

@section('content')
    <header class="mb-3">
    </header>

    {{--
        The dashboard is embedded in a same-origin iframe so its own CSS/JS
        cannot leak into the Statamic Control Panel. The iframe fills the
        available viewport height and scrolls internally, which is robust: it
        needs no height measurement or JavaScript, so it can never clip content
        or leave dead space regardless of when the dashboard finishes rendering.
    --}}
    <div class="card p-0 overflow-hidden">
        <iframe
            id="aiopdf-frame"
            src="{{ $frame_url }}"
            title="SkynetA11y PDF Remediation"
            style="width:100%;border:0;display:block;height:calc(100vh - 130px);min-height:600px;"
        ></iframe>
    </div>
@endsection
