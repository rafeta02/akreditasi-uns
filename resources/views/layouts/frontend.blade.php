<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('rocker/images/favicon-32x32.png') }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('rocker/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
	<link href="{{ asset('rocker/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('rocker/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('rocker/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('rocker/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('rocker/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('rocker/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('rocker/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('rocker/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('rocker/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('rocker/css/dark-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('rocker/css/semi-dark.css') }}" />
	<link rel="stylesheet" href="{{ asset('rocker/css/header-colors.css') }}" />
	<title>@yield('title', 'Akreditasi LPPMP UNS')</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="rocker/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">LPPMP UNS</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="menu-label">Akreditasi</li>
				<li>
					<a href="index.html">
						<div class="parent-icon"><i class='bx bx-home-alt'></i>
						</div>
						<div class="menu-title">Rekapitulasi</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Sertifikat</div>
					</a>
					<ul>
						<li> <a href="table-datatable.html"><i class='bx bx-radio-circle'></i>Datatable</a>
						</li>
						<li> <a href="timeline.html"><i class='bx bx-radio-circle'></i>Timeline</a>
						</li>
						<li> <a href="app-file-manager.html"><i class='bx bx-radio-circle'></i>File Manager</a>
						</li>
						<li> <a href="app-contact-list.html"><i class='bx bx-radio-circle'></i>Contatcs</a>
						</li>
						<li> <a href="app-to-do.html"><i class='bx bx-radio-circle'></i>Todo List</a>
						</li>
						<li> <a href="app-invoice.html"><i class='bx bx-radio-circle'></i>Invoice</a>
						</li>
						<li> <a href="app-fullcalender.html"><i class='bx bx-radio-circle'></i>Calendar</a>
						</li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>

					<div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal"
						data-bs-target="#SearchModal">
						<input class="form-control px-5" disabled type="search" placeholder="Search">
						<span
							class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i
								class='bx bx-search'></i></span>
					</div>


					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
								data-bs-target="#SearchModal">
								<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
								</a>
							</li>
							<li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;"
									data-bs-toggle="dropdown"><img src="rocker/images/county/02.png" width="22" alt="">
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
												src="rocker/images/county/01.png" width="20" alt=""><span
												class="ms-2">English</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
												src="rocker/images/county/02.png" width="20" alt=""><span
												class="ms-2">Catalan</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
												src="rocker/images/county/03.png" width="20" alt=""><span
												class="ms-2">French</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
												src="rocker/images/county/04.png" width="20" alt=""><span
												class="ms-2">Belize</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
												src="rocker/images/county/05.png" width="20" alt=""><span
												class="ms-2">Colombia</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
												src="rocker/images/county/06.png" width="20" alt=""><span
												class="ms-2">Spanish</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
												src="rocker/images/county/07.png" width="20" alt=""><span
												class="ms-2">Georgian</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
												src="rocker/images/county/08.png" width="20" alt=""><span
												class="ms-2">Hindi</span></a>
									</li>
								</ul>
							</li>
							<li class="nav-item dark-mode d-none d-sm-flex">
								<a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
								</a>
							</li>

							<li class="nav-item dropdown dropdown-app">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"
									href="javascript:;"><i class='bx bx-grid-alt'></i></a>
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="app-container p-2 my-2">
										<div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/slack.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Slack</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/behance.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Behance</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/google-drive.png" width="30"
																alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Dribble</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/outlook.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Outlook</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/github.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">GitHub</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/stack-overflow.png" width="30"
																alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Stack</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/figma.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Stack</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/twitter.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Twitter</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/google-calendar.png" width="30"
																alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Calendar</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/spotify.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Spotify</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/google-photos.png" width="30"
																alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Photos</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/pinterest.png" width="30"
																alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Photos</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/linkedin.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">linkedin</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/dribble.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Dribble</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/youtube.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">YouTube</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/google.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">News</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/envato.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Envato</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="javascript:;">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="rocker/images/app/safari.png" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Safari</p>
														</div>
													</div>
												</a>
											</div>

										</div>
										<!--end row-->

									</div>
								</div>
							</li>

							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
									data-bs-toggle="dropdown"><span class="alert-count">7</span>
									<i class='bx bx-bell'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-badge">8 New</p>
										</div>
									</a>
									<div class="header-notifications-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="rocker/images/avatars/avatar-1.png" class="msg-avatar"
														alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Daisy Anderson<span
															class="msg-time float-end">5 sec
															ago</span></h6>
													<p class="msg-info">The standard chunk of lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger">dc
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Orders <span class="msg-time float-end">2
															min
															ago</span></h6>
													<p class="msg-info">You have recived new orders</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="rocker/images/avatars/avatar-2.png" class="msg-avatar"
														alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Althea Cabardo <span
															class="msg-time float-end">14
															sec ago</span></h6>
													<p class="msg-info">Many desktop publishing packages</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success">
													<img src="rocker/images/app/outlook.png" width="25"
														alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Account Created<span
															class="msg-time float-end">28 min
															ago</span></h6>
													<p class="msg-info">Successfully created new email</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-info text-info">Ss
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Product Approved <span
															class="msg-time float-end">2 hrs ago</span></h6>
													<p class="msg-info">Your new product has approved</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="rocker/images/avatars/avatar-4.png" class="msg-avatar"
														alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Katherine Pechon <span
															class="msg-time float-end">15
															min ago</span></h6>
													<p class="msg-info">Making this the first true generator</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i
														class='bx bx-check-square'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Your item is shipped <span
															class="msg-time float-end">5 hrs
															ago</span></h6>
													<p class="msg-info">Successfully shipped your item</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary">
													<img src="rocker/images/app/github.png" width="25"
														alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New 24 authors<span
															class="msg-time float-end">1 day
															ago</span></h6>
													<p class="msg-info">24 new authors joined last week</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="rocker/images/avatars/avatar-8.png" class="msg-avatar"
														alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Peter Costanzo <span
															class="msg-time float-end">6 hrs
															ago</span></h6>
													<p class="msg-info">It was popularised in the 1960s</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">
											<button class="btn btn-primary w-100">View All Notifications</button>
										</div>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
									role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
										class="alert-count">8</span>
									<i class='bx bx-shopping-bag'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">My Cart</p>
											<p class="msg-header-badge">10 Items</p>
										</div>
									</a>
									<div class="header-message-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/11.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/02.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/03.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/04.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/05.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/06.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/07.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/08.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="rocker/images/products/09.png" class=""
															alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">
											<div class="d-flex align-items-center justify-content-between mb-3">
												<h5 class="mb-0">Total</h5>
												<h5 class="mb-0 ms-auto">$489.00</h5>
											</div>
											<button class="btn btn-primary w-100">Checkout</button>
										</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
							href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="rocker/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
							<div class="user-info">
								<p class="user-name mb-0">Pauline Seitz</p>
								<p class="designattion mb-0">Web Designer</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-user fs-5"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-cog fs-5"></i><span>Settings</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-download fs-5"></i><span>Downloads</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row row-cols-1 row-cols-md-1 row-cols-xl-2">
					<div class="col">
						<div class="card radius-10 border-start border-0 border-4 border-info">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total Fakultas (Sesuai SIAKAD)</p>
										<h4 class="my-1 text-info">4805</h4>
										<p class="mb-0 font-13">+2.5% from last week</p>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
											class='bx bxs-cart'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-start border-0 border-4 border-danger">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total Program Studi (Sesuai SIAKAD)</p>
										<h4 class="my-1 text-danger">$84,245</h4>
										<p class="mb-0 font-13">+5.4% from last week</p>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
										<i class='bx bxs-wallet'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-start border-0 border-4 border-success">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total Program Studi Terakreditasi</p>
										<h4 class="my-1 text-success">34.6%</h4>
										<p class="mb-0 font-13">-4.5% from last week</p>
									</div>
									<div
										class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
										<i class='bx bxs-bar-chart-alt-2'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-start border-0 border-4 border-warning">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total Program Studi Terakreditasi Internasional</p>
										<h4 class="my-1 text-warning">8.4K</h4>
										<p class="mb-0 font-13">+8.4% from last week</p>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
											class='bx bxs-group'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
				<div class="row row-cols-1 row-cols-lg-3">
					<div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header bg-transparent">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Sales This Week</h6>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="chart-container-1">
									<canvas id="chart16"></canvas>
								  </div>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Completed
									<span class="badge bg-gradient-quepal rounded-pill">25</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Apple
									<span class="badge bg-gradient-ibiza rounded-pill">10</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Nokia <span class="badge bg-gradient-deepblue rounded-pill">65</span>
								</li>
							</ul>
						</div>
					  </div>
					 <div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header bg-transparent">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Profit Ratio</h6>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="chart-container-1">
									<canvas id="chart17"></canvas>
								  </div>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Gross Profit <span class="badge bg-gradient-quepal rounded-pill">25</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Revenue <span class="badge bg-gradient-ibiza rounded-pill">10</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Expense <span class="badge bg-gradient-deepblue rounded-pill">65</span>
								</li>
							</ul>
						</div>
					  </div>
					  <div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header bg-transparent">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Trending Products</h6>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="chart-container-1">
									<canvas id="chart18"></canvas>
								  </div>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Jeans <span class="badge bg-gradient-quepal rounded-pill">25</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">T-Shirts <span class="badge bg-gradient-ibiza rounded-pill">10</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Shoes
									<span class="badge bg-gradient-deepblue rounded-pill">65</span>
								</li>
							</ul>
						</div>
					  </div>
				 </div><!--end row-->

				<div class="row">
					<div class="col-12 col-lg-12 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Sales Overview</h6>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
											data-bs-toggle="dropdown"><i
												class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
											style="color: #14abef"></i>Sales</span>
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
											style="color: #ffc107"></i>Visits</span>
								</div>
								<div class="chart-container-1">
									<canvas id="chart1"></canvas>
								</div>
							</div>
							<div
								class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
								<div class="col">
									<div class="p-3">
										<h5 class="mb-0">24.15M</h5>
										<small class="mb-0">Overall Visitor <span> <i
													class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
									</div>
								</div>
								<div class="col">
									<div class="p-3">
										<h5 class="mb-0">12:38</h5>
										<small class="mb-0">Visitor Duration <span> <i
													class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
									</div>
								</div>
								<div class="col">
									<div class="p-3">
										<h5 class="mb-0">639.82</h5>
										<small class="mb-0">Pages/Visit <span> <i
													class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->

				<div class="card radius-10">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<div>
								<h6 class="mb-0">Recent Orders</h6>
							</div>
							<div class="dropdown ms-auto">
								<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
										class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
								</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="javascript:;">Action</a>
									</li>
									<li><a class="dropdown-item" href="javascript:;">Another action</a>
									</li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="javascript:;">Something else here</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table align-middle mb-0">
								<thead class="table-light">
									<tr>
										<th>Product</th>
										<th>Photo</th>
										<th>Product ID</th>
										<th>Status</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Shipping</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Iphone 5</td>
										<td><img src="rocker/images/products/01.png" class="product-img-2"
												alt="product img"></td>
										<td>#9405822</td>
										<td><span
												class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span>
										</td>
										<td>$1250.00</td>
										<td>03 Feb 2020</td>
										<td>
											<div class="progress" style="height: 6px;">
												<div class="progress-bar bg-gradient-quepal" role="progressbar"
													style="width: 100%"></div>
											</div>
										</td>
									</tr>

									<tr>
										<td>Earphone GL</td>
										<td><img src="rocker/images/products/02.png" class="product-img-2"
												alt="product img"></td>
										<td>#8304620</td>
										<td><span
												class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span>
										</td>
										<td>$1500.00</td>
										<td>05 Feb 2020</td>
										<td>
											<div class="progress" style="height: 6px;">
												<div class="progress-bar bg-gradient-blooker" role="progressbar"
													style="width: 60%"></div>
											</div>
										</td>
									</tr>

									<tr>
										<td>HD Hand Camera</td>
										<td><img src="rocker/images/products/03.png" class="product-img-2"
												alt="product img"></td>
										<td>#4736890</td>
										<td><span
												class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span>
										</td>
										<td>$1400.00</td>
										<td>06 Feb 2020</td>
										<td>
											<div class="progress" style="height: 6px;">
												<div class="progress-bar bg-gradient-bloody" role="progressbar"
													style="width: 70%"></div>
											</div>
										</td>
									</tr>

									<tr>
										<td>Clasic Shoes</td>
										<td><img src="rocker/images/products/04.png" class="product-img-2"
												alt="product img"></td>
										<td>#8543765</td>
										<td><span
												class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span>
										</td>
										<td>$1200.00</td>
										<td>14 Feb 2020</td>
										<td>
											<div class="progress" style="height: 6px;">
												<div class="progress-bar bg-gradient-quepal" role="progressbar"
													style="width: 100%"></div>
											</div>
										</td>
									</tr>
									<tr>
										<td>Sitting Chair</td>
										<td><img src="rocker/images/products/06.png" class="product-img-2"
												alt="product img"></td>
										<td>#9629240</td>
										<td><span
												class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span>
										</td>
										<td>$1500.00</td>
										<td>18 Feb 2020</td>
										<td>
											<div class="progress" style="height: 6px;">
												<div class="progress-bar bg-gradient-blooker" role="progressbar"
													style="width: 60%"></div>
											</div>
										</td>
									</tr>
									<tr>
										<td>Hand Watch</td>
										<td><img src="rocker/images/products/05.png" class="product-img-2"
												alt="product img"></td>
										<td>#8506790</td>
										<td><span
												class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span>
										</td>
										<td>$1800.00</td>
										<td>21 Feb 2020</td>
										<td>
											<div class="progress" style="height: 6px;">
												<div class="progress-bar bg-gradient-bloody" role="progressbar"
													style="width: 40%"></div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-7 col-xl-8 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header bg-transparent">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Recent Orders</h6>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
											data-bs-toggle="dropdown"><i
												class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12 col-xl-12">

										<div class="mb-4">
											<p class="mb-2"><i class="flag-icon flag-icon-us me-1"></i> USA <span
													class="float-end">70%</span></p>
											<div class="progress" style="height: 7px;">
												<div class="progress-bar bg-primary progress-bar-striped"
													role="progressbar" style="width: 70%"></div>
											</div>
										</div>

										<div class="mb-4">
											<p class="mb-2"><i class="flag-icon flag-icon-ca me-1"></i> Canada <span
													class="float-end">65%</span></p>
											<div class="progress" style="height: 7px;">
												<div class="progress-bar bg-danger progress-bar-striped"
													role="progressbar" style="width: 65%"></div>
											</div>
										</div>

										<div class="mb-4">
											<p class="mb-2"><i class="flag-icon flag-icon-gb me-1"></i> England <span
													class="float-end">60%</span></p>
											<div class="progress" style="height: 7px;">
												<div class="progress-bar bg-success progress-bar-striped"
													role="progressbar" style="width: 60%"></div>
											</div>
										</div>

										<div class="mb-4">
											<p class="mb-2"><i class="flag-icon flag-icon-au me-1"></i> Australia <span
													class="float-end">55%</span></p>
											<div class="progress" style="height: 7px;">
												<div class="progress-bar bg-warning progress-bar-striped"
													role="progressbar" style="width: 55%"></div>
											</div>
										</div>

										<div class="mb-4">
											<p class="mb-2"><i class="flag-icon flag-icon-in me-1"></i> India <span
													class="float-end">50%</span></p>
											<div class="progress" style="height: 7px;">
												<div class="progress-bar bg-info progress-bar-striped"
													role="progressbar" style="width: 50%"></div>
											</div>
										</div>

										<div class="mb-0">
											<p class="mb-2"><i class="flag-icon flag-icon-cn me-1"></i> China <span
													class="float-end">45%</span></p>
											<div class="progress" style="height: 7px;">
												<div class="progress-bar bg-dark progress-bar-striped"
													role="progressbar" style="width: 45%"></div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-5 col-xl-4 d-flex">
						<div class="card w-100 radius-10">
							<div class="card-body">
								<div class="card radius-10 border shadow-none">
									<div class="card-body">
										<div class="d-flex align-items-center">
											<div>
												<p class="mb-0 text-secondary">Total Likes</p>
												<h4 class="my-1">45.6M</h4>
												<p class="mb-0 font-13">+6.2% from last week</p>
											</div>
											<div class="widgets-icons-2 bg-gradient-cosmic text-white ms-auto"><i
													class='bx bxs-heart-circle'></i>
											</div>
										</div>
									</div>
								</div>
								<div class="card radius-10 border shadow-none">
									<div class="card-body">
										<div class="d-flex align-items-center">
											<div>
												<p class="mb-0 text-secondary">Comments</p>
												<h4 class="my-1">25.6K</h4>
												<p class="mb-0 font-13">+3.7% from last week</p>
											</div>
											<div class="widgets-icons-2 bg-gradient-ibiza text-white ms-auto"><i
													class='bx bxs-comment-detail'></i>
											</div>
										</div>
									</div>
								</div>
								<div class="card radius-10 mb-0 border shadow-none">
									<div class="card-body">
										<div class="d-flex align-items-center">
											<div>
												<p class="mb-0 text-secondary">Total Shares</p>
												<h4 class="my-1">85.4M</h4>
												<p class="mb-0 font-13">+4.6% from last week</p>
											</div>
											<div class="widgets-icons-2 bg-gradient-kyoto text-dark ms-auto"><i
													class='bx bxs-share-alt'></i>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!--end row-->
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2022. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->

	<!-- search modal -->
	<div class="modal" id="SearchModal" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
			<div class="modal-content">
				<div class="modal-header gap-2">
					<div class="position-relative popup-search w-100">
						<input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search"
							placeholder="Search">
						<span
							class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i
								class='bx bx-search'></i></span>
					</div>
					<button type="button" class="btn-close d-md-none" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="search-list">
						<p class="mb-1">Html Templates</p>
						<div class="list-group">
							<a href="javascript:;"
								class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-angular fs-4'></i>Best Html Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-vuejs fs-4'></i>Html5 Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-magento fs-4'></i>Responsive Html5 Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-shopify fs-4'></i>eCommerce Html Templates</a>
						</div>
						<p class="mb-1 mt-3">Web Designe Company</p>
						<div class="list-group">
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-windows fs-4'></i>Best Html Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-dropbox fs-4'></i>Html5 Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-opera fs-4'></i>Responsive Html5 Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-wordpress fs-4'></i>eCommerce Html Templates</a>
						</div>
						<p class="mb-1 mt-3">Software Development</p>
						<div class="list-group">
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-mailchimp fs-4'></i>Best Html Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-zoom fs-4'></i>Html5 Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-sass fs-4'></i>Responsive Html5 Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-vk fs-4'></i>eCommerce Html Templates</a>
						</div>
						<p class="mb-1 mt-3">Online Shoping Portals</p>
						<div class="list-group">
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-slack fs-4'></i>Best Html Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-skype fs-4'></i>Html5 Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-twitter fs-4'></i>Responsive Html5 Templates</a>
							<a href="javascript:;"
								class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
									class='bx bxl-vimeo fs-4'></i>eCommerce Html Templates</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search modal -->




	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr />
			<h6 class="mb-0">Theme Styles</h6>
			<hr />
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr />
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr />
			<h6 class="mb-0">Header Colors</h6>
			<hr />
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>
			<hr />
			<h6 class="mb-0">Sidebar Colors</h6>
			<hr />
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="rocker/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="rocker/js/jquery.min.js"></script>
	<script src="rocker/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="rocker/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="rocker/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="rocker/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="rocker/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="rocker/plugins/chartjs/js/chart.js"></script>
	<script src="rocker/js/index.js"></script>
	<!--app JS-->
	<script src="rocker/js/app.js"></script>
	<script>
		new PerfectScrollbar(".app-container")
	</script>
	<script>
		// chart 16
		var ctx = document.getElementById("chart16").getContext('2d');

		var gradientStroke5 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke5.addColorStop(0, '#7f00ff');
		gradientStroke5.addColorStop(1, '#e100ff');

		var gradientStroke6 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke6.addColorStop(0, '#fc4a1a');
		gradientStroke6.addColorStop(1, '#f7b733');


		var gradientStroke7 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke7.addColorStop(0, '#283c86');
		gradientStroke7.addColorStop(1, '#45a247');

		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: ["Samsung", "Apple", "Nokia"],
				datasets: [{
					backgroundColor: [
						gradientStroke5,
						gradientStroke6,
						gradientStroke7
					],

					hoverBackgroundColor: [
						gradientStroke5,
						gradientStroke6,
						gradientStroke7
					],

					data: [50, 50, 50]
				}]
			},
			options: {
				maintainAspectRatio: false,
				plugins: {
					legend: {
						display: false,
						position: 'bottom'
					}
				}

			}
		});

		var ctx = document.getElementById("chart17").getContext('2d');

		var gradientStroke8 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke8.addColorStop(0, '#42e695');
		gradientStroke8.addColorStop(1, '#3bb2b8');

		var gradientStroke9 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke9.addColorStop(0, '#4776e6');
		gradientStroke9.addColorStop(1, '#8e54e9');


		var gradientStroke10 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke10.addColorStop(0, '#ee0979');
		gradientStroke10.addColorStop(1, '#ff6a00');

		var myChart = new Chart(ctx, {
			type: 'polarArea',
			data: {
				labels: ["Gross Profit", "Revenue", "Expense"],
				datasets: [{
					backgroundColor: [
						gradientStroke8,
						gradientStroke9,
						gradientStroke10
					],

					hoverBackgroundColor: [
						gradientStroke8,
						gradientStroke9,
						gradientStroke10
					],
					data: [5, 8, 30]
				}]
			},
			options: {
				maintainAspectRatio: false,
				plugins: {
					legend: {
						display: false,
						position: 'bottom'
					}
				}

			}
		});


		// chart 18
		var ctx = document.getElementById("chart18").getContext('2d');

		var gradientStroke11 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke11.addColorStop(0, '#ba8b02');
		gradientStroke11.addColorStop(1, '#181818');

		var gradientStroke12 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke12.addColorStop(0, '#2c3e50');
		gradientStroke12.addColorStop(1, '#fd746c');


		var gradientStroke13 = ctx.createLinearGradient(0, 0, 0, 300);
		gradientStroke13.addColorStop(0, '#ff0099');
		gradientStroke13.addColorStop(1, '#493240');

		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: ["Jeans", "T-Shirts", "Shoes"],
				datasets: [{
					backgroundColor: [
						gradientStroke11,
						gradientStroke12,
						gradientStroke13
					],
					hoverBackgroundColor: [
						gradientStroke11,
						gradientStroke12,
						gradientStroke13
					],
					data: [25, 25, 25]
				}]
			},
			options: {
				maintainAspectRatio: false,
				plugins: {
					legend: {
						display: false,
						position: 'bottom'
					}
				}

			}
		});
	</script>
</body>

</html>
