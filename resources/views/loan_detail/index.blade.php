@extends('layouts.app')
@section('title', 'Loan Details')
@section('content')
<div class="data">
    <a href="{{ route('loan.index') }}" class="return">
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
                 @foreach ($details as $detail)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$detail->loan_id}}</td>
                            <td>{{ $detail->book->title ?? $detail->book_id }}</td>
                            <td>{{$detail->quantity}}</td>
                            <td class='table-action'>
                                @if(($detail->status ?? 'borrowed') === 'done')
                                    <span class="badge">Returned</span>
                                @else
                                    <form action="{{ route('loan-detail.return', $detail->id) }}" method="POST" style="display:inline">
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
