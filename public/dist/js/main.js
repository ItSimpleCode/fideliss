"use strict";

function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
var Scrollbar = window.Scrollbar;
Scrollbar.initAll();
window.addEventListener("load", function () {
  var aside = document.getElementById("aside");
  var asideToggle = document.getElementById("aside_toggle");
  var aside_texts = document.querySelectorAll(".text");
  asideToggle === null || asideToggle === void 0 || asideToggle.addEventListener("click", function () {
    aside === null || aside === void 0 || aside.classList.toggle("active");
    if (aside !== null && aside !== void 0 && aside.classList.contains("active")) aside_texts.forEach(function (e, i) {
      return setTimeout(function () {
        return e.classList.add("active");
      }, 100 * (i + 1));
    });else aside_texts.forEach(function (e) {
      return e.classList.remove("active");
    });
  });
});

// Selection field

window.addEventListener("DOMContentLoaded", function () {
  var selectionCon = document.querySelectorAll(".selection-field");
  var selectionField = document.querySelectorAll(".selection-field .field");
  var selectionFieldInputF = document.querySelectorAll(".selection-field .front");
  var selectionFieldInputB = document.querySelectorAll(".selection-field .back");
  var selectionFieldOptions = document.querySelectorAll(".selection-field .options");
  selectionField.forEach(function (fie) {
    fie.addEventListener("click", function (e) {
      selectionCon.forEach(function (con) {
        con.contains(fie) && selectionFieldOptions.forEach(function (opt) {
          con.contains(opt) ? opt.classList.toggle("show") : opt.classList.remove("show");
        });
      });
    });
  });
  selectionFieldOptions.forEach(function (opt) {
    _toConsumableArray(opt.children).forEach(function (chi) {
      chi.onclick = function () {
        return selectionCon.forEach(function (con) {
          if (con.contains(chi)) {
            selectionFieldInputF.forEach(function (inp) {
              if (con.contains(inp)) inp.value = chi.textContent;
            });
            selectionFieldInputB.forEach(function (inp) {
              if (con.contains(inp)) {
                inp.value = chi.dataset.hidden;
              }
            });
            opt.classList.remove("show");
          }
        });
      };
    });
  });
});