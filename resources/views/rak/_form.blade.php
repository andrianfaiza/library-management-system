<div class="form-group">
                    <label for="nama_rak">Shelf Name</label>
                    <input type="text" id="nama_rak" name="nama_rak" placeholder="Enter shelf name" required value="{{ old('nama_rak', $rak->nama_rak ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="lokasi">Location</label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Enter location"  value="{{ old('lokasi', $rak->lokasi ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="kapasitas">Capacity</label>
                    <input type="number" id="kapasitas" name="kapasitas" placeholder="Enter capacity" required value="{{ old('kapasitas', $rak->kapasitas ?? '') }}">
                </div>

                <button type="submit" class="btn-submit">Save</button>
                <a href="{{ route('rak.index') }}" class="btn-back">Back</a>