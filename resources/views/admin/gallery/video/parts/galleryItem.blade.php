<tr class="gallery-tr-{{ $gallery->id }}">
    <td>
        <iframe width="240" height="157" src="{{ $gallery->videoUrl }}" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </td>
    <td>
        <b>ID:</b> {{ $gallery->id }} <br>
        <b>Status:</b> {{ $gallery->publish_status }}
    </td>
    <td>
        <b>Title:</b> {{ $gallery->title }}
    </td>
    <td>
        <b>Description:</b> {{ $gallery->description }}
    </td>

    <td>
        <div class="btn-group btn-sm float-right ">
            <a class="btn btn-primary xs" href="{{ route('admin.editVideoGallery', $gallery->id) }}">Edit</a>
            <button type="button" class="btn btn-primary xs dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                {{-- <li><a  target="_blank" href="{{route('welcome.videoGallery',$gallery)}}">Details</a></li> --}}

                <li><a href="{{ route('admin.deleteVideoGallery', $gallery) }}"
                        onclick="return confirm('Do you really want to delete this gallery?');">Delete</a>
                </li>
            </ul>
        </div>

    </td>
</tr>
