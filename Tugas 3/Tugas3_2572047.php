<!-- [2572047] - [Kevin Wijaya] -->
<?php
include_once 'koneksi.php';

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $asal = trim($_POST['asal']);
    $komentar = trim($_POST['komentar']);

    if (empty($nama) || empty($asal) || empty($komentar)) {
        $pesan = "<div class='alert alert-danger'>Semua kolom wajib diisi!</div>";
    } else {
        $query = "INSERT INTO buku_tamu (nama, asal, komentar) VALUES (:nama, :asal, :komentar)";
        $stmt = $conn->prepare($query);
        
        if ($stmt->execute(['nama' => $nama, 'asal' => $asal, 'komentar' => $komentar])) {
            $pesan = "<div class='alert alert-success'>Komentar berhasil ditambahkan.</div>";
        } else {
            $pesan = "<div class='alert alert-danger'>Gagal menyimpan komentar.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - 2572047</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { 
            background-color: #fcfcfc; 
            padding: 40px 0; 
        }
        .card { 
            border: none; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        }
        .comment-box {
            border-bottom: 1px solid #eee; 
            padding-bottom: 15px; 
            margin-bottom: 15px; 
        }
        .comment-name { 
            font-weight: bold; 
            color: #333; 
        }
        .comment-meta { 
            font-size: 0.85em; 
            color: #777; 
        }
        .btn-kirim {
            background-color: #b148d2; 
            color: white; border: none; 
            padding: 10px 20px; 
            border-radius: 5px; 
            width: 20%;
        }
        footer{
            color: gray;
            font-size: 15px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?= $pesan; ?>
            <div class="card mb-4 p-3">
                <div class="card-body">
                    <h3 class="mb-4">Buku Tamu</h3>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Asal Kota</label>
                            <input type="text" name="asal" class="form-control" placeholder="Contoh: Bandung">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Komentar</label>
                            <textarea name="komentar" class="form-control" rows="3" placeholder="Tulis komentar atau kesanmu..."></textarea>
                        </div>
                        <button type="submit" class="btn-kirim">Kirim Komentar</button>
                    </form>
                </div>
            </div>

<div class="card p-4">
    <div class="card-body">
        <?php
        $stmt = $conn->query("SELECT * FROM buku_tamu ORDER BY waktu DESC");
        $total_komentar = $stmt->rowCount();
        ?>
        <h4 class="mb-4">Komentar Tamu <span class="text-muted fs-6 fw-normal">(<?= $total_komentar; ?> komentar)</span></h4>
        
        <?php if ($total_komentar > 0): ?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="card mb-3 p-3 border rounded-3 bg-white shadow-sm">
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="comment-name fw-bold text-dark fs-5">
                            <?= htmlspecialchars($row['nama']); ?>
                        </div>
                        <div class="comment-meta text-muted small text-end">
                            <?= htmlspecialchars($row['asal']); ?> | <?= date('Y-m-d H:i:s', strtotime($row['waktu'])); ?>
                        </div>
                    </div>
                    
                    <div class="text-secondary">
                        "<?= htmlspecialchars($row['komentar']); ?>"
                    </div>
                    
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="alert alert-secondary">Belum ada komentar</div>
        <?php endif; ?>
        
    </div>
</div>
<footer>2572047 - Kevin Wijaya</footer>
</div>
</div>
</div>
</body>
</html>