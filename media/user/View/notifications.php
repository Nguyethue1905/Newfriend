
<div class="col-lg-6">
	<div class="central-meta">
		<div class="editing-interest">
			<h5 class="f-title"><i class="ti-bell"></i>Tất cả thông báo</h5>
			<div class="notification-box">
				<ul>
					<?php

					$user_id = $_SESSION['id'];
					$looking_for_friends = new looking_for_friends();
					$bell = $looking_for_friends->bell($user_id);
					
					foreach($bell as $item){
						$data = new profile();
						$user_id = $item['user'];
						$profile = $data->getList($user_id);
						if($item['type'] == 'like'){
							echo '<li class="bell-on" >
							<a href="./index.php?act=insights&id_post=' . $item['posts_id'] . '">
								<figure><img onclick="coutss()" src="./View/images/uploads/' . ($profile['avatar'] ? $profile['avatar'] : 'avatar.jpg') . '" alt=""></figure>
								<div class="notifi-meta">
									<p style="font-size:17px;">' . $profile['name_count'] . ' </p> vừa yêu thích bài viết của bạn
									<span>' . $item['datetime'] . '</span>
								</div>
							</a>
						</li>';
						}elseif($item['type'] == 'comment'){
							echo '<li class="bell-on" >
							<a href="./index.php?act=insights&id_post=' . $item['posts_id']. '">
								<figure><img onclick="coutss()" src="./View/images/uploads/' . ($profile['avatar'] ? $profile['avatar'] : 'avatar.jpg') . '" alt=""></figure>
								<div class="notifi-meta">
									<p style="font-size:17px;">' . $profile['name_count'] . '</p> đã bình luận bài viết của bạn
									<span>' . $item['datetime'] . '</span>
								</div>
						</li>';
						}else{
							echo "";
						}
					}
				

					?>
				</ul>
			</div>
		</div>
	</div>
</div><!-- centerl meta -->

<script>
	function coutss() {
		var coutsl = <?php echo $couts ?>;
		console.log(coutss);

	}
</script>