<td style="width: 70px;" class=""> Subcat: {{ $subcat->id }}</td>
<td>
    @foreach (editions() as $lan)
    {{ App::setLocale($lan) }}
        <b>{{ $lan }}:</b>{{$subcat->name}}
    @endforeach
</td>
<td> 
<div class="btn-group btn-group-xs float-right" title="Delete SubCategory">
    <ul class="">
        <li class="p-0" style="list-style: none"><a class="btn-subcat-edit"  href="{{route('admin.subcatEdit',$subcat)}}" data-url=""><i class="fas fa-edit"></i></a></li>
      <li class="p-0" style="list-style: none"><a class=" btn-subcat-delete text-danger"  href="{{route('admin.subcatDelete',$subcat)}}" data-url=""><i class="fa fa-trash"></i></a></li>
    </ul>
  </div>
</td>