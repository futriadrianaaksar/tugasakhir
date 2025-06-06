<div align="center">
    <h2 style="margin:0; font-size:3em; color:#333;">Sistem Manajemen Perpustakaan </h2>
    <img src="/public/Unsulbar Logo (2).png" alt="Logo Explore Mandar" style="display:block; margin:1em auto; max-width:80%; height:auto;" />
    <h2 style="margin:0; font-size:2em; color:#333;">Futri Adriana Aksar</h2>
    <h2 style="margin:0; font-size:2em; color:#333;">D0223009</h2>
    <h2 style="margin:0; font-size:2em; color:#333;">FRAMEWORK WEB BASED</h2>
    <h2 style="margin-top:0.5em; font-size:2em; color:#333;">2025</h2>
  </div>

    <h2>Role dan Fitur-fiturnya</h2>
    <table>
        <thead>
            <tr>
                <th>Role</th>
                <th>Fitur</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Admin</td>
                <td>Mengelola data pengguna (admin, petugas, anggota) dan aturan denda.</td>
            </tr>
            <tr>
                <td>Petugas</td>
                <td>Melayani peminjaman buku, mencatat status pinjam/kembali.</td>
            </tr>
            <tr>
                <td>Anggota</td>
                <td>Melihat daftar buku, melakukan peminjaman, dan pengembalian.</td>
            </tr>
        </tbody>
    </table>

    <h2>Tabel-tabel Database</h2>

    <h3>Tabel 1: User</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Field</th>
                <th>Tipe Data</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>id</td><td>INT AUTO_INCREMENT</td><td>ID unik pengguna</td></tr>
            <tr><td>name</td><td>VARCHAR(255)</td><td>Nama pengguna</td></tr>
            <tr><td>email</td><td>VARCHAR(255) UNIQUE</td><td>Email</td></tr>
            <tr><td>password</td><td>VARCHAR(255)</td><td>Password (di-hash)</td></tr>
            <tr><td>role</td><td>ENUM('admin','petugas','anggota')</td><td>Peran pengguna</td></tr>
            <tr><td>created_at</td><td>timestamps</td><td>Tanggal data dibuat</td></tr>
            <tr><td>updated_at</td><td>timestamps</td><td>Tanggal data diperbarui</td></tr>
        </tbody>
    </table>

    <h3>Tabel 2: Books</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Field</th>
                <th>Tipe Data</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>id</td><td>INT AUTO_INCREMENT</td><td>ID unik buku</td></tr>
            <tr><td>title</td><td>VARCHAR(255)</td><td>Judul buku</td></tr>
            <tr><td>author</td><td>VARCHAR(255)</td><td>Nama penulis</td></tr>
            <tr><td>isbn</td><td>VARCHAR(255) UNIQUE</td><td>Nomor ISBN buku</td></tr>
            <tr><td>stock</td><td>INT</td><td>Stok buku tersedia</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td>Tanggal data dibuat</td></tr>
            <tr><td>updated_at</td><td>timestamps</td><td>Tanggal data diperbarui</td></tr>
        </tbody>
    </table>

    <h3>Tabel 3: Loans</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Field</th>
                <th>Tipe Data</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>id</td><td>INT AUTO_INCREMENT</td><td>ID unik peminjaman</td></tr>
            <tr><td>user_id</td><td>FOREIGN KEY</td><td>ID pengguna yang meminjam buku (FK ke tabel user)</td></tr>
            <tr><td>book_id</td><td>INT</td><td>ID buku yang dipinjam (FK ke tabel books)</td></tr>
            <tr><td>loan_date</td><td>DATE</td><td>Tanggal pinjam</td></tr>
            <tr><td>return_due_date</td><td>DATE</td><td>Tanggal jatuh tempo</td></tr>
            <tr><td>status</td><td>ENUM('dipinjam','dikembalikan')</td><td>Status peminjaman</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td>Tanggal data dibuat</td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td>Tanggal data diperbarui</td></tr>
        </tbody>
    </table>

    <h3>Tabel 4: Fines_rules</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Field</th>
                <th>Tipe Data</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>id</td><td>INT AUTO_INCREMENT</td><td>ID unik aturan denda</td></tr>
            <tr><td>amount</td><td>INT</td><td>Nominal denda per hari (Rp)</td></tr>
            <tr><td>description</td><td>TEXT (nullable)</td><td>Penjelasan aturan denda</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td>Tanggal data dibuat</td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td>Tanggal data diperbarui</td></tr>
        </tbody>
    </table>

    <h2>Jenis Relasi Antar Tabel</h2>
    <table>
        <thead>
            <tr>
                <th>Jenis Relasi</th>
                <th>Dari Tabel</th>
                <th>Ke Tabel</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>One to Many</td>
                <td>user</td>
                <td>loans</td>
                <td>Satu user bisa melakukan banyak peminjaman</td>
            </tr>
            <tr>
                <td>One to Many</td>
                <td>books</td>
                <td>loans</td>
                <td>Satu buku bisa dipinjam oleh banyak user di waktu berbeda</td>
            </tr>
            <tr>
                <td>Many to One</td>
                <td>loans</td>
                <td>user, books</td>
                <td>Setiap data peminjaman dimiliki oleh satu user dan satu buku</td>
            </tr>
            <tr>
                <td>One to One</td>
                <td>fines_rules</td>
                <td>-</td>
                <td>Aturan denda hanya satu, tidak berelasi ke tabel lain secara langsung</td>
            </tr>
        </tbody>
    </table>

</body>
</html>


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
#   t u g a s a k h i r 
 
 
