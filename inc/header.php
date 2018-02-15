		
		<div id="header">
			
			<div id="top-header">
				<ul class="ul_contact">
					<li><a href="#"><i class="fa fa-phone"></i> +385 02 701 821</a></li>
					<li><a href="ContactForm.php"><i class="fa fa-envelope"></i> Contact Us</a></li>
				</ul>

				<ul class="ul_social">
					<li id="fa-face"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li id="fa-twit"><a href="#" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li id="fa-gplus"><a href="#" ><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					<li id="fa-github"><a href="#" ><i class="fa fa-github" aria-hidden="true"></i></a></li>
					<li id="fa-in"><a href="#" ><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					<li id="fa-inst"><a href="#" ><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				</ul>
			</div>
			
			<div id="logo">
				<a href="index.php"><img src="imgs/P.jpg" width="59" height="70" alt="POSTERS"/></a>
			</div><!-- end of logo-->
			
			<div id="link">
				<ul class="link-nav">
					<li><a href="#" id="signedIn"> 
						<?php
							if(isset($_COOKIE['user'])){
						?>
								<i class="fa fa-lock"></i>
						<?php
								echo $_COOKIE['user'];
						?>
								<span class="caret"></span></a><!--
								<ul class="dropdown-menu" style="margin-left:-59px; border:1px solid #fff;background:#b3003b;">
									<li><a href="#.php" style="color:#fff;">Logout</a></li>											
								</ul>
								-->
					</li>

					<li><a href="Myprofile.php"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
						<ul>
							<li><a href="Myprofile.php">View Profile</a></li>
							<li><a href="Myprofile.php?editProfile">Edit Profile</a></li>
							<li><a href="Myprofile.php?editPass">Change password</a></li>
						</ul>
					</li>

					<!-- SignOut Form-->
						<form method="POST" action="" id="signOut_form" style="margin-left:920px;position:fixed;"> 
							<span id="closeSignOutForm" style="color:#b3003b;cursor:pointer; float:right; font-weight:bold;">&times;</span> 
							<!--<h4 style="color:#b3003b;">Thank you for shopping with us, hope we see you soon.</h4>
							<br /> <br />-->
						
							<a href="Log-out.php" name="signOut" id="signOut" class="btn btn-danger"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
					    </form><!-- end of signOut form -->
						

					<?php
							}else{
					?>


					<li><a id="btn-login" href="#"><i class="fa fa-lock"></i> LogIn</a>
						<!--onclick="document.getElementById('form_signIn').style.display='block'"-->
					
						<!-- Begin SignIn form -->
						<form method="post" style="margin-left:-820px;" id="form_signIn" class="animate">
							
							<!--<span onclick="document.getElementById('form_signIn').style.display='none'" class="close" title="Close Sign-In Form">-->
							<span id="close" style="color:red; cursor:pointer; float:right; font-weight:bold;">&times;</span>
							
							<center style="color:#b30030;">
								<h3>Already know each other?</h3>
								<p>Log in to access your account and find all your benefits.</p>
							</center>
							<br>
							<table>
								<tr>
									<td style="font-size:19px; color:#b30030;">Username: </td>
									<td><input type="text" id="username" name="username" placeholder="Email@email.com" value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username'];?>"/></td>
								</tr>
								<tr>
									<td style="font-size:19px; color:#b30030;">Password: </td>
									<td><input type="password" id="password" name="password" placeholder="************" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password'];?>"/></td>
								</tr>
							</table>
							<button type="button" id="show_password" name="show_password" style="float:right;" class="btn btn-link">Show Password</button>
								<center id="signIp_btn">
									<input type="submit" name="login_btn" id="login_button" value="Login" />
									<!--<input type="button" name="for_pass" value="Forget Password ?" />-->
								</center>
									<input type="checkbox" style="margin:26px 15px;" name="remember">Remember me
									<a href="#" id="forgot_pswd" style="color:blue; text-decoration:none; float:right; margin-right:34px; margin-top:26px;">Forgot Your Password?</a>				
						</form><!-- End signIn form -->
						
							<?php echo SignIn();?>

						<!-- Forgot password form -->
						<form method="post" id="forgotpswd_form">
							<br clear="all"/>
							<table style="border:1px;">
								<tr>
									<td ><center><a href="#" class="btn-login" style="color:#000 !important;"><b>Sign In</b></a></center></td>
									<td><a href="#" class="btn-logup" style="border-left:1px solid #ededed;text-decoration:none;color:#b3003b !important;">Create an account</a><span id="closeForgotForm" style="color:red; cursor:pointer; float:right; font-weight:bold;margin-top:-8px;">&times;</span></td>
								</tr>
							</table> 
							<hr style="width:105.5%;margin-left:-13px;">
							<p style="line-height:25px;padding:0px 14px;">Please enter your e-mail address and we will send you a link to reset your password.</p>
							<!--<p style="padding:0px 0px 0px 14px;font-size:15.9px;color:#000;">e-mail Address</p>-->
							<center>
								<input type="text" name="Forgotpasswordemail" id="Forgotpassword" placeholder="type your email here." class=""/>
							</center>
							<center id="signIp_btn">
								<input type="submit" name="send_password" id="send_password" value="Reset Password" class="btn btn-primary" style="border:1px solid #fff;"/> 
							</center>
					   </form><!-- end of forgot password form -->

					  <?php echo forgot_pass(); ?>
					</li><!-- end of sign in form -->
					

					<!-- Sign up form -->
					<li><a href="#" id="btn-logup"><i class="fa fa-user"></i> Account</a>
						<!--onclick="document.getElementById('form_signUp').style.display='block'"-->
						<form name="form" method="post" enctype="multipart/form-data" style="margin-left:-720px;" id="form_signUp" class="animate">
							<h2 style="float:left;">Create an Account </h2>
							<!--<span onclick="document.getElementById('form_signUp').style.display='none'" class="close" title="Close PopUp">--><span id="closeUp" style="color:red; cursor:pointer; float:right; font-weight:bold;">&times;</span>

							<div id="comments_Div">
								<div id="emptyName"></div>
								<div id="Notavailable"></div><br>
								<span id="availability"></span>
							</div>

							<table>
								<tr>
									<td>Enter your Name</td>
									<td><input type="text" name="u_name" id="u_name" /></td>
								</tr>
								<tr>
									<td>Upload your Picture</td>
									<td><input type="file" name="u_img" /></td>
								</tr>
								<tr>
									<td>Enter your Email</td>
									<td><input type="email" name="u_email" id="u_mail" disabled/></td>
								</tr>
								<tr>
									<td>Enter Nickname</td>
									<td><input type="text" name="u_nickname" /></td>
								</tr>
								<tr>
									<td>Enter your Address</td>
									<td><textarea name="u_add" ></textarea></td>
								</tr>
								<tr>
									<td>Enter your Country</td>
									<td><input type="text" name="u_country" /></td>
								</tr>
								<tr>
									<td>Enter your City</td>
									<td><input type="text" name="u_state" /></td>
								</tr>
								<tr>
									<td>Enter your Date of Birth</td>
									<td><input type="date" name="u_date" /></td>
								</tr>
								<tr>
									<td>Enter your Phone No.</td>
									<td><input type="tel" name="u_phone" /></td>
								</tr>
							</table>
							<center id="signUp_btn">
								<input type="submit" name="u_signup" id="u_signup" value="SignUp" disabled/>
								<input type="reset" name="reset" value="Reset"/>
							</center>
						</form>
						<?php echo Sign_Up(); ?>
					</li>

				<?php
						
					}
				?>

					<li><a href="cart.php" style="color:#00ffff; top:-5px;"><span class="glyphicon glyphicon-shopping-cart"></span>(<?php echo cart_count(); ?>)</a></li>
				</ul>
			</div><!--end of link-->
			
			<div id="search">
				<form method="get" action="search.php" encrypt="multipart/form-data">
					<input type="text" id="InSearch" name="user_query" placeholder="Searh Form Here..."/>
					<button name="search" id="search_btn"><span class="glyphicon glyphicon-search"></span> Search</button>
					<!--<button id="cart_btn"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <?php //echo cart_count(); ?></a></button>-->
				</form><!--end of search-->
			</div>

		</div><!--end of header-->
		