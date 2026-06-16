<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Loan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container1">
        <div class="form-container">
            <h2>Edit Loan</h2>
            <form action="{{ route('loan.update', $loan->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('loan._form')

            </form>
        </div>
    </div>
</body>
</html>
