@extends('home.partials.master')
@section('title', 'Bienvenido a eBISU - Cliente')
@section('content')
<div id="content" class="uicore-content">
	<script id="uicore-page-transition"> </script>
	<div id="primary" class="content-area">
		<article id="post-13" class="post-13 page type-page status-publish hentry">
			<main class="entry-content">
				<div data-elementor-type="wp-page" data-elementor-id="13" class="elementor elementor-13">
					<div class="elementor-section elementor-top-section elementor-element elementor-element-38fe679 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
						data-id="38fe679" data-element_type="section" id="Nosotros"
						data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
						<div class="elementor-container elementor-column-gap-no">
							<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb5deb5"
								data-id="fb5deb5" data-element_type="column">
								<div class="elementor-widget-wrap elementor-element-populated">
									<div style="margin-top: 210px;" class="elementor-element elementor-element-68cf322 elementor-invisible elementor-widget elementor-widget-heading"
										data-id="68cf322" data-element_type="widget"
										data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
										data-widget_type="heading.default">
										<div class="elementor-widget-container">
											@auth
												<h5 class="elementor-heading-title elementor-size-default">Cuenta de cliente</h5>
											@endauth
										</div>
									</div>
									<div class="elementor-element elementor-element-cb132e2 elementor-widget__width-initial elementor-widget-tablet__width-initial elementor-widget-mobile__width-inherit  ui-split-animate ui-splitby-chars elementor-widget elementor-widget-heading"
										data-id="cb132e2" data-element_type="widget"
										data-settings="{&quot;ui_animate_split&quot;:&quot;ui-split-animate&quot;,&quot;ui_animate_split_by&quot;:&quot;chars&quot;,&quot;ui_animate_split_style&quot;:&quot;fadeInUp&quot;}"
										data-widget_type="heading.default">
										<div class="elementor-widget-container">
											<h2 class="elementor-heading-title elementor-size-default">Bienvenido</h2>
											<h2 class="elementor-heading-title elementor-size-default">{{ Auth::user()->name }}</h2>
										</div>
									</div>
									<div class="elementor-element elementor-element-70b0e81 elementor-widget__width-inherit elementor-invisible elementor-widget elementor-widget-text-editor"
										data-id="70b0e81" data-element_type="widget"
										data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}"
										data-widget_type="text-editor.default">
										<div class="elementor-widget-container">
											<p>Estas son las opciones que puedes realizar en este panel</p>
										</div>
									</div>
									<section style="margin-top: 2%;"
										class="elementor-section elementor-inner-section elementor-element elementor-element-0d53e53 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-invisible"
										data-id="0d53e53" data-element_type="section"
										data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:600}">
										<div class="elementor-container elementor-column-gap-default">
											<div class="centering-container">
												<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-066b9f6"
													data-id="066b9f6" data-element_type="column">
													<a href="{{route('payments')}}" style="all: unset">
														<div
															class="elementor-widget-wrap elementor-element-populated">
															<div data-ep-wrapper-link="{&quot;url&quot;:&quot;#&quot;,&quot;is_external&quot;:&quot;&quot;,&quot;nofollow&quot;:&quot;&quot;,&quot;custom_attributes&quot;:&quot;&quot;}"
																style="cursor: pointer"
																class="bdt-element-link elementor-element elementor-element-adf23c6 bdt-icon-type-icon elementor-position-top bdt-icon-effect-none elementor-widget elementor-widget-bdt-advanced-icon-box"
																data-id="adf23c6" data-element_type="widget"
																data-widget_type="bdt-advanced-icon-box.default">
																<div class="elementor-widget-container">
																	<div class="bdt-ep-advanced-icon-box">
																		<div class="bdt-ep-advanced-icon-box-icon">
																			<span
																				class="bdt-ep-advanced-icon-box-icon-wrap">
																				<i aria-hidden="true"
																					class="fa fa-credit-card"></i>
																			</span>
																		</div>
																		<div
																			class="bdt-ep-advanced-icon-box-content">
																			<h4
																				class="bdt-ep-advanced-icon-box-title">
																				<span>
																					Mis pagos </span>
																			</h4>
																			<div
																				class="bdt-ep-advanced-icon-box-description">
																				<p>Gestiona tus pagos de forma online
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div>
												<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-066b9f6"
													data-id="066b9f6" data-element_type="column">
													<a href="/mis-incidencias" style="all: unset">
														<div
															class="elementor-widget-wrap elementor-element-populated">
															<div data-ep-wrapper-link="{&quot;url&quot;:&quot;#&quot;,&quot;is_external&quot;:&quot;&quot;,&quot;nofollow&quot;:&quot;&quot;,&quot;custom_attributes&quot;:&quot;&quot;}"
																style="cursor: pointer"
																class="bdt-element-link elementor-element elementor-element-adf23c6 bdt-icon-type-icon elementor-position-top bdt-icon-effect-none elementor-widget elementor-widget-bdt-advanced-icon-box"
																data-id="adf23c6" data-element_type="widget"
																data-widget_type="bdt-advanced-icon-box.default">
																<div class="elementor-widget-container">
																	<div class="bdt-ep-advanced-icon-box">
																		<div class="bdt-ep-advanced-icon-box-icon">
																			<span
																				class="bdt-ep-advanced-icon-box-icon-wrap">
																				<i aria-hidden="true"
																					class="fa fa-exclamation-triangle"></i>
																			</span>
																		</div>
																		<div
																			class="bdt-ep-advanced-icon-box-content">
																			<h4
																				class="bdt-ep-advanced-icon-box-title">
																				<span>
																					Mis incidencias</span>
																			</h4>
																			<div
																				class="bdt-ep-advanced-icon-box-description">
																				<p>Gestiona tus incidencias de forma online desde cualquier dispositivo
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div>
												<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-71c1821"
													data-id="71c1821" data-element_type="column">
													<a href="/generar-token" style="all: unset">
														<div
															class="elementor-widget-wrap elementor-element-populated">
															<div data-ep-wrapper-link="{&quot;url&quot;:&quot;#&quot;,&quot;is_external&quot;:&quot;&quot;,&quot;nofollow&quot;:&quot;&quot;,&quot;custom_attributes&quot;:&quot;&quot;}"
																style="cursor: pointer"
																class="bdt-element-link elementor-element elementor-element-8a244d2 bdt-icon-type-icon elementor-position-top bdt-icon-effect-none elementor-widget elementor-widget-bdt-advanced-icon-box"
																data-id="8a244d2" data-element_type="widget"
																data-widget_type="bdt-advanced-icon-box.default">
																<div class="elementor-widget-container">
																	<div class="bdt-ep-advanced-icon-box">
																		<div class="bdt-ep-advanced-icon-box-icon">
																			<span
																				class="bdt-ep-advanced-icon-box-icon-wrap">
																				<i aria-hidden="true"
																					class="fa fa-key"></i>
																			</span>
																		</div>
																		<div
																			class="bdt-ep-advanced-icon-box-content">
																			<h4
																				class="bdt-ep-advanced-icon-box-title">
																				<span>
																					Generar token</span>
																			</h4>
																			<div
																				class="bdt-ep-advanced-icon-box-description">
																				<p>Genera tokens para que se pueda comprar en tu empresa</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div>
												<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-71c1821"
													data-id="71c1821" data-element_type="column">
													<a href="/crear-incidencia" style="all: unset">
														<div
															class="elementor-widget-wrap elementor-element-populated">
															<div data-ep-wrapper-link="{&quot;url&quot;:&quot;#&quot;,&quot;is_external&quot;:&quot;&quot;,&quot;nofollow&quot;:&quot;&quot;,&quot;custom_attributes&quot;:&quot;&quot;}"
																style="cursor: pointer"
																class="bdt-element-link elementor-element elementor-element-8a244d2 bdt-icon-type-icon elementor-position-top bdt-icon-effect-none elementor-widget elementor-widget-bdt-advanced-icon-box"
																data-id="8a244d2" data-element_type="widget"
																data-widget_type="bdt-advanced-icon-box.default">
																<div class="elementor-widget-container">
																	<div class="bdt-ep-advanced-icon-box">
																		<div class="bdt-ep-advanced-icon-box-icon">
																			<span
																				class="bdt-ep-advanced-icon-box-icon-wrap">
																				<i aria-hidden="true"
																					class="fa fa-plus-square"></i>
																			</span>
																		</div>
																		<div
																			class="bdt-ep-advanced-icon-box-content">
																			<h4
																				class="bdt-ep-advanced-icon-box-title">
																				<span>
																					Crear incidencia</span>
																			</h4>
																			<div
																				class="bdt-ep-advanced-icon-box-description">
																				<p>Ponte en contacto con nosotros y te responderemos en breve.</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</article>
	</div>
</div>
@endsection
