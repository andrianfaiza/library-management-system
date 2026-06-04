@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="card-group">
    <div class="card1">
        <i class="fas fa-book fa-5x me-3 text-blue"></i>
        <div class="text">
            <div class="total">
                <span>{{ $totalBooks}}</span>
                <p>Books</p>
            </div>
        </div>
    </div>
    <div class="card2">
        <i class="fas fa-user-graduate fa-5x me-3"></i>
        <div class="text">
            <span>{{ $totalSiswa}}</span>
            <p>Students</p>
        </div>
    </div>
    <div class="card3">
        <i class="fas fa-book-reader fa-5x me-3"></i>
        <div class="text">
            <span>{{ $totalPinjam}}</span>
            <p>Loans</p>
        </div>
    </div>
</div>