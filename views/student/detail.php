<?php include __DIR__ . '/../shares/header.php'; ?>

<h1>Thông Tin Chi Tiết Sinh Viên</h1>

<?php if ($student): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mã Sinh Viên: <?php echo htmlspecialchars($student->MaSV, ENT_QUOTES, 'UTF-8'); ?></h5>
            <p class="card-text"><strong>Họ Tên:</strong> <?php echo htmlspecialchars($student->HoTen, ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Giới Tính:</strong> <?php echo htmlspecialchars($student->GioiTinh, ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Ngày Sinh:</strong> <?php echo htmlspecialchars($student->NgaySinh, ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Mã Ngành:</strong> <?php echo htmlspecialchars($student->MaNganh, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php if (!empty($student->Hinh)): ?>
                <p class="card-text"><strong>Hình Ảnh:</strong></p>
                <img src="/demo/kiemtra/uploads/<?php echo htmlspecialchars($student->Hinh, ENT_QUOTES, 'UTF-8'); ?>" alt="Hình ảnh" style="width: 200px; height: auto;">
            <?php else: ?>
                <p class="card-text"><strong>Hình Ảnh:</strong> Không có</p>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <p>Không tìm thấy thông tin sinh viên.</p>
<?php endif; ?>

<a href="/demo/kiemtra/Student" class="btn btn-secondary mt-3">Quay lại danh sách</a>

<?php include __DIR__ . '/../shares/footer.php'; ?>