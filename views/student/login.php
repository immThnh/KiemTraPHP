<?php require_once __DIR__ . '/../shares/header.php'; ?>

<h2>ĐĂNG NHẬP</h2>

<form action="/demo/kiemtra/Student/login" method="POST">
    <div class="form-group">
        <label for="MaSV">MaSV</label>
        <input type="text" id="MaSV" name="MaSV" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Đăng Nhập</button>
</form>

<a href="/demo/kiemtra/Student/list">Back to List</a>

<?php require_once __DIR__ . '/../shares/footer.php'; ?>
