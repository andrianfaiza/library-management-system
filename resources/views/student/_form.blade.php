<div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" id="nis" name="nis" placeholder="Enter NIS" required value="{{ old('nis', $student->nis ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter student name"  value="{{ old("name", $student->name ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="text" id="class" name="class" placeholder="Enter class" required value="{{ old("class", $student->class ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="major">Major</label>
                    <input type="text" id="major" name="major" placeholder="Enter major" required value="{{ old("major", $student->major ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Enter phone number" required value="{{ old("phone_number", $student->phone_number ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter email" required value="{{ old('email', $student->email ?? '') }}">
                </div>

                <button type="submit" class="btn-submit">Save</button>
                <a href="{{ route('student.index') }}" class="btn-back">Back</a>
