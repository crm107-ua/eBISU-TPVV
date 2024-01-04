<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<style>
		.ui-link-helper svg {
			width: 22px;
		}

		.ui-link-helper {
			position: fixed;
			right: 0;
			top: calc(50vh - 111px);
			display: flex;
			flex-direction: column;
			background: white;
			width: 45px;
			cursor: pointer;
			border-left: 0;
			border-radius: 0;
			-webkit-box-shadow: 0 5px 40px rgb(0 0 0 / 7%);
			-moz-box-shadow: 0 5px 40px rgba(0, 0, 0, 7%);
			box-shadow: 0 5px 40px rgb(0 0 0 / 7%);
			padding: 0;
			border-top-left-radius: 5px;
			border-bottom-left-radius: 5px;
			border: 1px solid #eaeaea;
			border-right: 0;
			z-index: 9999999;
		}

		.ui-link-helper .ui-tooltip {
			opacity: 0;
			visibility: hidden;
			-webkit-transform: scale(.7);
			-moz-transform: scale(.7);
			-ms-transform: scale(.7);
			transform: scale(.7);
			position: absolute;
			background-color: #fff;
			font-size: 13px;
			margin: 0;
			padding: 0px 20px;
			font-family: inherit;
			width: auto;
			font-weight: 500;
			line-height: 36px;
			letter-spacing: .1px;
			right: 10px;
			top: 4px;
			border-radius: 3px;
			white-space: nowrap;
			-webkit-box-shadow: 0 5px 40px rgb(0 0 0 / 7%), 0 0 3px -1px rgb(83 45 245 / 15%);
			-moz-box-shadow: 0 5px 40px rgb(0 0 0 / 7%), 0 0 3px -1px rgb(83 45 245 / 15%);
			box-shadow: 0 5px 40px rgb(0 0 0 / 7%), 0 0 3px -1px rgb(83 45 245 / 15%);
			-moz-transition: all .3s cubic-bezier(0.64, -0.09, 0.13, 1.15);
			-o-transition: all .3s cubic-bezier(0.64, -0.09, 0.13, 1.15);
			transition: all .3s cubic-bezier(0.64, -0.09, 0.13, 1.15);
			color: #F5A9A5;
		}

		.ui-link-helper .ui-tooltip-link:hover .ui-tooltip {
			opacity: 1;
			right: 60px;
			visibility: visible;
			-webkit-transform: scale(1);
			-moz-transform: scale(1);
			-ms-transform: scale(1);
			transform: scale(1);
		}

		.ui-link-helper .ui-tooltip-link {
			position: relative;
			display: flex;
			justify-content: center;
			height: 44px;
			align-items: center;
			transition: all .3s ease-in;
		}

		.ui-link-helper .ui-tooltip span {
			display: block;
			position: absolute;
			right: -5px;
			top: 12px;
			width: 0;
			height: 0;
			border-left: 5px solid #fff;
			border-bottom: 5px solid transparent;
			border-top: 5px solid transparent;
		}

		.ui-link-helper .ui-tooltip-link+.ui-tooltip-link {
			border-top: 1px solid #eaeaea;
		}

		.ui-link-helper .ui-tooltip-link svg {
			height: 20px;
		}

		.ui-tooltip-link:hover {
			background: rgb(83 45 245 / 5%);
		}

		.ui-tooltip-link:hover svg path {
			fill: #F5A9A5;
		}

		@media(max-width: 767px) {
			.ui-link-helper {
				display: none;
			}
		}
	</style>
	<title>@yield('title', 'eBISU - Home')</title>
	<meta name="robots" content="max-image-preview:large" />
	<link rel="alternate" type="application/rss+xml" title="Online Banking &raquo; Feed" href="feed/index.rss" />
	<link rel="alternate" type="application/rss+xml" title="Online Banking &raquo; Comments Feed"
		href="comments/feed/index.rss" />
	<script>
		window._wpemojiSettings = { "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/72x72\/", "ext": ".png", "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/svg\/", "svgExt": ".svg", "source": { "concatemoji": "https:\/\/finflow.uicore.co\/online-banking\/estilos\/js\/wp-emoji-release.min.js?ver=6.4.1" } };
		/*! This file is auto-generated */
		!function (i, n) { var o, s, e; function c(e) { try { var t = { supportTests: e, timestamp: (new Date).valueOf() }; sessionStorage.setItem(o, JSON.stringify(t)) } catch (e) { } } function p(e, t, n) { e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(t, 0, 0); var t = new Uint32Array(e.getImageData(0, 0, e.canvas.width, e.canvas.height).data), r = (e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(n, 0, 0), new Uint32Array(e.getImageData(0, 0, e.canvas.width, e.canvas.height).data)); return t.every(function (e, t) { return e === r[t] }) } function u(e, t, n) { switch (t) { case "flag": return n(e, "\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f", "\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f") ? !1 : !n(e, "\ud83c\uddfa\ud83c\uddf3", "\ud83c\uddfa\u200b\ud83c\uddf3") && !n(e, "\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f", "\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f"); case "emoji": return !n(e, "\ud83e\udef1\ud83c\udffb\u200d\ud83e\udef2\ud83c\udfff", "\ud83e\udef1\ud83c\udffb\u200b\ud83e\udef2\ud83c\udfff") }return !1 } function f(e, t, n) { var r = "undefined" != typeof WorkerGlobalScope && self instanceof WorkerGlobalScope ? new OffscreenCanvas(300, 150) : i.createElement("canvas"), a = r.getContext("2d", { willReadFrequently: !0 }), o = (a.textBaseline = "top", a.font = "600 32px Arial", {}); return e.forEach(function (e) { o[e] = t(a, e, n) }), o } function t(e) { var t = i.createElement("script"); t.src = e, t.defer = !0, i.head.appendChild(t) } "undefined" != typeof Promise && (o = "wpEmojiSettingsSupports", s = ["flag", "emoji"], n.supports = { everything: !0, everythingExceptFlag: !0 }, e = new Promise(function (e) { i.addEventListener("DOMContentLoaded", e, { once: !0 }) }), new Promise(function (t) { var n = function () { try { var e = JSON.parse(sessionStorage.getItem(o)); if ("object" == typeof e && "number" == typeof e.timestamp && (new Date).valueOf() < e.timestamp + 604800 && "object" == typeof e.supportTests) return e.supportTests } catch (e) { } return null }(); if (!n) { if ("undefined" != typeof Worker && "undefined" != typeof OffscreenCanvas && "undefined" != typeof URL && URL.createObjectURL && "undefined" != typeof Blob) try { var e = "postMessage(" + f.toString() + "(" + [JSON.stringify(s), u.toString(), p.toString()].join(",") + "));", r = new Blob([e], { type: "text/javascript" }), a = new Worker(URL.createObjectURL(r), { name: "wpTestEmojiSupports" }); return void (a.onmessage = function (e) { c(n = e.data), a.terminate(), t(n) }) } catch (e) { } c(n = f(s, u, p)) } t(n) }).then(function (e) { for (var t in e) n.supports[t] = e[t], n.supports.everything = n.supports.everything && n.supports[t], "flag" !== t && (n.supports.everythingExceptFlag = n.supports.everythingExceptFlag && n.supports[t]); n.supports.everythingExceptFlag = n.supports.everythingExceptFlag && !n.supports.flag, n.DOMReady = !1, n.readyCallback = function () { n.DOMReady = !0 } }).then(function () { return e }).then(function () { var e; n.supports.everything || (n.readyCallback(), (e = n.source || {}).concatemoji ? t(e.concatemoji) : e.wpemoji && e.twemoji && (t(e.twemoji), t(e.wpemoji))) })) }((window, document), window._wpemojiSettings);
	</script>
	<link rel="stylesheet" id="bdt-uikit-css"
		href="sources/plugins/bdthemes-element-pack/assets/css/bdt-uikit%EF%B9%96ver=3.15.1.css" media="all" />
	<link rel="stylesheet" id="ep-helper-css"
		href="sources/plugins/bdthemes-element-pack/assets/css/ep-helper%EF%B9%96ver=6.12.2.css" media="all" />
	<style id="wp-emoji-styles-inline-css">
		img.wp-smiley,
		img.emoji {
			display: inline !important;
			border: none !important;
			box-shadow: none !important;
			height: 1em !important;
			width: 1em !important;
			margin: 0 0.07em !important;
			vertical-align: -0.1em !important;
			background: none !important;
			padding: 0 !important;
		}
		.centering-container {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			width: 100%;
			height: 100%;
		}
	</style>
	<link rel="stylesheet" id="wp-block-library-css"
		href="estilos/css/dist/block-library/style.min%EF%B9%96ver=6.4.1.css" media="all" />
	<style id="classic-theme-styles-inline-css">
		/*! This file is auto-generated */
		.wp-block-button__link {
			color: #fff;
			background-color: #32373c;
			border-radius: 9999px;
			box-shadow: none;
			text-decoration: none;
			padding: calc(.667em + 2px) calc(1.333em + 2px);
			font-size: 1.125em
		}

		.wp-block-file__button {
			background: #32373c;
			color: #fff;
			text-decoration: none
		}
	</style>
	<link rel="stylesheet" id="elementor-frontend-css"
		href="sources/plugins/elementor/assets/css/frontend-lite.min%EF%B9%96ver=3.17.3.css" media="all" />
	<link rel="stylesheet" id="elementor-post-38-css"
		href="sources/uploads/sites/2/elementor/css/post-38%EF%B9%96ver=1699652699.css" media="all" />
	<link rel="stylesheet" id="elementor-icons-css"
		href="sources/plugins/elementor/assets/lib/eicons/css/elementor-icons.min%EF%B9%96ver=5.23.0.css"
		media="all" />
	<link rel="stylesheet" id="swiper-css"
		href="sources/plugins/elementor/assets/lib/swiper/css/swiper.min%EF%B9%96ver=5.3.6.css" media="all" />
	<link rel="stylesheet" id="elementor-post-13-css"
		href="sources/uploads/sites/2/elementor/css/post-13%EF%B9%96ver=1699688425.css" media="all" />
	<link rel="stylesheet" id="uicore_global-css" href="sources/uploads/sites/2/uicore-global%EF%B9%96ver=9832.css"
		media="all" />
	<link rel="stylesheet" id="google-fonts-1-css"
		href="https://fonts.googleapis.com/css?family=Inter%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&amp;display=swap&amp;ver=6.4.1"
		media="all" />
	<link rel="stylesheet" id="elementor-icons-shared-0-css"
		href="sources/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min%EF%B9%96ver=5.15.3.css"
		media="all" />
	<link rel="stylesheet" id="elementor-icons-fa-regular-css"
		href="sources/plugins/elementor/assets/lib/font-awesome/css/regular.min%EF%B9%96ver=5.15.3.css"
		media="all" />
	<link rel="stylesheet" id="elementor-icons-fa-solid-css"
		href="sources/plugins/elementor/assets/lib/font-awesome/css/solid.min%EF%B9%96ver=5.15.3.css" media="all" />
	<link rel="stylesheet" id="elementor-icons-shared-1-css"
		href="sources/plugins/uicore-framework/assets/fonts/themify-icons%EF%B9%96ver=1.0.0.css" media="all" />
	<link rel="stylesheet" id="elementor-icons-uicore-icons-css"
		href="sources/plugins/uicore-framework/assets/fonts/themify-icons%EF%B9%96ver=1.0.0.css" media="all" />
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<script src="estilos/js/jquery/jquery.min%EF%B9%96ver=3.7.1.js" id="jquery-core-js"></script>
	<script src="estilos/js/jquery/jquery-migrate.min%EF%B9%96ver=3.4.1.js" id="jquery-migrate-js"></script>
	<link rel="https://api.w.org/" href="wp-json/index.json" />
	<link rel="alternate" type="application/json" href="wp-json/wp/v2/pages/13.json" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD"
		href="https://finflow.uicore.co/online-banking/xmlrpc.php?rsd" />
	<meta name="generator" content="WordPress 6.4.1" />
	<link rel="canonical" href="index.html" />
	<link rel="shortlink" href="index.html" />
	<link rel="alternate" type="application/json+oembed"
		href="wp-json/oembed/1.0/embed%EF%B9%96url=https%EF%B9%95%EA%A4%B7%EA%A4%B7finflow.uicore.co%EA%A4%B7online-banking%EA%A4%B7.json" />
	<link rel="alternate" type="text/xml+oembed"
		href="wp-json/oembed/1.0/embed%EF%B9%96url=https%EF%B9%95%EA%A4%B7%EA%A4%B7finflow.uicore.co%EA%A4%B7online-banking%EA%A4%B7&amp;format=xml.xml" />
	<meta name="generator"
		content="Elementor 3.17.3; features: e_dom_optimization, e_optimized_assets_loading, e_optimized_css_loading, additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-swap">
	<meta name="theme-color" content="#277768" />
	<link rel="shortcut icon" href="{{ asset('icon.png') }}">
	<link rel="icon" href="{{ asset('icon.png') }}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('icon.png') }}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('icon.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('icon.png') }}">
	<link rel="apple-touch-icon" href="{{ asset('icon.png') }}">
	<link rel="icon" href="{{ asset('icon.png') }}" type="image/x-icon">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body class="home page-template-default page page-id-13 wp-embed-responsive ui-a-dsmm-slide  elementor-default elementor-kit-4 elementor-page elementor-page-13">


		
        @yield('content')






        <script>
            var uicore_frontend = { 'back': 'Back', 'rtl': '', 'mobile_br': '1025' };
            console.log('Using Vault v.1.1.2');
            console.log('Powered By eBISU');
        </script>
        <link rel="stylesheet" id="ui-e-split-css"
            href="sources/plugins/uicore-framework/assets/css/elementor/widgets/split%EF%B9%96ver=4.1.7.css"
            media="all" />
        <link rel="stylesheet" id="ep-mailchimp-css"
            href="sources/plugins/bdthemes-element-pack/assets/css/ep-mailchimp%EF%B9%96ver=6.12.2.css" media="all" />
        <link rel="stylesheet" id="ep-advanced-icon-box-css"
            href="sources/plugins/bdthemes-element-pack/assets/css/ep-advanced-icon-box%EF%B9%96ver=6.12.2.css"
            media="all" />
        <link rel="stylesheet" id="ep-tabs-css"
            href="sources/plugins/bdthemes-element-pack/assets/css/ep-tabs%EF%B9%96ver=6.12.2.css" media="all" />
        <script src="sources/uploads/sites/2/uicore-global%EF%B9%96ver=9832.js" id="uicore_global-js"></script>
        <script src="sources/plugins/uicore-framework/assets/js/elementor/widgets/fluid%EF%B9%96ver=4.1.7.js"
            id="ui-e-fluid-js"></script>
        <script src="sources/plugins/uicore-framework/assets/js/elementor/widgets/split%EF%B9%96ver=4.1.7.js"
            id="ui-e-split-js"></script>
        <script id="bdt-uikit-js-extra">
            var element_pack_ajax_login_config = { "ajaxurl": "https:\/\/finflow.uicore.co\/online-banking\/wp-admin\/admin-ajax.php", "language": "en", "loadingmessage": "Sending user info, please wait...", "unknownerror": "Unknown error, make sure access is correct!" };
            var ElementPackConfig = { "ajaxurl": "https:\/\/finflow.uicore.co\/online-banking\/wp-admin\/admin-ajax.php", "nonce": "5d6e0e6706", "data_table": { "language": { "lengthMenu": "Show _MENU_ Entries", "info": "Showing _START_ to _END_ of _TOTAL_ entries", "search": "Search :", "sZeroRecords": "No matching records found", "paginate": { "previous": "Previous", "next": "Next" } } }, "contact_form": { "sending_msg": "Sending message please wait...", "captcha_nd": "Invisible captcha not defined!", "captcha_nr": "Could not get invisible captcha response!" }, "mailchimp": { "subscribing": "Subscribing you please wait..." }, "search": { "more_result": "More Results", "search_result": "SEARCH RESULT", "not_found": "not found" }, "elements_data": { "sections": [], "columns": [], "widgets": [] } };
        </script>
        <script src="sources/plugins/bdthemes-element-pack/assets/js/bdt-uikit.min%EF%B9%96ver=3.15.1.js"
            id="bdt-uikit-js"></script>
        <script src="sources/plugins/elementor/assets/js/webpack.runtime.min%EF%B9%96ver=3.17.3.js"
            id="elementor-webpack-runtime-js"></script>
        <script src="sources/plugins/elementor/assets/js/frontend-modules.min%EF%B9%96ver=3.17.3.js"
            id="elementor-frontend-modules-js"></script>
        <script src="estilos/js/jquery/ui/core.min%EF%B9%96ver=1.13.2.js" id="jquery-ui-core-js"></script>
        <script id="elementor-frontend-js-before">
            var elementorFrontendConfig = { "environmentMode": { "edit": false, "wpPreview": false, "isScriptDebug": false }, "i18n": { "shareOnFacebook": "Share on Facebook", "shareOnTwitter": "Share on Twitter", "pinIt": "Pin it", "download": "Download", "downloadImage": "Download image", "fullscreen": "Fullscreen", "zoom": "Zoom", "share": "Share", "playVideo": "Play Video", "previous": "Previous", "next": "Next", "close": "Close", "a11yCarouselWrapperAriaLabel": "Carousel | Horizontal scrolling: Arrow Left & Right", "a11yCarouselPrevSlideMessage": "Previous slide", "a11yCarouselNextSlideMessage": "Next slide", "a11yCarouselFirstSlideMessage": "This is the first slide", "a11yCarouselLastSlideMessage": "This is the last slide", "a11yCarouselPaginationBulletMessage": "Go to slide" }, "is_rtl": false, "breakpoints": { "xs": 0, "sm": 480, "md": 768, "lg": 1025, "xl": 1440, "xxl": 1600 }, "responsive": { "breakpoints": { "mobile": { "label": "Mobile Portrait", "value": 767, "default_value": 767, "direction": "max", "is_enabled": true }, "mobile_extra": { "label": "Mobile Landscape", "value": 880, "default_value": 880, "direction": "max", "is_enabled": false }, "tablet": { "label": "Tablet Portrait", "value": 1024, "default_value": 1024, "direction": "max", "is_enabled": true }, "tablet_extra": { "label": "Tablet Landscape", "value": 1200, "default_value": 1200, "direction": "max", "is_enabled": false }, "laptop": { "label": "Laptop", "value": 1366, "default_value": 1366, "direction": "max", "is_enabled": false }, "widescreen": { "label": "Widescreen", "value": 2400, "default_value": 2400, "direction": "min", "is_enabled": false } } }, "version": "3.17.3", "is_static": false, "experimentalFeatures": { "e_dom_optimization": true, "e_optimized_assets_loading": true, "e_optimized_css_loading": true, "additional_custom_breakpoints": true, "landing-pages": true }, "urls": { "assets": "https:\/\/finflow.uicore.co\/online-banking\/sources\/plugins\/elementor\/assets\/" }, "swiperClass": "swiper-container", "settings": { "page": [], "editorPreferences": [] }, "kit": { "active_breakpoints": ["viewport_mobile", "viewport_tablet"], "global_image_lightbox": "yes", "lightbox_enable_counter": "yes", "lightbox_enable_fullscreen": "yes", "lightbox_enable_zoom": "yes", "lightbox_enable_share": "yes", "lightbox_title_src": "title", "lightbox_description_src": "description" }, "post": { "id": 13, "title": "Online%20Banking%20%E2%80%93%20FinFlow%20WordPress%20Theme", "excerpt": "", "featuredImage": false } };
        </script>
        <script src="sources/plugins/elementor/assets/js/frontend.min%EF%B9%96ver=3.17.3.js"
            id="elementor-frontend-js"></script>
        <script src="sources/plugins/bdthemes-element-pack/assets/js/modules/ep-mailchimp.min%EF%B9%96ver=6.12.2.js"
            id="ep-mailchimp-js"></script>
        <script src="sources/plugins/bdthemes-element-pack/assets/js/modules/ep-wrapper-link.min%EF%B9%96ver=6.12.2.js"
            id="ep-wrapper-link-js"></script>
        <script
            src="sources/plugins/bdthemes-element-pack/assets/js/modules/ep-advanced-icon-box.min%EF%B9%96ver=6.12.2.js"
            id="ep-advanced-icon-box-js"></script>
        <script src="sources/plugins/bdthemes-element-pack/assets/js/modules/ep-tabs.min%EF%B9%96ver=6.12.2.js"
            id="ep-tabs-js"></script>
        <script src="sources/plugins/bdthemes-element-pack/assets/js/common/helper.min%EF%B9%96ver=6.12.2.js"
            id="element-pack-helper-js"></script>

        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4HRCJB" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
    </body>
</html>