<div class="form-group">
    <div>
        <label for="student_id">Student <span>*</span></label>
        <select name="student_id">
            <option value="">-- Select Student --</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}" {{ old('student_id', $loan->student_id ?? '') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
        @error('student_id')<div>{{ $message }}</div>@enderror
    </div>
</div>

<div class="form-group">
    <label for="return_date">Return Date</label>
    <input type="date" name="return_date" id="return_date" value="{{ old("return_date", isset($loan) ? $loan->return_date->format('Y-m-d') : '') }}">
</div>

<div class="form-group">
    <label>Book Details</label>
    <table id="details-table" style="width:100%">
        <thead>
            <tr>
                <th>Book</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $books = App\Models\Book::all(); @endphp
            @if(old('details'))
                @foreach(old('details') as $i => $d)
                    <tr>
                        <td>
                            <select name="details[{{ $i }}][book_id]">
                                <option value="">-- Select Book --</option>
                                @foreach($books as $b)
                                    <option value="{{ $b->id }}" {{ ($d['book_id'] ?? '') == $b->id ? 'selected' : '' }}>{{ $b->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="details[{{ $i }}][quantity]" value="{{ $d['quantity'] ?? 1 }}" min="1"></td>
                        <td><button type="button" class="remove-row">Remove</button></td>
                    </tr>
                @endforeach
            @else
                @if(isset($loan) && $loan->details->count())
                    @foreach($loan->details as $i => $det)
                        <tr>
                            <td>
                                <select name="details[{{ $i }}][book_id]">
                                    <option value="">-- Select Book --</option>
                                    @foreach($books as $b)
                                        <option value="{{ $b->id }}" {{ $det->book_id == $b->id ? 'selected' : '' }}>{{ $b->title }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="details[{{ $i }}][id]" value="{{ $det->id }}">
                                <input type="hidden" name="details[{{ $i }}][status]" value="{{ $det->status ?? 'borrowed' }}">
                            </td>
                            <td><input type="number" name="details[{{ $i }}][quantity]" value="{{ $det->quantity }}" min="1"></td>
                            <td><button type="button" class="remove-row">Remove</button></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <select name="details[0][book_id]">
                                <option value="">-- Select Book --</option>
                                @foreach($books as $b)
                                    <option value="{{ $b->id }}">{{ $b->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="details[0][quantity]" value="1" min="1"></td>
                        <td><button type="button" class="remove-row">Remove</button></td>
                    </tr>
                @endif
            @endif
        </tbody>
    </table>
    <button type="button" id="add-row">Add Row</button>
</div>

<button type="submit" class="btn-submit">Save</button>
<a href="{{ route('loan.index') }}" class="btn-back">Back</a>

<script>
document.addEventListener('click', function(e){
    if(e.target && e.target.id === 'add-row'){
        const tbody = document.querySelector('#details-table tbody');
        const index = tbody.querySelectorAll('tr').length;
        const tr = document.createElement('tr');
        const books = `@foreach($books as $b)<option value="{{ $b->id }}">{{ $b->title }}</option>@endforeach`;
        tr.innerHTML = `<td><select name="details[${index}][book_id]"><option value="">-- Select Book --</option>${books}</select></td><td><input type="number" name="details[${index}][quantity]" value="1" min="1"></td><td><button type="button" class="remove-row">Remove</button></td>`;
        tbody.appendChild(tr);
    }

    if(e.target && e.target.classList && e.target.classList.contains('remove-row')){
        const tr = e.target.closest('tr');
        tr.parentNode.removeChild(tr);
    }
});
</script>
