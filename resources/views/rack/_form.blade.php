<div class="form-group">
                    <label for="name">Shelf Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter shelf name" required value="{{ old("name", $rack->name ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter location"  value="{{ old("location", $rack->location ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="capacity">Capacity</label>
                    <input type="number" id="capacity" name="capacity" placeholder="Enter capacity" required value="{{ old("capacity", $rack->capacity ?? '') }}">
                </div>

                <button type="submit" class="btn-submit">Save</button>
                <a href="{{ route('rack.index') }}" class="btn-back">Back</a>
