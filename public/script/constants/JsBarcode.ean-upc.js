/*! JsBarcode v3.6.0 | (c) Johan Lindell | MIT license */ ! function(t) {
    function e(r) {
        if (n[r]) return n[r].exports;
        var i = n[r] = {
            i: r,
            l: !1,
            exports: {}
        };
        return t[r].call(i.exports, i, i.exports, e), i.l = !0, i.exports
    }
    var n = {};
    return e.m = t, e.c = n, e.i = function(t) {
        return t
    }, e.d = function(t, e, n) {
        Object.defineProperty(t, e, {
            configurable: !1,
            enumerable: !0,
            get: n
        })
    }, e.n = function(t) {
        var n = t && t.__esModule ? function() {
            return t["default"]
        } : function() {
            return t
        };
        return e.d(n, "a", n), n
    }, e.o = function(t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, e.p = "", e(e.s = 23)
}([function(t, e) {
    "use strict";

    function n(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function i(t, e) {
        n(this, i), this.data = t, this.text = e.text || t, this.options = e
    };
    e["default"] = r
}, function(t, e) {
    "use strict";

    function n(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function() {
        function t() {
            n(this, t), this.startBin = "101", this.endBin = "101", this.middleBin = "01010", this.Lbinary = ["0001101", "0011001", "0010011", "0111101", "0100011", "0110001", "0101111", "0111011", "0110111", "0001011"], this.Gbinary = ["0100111", "0110011", "0011011", "0100001", "0011101", "0111001", "0000101", "0010001", "0001001", "0010111"], this.Rbinary = ["1110010", "1100110", "1101100", "1000010", "1011100", "1001110", "1010000", "1000100", "1001000", "1110100"]
        }
        return t.prototype.encode = function(t, e, n) {
            var r = "";
            n = n || "";
            for (var i = 0; i < t.length; i++) "L" == e[i] ? r += this.Lbinary[t[i]] : "G" == e[i] ? r += this.Gbinary[t[i]] : "R" == e[i] && (r += this.Rbinary[t[i]]), i < t.length - 1 && (r += n);
            return r
        }, t
    }();
    e["default"] = r
}, function(t, e) {
    "use strict";

    function n(t, e) {
        var n, r = {};
        for (n in t) t.hasOwnProperty(n) && (r[n] = t[n]);
        for (n in e) e.hasOwnProperty(n) && "undefined" != typeof e[n] && (r[n] = e[n]);
        return r
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e["default"] = n
}, function(t, e) {
    "use strict";

    function n(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }

    function r(t, e) {
        if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !e || "object" != typeof e && "function" != typeof e ? t : e
    }

    function i(t, e) {
        if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
        t.prototype = Object.create(e && e.prototype, {
            constructor: {
                value: t,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var o = function(t) {
            function e(i, o) {
                n(this, e);
                var a = r(this, t.call(this));
                return a.name = "InvalidInputException", a.symbology = i, a.input = o, a.message = '"' + a.input + '" is not a valid input for ' + a.symbology, a
            }
            return i(e, t), e
        }(Error),
        a = function(t) {
            function e() {
                n(this, e);
                var i = r(this, t.call(this));
                return i.name = "InvalidElementException", i.message = "Not supported type to render on", i
            }
            return i(e, t), e
        }(Error),
        s = function(t) {
            function e() {
                n(this, e);
                var i = r(this, t.call(this));
                return i.name = "NoElementException", i.message = "No element to render on.", i
            }
            return i(e, t), e
        }(Error);
    e.InvalidInputException = o, e.InvalidElementException = a, e.NoElementException = s
}, function(t, e) {
    "use strict";

    function n(t) {
        var e = ["width", "height", "textMargin", "fontSize", "margin", "marginTop", "marginBottom", "marginLeft", "marginRight"];
        for (var n in e) e.hasOwnProperty(n) && (n = e[n], "string" == typeof t[n] && (t[n] = parseInt(t[n], 10)));
        return "string" == typeof t.displayValue && (t.displayValue = "false" != t.displayValue), t
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e["default"] = n
}, function(t, e) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var n = {
        width: 2,
        height: 100,
        format: "auto",
        displayValue: !0,
        fontOptions: "",
        font: "monospace",
        text: void 0,
        textAlign: "center",
        textPosition: "bottom",
        textMargin: 2,
        fontSize: 20,
        background: "#ffffff",
        lineColor: "#000000",
        margin: 10,
        marginTop: void 0,
        marginBottom: void 0,
        marginLeft: void 0,
        marginRight: void 0,
        valid: function() {}
    };
    e["default"] = n
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        return e.height + (e.displayValue && t.text.length > 0 ? e.fontSize + e.textMargin : 0) + e.marginTop + e.marginBottom
    }

    function o(t, e, n) {
        if (n.displayValue && e < t) {
            if ("center" == n.textAlign) return Math.floor((t - e) / 2);
            if ("left" == n.textAlign) return 0;
            if ("right" == n.textAlign) return Math.floor(t - e)
        }
        return 0
    }

    function a(t, e, n) {
        for (var r = 0; r < t.length; r++) {
            var a, s = t[r],
                u = (0, d["default"])(e, s.options);
            a = u.displayValue ? f(s.text, u, n) : 0;
            var c = s.data.length * u.width;
            s.width = Math.ceil(Math.max(a, c)), s.height = i(s, u), s.barcodePadding = o(a, c, u)
        }
    }

    function s(t) {
        for (var e = 0, n = 0; n < t.length; n++) e += t[n].width;
        return e
    }

    function u(t) {
        for (var e = 0, n = 0; n < t.length; n++) t[n].height > e && (e = t[n].height);
        return e
    }

    function f(t, e, n) {
        var r;
        r = "undefined" == typeof n ? document.createElement("canvas").getContext("2d") : n, r.font = e.fontOptions + " " + e.fontSize + "px " + e.font;
        var i = r.measureText(t).width;
        return i
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e.getTotalWidthOfEncodings = e.calculateEncodingAttributes = e.getBarcodePadding = e.getEncodingHeight = e.getMaximumHeightOfEncodings = void 0;
    var c = n(2),
        d = r(c);
    e.getMaximumHeightOfEncodings = u, e.getEncodingHeight = i, e.getBarcodePadding = o, e.calculateEncodingAttributes = a, e.getTotalWidthOfEncodings = s
}, function(t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = n(17);
    e["default"] = {
        EAN13: r.EAN13,
        EAN8: r.EAN8,
        EAN5: r.EAN5,
        EAN2: r.EAN2,
        UPC: r.UPC
    }
}, function(t, e) {
    "use strict";

    function n(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function() {
        function t(e) {
            n(this, t), this.api = e
        }
        return t.prototype.handleCatch = function(t) {
            if ("InvalidInputException" !== t.name) throw t;
            if (this.api._options.valid === this.api._defaults.valid) throw t.message;
            this.api._options.valid(!1), this.api.render = function() {}
        }, t.prototype.wrapBarcodeCall = function(t) {
            try {
                var e = t.apply(void 0, arguments);
                return this.api._options.valid(!0), e
            } catch (n) {
                return this.handleCatch(n), this.api
            }
        }, t
    }();
    e["default"] = r
}, function(t, e) {
    "use strict";

    function n(t) {
        return t.marginTop = t.marginTop || t.margin, t.marginBottom = t.marginBottom || t.margin, t.marginRight = t.marginRight || t.margin, t.marginLeft = t.marginLeft || t.margin, t
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e["default"] = n
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t) {
        if ("string" == typeof t) return o(t);
        if (Array.isArray(t)) {
            for (var e = [], n = 0; n < t.length; n++) e.push(i(t[n]));
            return e
        }
        if ("undefined" != typeof HTMLCanvasElement && t instanceof HTMLImageElement) return a(t);
        if ("undefined" != typeof SVGElement && t instanceof SVGElement) return {
            element: t,
            options: (0, f["default"])(t),
            renderer: d["default"].SVGRenderer
        };
        if ("undefined" != typeof HTMLCanvasElement && t instanceof HTMLCanvasElement) return {
            element: t,
            options: (0, f["default"])(t),
            renderer: d["default"].CanvasRenderer
        };
        if (t && t.getContext) return {
            element: t,
            renderer: d["default"].CanvasRenderer
        };
        if (t && "object" === ("undefined" == typeof t ? "undefined" : s(t)) && !t.nodeName) return {
            element: t,
            renderer: d["default"].ObjectRenderer
        };
        throw new l.InvalidElementException
    }

    function o(t) {
        var e = document.querySelectorAll(t);
        if (0 !== e.length) {
            for (var n = [], r = 0; r < e.length; r++) n.push(i(e[r]));
            return n
        }
    }

    function a(t) {
        var e = document.createElement("canvas");
        return {
            element: e,
            options: (0, f["default"])(t),
            renderer: d["default"].CanvasRenderer,
            afterRender: function() {
                t.setAttribute("src", e.toDataURL())
            }
        }
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var s = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
            return typeof t
        } : function(t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol ? "symbol" : typeof t
        },
        u = n(18),
        f = r(u),
        c = n(20),
        d = r(c),
        l = n(3);
    e["default"] = i
}, function(t, e) {
    "use strict";

    function n(t) {
        function e(t) {
            if (Array.isArray(t))
                for (var r = 0; r < t.length; r++) e(t[r]);
            else t.text = t.text || "", t.data = t.data || "", n.push(t)
        }
        var n = [];
        return e(t), n
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e["default"] = n
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }

    function o(t, e) {
        if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !e || "object" != typeof e && "function" != typeof e ? t : e
    }

    function a(t, e) {
        if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
        t.prototype = Object.create(e && e.prototype, {
            constructor: {
                value: t,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
    }

    function s(t) {
        var e, n = 0;
        for (e = 0; e < 12; e += 2) n += parseInt(t[e]);
        for (e = 1; e < 12; e += 2) n += 3 * parseInt(t[e]);
        return (10 - n % 10) % 10
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var u = n(1),
        f = r(u),
        c = n(0),
        d = r(c),
        l = function(t) {
            function e(n, r) {
                i(this, e), n.search(/^[0-9]{12}$/) !== -1 && (n += s(n));
                var a = o(this, t.call(this, n, r));
                return !r.flat && r.fontSize > 10 * r.width ? a.fontSize = 10 * r.width : a.fontSize = r.fontSize, a.guardHeight = r.height + a.fontSize / 2 + r.textMargin, a.lastChar = r.lastChar, a
            }
            return a(e, t), e.prototype.valid = function() {
                return this.data.search(/^[0-9]{13}$/) !== -1 && this.data[12] == s(this.data)
            }, e.prototype.encode = function() {
                return this.options.flat ? this.flatEncoding() : this.guardedEncoding()
            }, e.prototype.getStructure = function() {
                return ["LLLLLL", "LLGLGG", "LLGGLG", "LLGGGL", "LGLLGG", "LGGLLG", "LGGGLL", "LGLGLG", "LGLGGL", "LGGLGL"]
            }, e.prototype.guardedEncoding = function() {
                var t = new f["default"],
                    e = [],
                    n = this.getStructure()[this.data[0]],
                    r = this.data.substr(1, 6),
                    i = this.data.substr(7, 6);
                return this.options.displayValue && e.push({
                    data: "000000000000",
                    text: this.text.substr(0, 1),
                    options: {
                        textAlign: "left",
                        fontSize: this.fontSize
                    }
                }), e.push({
                    data: "101",
                    options: {
                        height: this.guardHeight
                    }
                }), e.push({
                    data: t.encode(r, n),
                    text: this.text.substr(1, 6),
                    options: {
                        fontSize: this.fontSize
                    }
                }), e.push({
                    data: "01010",
                    options: {
                        height: this.guardHeight
                    }
                }), e.push({
                    data: t.encode(i, "RRRRRR"),
                    text: this.text.substr(7, 6),
                    options: {
                        fontSize: this.fontSize
                    }
                }), e.push({
                    data: "101",
                    options: {
                        height: this.guardHeight
                    }
                }), this.options.lastChar && this.options.displayValue && (e.push({
                    data: "00"
                }), e.push({
                    data: "00000",
                    text: this.options.lastChar,
                    options: {
                        fontSize: this.fontSize
                    }
                })), e
            }, e.prototype.flatEncoding = function() {
                var t = new f["default"],
                    e = "",
                    n = this.getStructure()[this.data[0]];
                return e += "101", e += t.encode(this.data.substr(1, 6), n), e += "01010", e += t.encode(this.data.substr(7, 6), "RRRRRR"), e += "101", {
                    data: e,
                    text: this.text
                }
            }, e
        }(d["default"]);
    e["default"] = l
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }

    function o(t, e) {
        if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !e || "object" != typeof e && "function" != typeof e ? t : e
    }

    function a(t, e) {
        if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
        t.prototype = Object.create(e && e.prototype, {
            constructor: {
                value: t,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var s = n(1),
        u = r(s),
        f = n(0),
        c = r(f),
        d = function(t) {
            function e(n, r) {
                i(this, e);
                var a = o(this, t.call(this, n, r));
                return a.structure = ["LL", "LG", "GL", "GG"], a
            }
            return a(e, t), e.prototype.valid = function() {
                return this.data.search(/^[0-9]{2}$/) !== -1
            }, e.prototype.encode = function() {
                var t = new u["default"],
                    e = this.structure[parseInt(this.data) % 4],
                    n = "1011";
                return n += t.encode(this.data, e, "01"), {
                    data: n,
                    text: this.text
                }
            }, e
        }(c["default"]);
    e["default"] = d
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }

    function o(t, e) {
        if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !e || "object" != typeof e && "function" != typeof e ? t : e
    }

    function a(t, e) {
        if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
        t.prototype = Object.create(e && e.prototype, {
            constructor: {
                value: t,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var s = n(1),
        u = r(s),
        f = n(0),
        c = r(f),
        d = function(t) {
            function e(n, r) {
                i(this, e);
                var a = o(this, t.call(this, n, r));
                return a.structure = ["GGLLL", "GLGLL", "GLLGL", "GLLLG", "LGGLL", "LLGGL", "LLLGG", "LGLGL", "LGLLG", "LLGLG"], a
            }
            return a(e, t), e.prototype.valid = function() {
                return this.data.search(/^[0-9]{5}$/) !== -1
            }, e.prototype.encode = function() {
                var t = new u["default"],
                    e = this.checksum(),
                    n = "1011";
                return n += t.encode(this.data, this.structure[e], "01"), {
                    data: n,
                    text: this.text
                }
            }, e.prototype.checksum = function() {
                var t = 0;
                return t += 3 * parseInt(this.data[0]), t += 9 * parseInt(this.data[1]), t += 3 * parseInt(this.data[2]), t += 9 * parseInt(this.data[3]), t += 3 * parseInt(this.data[4]), t % 10
            }, e
        }(c["default"]);
    e["default"] = d
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }

    function o(t, e) {
        if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !e || "object" != typeof e && "function" != typeof e ? t : e
    }

    function a(t, e) {
        if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
        t.prototype = Object.create(e && e.prototype, {
            constructor: {
                value: t,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
    }

    function s(t) {
        var e, n = 0;
        for (e = 0; e < 7; e += 2) n += 3 * parseInt(t[e]);
        for (e = 1; e < 7; e += 2) n += parseInt(t[e]);
        return (10 - n % 10) % 10
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var u = n(1),
        f = r(u),
        c = n(0),
        d = r(c),
        l = function(t) {
            function e(n, r) {
                return i(this, e), n.search(/^[0-9]{7}$/) !== -1 && (n += s(n)), o(this, t.call(this, n, r))
            }
            return a(e, t), e.prototype.valid = function() {
                return this.data.search(/^[0-9]{8}$/) !== -1 && this.data[7] == s(this.data)
            }, e.prototype.encode = function() {
                var t = new f["default"],
                    e = "",
                    n = this.data.substr(0, 4),
                    r = this.data.substr(4, 4);
                return e += t.startBin, e += t.encode(n, "LLLL"), e += t.middleBin, e += t.encode(r, "RRRR"), e += t.endBin, {
                    data: e,
                    text: this.text
                }
            }, e
        }(d["default"]);
    e["default"] = l
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }

    function o(t, e) {
        if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !e || "object" != typeof e && "function" != typeof e ? t : e
    }

    function a(t, e) {
        if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
        t.prototype = Object.create(e && e.prototype, {
            constructor: {
                value: t,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
    }

    function s(t) {
        var e, n = 0;
        for (e = 1; e < 11; e += 2) n += parseInt(t[e]);
        for (e = 0; e < 11; e += 2) n += 3 * parseInt(t[e]);
        return (10 - n % 10) % 10
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var u = n(1),
        f = r(u),
        c = n(0),
        d = r(c),
        l = function(t) {
            function e(n, r) {
                i(this, e), n.search(/^[0-9]{11}$/) !== -1 && (n += s(n));
                var a = o(this, t.call(this, n, r));
                return a.displayValue = r.displayValue, r.fontSize > 10 * r.width ? a.fontSize = 10 * r.width : a.fontSize = r.fontSize, a.guardHeight = r.height + a.fontSize / 2 + r.textMargin, a
            }
            return a(e, t), e.prototype.valid = function() {
                return this.data.search(/^[0-9]{12}$/) !== -1 && this.data[11] == s(this.data)
            }, e.prototype.encode = function() {
                return this.options.flat ? this.flatEncoding() : this.guardedEncoding()
            }, e.prototype.flatEncoding = function() {
                var t = new f["default"],
                    e = "";
                return e += "101", e += t.encode(this.data.substr(0, 6), "LLLLLL"), e += "01010", e += t.encode(this.data.substr(6, 6), "RRRRRR"), e += "101", {
                    data: e,
                    text: this.text
                }
            }, e.prototype.guardedEncoding = function() {
                var t = new f["default"],
                    e = [];
                return this.displayValue && e.push({
                    data: "00000000",
                    text: this.text.substr(0, 1),
                    options: {
                        textAlign: "left",
                        fontSize: this.fontSize
                    }
                }), e.push({
                    data: "101" + t.encode(this.data[0], "L"),
                    options: {
                        height: this.guardHeight
                    }
                }), e.push({
                    data: t.encode(this.data.substr(1, 5), "LLLLL"),
                    text: this.text.substr(1, 5),
                    options: {
                        fontSize: this.fontSize
                    }
                }), e.push({
                    data: "01010",
                    options: {
                        height: this.guardHeight
                    }
                }), e.push({
                    data: t.encode(this.data.substr(6, 5), "RRRRR"),
                    text: this.text.substr(6, 5),
                    options: {
                        fontSize: this.fontSize
                    }
                }), e.push({
                    data: t.encode(this.data[11], "R") + "101",
                    options: {
                        height: this.guardHeight
                    }
                }), this.displayValue && e.push({
                    data: "00000000",
                    text: this.text.substr(11, 1),
                    options: {
                        textAlign: "right",
                        fontSize: this.fontSize
                    }
                }), e
            }, e
        }(d["default"]);
    e["default"] = l
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e.UPC = e.EAN2 = e.EAN5 = e.EAN8 = e.EAN13 = void 0;
    var i = n(12),
        o = r(i),
        a = n(15),
        s = r(a),
        u = n(14),
        f = r(u),
        c = n(13),
        d = r(c),
        l = n(16),
        h = r(l);
    e.EAN13 = o["default"], e.EAN8 = s["default"], e.EAN5 = f["default"], e.EAN2 = d["default"], e.UPC = h["default"]
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t) {
        var e = {};
        for (var n in u["default"]) u["default"].hasOwnProperty(n) && (t.hasAttribute("jsbarcode-" + n.toLowerCase()) && (e[n] = t.getAttribute("jsbarcode-" + n.toLowerCase())), t.hasAttribute("data-" + n.toLowerCase()) && (e[n] = t.getAttribute("data-" + n.toLowerCase())));
        return e.value = t.getAttribute("jsbarcode-value") || t.getAttribute("data-value"), e = (0, a["default"])(e)
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var o = n(4),
        a = r(o),
        s = n(5),
        u = r(s);
    e["default"] = i
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var o = n(2),
        a = r(o),
        s = n(6),
        u = function() {
            function t(e, n, r) {
                i(this, t), this.canvas = e, this.encodings = n, this.options = r
            }
            return t.prototype.render = function() {
                if (!this.canvas.getContext) throw new Error("The browser does not support canvas.");
                this.prepareCanvas();
                for (var t = 0; t < this.encodings.length; t++) {
                    var e = (0, a["default"])(this.options, this.encodings[t].options);
                    this.drawCanvasBarcode(e, this.encodings[t]), this.drawCanvasText(e, this.encodings[t]), this.moveCanvasDrawing(this.encodings[t])
                }
                this.restoreCanvas()
            }, t.prototype.prepareCanvas = function() {
                var t = this.canvas.getContext("2d");
                t.save(), (0, s.calculateEncodingAttributes)(this.encodings, this.options, t);
                var e = (0, s.getTotalWidthOfEncodings)(this.encodings),
                    n = (0, s.getMaximumHeightOfEncodings)(this.encodings);
                this.canvas.width = e + this.options.marginLeft + this.options.marginRight, this.canvas.height = n, t.clearRect(0, 0, this.canvas.width, this.canvas.height), this.options.background && (t.fillStyle = this.options.background, t.fillRect(0, 0, this.canvas.width, this.canvas.height)), t.translate(this.options.marginLeft, 0)
            }, t.prototype.drawCanvasBarcode = function(t, e) {
                var n, r = this.canvas.getContext("2d"),
                    i = e.data;
                n = "top" == t.textPosition ? t.marginTop + t.fontSize + t.textMargin : t.marginTop, r.fillStyle = t.lineColor;
                for (var o = 0; o < i.length; o++) {
                    var a = o * t.width + e.barcodePadding;
                    "1" === i[o] ? r.fillRect(a, n, t.width, t.height) : i[o] && r.fillRect(a, n, t.width, t.height * i[o])
                }
            }, t.prototype.drawCanvasText = function(t, e) {
                var n = this.canvas.getContext("2d"),
                    r = t.fontOptions + " " + t.fontSize + "px " + t.font;
                if (t.displayValue) {
                    var i, o;
                    o = "top" == t.textPosition ? t.marginTop + t.fontSize - t.textMargin : t.height + t.textMargin + t.marginTop + t.fontSize, n.font = r, "left" == t.textAlign || e.barcodePadding > 0 ? (i = 0, n.textAlign = "left") : "right" == t.textAlign ? (i = e.width - 1, n.textAlign = "right") : (i = e.width / 2, n.textAlign = "center"), n.fillText(e.text, i, o)
                }
            }, t.prototype.moveCanvasDrawing = function(t) {
                var e = this.canvas.getContext("2d");
                e.translate(t.width, 0)
            }, t.prototype.restoreCanvas = function() {
                var t = this.canvas.getContext("2d");
                t.restore()
            }, t
        }();
    e["default"] = u
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var i = n(19),
        o = r(i),
        a = n(22),
        s = r(a),
        u = n(21),
        f = r(u);
    e["default"] = {
        CanvasRenderer: o["default"],
        SVGRenderer: s["default"],
        ObjectRenderer: f["default"]
    }
}, function(t, e) {
    "use strict";

    function n(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function() {
        function t(e, r, i) {
            n(this, t), this.object = e, this.encodings = r, this.options = i
        }
        return t.prototype.render = function() {
            this.object.encodings = this.encodings
        }, t
    }();
    e["default"] = r
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }

    function o(t, e, n) {
        var r = document.createElementNS(d, "g");
        return r.setAttribute("transform", "translate(" + t + ", " + e + ")"), n.appendChild(r), r
    }

    function a(t, e) {
        t.setAttribute("style", "fill:" + e.lineColor + ";")
    }

    function s(t, e, n, r, i) {
        var o = document.createElementNS(d, "rect");
        return o.setAttribute("x", t), o.setAttribute("y", e), o.setAttribute("width", n), o.setAttribute("height", r), i.appendChild(o), o
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var u = n(2),
        f = r(u),
        c = n(6),
        d = "http://www.w3.org/2000/svg",
        l = function() {
            function t(e, n, r) {
                i(this, t), this.svg = e, this.encodings = n, this.options = r
            }
            return t.prototype.render = function() {
                var t = this.options.marginLeft;
                this.prepareSVG();
                for (var e = 0; e < this.encodings.length; e++) {
                    var n = this.encodings[e],
                        r = (0, f["default"])(this.options, n.options),
                        i = o(t, r.marginTop, this.svg);
                    a(i, r), this.drawSvgBarcode(i, r, n), this.drawSVGText(i, r, n), t += n.width
                }
            }, t.prototype.prepareSVG = function() {
                for (; this.svg.firstChild;) this.svg.removeChild(this.svg.firstChild);
                (0, c.calculateEncodingAttributes)(this.encodings, this.options);
                var t = (0, c.getTotalWidthOfEncodings)(this.encodings),
                    e = (0, c.getMaximumHeightOfEncodings)(this.encodings),
                    n = t + this.options.marginLeft + this.options.marginRight;
                this.setSvgAttributes(n, e), this.options.background && s(0, 0, n, e, this.svg).setAttribute("style", "fill:" + this.options.background + ";")
            }, t.prototype.drawSvgBarcode = function(t, e, n) {
                var r, i = n.data;
                r = "top" == e.textPosition ? e.fontSize + e.textMargin : 0;
                for (var o = 0, a = 0, u = 0; u < i.length; u++) a = u * e.width + n.barcodePadding, "1" === i[u] ? o++ : o > 0 && (s(a - e.width * o, r, e.width * o, e.height, t), o = 0);
                o > 0 && s(a - e.width * (o - 1), r, e.width * o, e.height, t)
            }, t.prototype.drawSVGText = function(t, e, n) {
                var r = document.createElementNS(d, "text");
                if (e.displayValue) {
                    var i, o;
                    r.setAttribute("style", "font:" + e.fontOptions + " " + e.fontSize + "px " + e.font), o = "top" == e.textPosition ? e.fontSize - e.textMargin : e.height + e.textMargin + e.fontSize, "left" == e.textAlign || n.barcodePadding > 0 ? (i = 0, r.setAttribute("text-anchor", "start")) : "right" == e.textAlign ? (i = n.width - 1, r.setAttribute("text-anchor", "end")) : (i = n.width / 2, r.setAttribute("text-anchor", "middle")), r.setAttribute("x", i), r.setAttribute("y", o), r.appendChild(document.createTextNode(n.text)), t.appendChild(r)
                }
            }, t.prototype.setSvgAttributes = function(t, e) {
                var n = this.svg;
                n.setAttribute("width", t + "px"), n.setAttribute("height", e + "px"), n.setAttribute("x", "0px"), n.setAttribute("y", "0px"), n.setAttribute("viewBox", "0 0 " + t + " " + e), n.setAttribute("xmlns", d), n.setAttribute("version", "1.1"), n.style.transform = "translate(0,0)"
            }, t
        }();
    e["default"] = l
}, function(t, e, n) {
    "use strict";

    function r(t) {
        return t && t.__esModule ? t : {
            "default": t
        }
    }

    function i(t, e) {
        O.prototype[e] = O.prototype[e.toUpperCase()] = O.prototype[e.toLowerCase()] = function(n, r) {
            var i = this;
            return i._errorHandler.wrapBarcodeCall(function() {
                r.text = "undefined" == typeof r.text ? void 0 : "" + r.text;
                var a = (0, d["default"])(i._options, r);
                a = (0, w["default"])(a);
                var s = t[e],
                    u = o(n, s, a);
                return i._encodings.push(u), i
            })
        }
    }

    function o(t, e, n) {
        t = "" + t;
        var r = new e(t, n);
        if (!r.valid()) throw new x.InvalidInputException(r.constructor.name, t);
        var i = r.encode();
        i = (0, h["default"])(i);
        for (var o = 0; o < i.length; o++) i[o].options = (0, d["default"])(n, i[o].options);
        return i
    }

    function a() {
        return f["default"].CODE128 ? "CODE128" : Object.keys(f["default"])[0]
    }

    function s(t, e, n) {
        e = (0, h["default"])(e);
        for (var r = 0; r < e.length; r++) e[r].options = (0, d["default"])(n, e[r].options), (0, g["default"])(e[r].options);
        (0, g["default"])(n);
        var i = t.renderer,
            o = new i(t.element, e, n);
        o.render(), t.afterRender && t.afterRender()
    }
    var u = n(7),
        f = r(u),
        c = n(2),
        d = r(c),
        l = n(11),
        h = r(l),
        p = n(9),
        g = r(p),
        v = n(10),
        y = r(v),
        b = n(4),
        w = r(b),
        m = n(8),
        _ = r(m),
        x = n(3),
        L = n(5),
        E = r(L),
        O = function() {},
        A = function(t, e, n) {
            var r = new O;
            if ("undefined" == typeof t) throw Error("No element to render on was provided.");
            return r._renderProperties = (0, y["default"])(t), r._encodings = [], r._options = E["default"], r._errorHandler = new _["default"](r), "undefined" != typeof e && (n = n || {}, n.format || (n.format = a()), r.options(n)[n.format](e, n).render()), r
        };
    A.getModule = function(t) {
        return f["default"][t]
    };
    for (var P in f["default"]) f["default"].hasOwnProperty(P) && i(f["default"], P);
    O.prototype.options = function(t) {
        return this._options = (0, d["default"])(this._options, t), this
    }, O.prototype.blank = function(t) {
        var e = "0".repeat(t);
        return this._encodings.push({
            data: e
        }), this
    }, O.prototype.init = function() {
        if (this._renderProperties) {
            Array.isArray(this._renderProperties) || (this._renderProperties = [this._renderProperties]);
            var t;
            for (var e in this._renderProperties) {
                t = this._renderProperties[e];
                var n = (0, d["default"])(this._options, t.options);
                "auto" == n.format && (n.format = a()), this._errorHandler.wrapBarcodeCall(function() {
                    var e = n.value,
                        r = f["default"][n.format.toUpperCase()],
                        i = o(e, r, n);
                    s(t, i, n)
                })
            }
        }
    }, O.prototype.render = function() {
        if (!this._renderProperties) throw new x.NoElementException;
        if (Array.isArray(this._renderProperties))
            for (var t = 0; t < this._renderProperties.length; t++) s(this._renderProperties[t], this._encodings, this._options);
        else s(this._renderProperties, this._encodings, this._options);
        return this
    }, O.prototype._defaults = E["default"], "undefined" != typeof window && (window.JsBarcode = A), "undefined" != typeof jQuery && (jQuery.fn.JsBarcode = function(t, e) {
        var n = [];
        return jQuery(this).each(function() {
            n.push(this)
        }), A(n, t, e)
    }), t.exports = A
}]);