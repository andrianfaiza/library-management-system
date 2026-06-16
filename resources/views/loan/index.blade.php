@extends('layouts.app')
@section('title', 'Book Loans')
@section('content')
<div class="data">
    <div class="header">
        <h2>Book Loans</h2>
        <a href="{{ route('loan.create') }}" class="btn-tambah">+ Add Loan</a>
    </div>
    <div class="search-group">
        <form method="GET" action="{{route('loan.index')}}">
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
                 @foreach ($loans as $loan)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $loan->student->name ?? $loan->student_id }}</td>
                            <td>{{ $loan->user->name}}</td>
                            <td>{{ isset($loan->loan_date) ? $loan->loan_date->format('Y-m-d') : '' }}</td>
                            <td>{{ isset($loan->return_date) ? $loan->return_date->format('Y-m-d') : '' }}</td>
                            <td>{{ in_array($loan->status, ['dikembalikan', 'done', 'selesai']) ? 'Returned' : (in_array($loan->status, ['dipinjam', 'borrowed']) ? 'Borrowed' : ucfirst($loan->status)) }}</td>
                            <td class='table-action'>
                                    <a class='btn-edit' href="{{ route('loan.edit', $loan->id) }}"><i class="fas fa-edit mr-1"></i></a>
                                    <form action="{{ route('loan.destroy', $loan->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-hapus" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash mr-1"></i></button>
                                    </form>
                                    <a class="btn-detail" href="{{ route('loan-detail.index', ['loan_id' => $loan->id]) }}"><i class="fas fa-book mr-1"></i></a>
                                    
                                </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
