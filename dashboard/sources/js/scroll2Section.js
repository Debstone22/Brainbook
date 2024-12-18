/**
 * scroll2section - jQuery plugin to scroll to section from menu
 * @version v1.0.0
 * @homepage https://github.com/kiaonline/scroll2Section
 * @license ISC
 * @git git+https://github.com/kiaonline/scroll2Section.git
 */
"use strict";
!(function (t) {
  var e = function (e, i) {
    function o(t) {
      return -1 != p.indexOf(t);
    }
    function n(t) {
      var e = d.filter("[href$='#!" + t + "']");
      d.not(e).closest(i.activeParent).removeClass(i.activeClass),
        e.closest(i.activeParent).addClass(i.activeClass),
        u.trigger("update", e),
        (f = !0),
        (v = !1);
    }
    function r(e) {
      var o = 1,
        r = t("#" + e);
      if (r.length > 0 && !1 === v) {
        v = !0;
        var a = r.attr("data-padding") || 0,
          s = r.offset().top - parseInt(a) - h;
        (f = !1),
          t("body").addClass("scrolling"),
          t(c)
            .stop()
            .animate({ scrollTop: s }, i.duration, function () {
              var i = "#!" + e;
              t("body").removeClass("scrolling"),
                o === t(c).length &&
                  setTimeout(function () {
                    n(e);
                  }, 100),
                window.history &&
                  window.history.pushState &&
                  history.pushState("", document.title, i),
                o++;
            });
      }
    }
    var a =
        (window.matchMedia("(max-width: 767px)").matches,
        /Android|webOS|iPhone|iPad|BlackBerry|Windows Phone|Opera Mini|IEMobile|Mobile/i.test(
          navigator.userAgent
        ),
        t(e)),
      s = (a.data(), t(window)),
      l = t(e),
      c = i.scrollParent || "html,body",
      h = i.offsetTop || 0,
      f = !0,
      u = t(i.menu),
      d = u.find("a[data-section]"),
      p = [],
      v = !1,
      g = null,
      w = (t(document).scrollTop(), s.scrollTop(), i.useAffix || !1);
    if (
      (d.each(function () {
        var e = t(this),
          o = e.attr("href").toString().str2Hash().clearHash();
        p.push(o),
          e.click(function (e) {
            f = !1;
            var o = t(this),
              n = o.attr("href").str2Hash().clearHash();
            return (
              !n ||
              (o.closest(i.activeParent).addClass(i.activeClass),
              r(n),
              e.preventDefault(),
              !1)
            );
          });
      }),
      l.each(function () {
        var e = t(this);
        s.scroll(function () {
          var i = e.offset();
          i.top;
          if (
            (w && (h = u.outerHeight()),
            !1 === v &&
              s.scrollTop() + h >= e.offset().top &&
              e.offset().top + e.height() - h > s.scrollTop() &&
              f)
          ) {
            var r = e.attr("id"),
              a = o(r);
            if (!r.length || g === "#!" + r || !a) return !0;
            (g = "#!" + r),
              t(c).trigger("visibleSection", r),
              n(r),
              window.history &&
                window.history.pushState &&
                history.pushState("", document.title, g);
          }
        });
      }),
      window.location.hash)
    ) {
      g = window.location.hash.clearHash();
      var m = d.filter("[href$='#!" + g + "']");
      1 == m.length && m.trigger("click"), (f = !1);
    }
    return u;
  };
  (String.prototype.clearHash = function (t) {
    return this.replace("#!", "");
  }),
    (String.prototype.str2Hash = function (t) {
      var e = this.indexOf("#!");
      if (-1 == e) return this;
      var i = this.length;
      return this.slice(e, i);
    }),
    (t.fn.scroll2Section = function (i) {
      return (
        (i = t.extend({}, t.fn.scroll2Section.options, i)),
        t(this).hasClass("loaded") ? this : new e(this, i)
      );
    }),
    (t.fn.scroll2Section.options = {
      menu: "#menu",
      offSetTop: 0,
      activeClass: "active",
      activeParent: "li",
      duration: 1e3,
    });
})(jQuery);
