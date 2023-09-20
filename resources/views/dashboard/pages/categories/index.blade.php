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
    @forelse ($collection as $item)
    <tr>
        <td>{{ $categories }}</td>
        {{-- <td>
        <div class="progress progress-sm" style="height:3px">
            <div class="progress-bar" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        </td> --}}
        <td></td>
        <td>Barry Bright</td>
        <td>Donec Corporation</td>
        <td>662-5410 Eu Ave</td>
        <td>Jun 22, 2020</td>
    </tr>

    @empty

    @endforelse
    </tbody>
</table>
@endsection
