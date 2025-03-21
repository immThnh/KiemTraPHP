<?php
require_once __DIR__ . '/../model/Student.php';
require_once __DIR__ . '/../config/database.php';

class StudentController
{
    private $studentModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->studentModel = new Student($this->db);
      
    }

    public function index()
    {
        $students = $this->studentModel->getStudents();
        include __DIR__ . '/../views/student/list.php';
    }

    public function show($id)
    {
        $student = $this->studentModel->getStudentById($id);

        if ($student) {
            include __DIR__ . '/../views/student/show.php';
        } else {
            echo "Không tìm thấy sinh viên.";
        }
    }

    public function add()
    {
        include __DIR__ . '/../views/student/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaSV = $_POST['MaSV'] ?? '';
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $NgaySinh = $_POST['NgaySinh'] ?? '';
            $MaNganh = $_POST['MaNganh'] ?? '';
            $HinhAnh = '';

            // Định nghĩa thư mục lưu ảnh
            $targetDir = __DIR__ . "/../../kiemtra/uploads/";

            // Kiểm tra thư mục nếu chưa tồn tại thì tạo
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Kiểm tra nếu có file ảnh được tải lên
            if (!empty($_FILES['Hinh']['name'])) {
                $fileName = time() . "_" . basename($_FILES["Hinh"]["name"]); // Tạo tên file mới tránh trùng
                $targetFilePath = $targetDir . $fileName;

                // Kiểm tra và di chuyển file
                if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
                    $HinhAnh = $fileName; // Chỉ lưu tên file vào database
                } else {
                    die("Lỗi khi tải ảnh lên! Kiểm tra thư mục hoặc quyền ghi file.");
                }
            }

            // Gọi model để thêm sinh viên
            $result = $this->studentModel->addStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $HinhAnh, $MaNganh);

            if ($result === true) {
                header('Location: /demo/kiemtra/Student');
                exit;
            } else {
                print_r($result); // Hiển thị lỗi nếu có
            }
        }
    }



    public function edit($id)
    {
        $student = $this->studentModel->getStudentById($id);

        if ($student) {
            include __DIR__ . '/../views/student/edit.php';
        } else {
            echo "Không tìm thấy sinh viên.";
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaSV = $_POST['MaSV'];
            $HoTen = $_POST['HoTen'];
            $GioiTinh = $_POST['GioiTinh'];
            $NgaySinh = $_POST['NgaySinh'];
            $MaNganh = $_POST['MaNganh'];
            $HinhAnh = null;
    
            // Lấy thông tin sinh viên hiện tại
            $student = $this->studentModel->getStudentById($MaSV);
            if (!$student) {
                echo "Không tìm thấy sinh viên.";
                return;
            }
    
            // Định nghĩa thư mục lưu ảnh
            $targetDir = __DIR__ . "/../../kiemtra/uploads/";
    
            // Kiểm tra nếu chưa tồn tại thì tạo thư mục
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
    
            // Kiểm tra nếu có file ảnh được tải lên
            if (!empty($_FILES['Hinh']['name'])) {
                $fileName = time() . "_" . basename($_FILES["Hinh"]["name"]); // Tạo tên file mới tránh trùng
                $targetFilePath = $targetDir . $fileName;
    
                // Kiểm tra và di chuyển file
                if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
                    $HinhAnh = $fileName; // Chỉ lưu tên file vào database
    
                    // Xóa ảnh cũ nếu có
                    if (!empty($student->Hinh)) {
                        $oldFilePath = $targetDir . $student->Hinh;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                } else {
                    die("Lỗi khi tải ảnh lên! Kiểm tra thư mục hoặc quyền ghi file.");
                }
            } else {
                // Nếu không tải ảnh mới, giữ nguyên ảnh cũ
                $HinhAnh = $student->Hinh;
            }
    
            // Gọi model để cập nhật thông tin sinh viên
            $result = $this->studentModel->updateStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $HinhAnh, $MaNganh);
    
            if ($result === true) {
                header('Location: /demo/kiemtra/Student');
                exit;
            } else {
                print_r($result); // Hiển thị lỗi nếu có
            }
        }
    }

    public function detail($id)
    {
        // Lấy thông tin sinh viên theo MaSV
        $student = $this->studentModel->getStudentById($id);

        if ($student) {
            // Hiển thị view chi tiết sinh viên
            include __DIR__ . '/../views/student/detail.php';
        } else {
            echo "Không tìm thấy sinh viên.";
        }
    }
        
public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $MaSV = $_POST['MaSV'] ?? '';

        // Kiểm tra nếu MSSV bị bỏ trống
        if (empty($MaSV)) {
            echo "Lỗi: Mã số sinh viên không được để trống.";
            return;
        }

        // Gọi model để kiểm tra MSSV
        $student = $this->studentModel->loginByMSSV($MaSV);

        if ($student) {
            // Lưu thông tin đăng nhập vào session
            session_start();
            $_SESSION['student'] = $student;

            // Chuyển hướng đến trang danh sách sinh viên
            header('Location: /demo/kiemtra/Student');
            exit;
        } else {
            echo "Lỗi: Mã số sinh viên không tồn tại.";
        }
    } else {
        // Hiển thị form đăng nhập
        include __DIR__ . '/../views/student/login.php';
    }
}

    public function delete($id)
    {
        $result = $this->studentModel->deleteStudent($id);

        if ($result) {
            header('Location: /demo/kiemtra/Student');
        } else {
            echo "Xóa sinh viên thất bại.";
        }
    }
}


?>