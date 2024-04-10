<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Khởi tạo danh sách người dùng mẫu
$users = array(
    array('username' => 'admin@gmail.com', 'role' => 'admin', 'name' => 'admin'),
    array('username' => 'user1@gmail.com', 'role' => 'user', 'name' => 'User 1'),
    array('username' => 'user2@gmail.com', 'role' => 'user', 'name' => 'User 2')
);

// Hàm lấy danh sách người dùng
function getUsers($users) {
    return $users;
}

// Hàm thêm mới người dùng
function addUser(&$users, $newUser) {
    $users[] = $newUser;
}

// Hàm xóa người dùng
function deleteUser(&$users, $username) {
    foreach ($users as $key => $user) {
        if ($user['username'] === $username) {
            unset($users[$key]);
            return true;
        }
    }
    return false;
}

// Hàm cập nhật thông tin người dùng
function updateUser(&$users, $username, $newUserData) {
    foreach ($users as $key => $user) {
        if ($user['username'] === $username) {
            $users[$key] = array(
                'username' => 'newuser@gmail.com',
                'role' => 'user',
                'name' => 'New User',
            );
            return true;
        }
    }
    return false;
}

// Hàm sắp xếp người dùng theo tên
function sortUsersByName(&$users) {
    usort($users, function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
}

// Hàm tìm kiếm người dùng theo username
function searchUserByUsername($users, $username) {
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return $user;
        }
    }
    return null;
}

// Lấy danh sách người dùng
$allUsers = getUsers($users);

// Thêm mới người dùng
$newUser = array('username' => 'newuser@gmail.com', 'role' => 'user', 'name' => 'New User');
addUser($users, $newUser);

// Xóa người dùng
$usernameToDelete = 'user2@gmail.com';  
deleteUser($users, $usernameToDelete);

// Cập nhật thông tin người dùng
$usernameToUpdate = 'user1@gmail.com';
$newUserData = array('name' => 'Updated User');
updateUser($users, $usernameToUpdate, $newUserData);

// Sắp xếp người dùng theo tên
sortUsersByName($users);

// Tìm kiếm người dùng theo username
$usernameToSearch = 'admin@gmail.com';
$foundUser = searchUserByUsername($users, $usernameToSearch);

// Hiển thị kết quả
echo "<br>Danh sách người dùng sau khi thêm, xóa, cập nhật và sắp xếp:<br>";
print_r($users);

echo "<br><br>Người dùng tìm thấy:<br>";
print_r($foundUser);
?>

</body>
</html>