!function(t,i){"use strict";var n=function(t,i){var n=t.find(".bdt-tabs-area"),e=n.find(".bdt-tabs"),a=e.find(".bdt-tab"),o=Boolean(elementorFrontend.isEditMode());if(n.length){var d=e.data("settings"),s=d.hashScrollspyTime,c=d.hashTopOffset,l=d.navStickyOffset;"undefined"==l&&(l=10),t.find(".bdt-template-modal-iframe-edit-link").each((function(){var t=i(i(this).data("modal-element"));i(this).on("click",(function(i){bdtUIkit.modal(t).show()})),t.on("beforehide",(function(){window.parent.location.reload()}))})),"yes"==d.activeHash&&"bdt-sticky-custom"!=d.status&&(i(window).on("load",(function(){u(e,a,s,c)})),i(e).find(".bdt-tabs-item-title").off("click").on("click",(function(t){window.location.hash=i.trim(i(this).attr("data-title"))})),i(window).on("hashchange",(function(t){u(e,a,s,c)}))),"bdt-sticky-custom"==d.status&&(i(e).find(".bdt-tabs-item-title").bind().click("click",(function(t){"yes"==d.activeHash?window.location.hash=i.trim(i(this).attr("data-title")):i("html, body").animate({easing:"slow",scrollTop:i(e).offset().top-l},500,(function(){}))})),"yes"==d.activeHash&&"bdt-sticky-custom"==d.status&&(i(window).on("load",(function(){window.location.hash&&v(e,a,l)})),i(window).on("hashchange",(function(t){v(e,a,l)}))));var r=d.linkWidgetSettings,h=d.activeItem-1;if(void 0!==r&&!1===o&&(r.forEach((function(t,n){0==n&&(i("#bdt-tab-content-"+d.linkWidgetId).parent().remove(),i(t).parent().wrapInner('<div class="bdt-switcher-wrapper" />'),i(t).parent().wrapInner('<div id="bdt-tab-content-'+d.linkWidgetId+'" class="bdt-switcher bdt-switcher-item-content" />'),null==d.activeItem&&i(t).addClass("bdt-active")),void 0!==d.activeItem&&n==h&&i(t).addClass("bdt-active"),i(t).attr("data-content-id","tab-"+(n+1))})),a.find("a").on("click",(function(){let t=i(this).data("tab-index");i("#bdt-tab-content-"+d.linkWidgetId+">").removeClass("bdt-active"),i("#bdt-tab-content-"+d.linkWidgetId+">").eq(t).addClass("bdt-active")}))),void 0!==d.sectionBg){if(void 0===d.sectionBgSelector)return;var b=(d.sectionBgSelector+"-ep-dynamic").substring(1);i(`#${b}-wrapper`).length&&i(`#${b}-wrapper`).remove();var f=`<div id="${b}-wrapper"  style = "position: absolute; z-index: 0; top: 0; right: 0; bottom: 0; left: 0;" >`;i(d.sectionBg).each((function(t){let i='<div class="bdt-hidden '+b+" bdt-animation-"+d.sectionBgAnim+'" style=" width: 100%; height: 100%; transition: all .5s;">';i+='<img src = "'+d.sectionBg[t]+'" style = " height: 100%; width: 100%; object-fit: cover;" >',i+="</div>",f+=i})),f+="</div>",i(d.sectionBgSelector).prepend(f);var w=a.find(">.bdt-tabs-item.bdt-active").index();i(`.${b}:eq('${w}')`).removeClass("bdt-hidden"),n.find(".bdt-tabs-item-title").on("click",(function(){let t=i(this).data("tab-index");i("."+b+":eq("+t+")").siblings().addClass("bdt-hidden"),i("."+b+":eq("+t+")").removeClass("bdt-hidden")}))}var m=d.linkSectionSettings;void 0!==m&&!1===o&&m.forEach((function(t,n){let e=i("#bdt-tab-content-"+d.linkWidgetId),a=i(t);e.find(".bdt-tab-content-item:eq("+n+")").html(a)}))}function u(t,n,e,a){if(window.location.hash&&i(t).find('[data-title="'+window.location.hash.substring(1)+'"]').length){var o=i('[data-title="'+window.location.hash.substring(1)+'"]').closest(t).attr("id");i("html, body").animate({easing:"slow",scrollTop:i("#"+o).offset().top-a},e,(function(){})).promise().then((function(){bdtUIkit.tab(n).show(i('[data-title="'+window.location.hash.substring(1)+'"]').data("tab-index"))}))}}function v(t,n,e){if(i(t).find('[data-title="'+window.location.hash.substring(1)+'"]').length){var a=i('[data-title="'+window.location.hash.substring(1)+'"]').closest(t).attr("id");i("html, body").animate({easing:"slow",scrollTop:i("#"+a).offset().top-e},1e3,(function(){})).promise().then((function(){bdtUIkit.tab(n).show(i(n).find('[data-title="'+window.location.hash.substring(1)+'"]').data("tab-index"))}))}}};jQuery(window).on("elementor/frontend/init",(function(){elementorFrontend.hooks.addAction("frontend/element_ready/bdt-tabs.default",n)}))}(jQuery,window.elementorFrontend);