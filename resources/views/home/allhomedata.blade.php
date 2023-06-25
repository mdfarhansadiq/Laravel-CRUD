<!doctype html>
<html lang="en">
  <head>
  	<title>Table 02</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ asset('asset/htmlCssTableAsset/css/style.css') }}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Table #02</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-dark">
						    <tr>
                                <th>Serial Number</th>
						      <th>ID no.</th>
						      <th>User Name</th>
						      <th>Email</th>
                              <th>Action</th>
						      <th>&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
                            @php
                                $serial = 0;
                            @endphp
                            @foreach ($homeInfoAll as $homeInfo)
						    <tr class="alert" role="alert">
                                <td>{{++$serial}}</td>
                                <td>{{$homeInfo->id}}</td>
						      <td>{{$homeInfo->user_name}}</td>
						      <td>{{$homeInfo->user_email}}</td>
                              <td><button><a href="{{ url('/home-data/edit/'.$homeInfo->id) }}">Edit</a></button></td>
                              <td><button><a href="{{ url('/home-data/delete/'.$homeInfo->id) }}" onclick="return confirm('Are you sure to delete it?')">Delete</a></button></td>
						    </tr>
                            @endforeach
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('asset/htmlCssTableAsset/js/jquery.min.js') }}"></script>
  <script src="{{ asset('asset/htmlCssTableAsset/js/popper.js') }}"></script>
  <script src="{{ asset('asset/htmlCssTableAsset/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('asset/htmlCssTableAsset/js/main.js') }}"></script>

	</body>
</html>

