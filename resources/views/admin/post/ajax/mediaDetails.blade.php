<h5>ATTACHMENT DETAILS</h5>
<img src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $media->file_name]) }}">
<p class="m-0"><small>{{ $media->file_name }}</small></p>
<p class="m-0"><small>{{ \Carbon\Carbon::parse($media->created_at)->format('F d, Y') }}</small></p>
<p class="m-0"><small>{{ human_filesize($media->file_size) }}</small></p>
<p class="m-0"><small>{{ $media->width }} by {{ $media->height }}</small></p>
<p class="m-0"><small><a href="#">Edit Image</a></small></p>
<p class="m-0"><small><a href="#" class="text-danger">Delete Permanently</a></small></p>
File URL: <input type="text" id="url" value="{{ url('/' . $media->file_url) }}" readonly class="form-control">
<input type="hidden" id="thumbnail" value="{{ route('imagecache', ['template' => 'thumbnail', 'filename' => $media->file_name]) }}">
<input type="hidden" id="medium" value="{{ route('imagecache', ['template' => 'medium', 'filename' => $media->file_name]) }}">
<input type="hidden" id="large" value="{{ route('imagecache', ['template' => 'large', 'filename' => $media->file_name]) }}">
<input type="hidden" id="full" value="{{ url('/' . $media->file_url) }}">
<h5>ATTACHMENT DISPLAY SETTINGS</h5>
Copy URL: <input type="text" id="copyUrl" value="{{ url('/' . $media->file_url) }}" readonly class="form-control">
Size: <select name="size" id="size" class="form-control">
    <option value="thumbnail">
        Thumbnail – 150 × 150
    </option>
    <option value="medium">
        Medium – 298 × 300
    </option>

    <option value="large">
        Large – 750 × 756
    </option>

    <option value="full" selected="selected">
        Full Size –{{ $media->width }}  × {{ $media->height }}
    </option>
</select>
