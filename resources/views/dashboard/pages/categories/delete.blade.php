@extends('dashboard.layouts.master')
@section('title' , 'Deleted Categories')
@section('main-content')
<!-- Bordered table -->
<table class="table table-hover table-bordered @if($categories_count == 0) d-none @endif">
    <thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>deleted_at</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        {{-- <td>
            <div class="progress progress-sm" style="height:3px">
                <div class="progress-bar" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </td> --}}
        <td>{{ $category->title }}</td>
        <td>{{ $category->description ?? 'N/A' }}</td>
        <td>{{ $category->created_at }}</td>
        <td>{{ $category->updated_at ?? 'N/A' }}</td>
        <td>{{ $category->deleted_at ?? 'N/A' }}</td>
        <td class="text-light">
            <div class="d-flex justify-content-between aligin-items-center">
                <form action="{{ route('categories.restore', $category->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-success btn-md font-weight-bold fs-6">Delete</button>
                </form>
                <form action="{{ route('categories.forceDelete', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-md font-weight-bold fs-6">Delete</button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <div class="alert alert-danger text-center my-5 w-75 mx-auto">
        <span class="h6">There are no deleted categories yet! <a href="{{ route('categories.create') }}" class="fw-bold text-dark">Add categories from here</a>.</span>
    </div>
    @endforelse
    </tbody>
</table>
<div class="my-4">
    {{$categories->links()}}
</div>
@endsection
