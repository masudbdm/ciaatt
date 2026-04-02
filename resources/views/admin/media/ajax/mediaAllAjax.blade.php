@push('css')
    <style>
        .getImage {
            cursor: pointer;

        }

        .imgDesign {
            border: 4px solid #2271b1;
            /* box-shadow: inset 0 0 0 3px #fff, inset 0 0 0 7px #2271b1; */
        }

        .myactive a {
            color: black !important;
        }

        .myactive .active {
            background-color: transparent !important;
            color: black !important;
            border-top: 2px solid #dcdcde !important;
            border-left: 2px solid #dcdcde !important;
            border-right: 2px solid #dcdcde !important;
        }

        .myactive a:focus {
            box-shadow: 0 0 0 1px #4f94d4, 0 0 2px 1px rgb(79 148 212 / 80%);
            color: #043959;
            outline: 1px solid transparent;

        }

        form#image-upload {
            border: none;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"
        integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@foreach ($mediaAll as $md)
    <img class="getImage " src="{{ route('imagecache', ['template' => 'pplg', 'filename' => $md->file_name]) }}"
        alt="" srcset="" data-url="{{ route('imageDetails', $md) }}">
@endforeach

@push('js')
    <script>
        $(document).on('click', '.getImage', function() {
            var that = $(this);
            var b = that.closest('#closeIt').find('.getImage').removeClass('imgDesign');
            that.addClass('imgDesign');
            url = that.attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    // console.log(response);
                    $('#showDetails').html(response);
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '#size', function(e) {
            e.preventDefault();
            var that = $(this);
            var val = that.val();
            if (val == 'thumbnail') {
                url = $('#thumbnail').val();
            } else if (val == 'medium') {
                url = $('#medium').val();
            } else if (val == 'large') {
                url = $('#large').val();
            } else {
                url = $('#full').val();
            }
            // alert(url);
            $('#copyUrl').val(url);
        });
    </script>
    {{-- Dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"
        integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Start dropzone --}}
    <script>
        $(document).on('click', '.selectImage', function() {
            var that = $(this);
            var url = that.attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    $('.closeIt').html(response.html);
                }
            });
        });

        myDropzone.on("complete", function(file) {
  myDropzone.removeFile(file);
});
    </script>
@endpush
