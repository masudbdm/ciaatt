@extends('admin.layouts.adminMaster')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.css') }}">
@endpush
@section('content')
    @include('alerts.alerts')
@section('content')
    @include('admin.categories.parts.categoriesAll')
@endsection
@endsection
@push('js')
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $(function() {
        $(document).on('click', '.btn-cat-edit', function(e) {
            e.preventDefault();
            var that = $(this);
            url = that.attr('href');
            table = that.closest('.table-cat');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            table = that.closest('.table-cat');
            // alert(url);
            // $.post(url, function(data, status) {
            //     table.empty().append(data);
            // });

            $.ajax({
                    url: url,
                    type: 'post',
                    // data:action:"edit",
                    dataType: 'json',
                })
                .done(function(response) {
                    table.empty().append(response);
                })
                .fail(function() {
                    console.log("error");
                });
        });


        $(document).on('submit', '.form-cat-update', function(s) {
            s.preventDefault();
            var form = $(this),
                url = form.attr('action'),
                type = form.attr('method'),
                alldata = new FormData(this),
                table = form.closest('table');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    url: url,
                    type: 'post',
                    // dataType: 'json',
                    data: alldata,
                    // mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,

                }).done(function(response) {
                    table.empty().append(response);
                })
                .fail(function() {
                    console("error");
                });
        });

        $(document).on('submit', '.subcat_add_new', function(s) {
            s.preventDefault();
            var form = $(this),
                url = form.attr('action'),
                type = form.attr('method'),
                alldata = new FormData(this),
                table = form.closest('table');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    url: url,
                    type: 'post',
                    // dataType: 'json',
                    data: alldata,
                    // mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,

                }).done(function(response) {
                    form.closest('.card-body').find('.subcat-area').empty().append(response);
                    form.closest('td').find('input').val('').focus();
                })
                .fail(function() {
                    console("error");
                });
        });

        $(document).on('click', '.btn-cat-delete', function(e) {
            e.preventDefault();
            var that = $(this),
                url = that.attr('href'),
                table = that.closest('.card-panel');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(url, function(data, status) {
                table.remove();
            });
        });

        $(document).on('click', '.btn-subcat-delete', function(e) {
            e.preventDefault();
            var that = $(this),
                url = that.attr('href'),
                table = that.closest('tr');
            // alert(url);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                })
                .done(function(response) {
                    if (response.success) {
                        table.remove();
                    }
                })
                .fail(function() {
                    console.log("error");
                });
        });

        $(document).on('click', '.btn-subcat-edit', function(e) {
            e.preventDefault();
            var that = $(this),
                url = that.attr('href'),
                table = that.closest('tr');
            // alert(url);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url: url,
                    type: 'GET',
                    // dataType: 'json',
                    // success:function(res){
                    //     console.log(res);
                    //     alert(res);
                    //     table.remove();
                    // }
                })
                .done(function(response) {
                    console.log(response);
                    if (response.html) {
                        table.empty();
                        table.append(response.html);
                    }
                })
                .fail(function() {
                    console.log("error");
                });
        });
        $(document).on('submit', '.form-subcat-update', function(s) {
            s.preventDefault();
            var form = $(this),
                url = form.attr('action'),
                type = form.attr('method'),
                alldata = new FormData(this),
                table = form.closest('tbody');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    url: url,
                    type: 'post',
                    // dataType: 'json',
                    data: alldata,
                    // mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,

                }).done(function(response) {
                    // console.log(response);
                    table.empty();
                    table.append(response);
                })
                .fail(function() {
                    console.log("error");
                });
        });
       

        $("#sortablePanel").sortable({
            connectWith: ".connectedSortable",
            distance: 5,
            delay: 300,
            opacity: 0.6,
            cursor: 'move',
            update: function() {
                var order = $('#sortablePanel').sortable('toArray'),
                    url = $("#sortablePanel").attr('data-url');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: 'Post',
                    cache: false,
                    dataType: 'json',
                    data: {
                        sorted_data: order
                    },
                    success: function(response) {
                        if (response.success == true) {

                        } else {
                            alert('fail');
                        }
                    },
                    error: function() {}
                }); //ajax


            }
        }).disableSelection();


        $(document).on('click', '.subcat-new-toggle', function(e) {
            e.preventDefault();

            var that = $(this);
            that.closest('.card-body').find('.table-subcat-new').toggle();
        });


        $(document).on('keyup', '.input-subcat-new', function(e) {
            e.preventDefault();
            if (e.key === 'Enter') {
                var that = $(this);
                url = that.attr('data-url'),
                    val = that.val();

                urls = url + '?name=' + val;

                // alert(urls);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                        url: urls,
                        type: 'GET',
                        // dataType: 'json',
                        // mimeType:"multipart/form-data",
                        // contentType: false,
                        // cache: false,
                        // processData:false,

                    }).done(function(response) {
                        // table.empty().append(response);
                        that.closest('.box-body').find('.subcat-area').empty().append(response);
                        that.val('').focus();
                    })
                    .fail(function() {
                        console.log("error");
                    });
            }
        });

        // $(document).on('click', '.btn-subcat-submit', function(e) {
        //     e.preventDefault();

        //     var that = $(this),
        //         url = that.closest('td').find('input').attr('data-url'),
        //         val = that.closest('td').find('input').val();

        //     urls = url + '?name=' + val;
        //     // alert(urls);
        //     $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //     $.ajax({
        //             url: urls,
        //             type: 'GET',
        //             // dataType: 'json',
        //             // mimeType:"multipart/form-data",
        //             // contentType: false,
        //             // cache: false,
        //             // processData:false,

        //         }).done(function(response) {
        //             // table.empty().append(response);
        //             // console.log(response);
        //             that.closest('.card-body').find('.subcat-area').empty().append(response);
        //             that.closest('td').find('input').val('').focus();
        //         })
        //         .fail(function() {
        //             alert("error");
        //         });

        // });

    });
</script>
@endpush
