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
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fa fa-plus"></i> Create Sub-facility</button>

                                <a href="{{ route('facility.list') }}" class="btn btn-sm btn-secondary"> <i class="fa fa-chevron-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th >Title</th>
                                    <th >Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr class="text-left align-middle">
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <div class="custom-control custom-switch mt-1" data-toggle="tooltip" title="Toggle status">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch{{$item->id}}" {{ ($item->status == 1) ? 'checked' : '' }} onchange="statusToggle('{{ route('subfacility.status', $item->id) }}')">
                                            <label class="custom-control-label" for="customSwitch{{$item->id}}"></label>
                                        </div>
                                    </td>
                                    <td class="d-flex text-right">
                                        <div class="btn-group">
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $item->id }}" class="btn btn-sm btn-dark" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="{{route('subfacility.delete', $item->id)}}" class="btn btn-sm btn-danger delete-btn" data-toggle="tooltip" title="Delete" data-id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                        <!--Edit Sub-Facility Modal -->
                                        <div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Sub Facility</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('subfacility.store.edit', $item->id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                            <input type="hidden" name="facility_id" value="{{$item->facility_id}}">
                                                            <div class="form-group" style="text-align: justify;">
                                                                <label for="title">Title *</label>
                                                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{$item->title}}" required>
                                                                @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
                                                            </div>
                                                            <div class="form-group" style="text-align: justify;">
                                                                <label for="title">Description *</label>
                                                                <textarea class="form-control" name="description" id="description" placeholder="Enter Description Here" required>{{$item->description}}</textarea>
                                                                @error('description') <p class="small text-danger">{{ $message }}</p> @enderror
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Sub Facility</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('subfacility.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="facility_id" value="{{$id}}">
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ old('title') }}">
                        @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Description *</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter Description Here">{{ old('description') }}</textarea>
                        @error('description') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function statusToggle(url) {
        fetch(url, { method: 'GET' })
            .then(response => {
                if (response.ok) {
                    location.reload(); 
                } else {
                    alert("Failed to update status. Please try again.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Something went wrong. Try again.");
            });
    }
</script>

@endsection