<?php
class User
{
    public $id;
    public $username;
    public $password;
    public $role;
    public $email;
    public function __construct($id, $username, $password, $role, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->email = $email;
        $thongbao = $this->validateUser();
        // Báo lỗi nếu dữ liệu k hợp lệ hoặc để trống
        if ($thongbao !== true) {
            echo "Error: " . $thongbao;
            exit;
        }
    }
    function get_role($role)
    {
        return $this->role;
    }
    function set_role($role)
    {
        return $this->role = $role;
    }
    function validateuser()
    {
        // Kiểm tra username, email và password không được để trống
        if (empty($this->username)) {
            return "Tên đăng nhập không được để trống";
        }
        if (empty($this->email)) {
            return "Email không được để trống";
        }
        if (empty($this->password)) {
            return "Mật khẩu không được để trống";
        }

        if (strlen($this->username) < 4) {
            return "Tên đăng nhập phải trên 4 kí tự";
        }
        if (strlen($this->username) > 20) {
            return "Tên đăng nhập phải dưới 20 kí tự";
        }
        if (strlen($this->password) < 4) {
            return "Password phải trên 4 kí tự";
        }
        if (strlen($this->password) > 32) {
            return "Password phải dưới 32 kí tự";
        }
        if (strlen($this->email) < 4) {
            return "Email phải trên 4 kí tự";
        }
        if (strlen($this->email) > 150) {
            return "Email phải dưới 150 kí tự";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return "Email không đúng định dạng";
        }
        if (!preg_match('/[A-Za-z]/', $this->password) || !preg_match('/[0-9]/', $this->password)) {
            return "Password gồm số và ký tự.";
        }
        return true;
    }

    function xuatThongTin()
    {
        echo "Thong tin user" . "<br>";
        echo "ID: " . $this->id . "<br>";
        echo "Username: " . $this->username . "<br>";
        echo "Email: " . $this->email . "<br>";
        echo "Role: " . $this->role . "<br>";
        echo "----------------" . "<br>";
        echo "<br>";
    }
}
$a = new User(1, "nvqqd", "123f456", "user", "nv@gmail.com");
$a->xuatThongTin();
$a->set_role("admin");
$a->xuatThongTin();



//CLASS SAN PHAM PRODUCT
class Product
{
    public $id;
    public $tensanpham;
    public $gia;
    public $soluong;

    public function __construct($id, $tensanpham, $gia, $soluong)
    {
        $this->id = $id;
        $this->tensanpham = $tensanpham;
        $this->gia = $gia;
        $this->soluong = $soluong;
        $thongbao1 = $this->validateProduct();
        if ($thongbao1 !== true) {
            echo "Error: " . $thongbao1;
            exit;
        }
    }
    function get_soluong($soluong)
    {
        return $this->soluong;
    }
    function set_soluong($soluong)
    {
        return $this->soluong = $soluong;
    }

    function validateProduct()
    {
        if (empty($this->tensanpham)) {
            return "Tên sản phẩm không được để trống.";
        }
        if (strlen($this->tensanpham) < 4) {
            return "Tên sản phẩm tối thiểu 4 kí tự.";
        }
        if (strlen($this->tensanpham) > 150) {
            return "Tên sản phẩm tối đa 150 kí tự.";
        }
        if (empty($this->soluong)) {
            return "Số lượng không được để trống.";
        }
        if (!is_numeric($this->soluong)) {
            return "Số lượng phải là số.";
        }
        if ($this->soluong <= 0) {
            return "Số phải dương.";
        }
        if (empty($this->gia)) {
            return "Giá không được để trống.";
        }
        if (!is_numeric($this->gia)) {
            return "Giá phải là số.";
        }
        if ($this->gia <= 0) {
            return "Giá phải dương.";
        }

        return true;
    }


    function xuatThongTin2()
    {
        echo "Thông tin sản phẩm" . "<br>";
        echo "ID: " . $this->id . "<br>";
        echo "Tên sản phẩm: " . $this->tensanpham . "<br>";
        echo "Giá: " . $this->gia . "<br>";
        echo "Số lượng: " . $this->soluong . "<br>";
        echo "----------------" . "<br>";
        echo "<br>";
    }
}
$b = new Product(1, "áo khoác", 100000, 10);
$b->xuatThongTin2();
$b->set_soluong(5);
$b->xuatThongTin2();



//Categories
class Categories
{
    public $id;
    public $tenSp;

    public function __construct($id, $tenSp)
    {
        $this->id = $id;
        $this->tenSp = $tenSp;
        $this->validateCategories();
    }
    public function validateCategories()
    {
        if (empty($this->tenSp)) {
            echo "San pahm is required";
        }
        if (empty($this->id)) {
            echo "ID is required";
        }
    }
    function get_id($id)
    {
        return $this->id;
    }
    function set_id($id)
    {
        return $this->id = $id;
    }

    function xuatThongTin3()
    {
        echo "Categories" . "<br>";
        echo "ID: " . $this->id . "<br>";
        echo "Tên sản phẩm: " . $this->tenSp . "<br>";
        echo "----------------" . "<br>";
    }
}
$c = new Categories(1, "Áo khoác");
$c->xuatThongTin3();
$c->set_id(2);
$c->xuatThongTin3();

//CLASS ORDERS
class Orders
{
    public $id;
    public $productName;
    public $quantity;
    public $username;
    public $Sdt;
    public $address;

    public function __construct($id, $productName, $quantity, $username, $Sdt, $address)
    {
        $this->id = $id;
        $this->productName = $productName;
        $this->quantity = $quantity;
        $this->username = $username;
        $this->Sdt = $Sdt;
        $this->address = $address;
        $thongbao = $this->validateOrder();
        if ($thongbao !== true) {
            echo "Error: " . $thongbao;
            exit;
        }
    }

    function validateOrder()
    {
        if (empty($this->id)) {
            return "ID là bắt buộc.";
        }
        if (empty($this->productName)) {
            return "Tên sản phẩm là bắt buộc.";
        }
        if (empty($this->quantity)) {
            return "Số lượng là bắt buộc.";
        }
        if (empty($this->username)) {
            return "Tên người dùng là bắt buộc.";
        }
        if (strlen($this->username) < 4) {
            return "Tên người dùng phải có ít nhất 4 ký tự.";
        }
        if (empty($this->address)) {
            return "Địa chỉ là bắt buộc.";
        }
        if (strlen($this->address) < 10) {
            return "Địa chỉ phải có ít nhất 10 ký tự.";
        }
        if (empty($this->Sdt)) {
            return "Số điện thoại là bắt buộc.";
        }
        if (!is_numeric($this->Sdt)) {
            return "Số điện thoại phải là số.";
        }
        if (strlen($this->Sdt) >= 12) {
            return "Số điện thoại phải ngắn hơn 12 số.";
        }
        return true;
    }


    function displayOrderInfo()
    {
        echo "Order Information" . "<br>";
        echo "ID: " . $this->id . "<br>";
        echo "Product Name: " . $this->productName . "<br>";
        echo "Quantity: " . $this->quantity . "<br>";
        echo "Username: " . $this->username . "<br>";
        echo "Phone number: " . $this->Sdt . "<br>";
        echo "Address: " . $this->address . "<br>";
        echo "----------------" . "<br>";
        echo "<br>";
    }
}

// Create Orders
$order1 = new Orders(1, " Áo Khoác", 2, "Nguyễn Vũ", "0345213147", "1111 Cưsue, Đắt lắc");
$order1->displayOrderInfo();
$order2 = new Orders(2, "Áo khoác", 3, "Vũ Nguyễn", "0901110011", "28 ywang, tb bmt");
$order2->displayOrderInfo();
