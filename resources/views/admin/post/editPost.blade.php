    @extends('admin.layouts.adminMaster')
    @push('css')
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
        <style>
            pre {
                background-color: #ccc;
                border: 0.5px solid #ccc;

            }


            span.select2-selection__choice__remove {
                color: #fff !important;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #007bff;

            }

        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"
            integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- End dropzone --}}
    @endpush
    @section('content')
        <div class="container-fluid">
            @include('alerts.alerts')
            <h1>Edit Post <small>edit</small> </h1>
            <div class="card w3-light-gray">
                <div class="card-header w3-white">
                    <div class="card-title  ">Edit Post</div>
                </div>
                @include('admin.media.addMediaDropzon')
                <input type="hidden" value="{{route('admin.mediaUploadDropZon')}}" id="route">
                <div class="card-body">
                    <form action="{{ route('admin.updtePost', $post) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="publish_date">Publish Date</label>
                                                    <input type="date" name="publish_date" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') }}">
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="publish_time">Publish Time</label>
                                                    <input type="time" name="publish_time" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($post->published_at)->format('H:i') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="author">Author/Writer</label>
                                                <select id="author" name="author"
                                                    class="form-control user-select select2-container step2-select select2"
                                                    data-placeholder="example@example.com"
                                                    data-ajax-url="{{ route('admin.selectUserForAssignRole') }}"
                                                    data-ajax-cache="true" data-ajax-dataType="json" data-ajax-delay="200"
                                                    style="">
                                                    <option selected="selected" value="{{ $post->writer ? $post->writer->id : '' }}">
                                                        {{ $post->writer ? $post->writer->email : '' }}
                                                    </option>
                                                </select>

                                                @if ($websiteParameter->news_editions)
                                                    <?php $version_Editions = explode(',', $websiteParameter->news_editions); ?>
                                                    <div class="col-md-12">
                                                        @foreach ($version_Editions as $vwise)
                                                            {{ app()->setLocale($vwise) }}
                                                            <div class="form-group">
                                                                <label for="{{ $vwise }}_title">Title
                                                                    ({{ $vwise }})</label>
                                                                <input type="text" class="form-control"
                                                                    name="{{ $vwise }}_title"
                                                                    placeholder="{{ $vwise }} Title"
                                                                    value="{{ $post->title }}">
                                                            </div>
                                                        @endforeach
                                                        @foreach ($version_Editions as $vwise)
                                                            {{ app()->setLocale($vwise) }}
                                                            <div class="form-group">
                                                                <label for="description_{{ $vwise }}">Description
                                                                    ({{ $vwise }})</label>
                                                                <textarea name="{{ $vwise }}_description"
                                                                    class="tinyMC" id="summerNote" cols="30" rows="10"
                                                                    placeholder="{{ $vwise }} Description">{{ $post->description }}</textarea>
                                                            </div>
                                                        @endforeach

                                                        @foreach ($version_Editions as $vwise)
                                                            {{ app()->setLocale($vwise) }}
                                                            <div class="form-group">
                                                                <label for="{{ $vwise }}_excerpt">Excerpt
                                                                    ({{ $vwise }})</label>
                                                                <textarea name="{{ $vwise }}_excerpt" id="excerpt"
                                                                    cols="30" rows="3"
                                                                    class="form-control">{{ $post->excerpt }}</textarea>
                                                                @if ($errors->has('excerpt_' . $vwise . ''))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('excerpt_' . $vwise . '') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        @endforeach

                                                        @foreach ($version_Editions as $vwise)
                                                            {{ app()->setLocale($vwise) }}
                                                            <div class="form-group">
                                                                <label for="{{ $vwise }}_tags"
                                                                    class=" control-label">Tags
                                                                    (For Search)</label>
                                                                <select id="{{ $vwise }}_tags"
                                                                    name="{{ $vwise }}_tags[]"
                                                                    class="form-control select2-tags select2-container step2-select select2"
                                                                    data-placeholder="Select {{ $vwise }} Tags From list or Add New"
                                                                    data-ajax-url="{{ route('admin.selectTagsOrAddNew') }}"
                                                                    data-ajax-cache="true" data-ajax-dataType="json"
                                                                    data-ajax-delay="200" multiple="multiple"
                                                                    style="width: 100%;">
                                                                    {{-- @if (count($post->tags)) --}}
                                                                    @if ($post->tags)
                                                                        @foreach ($post->tags as $ot)
                                                                            <option selected="selected">{{ $ot }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                @endif


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="publish"
                                                                    {{ ($post->publish_status ?? null) === 'published' ? 'checked' : '' }}>
                                                                Publish
                                                                Instantly</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="front_slider"
                                                                    {{ !empty($post->front_slider) ? 'checked' : '' }}>
                                                                Front
                                                            </label>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="headline">Headline (Scrolling)
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="highlight">Highlight</label>
                                                        </div>
                                                    </div> --}}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Update Feature Image</h3>
                                    </div>
                                    <div class="card-body">

                                        @if (!empty($post->feature_img_name))
            <div class="mb-3 text-center">
                <label class="d-block font-weight-bold">Current Feature Image</label>
                <img src="{{ asset('storage/media/image/' . $post->feature_img_name) }}"
                     class="img-fluid img-thumbnail"
                     style="max-height: 180px;">
            </div>
        @endif


                                        <div class="form-group {{ $errors->has('feature_image') ? ' has-error' : '' }}">
                                            <label for="feature_image" class="col-sm-5 form-control-label">Feature
                                                Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="feature_image" class=""
                                                    id="feature_image">
                                                <span class="help-block">Image Dimention 300px X 200px or larger and
                                                    Ratio
                                                    3/2.</span>

                                                @if ($errors->has('feature_image'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('feature_image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Add Category / Subcategory</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="extra_file" class=" control-label"></label>
                                            <div class="row">
                                                @foreach ($cats->chunk(2) as $cats2)
                                                    @foreach ($cats2 as $cat)
                                                        <div class="col-sm-3">
                                                            <div class="checkbox">
                                                                <label><input type="checkbox" name="categories[]"
                                                                        value="{{ $cat->id }}"
                                                                        {{ $cat->hasPost($post) ? 'checked' : '' }}>{{ $cat->name }}</label>
                                                            </div>
                                                            @if ($cat->subcats)
                                                                <div class="pl-2">
                                                                    @foreach ($cat->subcats as $sc)
                                                                        <div class="checkbox">
                                                                            <label><input type="checkbox"
                                                                                    name="subCategories[]"
                                                                                    value="{{ $sc->id }}"
                                                                                    {{ $sc->hasPost($post) ? 'checked' : '' }}>{{ $sc->name }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>

                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/summernote/summernote.min.js') }}"></script>
 
         
          
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    theme: 'bootstrap4'
                });

                $('.step2-select').select2({
                    theme: 'bootstrap4',
                    // minimumInputLength: 1,
                    ajax: {
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            // alert(data[0].s);
                            var data = $.map(data, function(obj) {
                                obj.id = obj.id || obj.id;
                                return obj;
                            });
                            var data = $.map(data, function(obj) {
                                obj.text = obj.email;
                                return obj;
                            });
                            return {
                                results: data,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        }
                    },
                });

                $('#summerNote').summernote();
                $('.summerNote').summernote();
                $('.summernote').each(function(i, obj) {
                    $(obj).summernote({
                        onblur: function(e) {
                            var id = $(obj).data('id');
                            var sHTML = $(obj).code();
                            alert(sHTML);
                        }
                    });
                });

                $('.select2-tags').select2({
                    minimumInputLength: 1,
                    tags: true,
                    tokenSeparators: [','],
                    ajax: {
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            // alert(data[0].s);
                            var data = $.map(data, function(obj) {
                                obj.id = obj.id || obj.title;
                                return obj;
                            });
                            var data = $.map(data, function(obj) {
                                obj.text = obj.text || obj.title;
                                return obj;
                            });
                            return {
                                results: data,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        }
                    },
                });
            });
        </script>

    @endpush
