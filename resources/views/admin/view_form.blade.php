@extends('layouts.app')
@section('content')
    <div>
        <h2 class="mb-4">Admission Application List</h2>
        <div class="card-header">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <form action="" method="get">
                        <div class="d-flex justify-content-end">
                            <div class="form-group ml-2">
                                <lable class="text-sm">Start Date</lable>
                                <input type="datetime-local" class="form-control form-control-sm" name="start_date" id="start_date" value="{{ request()->input('start_date')}}">
                            </div>
                            <div class="form-group ml-2">
                                <lable class="text-sm">End Date</lable>
                                <input type="datetime-local" class="form-control form-control-sm" name="end_date" id="end_date" value="{{ request()->input('end_date')}}">
                            </div>
                            <div class="form-group ml-2 mt-4">
                                 <lable class=""></lable>
                                <input type="search" style="width: 250px;" class="form-control form-control-sm" name="keyword" id="keyword" value="{{ request()->input('keyword') }}" placeholder="Search something...">
                            </div>
                            <div class="form-group ml-2 mt-4">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-filter"></i>
                                    </button>
                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-light" data-toggle="tooltip" title="Clear filter">
                                        <i class="fa fa-times"></i>
                                    </a>
                                     {{-- <a href="{{ route('admin.admission.application.export', ['start_date' => request()->input('start_date'), 'end_date' => request()->input('end_date'), 'keyword' => request()->input('keyword')]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Export Data">
                                        Export
                                     </a> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Dob</th>
                    <th>Class</th>
                    <th>Parent name</th>
                    <th>Country_code</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Pin Code</th>
                    <th>UTM Term</th>
                    <th>UTM content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admissions as $admission)
                <tr>
                    <td>{{ $admission->name }}</td>
                    <td>{{ $admission->dob }}</td>
                    <td>{{ $admission->class }}</td>
                    <td>{{ $admission->parent_name }}</td>
                    <td>{{ $admission->country_code }}</td>
                    <td>{{ $admission->mobile }}</td>
                    <td>{{ $admission->email }}</td>
                    <td>{{ $admission->pincode }}</td>
                    <td>{{ $admission->utm_term }}</td>
                    <td>{{ $admission->utm_content }}</td>
                    <td>
                        <a href="{{ route('edit.form', $admission->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                        <form action="{{route('delete.form', $admission->id)}}" method="POST" style="display:inline-block;">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection