
	<div class="col-lg-6">
		<div class="central-meta">
			<div class="editing-interest">
				<h5 class="f-title"><i class="ti-bell"></i>Tất cả thông báo</h5>
				<div class="notification-box">
					<ul>
						<?php
								$user_id = $_SESSION['id'];
								$looking_for_friends = new looking_for_friends();
								$notifications = $looking_for_friends->notifications($user_id);
								$avatar = $get['avatar'] ?? "";
								foreach ($notifications as $item){
										echo '<li class="bell-on" >
										<a href="./index.php?act=insights&id_post='.$item['posts_id'].'&id_cm='.$item['cmt_id'].'">
											<figure><img onclick="coutss()" src="./View/images/uploads/'.($item['avatar'] ? $item['avatar'] : 'avatar.jpg').'" alt=""></figure>
											<div class="notifi-meta">
												<h5>'.$item['name_fl'].'</h5>
												<p>'.$item['name_fl'].' đã bình luận bài viết '.$item['content'].'</p>
												<span>'.$item['date_cmt'].'</span>
											</div>
										</a>
									</li>';
								}
				
						?>
					</ul>
				</div>

<div class="col-lg-6">
	<div class="central-meta">
		<div class="editing-interest">
			<h5 class="f-title"><i class="ti-bell"></i>Tất cả thông báo</h5>
			<div class="notification-box">
				<ul>
					<?php
							$user_id = $_SESSION['id'];
							$looking_for_friends = new looking_for_friends();
							$notifications = $looking_for_friends->notifications_cmt($user_id);
							$avatar = $get['avatar'] ?? "";
							foreach ($notifications as $item){
									echo '<li class="bell-on" >
									<a href="./index.php?act=insights&id_post='.$item['posts_id'].'&id_cm='.$item['cmt_id'].'">
										<figure><img onclick="coutss()" src="./View/images/uploads/'.($item['avatar'] ? $item['avatar'] : 'avatar.jpg').'" alt=""></figure>
										<div class="notifi-meta">
											<p><h6>'.$item['name_count'].'</h6><p> đã bình luận bài viết của bạn</p></p>
											
											<span>'.$item['date_cmt'].'</span>
										</div>
									</a>
								</li>';
							}
					?>
				</ul>

			</div>
		</div>
	</div><!-- centerl meta -->

	<script>
		function coutss(){
			var coutsl = <?php echo $couts ?>;
			console.log(coutss);
			
		}
	</script>