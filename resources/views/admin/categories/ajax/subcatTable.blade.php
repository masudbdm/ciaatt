@if($cat->subcats->first())
<table class="table  table-subcat">
  <tbody>
    
@foreach($cat->subcats as $subcat)

  @include('admin.categories.ajax.subcatTr')

@endforeach
  </tbody>
</table>
@endif