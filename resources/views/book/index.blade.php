@extends('layouts.app')
@section('title', 'Book List')
@section('content')
<div class="data">
   <div class="header">
        <h2>Book List</h2>
        <a href="{{ route('book.create') }}" class="btn-tambah">+ Add Book</a>
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
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                 @foreach ($book as $book)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->judul_buku}}</td>
                            <td>{{$book->penerbit}}</td>
                            <td>{{$book->tahun_terbit}}</td>
                            <td>{{$book->pengarang}}</td>
                            <td>{{$book->rak->nama_rak ?? $book->rak_id}}</td>
                            <td>{{$book->jumlah}}</td>
                            <td class='table-action'>
                                    <a class='btn-edit' href="{{ route('book.edit', $book->id) }}" text-decoration:none;'><i class="fas fa-edit mr-1"></i></a> 
                                    <form action="{{ route('book.destroy', $book->id) }}" method="POST" style="display:inline">
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