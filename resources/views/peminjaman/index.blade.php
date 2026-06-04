@extends('layouts.app')
@section('title', 'Book Loans')
@section('content')
<div class="data">
    <div class="header">
        <h2>Book Loans</h2>
        <a href="{{ route('peminjaman.create') }}" class="btn-tambah">+ Add Loan</a>
    </div>
    <div class="search-group">
        <form method="GET" action="{{route('peminjaman.index')}}">
            <input type="text" name="search" class="search"  placeholder="Search" value="{{ request('search') }}">
            <button type="submit" class="btn-search">🔍 Search</button>
        </form>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Student</td>
                    <td>Staff</td>
                    <td>Loan Date</td>
                    <td>Return Date</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                 @foreach ($peminjaman as $peminjamans)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $peminjamans->siswa->nama_siswa ?? $peminjamans->nis }}</td>
                            <td>{{ $peminjamans->users->name}}</td>
                            <td>{{ isset($peminjamans->tanggal_pinjam) ? $peminjamans->tanggal_pinjam->format('Y-m-d') : '' }}</td>
                            <td>{{ isset($peminjamans->tanggal_kembali) ? $peminjamans->tanggal_kembali->format('Y-m-d') : '' }}</td>
                            <td>{{ $peminjamans->status === 'dikembalikan' ? 'Returned' : ($peminjamans->status === 'dipinjam' ? 'Borrowed' : $peminjamans->status) }}</td>
                            <td class='table-action'>
                                    <a class='btn-edit' href="{{ route('peminjaman.edit', $peminjamans->id) }}"><i class="fas fa-edit mr-1"></i></a>
                                    <form action="{{ route('peminjaman.destroy', $peminjamans->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-hapus" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash mr-1"></i></button>
                                    </form>
                                    <a class="btn-detail" href="{{ url('detail?peminjaman_id='.$peminjamans->id) }}"><i class="fas fa-book mr-1"></i></a>
                                    
                                </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>