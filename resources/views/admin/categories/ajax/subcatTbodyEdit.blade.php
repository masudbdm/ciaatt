<tbody>
    <tr>
        <td style="width: 50px;" class="">{{ $subcat->id }}</td>
        <td>
			@foreach (editions() as $lan)
            <form class="form-inline form-subcat-update" method="post" action="{{ route('admin.subcatUpdate',['subcat'=>$subcat,'lan'=>$lan]) }}">
				{{ App::setLocale($lan) }}
                    <div class="form-group">
                       <b>{{ $lan }}</b> <input type="text" value="{{ $subcat->name }}" name="name"
                            class="form-control input-sm cat-input" style="min-width: 450px;">
                    </div>
                
                <button type="submit" class="btn btn-xs btn-warning pull-right">Update</button>
            </form>

			@endforeach
        </td>
        <td style="width: 100px;"></td>
    </tr>
</tbody>
