<tbody>
    <tr>
        <td style="width: 50px;">{{ $cat->id }}</td>
        <td>
            @foreach (editions() as $lan)
                <form class="form-cat-update" method="post"
                    action="{{ route('admin.categoryUpdate', ['cat' => $cat, 'lan' => $lan]) }}">

                    {{ App::setLocale($lan) }}
                    <div class="form-group">
                        <b>{{ $lan }}</b> <input type="text" value="{{ $cat->name }}" name="name"
                            class="form-control input-sm cat-input" style="min-width: 450px;">
                    </div>
                    @if($loop->index == 0)
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="description_en" id="" cols="30" rows="5" class="form-control"
                            placeholder="Description here...." required>{!! $cat->description_en !!}</textarea>
                    </div>
                    @endif


                    <button type="submit" class="btn btn-xs btn-warning pull-right">Update</button>
                </form>
            @endforeach

        </td>
        <td>

            {{-- <form class="form-cat-update" method="post"
                action="{{ route('admin.categoryUpdate', ['cat' => $cat, 'lan' => $lan]) }}"> --}}

                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea name="description_en" id="" cols="30" rows="5" class="form-control"
                        placeholder="Description here...." required>{!! $cat->description_en!!}</textarea>
                </div> --}}

                {{-- <button type="submit" class="btn btn-xs btn-warning pull-right">Update</button>
            </form> --}}
        </td>
        <td style="width: 100px;"></td>
    </tr>
</tbody>
