@extends('layouts.app')
@section('title', 'Shelf List')
@section('content')
<div class="data">
    <div class="header">
        <h2>Shelf List</h2>
        @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('rack.create') }}" class="btn-tambah">+ Add Shelf</a>
        @endif
    </div>
    <div class="search-group">
        <form method="GET" action="{{route('rack.index')}}">
            <input type="text" name="search" class="search"  placeholder="Search" value="{{ request('search') }}">
            <button type="submit" class="btn-search">🔍 Search</button>
        </form>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Shelf Name</td>
                    <td>Location</td>
                    <td>Capacity</td>
                    @if(auth()->user()->hasRole('admin'))
                    <td>Actions</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                 @foreach ($racks as $rack)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$rack->name}}</td>
                            <td>{{$rack->location}}</td>
                            <td>{{$rack->capacity}}</td>
                            @if(auth()->user()->hasRole('admin'))
                            <td class="table-action">
                                <a class="btn-edit" href="{{ route('rack.edit', $rack->id) }}"><i class="fas fa-edit mr-1"></i></a>
                                <form action="{{ route('rack.destroy', $rack->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash mr-1"></i></button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
