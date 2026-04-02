<section class="content-header">
    <h1>
        All
        <small>Categories</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-plus"></i> All </a></li>
        <li class="active">Categories</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <h3 class="card-title">All Categories</h3>
                        </div>
                        <div class="col-md-10">
                            <form class="px-3" method="post"
                                action="{{ route('admin.categoryAddNewPost') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @foreach (editions() as $lan)
                                    <div class="form-group {{ $errors->has($lan . '_category') ? ' has-error' : '' }}">
                                        <label for="{{ $lan }}_category">Category Name</label>
                                        <input type="text" name="{{ $lan }}_category" class="form-control"
                                            value="{{ old($lan . '_category') }}" id="category"
                                            placeholder="Category Name" autocomplete="off">
                                        @if ($errors->has('category'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                       <textarea name="description_en" id="" cols="30" rows="5" class="form-control" placeholder="Description here...." required></textarea>
                                      </div>
                                    
                                @endforeach
                                {{-- <label for="cover_image">Category Cover Image</label>
                                <div class="form-control">
                                    <input type="file" name="{{$lan.'cover_image'}}">
                                </div> --}}
                                <br>

                                <button type="submit" class="btn btn-info">Submit New Category</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive ">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th>Category Name</th>
                                <th style="width: 150px;" class="f">Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div id="sortablePanel" class="col-md-12 connectedSortable" data-url="{{ route('admin.catSort') }}">
                    @foreach ($cats as $key => $cat)
                        <div id="{{ $cat->id }}" class="card card-widget my-2 w3-light-gray mb-1">
                            <div class="card-body table-responsive pt-0" style="min-height: 60px;">
                                <table class="table  table-cat">
                                    @include('admin.categories.ajax.catTable')
                                </table>
                                <table class="table table-striped table-subcat-new" style="display: none;">
                                    @include('admin.categories.ajax.subcatNewInput')
                                </table>
                                <div class="subcat-area">
                                    @include('admin.categories.ajax.subcatTable')
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>
