@extends('layouts.app')
@section('title', 'Student List')

@section('content')
<div class="data">
    <div class="header">
        <h2>Student List</h2>
        <a href="{{ route('siswa.create') }}" class="btn-tambah">+ Add Student</a>
    </div>
    <div class="search-group">
        <form method="GET" action="{{route('siswa.index')}}">
            <input type="text" name="search" class="search"  placeholder="Search" value="{{ request('search') }}">
            <button type="submit" class="btn-search">🔍 Search</button>
        </form>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>NIS</td>
                    <td>Student Name</td>
                    <td>Class</td>
                    <td>Major</td>
                    <td>Phone</td>
                    <td>Email</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                 @foreach ($siswa as $siswas)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$siswas->nis}}</td>
                            <td>{{$siswas->nama_siswa}}</td>
                            <td>{{$siswas->kelas}}</td>
                            <td>{{$siswas->jurusan}}</td>
                            <td>{{$siswas->no_hp}}</td>
                            <td>{{$siswas->email}}</td>
                            <td class='table-action'>
                                    <a class='btn-edit' href="{{ route('siswa.edit', $siswas->id) }}" text-decoration:none;'><i class="fas fa-edit mr-1"></i></a> 
                                    <form action="{{ route('siswa.destroy', $siswas->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash mr-1"></i></button>
                                </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>