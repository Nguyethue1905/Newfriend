<div class="col-lg-6">
    <div class="central-meta">
        <div class="groups">
            <span><i class="fa fa-users"></i>Danh sách tìm kiếm</span>
        </div>
        <ul class="nearby-contct">

            <?php
									if (isset($_POST['searchfr-btn'])){
										$searchfr = $_POST['searchfr'];
										$looking_for_friends = new looking_for_friends();	
										$search_friends = $looking_for_friends->search_friends($searchfr);
										if ($search_friends == true){
											foreach ($search_friends as $friend){
												$_SESSION['user_id'] = $friend['user_id'];
												echo $tl = '<li>
												<div class="nearly-pepls">
													<figure>
														<a href="" title=""><img src="./View/images/uploads/'.($avatar ? $avatar : 'avatar.jpg').'" alt=""></a>
													</figure>
													<div class="pepl-info">
														<h4><a href="" title="">'.$friend['name_count'].'</a></h4>
														<em>32 bạn chung</em>
														<a href="" title="" class="add-butn more-action" data-ripple="">Xem trang cá nhân</a>
														<a href="#" title="" class="add-butn btn-add-friend" data-ripple="" data-ids="'.$friend['user_id'].'">Kết bạn</a>
													</div>
												</div>
											</li>';
											}
											
										}else{
											echo 'lỗi';
												
										}
									}
								?>

        </ul>
        <div class="lodmore"><button class="btn-view btn-load-more"></button></div>
    </div><!-- photos -->
</div><!-- centerl meta -->

<?php
$user_id = $_SESSION['id'];

?>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $(document).on("click", ".btn-add-friend", function(event) {
		event.preventDefault()
        var button = $(this);
        var userId = button.data('ids');
        var user_id_in_js = <?php echo json_encode($user_id); ?>;
        $.ajax({
            url: "/user/ajax.php",
            method: "POST",
            data: {
                action: "addfriend",
                id: userId,
                id_user: user_id_in_js
            },
            success: function(result) {
                $("#weather-temp").html("<strong>" + result + "</strong> degrees");
                console.log(result);
				if (result == true){
					button.text(button.text() === "Huỷ kết bạn" ? "Kết bạn" : "Huỷ kết bạn");
				}
            }
        });
    });
});
</script>
