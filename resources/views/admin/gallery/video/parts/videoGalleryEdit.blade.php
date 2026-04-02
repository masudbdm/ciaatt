<div class="card card-widget">
  <div class="card-header with-border">
      <h3 class="card-title">
          Update Video Gallery
      </h3>
  </div>

  <div class="card-body" style="background-color: #ccc;">
      <div class="row">
          <div class="col-md-7">

              <form method="post"
                  action="{{ route('admin.updateVideoGallery', $videoGallery->id) }}">
                  @csrf
                  <div class="card-body">
                    @include('alerts.alerts')
                    <div class="form-group ">
                      <label for="title" class=" control-label">Video Gallery Title</label>
                      <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' form-error' : '' }}" value="{{ old('title') ?: $videoGallery->title  }}" id="title"
                                placeholder="Title of Video Gallery" autocomplete="off">
                            @if ($errors->has('title'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-group ">
                        <label for="description" class=" control-label">Description</label>
                            <input type="text" name="description" class="form-control {{ $errors->has('description') ? ' form-error' : '' }}"
                                value="{{ old('description') ?: $videoGallery->description  }}" id="description"
                                placeholder="Short Description about the video gallery"
                                autocomplete="off">
                            @if ($errors->has('description'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="videoUrl" class="control-label">Youtube Video Url</label>
                            <input type="text" name="videoUrl" class="form-control {{ $errors->has('videoUrl') ? ' form-error' : '' }}"
                                value="{{ old('videoUrl') ?: $videoGallery->videoUrl  }}" id="videoUrl"
                                placeholder="https://www.youtube.com/embed/WB8BgVGF6mo"
                                autocomplete="off">
                            @if ($errors->has('videoUrl'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('videoUrl') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <div class="checkbox">
                                <label><input type="checkbox" name="publish" checked>Publish
                                    Instantly</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
              </form>
          </div>
          <div class="col-md-5">
            <iframe width="400" height="240" src="{{ $videoGallery->videoUrl }}" title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
          </div>
      </div>

  </div>

  <div class="card-footer">

  </div>

</div>

