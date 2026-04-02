@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <form action="{{ route('admin.pageAddNewPost') }}" method="post">
                <div class="col-md-12">

                </div>
            </form>
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header with-border">
                        <h3 class="card-title"><i class="fa fa-plus"></i> Add New Page</h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-widget mb-0">
                            <div class="card-body w3-gray ">
                                <div class="card card-widget mb-0">
                                    <div class="card-body">
                                        <form class="" method="post" style="white-space: nowrap"
                                            action="{{ route('admin.pageAddNewPost') }}">
                                            @csrf
                                            <div class="form-group{{ $errors->has('page_title') ? ' has-error' : '' }}">
                                                <label for="page_title">Page Title:</label>
                                                <input type="text" class="form-control" placeholder="Page Title"
                                                    id="page_title" name="page_title" value="{{ old('page_title') }}">
                                            </div>
                                            <br>
                                            <div class="checkbox pl-1">
                                                <label><input type="checkbox" name="title_hide"> Title Hide </label>
                                            </div>

                                            <div class="checkbox pl-1">
                                                <label><input type="checkbox" checked name="active"> Active</label>
                                            </div>

                                            <div class="checkbox pl-1">
                                                <label><input type="checkbox" checked name="list_in_menu"> List In
                                                    Menu</label>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header with-border">
                                                            <h5 class="card-title">Update Menu</h5>
                                                        </div>
                                                        <div class="card-body" style="padding-top: 0 !important;">
                                                            <div class="form-group">
                                                                <label for="extra_file" class="control-label"></label>
                                                                <div class="row">
                                                                    @foreach ($menus->chunk(4) as $menu2)
                                                                        @foreach ($menu2 as $menu)
                                                                            <div class="checkbox mr-2">
                                                                                <label><input type="checkbox" name="menus[]"
                                                                                        value="{{ $menu->id }}">
                                                                                    {{ $menu->menu_title }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    @endforeach

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-widget">
                    <div class="card-header with-border">
                        <h3 class="card-title"><i class="fa fa-th"></i> All Pages</h3>
                    </div>

                    <div class="card-body">
                        <div class="card card-widget mb-0">
                            <div class="card-body w3-gray ">

                                <div class="row">
                                    <div class="col-sm-12 connectedSortable" id="sortablePanel"
                                        data-url="{{ route('admin.pageSort') }}">

                                        @foreach ($pages as $page)

                                            <div class="card card-widget mb-1" id="{{ $page->id }}">
                                                <div class="card-body">
                                                    <i title="Drag up or down" class="fas fa-arrows-alt-v"
                                                        style="cursor: pointer"></i>
                                                    Page ID: <b>{{ $page->id }}</b>,
                                                    Page Title: <b> {{ $page->page_title }}</b>,
                                                    Route Name: <b> {{ $page->route_name }}</b>,
                                                    Active: <b>{{ $page->active ? 'Yes' : 'No' }}</b>,
                                                    List In Menu: <b>{{ $page->list_in_menu ? 'Yes' : 'No' }}</b>,
                                                    Title Hide: <b>{{ $page->title_hide ? 'Yes' : 'No' }}</b>,

                                                    Parts: <b> <span
                                                            class="label {{ $page->items()->whereActive(true)->count()
    ? 'label-success'
    : 'label-danger' }} ">
                                                            {{ $page->items()->whereActive(true)->count() }}
                                                        </span> </b>

                                                    <div class="float-right">
                                                        <a class="btn btn-primary btn-sm "
                                                            href="{{ route('admin.pageEdit', $page) }}">Edit</a>

                                                        <a class="btn btn-primary btn-sm "
                                                            href="{{ route('admin.pageItems', $page) }}">Add Page
                                                            Part</a>
                                                        &nbsp;
                                                        <a class="w3-btn w3-red btn btn-xs "
                                                            onclick="return confirm('Do you really want to delete?');"
                                                            href="{{ route('admin.pageDelete', $page) }}">Delete</a>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
        $("#sortablePanel").sortable({
            connectWith: ".connectedSortable",
            distance: 5,
            delay: 300,
            opacity: 0.6,
            cursor: 'move',
            update: function() {
                var order = $('#sortablePanel').sortable('toArray'),
                    url = $("#sortablePanel").attr('data-url');
                $.ajax({
                    url: url,
                    type: 'Post',
                    cache: false,
                    dataType: 'json',
                    data: {
                        sorted_data: order
                    },
                    success: function(response) {
                        if (response.success == true) {} else {
                            alert('fail');
                        }
                    },
                    error: function() {}
                }); //ajax
            }
        }).disableSelection();
    </script>

@endpush
