<?php
class comment
{
    var $cmt_id = null;
    var $posts_id  = null;
    var $comment = null;
    var $user_id  = null;
    var $date_cmt = null;

    public function getAdd($posts_id, $comment, $user_id){
        $db = new connect();
        $sql =  "INSERT INTO `postscomment`(`posts_id`,`user_id`,`comment`) VALUES ('$posts_id', '$user_id','$comment') ";
        $result = $db->pdo_query_one($sql);
        return $result;
    }
    public function getListcmt($posts_id){
        $db = new connect();
        $sql =  "SELECT * 
        FROM postscomment
        INNER JOIN userproflie ON postscomment.user_id = userproflie.user_id
        WHERE posts_id = '$posts_id'
        ORDER BY postscomment.cmt_id DESC";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function ser_cmt($cmt_id){
        $db = new connect();
        $sql =  "SELECT * 
        FROM postscomment
        INNER JOIN userproflie ON postscomment.user_id = userproflie.user_id
        WHERE postscomment.cmt_id = '$cmt_id'
        ORDER BY postscomment.cmt_id DESC";
        $result = $db->pdo_query($sql);
        return $result;
    }
    
    public function getDate($cmt_id){
        $db = new connect();
        $sql = 'SELECT FLOOR(minutes_ago / 1440) AS days, FLOOR((minutes_ago % 1440) / 60) AS hours, minutes_ago % 60 AS minutes FROM ( SELECT TIMESTAMPDIFF(MINUTE, date_cmt, NOW()) AS minutes_ago FROM postscomment WHERE cmt_id = '.$cmt_id.' ) AS time_diff;';
        $result = $db->pdo_query_one($sql);
        return $result;
    }
    public function postscomment($user_id, $posts_id, $cmt_id, $content){
        $db = new connect();
        $sql = "INSERT INTO `recomment`(user_id, posts_id, cmt_id, content) VALUES ('$user_id','$posts_id','$cmt_id','$content')";
        $result = $db->pdo_query_one($sql);
        return $result;
    }
  
}
?>