@extends('layouts.app')
@section('title', 'Book List')
@section('content')
<div class="data">
   <div class="header">
        <h2>Book List</h2>
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('book.create') }}" class="btn-tambah">+ Add Book</a>
        @endif
    </div>
    <div class="search-group">
        <form method="GET" action="{{route('book.index')}}">
            <input type="text" name="search" class="search"  placeholder="Search" value="{{ request('search') }}">
            <button type="submit" class="btn-search">🔍 Search</button>
        </form>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>ISBN</td>
                    <td>Title</td>
                    <td>Publisher</td>
                    <td>Publication Year</td>
                    <td>Author</td>
                    <td>Shelf Name</td>
                    <td>Quantity</td>
                    @if(auth()->user()->hasRole('admin'))
                    <td>Actions</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                 @foreach ($books as $book)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->publisher}}</td>
                            <td>{{$book->publication_year}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->rack->name ?? $book->rack_id}}</td>
                            <td>{{$book->quantity}}</td>
                            @if(auth()->user()->hasRole('admin'))
                                <td class='table-action'>
                                        <a class='btn-edit' href="{{ route('book.edit', $book->id) }}" text-decoration:none;'><i class="fas fa-edit mr-1"></i></a> 
                                        <form action="{{ route('book.destroy', $book->id) }}" method="POST" style="display:inline">
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