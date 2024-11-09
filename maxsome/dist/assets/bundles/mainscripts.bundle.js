if ("undefined" == typeof jQuery)
  throw new Error("jQuery plugins need to be before this file");
$(function () {
  "use strict";
  $.AdminAmaze.browser.activate(),
    $.AdminAmaze.leftSideBar.activate(),
    $.AdminAmaze.rightSideBar.activate(),
    $.AdminAmaze.navbar.activate(),
    $.AdminAmaze.select.activate(),
    setTimeout(function () {
      $(".page-loader-wrapper").fadeOut();
    }, 10);
  var a = $("input[name=menu_settings]").change(function () {
    var e = $("body"),
      t = a.filter(":checked").val();
    "menu-h" == t
      ? (e.addClass("h_menu"),
        e.removeClass("leftmenu"),
        e.removeClass("ls-closed"),
        e.removeClass("fullwidth"))
      : "menu-l" == t
      ? (e.addClass("leftmenu"),
        e.removeClass("h_menu"),
        e.removeClass("ls-closed"),
        e.removeClass("fullwidth"))
      : "menu-f" == t &&
        (e.addClass("ls-closed"),
        e.addClass("fullwidth"),
        e.removeClass("h_menu"),
        e.removeClass("leftmenu"));
  });
}),
  ($.AdminAmaze = {}),
  ($.AdminAmaze.options = {
    colors: {
      red: "#ec3b57",
      pink: "#E91E63",
      purple: "#ba3bd0",
      deepPurple: "#673AB7",
      indigo: "#3F51B5",
      blue: "#2196f3",
      lightBlue: "#03A9F4",
      cyan: "#00bcd4",
      green: "#4CAF50",
      lightGreen: "#8BC34A",
      yellow: "#ffe821",
      orange: "#FF9800",
      deepOrange: "#f83600",
      grey: "#9E9E9E",
      blueGrey: "#607D8B",
      black: "#000000",
      blush: "#dd5e89",
      white: "#ffffff",
    },
    leftSideBar: {
      scrollColor: "rgba(0,0,0,0.5)",
      scrollWidth: "4px",
      scrollAlwaysVisible: !1,
      scrollBorderRadius: "0",
      scrollRailBorderRadius: "0",
    },
    dropdownMenu: { effectIn: "fadeIn", effectOut: "fadeOut" },
  }),
  ($.AdminAmaze.leftSideBar = {
    activate: function () {
      var a = this,
        n = $("body"),
        o = $(".overlay");
      $(window).on("click", function (e) {
        var t = $(e.target);
        !(t =
          "i" === e.target.nodeName.toLowerCase()
            ? $(e.target).parent()
            : t).hasClass("bars") &&
          a.isOpen() &&
          0 === t.parents("#leftsidebar").length &&
          (t.hasClass("js-right-sidebar") || o.fadeOut(),
          n.removeClass("overlay-open"));
      }),
        $.each($(".menu-toggle.toggled"), function (e, t) {
          $(t).next().slideToggle(0);
        }),
        $.each($(".menu .list li.active"), function (e, t) {
          t = $(t).find("a:eq(0)");
          t.addClass("toggled"), t.next().show();
        }),
        $(".menu-toggle").on("click", function (e) {
          var t = $(this),
            a = t.next();
          $(t.parents("ul")[0]).hasClass("list") &&
            ((e = $(e.target).hasClass("menu-toggle")
              ? e.target
              : $(e.target).parents(".menu-toggle")),
            $.each($(".menu-toggle.toggled").not(e).next(), function (e, t) {
              $(t).is(":visible") &&
                ($(t).prev().toggleClass("toggled"), $(t).slideUp());
            })),
            t.toggleClass("toggled"),
            a.slideToggle(320);
        }),
        a.checkStatuForResize(!0),
        $(window).resize(function () {
          a.checkStatuForResize(!1);
        }),
        Waves.attach(".menu .list a", ["waves-block"]),
        Waves.init();
    },
    checkStatuForResize: function (e) {
      var t = $("body"),
        a = $(".navbar .navbar-header .bars"),
        n = t.width();
      e &&
        t
          .find(".content, .sidebar")
          .addClass("no-animate")
          .delay(1e3)
          .queue(function () {
            $(this).removeClass("no-animate").dequeue();
          }),
        n < 1170
          ? (t.addClass("ls-closed"),
            t.removeClass("h_menu"),
            t.removeClass("leftmenu"),
            $(".layout_setting_card").hide(),
            a.fadeIn())
          : (t.removeClass("ls-closed"),
            t.addClass("h_menu"),
            $(".layout_setting_card").show(),
            $("input[name=menu_settings][value=menu-h]").prop("checked", !0),
            a.fadeOut());
    },
    isOpen: function () {
      return $("body").hasClass("overlay-open");
    },
  }),
  ($.AdminAmaze.rightSideBar = {
    activate: function () {
      var a = this,
        n = $("#rightsidebar"),
        o = $(".overlay");
      $(window).on("click", function (e) {
        var t = $(e.target);
        !(t =
          "i" === e.target.nodeName.toLowerCase()
            ? $(e.target).parent()
            : t).hasClass("js-right-sidebar") &&
          a.isOpen() &&
          0 === t.parents("#rightsidebar").length &&
          (t.hasClass("bars") || o.fadeOut(), n.removeClass("open"));
      }),
        $(".js-right-sidebar").on("click", function () {
          n.toggleClass("open"), a.isOpen() ? o.fadeIn() : o.fadeOut();
        });
    },
    isOpen: function () {
      return $(".right-sidebar").hasClass("open");
    },
  }),
  ($.AdminAmaze.navbar = {
    activate: function () {
      var e = $("body"),
        t = $(".overlay");
      $(".bars").on("click", function () {
        e.toggleClass("overlay-open"),
          e.hasClass("overlay-open") ? t.fadeIn() : t.fadeOut();
      }),
        $('.nav [data-close="true"]').on("click", function () {
          var e = $(".navbar-toggle").is(":visible"),
            t = $(".navbar-collapse");
          e &&
            t.slideUp(function () {
              t.removeClass("in").removeAttr("style");
            });
        });
    },
  }),
  ($.AdminAmaze.select = {
    activate: function () {
      $.fn.selectpicker && $("select:not(.ms)").selectpicker();
    },
  });
var edge = "Microsoft Edge",
  ie10 = "Internet Explorer 10",
  ie11 = "Internet Explorer 11",
  opera = "Opera",
  firefox = "Mozilla Firefox",
  chrome = "Google Chrome",
  safari = "Safari";
function initSparkline() {
  $(".sparkline").each(function () {
    var e = $(this);
    e.sparkline("html", e.data());
  });
}
function initCounters() {
  $(".count-to").countTo();
}
function skinChanger() {
  $(".right-sidebar .choose-skin li").on("click", function () {
    var e = $("#body"),
      t = $(this),
      a = $(".right-sidebar .choose-skin li.active").data("theme");
    $(".right-sidebar .choose-skin li").removeClass("active"),
      e.removeClass("theme-" + a),
      t.addClass("active"),
      e.addClass("theme-" + t.data("theme"));
  });
}
function FontSetting() {
  $(".font_setting input:radio").click(function () {
    var e = $("[name='" + this.name + "']")
      .map(function () {
        return this.value;
      })
      .get()
      .join(" ");
    console.log(e), $("body").removeClass(e).addClass(this.value);
  });
}
($.AdminAmaze.browser = {
  activate: function () {
    "" !== this.getClassName() && $("html").addClass(this.getClassName());
  },
  getBrowser: function () {
    var e = navigator.userAgent.toLowerCase();
    return /edge/i.test(e)
      ? edge
      : /rv:11/i.test(e)
      ? ie11
      : /msie 10/i.test(e)
      ? ie10
      : /opr/i.test(e)
      ? opera
      : /chrome/i.test(e)
      ? chrome
      : /firefox/i.test(e)
      ? firefox
      : navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)
      ? safari
      : void 0;
  },
  getClassName: function () {
    var e = this.getBrowser();
    return e === edge
      ? "edge"
      : e === ie11
      ? "ie11"
      : e === ie10
      ? "ie10"
      : e === opera
      ? "opera"
      : e === chrome
      ? "chrome"
      : e === firefox
      ? "firefox"
      : e === safari
      ? "safari"
      : "";
  },
}),
  (window.Amaze = {
    colors: {
      "theme-dark1": "#343a40",
      "theme-dark2": "#636d76",
      "theme-dark3": "#939697",
      "theme-dark4": "#c7c7c7",
      "theme-dark5": "#1c1818",
      "theme-cyan1": "#59c4bc",
      "theme-cyan2": "#637aae",
      "theme-cyan3": "#2faaa1",
      "theme-cyan4": "#4cc5bc",
      "theme-cyan5": "#89bab7",
      "theme-purple1": "#7954ad",
      "theme-purple2": "#e76886",
      "theme-purple3": "#782fdf",
      "theme-purple4": "#a06ee8",
      "theme-purple5": "#a390be",
      "theme-blue1": "#090089",
      "theme-blue2": "#0060ca",
      "theme-blue3": "#91ceff",
      "theme-blue4": "#fcdc74",
      "theme-blue5": "#a390be",
      "theme-orange1": "#FFA901",
      "theme-orange2": "#600489",
      "theme-orange3": "#FF7F00",
      "theme-orange4": "#FBC200",
      "theme-orange5": "#38C172",
      "theme-a1": "#283c63",
      "theme-a2": "#f85f73",
      "theme-a3": "#928a97",
      "theme-a4": "#fbe8d3",
      "theme-a5": "#318fb5",
    },
  }),
  $(function () {
    "use strict";
    initSparkline(),
      initCounters(),
      skinChanger(),
      FontSetting(),
      CustomPageJS();
  });
var toggleSwitch = document.querySelector(
    '.theme-switch input[type="checkbox"]'
  ),
  toggleHcSwitch = document.querySelector(
    '.theme-high-contrast input[type="checkbox"]'
  ),
  currentTheme = localStorage.getItem("theme");
function switchTheme(e) {
  e.target.checked
    ? (document.documentElement.setAttribute("data-theme", "dark"),
      localStorage.setItem("theme", "dark"),
      $('.theme-high-contrast input[type="checkbox"]').prop("checked", !1))
    : (document.documentElement.setAttribute("data-theme", "light"),
      localStorage.setItem("theme", "light"));
}
function switchHc(e) {
  e.target.checked
    ? (document.documentElement.setAttribute("data-theme", "high-contrast"),
      localStorage.setItem("theme", "high-contrast"),
      $('.theme-switch input[type="checkbox"]').prop("checked", !1))
    : (document.documentElement.setAttribute("data-theme", "light"),
      localStorage.setItem("theme", "light"));
}
function CustomPageJS() {
  $(".boxs-close").on("click", function () {
    $(this).parents(".card").addClass("closed").fadeOut();
  }),
    $(".sub_menu_btn").on("click", function () {
      $(".sub_menu").toggleClass("show");
    }),
    $(document).ready(function () {
      $(".btn_overlay").on("click", function () {
        $(".overlay_menu").fadeToggle(200),
          $(this).toggleClass("btn-open").toggleClass("btn-close");
      });
    }),
    $(".overlay_menu").on("click", function () {
      $(".overlay_menu").fadeToggle(200),
        $(".overlay_menu button.btn")
          .toggleClass("btn-open")
          .toggleClass("btn-close"),
        (open = !1);
    }),
    $(".form-control")
      .on("focus", function () {
        $(this).parent(".input-group").addClass("input-group-focus");
      })
      .on("blur", function () {
        $(this).parent(".input-group").removeClass("input-group-focus");
      }),
    $(".theme-rtl input").on("change", function () {
      this.checked
        ? ($("body").addClass("rtl_mode"),
          $(".team-info, .block-header .nav-tabs, .page-calendar").addClass(
            "rtl"
          ),
          $(".follow_us").addClass("rtl"),
          $(".timeline-item").addClass("rtl"))
        : ($("body").removeClass("rtl_mode"),
          $(".team-info, .block-header .nav-tabs, .page-calendar").removeClass(
            "rtl"
          ),
          $(".follow_us").removeClass("rtl"),
          $(".timeline-item").removeClass("rtl"));
    });
}
// currentTheme &&
//   (document.documentElement.setAttribute("data-theme", currentTheme),
//   "dark" === currentTheme && (toggleSwitch.checked = !0),
//   "high-contrast" === currentTheme) &&
//   ((toggleHcSwitch.checked = !0), (toggleSwitch.checked = !1)),
//   toggleSwitch.addEventListener("change", switchTheme, !1),
//   toggleHcSwitch.addEventListener("change", switchHc, !1);
// var Tawk_API = Tawk_API || {},
//   Tawk_LoadStart = new Date();
// !(function () {
//   var e = document.createElement("script"),
//     t = document.getElementsByTagName("script")[0];
//   (e.async = !0),
//     (e.src = "https://embed.tawk.to/5c6d4867f324050cfe342c69/default"),
//     (e.charset = "UTF-8"),
//     e.setAttribute("crossorigin", "*"),
//     t.parentNode.insertBefore(e, t);
// })();
