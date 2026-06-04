<div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" id="nis" name="nis" placeholder="Enter NIS" required value="{{ old('nis', $siswa->nis ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="nama_siswa">Student Name</label>
                    <input type="text" id="nama_siswa" name="nama_siswa" placeholder="Enter student name"  value="{{ old('nama_siswa', $siswa->nama_siswa ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="kelas">Class</label>
                    <input type="text" id="kelas" name="kelas" placeholder="Enter class" required value="{{ old('kelas', $siswa->kelas ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="jurusan">Major</label>
                    <input type="text" id="jurusan" name="jurusan" placeholder="Enter major" required value="{{ old('jurusan', $siswa->jurusan ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="no_hp">Phone Number</label>
                    <input type="text" id="no_hp" name="no_hp" placeholder="Enter phone number" required value="{{ old('no_hp', $siswa->no_hp ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter email" required value="{{ old('email', $siswa->email ?? '') }}">
                </div>

                <button type="submit" class="btn-submit">Save</button>
                <a href="{{ route('siswa.index') }}" class="btn-back">Back</a>