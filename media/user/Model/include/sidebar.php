<div class="col-lg-3">
    <aside class="sidebar static">
        <div class="widget">
            <h4 class="widget-title">Lối tắt</h4>
            <ul class="naves">
                <li>
                    <i class="fa-solid fa-house" style="color: #08d5a9;"></i>
                    <a href="./index.php?act=home" title="">Bảng tin</a>
                </li>
                <li>
                <i class="fa-solid fa-wand-magic-sparkles" style="color: #08d5a9;"></i> 
                    <a href="./index.php?act=myacount" title="">Trang cá nhân</a>
                </li>
                <li>
                    <i class="fa-solid fa-user-group" style="color:#08d5a9;"></i>
                    <a href="./index.php?act=friend" title="">Bạn bè</a>
                </li>
                <li>
                    <i class="fa-solid fa-comment" style="color:#08d5a9;"></i>
                    <a href="./index.php?act=messages" title="">Tin nhắn</a>
                </li>
                <li>
                    <i class="fa-solid fa-bell" style="color: #08d5a9;"></i>
                    <a href="./index.php?act=notifications" title="">Thông báo</a>
                </li>
                <li>
                    <i class="fa-solid fa-circle-notch" style="color:#08d5a9;"></i>
                    <a href="./index.php?act=logout" title="">Đăng xuất</a>
                </li>
                <li>
                    <i class="ti-power-off"></i>
                    <a href="../user/index.php?act=contact" title="">Hỗ Trợ</a>
                </li>
            </ul>
        </div><!-- Shortcuts -->
        <div class="widget stick-widget">
            <h4 class="widget-title">Gợi ý kết bạn</h4>
            <ul class="followers">
                <?php
                $user_id = $_SESSION['id'];
                $db = new profile();
                $get = $db->getUser($user_id);
                foreach($get as $item){
                ?>
                <li>
                    <figure>
                        <?php
                         $avatar = $item['avatar'] ?? "";
                         if ($avatar == "") {
                             echo '<img src="./View/images/uploads/avatar.jpg" alt="">';
                         } else {
                             echo '<img src="./View/images/uploads/' . $avatar . '" alt="">';
                         }
                        ?>
                        
                    </figure>
                    <div class="friend-meta">
                        <h4><a href="time-line.html" title=""><?=$item['name_count']?></a></h4>
                        <a href="#" title="" class="underline" type="submit">Kết bạn</a>
                    </div>
                </li>
                <?php
                }
                ?>
            </ul>
        </div><!-- who's following -->
    </aside>
</div><!-- sidebar -->