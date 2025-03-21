<?php require_once __DIR__ . '/../shares/header.php'; ?>

<h1>Danh sách Sinh Viên</h1>
<a href="/demo/kiemtra/Student/add" class="btn btn-success mb-2">Thêm sinh viên mới</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình Ảnh</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student->MaSV, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($student->HoTen, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($student->GioiTinh, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($student->NgaySinh, ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <?php if (!empty($student->Hinh)): ?>
                        <img src="/demo/kiemtra/uploads/<?php echo htmlspecialchars($student->Hinh, ENT_QUOTES, 'UTF-8'); ?>" alt="Hình ảnh" style="width: 100px; height: auto;">
                    <?php else: ?>
                        Không có hình
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/demo/kiemtra/Student/detail/<?php echo $student->MaSV; ?>" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                    <a href="/demo/kiemtra/Student/edit/<?php echo $student->MaSV; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="/demo/kiemtra/Student/delete/<?php echo $student->MaSV; ?>" 
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xóa</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../shares/footer.php'; ?>