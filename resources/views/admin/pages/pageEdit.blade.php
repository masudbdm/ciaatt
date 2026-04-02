@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @include('alerts.alerts')


                <div class="card card-widget">
                    <div class="card-header with-border">
                        <h3 class="card-title"><i class="fa fa-edit"></i> Page Add/Edit <span
                                class="label label-default">{{ $page->page_title }}</span></h3>
                    </div>

                    <div class="card-body">
                        <div class="card card-widget mb-0">
                            <div class="card-body w3-gray ">
                                <div class="card card-widget ">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('admin.pageEditPost', $page) }}">
                                            @csrf
                                            <div class="form-group{{ $errors->has('page_title') ? ' has-error' : '' }}">
                                                <label for="page_title">Page Title:</label>
                                                <input type="text" class="form-control" placeholder="Page Title"
                                                    id="page_title" name="page_title"
                                                    value="{{ old('page_title') ?: $page->page_title }}">
                                            </div>

                                            <div class="checkbox">
                                                <label><input type="checkbox" name="title_hide"
                                                        {{ $page->title_hide ? 'checked' : '' }}> Title Hide </label>
                                            </div>

                                            <div class="checkbox">
                                                <label><input type="checkbox" {{ $page->active ? 'checked' : '' }}
                                                        name="active"> Active</label>
                                            </div>

                                            <div class="checkbox">
                                                <label><input type="checkbox" {{ $page->list_in_menu ? 'checked' : '' }}
                                                        name="list_in_menu"> List In Menu</label>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card card-widget">
                                                        <div class="card-header with-border">
                                                            <h5 class="card-title">Update Menu</h5>
                                                        </div>
                                                        <div class="card-body " style="padding-top: 0 !important;">
                                                            <div class="form-group ">
                                                                <label for="extra_file" class="control-label"></label>
                                                                <div class="row">
                                                                    @foreach ($menus->chunk(4) as $menu2)
                                                                        @foreach ($menu2 as $menu)
                                                                            <div class="col-sm-3">

                                                                                <div class="checkbox">
                                                                                    <label><input type="checkbox"
                                                                                            name="menus[]"
                                                                                            value="{{ $menu->id }}"
                                                                                            {{ $menu->hasPage($page) ? 'checked' : '' }}>
                                                                                        {{ $menu->menu_title }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">Submit</button>

                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">

                                        @foreach ($page->items as $item)
                                            @include('admin.pages.includes.pageItemSingle')
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

@endpush
