<script>
$(document).ready(function(){
	var form     = $('#edit_profile');
	var edit_btn = $('button',form);
	var input_list = $('input',form);
	var can_submit = false;
	
	edit_btn.on('click',function(e){
		for(var i= 0; i < input_list.length; i++){
			$(input_list[i]).removeAttr('disabled');
		}
		if(can_submit == false){
			e.preventDefault();
		}
		can_submit= true;
	});
});
	

</script>

<h2>Profile:</h2>
<hr>
<!--------Error Message----------->
<?php $this->load->view('inc/layout/message'); ?>


<form id="edit_profile" method="post" action="<?php base_url("profile/edit");?>">
<?php if($user):?>
	<?php //print_r($user)?>
	
	<img class="user-profile" src="url.jpg" />
	<label for="username">Username</label>
	<input id="username" type="text" name="username" class="inpTxt" placeholder="username"
	value="<?php echo $user->username;?>" disabled />


	<label for="email">Email address</label>
	<input id="email" type="email" name="email" class="inpTxt"  placeholder="Email"
	value="<?php echo $user->email;?>" disabled>

	<label for="firstname">Firstname</label>
	<input id="firstname" name="firstname" type="text" class="inpTxt" placeholder="firstname"
	value="<?php echo $user->firstName;?>" disabled />


	<label for="lastname">Lastname</label>
	<input id="lastname" name="lastname" type="text" class="inpTxt" placeholder="lastname" 
	value="<?php echo $user->lastName;?>"  disabled />

	<button  name="edit_profile" type="submit" class="btn-submit">
		Edit Prfile
	</button>
	
</form>
<?php else:?>

<?php endif;?>
