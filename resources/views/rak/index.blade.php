@extends('layouts.app')
@section('title', 'Shelf List')
@section('content')
<div class="data">
    <div class="header">
        <h2>Shelf List</h2>
        <a href="{{ route('rak.create') }}" class="btn-tambah">+ Add Shelf</a>
    </div>
    <div class="search-group">
        <form method="GET" action="{{route('rak.index')}}">
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
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                 @foreach ($rak as $raks)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$raks->nama_rak}}</td>
                            <td>{{$raks->lokasi}}</td>
                            <td>{{$raks->kapasitas}}</td>
                            <td class="table-action">
                                <a class="btn-edit" href="{{ route('rak.edit', $raks->id) }}"><i class="fas fa-edit mr-1"></i></a>
                                <form action="{{ route('rak.destroy', $raks->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash mr-1"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>