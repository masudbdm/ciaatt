<div class="card card-widget">
    <div class="card-header with-border">
        <h3 class="card-title">
            Update Gallery
        </h3>
    </div>

    <div class="card-body" style="background-color: #ccc;">
        <div class="row">
            <div class="col-md-7">

                <form class="form-horizontal" method="post"
                    action="{{ route('admin.imgGalleryEditPost', $imageGallery) }}">

                    <div class="card card-widget">
                        <div class="card-body">

                            @include('alerts.alerts')

                            {{ csrf_field() }}


                            <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-sm-3 control-label">Gallery Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title') ?: $imageGallery->title }}" id="title"
                                        placeholder="Title of Post" autocomplete="off">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-sm-3 control-label">Gallery Description</label>
                                <div class="col-sm-9">
                                    <input type="text" name="description" class="form-control"
                                        value="{{ old('description') ?: $imageGallery->description }}" id="description"
                                        placeholder="Short Description about the gallery" autocomplete="off">
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('link_url') ? ' has-error' : '' }}">
                                <label for="link_url" class="col-sm-3 control-label">Link Url </label>
                                <div class="col-sm-9">
                                    <input type="text" name="link_url" class="form-control"
                                        value="{{ old('link_url') ?: $imageGallery->link_url }}" id="link_url"
                                        placeholder="Post url or external any url" autocomplete="off">
                                    @if ($errors->has('link_url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('link_url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>





                            <div class="form-group row">

                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="publish"
                                                {{ $imageGallery->publish_status == 'published' ? 'checked' : '' }}>Publish
                                            Instantly</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right"
                                onclick="return confirm('Did you add all the items below you need?');">Save With Items
                                Below</button>





                        </div>
                    </div>
                </form>

                @if ($imageGallery->items->count())
                    <div class="card card-widget">
                        <div class="card-header">
                            <h3 class="card-title">
                                Gallery Items <i class="fa fa-angle-double-down"></i>
                            </h3>
                        </div>
                    </div>
                    @foreach ($imageGallery->items as $item)

                        <div class="card card-widget">
                            <div class="card-body">
                                <form class="form-horizontal gallery-item-form" method="post"
                                    action="{{ route('admin.imgGalleryItemAjaxPost', $item) }}">

                                    {{ csrf_field() }}

                                    <div class="form-group row {{ $errors->has('img_url') ? ' has-error' : '' }}">
                                        <label for="img_url" class="col-sm-3 control-label">Item Image Url</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="img_url" class="form-control"
                                                value="{{ old('img_url') ?: $item->img_url }}" id="img_url"
                                                placeholder="The media gallery image url or other image url"
                                                autocomplete="off">
                                            @if ($errors->has('img_url'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('img_url') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label for="title" class="col-sm-3 control-label">Item Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title') ?: $item->title }}" id="title"
                                                placeholder="Title of the image item" autocomplete="off">
                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description" class="col-sm-3 control-label">Item Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="description" class="form-control"
                                                value="{{ old('description') ?: $item->description }}" id="description"
                                                placeholder="Short Description about the item" autocomplete="off">
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group row {{ $errors->has('photo_credit') ? ' has-error' : '' }}">
                                        <label for="photo_credit" class="col-sm-3 control-label">Photo Credit</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="photo_credit" class="form-control"
                                                value="{{ old('photo_credit') ?: $item->photo_credit }}"
                                                id="photo_credit"
                                                placeholder="The name or about the person who captured the photo."
                                                autocomplete="off">
                                            @if ($errors->has('photo_credit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('photo_credit') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($item->publish_status == 'published')
                                        <button type="submit"
                                            class="btn btn-success pull-right submit-btn">Added</button>
                                    @else
                                        <button type="submit" class="btn btn-primary pull-right submit-btn">Add</button>
                                    @endif

                                </form>
                            </div>
                        </div>

                    @endforeach
                @endif


            </div>
            <div class="col-md-5">
                <style>
                    .btn-feature {
                        text-shadow: 2px 2px 4px #000000;
                    }

                </style>

                <div class="card card-widget">
                    <div class="card-header with-border">
                        <h3 class="card-title">Media Gallery</h3>

                        <div class="card-tools pull-right">
                            <a href="{{ route('admin.mediaAll') }}"
                                class="w3-btn btn-sm w3-round w3-white w3-border w3-border-blue"> <i
                                    class="fa fa-image"></i>Upload Image</a>
                        </div>
                    </div>
                    <div class="card-body slim-media">

                        <div class="card card-widget">
                            <div class="card-body" style="background-color: #ccc;">

                                @include('admin.post.include.mediaAllForPost')

                            </div>
                        </div>

                    </div>
                </div>










            </div>
        </div>








    </div>

    <div class="card-footer">

    </div>

</div>
