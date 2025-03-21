<?php include __DIR__ . '/../shares/header.php'; ?>

<h1>Thêm Sinh Viên</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/demo/kiemtra/Student/save" enctype="multipart/form-data">
    <div class="form-group">
        <label for="masv">Mã SV:</label>
        <input type="text" id="masv" name="MaSV" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="hoten">Họ Tên:</label>
        <input type="text" id="hoten" name="HoTen" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="gioitinh">Giới Tính:</label>
        <select id="gioitinh" name="GioiTinh" class="form-control" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>

    <div class="form-group">
        <label for="ngaysinh">Ngày Sinh:</label>
        <input type="date" id="ngaysinh" name="NgaySinh" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="hinh">Hình ảnh:</label>
        <input type="file" id="hinh" name="Hinh" class="form-control">
    </div>

    <div class="form-group">
        <label for="manganh">Mã Ngành:</label>
        <input type="text" id="manganh" name="MaNganh" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Thêm Sinh Viên</button>
</form>

<a href="../../controller/StudentController.php" class="btn btn-secondary mt-2">Quay lại danh sách sinh viên</a>

<?php include __DIR__ . '/../shares/footer.php'; ?>
