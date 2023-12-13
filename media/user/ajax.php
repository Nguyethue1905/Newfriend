<?php

include './Model/looking_for_friends.php';
include './Model/model.php';
include './Model/comment.php';
include './Model/posts.php';

// Gữi lời mời kết bạn
if($_POST['action'] == 'addfriend'){
    $following_id = $_POST['id'] ?? "";
    $user_id  = $_POST['id_user'] ?? "";  
    $looking_for_friends = new looking_for_friends();
	$all_frendship = $looking_for_friends->all_frendship($user_id, $following_id);
    if ($user_id !== $following_id && !$all_frendship) {
		$friendships = $looking_for_friends->friendships($user_id, $following_id);
        if ($friendships == true){            
            echo "Thành công rồi á";
        }
    }else{
        echo "bạn đã kết bạn rồi";
    }
    echo true;
}

//xoá lời mời kết bạn
if ($_POST['action'] == 'delete_fren'){
    $friendship_id = $_POST['idship'] ?? "";
    $looking_for_friends = new looking_for_friends();
    $delete_idfen = $looking_for_friends->delete_idfen($friendship_id);
    if ($delete_idfen == true){
        echo "thành công";
    }
    echo true;
}

// tạo bài post
if($_POST['action'] == 'addCmt'){
    $user_id =  $_POST['user_id'] ?? "";
    $posts_id =  $_POST['posts_id'] ?? "";
    $comment =  $_POST['comment'] ?? "";
    $db = new comment();
    $add = $db->getAdd($posts_id, $comment, $user_id);
    if($add == true){
        echo "Thành công nhé";
    }
    echo true;
}

if($_POST['action'] == 'deletepost'){
    $user_id =  $_POST['user_id'] ?? "";
    $posts_id =  $_POST['posts_id'] ?? "";
    $db = new posts();
    $add = $db->Delete($posts_id, $user_id);
    if($add == true){
        echo "thành công nhé";
    }
    echo true;
}




if($_POST['action'] == 'getyes'){
	$friendship_id = $_POST['idyes'];
	$looking_for_friends = new looking_for_friends();
	$getyes = $looking_for_friends->getyes($friendship_id);
	if ($getyes == true) {
		echo 'thành công';
        exit();
	}else{
		echo 'Lỗi kết bạn';
	}
    echo true;
}


//Like posts
if($_POST['action'] == 'addLike'){
    $user_id = $_POST['user_id'];
    $posts_id = $_POST['posts_id'];
    $db = new posts();
    $add = $db->addLike($posts_id, $user_id);
    $response = array(
        'status' => 'success',
        'posts_id' => $posts_id
    );  
    echo json_encode($response);
}

//Unlike posts
if($_POST['action'] == 'deleteLike'){
    $postlike_id = $_POST['postlike_id'];
    $db = new posts();
    $delete = $db->deleteLike($postlike_id);
        $response = array(
            'status' => 'success',
            'postlike_id' => $postlike_id
        );  
    echo json_encode($response);
}



if($_POST['action'] == 'fens'){
    $db = new looking_for_friends();
    $friendship_id = $_POST['idhu'];
    $udpnotifications = $db->udpnotifications($friendship_id);
    if($udpnotifications == true){
        echo "Huỷ kết bạn thành công thành công";
    }
    echo true;
}
 
