@extends('admin.layouts.adminMaster')
@push('css')
    
@endpush
@section('content')
<div class="container-fluid">
   <div class="card">
       <div class="card-header">
           <div class="card-title">
           {{ $post->title }}
           </div>
       </div>
       <div class="card-body">
           <p><b>Excerpt: </b>  {{ $post->excerpt }}</p>
           <p class="pl-3"><b>Description: </b>{!! $post->description !!}</p>
           <p><b>tags: </b>@if ($post->tags)
            @foreach ($post->tags as $item)
                <span class="badge badge-info">{{ $item }}</span>
            @endforeach
           @endif</p>
           <p><b>Category: </b>@if ($post->categories)
               @foreach ($post->categories as $item)
                   <span class="badge badge-success">{{ $item->name }}</span>
               @endforeach
           @endif</p>
          
       </div>
   </div>
</div>
@endsection
@push('js')
    
@endpush