@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
    @include('alerts.alerts')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title">Add Category</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.addCategory') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Namee</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Category">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info form-control" value="Add Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title">All Categories</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Action</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php
                                    $i = ($categories->currentPage() - 1) * $categories->perPage() + 1;
                                    ?>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <div class="btn-group btn-sm">
                                                    <a onclick="return confirm('Are you sure? You want to delete this category?');"
                                                        href="{{ route('admin.deleteCategory', ['category' => $category->id]) }}"
                                                        class="btn text-danger btn-xs"><i class="fas fa-trash-alt fa-2x"
                                                            class="btn btn-primary"></i></a>
                                                    <a href="javascript:void(0)" class="btn text-warning btn-xs"
                                                        data-toggle="modal" data-target="#cat{{ $category->id }}"><i
                                                            class="far fa-edit fa-2x"></i></a>
                                                </div>
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if (isset($category->subcategories))
                                                    <ul class="subcatUL">
                                                        @foreach ($category->subcategories as $subcat)
                                                            <li>{{ $subcat->name }}</li>
                                                        @endforeach
                                                        <button class="addmoreBTN" type="button"
                                                            data-id="{{ $category->id }}">Add More</button>

                                                    </ul>
                                                @endif
                                            </td>
                                            <td>{{ $category->created_at }}</td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="cat{{ $category->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('admin.updateCategory', ['category' => $category->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="name">Category Name</label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control" value="{{ $category->name }}">
                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="submit" class="btn btn-info form-control"
                                                                    value="Update Category">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    @empty

                                        <tr>
                                            <td class="text-center text-danger h3" colspan="4">No Category Found </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.addmoreBTN').on('click', function() {
                var that = $(this);
                var cat_id = that.attr('data-id');
                var html = '<input type="text" name="subcat" id="subcat" class="subcatInput">';
                that.closest('.subcatUL').append(html);
                that.addClass('submit').removeClass('addmoreBTN');
                that.text('submit')
                console.log(that.attr('class'))
            });
           
          
        });
        $('.subcatInput').on('onkeydown',function(){
               alert('hello');
               console.log('Hello');
           })

            $(".subcatInput").on('keyup', function(event) {
                alert('Hello')
                if (event.keyCode === 13) {
                    alert('Hello')
                    var that = $(this);
                    var cat_id = that.closest('button').attr('data-id');
                    alert(cat_id);
                }
            });
    </script>
@endpush
