@extends('admin.layouts.adminMaster')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/dist/css/monokai.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        .note-group-select-from-files {
      display: none;
    }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @include('alerts.alerts')

                <div class="card card-widget">
                    <div class="card-body">
                        <div class="card card-widget mb-0">
                            <div class="card-body w3-gray ">
                                <div class="card card-widget mb-1">
                                    <div class="card-body">
                                        Page ID: <b>{{ $page->id }}</b>, &nbsp;
                                        Page Title: <b> {{ $page->page_title }}</b>, &nbsp;
                                        Route Name: <b> {{ $page->route_name }}</b>, &nbsp;
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
                                            <a class="btn-primary btn btn-xs "
                                                href="{{ route('admin.pageEdit', $page) }}">Edit</a>
                                            &nbsp;
                                            <a class="btn-primary btn btn-xs "
                                                href="{{ route('admin.pageItems', $page) }}">Add Page Part</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">

                                        @foreach ($page->items as $item)
                                            <div class="card card-widget mb-1">
                                                <div class="card-body">
                                                    SL: <b>{{ $loop->iteration }}</b>, &nbsp;
                                                    Part Title: <b> {{ $item->title }}</b>, &nbsp;

                                                    Active: <b>{{ $page->active ? 'Yes' : 'No' }}</b>,
                                                    <div class="float-right">
                                                        <a class="btn-primary btn btn-xs "
                                                            href="{{ route('admin.pageItemEdit', $item) }}">Edit</a>
                                                        &nbsp;

                                                        <a class="btn-danger btn btn-xs "
                                                            onclick="return confirm('Do you really want to delete?');"
                                                            href="{{ route('admin.pageItemDelete', $item) }}">Delete</a>
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

                <div class="card card-widget">
                    <div class="card-header with-border">
                        <h3 class="card-title"><i class="fa fa-edit"></i> Page Item Add of <span
                                class="label label-default">{{ $page->page_title }}</span></h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-widget mb-0">
                            <div class="card-body w3-gray ">

                                <div class="row">
                                    <div class="col-sm-7">

                                        <div class="card card-widget mb-0">
                                            <div class="card-body">
                                                <form method="post" enctype="multipart/form-data"
                                                    action="{{ route('admin.pageItemAddPost', $page) }}">

                                                    @csrf
                                                    <div
                                                        class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                                        <label for="title">Item Title:</label>
                                                        <input type="text" class="form-control" placeholder="Page Title"
                                                            id="title" name="title" value="{{ old('title') }}">
                                                    </div>

                                                    <div
                                                        class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                                        <label for="description" class="control-label"> Description</label>

                                                        <textarea name="description" class="form-control details-input"
                                                            rows="10" id="description"
                                                            placeholder="Description">{!! old('description') !!}</textarea>

                                                        @if ($errors->has('description'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('description') }}</strong>
                                                            </span>
                                                        @endif

                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" checked name="editor"> Editor</label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label><input type="checkbox" checked name="active"> Active</label>
                                                    </div>



                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-5">

                                        <div class="card card-widget">
                                            <div class="card-header with-border">
                                                <h3 class="card-title">Media Gallery</h3>

                                                <div class="card-tools pull-right">
                                                    {{-- <a href="{{ route('admin.mediaAll') }}"
                                                    class="w3-btn btn-sm w3-round w3-white w3-border w3-border-blue"> <i
                                                        class="fa fa-image"></i>Upload Image</a> --}}
                                                </div>
                                            </div>
                                            <div class="card-body slim-media">

                                                <div class="card card-widget">
                                                    <div class="card-body" style="background-color: #ccc;">

                                                        @include('admin.media.includes.mediaAllForPost')

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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
<script src="{{ asset('admin/dist/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/formatting.js') }}"></script>
<script src="{{ asset('admin/dist/js/codemirror.js') }}"></script>
<script src="{{ asset('admin/dist/js/xml.js') }}"></script>
<script src="{{ asset('admin/plugins/summernote/summernote.min.js') }}"></script>
<script>
    
  $(document).ready(function() {
    $('.details-input').summernote({
      placeholder: 'Write description of the post here...',
      minHeight: 160,
      codemirror: { // codemirror options
        theme: 'monokai',
        lineNumbers: true,
        lineWrapping: true,
      }
    });
  });

  // $(function () {
  //   // Replace the <textarea id="editor1"> with a CKEditor
  //   // instance, using default configuration.
  //   CKEDITOR.replace('description');
  // });

    $(document).ready(function () {
  $('.select2-tags').select2({
    minimumInputLength: 0,
    tags:true,
    tokenSeparators: [','],
    ajax: {
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 1;
        // alert(data[0].s);
        var data = $.map(data, function (obj) {
          obj.id = obj.id || obj.title;
          return obj;
        });
        var data = $.map(data, function (obj) {
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


<script>
  $(function(){
          $('.slim-media').slimScroll({
              height: '500px'
          });

 
        });
</script>

<script>
  
  $(function(){

$(document).on('click', '.copyboard', function(e) {
  e.preventDefault();


  $(".copyboard").text('Copy to Clipboard');

  $(this).text('Coppied!');
  var copyText = $(this).attr('data-text');

  var textarea = document.createElement("textarea");
  textarea.textContent = copyText;
  textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand("copy"); 

  document.body.removeChild(textarea);
});

  });
</script>
@endpush
