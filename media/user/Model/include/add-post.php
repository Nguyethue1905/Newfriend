<div class="central-meta">
    <div class="new-postbox">
        <figure>
            <?php
            $user_id = $_SESSION['id'];
            $db = new profile();
            $select = $db->getImg($user_id);
            $avatar = $select['avatar'] ?? "";
            if ($avatar == "") {
                echo '<img src="./View/images/uploads/avatar.jpg" alt="" class="user-avatars">';
            } else {
                echo '<img src="./View/images/uploads/' . $select['avatar'] . '" alt="" class="user-avatars">';
            }
            ?>
        </figure>
        <div class="newpst-input">
            <form method="post" enctype="multipart/form-data">
                <textarea rows="2" placeholder="Bạn đang nghĩ gì ?" name="content"></textarea>
                <div class="attachments">
                    <ul id="imageList">
                        <!-- Danh sách hình ảnh sẽ được hiển thị ở đây -->
                        <ul id="formList"></ul>
                    </ul>
                   
                    <li>
                        <label class="fileContainer">
                            <i class="fa-solid fa-camera" style="color: #08d5a9; font-size:30px; position: relative;top: 6px;"></i>
                            <input type="file" name="image[]" id="imageInput" multiple="multiple" accept="image/jpg, image/jpeg, image/png, image/gif" onchange="choseFile(this)" value="fdvdfbvdf">
                        </label>
                    </li>
                    <li>
                        <button type="submit" name="upload" class="btn-post">Đăng</button>
                    </li>
                </div>
            </form>

        </div>

        <?php
        if (isset($_POST['upload'])) {
            $user_id = $_SESSION['id'];
            $content = $_POST['content'] ?? "";

            if (isset($_FILES['image']) && !empty(array_filter($_FILES['image']['name']))) {
                $maxImageCount = 5; // Số lượng tối đa cho phép
                $fileCount = count($_FILES['image']['name']);

                if ($fileCount > $maxImageCount) {
                    echo "<script>alert('Chỉ được phép chọn tối đa $maxImageCount ảnh.');</script>";
                } else {
                    $db = new posts();
                    $text = $db->addPost($user_id, $content);
                    $get = $db->getid_post();

                    foreach ($get as $post) {
                        $_SESSION['posts_id'] = $post;
                    }

                    $files = $_FILES['image'];
                    foreach ($files['tmp_name'] as $key => $tmp_name) {
                        $filename = $files['name'][$key];
                        $file_tmp = $files['tmp_name'][$key];

                        move_uploaded_file($file_tmp, './View/images/uploads/' . $filename);
                        $posts_id = $_SESSION['posts_id'];
                        $img = $db->isetimg($filename, $posts_id);
                    }
                }
            } else {
                // Không có ảnh được chọn, chỉ xử lý với nội dung văn bản
                $db = new posts();
                $text = $db->addPost($user_id, $content);
            }
        }
        ?>
    </div>
</div><!-- add post new box -->