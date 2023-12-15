<div class="col-lg-6">
	<div class="central-meta">
		<div class="frnds">		
			<?php
			$db = new looking_for_friends();
			$user_id = $_SESSION['id'];
			$get = $db->total_frents($user_id);
			$total =  $get['total'];
			$select = $db->addfr($user_id);
			$count = $select['total'];
			?>

			<ul class="nav nav-tabs">
				<li class="nav-item"><a class="active" href="#frends" data-toggle="tab">Danh sách bạn</a> <span><?=$total?></span></li>
				<li class="nav-item"><a class="" href="#frends-req" data-toggle="tab">Lời mời kết bạn</a><span><?=$count?></span></li>
			</ul>

			<!-- Tab panes -->

			
			<div class="tab-content">
				<div class="tab-pane active fade show " id="frends">
					<ul class="nearby-contct ok">
						<?php
						$user_id = $_SESSION['id'];
						$looking_for_friends = new looking_for_friends();
						$list_frents = $looking_for_friends->list_frents($user_id);
							foreach($list_frents as $iem){
								$user = $iem['user'];
								$avatar = $iem['avatar'] ?? "avatar.jpg";
								if ($user_id !== $user)
								echo '<li>
								<div class="nearly-pepls">
									<figure>
										<a href="" title=""><img src="./View/images/uploads/'.$avatar.'" alt=""></a>
									</figure>
									<div class="pepl-info">
										<h4><a href="./index.php?act=useracout&id='.$user.'" title="">'.$iem['name_count'].'</a></h4>
										<span>2 bạn chung</span>
										<a href="" title="" class="add-butn more-action fens" data-idhu = "'.$iem['friendship_id'].'" data-ripple="">Hủy kêt bạn</a>
										<a href="" title="" class="add-butn" data-ripple="">Nhắn tin</a>
									</div>
								</div>
							</li>';
							}
						

						?>
					</ul>
					<div class="lodmore"><button class="btn-view btn-load-more"></button></div>
				</div>

				<!-- //ádhjas -->
				<div class="tab-pane fade" id="frends-req">
					<ul class="nearby-contct is">
					
						<?php
							$user_id= $_SESSION['id'];
							$looking_for_friends = new looking_for_friends();
							$getidfol = $looking_for_friends->getidfol($user_id);
							foreach ($getidfol as $all){
								// $user_ids = $_SESSION['id'];
								$friendship_id = $all['id_fs'];
								$_SESSION['friendship_id'] = $friendship_id;

								$following_id = $all['fl_id']; 
								$status = $all['status'];


								if ($friendship_id && $user_id == $following_id && trim($status) == "Đã gữi lời mời"){
										echo '<li>
										<div class="nearly-pepls">
											<figure>
												<a href="" title=""><img src="./View/images/uploads/'.($all['avatar'] ? $all['avatar'] :'avatar.jpg').'" alt=""></a>
											</figure>
											<div class="pepl-info">
												<h4><a href="time-line.html" title="">'.$all['name_count'].'</a></h4>
												
												<a href="" title="" class="add-butn more-action btnls"  data-idship="'.$friendship_id.'" data-ripple="" >Xóa lời mời</a>
			
												<a href="" title="" class="add-butn btn-idyes" data-idyes="'.$friendship_id.'" data-ripple="">Đồng ý</a>
											
											</div>
										</div>
									</li>';
									
								}
							}
						?>
					</ul>
					<button class="btn-view btn-load-more"></button>
				</div>
			</div>
		</div>
	</div>
</div><!-- centerl meta -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $(document).on("click", ".btnls", function() {
        var button = $(this);
        var idship = button.data('idship');
		console.log(idship);
        $.ajax({
            url: "/user/ajax.php",
            method: "POST",
            data: {
                action: "delete_fren",
                idship: idship,
            },
            success: function(result) {
                $("#weather-temp").html("<strong>" + result + "</strong> degrees");
				$('.is').load(location.href + ' .is');
				$('.ok').load(location.href + ' .ok');
                console.log(result);
				if (result == true){
					console.log("Bạn đã xoá thành công");

				}
            }
        });
    });
});


jQuery(document).ready(function($) {
    $(document).on("click", ".btn-idyes", function() {
        var button = $(this);
        var idyes = button.data('idyes');
		console.log(idyes);
        $.ajax({
            url: "/user/ajax.php",
            method: "POST",
            data: {
                action: "getyes",
                idyes: idyes,
            },
            success: function(result) {
                $("#weather-temp").html("<strong>" + result + "</strong> degrees");
                console.log(result);
				$('.is').load(location.href + ' .is');
				$('.ok').load(location.href + ' .ok');
				if (result == true){
					console.log("bạn đã thành công");
					location.reload();
				}
            }
        });
    });
});


jQuery(document).ready(function($) {
    $(document).on("click", ".fens", function() {
        var button = $(this); 
        var idhu = button.data('idhu');
		console.log(idhu);
        $.ajax({
            url: "/user/ajax.php",
            method: "POST",
            data: {
                action: "fens",
                idhu: idhu
            },
            success: function(result) {
                $("#weather-temp").html("<strong>" + result + "</strong> degrees");
				$('.ok').load(location.href + ' .ok');
                console.log(result);
				if (result == true){
					console.log("bạn đã thành công");
					// button.style(display: none);
				}
            }
        });
    });
});
</script>