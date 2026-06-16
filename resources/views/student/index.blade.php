@extends('layouts.app')
@section('title', 'Student List')

@section('content')
<div class="data">
    <div class="header">
        <h2>Student List</h2>
        @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('student.create') }}" class="btn-tambah">+ Add Student</a>
        @endif
    </div>
    <div class="search-group">
        <form method="GET" action="{{route('student.index')}}">
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
                    @if(auth()->user()->hasRole('admin'))
                    <td>Actions</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                 @foreach ($students as $student)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$student->nis}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->class}}</td>
                            <td>{{$student->major}}</td>
                            <td>{{$student->phone_number}}</td>
                            <td>{{$student->email}}</td>
                            @if(auth()->user()->hasRole('admin'))
                            <td class='table-action'>
                                    <a class='btn-edit' href="{{ route('student.edit', $student->id) }}" text-decoration:none;'><i class="fas fa-edit mr-1"></i></a> 
                                    <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash mr-1"></i></button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
