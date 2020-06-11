<!doctype html>
<html lang="en">


<head>

<!-- Basic Page Needs
================================================== -->
<title>Gotem|Admin - Log in</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{asset('backstyling/css/style.css')}}">
<link rel="stylesheet" href="{{asset('backstyling/css/colors/blue.css')}}">

</head>
<body>

<!-- Wrapper -->
<!-- <div id="wrapper"> -->

<!-- Header Container
================================================== -->

<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<center><h2></h2></center>



			</div>
		</div>
	</div>
</div>

<br>
<br>

<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		<div class="col-xl-5 offset-xl-3">


			<div class="login-register-page">
			<center><h2>welcome back Admin!</h2></center><br>

				<!-- Form -->
				<form method="POST" action="{{ route('login') }}" id="login-form">
					@csrf
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}" id="emailaddress" placeholder="Email Address" required/>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border"  @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required/>
                              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>

	<!-- 				<a href="#" class="forgot-password">Forgot Password?</a> -->


				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>

				</form>
			</div>

		</div>
	</div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
<!-- Spacer / End-->

<!-- Footer
================================================== -->

<!-- Scripts
================================================== -->
<script src="{{asset('backstyling/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('backstyling/js/jquery-migrate-3.1.0.min.html')}}"></script>
<script src="{{asset('backstyling/js/mmenu.min.js')}}"></script>
<script src="{{asset('backstyling/js/tippy.all.min.js')}}"></script>
<script src="{{asset('backstyling/js/simplebar.min.js')}}"></script>
<script src="{{asset('backstyling/js/bootstrap-slider.min.js')}}"></script>
<script src="{{asset('backstyling/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('backstyling/js/snackbar.js')}}"></script>
<script src="{{asset('backstyling/js/clipboard.min.js')}}"></script>
<script src="{{asset('backstyling/js/counterup.min.js')}}"></script>
<script src="{{asset('backstyling/js/magnific-popup.min.js')}}"></script>
<script src="{{asset('backstyling//js/slick.min.js')}}"></script>
<script src="{{asset('backstyling/js/custom.js')}}"></script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() {
	Snackbar.show({
		text: 'Your status has been changed!',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	});
});
</script>

</body>


</html>