<div class="dangki">
    <form class="form lko" method="post">
        <p class="title"><a title="" href="index.php?act=login"><img src="../user/View/images/runn.png" alt="" class=""><img src="../user/View/images/name-removebg.png" alt="" style=" max-width: 50%;"></a>
        </p>
        <?php
            $signup = new register();
            $log = $signup->addsignup();
        ?>
        <label>
            <span class="ll">Tên đăng nhập</span>
            <input required="" placeholder="" type="text" class="input" name="username">
        </label>
        <label>
            <span class="ll">Tên tài khoản</span>
            <input required="" placeholder="" type="text" class="input" name="name_count">
        </label>
        <label>
            <span class="ll">Email</span>
            <input required="" placeholder="" type="email" class="input" name="email">
        </label>
        <label>
            <span class="ll">Ngày sinh</span>
            <input required="" placeholder="" type="date" class="input" name="brithdate">
        </label>

        <label>
            <span class="ll">Mật khẩu</span>
            <input required="" placeholder="" type="password" class="input" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Ít nhất 8 ký tự, gồm ít nhất một chữ cái và một số" required>
        </label>
        <label>
            <span class="ll">Nhập lại mật khẩu</span>
            <input required="" placeholder="" type="password" class="input" name="re_password">
        </label>
        <label>
            <span class="ll"><a href="./View/baomat.php">Tôi đồng ý với điều khoản và điều kiện </a></span>
            <input type="checkbox" name="agree" value="1" required>   
        </label>
        <button class="submit" name="btn-signup">Đăng ký</button>
        <p class="signin">Bạn đã có tài khoản ?<a href="./index.php?act=login">Đăng nhập</a> </p>
    </form>
</div>