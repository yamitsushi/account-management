<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Demo Management</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="card o-hidden shadow-lg my-5 card-border">
						<div class="card-body text-center">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Please Wait</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>