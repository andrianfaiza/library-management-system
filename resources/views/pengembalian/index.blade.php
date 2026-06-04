@extends('layouts.app')
@section('title', 'Book Returns')
@section('content')
<div class="data">
    
    <h2>Returned Books</h2>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Loan ID</td>
                    <td>Return Date</td>
                    <td>Fine</td>
                    <td>Staff</td>
                </tr>
            </thead>
            <tbody>
                 @foreach ($pengembalian as $pengembalians)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$pengembalians->peminjaman_id}}</td>
                            <td>{{ isset($pengembalians->tanggal_dikembalikan) ? $pengembalians->tanggal_dikembalikan->format('Y-m-d') : '' }}</td>
                            <td>Rp{{$pengembalians->denda}}</td>
                            <td>{{ $pengembalians->users->name}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>