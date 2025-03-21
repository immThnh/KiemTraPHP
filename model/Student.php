<?php
class Student
{
    private $conn;
    private $table_name = "sinhvien";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getStudents()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public function loginByMSSV($MaSV)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaSV', $MaSV);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result; // Trả về thông tin sinh viên nếu tìm thấy, hoặc null nếu không tìm thấy
    }

    public function getStudentById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    

    public function addStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)
    {
        $errors = [];
    
        if (empty($MaSV)) {
            $errors['MaSV'] = 'Mã sinh viên không được để trống';
        }
    
        if (empty($HoTen)) {
            $errors['HoTen'] = 'Họ tên không được để trống';
        }
    
        if (empty($GioiTinh)) {
            $errors['GioiTinh'] = 'Giới tính không được để trống';
        }
    
        if (empty($NgaySinh)) {
            $errors['NgaySinh'] = 'Ngày sinh không được để trống';
        }
    
        if (empty($MaNganh)) {
            $errors['MaNganh'] = 'Mã ngành không được để trống';
        }
    
        if (count($errors) > 0) {
            return $errors;
        }
    
        $query = "INSERT INTO " . $this->table_name . " (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                  VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
        $stmt = $this->conn->prepare($query);
    
        $MaSV = htmlspecialchars(strip_tags($MaSV));
        $HoTen = htmlspecialchars(strip_tags($HoTen));
        $GioiTinh = htmlspecialchars(strip_tags($GioiTinh));
        $NgaySinh = htmlspecialchars(strip_tags($NgaySinh));
        $Hinh = htmlspecialchars(strip_tags($Hinh));
        $MaNganh = htmlspecialchars(strip_tags($MaNganh));
    
        $stmt->bindParam(':MaSV', $MaSV);
        $stmt->bindParam(':HoTen', $HoTen);
        $stmt->bindParam(':GioiTinh', $GioiTinh);
        $stmt->bindParam(':NgaySinh', $NgaySinh);
        $stmt->bindParam(':Hinh', $Hinh);
        $stmt->bindParam(':MaNganh', $MaNganh);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    public function updateStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)
    {
        $query = "UPDATE " . $this->table_name . " 
                SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, MaNganh = :MaNganh";

        // Chỉ cập nhật ảnh nếu có ảnh mới
        if (!empty($Hinh)) {
            $query .= ", Hinh = :Hinh";
        }

        $query .= " WHERE MaSV = :MaSV";

        $stmt = $this->conn->prepare($query);

        $HoTen = htmlspecialchars(strip_tags($HoTen));
        $GioiTinh = htmlspecialchars(strip_tags($GioiTinh));
        $NgaySinh = htmlspecialchars(strip_tags($NgaySinh));
        $MaNganh = htmlspecialchars(strip_tags($MaNganh));

        $stmt->bindParam(':MaSV', $MaSV);
        $stmt->bindParam(':HoTen', $HoTen);
        $stmt->bindParam(':GioiTinh', $GioiTinh);
        $stmt->bindParam(':NgaySinh', $NgaySinh);
        $stmt->bindParam(':MaNganh', $MaNganh);

        // Bind ảnh nếu có
        if (!empty($Hinh)) {
            $Hinh = htmlspecialchars(strip_tags($Hinh));
            $stmt->bindParam(':Hinh', $Hinh);
        }

        return $stmt->execute();
    }


    public function deleteStudent($MaSV)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaSV', $MaSV);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>