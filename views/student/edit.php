<?php require_once __DIR__ . '/../shares/header.php'; ?>

<h1>Sửa thông tin sinh viên</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/demo/kiemtra/Student/update" enctype="multipart/form-data" onsubmit="return validateForm();">
    <input type="hidden" name="MaSV" value="<?php echo $student->MaSV; ?>">

    <div class="form-group">
        <label for="HoTen">Mã SV:</label>
        <input type="text" id="MaSV" name="MaSV" class="form-control" 
               value="<?php echo htmlspecialchars($student->MaSV, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="form-group">
        <label for="HoTen">Họ Tên:</label>
        <input type="text" id="HoTen" name="HoTen" class="form-control" 
               value="<?php echo htmlspecialchars($student->HoTen, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label for="GioiTinh">Giới Tính:</label>
        <select id="GioiTinh" name="GioiTinh" class="form-control" required>
            <option value="Nam" <?php echo ($student->GioiTinh == 'Nam') ? 'selected' : ''; ?>>Nam</option>
            <option value="Nữ" <?php echo ($student->GioiTinh == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
        </select>
    </div>

    <div class="form-group">
        <label for="NgaySinh">Ngày Sinh:</label>
        <input type="date" id="NgaySinh" name="NgaySinh" class="form-control" 
               value="<?php echo htmlspecialchars($student->NgaySinh, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label for="MaNganh">Mã Ngành:</label>
        <input type="text" id="MaNganh" name="MaNganh" class="form-control" 
               value="<?php echo htmlspecialchars($student->MaNganh, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label>Ảnh hiện tại:</label><br>
        <?php if (!empty($student->Hinh)): ?>
                        <img src="/demo/kiemtra/uploads/<?php echo htmlspecialchars($student->Hinh, ENT_QUOTES, 'UTF-8'); ?>" alt="Hình ảnh" style="width: 100px; height: auto;">
                    <?php else: ?>
                        Không có hình
                    <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="Hinh">Chọn ảnh mới (nếu có):</label>
        <input type="file" id="Hinh" name="Hinh" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
</form>

<a href="/kiemtra/Student/list" class="btn btn-secondary mt-2">Quay lại danh sách sinh viên</a>
<?php require_once __DIR__ . '/../shares/footer.php'; ?>
