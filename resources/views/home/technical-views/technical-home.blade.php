@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU')
@section('content')
	<div class="uicore-body-content">
		<div id="uicore-page">
			@include('home.layouts.nav')
			<div id="content" class="uicore-content">
				<script id="uicore-page-transition"> </script>
				<div id="primary" class="content-area">
					<article id="post-13" class="post-13 page type-page status-publish hentry">
						<main class="entry-content">
							<div data-elementor-type="wp-page" data-elementor-id="13" class="elementor elementor-13">
								
							</div>
						</main>
					</article>
				</div>
			</div>
			@include('home.layouts.footer')
		</div>	
		@include('home.layouts.mobile-nav')
	</div>
@endsection