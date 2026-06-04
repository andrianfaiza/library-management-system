<div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" placeholder="Enter ISBN" required value="{{ old('isbn', $book->isbn ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="judul_buku">Book Title</label>
                    <input type="text" id="judul_buku" name="judul_buku" placeholder="Enter book title" required value="{{ old('judul_buku', $book->judul_buku ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="penerbit">Publisher</label>
                    <input type="text" id="penerbit" name="penerbit" placeholder="Enter publisher" required value="{{ old('penerbit', $book->penerbit ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="tahun_terbit">Publication Year</label>
                    <input type="text" id="tahun_terbit" name="tahun_terbit" placeholder="Enter publication year" required value="{{ old('tahun_terbit', $book->tahun_terbit ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="pengarang">Author</label>
                    <input type="text" id="pengarang" name="pengarang" placeholder="Enter author" required value="{{ old('pengarang', $book->pengarang ?? '') }}">
                </div>

                <div class="form-group">
                    <div>
                        <label for="rak_id">Shelf <span>*</span></label>
                        <select name="rak_id">
                                    <option value="">-- Select Shelf --</option>
                                    @foreach($rak as $raks)
                                        <option value="{{ $raks->id }}"
                                            {{ old('rak_id', $book->rak_id ?? '') == $raks->id ? 'selected' : '' }}>
                                            {{ $raks->nama_rak }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rak_id')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                <div class="form-group">
                    <label for="jumlah">Quantity</label>
                    <input type="number" id="jumlah" name="jumlah" placeholder="Enter quantity" value="{{ old('jumlah', $book->jumlah ?? '') }}" required>
                </div>

                <button type="submit" class="btn-submit">Save</button>
                <a href="{{ route('book.index') }}" class="btn-back">Back</a>