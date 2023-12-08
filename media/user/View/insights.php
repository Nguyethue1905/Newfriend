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
    $posts_id = $_GET['id_post'];
    $item = $db->sergetPost($user_id, $posts_id);
    $name = $item['name_count'] ?? "";
	$_SESSION['name'] = $name;
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

    ?>
    <div class="central-meta item">
        <div class="user-post">
            <div class="friend-info">
                <figure>
                    <?php
                    $avatar = $item['avatar'] ?? "";
                    if ($avatar == "") {
                        echo '<img src="./View/images/uploads/avatar.jpg" alt="">';
                    } else {
                        echo '<img src="./View/images/uploads/' . $avatar . '" alt="" class="user-avatars">';
                    }
                    ?>
                </figure>
                <div class="friend-name">
                    <ins><a href="time-line.html" title=""><?php echo $_SESSION['name'] ?></a></ins>
                    <span><?= $timeString ?></span>
                </div>
                <div class="dropdown-post">
                    <button class="dropbtn">&#8942;</button>
                    <div class="dropdown-content">
                        <!-- Các lựa chọn trong dropdown menu -->
                        <a href="#">Lựa chọn 1</a>
                        <a href="#">Lựa chọn 2</a>
                        <a href="#">Lựa chọn 3</a>
                    </div>
                </div>

                <div class="description">
                    <p>
                        <?= $item['content'] ?? "" ?>
                    </p>
                </div>
                <div class="post-meta-img">

                    <?php
                    $file = $db->getfile($posts_id);
                    if ($file) {
                        $filename = $files['filename'] ?? "";
                        $count = 0;
                        foreach ($file as $files) {
                            echo '<img src="./View/images/uploads/' . $files['filename'] . '" alt="Image">';
                        }
                    } elseif ($file == "") {
                        echo '<p></p>';
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
                                                    <a type="submit" class="unlikeInput"  name="unlikeInput" data-postunlike="' . $idLike['postlike_id'] . '">
                                                        <i class="fa-solid fa-heart"style="color: #08d5a9;font-size:24px;"></i>
                                                    </a>
                                                ';
                                            if (isset($_POST['unlike'])) {
                                                $postlike_id = $idLike['postlike_id'];;
                                                $db = new posts();
                                                $delete = $db->deleteLike($postlike_id);
                                                header('Location: ./index.php?act=home');
                                                exit();
                                            }
                                        } elseif ($like == "") {
                                            echo ' 
                                                    <a type="submit"  <a class="likeInput"  name="likeInput" data-postlike="' . $posts_id. '">
                                                    <i class="fa-regular fa-heart" style="color: #08d5a9; font-size:24px;"></i> </a>
                                                ';
                                        }

                                        ?>
                                </span>
                            </li>
                            <!-- cmt -->
                            <li>
                                <span class="comment" data-toggle="tooltip" title="Comments">
                                    <i class="fa fa-comments-o"></i>
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
                                <input class="input" id="binhluan_<?= $item['posts_id'] ?>" type="text"
                                    name="contentcmt" placeholder="Bình luận">
                                <a class="inputs submit-cmt" type="submit" name="submit-cmt"
                                    data-post="<?= $item['posts_id'] ?>" placeholder="Bình luận"> gửi</a>
                            </div>
                        </form>
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
                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                            </div>
                            <p><?= $get['comment'] ?> </p>
                        </div>

                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- cmt deatail end -->
        </div>
    </div>
</div>
<?php
$user_id = $_SESSION['id'];
?>

<script>
jQuery(document).ready(function($) {
    $(document).on("click", ".submit-cmt", function() {
        var button = $(this);
        var post_id = button.data('post');
        var content = $('#binhluan_' + post_id).val();
        var user_id_in_js = <?php echo json_encode($user_id); ?>;

        console.log(post_id, user_id_in_js, content);
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
                $("#weather-temp").html("<strong>" + result + "</strong> degrees");
                console.log(result);
                if (result == true) {
                    console.log('thành công ');
                    location.reload();
                } else {
                    console.log('lỗi');
                }
            }
        });
    });
});

//like post
jQuery(document).ready(function($) {
    $(document).on("click", ".likeInput", function() {
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
                $("#weather-temp").html("<strong>" + result + "</strong> degrees");
                console.log(result);
                if (result == true) {
                    console.log('thành công');

                } else {
                    console.log('lỗi');
                    location.reload();
                }
            }
        });
    });
});

//unlike post
jQuery(document).ready(function($) {
    $(document).on("click", ".unlikeInput", function() {
        var button = $(this);
        var like_id = button.data('postunlike');

        console.log(like_id);
        $.ajax({
            url: "/user/ajax.php",
            method: "POST",
            data: {
                action: "deleteLike",
                postlike_id: like_id,


            },
            success: function(result) {
                $("#weather-temp").html("<strong>" + result + "</strong> degrees");
                console.log(result);
                if (result == true) {
                    console.log('thành công');
                    location.reload();
                } else {
                    console.log('lỗi');
                    location.reload();
                }
            }
        });
    });
});
</script>