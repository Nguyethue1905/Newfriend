<?php 
class login{
    var $user_id = null;
    var $username = null;
    var $email = null;
    var $password =null;  
    var $passwords =null;  

    public function checkuser($username, $password){
        $db = new connect();
        $sql = "select * from users where `username` = '$username' and `password` = '$password'";
        $result = $db->pdo_query_one($sql);
        if ($result != null)
            return true;
        else
            return false;
    }
    public function check_login($username){
        $db = new connect();
        $sql = "select * from users where `username` = '$username'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }
    function getUserid($username, $password)
    {
        $db = new connect();
        $select = "select user_id from users where username='$username' and password='$password'";
        return $db->pdo_query($select);
    }
    function chek_userids($username)
    {
        $db = new connect();
        $select = "select user_id from users where username = '$username'";
        return $db->pdo_query($select);
    }
    function getById($user_id)
    {
        $db = new connect();
        $select = "select * from users where user_id = '$user_id'";
        return $db->pdo_query_one($select);
    }

    function getupdatetime($user_id)
    {
        $db = new connect();
        $select = "INSERT INTO `time_login` ( `user_id`, `login_time`) VALUES ('$user_id', NOW()); ";
        return $db->pdo_query_one($select);
    }
    function all_user()
    {
        $db = new connect();
        $select = "select * from users";
        return $db->pdo_query($select);

    }

}

class singin {

  public function sigin(){
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    if (isset($_POST['btn'])){ 
        $login = new login();
        
        $user = $login->check_login($username);
        $psw =  password_verify($password, $user['password'] ?? "");
        $user_status = $user['user_status'] ?? "";
        if ($user && $psw){
          if ($user_status == 3){
            echo '<div style="color: red;">Tài khoản của bạn đã bị khoá</div>';
          }else{
            $id = $login->chek_userids($username);
            if ($id){
                foreach ($id as $ro){
                    $_SESSION['id'] = $ro['user_id'];
                    $_SESSION['user'] = $username;
                    header("Location: ./index.php?act=home");
                    exit(); 
                }
            }
          }
            
        }
        echo '<div style="color: red;">Tên đăng nhập hoặc mật khẩu không chính xác</div>';
    }
}

}
