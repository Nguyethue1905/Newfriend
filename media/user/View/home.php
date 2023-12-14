<?php
$db = new profile();
$select = $db->getList($user_id);
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<div class="col-lg-6">
    <?php
    include './Model/include/add-post.php';
    ?>

    <?php
    $db = new posts();
    $user_id = $_SESSION['id'];
    $item = $db->getPost($user_id);
    foreach ($item as $get) {
        $name = $get['name_count'] ?? "?     ?";
        $posts_id = $get['posts_id'];
        $_SESSION['posts_id'] = $posts_id;

        $db = new posts();
        $time = $db->getDate($posts_id);

        // Thời gian ban đầu
        $days = $time['days'];
        $hours = $time['hours'];
        $minutes = $time['minutes'];

        // Chuyển đổi thời gian thành chuỗi "ngày giờ phút"
        $timeString = '';

        if ($days > 0) {
            $timeString .= $days . ' ngày ';
        }

        if ($hours > 0) {
            $timeString .= $hours . ' giờ ';
        }

        if ($minutes > 0) {
            $timeString .= $minutes . ' phút';
        }

        echo '';

    ?>

        <div class="central-meta item">
            <div class="user-post<?= $_SESSION['posts_id'] ?>">
                <div class="friend-info">
                    <figure>
                        <?php

                        $avatar = $get['avatar'] ?? "";
                        if ($avatar == "") {
                            echo '<img src="./View/images/uploads/avatar.jpg" alt="">';
                        } else {
                            echo '<img src="./View/images/uploads/' . $avatar . '" alt="" class="user-avatars">';
                        }
                        ?>
                    </figure>
                    <div class="friend-name">
                        <ins><a href="time-line.html" title=""><?= $name ?></a></ins>
                        <span><?= $timeString ?></span>
                    </div>
                    <!-- Delete post -->
                    <div class="dropdown-post">
                        <button class="dropbtn">&#8942;</button>
                        <div class="dropdown-content">
                            <a class="delete" data-delete="<?= $get['posts_id'] ?>">Xóa bài viết</a>
                        </div>
                    </div>


                    <div class="description">
                        <p>
                            <?= $get['content'] ?? "" ?>
                        </p>
                    </div>
                    <div class="post-meta">

                        <?php

                        $posts_id = $get['posts_id'];
                        $file = $db->getfile($posts_id);
                        $count = count($file);
                        if ($count == 1) {

                        ?>
                            <div class="img-content1">
                                <?php
                                foreach ($file as $img) {
                                    echo '<img src="./View/images/uploads/' . $img['filename'] . '" alt="" style="width:100%; object-fit: cover;">';
                                }
                                ?>

                            </div>
                        <?php
                        } elseif ($count == 2) {
                        ?>
                            <div class="img-content2">
                                <?php foreach ($file as $img) { ?>
                                    <img src="./View/images/uploads/<?= $img['filename'] ?>" alt="">
                                <?php } ?>
                            </div>
                        <?php
                        } elseif ($count == 3) {
                        ?>
                            <div class="img-content3">
                                <?php foreach ($file as $img) { ?>
                                    <img src="./View/images/uploads/<?= $img['filename'] ?>" alt="">
                                <?php } ?>
                            </div>
                        <?php
                        } elseif ($count == 4) {
                        ?>
                            <div class="img-content4">
                                <?php foreach ($file as $img) { ?>
                                    <img src="./View/images/uploads/<?= $img['filename'] ?>" alt="">
                                <?php } ?>
                            </div>
                        <?php
                        } elseif ($count == 5) {
                        ?>
                            <div class="img-content5">
                                <?php
                                $img1 = array_slice($file, 0, 1);
                                $img2 = array_slice($file, 1, 1);
                                $img3 = array_slice($file, 2, 1);
                                $img4 = array_slice($file, 3, 1);
                                $img5 = array_slice($file, 4, 1);
                                ?>
                                <div class="large-images">
                                    <img src="./View/images/uploads/<?= $img1[0]["filename"] ?>" alt="">
                                    <img src="./View/images/uploads/<?= $img2[0]["filename"] ?>" alt="">
                                </div>
                                <div class="small-images">
                                    <img src="./View/images/uploads/<?= $img3[0]["filename"] ?>" alt="">
                                    <img src="./View/images/uploads/<?= $img4[0]["filename"] ?>" alt="">
                                    <img src="./View/images/uploads/<?= $img5[0]["filename"] ?>" alt="">
                                </div>
                            </div>

                        <?php
                        }
                        ?>




                        <div class="we-video-info">
                            <ul>
                                <!-- like -->
                                <li>
                                    <span class="like" data-postid="<?= $get['posts_id'] ?>" title="like">
                                        <?php
                                        $getdt = new posts();
                                        $user_id = $_SESSION['id'];
                                        $like = $getdt->getLike($posts_id, $user_id);
                                        $idLike = '';

                                        if ($like) {
                                            $idLike = $getdt->getIdLike($posts_id, $user_id);
                                            echo '
                                                    <a type="submit" class="unlikeInput" name="unlikeInput" data-postunlike="' . $idLike['postlike_id'] . '">
                                                        <i class="fa-solid fa-heart"style="color: #08d5a9;font-size:24px;"></i>
                                                    </a>
                                                ';
                                            if (isset($_POST['unlike'])) {
                                                $postlike_id = $idLike['postlike_id'];
                                                $db = new posts();
                                                $delete = $db->deleteLike($postlike_id);
                                                // header('Location: ./index.php?act=home');    
                                            }
                                        } elseif ($like == "") {
                                            echo '
                                                    
                                                    <a type="submit" class="likeInput"  name="likeInput" data-postlike="' . $get['posts_id'] . '">
                                                    <i class="fa-regular fa-heart" style="color: #08d5a9; font-size:24px;"></i> </a>
                                                ';
                                        }

                                        ?>



                                    </span>
                                    <script>
                                        jQuery(document).ready(function($) {
                                            $(document).on("click", ".likeInput", function(event) {
                                                event.preventDefault();
                                                var button = $(this);
                                                var post_id = button.data('postlike');
                                                var user_id_in_js = <?php echo json_encode($user_id); ?>;

                                                $.ajax({
                                                    url: "/user/ajax.php",
                                                    method: "POST",
                                                    data: {
                                                        action: "addLike",
                                                        posts_id: post_id,
                                                        user_id: user_id_in_js,

                                                    },
                                                    success: function(result) {
                                                        $("#weather-temp").html("<strong>" +
                                                            result + "</strong> degrees");
                                                        console.log(result);
                                                        var result = JSON.parse(result);
                                                        if (result.status == 'success') {
                                                            $('.user-post<?= $get['posts_id'] ?>').load(location.href + ' .user-post<?= $get['posts_id'] ?>');
                                                            console.log('thêm thành công');

                                                        } else {
                                                            console.log('lỗi');
                                                        }

                                                    }
                                                });
                                            });
                                        });

                                        jQuery(document).ready(function($) {
                                            $(document).on("click", ".unlikeInput", function(event) {
                                                event.preventDefault();
                                                var button = $(this);
                                                var like_id = button.data('postunlike');

                                                console.log(like_id);
                                                $.ajax({
                                                    url: "/user/ajax.php",
                                                    method: "POST",
                                                    data: {
                                                        action: "deleteLike",
                                                        postlike_id: like_id

                                                    },
                                                    success: function(result) {
                                                        $("#weather-temp").html("<strong>" +
                                                            result + "</strong> degrees");
                                                        console.log(result);
                                                        var result = JSON.parse(result);
                                                        // $('.like').load(location.href + ' .like');
                                                        if (result.status === 'success') {
                                                            $('.user-post<?= $get['posts_id'] ?>').load(location.href + ' .user-post<?= $get['posts_id'] ?>');
                                                            console.log('xoá thành công');

                                                        } else {
                                                            console.log('lỗi');
                                                        }
                                                    }
                                                });
                                            });
                                        });


                                        jQuery(document).ready(function($) {
                                            $(document).on("click", ".delete", function(event) {
                                                event.preventDefault();
                                                var button = $(this);
                                                var post_id = button.data('delete');
                                                var user_id_in_js = <?php echo json_encode($user_id); ?>;
                                                $.ajax({
                                                    url: "/user/ajax.php",
                                                    method: "POST",
                                                    data: {
                                                        action: "deletepost",
                                                        posts_id: post_id,
                                                        user_id: user_id_in_js
                                                    },
                                                    success: function(text) {
                                                        $("#weather-temp").html("<strong>" +
                                                            text + "</strong> degrees");
                                                        console.log(text);
                                                        if (text == true) {
                                                            $('.user-post<?= $get['posts_id'] ?>').load(location.href + ' .user-post<?= $get['posts_id'] ?>');
                                                            console.log('Xóa thành công');
                                                        } else {
                                                            console.log('lỗi');
                                                        }

                                                    }
                                                });
                                            });
                                        });
                                    </script>


                                </li>


                                <!-- cmt -->
                                <li>
                                    <span class="comment" data-toggle="tooltip" title="Comments">
                                        <i class="fa-solid fa-comment" style="color: #08d5a9; font-size:24px;"></i>
                                        <ins></ins>
                                    </span>
                                </li>
                                <!-- share -->
                                <li class="social-media">
                                    <div class="menu">
                                        <div class="btn trigger"><i class="fa fa-share-alt"></i></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="post-comt-box">
                            <form method="post">
                                <div class="img-cmt">
                                    <?php
                                    $avatar = $select['avatar'] ?? "";
                                    if ($avatar == "") {
                                        echo '<img src="./View/images/uploads/avatar.jpg" alt="" style="border-radius: 50%; width:55px; height:55px;">';
                                    } else {
                                        echo ' <img src="./View/images/uploads/' . $avatar . '" alt="" style="border-radius: 50%; width:55px; height:55px;" class="user-avatars">';
                                    }
                                    ?>
                                    <input class="input" id="binhluan_<?= $get['posts_id'] ?>" type="text" name="contentcmt" placeholder="Bình luận">
                                    <a class="inputs submit-cmt" type="submit" name="submit-cmt" data-post="<?= $get['posts_id'] ?>" placeholder="Bình luận"> Gửi</a>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>

            </div>
       


            <!--cmt deatail start -->
            <div class="coment-area" style="margin-top: 30px;">
                <ul class="we-comet" style=" max-height: 300px;  overflow-y: auto;">
                    <?php

                    $db = new comment();
                    $cmt = $db->getListcmt($posts_id) ?? "";
                    foreach ($cmt as $get) {
                        $cmt_id = $get['cmt_id'];
                        $_SESSION['cmt_id'] = $cmt_id;
                        $timecmt = $db->getDate($cmt_id);


                        // Thời gian ban đầu
                        $days = $timecmt['days'];
                        $hours = $timecmt['hours'];
                        $minutes = $timecmt['minutes'];

                        // Chuyển đổi thời gian thành chuỗi "ngày giờ phút"
                        $timeString = '';

                        if ($days > 0) {
                            $timeString .= $days . ' ngày ';
                        }

                        if ($hours > 0) {
                            $timeString .= $hours . ' giờ ';
                        }

                        if ($minutes > 0) {
                            $timeString .= $minutes . ' phút';
                        }
                    ?>
                        <li>
                            <div class="comet-avatar">

                                <?php
                                $avatar = $get['avatar'] ?? "";
                                if ($avatar == "") {
                                    echo '<img src="./View/images/uploads/avatar.jpg" alt="">';
                                } else {
                                    echo '<img src="./View/images/uploads/' . $avatar . '" alt="" class="user-avatars"> ';
                                }
                                ?>
                            </div>

                            <div class="we-comment">
                                <div class="coment-head">
                                    <h5><a href="" title=""><?= $get['name_count'] ?></a></h5>
                                    <span><?= $timeString ?></span>
                                    <button onclick="cmt_user()" style="border: none;"><i class="fa fa-reply"></i></button>
                                </div>
                                <p><?= $get['comment'] ?></p>
                            </div>
                            <!-- <div id = "all_cmt">
                       <form action=""  method="POST">
                       <input type="text" name ="recmt" id="userInput" placeholder="Bạn hãy nhập ý kiến phản hồi">
                       <button id="btn-cmts" name ="btn" type = "submit">Gữi</button>
                       </form>
                        </div> -->
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- cmt deatail end -->


        </div>
<?php }  ?>

</div>







<?php
if (isset($_POST['btn'])) {
    $content = $_POST['recmt'];
    $posts_id = $_SESSION['posts_id'];
    $user_id = $_SESSION['id'];
    $cmt_id  = $_SESSION['cmt_id'];
    $db = new comment();
    $postscomment = $db->postscomment($user_id, $posts_id, $cmt_id, $content);
    if ($postscomment == true) {
        echo 'Bạn đã trả lời bình luận thành công';
    }
}
?>
<?php

$user_id = $_SESSION['id'];

?>

<script>
            
                jQuery(document).ready(function($) {
                    $(document).on("click", ".submit-cmt", function(event) {
                        event.preventDefault();
                        var button = $(this);
                        var post_id = button.data('post');
                        var content = $('#binhluan_' + post_id).val();
                        var user_id_in_js = <?php echo json_encode($user_id); ?>;

                        $.ajax({
                            url: "/user/ajax.php",
                            method: "POST",
                            data: {
                                action: "addCmt",
                                posts_id: post_id,
                                user_id: user_id_in_js,
                                comment: content
                            },
                            success: function(result) {
                                $("#weather-temp").html("<strong>" +
                                    result + "</strong> degrees");
                                console.log(result);
                                if (result == true) {
                                    location.reload();
                                    console.log('thành công');     
                                } else {
                                    console.log('lỗi');
                                }

                            }
                        });
                    });
                });
            </script>