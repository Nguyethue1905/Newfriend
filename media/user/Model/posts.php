<?php
class posts
{
    var $user_id = null;
    var $content = null;
    var $filename = null;
    var $posts_id = null;
    var $friendship_id  = null;
    var $postlike_id  = null;

    public function countlike($posts_id)
    {
        $db = new connect();
        $sql =  "SELECT COUNT(postlike_id) FROM `postlike` WHERE postlike.posts_id = '.$posts_id.'";
        $result = $db->pdo_query($sql);
        return $result;
    }
    
    public function addPost($user_id, $content)
    {
        $db = new connect();
        $sql =  "INSERT INTO `posts`(`user_id`,`content`) VALUES ('$user_id', '$content')";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function getid_post(){
        $db = new connect();
        $sql =  "SELECT MAX(posts_id) AS latest_id FROM posts" ;
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    
    public function isetimg($filename,$posts_id){
        $db = new connect();
        $sql =  "INSERT INTO `image`(`posts_id`,`filename`) VALUES ('$posts_id', '$filename')";
        $result = $db->pdo_query($sql);
        return $result; 
    }
    public function getPost($user_id){
        $db = new connect();
        $sql = 'SELECT users.user_id as user_post, userproflie.name_count, userproflie.avatar, posts.posts_id, posts.content, posts.date_post
        FROM users
        INNER JOIN userproflie ON users.user_id = userproflie.user_id
        INNER JOIN posts ON users.user_id = posts.user_id
        INNER JOIN friendship ON users.user_id = friendship.user_id OR users.user_id = friendship.following_id 
        WHERE ((friendship.status = "Kết bạn thành công" )AND (friendship.user_id = '.$user_id.' OR friendship.following_id = '.$user_id.')) 
        OR (posts.user_id ='.$user_id .')
        GROUP BY posts.posts_id,userproflie.name_count,userproflie.avatar
        ORDER BY posts.date_post DESC';
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function getList($user_id){
        $db = new connect();
        $sql = 'SELECT posts.user_id, userproflie.name_count, userproflie.avatar, posts.posts_id, posts.content, posts.date_post, COUNT(image.filename) as image_count 
        FROM users 
        INNER JOIN userproflie ON users.user_id = userproflie.user_id 
        INNER JOIN posts ON users.user_id = posts.user_id
        LEFT JOIN image ON posts.posts_id = image.posts_id WHERE users.user_id = '.$user_id.'
        GROUP BY users.user_id, userproflie.name_count, userproflie.avatar, posts.posts_id, posts.content, posts.date_post
        ORDER BY posts.date_post DESC;';
        $result = $db->pdo_query($sql);
        return $result;
    }


    public function getfile($posts_id){
        $db = new connect();
        $sql = 'SELECT filename FROM image WHERE posts_id ='.$posts_id;
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function getDate($posts_id){
        $db = new connect();
        $sql = 'SELECT FLOOR(minutes_ago / 1440) AS days, FLOOR((minutes_ago % 1440) / 60) AS hours, minutes_ago % 60 AS minutes FROM ( SELECT TIMESTAMPDIFF(MINUTE, date_post, NOW()) AS minutes_ago FROM posts WHERE posts_id = '.$posts_id.' ) AS time_diff;';
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    public function Delete($posts_id, $user_id){
        $db = new connect();
    
        $sql1 = "DELETE FROM postlike WHERE postlike_id = '$posts_id'";
        $result1 = $db->pdo_query_one($sql1);

        $sql2 = "DELETE FROM image WHERE posts_id = '$posts_id'";
        $result2 = $db->pdo_query($sql2);

        $sql4 = "DELETE FROM postscomment WHERE posts_id = '$posts_id'";
        $result4 = $db->pdo_query_one($sql4);
    
        $sql5 = "DELETE FROM posts WHERE posts_id = '$posts_id' AND user_id = '$user_id'";
        $result5 = $db->pdo_query_one($sql5);
        
        $allQueriesSuccessful = $result1 && $result2 && $result4 && $result5;
        
        return ($result1 && $result2 && $result4 && $result5); // Trả về true nếu cả ba lệnh đều thành công
    }
    
    public function addLike($posts_id,$user_id){
        $db = new connect();
        $sql =  "INSERT INTO `postlike` (`posts_id`,`user_id`) VALUES ('$posts_id', '$user_id')";
        $result = $db->pdo_query_one($sql);
        return $result; 
    }
    public function deleteLike($postlike_id){
        $db = new connect();
        $sql =  "DELETE FROM `postlike` WHERE `postlike_id` = '$postlike_id'";
        $result = $db->pdo_query_one($sql);
        return $result; 
    
    }
    public function getLike($posts_id,$user_id){
        $db = new connect();
        $sql =  "SELECT * FROM `postlike` WHERE user_id = '$user_id' AND posts_id= '$posts_id'";
        $result = $db->pdo_query_one($sql);
        return $result; 
    }
    public function getIdLike($posts_id, $user_id){
        $db = new connect();
        $sql =  "SELECT postlike_id FROM `postlike` WHERE user_id = '$user_id' AND posts_id= '$posts_id'";
        $result = $db->pdo_query_one($sql);
        return $result; 
    }
    public function sergetPost($user_id, $posts_id){
        $db = new connect();
        $sql = "SELECT
                    users.user_id,
                    userproflie.name_count,
                    userproflie.avatar,
                    posts.posts_id,
                    posts.content,
                    posts.date_post
                FROM
                    users
                INNER JOIN userproflie ON users.user_id = userproflie.user_id
                INNER JOIN posts ON users.user_id = posts.user_id
                INNER JOIN friendship ON users.user_id = friendship.user_id OR users.user_id = friendship.following_id
                WHERE
                    (
                        (friendship.status = 'Kết bạn thành công' AND (friendship.user_id = $user_id OR friendship.following_id = $user_id))
                        OR (users.user_id = $user_id)
                    )
                    AND posts.posts_id = $posts_id
                GROUP BY
                    posts.posts_id,
                    userproflie.name_count,
                    userproflie.avatar
                ORDER BY
                    posts.date_post DESC";
        $result = $db->pdo_query_one($sql);
        return $result;
    }
    


}