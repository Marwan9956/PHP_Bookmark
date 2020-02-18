<div class="search-box logout">
	<label>Welcome : <?php echo $this->session->userdata('username');?></label>
	<a class="btn-logout" href="<?php echo base_url("login/logout");?>">Log out</a>
</div>


