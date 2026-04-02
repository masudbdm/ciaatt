</div>
{{-- MOdal For Insert Image --}}
<button type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#myModal">
    Insert Media
</button>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header d-block pb-0">
                <div class="d-flex">
                    <h4 class="modal-title">Add Media</h4>
                    <button type="button" class="close"
                        data-dismiss="modal">&times;</button>
                </div>

                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item myactive">
                        <a class="nav-link active" id="pills-upload-image-tab"
                            data-toggle="pill" href="#pills-upload-image" role="tab"
                            aria-controls="pills-home" aria-selected="true">Upload
                            Image</a>
                    </li>
                    <li class="nav-item myactive">
                        <a class="nav-link selectImage" data-url="{{ route('admin.mediaAllAjax') }}" id="pills-profile-tab"
                            data-toggle="pill" href="#pills-profile" role="tab"
                            aria-controls="pills-profile"
                            aria-selected="false">Select Image</a>
                    </li>
                </ul>
            </div>

            <!-- Modal body -->
            <div class="modal-body py-0 my-0" style="min-height: 60vh">
                <div class="tab-content pt-2" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-upload-image"
                        role="tabpanel" aria-labelledby="pills-upload-image-tab">
                        <div id="MfDropZon" class="city m-2 w3-white" >
                            {!! Form::open(['route' => 'admin.mediaUploadDropZon', 'id' => 'image-upload', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'dropzone','name'=>'files']) !!}
                            <div class="card-body dz-default dz-message">
                                <span class="uploadFile"><img src="{{ asset('img/dummyUpload.png') }}" alt=""></span>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="pills-profile"
                        role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-md-8 closeIt" id="closeIt">
                               @include('admin.media.ajax.mediaAllAjax')
                            </div>
                            <div class="col-md-4 w3-gray" style="min-height: 60vh">
                                <div id="showDetails">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

{{-- MOdal For Insert Image --}}