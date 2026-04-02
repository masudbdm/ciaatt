@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            @include('alerts.alerts')

            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title"><i class="fa fa-th"></i> All Menus</h3>
                </div>
                <div class="card-body">
                 <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
    <tr>
        <th>SL</th>
        <th style="text-align:left;">Menu Title</th>
        <th>Slug</th>
        <th>Menu Type</th>
        <th>Added By</th>
        <th width="100">Action</th>
    </tr>
</thead>

                        <tbody>
@foreach ($menus as $menu)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td style="text-align:left;">
        {{ $menu->menu_title }}
    </td>

 
        <td style="max-width:180px; word-break:break-all;">
    <code>{{ $menu->slug }}</code>
</td>

   

    <td>
        {{ $menu->menu_type }}
    </td>

    <td>
        {{ $menu->addedBy->name }}
    </td>

    <td width="100">
        <div class="btn-group btn-sm">
            <a href="{{ route('admin.editMenu', $menu) }}"
               class="btn btn-info btn-xs">
                <i class="fas fa-edit"></i>
            </a>

            <a href="{{ route('admin.deleteMenu', $menu) }}"
               onclick="return confirm('Do you want to delete this page?');"
               class="btn btn-danger btn-xs">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
</tbody>

                </table>
            </div>
        </div>
    </div>

</div>


</div>
</div>
@endsection
@push('js')

@endpush
