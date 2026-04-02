<div class="card-body slim-media">
    <div class="card card-widget">
        <div class="card-body" style="background-color: #ccc;">
            @if ($mediaAll->count())

                @foreach ($mediaAll as $media)

                    <div class="card card-default"
                        style="margin-bottom: 5px; font-size:14px; overflow:hidden">
                        <div class="card-body">
                            <div class="media d-flex justify-content-between">
                                <div class="float-left">
                                    <a href="#">
                                        <img class="media-object"
                                            style="width: 80px;height:60px;"
                                            src="{{ asset($media->file_url) }}"
                                            alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        {{ url('/' . $media->file_url) }} </h4>
                                    Orig.Name: {{ $media->file_original_name }} <br>
                                    Size: {{ human_filesize($media->file_size) }}<br>
                                    Width: {{ $media->width }}px <br>
                                    Height: {{ $media->height }}px
                                </div>
                            </div>

                            <small>
                                <pre>{{ url('/' . $media->file_url) }}</pre>
                            </small>

                        </div>
                    </div>

                @endforeach


                <div class="pull-right">
                    {{ $mediaAll->render() }}
                </div>

            @endif


        </div>
    </div>

</div>