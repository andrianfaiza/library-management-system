<div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" placeholder="Enter ISBN" required value="{{ old('isbn', $book->isbn ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="title">Book Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter book title" required value="{{ old('title', $book->title ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <input type="text" id="publisher" name="publisher" placeholder="Enter publisher" required value="{{ old('publisher', $book->publisher ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="publication_year">Publication Year</label>
                    <input type="text" id="publication_year" name="publication_year" placeholder="Enter publication year" required value="{{ old('publication_year', $book->publication_year ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author" placeholder="Enter author" required value="{{ old('author', $book->author ?? '') }}">
                </div>

                <div class="form-group">
                    <div>
                        <label for="rack_id">Shelf <span>*</span></label>
                        <select name="rack_id">
                                    <option value="">-- Select Shelf --</option>
                                    @foreach($racks as $rack)
                                        <option value="{{ $rack->id }}"
                                            {{ old('rack_id', $book->rack_id ?? '') == $rack->id ? 'selected' : '' }}>
                                            {{ $rack->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rack_id')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" value="{{ old('quantity', $book->quantity ?? '') }}" required>
                </div>

                <button type="submit" class="btn-submit">Save</button>
                <a href="{{ route('book.index') }}" class="btn-back">Back</a>