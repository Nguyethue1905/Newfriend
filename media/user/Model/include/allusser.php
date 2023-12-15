<!-- acount -->
<?php
$user_id = $_GET['id'];
$db = new profile();
$select = $db->getList($user_id);
$name = $select['name_count'] ?? "";
?>
<div class="feature-photo">
	<form class="form-cover" id="form-cover" enctype="multipart/form-data" method="post">
		<figure>
			<?php
			$select = $db->getList($user_id);
			$cover_img = $select['cover_img'] ??"";
			$_SESSION['cover_img'] = $cover_img;
			
			if($cover_img == ""){
				echo '<img src="./View/images/uploads/cover.jpg" alt="">';
			}else{
				echo '<img src="./View/images/uploads/'.$cover_img.'" alt="">';
			}
			?>
			
		</figure>
		
	</form>
	<div class="container-fluid">
		<div class="row merged">
			<div class="col-lg-2 col-sm-3">
				<form class="form-avatar" id="form" enctype="multipart/form-data" method="post">
					<div class="user-avatar">
						<figure>
							<?php
							$select = $db->getImg($user_id);
							$avatar = $select['avatar'] ??"";
							if($avatar == ""){
								echo '<img src="./View/images/uploads/avatar.jpg" alt="">';
								
							}else{
								echo '<img src="./View/images/uploads/'.$select['avatar'].'" alt="">';
							}
							?>
						</figure>
					</div>
				</form>
			</div>
			<div class="col-lg-10 col-sm-9">
				<div class="timeline-info">
					<ul>
						<li class="admin-name">
							<span style="margin-bottom:20px;"><?=$name?></span>
							<!-- <h6>( 89 Bạn bè)</h6> -->
						</li>
						<!-- if(frinedship ko tồn tại ) -->
						<li>
							<a href="#" type="submit" class="button-view"><i class="fa-solid fa-square-check" style="color: #08d5a9;"></i> Kết bạn</a>
						</li>
					</ul>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- //demo -->


<script>
	document.getElementById("image").onchange = function() {
		document.getElementById("form").submit();
	}
	document.getElementById("image-cover").onchange = function() {
		document.getElementById("form-cover").submit();
	}
</script>
<?php
$db = new upload();
$reupimg = $db->loadimg();
$recover = $db->loadcover();
?>