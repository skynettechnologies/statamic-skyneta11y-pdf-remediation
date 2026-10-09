@extends('statamic::layout')
@section('title', __('SkynetA11y PDF Remediation'))
@section('wrapper_class', 'max-w-full')

@section('content')
    <div style="width:100%;">
        <iframe
            id="aiopdf-frame"
            src="{{ $frame_url }}"
            title="{{ __('SkynetA11y PDF Remediation') }}"
            style="width:100%;border:0;display:block;height:80vh;"
        ></iframe>
    </div>

    <script>
        (function () {
            var frame = document.getElementById('aiopdf-frame');
            if (!frame) return;

            function fit() {
                var top = frame.getBoundingClientRect().top;
                var h = Math.max(window.innerHeight - top - 8, 480);
                frame.style.height = h + 'px';
            }

            window.addEventListener('load', fit);
            window.addEventListener('resize', fit);
            frame.addEventListener('load', fit);
            fit();
            setTimeout(fit, 50);
            setTimeout(fit, 300);
        })();
    </script>
@endsection
