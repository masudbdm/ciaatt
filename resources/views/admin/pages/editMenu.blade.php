@extends('admin.layouts.adminMaster')
@push('css')
    
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            @include('alerts.alerts')

            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        <i class="fa fa-edit"></i> Update Menu
                    </h3>
                </div>

                <!-- form start -->
                <form class="form-horizontal"
                      method="POST"
                      action="{{ route('admin.updateMenu', $menu) }}">
                    @csrf

                    <div class="card-body">

                        {{-- Menu Title --}}
                        <div class="form-group{{ $errors->has('menu_title') ? ' has-error' : '' }}">
                            <label for="menu_title" class="col-sm-2 control-label">
                                Menu Title
                            </label>

                            <div class="col-sm-10">
                                <input type="text"
                                       name="menu_title"
                                       id="menu_title"
                                       class="form-control"
                                       value="{{ old('menu_title', $menu->menu_title) }}"
                                       placeholder="Menu Title"
                                       required
                                       autofocus>

                                @if ($errors->has('menu_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('menu_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        {{-- Menu Slug --}}
<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
    <label for="slug" class="col-sm-2 control-label">
        Menu Slug
    </label>

    <div class="col-sm-10">
        <input type="text"
               name="slug"
               id="slug"
               class="form-control"
               value="{{ old('slug', $menu->slug) }}"
               placeholder="menu-slug"
               required>

        <small class="text-muted">
            Only lowercase letters, numbers and hyphen (-)
        </small>

        @if ($errors->has('slug'))
            <span class="help-block">
                <strong>{{ $errors->first('slug') }}</strong>
            </span>
        @endif
    </div>
</div>


                        {{-- Menu Type --}}
                        <div class="form-group{{ $errors->has('menu_type') ? ' has-error' : '' }}">
                            <label for="menu_type" class="col-sm-2 control-label">
                                Menu Type
                            </label>

                            <div class="col-sm-10">
                                <select name="menu_type"
                                        id="menu_type"
                                        class="form-control"
                                        required>
                                    <option value="">-- Select Type --</option>
                                    <option value="Full"
                                        {{ old('menu_type', $menu->menu_type) == 'Full' ? 'selected' : '' }}>
                                        Full
                                    </option>
                                    <option value="Tab"
                                        {{ old('menu_type', $menu->menu_type) == 'Tab' ? 'selected' : '' }}>
                                        Tab
                                    </option>
                                </select>

                                @if ($errors->has('menu_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('menu_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <a href="{{ route('admin.allMenus') }}"
                                   class="btn btn-default">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-primary pull-right">
                                    Update
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
document.getElementById('menu_title').addEventListener('keyup', function () {
    const slug = this.value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');

    document.getElementById('slug').value = slug;
});
</script>

@endpush