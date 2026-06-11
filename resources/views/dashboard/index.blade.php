@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="data1">
    
    <div style="margin-bottom: 35px; animation: fadeIn 0.5s ease-out;">
        <h1 style="font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 8px; letter-spacing: -0.03em;">Welcome Back, Admin! 👋</h1>
    <p style="color: #64748b; font-size: 15px; font-weight: 500;">Here is a quick summary of the E-Library system status today.</p>
</div>

<div class="card-group" style="animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);">
    <div class="card1" onclick="window.location='{{ route('book.index') }}'">
        <i class="fas fa-book"></i>
        <div class="text">
            <span>{{ $totalBooks }}</span>
            <p>Total Books</p>
        </div>
    </div>
    
    <div class="card2" onclick="window.location='{{ route('siswa.index') }}'">
        <i class="fas fa-user-graduate"></i>
        <div class="text">
            <span>{{ $totalSiswa }}</span>
            <p>Active Students</p>
        </div>
    </div>
    
    <div class="card3" onclick="window.location='{{ route('peminjaman.index') }}'">
        <i class="fas fa-book-reader"></i>
        <div class="text">
            <span>{{ $totalPinjam }}</span>
            <p>Active Loans</p>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</div>
@endsection