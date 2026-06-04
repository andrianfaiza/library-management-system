@extends('layouts.app')
@section('title', 'Loan Details')
@section('content')
<div class="data">
    <a href="{{ url()->previous() }}" class="return">
        <i class="fas fa-arrow-left mr-2"></i> Return
    </a>
    <h2>Book Loan Details</h2>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Loan ID</td>
                    <td>Book</td>
                    <td>Quantity</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                 @foreach ($detail as $details)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$details->peminjaman_id}}</td>
                            <td>{{ $details->book->judul_buku ?? $details->book_id }}</td>
                            <td>{{$details->jumlah}}</td>
                            <td class='table-action'>
                                @if(($details->status ?? 'dipinjam') === 'dikembalikan')
                                    <span class="badge">Returned</span>
                                @else
                                    <form action="{{ route('detail.kembalikan', $details->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="btn-dikembalikan" onclick="return confirm('Return this book?')">Return</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>