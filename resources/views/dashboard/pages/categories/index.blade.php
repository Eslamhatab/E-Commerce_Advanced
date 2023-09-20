@extends('dashboard.layouts.master')
@section('title' , 'Categories')
@section('main-content')
<!-- Bordered table -->
<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>deleted_at</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        {{-- <td>
        <div class="progress progress-sm" style="height:3px">
            <div class="progress-bar" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        </td> --}}
        <td>{{ $category->title }}</td>
        <td>{{ $category->description }}</td>
        <td>{{ $category->created_at }}</td>
        <td>{{ $category->updated_at }}</td>
        <td>{{ $category->deleted_at }}</td>
    </tr>

    @empty

    @endforelse
    </tbody>
    {{-- <div class="my-4">
        {{$categories->links()}}
    </div> --}}
</table>
<div class="my-4">
    {{$categories->links()}}
</div>
@endsection
