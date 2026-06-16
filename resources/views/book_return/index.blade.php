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
                 @foreach ($returns as $return)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$return->loan_id}}</td>
                            <td>{{ isset($return->return_date) ? $return->return_date->format('Y-m-d') : '' }}</td>
                            <td>Rp{{$return->fine}}</td>
                            <td>{{ $return->user->name}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>

