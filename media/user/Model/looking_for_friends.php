<?php
class looking_for_friends
{
    var $user_id = null;
    var $content = null;
    var $filename = null;
    var $posts_id = null;
    var $username = null;
    var $searchfr = null;
    var $following_id = null;
    var $friendship_id = null;
    var $user_id_s = null;
    
    public function search_friends($searchfr)
    {
        $db = new connect();
        $sql =  "SELECT * FROM userproflie INNER JOIN users ON userproflie.user_id = users.user_id LEFT JOIN friendship ON friendship.user_id = users.user_id OR users.user_id = friendship.following_id WHERE userproflie.name_count LIKE '%$searchfr%'";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function search_userproflie($searchfr)
    {
        $db = new connect();
        $sql =  "SELECT * FROM users WHERE username LIKE '%$searchfr%';";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function friendships($user_id, $following_id)
    {
        $db = new connect();
        $sql =  "INSERT INTO friendship (`user_id`, `following_id`) VALUES ('$user_id', '$following_id')";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function slfriendships($user_id)
    {
        $db = new connect();
        $sql =  "SELECT * FROM friendship WHERE user_id = '$user_id'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }
    public function getidfol($user_id_s)
    {
        $db = new connect();
        $sql = "SELECT friendship.user_id AS idfrend, friendship.following_id AS fl_id, friendship.friendship_id AS id_fs, friendship.status AS status FROM friendship INNER JOIN users ON friendship.following_id = users.user_id INNER JOIN userproflie ON users.user_id = userproflie.user_id WHERE friendship.following_id='$user_id_s'";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function getid($user_id)
    {
        $db = new connect();
        $sql =  "SELECT * FROM userproflie WHERE user_id = '$user_id'";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function getyes($friendship_id)
    {
        $db = new connect();
        $sql =  "UPDATE friendship SET status = 'Kết bạn thành công' WHERE friendship_id = '$friendship_id'";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function delete_idfen($friendship_id)
    {
        $db = new connect();
        $sql =  "DELETE FROM friendship WHERE friendship_id = '$friendship_id'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }
    public function all_frendship($user_id, $following_id)
    {
        $db = new connect();
        $sql =  "SELECT * FROM friendship WHERE (user_id = '$user_id' AND following_id = '$following_id') OR (user_id = '$following_id' AND following_id = '$user_id')";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function list_frents($user_id)
    {
        $db = new connect();
        $sql =  "SELECT userproflie.name_count, users.user_id as user, userproflie.avatar, friendship.friendship_id, friendship.following_id, friendship.status, friendship.user_id FROM friendship INNER JOIN users ON users.user_id = friendship.user_id INNER JOIN userproflie ON userproflie.user_id = users.user_id WHERE friendship.status = 'Kết bạn thành công' AND (friendship.user_id = '$user_id' or friendship.following_id = '$user_id') UNION SELECT userproflie.name_count, users.user_id as user, userproflie.avatar, friendship.friendship_id, friendship.following_id, friendship.status, friendship.user_id FROM friendship INNER JOIN users ON users.user_id = friendship.following_id INNER JOIN userproflie ON userproflie.user_id = users.user_id WHERE friendship.status = 'Kết bạn thành công' AND (friendship.user_id = '$user_id' or friendship.following_id = '$user_id');";
        $result = $db->pdo_query($sql);
        return $result;
    }


    public function udpnotifications($friendship_id)
    {
        $db = new connect();
        $sql =  "UPDATE friendship SET status = 'Đã huỷ kết bạn' WHERE friendship_id = '$friendship_id'";
        $result = $db->pdo_query($sql);
        return $result;
    }
    public function total_frents($user_id)
    {
        $db = new connect();
        $sql =  "SELECT COUNT(status) as total
        FROM friendship
        WHERE (friendship.following_id = '$user_id' OR friendship.user_id = '$user_id') AND status = 'Kết bạn thành công'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }
    public function addfr($user_id)
    {
        $db = new connect();
        $sql =  "SELECT COUNT(friendship.status) as total
        FROM friendship
        WHERE (friendship.following_id = '$user_id' OR friendship.user_id = '$user_id') AND status = 'Đã gữi lời mời'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    //thong_bao

    public function notifications_cmt($user_id)
    {
        $db = new connect();
        $sql =  "SELECT users.user_id, userproflie.name_count, userproflie.avatar, posts.posts_id, 
        postscomment.comment, postscomment.cmt_id, postscomment.date_cmt, friendship.friendship_id,friendship.following_id
        FROM users 
        INNER JOIN userproflie ON users.user_id = userproflie.user_id 
        INNER JOIN posts ON users.user_id = posts.user_id 
        INNER JOIN postscomment ON posts.posts_id = postscomment.posts_id 
        INNER JOIN friendship ON users.user_id = friendship.user_id OR users.user_id = friendship.following_id 
        WHERE ((friendship.status = 'Kết bạn thành công') AND (friendship.user_id = $user_id OR friendship.following_id = $user_id))
        AND users.user_id != $user_id 
        GROUP BY posts.posts_id,userproflie.name_count,userproflie.avatar,postscomment.date_cmt,postscomment.comment,
        friendship.friendship_id,friendship.following_id ,postscomment.cmt_id 
        ORDER BY postscomment.date_cmt DESC;";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function notifications_posts($user_id)
    {
        $db = new connect();
        $sql = "SELECT users.user_id, userproflie.name_count, userproflie.avatar, posts.posts_id, posts.content, posts.date_post
        FROM users
        INNER JOIN userproflie ON users.user_id = userproflie.user_id
        INNER JOIN posts ON users.user_id = posts.user_id
        INNER JOIN friendship ON users.user_id = friendship.user_id OR users.user_id = friendship.following_id 
        WHERE ((friendship.status = 'Kết bạn thành công')
        AND (friendship.user_id = $user_id OR friendship.following_id = $user_id))
        AND users.user_id !=$user_id
        GROUP BY posts.posts_id,userproflie.name_count,userproflie.avatar
        ORDER BY posts.date_post DESC";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function notifications_likes($user_id)
    {
        $db = new connect();
        $sql = "SELECT users.user_id, userproflie.name_count, userproflie.avatar, 
        posts.posts_id,friendship.friendship_id,friendship.following_id, postlike.postlike_id, postlike.user_id 
        FROM users 
        INNER JOIN userproflie ON users.user_id = userproflie.user_id 
        INNER JOIN posts ON users.user_id = posts.user_id 
        INNER JOIN postlike ON posts.posts_id = postlike.posts_id 
        INNER JOIN friendship ON users.user_id = friendship.user_id OR users.user_id = friendship.following_id 
        WHERE ((friendship.status = 'Kết bạn thành công') AND (friendship.user_id = $user_id OR friendship.following_id = $user_id)) 
        AND users.user_id != $user_id
        GROUP BY posts.posts_id,userproflie.name_count,userproflie.avatar,postlike.postlike_id,
        postlike.user_id, friendship.friendship_id,friendship.following_id 
        ORDER BY postlike.datetime DESC;";
        $result = $db->pdo_query($sql);
        return $result;
    }


    public function bell($user_id)
    {
        $db = new connect();
        $sql =  "SELECT * FROM (
            (SELECT postscomment.date_cmt AS date FROM postscomment)
            UNION ALL
            (SELECT posts.date_post AS date  FROM posts)
            UNION ALL
            (SELECT postlike.datetime AS date FROM postlike)
        ) AS combined
        ORDER BY combined.date DESC
        ";
        $result = $db->pdo_query_one($sql);
        return $result;
    }
}