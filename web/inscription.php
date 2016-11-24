<h1 class="text-center">
	Sign in
	<span class="subtitle">No account yet ? --> <a href="<?=BASEURL?>/index.php/user/signup">Sign up</a></span>
</h1>

<form action="<?=BASEURL?>/index.php/user/signin" method="post">
	<div class="formline">
		<label for="login">Your login</label>
		<input type="text" id="login" placeholder="login" name="login">
	</div>
	
	<div class="formline">
		<label for="password">Your password</label>
		<input type="password" id="password" placeholder="*****" name="password">
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" value="Sign in">
	</div>
</form>

