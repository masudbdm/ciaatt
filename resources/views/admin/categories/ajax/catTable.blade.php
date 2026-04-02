 <tbody>
	<tr>
		<td  title="drag and sort Category"  style="width: 50px;"><i class="fa fa-arrows-v"></i>  &nbsp; {{ $cat->id }}</td>
		<td >
			@foreach (editions() as $lan)
			{{ App::setLocale($lan) }}
			<b>{{ $lan }}</b> {{$cat->name}}
			@endforeach
		</td>
		<td style="width:150%" class=""> 
		<div class="btn-group btn-group-xs float-right" title="Delete Category">
 
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-trash"></i>
            </button>
            <ul class="dropdown-menu p-0" role="menu">
              <li class="p-0"><a class="w3-btn w3-red w3-small w3-round w3-hover-red btn-cat-delete ddd" href="{{route('admin.categoryDelete',$cat)}}" data-url="">Confirm</a></li>
            </ul>
          </div>

          <a class="btn btn-xs btn-primary float-right mr-2 subcat-new-toggle" title="Add new subcategory" href=""> <i class="fa fa-plus-circle"></i> Add Subcategory</a> 

			<a class="btn btn-xs btn-warning btn-cat-edit float-right mr-2" title="Edit Category" href="{{route('admin.categoryEdit',$cat)}}">Edit</a> 

		</td>
	</tr>
</tbody>