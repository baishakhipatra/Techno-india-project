@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5px">#</th>
                                    <th>Image/Video path</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $index => $item)
                                    <tr class="text-left align-middle">
                                        <td>{{ $index+1}}</td>
                                        <td>
                                            @if($item->image)
                                                <img src="{{asset($item->image)}}" alt="No Image" srcset="" height="75px" width="75px" class="img-thumbnail">
                                            @else
                                            <a href="{{$item->video}}" class="btn btn-primary btn-sm" target="_blank">Video Path</a>
                                            @endif
                                        </td>
                                        
                                        <td class="d-flex text-right">
                                            <div class="btn-group">
                                                <a href="{{ route('gallery.edit', $item->id) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{route('gallery.delete', $item->id)}}" class="btn btn-sm btn-danger delete-btn" data-toggle="tooltip" title="Delete" data-id="{{ $item->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
@endsection

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var itemId = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'gallery/delete/' + itemId; 
                }
            });
        });
    });
</script>