@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Subject List</h2>
    <div class="row mb-3">
        <div class="col-md-12 text-right">
            <a href="{{ route('create.list') }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Create</a>
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
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subject as $sub)
        <tr>
            <td>{{ $sub->title }}</td>
            <td>
                <div class="custom-control custom-switch mt-1" data-toggle="tooltip" title="Toggle status">
                <input type="checkbox" class="custom-control-input" id="customSwitch{{$sub->id}}" onchange="changeStatus('{{$sub->id}}', '{{$sub->status}}')" {{ ($sub->status == 1) ? 'checked' : '' }} />
                <label class="custom-control-label" for="customSwitch{{$sub->id}}"></label>
                </div>
            </td>
            <td class="d-flex text-right">
                <div class="btn-group">

                    <a href="{{ route('edit.sub', $sub->id) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{route('delete.sub',$sub->id)}}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger delete-btn" data-toggle="tooltip" title="Delete" data-id="{{ $sub->id }}">
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
 function changeStatus (id, status) {
 if (confirm("Are you sure you want to change the status?")) {
 $.ajax({
 url: "{{route('sub.toggle-status')}}",
 type: 'post',
 data: {
 'id' : id,
 'status': status,
 '_token': '{{ csrf_token() }}'
 },
 success: function(response) {
 const responseData = JSON.parse(response);
 alert(responseData.message);
 }
 });
 }
 }
</script> 

@endsection
