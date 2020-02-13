var lastScheme = "", lastNavbarScheme = "", lastSidebarScheme = "", rounded = false, solid = false;

var boxed = $("body").hasClass("boxed");
var scheme = $("#schemeSetting").val();
var navbarScheme = $("#navbarSchemeSetting").val();

var sidebarScheme = $("#sidebarSchemeSetting").val();
var sidebarOverlay = false;
var sidebarClosed = false;
var sidebarHover = false;
//var isRTL = $("html").attr("dir") == "rtl";

$(document).ready(function() {
	$("#settings").slimScroll({
	    height: '100%',
	    color: 'rgba(0,0,0,0.5)',
	    distance: '0'
	});
});

$(".toggleBtn").click(function() {
	if ($(".demo_settings").hasClass("opened")) {
		if (isRTL)
			$(".demo_settings").animate({left:"-250px"}, 50);
		else $(".demo_settings").animate({right:"-250px"}, 50);
		$(".demo_settings").removeClass("opened");
	}
	else {
		if (isRTL)
			$(".demo_settings").animate({left:"0"}, 50);
		else $(".demo_settings").animate({right:"0"}, 50);
		$(".demo_settings").addClass("opened");
	}
});

$("#settingsDefaults").click(function() {
	$("body").removeClass(lastScheme);
	$("body").removeClass(lastNavbarScheme);
	$("body").removeClass(lastSidebarScheme);
	$("body").removeClass("controls-rounded");
	$("body").removeClass("sidebar-solid");
	$("body").removeClass("sidebar-hover");

	sidebarHover = $("body").hasClass("sidebar-hover");

	lastScheme = "";
	lastNavbarScheme = "";
	lastSidebarScheme = "";
	rounded = false;
	solid = false;

	$("#schemeSetting .demo_color").removeClass("selected");
	$("#schemeSetting #def").addClass("selected");

	$("#sidebarSchemeSetting .demo_color").removeClass("selected");
	$("#sidebarSchemeSetting #def").addClass("selected");

	$("#navbarSchemeSetting .demo_color").removeClass("selected");
	$("#navbarSchemeSetting #def").addClass("selected");

	$("#wideSetting").prop("checked", true);
	$("#sidebarOverlaySetting").prop("checked", false);
	$("#sidebarClosedSetting").prop("checked", false);
	$("#roundedSetting").prop("checked", false);
	$("#sidebarSolidSetting").prop("checked", false);
	$("#sidebarHoverSetting").prop("checked", false);
	$("body").removeClass("boxed");
	boxed = false;

	$("body").removeClass("sidebar-overlay");
	sidebarOverlay = false;

	$("body").removeClass("sidebar-closed");
	$(".sidebar").css("width", "240px");
	if ($(window).width() > 700)
		$(".sidebar").removeAttr("style");

	$(".sidebar").addClass("sidebar-opened");
	$(".sidebar-content li a").each(function() {
		$(this).removeClass("closed");
	});
	$("#content-main").animate({paddingLeft: "255px"}, animationSpeed - 100);
	$(".sidebar-content > ul > li > ul.opened").show();
	if ($(window).width() <= 700) {
		$(".sidebar-content li a span").css("opacity", "1");
		$(".content-container .black").show();
	}
	$(".sidebar-title").show();
	sidebarOpened = true;

	ServerChart()
});

$("input[name='layout']").change(function() {
	if ($("#boxedSetting").is(":checked")) {
		$("body").addClass("boxed");
		boxed = true;
	}
	else {
		$("body").removeClass("boxed");
		boxed = false;
	}
	ServerChart()
});

$("#sidebarOverlaySetting").change(function() {
	if ($(this).is(":checked")) {
		$("body").addClass("sidebar-overlay");
		sidebarOverlay = true;

		$("#content-main").animate({paddingLeft:"70px"}, animationSpeed);
	}
	else {
		$("body").removeClass("sidebar-overlay");
		sidebarOverlay = false;

		var w = (parseFloat($(".sidebar").width()) + 15);
		$("#content-main").animate({paddingLeft: w+"px"}, animationSpeed);
	}
});

$("#sidebarClosedSetting").change(function() {
	if ($(this).is(":checked")) {
		$("body").addClass("sidebar-closed");

		$(".sidebar-title").fadeOut(animationSpeed);
		$(".sidebar").animate({width: "55px"}, animationSpeed);
		$(".sidebar").removeClass("sidebar-opened");
		if (!sidebarOverlay) {
			$("#content-main").animate({paddingLeft: "70px"}, animationSpeed - 100);
		}
		$(".sidebar-content li a").each(function() {
			$(this).addClass("closed");
		});
		$(".sidebar-content > ul > li > ul").fadeOut(50);
		if ($(window).width() <= 700) {
			$(".sidebar-content li a span").css("opacity", "0");
			$(".content-container .black").fadeOut(animationSpeed);
		}

		sidebarOpened = false;
	}
	else {
		$("body").removeClass("sidebar-closed");

		$(".sidebar").animate({width: "240px"}, animationSpeed, function() {
			if ($(window).width() > 700)
				$(".sidebar").removeAttr("style");
		});
		$(".sidebar").addClass("sidebar-opened");
		if (!sidebarOverlay) {
			$("#content-main").animate({paddingLeft: "255px"}, animationSpeed - 100);
		}
		$(".sidebar-content li a").each(function() {
			$(this).removeClass("closed");
		});
		$(".sidebar-content > ul > li > ul.opened").fadeIn(50);
		if ($(window).width() <= 700) {
			$(".sidebar-content li a span").css("opacity", "1");
			$(".content-container .black").fadeIn(animationSpeed);
		}
		$(".sidebar-title").fadeIn(animationSpeed);

		sidebarOpened = true;
	}
});

$("#schemeSetting .demo_color").click(function() {
	var val = $(this).prop("id");

	$("#schemeSetting .demo_color").removeClass("selected");
	$(this).addClass("selected");

	if (val == "def") {
		$("body").removeClass(lastScheme);
	}
	else {
		$("body").removeClass(lastScheme);
		$("body").addClass("scheme-"+val);
	}

	lastScheme = "scheme-"+val;
});

$("#sidebarSchemeSetting .demo_color").click(function() {
	var val = $(this).prop("id");

	$("#sidebarSchemeSetting .demo_color").removeClass("selected");
	$(this).addClass("selected");

	if (val == "def") {
		$("body").removeClass(lastSidebarScheme);
	}
	else {
		$("body").removeClass(lastSidebarScheme);
		$("body").addClass("sidebar-"+val);
	}

	lastSidebarScheme = "sidebar-"+val;
});

$("#navbarSchemeSetting .demo_color").click(function() {
	var val = $(this).prop("id");

	$("#navbarSchemeSetting .demo_color").removeClass("selected");
	$(this).addClass("selected");

	if (val == "def") {
		$("body").removeClass(lastNavbarScheme);
	}
	else {
		$("body").removeClass(lastNavbarScheme);
		$("body").addClass("navbar-"+val);
	}

	lastNavbarScheme = "navbar-"+val;
});

$("#roundedSetting").change(function() {
	if ($("#roundedSetting").is(":checked")) {
		$("body").addClass("controls-rounded");
		rounded = true;
	}
	else {
		$("body").removeClass("controls-rounded");
		rounded = false;
	}
});

$("#sidebarSolidSetting").change(function() {
	if ($("#sidebarSolidSetting").is(":checked")) {
		$("body").addClass("sidebar-solid");
		solid = true;
	}
	else {
		$("body").removeClass("sidebar-solid");
		solid = false;
	}
});

$("#sidebarHoverSetting").change(function() {
	if ($("#sidebarHoverSetting").is(":checked")) {
		$("body").addClass("sidebar-hover");
		sidebarHover = true;
	}
	else {
		$("body").removeClass("sidebar-hover");
		sidebarHover = false;
	}
});