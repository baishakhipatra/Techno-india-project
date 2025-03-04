@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <h2 class="mb-4">Facility List</h2>
    <div class="row mb-3">
        <div class="col-md-12 text-right">
            <a href="{{ route('facility.create') }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Create</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <form action="" method="get">
                <div class="d-flex justify-content-end">
                    <div class="form-group ml-2">
                        <input type="search" class="form-control form-control-sm" name="keyword" id="keyword" value="{{ request()->input('keyword') }}" placeholder="Search something...">
                    </div>

                    <div class="form-group ml-2">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-filter"></i>
                            </button>
                            <a href="{{ url()->current() }}" class="btn btn-sm btn-light" data-toggle="tooltip" title="Clear filter">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
   <table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Logo</th>
            <th>Image</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
         <tr class="text-left align-middle">
            <td>{{ $item->title }}</td>
            <td><img src="{{asset($item->logo)}}" alt="No Logo" srcset="" height="60px" width="60px" class="img-thumbnail" title="{{ $item->title }}'s Logo"></td>
            <td><img src="{{asset($item->image)}}" alt="No Image" srcset="" height="80px" width="80px" class="img-thumbnail" title="{{ $item->title }}'s Image"></td>
            {{-- <td>{{ $item->title }}</td> --}}
            <td>{{ Str::limit($item->description, 100) }}</td>

            <td> 
                <div class="custom-control custom-switch mt-1" data-toggle="tooltip" title="Toggle status">
                <input type="checkbox" class="custom-control-input" id="customSwitch{{$item->id}}" {{ ($item->status == 1) ? 'checked' : '' }} onchange="statusToggle('{{ route('facility.status', $item->id) }}')">
                <label class="custom-control-label" for="customSwitch{{$item->id}}"></label>
            </div>
            </td>
            <td class="d-flex text-right">
                <div class="btn-group">
                    <a href="{{ route('subfacility.list', $item->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Sub facilities">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a href="{{ route('facility.edit', $item->id) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>

                    {{-- <form action="{{route('facility.delete',$item->id)}}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger delete-btn" data-toggle="tooltip" title="Delete" data-id="{{ $item->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form> --}}

                    <form action="{{route('facility.delete',$item->id)}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this facility?')">
                        <i class="fa fa-trash"></i>
                        </button>
                    </form>


                    <script>
                        document.querySelectorAll('.delete-btn').forEach(button => {
                            button.addEventListener('click', function() {
                                if (confirm('Are you sure you want to delete this Post?')) {
                                    this.closest('form').submit();
                                }
                            });
                        });
                    </script>
                </div>
            </td>
         </tr>
       
        @endforeach
    </tbody>
   </table>
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


