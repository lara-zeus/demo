var __create = Object.create;
var __defProp = Object.defineProperty;
var __getOwnPropDesc = Object.getOwnPropertyDescriptor;
var __getOwnPropNames = Object.getOwnPropertyNames;
var __getProtoOf = Object.getPrototypeOf;
var __hasOwnProp = Object.prototype.hasOwnProperty;
var __commonJS = (cb, mod) => function __require() {
  return mod || (0, cb[__getOwnPropNames(cb)[0]])((mod = { exports: {} }).exports, mod), mod.exports;
};
var __copyProps = (to, from, except, desc) => {
  if (from && typeof from === "object" || typeof from === "function") {
    for (let key of __getOwnPropNames(from))
      if (!__hasOwnProp.call(to, key) && key !== except)
        __defProp(to, key, { get: () => from[key], enumerable: !(desc = __getOwnPropDesc(from, key)) || desc.enumerable });
  }
  return to;
};
var __toESM = (mod, isNodeMode, target) => (target = mod != null ? __create(__getProtoOf(mod)) : {}, __copyProps(
  // If the importer is in node compatibility mode or this is not an ESM
  // file that has been converted to a CommonJS file using a Babel-
  // compatible transform (i.e. "__esModule" has not been set), then set
  // "default" to the CommonJS "module.exports" for node compatibility.
  isNodeMode || !mod || !mod.__esModule ? __defProp(target, "default", { value: mod, enumerable: true }) : target,
  mod
));

// node_modules/dom-to-image/src/dom-to-image.js
var require_dom_to_image = __commonJS({
  "node_modules/dom-to-image/src/dom-to-image.js"(exports, module) {
    (function(global2) {
      "use strict";
      var util = newUtil();
      var inliner = newInliner();
      var fontFaces = newFontFaces();
      var images = newImages();
      var defaultOptions = {
        // Default is to fail on error, no placeholder
        imagePlaceholder: void 0,
        // Default cache bust is false, it will use the cache
        cacheBust: false
      };
      var domtoimage2 = {
        toSvg,
        toPng,
        toJpeg,
        toBlob,
        toPixelData,
        impl: {
          fontFaces,
          images,
          util,
          inliner,
          options: {}
        }
      };
      if (typeof module !== "undefined")
        module.exports = domtoimage2;
      else
        global2.domtoimage = domtoimage2;
      function toSvg(node, options) {
        options = options || {};
        copyOptions(options);
        return Promise.resolve(node).then(function(node2) {
          return cloneNode(node2, options.filter, true);
        }).then(embedFonts).then(inlineImages).then(applyOptions).then(function(clone) {
          return makeSvgDataUri(
            clone,
            options.width || util.width(node),
            options.height || util.height(node)
          );
        });
        function applyOptions(clone) {
          if (options.bgcolor)
            clone.style.backgroundColor = options.bgcolor;
          if (options.width)
            clone.style.width = options.width + "px";
          if (options.height)
            clone.style.height = options.height + "px";
          if (options.style)
            Object.keys(options.style).forEach(function(property) {
              clone.style[property] = options.style[property];
            });
          return clone;
        }
      }
      function toPixelData(node, options) {
        return draw(node, options || {}).then(function(canvas) {
          return canvas.getContext("2d").getImageData(
            0,
            0,
            util.width(node),
            util.height(node)
          ).data;
        });
      }
      function toPng(node, options) {
        return draw(node, options || {}).then(function(canvas) {
          return canvas.toDataURL();
        });
      }
      function toJpeg(node, options) {
        options = options || {};
        return draw(node, options).then(function(canvas) {
          return canvas.toDataURL("image/jpeg", options.quality || 1);
        });
      }
      function toBlob(node, options) {
        return draw(node, options || {}).then(util.canvasToBlob);
      }
      function copyOptions(options) {
        if (typeof options.imagePlaceholder === "undefined") {
          domtoimage2.impl.options.imagePlaceholder = defaultOptions.imagePlaceholder;
        } else {
          domtoimage2.impl.options.imagePlaceholder = options.imagePlaceholder;
        }
        if (typeof options.cacheBust === "undefined") {
          domtoimage2.impl.options.cacheBust = defaultOptions.cacheBust;
        } else {
          domtoimage2.impl.options.cacheBust = options.cacheBust;
        }
      }
      function draw(domNode, options) {
        return toSvg(domNode, options).then(util.makeImage).then(util.delay(100)).then(function(image) {
          var canvas = newCanvas(domNode);
          canvas.getContext("2d").drawImage(image, 0, 0);
          return canvas;
        });
        function newCanvas(domNode2) {
          var canvas = document.createElement("canvas");
          canvas.width = options.width || util.width(domNode2);
          canvas.height = options.height || util.height(domNode2);
          if (options.bgcolor) {
            var ctx = canvas.getContext("2d");
            ctx.fillStyle = options.bgcolor;
            ctx.fillRect(0, 0, canvas.width, canvas.height);
          }
          return canvas;
        }
      }
      function cloneNode(node, filter, root) {
        if (!root && filter && !filter(node))
          return Promise.resolve();
        return Promise.resolve(node).then(makeNodeCopy).then(function(clone) {
          return cloneChildren(node, clone, filter);
        }).then(function(clone) {
          return processClone(node, clone);
        });
        function makeNodeCopy(node2) {
          if (node2 instanceof HTMLCanvasElement)
            return util.makeImage(node2.toDataURL());
          return node2.cloneNode(false);
        }
        function cloneChildren(original, clone, filter2) {
          var children = original.childNodes;
          if (children.length === 0)
            return Promise.resolve(clone);
          return cloneChildrenInOrder(clone, util.asArray(children), filter2).then(function() {
            return clone;
          });
          function cloneChildrenInOrder(parent, children2, filter3) {
            var done = Promise.resolve();
            children2.forEach(function(child) {
              done = done.then(function() {
                return cloneNode(child, filter3);
              }).then(function(childClone) {
                if (childClone)
                  parent.appendChild(childClone);
              });
            });
            return done;
          }
        }
        function processClone(original, clone) {
          if (!(clone instanceof Element))
            return clone;
          return Promise.resolve().then(cloneStyle).then(clonePseudoElements).then(copyUserInput).then(fixSvg).then(function() {
            return clone;
          });
          function cloneStyle() {
            copyStyle(window.getComputedStyle(original), clone.style);
            function copyStyle(source, target) {
              if (source.cssText)
                target.cssText = source.cssText;
              else
                copyProperties(source, target);
              function copyProperties(source2, target2) {
                util.asArray(source2).forEach(function(name) {
                  target2.setProperty(
                    name,
                    source2.getPropertyValue(name),
                    source2.getPropertyPriority(name)
                  );
                });
              }
            }
          }
          function clonePseudoElements() {
            [":before", ":after"].forEach(function(element) {
              clonePseudoElement(element);
            });
            function clonePseudoElement(element) {
              var style = window.getComputedStyle(original, element);
              var content = style.getPropertyValue("content");
              if (content === "" || content === "none")
                return;
              var className = util.uid();
              clone.className = clone.className + " " + className;
              var styleElement = document.createElement("style");
              styleElement.appendChild(formatPseudoElementStyle(className, element, style));
              clone.appendChild(styleElement);
              function formatPseudoElementStyle(className2, element2, style2) {
                var selector = "." + className2 + ":" + element2;
                var cssText = style2.cssText ? formatCssText(style2) : formatCssProperties(style2);
                return document.createTextNode(selector + "{" + cssText + "}");
                function formatCssText(style3) {
                  var content2 = style3.getPropertyValue("content");
                  return style3.cssText + " content: " + content2 + ";";
                }
                function formatCssProperties(style3) {
                  return util.asArray(style3).map(formatProperty).join("; ") + ";";
                  function formatProperty(name) {
                    return name + ": " + style3.getPropertyValue(name) + (style3.getPropertyPriority(name) ? " !important" : "");
                  }
                }
              }
            }
          }
          function copyUserInput() {
            if (original instanceof HTMLTextAreaElement)
              clone.innerHTML = original.value;
            if (original instanceof HTMLInputElement)
              clone.setAttribute("value", original.value);
          }
          function fixSvg() {
            if (!(clone instanceof SVGElement))
              return;
            clone.setAttribute("xmlns", "http://www.w3.org/2000/svg");
            if (!(clone instanceof SVGRectElement))
              return;
            ["width", "height"].forEach(function(attribute) {
              var value = clone.getAttribute(attribute);
              if (!value)
                return;
              clone.style.setProperty(attribute, value);
            });
          }
        }
      }
      function embedFonts(node) {
        return fontFaces.resolveAll().then(function(cssText) {
          var styleNode = document.createElement("style");
          node.appendChild(styleNode);
          styleNode.appendChild(document.createTextNode(cssText));
          return node;
        });
      }
      function inlineImages(node) {
        return images.inlineAll(node).then(function() {
          return node;
        });
      }
      function makeSvgDataUri(node, width, height) {
        return Promise.resolve(node).then(function(node2) {
          node2.setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
          return new XMLSerializer().serializeToString(node2);
        }).then(util.escapeXhtml).then(function(xhtml) {
          return '<foreignObject x="0" y="0" width="100%" height="100%">' + xhtml + "</foreignObject>";
        }).then(function(foreignObject) {
          return '<svg xmlns="http://www.w3.org/2000/svg" width="' + width + '" height="' + height + '">' + foreignObject + "</svg>";
        }).then(function(svg) {
          return "data:image/svg+xml;charset=utf-8," + svg;
        });
      }
      function newUtil() {
        return {
          escape,
          parseExtension,
          mimeType,
          dataAsUrl,
          isDataUrl,
          canvasToBlob,
          resolveUrl,
          getAndEncode,
          uid: uid(),
          delay,
          asArray,
          escapeXhtml,
          makeImage,
          width,
          height
        };
        function mimes() {
          var WOFF = "application/font-woff";
          var JPEG = "image/jpeg";
          return {
            "woff": WOFF,
            "woff2": WOFF,
            "ttf": "application/font-truetype",
            "eot": "application/vnd.ms-fontobject",
            "png": "image/png",
            "jpg": JPEG,
            "jpeg": JPEG,
            "gif": "image/gif",
            "tiff": "image/tiff",
            "svg": "image/svg+xml"
          };
        }
        function parseExtension(url) {
          var match = /\.([^\.\/]*?)$/g.exec(url);
          if (match)
            return match[1];
          else
            return "";
        }
        function mimeType(url) {
          var extension = parseExtension(url).toLowerCase();
          return mimes()[extension] || "";
        }
        function isDataUrl(url) {
          return url.search(/^(data:)/) !== -1;
        }
        function toBlob2(canvas) {
          return new Promise(function(resolve) {
            var binaryString = window.atob(canvas.toDataURL().split(",")[1]);
            var length = binaryString.length;
            var binaryArray = new Uint8Array(length);
            for (var i = 0; i < length; i++)
              binaryArray[i] = binaryString.charCodeAt(i);
            resolve(new Blob([binaryArray], {
              type: "image/png"
            }));
          });
        }
        function canvasToBlob(canvas) {
          if (canvas.toBlob)
            return new Promise(function(resolve) {
              canvas.toBlob(resolve);
            });
          return toBlob2(canvas);
        }
        function resolveUrl(url, baseUrl) {
          var doc = document.implementation.createHTMLDocument();
          var base = doc.createElement("base");
          doc.head.appendChild(base);
          var a = doc.createElement("a");
          doc.body.appendChild(a);
          base.href = baseUrl;
          a.href = url;
          return a.href;
        }
        function uid() {
          var index = 0;
          return function() {
            return "u" + fourRandomChars() + index++;
            function fourRandomChars() {
              return ("0000" + (Math.random() * Math.pow(36, 4) << 0).toString(36)).slice(-4);
            }
          };
        }
        function makeImage(uri) {
          return new Promise(function(resolve, reject) {
            var image = new Image();
            image.onload = function() {
              resolve(image);
            };
            image.onerror = reject;
            image.src = uri;
          });
        }
        function getAndEncode(url) {
          var TIMEOUT = 3e4;
          if (domtoimage2.impl.options.cacheBust) {
            url += (/\?/.test(url) ? "&" : "?") + (/* @__PURE__ */ new Date()).getTime();
          }
          return new Promise(function(resolve) {
            var request = new XMLHttpRequest();
            request.onreadystatechange = done;
            request.ontimeout = timeout;
            request.responseType = "blob";
            request.timeout = TIMEOUT;
            request.open("GET", url, true);
            request.send();
            var placeholder;
            if (domtoimage2.impl.options.imagePlaceholder) {
              var split = domtoimage2.impl.options.imagePlaceholder.split(/,/);
              if (split && split[1]) {
                placeholder = split[1];
              }
            }
            function done() {
              if (request.readyState !== 4)
                return;
              if (request.status !== 200) {
                if (placeholder) {
                  resolve(placeholder);
                } else {
                  fail("cannot fetch resource: " + url + ", status: " + request.status);
                }
                return;
              }
              var encoder = new FileReader();
              encoder.onloadend = function() {
                var content = encoder.result.split(/,/)[1];
                resolve(content);
              };
              encoder.readAsDataURL(request.response);
            }
            function timeout() {
              if (placeholder) {
                resolve(placeholder);
              } else {
                fail("timeout of " + TIMEOUT + "ms occured while fetching resource: " + url);
              }
            }
            function fail(message) {
              console.error(message);
              resolve("");
            }
          });
        }
        function dataAsUrl(content, type) {
          return "data:" + type + ";base64," + content;
        }
        function escape(string) {
          return string.replace(/([.*+?^${}()|\[\]\/\\])/g, "\\$1");
        }
        function delay(ms) {
          return function(arg) {
            return new Promise(function(resolve) {
              setTimeout(function() {
                resolve(arg);
              }, ms);
            });
          };
        }
        function asArray(arrayLike) {
          var array = [];
          var length = arrayLike.length;
          for (var i = 0; i < length; i++)
            array.push(arrayLike[i]);
          return array;
        }
        function escapeXhtml(string) {
          return string.replace(/#/g, "%23").replace(/\n/g, "%0A");
        }
        function width(node) {
          var leftBorder = px(node, "border-left-width");
          var rightBorder = px(node, "border-right-width");
          return node.scrollWidth + leftBorder + rightBorder;
        }
        function height(node) {
          var topBorder = px(node, "border-top-width");
          var bottomBorder = px(node, "border-bottom-width");
          return node.scrollHeight + topBorder + bottomBorder;
        }
        function px(node, styleProperty) {
          var value = window.getComputedStyle(node).getPropertyValue(styleProperty);
          return parseFloat(value.replace("px", ""));
        }
      }
      function newInliner() {
        var URL_REGEX = /url\(['"]?([^'"]+?)['"]?\)/g;
        return {
          inlineAll,
          shouldProcess,
          impl: {
            readUrls,
            inline
          }
        };
        function shouldProcess(string) {
          return string.search(URL_REGEX) !== -1;
        }
        function readUrls(string) {
          var result = [];
          var match;
          while ((match = URL_REGEX.exec(string)) !== null) {
            result.push(match[1]);
          }
          return result.filter(function(url) {
            return !util.isDataUrl(url);
          });
        }
        function inline(string, url, baseUrl, get) {
          return Promise.resolve(url).then(function(url2) {
            return baseUrl ? util.resolveUrl(url2, baseUrl) : url2;
          }).then(get || util.getAndEncode).then(function(data) {
            return util.dataAsUrl(data, util.mimeType(url));
          }).then(function(dataUrl) {
            return string.replace(urlAsRegex(url), "$1" + dataUrl + "$3");
          });
          function urlAsRegex(url2) {
            return new RegExp(`(url\\(['"]?)(` + util.escape(url2) + `)(['"]?\\))`, "g");
          }
        }
        function inlineAll(string, baseUrl, get) {
          if (nothingToInline())
            return Promise.resolve(string);
          return Promise.resolve(string).then(readUrls).then(function(urls) {
            var done = Promise.resolve(string);
            urls.forEach(function(url) {
              done = done.then(function(string2) {
                return inline(string2, url, baseUrl, get);
              });
            });
            return done;
          });
          function nothingToInline() {
            return !shouldProcess(string);
          }
        }
      }
      function newFontFaces() {
        return {
          resolveAll,
          impl: {
            readAll
          }
        };
        function resolveAll() {
          return readAll(document).then(function(webFonts) {
            return Promise.all(
              webFonts.map(function(webFont) {
                return webFont.resolve();
              })
            );
          }).then(function(cssStrings) {
            return cssStrings.join("\n");
          });
        }
        function readAll() {
          return Promise.resolve(util.asArray(document.styleSheets)).then(getCssRules).then(selectWebFontRules).then(function(rules) {
            return rules.map(newWebFont);
          });
          function selectWebFontRules(cssRules) {
            return cssRules.filter(function(rule) {
              return rule.type === CSSRule.FONT_FACE_RULE;
            }).filter(function(rule) {
              return inliner.shouldProcess(rule.style.getPropertyValue("src"));
            });
          }
          function getCssRules(styleSheets) {
            var cssRules = [];
            styleSheets.forEach(function(sheet) {
              try {
                util.asArray(sheet.cssRules || []).forEach(cssRules.push.bind(cssRules));
              } catch (e) {
                console.log("Error while reading CSS rules from " + sheet.href, e.toString());
              }
            });
            return cssRules;
          }
          function newWebFont(webFontRule) {
            return {
              resolve: function resolve() {
                var baseUrl = (webFontRule.parentStyleSheet || {}).href;
                return inliner.inlineAll(webFontRule.cssText, baseUrl);
              },
              src: function() {
                return webFontRule.style.getPropertyValue("src");
              }
            };
          }
        }
      }
      function newImages() {
        return {
          inlineAll,
          impl: {
            newImage
          }
        };
        function newImage(element) {
          return {
            inline
          };
          function inline(get) {
            if (util.isDataUrl(element.src))
              return Promise.resolve();
            return Promise.resolve(element.src).then(get || util.getAndEncode).then(function(data) {
              return util.dataAsUrl(data, util.mimeType(element.src));
            }).then(function(dataUrl) {
              return new Promise(function(resolve, reject) {
                element.onload = resolve;
                element.onerror = reject;
                element.src = dataUrl;
              });
            });
          }
        }
        function inlineAll(node) {
          if (!(node instanceof Element))
            return Promise.resolve(node);
          return inlineBackground(node).then(function() {
            if (node instanceof HTMLImageElement)
              return newImage(node).inline();
            else
              return Promise.all(
                util.asArray(node.childNodes).map(function(child) {
                  return inlineAll(child);
                })
              );
          });
          function inlineBackground(node2) {
            var background = node2.style.getPropertyValue("background");
            if (!background)
              return Promise.resolve(node2);
            return inliner.inlineAll(background).then(function(inlined) {
              node2.style.setProperty(
                "background",
                inlined,
                node2.style.getPropertyPriority("background")
              );
            }).then(function() {
              return node2;
            });
          }
        }
      }
    })(exports);
  }
});

// node_modules/file-saver/dist/FileSaver.min.js
var require_FileSaver_min = __commonJS({
  "node_modules/file-saver/dist/FileSaver.min.js"(exports, module) {
    (function(a, b) {
      if ("function" == typeof define && define.amd)
        define([], b);
      else if ("undefined" != typeof exports)
        b();
      else {
        b(), a.FileSaver = { exports: {} }.exports;
      }
    })(exports, function() {
      "use strict";
      function b(a2, b2) {
        return "undefined" == typeof b2 ? b2 = { autoBom: false } : "object" != typeof b2 && (console.warn("Deprecated: Expected third argument to be a object"), b2 = { autoBom: !b2 }), b2.autoBom && /^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(a2.type) ? new Blob(["\uFEFF", a2], { type: a2.type }) : a2;
      }
      function c(a2, b2, c2) {
        var d2 = new XMLHttpRequest();
        d2.open("GET", a2), d2.responseType = "blob", d2.onload = function() {
          g(d2.response, b2, c2);
        }, d2.onerror = function() {
          console.error("could not download file");
        }, d2.send();
      }
      function d(a2) {
        var b2 = new XMLHttpRequest();
        b2.open("HEAD", a2, false);
        try {
          b2.send();
        } catch (a3) {
        }
        return 200 <= b2.status && 299 >= b2.status;
      }
      function e(a2) {
        try {
          a2.dispatchEvent(new MouseEvent("click"));
        } catch (c2) {
          var b2 = document.createEvent("MouseEvents");
          b2.initMouseEvent("click", true, true, window, 0, 0, 0, 80, 20, false, false, false, false, 0, null), a2.dispatchEvent(b2);
        }
      }
      var f = "object" == typeof window && window.window === window ? window : "object" == typeof self && self.self === self ? self : "object" == typeof global && global.global === global ? global : void 0, a = f.navigator && /Macintosh/.test(navigator.userAgent) && /AppleWebKit/.test(navigator.userAgent) && !/Safari/.test(navigator.userAgent), g = f.saveAs || ("object" != typeof window || window !== f ? function() {
      } : "download" in HTMLAnchorElement.prototype && !a ? function(b2, g2, h) {
        var i = f.URL || f.webkitURL, j = document.createElement("a");
        g2 = g2 || b2.name || "download", j.download = g2, j.rel = "noopener", "string" == typeof b2 ? (j.href = b2, j.origin === location.origin ? e(j) : d(j.href) ? c(b2, g2, h) : e(j, j.target = "_blank")) : (j.href = i.createObjectURL(b2), setTimeout(function() {
          i.revokeObjectURL(j.href);
        }, 4e4), setTimeout(function() {
          e(j);
        }, 0));
      } : "msSaveOrOpenBlob" in navigator ? function(f2, g2, h) {
        if (g2 = g2 || f2.name || "download", "string" != typeof f2)
          navigator.msSaveOrOpenBlob(b(f2, h), g2);
        else if (d(f2))
          c(f2, g2, h);
        else {
          var i = document.createElement("a");
          i.href = f2, i.target = "_blank", setTimeout(function() {
            e(i);
          });
        }
      } : function(b2, d2, e2, g2) {
        if (g2 = g2 || open("", "_blank"), g2 && (g2.document.title = g2.document.body.innerText = "downloading..."), "string" == typeof b2)
          return c(b2, d2, e2);
        var h = "application/octet-stream" === b2.type, i = /constructor/i.test(f.HTMLElement) || f.safari, j = /CriOS\/[\d]+/.test(navigator.userAgent);
        if ((j || h && i || a) && "undefined" != typeof FileReader) {
          var k = new FileReader();
          k.onloadend = function() {
            var a2 = k.result;
            a2 = j ? a2 : a2.replace(/^data:[^;]*;/, "data:attachment/file;"), g2 ? g2.location.href = a2 : location = a2, g2 = null;
          }, k.readAsDataURL(b2);
        } else {
          var l = f.URL || f.webkitURL, m = l.createObjectURL(b2);
          g2 ? g2.location = m : location.href = m, g2 = null, setTimeout(function() {
            l.revokeObjectURL(m);
          }, 4e4);
        }
      });
      f.saveAs = g.saveAs = g, "undefined" != typeof module && (module.exports = g);
    });
  }
});

// resources/js/index.js
var import_dom_to_image = __toESM(require_dom_to_image(), 1);
var import_file_saver = __toESM(require_FileSaver_min(), 1);
function qrPlugin({
  state
}) {
  return {
    state,
    // You can define any other Alpine.js properties here.
    init: function() {
      console.log("sssssss");
    }
    // You can define any other Alpine.js functions here.
  };
}
window.download = function(domain) {
  var node = document.querySelector("#qrcode svg");
  import_dom_to_image.default.toBlob(node).then(function(blob) {
    (0, import_file_saver.saveAs)(blob, domain + ".png");
  }).catch(function(error) {
    console.error("oops, something went wrong!", error);
  });
};
export {
  qrPlugin as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsiLi4vLi4vbm9kZV9tb2R1bGVzL2RvbS10by1pbWFnZS9zcmMvZG9tLXRvLWltYWdlLmpzIiwgIi4uLy4uL25vZGVfbW9kdWxlcy9maWxlLXNhdmVyL3NyYy9GaWxlU2F2ZXIuanMiLCAiLi4vanMvaW5kZXguanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbIihmdW5jdGlvbiAoZ2xvYmFsKSB7XG4gICAgJ3VzZSBzdHJpY3QnO1xuXG4gICAgdmFyIHV0aWwgPSBuZXdVdGlsKCk7XG4gICAgdmFyIGlubGluZXIgPSBuZXdJbmxpbmVyKCk7XG4gICAgdmFyIGZvbnRGYWNlcyA9IG5ld0ZvbnRGYWNlcygpO1xuICAgIHZhciBpbWFnZXMgPSBuZXdJbWFnZXMoKTtcblxuICAgIC8vIERlZmF1bHQgaW1wbCBvcHRpb25zXG4gICAgdmFyIGRlZmF1bHRPcHRpb25zID0ge1xuICAgICAgICAvLyBEZWZhdWx0IGlzIHRvIGZhaWwgb24gZXJyb3IsIG5vIHBsYWNlaG9sZGVyXG4gICAgICAgIGltYWdlUGxhY2Vob2xkZXI6IHVuZGVmaW5lZCxcbiAgICAgICAgLy8gRGVmYXVsdCBjYWNoZSBidXN0IGlzIGZhbHNlLCBpdCB3aWxsIHVzZSB0aGUgY2FjaGVcbiAgICAgICAgY2FjaGVCdXN0OiBmYWxzZVxuICAgIH07XG5cbiAgICB2YXIgZG9tdG9pbWFnZSA9IHtcbiAgICAgICAgdG9Tdmc6IHRvU3ZnLFxuICAgICAgICB0b1BuZzogdG9QbmcsXG4gICAgICAgIHRvSnBlZzogdG9KcGVnLFxuICAgICAgICB0b0Jsb2I6IHRvQmxvYixcbiAgICAgICAgdG9QaXhlbERhdGE6IHRvUGl4ZWxEYXRhLFxuICAgICAgICBpbXBsOiB7XG4gICAgICAgICAgICBmb250RmFjZXM6IGZvbnRGYWNlcyxcbiAgICAgICAgICAgIGltYWdlczogaW1hZ2VzLFxuICAgICAgICAgICAgdXRpbDogdXRpbCxcbiAgICAgICAgICAgIGlubGluZXI6IGlubGluZXIsXG4gICAgICAgICAgICBvcHRpb25zOiB7fVxuICAgICAgICB9XG4gICAgfTtcblxuICAgIGlmICh0eXBlb2YgbW9kdWxlICE9PSAndW5kZWZpbmVkJylcbiAgICAgICAgbW9kdWxlLmV4cG9ydHMgPSBkb210b2ltYWdlO1xuICAgIGVsc2VcbiAgICAgICAgZ2xvYmFsLmRvbXRvaW1hZ2UgPSBkb210b2ltYWdlO1xuXG5cbiAgICAvKipcbiAgICAgKiBAcGFyYW0ge05vZGV9IG5vZGUgLSBUaGUgRE9NIE5vZGUgb2JqZWN0IHRvIHJlbmRlclxuICAgICAqIEBwYXJhbSB7T2JqZWN0fSBvcHRpb25zIC0gUmVuZGVyaW5nIG9wdGlvbnNcbiAgICAgKiBAcGFyYW0ge0Z1bmN0aW9ufSBvcHRpb25zLmZpbHRlciAtIFNob3VsZCByZXR1cm4gdHJ1ZSBpZiBwYXNzZWQgbm9kZSBzaG91bGQgYmUgaW5jbHVkZWQgaW4gdGhlIG91dHB1dFxuICAgICAqICAgICAgICAgIChleGNsdWRpbmcgbm9kZSBtZWFucyBleGNsdWRpbmcgaXQncyBjaGlsZHJlbiBhcyB3ZWxsKS4gTm90IGNhbGxlZCBvbiB0aGUgcm9vdCBub2RlLlxuICAgICAqIEBwYXJhbSB7U3RyaW5nfSBvcHRpb25zLmJnY29sb3IgLSBjb2xvciBmb3IgdGhlIGJhY2tncm91bmQsIGFueSB2YWxpZCBDU1MgY29sb3IgdmFsdWUuXG4gICAgICogQHBhcmFtIHtOdW1iZXJ9IG9wdGlvbnMud2lkdGggLSB3aWR0aCB0byBiZSBhcHBsaWVkIHRvIG5vZGUgYmVmb3JlIHJlbmRlcmluZy5cbiAgICAgKiBAcGFyYW0ge051bWJlcn0gb3B0aW9ucy5oZWlnaHQgLSBoZWlnaHQgdG8gYmUgYXBwbGllZCB0byBub2RlIGJlZm9yZSByZW5kZXJpbmcuXG4gICAgICogQHBhcmFtIHtPYmplY3R9IG9wdGlvbnMuc3R5bGUgLSBhbiBvYmplY3Qgd2hvc2UgcHJvcGVydGllcyB0byBiZSBjb3BpZWQgdG8gbm9kZSdzIHN0eWxlIGJlZm9yZSByZW5kZXJpbmcuXG4gICAgICogQHBhcmFtIHtOdW1iZXJ9IG9wdGlvbnMucXVhbGl0eSAtIGEgTnVtYmVyIGJldHdlZW4gMCBhbmQgMSBpbmRpY2F0aW5nIGltYWdlIHF1YWxpdHkgKGFwcGxpY2FibGUgdG8gSlBFRyBvbmx5KSxcbiAgICAgICAgICAgICAgICBkZWZhdWx0cyB0byAxLjAuXG4gICAgICogQHBhcmFtIHtTdHJpbmd9IG9wdGlvbnMuaW1hZ2VQbGFjZWhvbGRlciAtIGRhdGFVUkwgdG8gdXNlIGFzIGEgcGxhY2Vob2xkZXIgZm9yIGZhaWxlZCBpbWFnZXMsIGRlZmF1bHQgYmVoYXZpb3VyIGlzIHRvIGZhaWwgZmFzdCBvbiBpbWFnZXMgd2UgY2FuJ3QgZmV0Y2hcbiAgICAgKiBAcGFyYW0ge0Jvb2xlYW59IG9wdGlvbnMuY2FjaGVCdXN0IC0gc2V0IHRvIHRydWUgdG8gY2FjaGUgYnVzdCBieSBhcHBlbmRpbmcgdGhlIHRpbWUgdG8gdGhlIHJlcXVlc3QgdXJsXG4gICAgICogQHJldHVybiB7UHJvbWlzZX0gLSBBIHByb21pc2UgdGhhdCBpcyBmdWxmaWxsZWQgd2l0aCBhIFNWRyBpbWFnZSBkYXRhIFVSTFxuICAgICAqICovXG4gICAgZnVuY3Rpb24gdG9Tdmcobm9kZSwgb3B0aW9ucykge1xuICAgICAgICBvcHRpb25zID0gb3B0aW9ucyB8fCB7fTtcbiAgICAgICAgY29weU9wdGlvbnMob3B0aW9ucyk7XG4gICAgICAgIHJldHVybiBQcm9taXNlLnJlc29sdmUobm9kZSlcbiAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChub2RlKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGNsb25lTm9kZShub2RlLCBvcHRpb25zLmZpbHRlciwgdHJ1ZSk7XG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgLnRoZW4oZW1iZWRGb250cylcbiAgICAgICAgICAgIC50aGVuKGlubGluZUltYWdlcylcbiAgICAgICAgICAgIC50aGVuKGFwcGx5T3B0aW9ucylcbiAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChjbG9uZSkge1xuICAgICAgICAgICAgICAgIHJldHVybiBtYWtlU3ZnRGF0YVVyaShjbG9uZSxcbiAgICAgICAgICAgICAgICAgICAgb3B0aW9ucy53aWR0aCB8fCB1dGlsLndpZHRoKG5vZGUpLFxuICAgICAgICAgICAgICAgICAgICBvcHRpb25zLmhlaWdodCB8fCB1dGlsLmhlaWdodChub2RlKVxuICAgICAgICAgICAgICAgICk7XG4gICAgICAgICAgICB9KTtcblxuICAgICAgICBmdW5jdGlvbiBhcHBseU9wdGlvbnMoY2xvbmUpIHtcbiAgICAgICAgICAgIGlmIChvcHRpb25zLmJnY29sb3IpIGNsb25lLnN0eWxlLmJhY2tncm91bmRDb2xvciA9IG9wdGlvbnMuYmdjb2xvcjtcblxuICAgICAgICAgICAgaWYgKG9wdGlvbnMud2lkdGgpIGNsb25lLnN0eWxlLndpZHRoID0gb3B0aW9ucy53aWR0aCArICdweCc7XG4gICAgICAgICAgICBpZiAob3B0aW9ucy5oZWlnaHQpIGNsb25lLnN0eWxlLmhlaWdodCA9IG9wdGlvbnMuaGVpZ2h0ICsgJ3B4JztcblxuICAgICAgICAgICAgaWYgKG9wdGlvbnMuc3R5bGUpXG4gICAgICAgICAgICAgICAgT2JqZWN0LmtleXMob3B0aW9ucy5zdHlsZSkuZm9yRWFjaChmdW5jdGlvbiAocHJvcGVydHkpIHtcbiAgICAgICAgICAgICAgICAgICAgY2xvbmUuc3R5bGVbcHJvcGVydHldID0gb3B0aW9ucy5zdHlsZVtwcm9wZXJ0eV07XG4gICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIHJldHVybiBjbG9uZTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEBwYXJhbSB7Tm9kZX0gbm9kZSAtIFRoZSBET00gTm9kZSBvYmplY3QgdG8gcmVuZGVyXG4gICAgICogQHBhcmFtIHtPYmplY3R9IG9wdGlvbnMgLSBSZW5kZXJpbmcgb3B0aW9ucywgQHNlZSB7QGxpbmsgdG9Tdmd9XG4gICAgICogQHJldHVybiB7UHJvbWlzZX0gLSBBIHByb21pc2UgdGhhdCBpcyBmdWxmaWxsZWQgd2l0aCBhIFVpbnQ4QXJyYXkgY29udGFpbmluZyBSR0JBIHBpeGVsIGRhdGEuXG4gICAgICogKi9cbiAgICBmdW5jdGlvbiB0b1BpeGVsRGF0YShub2RlLCBvcHRpb25zKSB7XG4gICAgICAgIHJldHVybiBkcmF3KG5vZGUsIG9wdGlvbnMgfHwge30pXG4gICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoY2FudmFzKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGNhbnZhcy5nZXRDb250ZXh0KCcyZCcpLmdldEltYWdlRGF0YShcbiAgICAgICAgICAgICAgICAgICAgMCxcbiAgICAgICAgICAgICAgICAgICAgMCxcbiAgICAgICAgICAgICAgICAgICAgdXRpbC53aWR0aChub2RlKSxcbiAgICAgICAgICAgICAgICAgICAgdXRpbC5oZWlnaHQobm9kZSlcbiAgICAgICAgICAgICAgICApLmRhdGE7XG4gICAgICAgICAgICB9KTtcbiAgICB9XG5cbiAgICAvKipcbiAgICAgKiBAcGFyYW0ge05vZGV9IG5vZGUgLSBUaGUgRE9NIE5vZGUgb2JqZWN0IHRvIHJlbmRlclxuICAgICAqIEBwYXJhbSB7T2JqZWN0fSBvcHRpb25zIC0gUmVuZGVyaW5nIG9wdGlvbnMsIEBzZWUge0BsaW5rIHRvU3ZnfVxuICAgICAqIEByZXR1cm4ge1Byb21pc2V9IC0gQSBwcm9taXNlIHRoYXQgaXMgZnVsZmlsbGVkIHdpdGggYSBQTkcgaW1hZ2UgZGF0YSBVUkxcbiAgICAgKiAqL1xuICAgIGZ1bmN0aW9uIHRvUG5nKG5vZGUsIG9wdGlvbnMpIHtcbiAgICAgICAgcmV0dXJuIGRyYXcobm9kZSwgb3B0aW9ucyB8fCB7fSlcbiAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChjYW52YXMpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gY2FudmFzLnRvRGF0YVVSTCgpO1xuICAgICAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQHBhcmFtIHtOb2RlfSBub2RlIC0gVGhlIERPTSBOb2RlIG9iamVjdCB0byByZW5kZXJcbiAgICAgKiBAcGFyYW0ge09iamVjdH0gb3B0aW9ucyAtIFJlbmRlcmluZyBvcHRpb25zLCBAc2VlIHtAbGluayB0b1N2Z31cbiAgICAgKiBAcmV0dXJuIHtQcm9taXNlfSAtIEEgcHJvbWlzZSB0aGF0IGlzIGZ1bGZpbGxlZCB3aXRoIGEgSlBFRyBpbWFnZSBkYXRhIFVSTFxuICAgICAqICovXG4gICAgZnVuY3Rpb24gdG9KcGVnKG5vZGUsIG9wdGlvbnMpIHtcbiAgICAgICAgb3B0aW9ucyA9IG9wdGlvbnMgfHwge307XG4gICAgICAgIHJldHVybiBkcmF3KG5vZGUsIG9wdGlvbnMpXG4gICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoY2FudmFzKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGNhbnZhcy50b0RhdGFVUkwoJ2ltYWdlL2pwZWcnLCBvcHRpb25zLnF1YWxpdHkgfHwgMS4wKTtcbiAgICAgICAgICAgIH0pO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEBwYXJhbSB7Tm9kZX0gbm9kZSAtIFRoZSBET00gTm9kZSBvYmplY3QgdG8gcmVuZGVyXG4gICAgICogQHBhcmFtIHtPYmplY3R9IG9wdGlvbnMgLSBSZW5kZXJpbmcgb3B0aW9ucywgQHNlZSB7QGxpbmsgdG9Tdmd9XG4gICAgICogQHJldHVybiB7UHJvbWlzZX0gLSBBIHByb21pc2UgdGhhdCBpcyBmdWxmaWxsZWQgd2l0aCBhIFBORyBpbWFnZSBibG9iXG4gICAgICogKi9cbiAgICBmdW5jdGlvbiB0b0Jsb2Iobm9kZSwgb3B0aW9ucykge1xuICAgICAgICByZXR1cm4gZHJhdyhub2RlLCBvcHRpb25zIHx8IHt9KVxuICAgICAgICAgICAgLnRoZW4odXRpbC5jYW52YXNUb0Jsb2IpO1xuICAgIH1cblxuICAgIGZ1bmN0aW9uIGNvcHlPcHRpb25zKG9wdGlvbnMpIHtcbiAgICAgICAgLy8gQ29weSBvcHRpb25zIHRvIGltcGwgb3B0aW9ucyBmb3IgdXNlIGluIGltcGxcbiAgICAgICAgaWYodHlwZW9mKG9wdGlvbnMuaW1hZ2VQbGFjZWhvbGRlcikgPT09ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICBkb210b2ltYWdlLmltcGwub3B0aW9ucy5pbWFnZVBsYWNlaG9sZGVyID0gZGVmYXVsdE9wdGlvbnMuaW1hZ2VQbGFjZWhvbGRlcjtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIGRvbXRvaW1hZ2UuaW1wbC5vcHRpb25zLmltYWdlUGxhY2Vob2xkZXIgPSBvcHRpb25zLmltYWdlUGxhY2Vob2xkZXI7XG4gICAgICAgIH1cblxuICAgICAgICBpZih0eXBlb2Yob3B0aW9ucy5jYWNoZUJ1c3QpID09PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgZG9tdG9pbWFnZS5pbXBsLm9wdGlvbnMuY2FjaGVCdXN0ID0gZGVmYXVsdE9wdGlvbnMuY2FjaGVCdXN0O1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgZG9tdG9pbWFnZS5pbXBsLm9wdGlvbnMuY2FjaGVCdXN0ID0gb3B0aW9ucy5jYWNoZUJ1c3Q7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBmdW5jdGlvbiBkcmF3KGRvbU5vZGUsIG9wdGlvbnMpIHtcbiAgICAgICAgcmV0dXJuIHRvU3ZnKGRvbU5vZGUsIG9wdGlvbnMpXG4gICAgICAgICAgICAudGhlbih1dGlsLm1ha2VJbWFnZSlcbiAgICAgICAgICAgIC50aGVuKHV0aWwuZGVsYXkoMTAwKSlcbiAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChpbWFnZSkge1xuICAgICAgICAgICAgICAgIHZhciBjYW52YXMgPSBuZXdDYW52YXMoZG9tTm9kZSk7XG4gICAgICAgICAgICAgICAgY2FudmFzLmdldENvbnRleHQoJzJkJykuZHJhd0ltYWdlKGltYWdlLCAwLCAwKTtcbiAgICAgICAgICAgICAgICByZXR1cm4gY2FudmFzO1xuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgZnVuY3Rpb24gbmV3Q2FudmFzKGRvbU5vZGUpIHtcbiAgICAgICAgICAgIHZhciBjYW52YXMgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdjYW52YXMnKTtcbiAgICAgICAgICAgIGNhbnZhcy53aWR0aCA9IG9wdGlvbnMud2lkdGggfHwgdXRpbC53aWR0aChkb21Ob2RlKTtcbiAgICAgICAgICAgIGNhbnZhcy5oZWlnaHQgPSBvcHRpb25zLmhlaWdodCB8fCB1dGlsLmhlaWdodChkb21Ob2RlKTtcblxuICAgICAgICAgICAgaWYgKG9wdGlvbnMuYmdjb2xvcikge1xuICAgICAgICAgICAgICAgIHZhciBjdHggPSBjYW52YXMuZ2V0Q29udGV4dCgnMmQnKTtcbiAgICAgICAgICAgICAgICBjdHguZmlsbFN0eWxlID0gb3B0aW9ucy5iZ2NvbG9yO1xuICAgICAgICAgICAgICAgIGN0eC5maWxsUmVjdCgwLCAwLCBjYW52YXMud2lkdGgsIGNhbnZhcy5oZWlnaHQpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICByZXR1cm4gY2FudmFzO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgZnVuY3Rpb24gY2xvbmVOb2RlKG5vZGUsIGZpbHRlciwgcm9vdCkge1xuICAgICAgICBpZiAoIXJvb3QgJiYgZmlsdGVyICYmICFmaWx0ZXIobm9kZSkpIHJldHVybiBQcm9taXNlLnJlc29sdmUoKTtcblxuICAgICAgICByZXR1cm4gUHJvbWlzZS5yZXNvbHZlKG5vZGUpXG4gICAgICAgICAgICAudGhlbihtYWtlTm9kZUNvcHkpXG4gICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoY2xvbmUpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gY2xvbmVDaGlsZHJlbihub2RlLCBjbG9uZSwgZmlsdGVyKTtcbiAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoY2xvbmUpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gcHJvY2Vzc0Nsb25lKG5vZGUsIGNsb25lKTtcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgIGZ1bmN0aW9uIG1ha2VOb2RlQ29weShub2RlKSB7XG4gICAgICAgICAgICBpZiAobm9kZSBpbnN0YW5jZW9mIEhUTUxDYW52YXNFbGVtZW50KSByZXR1cm4gdXRpbC5tYWtlSW1hZ2Uobm9kZS50b0RhdGFVUkwoKSk7XG4gICAgICAgICAgICByZXR1cm4gbm9kZS5jbG9uZU5vZGUoZmFsc2UpO1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gY2xvbmVDaGlsZHJlbihvcmlnaW5hbCwgY2xvbmUsIGZpbHRlcikge1xuICAgICAgICAgICAgdmFyIGNoaWxkcmVuID0gb3JpZ2luYWwuY2hpbGROb2RlcztcbiAgICAgICAgICAgIGlmIChjaGlsZHJlbi5sZW5ndGggPT09IDApIHJldHVybiBQcm9taXNlLnJlc29sdmUoY2xvbmUpO1xuXG4gICAgICAgICAgICByZXR1cm4gY2xvbmVDaGlsZHJlbkluT3JkZXIoY2xvbmUsIHV0aWwuYXNBcnJheShjaGlsZHJlbiksIGZpbHRlcilcbiAgICAgICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBjbG9uZTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgZnVuY3Rpb24gY2xvbmVDaGlsZHJlbkluT3JkZXIocGFyZW50LCBjaGlsZHJlbiwgZmlsdGVyKSB7XG4gICAgICAgICAgICAgICAgdmFyIGRvbmUgPSBQcm9taXNlLnJlc29sdmUoKTtcbiAgICAgICAgICAgICAgICBjaGlsZHJlbi5mb3JFYWNoKGZ1bmN0aW9uIChjaGlsZCkge1xuICAgICAgICAgICAgICAgICAgICBkb25lID0gZG9uZVxuICAgICAgICAgICAgICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBjbG9uZU5vZGUoY2hpbGQsIGZpbHRlcik7XG4gICAgICAgICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKGNoaWxkQ2xvbmUpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoY2hpbGRDbG9uZSkgcGFyZW50LmFwcGVuZENoaWxkKGNoaWxkQ2xvbmUpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGRvbmU7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiBwcm9jZXNzQ2xvbmUob3JpZ2luYWwsIGNsb25lKSB7XG4gICAgICAgICAgICBpZiAoIShjbG9uZSBpbnN0YW5jZW9mIEVsZW1lbnQpKSByZXR1cm4gY2xvbmU7XG5cbiAgICAgICAgICAgIHJldHVybiBQcm9taXNlLnJlc29sdmUoKVxuICAgICAgICAgICAgICAgIC50aGVuKGNsb25lU3R5bGUpXG4gICAgICAgICAgICAgICAgLnRoZW4oY2xvbmVQc2V1ZG9FbGVtZW50cylcbiAgICAgICAgICAgICAgICAudGhlbihjb3B5VXNlcklucHV0KVxuICAgICAgICAgICAgICAgIC50aGVuKGZpeFN2ZylcbiAgICAgICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBjbG9uZTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgZnVuY3Rpb24gY2xvbmVTdHlsZSgpIHtcbiAgICAgICAgICAgICAgICBjb3B5U3R5bGUod2luZG93LmdldENvbXB1dGVkU3R5bGUob3JpZ2luYWwpLCBjbG9uZS5zdHlsZSk7XG5cbiAgICAgICAgICAgICAgICBmdW5jdGlvbiBjb3B5U3R5bGUoc291cmNlLCB0YXJnZXQpIHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKHNvdXJjZS5jc3NUZXh0KSB0YXJnZXQuY3NzVGV4dCA9IHNvdXJjZS5jc3NUZXh0O1xuICAgICAgICAgICAgICAgICAgICBlbHNlIGNvcHlQcm9wZXJ0aWVzKHNvdXJjZSwgdGFyZ2V0KTtcblxuICAgICAgICAgICAgICAgICAgICBmdW5jdGlvbiBjb3B5UHJvcGVydGllcyhzb3VyY2UsIHRhcmdldCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgdXRpbC5hc0FycmF5KHNvdXJjZSkuZm9yRWFjaChmdW5jdGlvbiAobmFtZSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRhcmdldC5zZXRQcm9wZXJ0eShcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbmFtZSxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgc291cmNlLmdldFByb3BlcnR5VmFsdWUobmFtZSksXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHNvdXJjZS5nZXRQcm9wZXJ0eVByaW9yaXR5KG5hbWUpXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgKTtcbiAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBmdW5jdGlvbiBjbG9uZVBzZXVkb0VsZW1lbnRzKCkge1xuICAgICAgICAgICAgICAgIFsnOmJlZm9yZScsICc6YWZ0ZXInXS5mb3JFYWNoKGZ1bmN0aW9uIChlbGVtZW50KSB7XG4gICAgICAgICAgICAgICAgICAgIGNsb25lUHNldWRvRWxlbWVudChlbGVtZW50KTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgIGZ1bmN0aW9uIGNsb25lUHNldWRvRWxlbWVudChlbGVtZW50KSB7XG4gICAgICAgICAgICAgICAgICAgIHZhciBzdHlsZSA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKG9yaWdpbmFsLCBlbGVtZW50KTtcbiAgICAgICAgICAgICAgICAgICAgdmFyIGNvbnRlbnQgPSBzdHlsZS5nZXRQcm9wZXJ0eVZhbHVlKCdjb250ZW50Jyk7XG5cbiAgICAgICAgICAgICAgICAgICAgaWYgKGNvbnRlbnQgPT09ICcnIHx8IGNvbnRlbnQgPT09ICdub25lJykgcmV0dXJuO1xuXG4gICAgICAgICAgICAgICAgICAgIHZhciBjbGFzc05hbWUgPSB1dGlsLnVpZCgpO1xuICAgICAgICAgICAgICAgICAgICBjbG9uZS5jbGFzc05hbWUgPSBjbG9uZS5jbGFzc05hbWUgKyAnICcgKyBjbGFzc05hbWU7XG4gICAgICAgICAgICAgICAgICAgIHZhciBzdHlsZUVsZW1lbnQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdzdHlsZScpO1xuICAgICAgICAgICAgICAgICAgICBzdHlsZUVsZW1lbnQuYXBwZW5kQ2hpbGQoZm9ybWF0UHNldWRvRWxlbWVudFN0eWxlKGNsYXNzTmFtZSwgZWxlbWVudCwgc3R5bGUpKTtcbiAgICAgICAgICAgICAgICAgICAgY2xvbmUuYXBwZW5kQ2hpbGQoc3R5bGVFbGVtZW50KTtcblxuICAgICAgICAgICAgICAgICAgICBmdW5jdGlvbiBmb3JtYXRQc2V1ZG9FbGVtZW50U3R5bGUoY2xhc3NOYW1lLCBlbGVtZW50LCBzdHlsZSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgdmFyIHNlbGVjdG9yID0gJy4nICsgY2xhc3NOYW1lICsgJzonICsgZWxlbWVudDtcbiAgICAgICAgICAgICAgICAgICAgICAgIHZhciBjc3NUZXh0ID0gc3R5bGUuY3NzVGV4dCA/IGZvcm1hdENzc1RleHQoc3R5bGUpIDogZm9ybWF0Q3NzUHJvcGVydGllcyhzdHlsZSk7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gZG9jdW1lbnQuY3JlYXRlVGV4dE5vZGUoc2VsZWN0b3IgKyAneycgKyBjc3NUZXh0ICsgJ30nKTtcblxuICAgICAgICAgICAgICAgICAgICAgICAgZnVuY3Rpb24gZm9ybWF0Q3NzVGV4dChzdHlsZSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHZhciBjb250ZW50ID0gc3R5bGUuZ2V0UHJvcGVydHlWYWx1ZSgnY29udGVudCcpO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBzdHlsZS5jc3NUZXh0ICsgJyBjb250ZW50OiAnICsgY29udGVudCArICc7JztcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICAgICAgICAgZnVuY3Rpb24gZm9ybWF0Q3NzUHJvcGVydGllcyhzdHlsZSkge1xuXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHV0aWwuYXNBcnJheShzdHlsZSlcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgLm1hcChmb3JtYXRQcm9wZXJ0eSlcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgLmpvaW4oJzsgJykgKyAnOyc7XG5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBmdW5jdGlvbiBmb3JtYXRQcm9wZXJ0eShuYW1lKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBuYW1lICsgJzogJyArXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBzdHlsZS5nZXRQcm9wZXJ0eVZhbHVlKG5hbWUpICtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIChzdHlsZS5nZXRQcm9wZXJ0eVByaW9yaXR5KG5hbWUpID8gJyAhaW1wb3J0YW50JyA6ICcnKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGZ1bmN0aW9uIGNvcHlVc2VySW5wdXQoKSB7XG4gICAgICAgICAgICAgICAgaWYgKG9yaWdpbmFsIGluc3RhbmNlb2YgSFRNTFRleHRBcmVhRWxlbWVudCkgY2xvbmUuaW5uZXJIVE1MID0gb3JpZ2luYWwudmFsdWU7XG4gICAgICAgICAgICAgICAgaWYgKG9yaWdpbmFsIGluc3RhbmNlb2YgSFRNTElucHV0RWxlbWVudCkgY2xvbmUuc2V0QXR0cmlidXRlKFwidmFsdWVcIiwgb3JpZ2luYWwudmFsdWUpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBmdW5jdGlvbiBmaXhTdmcoKSB7XG4gICAgICAgICAgICAgICAgaWYgKCEoY2xvbmUgaW5zdGFuY2VvZiBTVkdFbGVtZW50KSkgcmV0dXJuO1xuICAgICAgICAgICAgICAgIGNsb25lLnNldEF0dHJpYnV0ZSgneG1sbnMnLCAnaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnKTtcblxuICAgICAgICAgICAgICAgIGlmICghKGNsb25lIGluc3RhbmNlb2YgU1ZHUmVjdEVsZW1lbnQpKSByZXR1cm47XG4gICAgICAgICAgICAgICAgWyd3aWR0aCcsICdoZWlnaHQnXS5mb3JFYWNoKGZ1bmN0aW9uIChhdHRyaWJ1dGUpIHtcbiAgICAgICAgICAgICAgICAgICAgdmFyIHZhbHVlID0gY2xvbmUuZ2V0QXR0cmlidXRlKGF0dHJpYnV0ZSk7XG4gICAgICAgICAgICAgICAgICAgIGlmICghdmFsdWUpIHJldHVybjtcblxuICAgICAgICAgICAgICAgICAgICBjbG9uZS5zdHlsZS5zZXRQcm9wZXJ0eShhdHRyaWJ1dGUsIHZhbHVlKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH1cblxuICAgIGZ1bmN0aW9uIGVtYmVkRm9udHMobm9kZSkge1xuICAgICAgICByZXR1cm4gZm9udEZhY2VzLnJlc29sdmVBbGwoKVxuICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKGNzc1RleHQpIHtcbiAgICAgICAgICAgICAgICB2YXIgc3R5bGVOb2RlID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnc3R5bGUnKTtcbiAgICAgICAgICAgICAgICBub2RlLmFwcGVuZENoaWxkKHN0eWxlTm9kZSk7XG4gICAgICAgICAgICAgICAgc3R5bGVOb2RlLmFwcGVuZENoaWxkKGRvY3VtZW50LmNyZWF0ZVRleHROb2RlKGNzc1RleHQpKTtcbiAgICAgICAgICAgICAgICByZXR1cm4gbm9kZTtcbiAgICAgICAgICAgIH0pO1xuICAgIH1cblxuICAgIGZ1bmN0aW9uIGlubGluZUltYWdlcyhub2RlKSB7XG4gICAgICAgIHJldHVybiBpbWFnZXMuaW5saW5lQWxsKG5vZGUpXG4gICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIG5vZGU7XG4gICAgICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBmdW5jdGlvbiBtYWtlU3ZnRGF0YVVyaShub2RlLCB3aWR0aCwgaGVpZ2h0KSB7XG4gICAgICAgIHJldHVybiBQcm9taXNlLnJlc29sdmUobm9kZSlcbiAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChub2RlKSB7XG4gICAgICAgICAgICAgICAgbm9kZS5zZXRBdHRyaWJ1dGUoJ3htbG5zJywgJ2h0dHA6Ly93d3cudzMub3JnLzE5OTkveGh0bWwnKTtcbiAgICAgICAgICAgICAgICByZXR1cm4gbmV3IFhNTFNlcmlhbGl6ZXIoKS5zZXJpYWxpemVUb1N0cmluZyhub2RlKTtcbiAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAudGhlbih1dGlsLmVzY2FwZVhodG1sKVxuICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKHhodG1sKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuICc8Zm9yZWlnbk9iamVjdCB4PVwiMFwiIHk9XCIwXCIgd2lkdGg9XCIxMDAlXCIgaGVpZ2h0PVwiMTAwJVwiPicgKyB4aHRtbCArICc8L2ZvcmVpZ25PYmplY3Q+JztcbiAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoZm9yZWlnbk9iamVjdCkge1xuICAgICAgICAgICAgICAgIHJldHVybiAnPHN2ZyB4bWxucz1cImh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnXCIgd2lkdGg9XCInICsgd2lkdGggKyAnXCIgaGVpZ2h0PVwiJyArIGhlaWdodCArICdcIj4nICtcbiAgICAgICAgICAgICAgICAgICAgZm9yZWlnbk9iamVjdCArICc8L3N2Zz4nO1xuICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChzdmcpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gJ2RhdGE6aW1hZ2Uvc3ZnK3htbDtjaGFyc2V0PXV0Zi04LCcgKyBzdmc7XG4gICAgICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBmdW5jdGlvbiBuZXdVdGlsKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgZXNjYXBlOiBlc2NhcGUsXG4gICAgICAgICAgICBwYXJzZUV4dGVuc2lvbjogcGFyc2VFeHRlbnNpb24sXG4gICAgICAgICAgICBtaW1lVHlwZTogbWltZVR5cGUsXG4gICAgICAgICAgICBkYXRhQXNVcmw6IGRhdGFBc1VybCxcbiAgICAgICAgICAgIGlzRGF0YVVybDogaXNEYXRhVXJsLFxuICAgICAgICAgICAgY2FudmFzVG9CbG9iOiBjYW52YXNUb0Jsb2IsXG4gICAgICAgICAgICByZXNvbHZlVXJsOiByZXNvbHZlVXJsLFxuICAgICAgICAgICAgZ2V0QW5kRW5jb2RlOiBnZXRBbmRFbmNvZGUsXG4gICAgICAgICAgICB1aWQ6IHVpZCgpLFxuICAgICAgICAgICAgZGVsYXk6IGRlbGF5LFxuICAgICAgICAgICAgYXNBcnJheTogYXNBcnJheSxcbiAgICAgICAgICAgIGVzY2FwZVhodG1sOiBlc2NhcGVYaHRtbCxcbiAgICAgICAgICAgIG1ha2VJbWFnZTogbWFrZUltYWdlLFxuICAgICAgICAgICAgd2lkdGg6IHdpZHRoLFxuICAgICAgICAgICAgaGVpZ2h0OiBoZWlnaHRcbiAgICAgICAgfTtcblxuICAgICAgICBmdW5jdGlvbiBtaW1lcygpIHtcbiAgICAgICAgICAgIC8qXG4gICAgICAgICAgICAgKiBPbmx5IFdPRkYgYW5kIEVPVCBtaW1lIHR5cGVzIGZvciBmb250cyBhcmUgJ3JlYWwnXG4gICAgICAgICAgICAgKiBzZWUgaHR0cDovL3d3dy5pYW5hLm9yZy9hc3NpZ25tZW50cy9tZWRpYS10eXBlcy9tZWRpYS10eXBlcy54aHRtbFxuICAgICAgICAgICAgICovXG4gICAgICAgICAgICB2YXIgV09GRiA9ICdhcHBsaWNhdGlvbi9mb250LXdvZmYnO1xuICAgICAgICAgICAgdmFyIEpQRUcgPSAnaW1hZ2UvanBlZyc7XG5cbiAgICAgICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICAgICAgJ3dvZmYnOiBXT0ZGLFxuICAgICAgICAgICAgICAgICd3b2ZmMic6IFdPRkYsXG4gICAgICAgICAgICAgICAgJ3R0Zic6ICdhcHBsaWNhdGlvbi9mb250LXRydWV0eXBlJyxcbiAgICAgICAgICAgICAgICAnZW90JzogJ2FwcGxpY2F0aW9uL3ZuZC5tcy1mb250b2JqZWN0JyxcbiAgICAgICAgICAgICAgICAncG5nJzogJ2ltYWdlL3BuZycsXG4gICAgICAgICAgICAgICAgJ2pwZyc6IEpQRUcsXG4gICAgICAgICAgICAgICAgJ2pwZWcnOiBKUEVHLFxuICAgICAgICAgICAgICAgICdnaWYnOiAnaW1hZ2UvZ2lmJyxcbiAgICAgICAgICAgICAgICAndGlmZic6ICdpbWFnZS90aWZmJyxcbiAgICAgICAgICAgICAgICAnc3ZnJzogJ2ltYWdlL3N2Zyt4bWwnXG4gICAgICAgICAgICB9O1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gcGFyc2VFeHRlbnNpb24odXJsKSB7XG4gICAgICAgICAgICB2YXIgbWF0Y2ggPSAvXFwuKFteXFwuXFwvXSo/KSQvZy5leGVjKHVybCk7XG4gICAgICAgICAgICBpZiAobWF0Y2gpIHJldHVybiBtYXRjaFsxXTtcbiAgICAgICAgICAgIGVsc2UgcmV0dXJuICcnO1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gbWltZVR5cGUodXJsKSB7XG4gICAgICAgICAgICB2YXIgZXh0ZW5zaW9uID0gcGFyc2VFeHRlbnNpb24odXJsKS50b0xvd2VyQ2FzZSgpO1xuICAgICAgICAgICAgcmV0dXJuIG1pbWVzKClbZXh0ZW5zaW9uXSB8fCAnJztcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIGlzRGF0YVVybCh1cmwpIHtcbiAgICAgICAgICAgIHJldHVybiB1cmwuc2VhcmNoKC9eKGRhdGE6KS8pICE9PSAtMTtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIHRvQmxvYihjYW52YXMpIHtcbiAgICAgICAgICAgIHJldHVybiBuZXcgUHJvbWlzZShmdW5jdGlvbiAocmVzb2x2ZSkge1xuICAgICAgICAgICAgICAgIHZhciBiaW5hcnlTdHJpbmcgPSB3aW5kb3cuYXRvYihjYW52YXMudG9EYXRhVVJMKCkuc3BsaXQoJywnKVsxXSk7XG4gICAgICAgICAgICAgICAgdmFyIGxlbmd0aCA9IGJpbmFyeVN0cmluZy5sZW5ndGg7XG4gICAgICAgICAgICAgICAgdmFyIGJpbmFyeUFycmF5ID0gbmV3IFVpbnQ4QXJyYXkobGVuZ3RoKTtcblxuICAgICAgICAgICAgICAgIGZvciAodmFyIGkgPSAwOyBpIDwgbGVuZ3RoOyBpKyspXG4gICAgICAgICAgICAgICAgICAgIGJpbmFyeUFycmF5W2ldID0gYmluYXJ5U3RyaW5nLmNoYXJDb2RlQXQoaSk7XG5cbiAgICAgICAgICAgICAgICByZXNvbHZlKG5ldyBCbG9iKFtiaW5hcnlBcnJheV0sIHtcbiAgICAgICAgICAgICAgICAgICAgdHlwZTogJ2ltYWdlL3BuZydcbiAgICAgICAgICAgICAgICB9KSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIGNhbnZhc1RvQmxvYihjYW52YXMpIHtcbiAgICAgICAgICAgIGlmIChjYW52YXMudG9CbG9iKVxuICAgICAgICAgICAgICAgIHJldHVybiBuZXcgUHJvbWlzZShmdW5jdGlvbiAocmVzb2x2ZSkge1xuICAgICAgICAgICAgICAgICAgICBjYW52YXMudG9CbG9iKHJlc29sdmUpO1xuICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICByZXR1cm4gdG9CbG9iKGNhbnZhcyk7XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiByZXNvbHZlVXJsKHVybCwgYmFzZVVybCkge1xuICAgICAgICAgICAgdmFyIGRvYyA9IGRvY3VtZW50LmltcGxlbWVudGF0aW9uLmNyZWF0ZUhUTUxEb2N1bWVudCgpO1xuICAgICAgICAgICAgdmFyIGJhc2UgPSBkb2MuY3JlYXRlRWxlbWVudCgnYmFzZScpO1xuICAgICAgICAgICAgZG9jLmhlYWQuYXBwZW5kQ2hpbGQoYmFzZSk7XG4gICAgICAgICAgICB2YXIgYSA9IGRvYy5jcmVhdGVFbGVtZW50KCdhJyk7XG4gICAgICAgICAgICBkb2MuYm9keS5hcHBlbmRDaGlsZChhKTtcbiAgICAgICAgICAgIGJhc2UuaHJlZiA9IGJhc2VVcmw7XG4gICAgICAgICAgICBhLmhyZWYgPSB1cmw7XG4gICAgICAgICAgICByZXR1cm4gYS5ocmVmO1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gdWlkKCkge1xuICAgICAgICAgICAgdmFyIGluZGV4ID0gMDtcblxuICAgICAgICAgICAgcmV0dXJuIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gJ3UnICsgZm91clJhbmRvbUNoYXJzKCkgKyBpbmRleCsrO1xuXG4gICAgICAgICAgICAgICAgZnVuY3Rpb24gZm91clJhbmRvbUNoYXJzKCkge1xuICAgICAgICAgICAgICAgICAgICAvKiBzZWUgaHR0cDovL3N0YWNrb3ZlcmZsb3cuY29tL2EvNjI0ODcyMi8yNTE5MzczICovXG4gICAgICAgICAgICAgICAgICAgIHJldHVybiAoJzAwMDAnICsgKE1hdGgucmFuZG9tKCkgKiBNYXRoLnBvdygzNiwgNCkgPDwgMCkudG9TdHJpbmcoMzYpKS5zbGljZSgtNCk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfTtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIG1ha2VJbWFnZSh1cmkpIHtcbiAgICAgICAgICAgIHJldHVybiBuZXcgUHJvbWlzZShmdW5jdGlvbiAocmVzb2x2ZSwgcmVqZWN0KSB7XG4gICAgICAgICAgICAgICAgdmFyIGltYWdlID0gbmV3IEltYWdlKCk7XG4gICAgICAgICAgICAgICAgaW1hZ2Uub25sb2FkID0gZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICByZXNvbHZlKGltYWdlKTtcbiAgICAgICAgICAgICAgICB9O1xuICAgICAgICAgICAgICAgIGltYWdlLm9uZXJyb3IgPSByZWplY3Q7XG4gICAgICAgICAgICAgICAgaW1hZ2Uuc3JjID0gdXJpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiBnZXRBbmRFbmNvZGUodXJsKSB7XG4gICAgICAgICAgICB2YXIgVElNRU9VVCA9IDMwMDAwO1xuICAgICAgICAgICAgaWYoZG9tdG9pbWFnZS5pbXBsLm9wdGlvbnMuY2FjaGVCdXN0KSB7XG4gICAgICAgICAgICAgICAgLy8gQ2FjaGUgYnlwYXNzIHNvIHdlIGRvbnQgaGF2ZSBDT1JTIGlzc3VlcyB3aXRoIGNhY2hlZCBpbWFnZXNcbiAgICAgICAgICAgICAgICAvLyBTb3VyY2U6IGh0dHBzOi8vZGV2ZWxvcGVyLm1vemlsbGEub3JnL2VuL2RvY3MvV2ViL0FQSS9YTUxIdHRwUmVxdWVzdC9Vc2luZ19YTUxIdHRwUmVxdWVzdCNCeXBhc3NpbmdfdGhlX2NhY2hlXG4gICAgICAgICAgICAgICAgdXJsICs9ICgoL1xcPy8pLnRlc3QodXJsKSA/IFwiJlwiIDogXCI/XCIpICsgKG5ldyBEYXRlKCkpLmdldFRpbWUoKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgcmV0dXJuIG5ldyBQcm9taXNlKGZ1bmN0aW9uIChyZXNvbHZlKSB7XG4gICAgICAgICAgICAgICAgdmFyIHJlcXVlc3QgPSBuZXcgWE1MSHR0cFJlcXVlc3QoKTtcblxuICAgICAgICAgICAgICAgIHJlcXVlc3Qub25yZWFkeXN0YXRlY2hhbmdlID0gZG9uZTtcbiAgICAgICAgICAgICAgICByZXF1ZXN0Lm9udGltZW91dCA9IHRpbWVvdXQ7XG4gICAgICAgICAgICAgICAgcmVxdWVzdC5yZXNwb25zZVR5cGUgPSAnYmxvYic7XG4gICAgICAgICAgICAgICAgcmVxdWVzdC50aW1lb3V0ID0gVElNRU9VVDtcbiAgICAgICAgICAgICAgICByZXF1ZXN0Lm9wZW4oJ0dFVCcsIHVybCwgdHJ1ZSk7XG4gICAgICAgICAgICAgICAgcmVxdWVzdC5zZW5kKCk7XG5cbiAgICAgICAgICAgICAgICB2YXIgcGxhY2Vob2xkZXI7XG4gICAgICAgICAgICAgICAgaWYoZG9tdG9pbWFnZS5pbXBsLm9wdGlvbnMuaW1hZ2VQbGFjZWhvbGRlcikge1xuICAgICAgICAgICAgICAgICAgICB2YXIgc3BsaXQgPSBkb210b2ltYWdlLmltcGwub3B0aW9ucy5pbWFnZVBsYWNlaG9sZGVyLnNwbGl0KC8sLyk7XG4gICAgICAgICAgICAgICAgICAgIGlmKHNwbGl0ICYmIHNwbGl0WzFdKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBwbGFjZWhvbGRlciA9IHNwbGl0WzFdO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgZnVuY3Rpb24gZG9uZSgpIHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKHJlcXVlc3QucmVhZHlTdGF0ZSAhPT0gNCkgcmV0dXJuO1xuXG4gICAgICAgICAgICAgICAgICAgIGlmIChyZXF1ZXN0LnN0YXR1cyAhPT0gMjAwKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBpZihwbGFjZWhvbGRlcikge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJlc29sdmUocGxhY2Vob2xkZXIpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBmYWlsKCdjYW5ub3QgZmV0Y2ggcmVzb3VyY2U6ICcgKyB1cmwgKyAnLCBzdGF0dXM6ICcgKyByZXF1ZXN0LnN0YXR1cyk7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgICAgIHZhciBlbmNvZGVyID0gbmV3IEZpbGVSZWFkZXIoKTtcbiAgICAgICAgICAgICAgICAgICAgZW5jb2Rlci5vbmxvYWRlbmQgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICB2YXIgY29udGVudCA9IGVuY29kZXIucmVzdWx0LnNwbGl0KC8sLylbMV07XG4gICAgICAgICAgICAgICAgICAgICAgICByZXNvbHZlKGNvbnRlbnQpO1xuICAgICAgICAgICAgICAgICAgICB9O1xuICAgICAgICAgICAgICAgICAgICBlbmNvZGVyLnJlYWRBc0RhdGFVUkwocmVxdWVzdC5yZXNwb25zZSk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgZnVuY3Rpb24gdGltZW91dCgpIHtcbiAgICAgICAgICAgICAgICAgICAgaWYocGxhY2Vob2xkZXIpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJlc29sdmUocGxhY2Vob2xkZXIpO1xuICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAgICAgZmFpbCgndGltZW91dCBvZiAnICsgVElNRU9VVCArICdtcyBvY2N1cmVkIHdoaWxlIGZldGNoaW5nIHJlc291cmNlOiAnICsgdXJsKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIGZ1bmN0aW9uIGZhaWwobWVzc2FnZSkge1xuICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmVycm9yKG1lc3NhZ2UpO1xuICAgICAgICAgICAgICAgICAgICByZXNvbHZlKCcnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIGRhdGFBc1VybChjb250ZW50LCB0eXBlKSB7XG4gICAgICAgICAgICByZXR1cm4gJ2RhdGE6JyArIHR5cGUgKyAnO2Jhc2U2NCwnICsgY29udGVudDtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIGVzY2FwZShzdHJpbmcpIHtcbiAgICAgICAgICAgIHJldHVybiBzdHJpbmcucmVwbGFjZSgvKFsuKis/XiR7fSgpfFxcW1xcXVxcL1xcXFxdKS9nLCAnXFxcXCQxJyk7XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiBkZWxheShtcykge1xuICAgICAgICAgICAgcmV0dXJuIGZ1bmN0aW9uIChhcmcpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gbmV3IFByb21pc2UoZnVuY3Rpb24gKHJlc29sdmUpIHtcbiAgICAgICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXNvbHZlKGFyZyk7XG4gICAgICAgICAgICAgICAgICAgIH0sIG1zKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH07XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiBhc0FycmF5KGFycmF5TGlrZSkge1xuICAgICAgICAgICAgdmFyIGFycmF5ID0gW107XG4gICAgICAgICAgICB2YXIgbGVuZ3RoID0gYXJyYXlMaWtlLmxlbmd0aDtcbiAgICAgICAgICAgIGZvciAodmFyIGkgPSAwOyBpIDwgbGVuZ3RoOyBpKyspIGFycmF5LnB1c2goYXJyYXlMaWtlW2ldKTtcbiAgICAgICAgICAgIHJldHVybiBhcnJheTtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIGVzY2FwZVhodG1sKHN0cmluZykge1xuICAgICAgICAgICAgcmV0dXJuIHN0cmluZy5yZXBsYWNlKC8jL2csICclMjMnKS5yZXBsYWNlKC9cXG4vZywgJyUwQScpO1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gd2lkdGgobm9kZSkge1xuICAgICAgICAgICAgdmFyIGxlZnRCb3JkZXIgPSBweChub2RlLCAnYm9yZGVyLWxlZnQtd2lkdGgnKTtcbiAgICAgICAgICAgIHZhciByaWdodEJvcmRlciA9IHB4KG5vZGUsICdib3JkZXItcmlnaHQtd2lkdGgnKTtcbiAgICAgICAgICAgIHJldHVybiBub2RlLnNjcm9sbFdpZHRoICsgbGVmdEJvcmRlciArIHJpZ2h0Qm9yZGVyO1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gaGVpZ2h0KG5vZGUpIHtcbiAgICAgICAgICAgIHZhciB0b3BCb3JkZXIgPSBweChub2RlLCAnYm9yZGVyLXRvcC13aWR0aCcpO1xuICAgICAgICAgICAgdmFyIGJvdHRvbUJvcmRlciA9IHB4KG5vZGUsICdib3JkZXItYm90dG9tLXdpZHRoJyk7XG4gICAgICAgICAgICByZXR1cm4gbm9kZS5zY3JvbGxIZWlnaHQgKyB0b3BCb3JkZXIgKyBib3R0b21Cb3JkZXI7XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiBweChub2RlLCBzdHlsZVByb3BlcnR5KSB7XG4gICAgICAgICAgICB2YXIgdmFsdWUgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShub2RlKS5nZXRQcm9wZXJ0eVZhbHVlKHN0eWxlUHJvcGVydHkpO1xuICAgICAgICAgICAgcmV0dXJuIHBhcnNlRmxvYXQodmFsdWUucmVwbGFjZSgncHgnLCAnJykpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgZnVuY3Rpb24gbmV3SW5saW5lcigpIHtcbiAgICAgICAgdmFyIFVSTF9SRUdFWCA9IC91cmxcXChbJ1wiXT8oW14nXCJdKz8pWydcIl0/XFwpL2c7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGlubGluZUFsbDogaW5saW5lQWxsLFxuICAgICAgICAgICAgc2hvdWxkUHJvY2Vzczogc2hvdWxkUHJvY2VzcyxcbiAgICAgICAgICAgIGltcGw6IHtcbiAgICAgICAgICAgICAgICByZWFkVXJsczogcmVhZFVybHMsXG4gICAgICAgICAgICAgICAgaW5saW5lOiBpbmxpbmVcbiAgICAgICAgICAgIH1cbiAgICAgICAgfTtcblxuICAgICAgICBmdW5jdGlvbiBzaG91bGRQcm9jZXNzKHN0cmluZykge1xuICAgICAgICAgICAgcmV0dXJuIHN0cmluZy5zZWFyY2goVVJMX1JFR0VYKSAhPT0gLTE7XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiByZWFkVXJscyhzdHJpbmcpIHtcbiAgICAgICAgICAgIHZhciByZXN1bHQgPSBbXTtcbiAgICAgICAgICAgIHZhciBtYXRjaDtcbiAgICAgICAgICAgIHdoaWxlICgobWF0Y2ggPSBVUkxfUkVHRVguZXhlYyhzdHJpbmcpKSAhPT0gbnVsbCkge1xuICAgICAgICAgICAgICAgIHJlc3VsdC5wdXNoKG1hdGNoWzFdKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIHJldHVybiByZXN1bHQuZmlsdGVyKGZ1bmN0aW9uICh1cmwpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gIXV0aWwuaXNEYXRhVXJsKHVybCk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIGlubGluZShzdHJpbmcsIHVybCwgYmFzZVVybCwgZ2V0KSB7XG4gICAgICAgICAgICByZXR1cm4gUHJvbWlzZS5yZXNvbHZlKHVybClcbiAgICAgICAgICAgICAgICAudGhlbihmdW5jdGlvbiAodXJsKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBiYXNlVXJsID8gdXRpbC5yZXNvbHZlVXJsKHVybCwgYmFzZVVybCkgOiB1cmw7XG4gICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICAudGhlbihnZXQgfHwgdXRpbC5nZXRBbmRFbmNvZGUpXG4gICAgICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHV0aWwuZGF0YUFzVXJsKGRhdGEsIHV0aWwubWltZVR5cGUodXJsKSk7XG4gICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoZGF0YVVybCkge1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gc3RyaW5nLnJlcGxhY2UodXJsQXNSZWdleCh1cmwpLCAnJDEnICsgZGF0YVVybCArICckMycpO1xuICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICBmdW5jdGlvbiB1cmxBc1JlZ2V4KHVybCkge1xuICAgICAgICAgICAgICAgIHJldHVybiBuZXcgUmVnRXhwKCcodXJsXFxcXChbXFwnXCJdPykoJyArIHV0aWwuZXNjYXBlKHVybCkgKyAnKShbXFwnXCJdP1xcXFwpKScsICdnJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiBpbmxpbmVBbGwoc3RyaW5nLCBiYXNlVXJsLCBnZXQpIHtcbiAgICAgICAgICAgIGlmIChub3RoaW5nVG9JbmxpbmUoKSkgcmV0dXJuIFByb21pc2UucmVzb2x2ZShzdHJpbmcpO1xuXG4gICAgICAgICAgICByZXR1cm4gUHJvbWlzZS5yZXNvbHZlKHN0cmluZylcbiAgICAgICAgICAgICAgICAudGhlbihyZWFkVXJscylcbiAgICAgICAgICAgICAgICAudGhlbihmdW5jdGlvbiAodXJscykge1xuICAgICAgICAgICAgICAgICAgICB2YXIgZG9uZSA9IFByb21pc2UucmVzb2x2ZShzdHJpbmcpO1xuICAgICAgICAgICAgICAgICAgICB1cmxzLmZvckVhY2goZnVuY3Rpb24gKHVybCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgZG9uZSA9IGRvbmUudGhlbihmdW5jdGlvbiAoc3RyaW5nKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGlubGluZShzdHJpbmcsIHVybCwgYmFzZVVybCwgZ2V0KTtcbiAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGRvbmU7XG4gICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIGZ1bmN0aW9uIG5vdGhpbmdUb0lubGluZSgpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gIXNob3VsZFByb2Nlc3Moc3RyaW5nKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH1cblxuICAgIGZ1bmN0aW9uIG5ld0ZvbnRGYWNlcygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHJlc29sdmVBbGw6IHJlc29sdmVBbGwsXG4gICAgICAgICAgICBpbXBsOiB7XG4gICAgICAgICAgICAgICAgcmVhZEFsbDogcmVhZEFsbFxuICAgICAgICAgICAgfVxuICAgICAgICB9O1xuXG4gICAgICAgIGZ1bmN0aW9uIHJlc29sdmVBbGwoKSB7XG4gICAgICAgICAgICByZXR1cm4gcmVhZEFsbChkb2N1bWVudClcbiAgICAgICAgICAgICAgICAudGhlbihmdW5jdGlvbiAod2ViRm9udHMpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIFByb21pc2UuYWxsKFxuICAgICAgICAgICAgICAgICAgICAgICAgd2ViRm9udHMubWFwKGZ1bmN0aW9uICh3ZWJGb250KSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHdlYkZvbnQucmVzb2x2ZSgpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICAgICAgKTtcbiAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChjc3NTdHJpbmdzKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBjc3NTdHJpbmdzLmpvaW4oJ1xcbicpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gcmVhZEFsbCgpIHtcbiAgICAgICAgICAgIHJldHVybiBQcm9taXNlLnJlc29sdmUodXRpbC5hc0FycmF5KGRvY3VtZW50LnN0eWxlU2hlZXRzKSlcbiAgICAgICAgICAgICAgICAudGhlbihnZXRDc3NSdWxlcylcbiAgICAgICAgICAgICAgICAudGhlbihzZWxlY3RXZWJGb250UnVsZXMpXG4gICAgICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKHJ1bGVzKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBydWxlcy5tYXAobmV3V2ViRm9udCk7XG4gICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIGZ1bmN0aW9uIHNlbGVjdFdlYkZvbnRSdWxlcyhjc3NSdWxlcykge1xuICAgICAgICAgICAgICAgIHJldHVybiBjc3NSdWxlc1xuICAgICAgICAgICAgICAgICAgICAuZmlsdGVyKGZ1bmN0aW9uIChydWxlKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gcnVsZS50eXBlID09PSBDU1NSdWxlLkZPTlRfRkFDRV9SVUxFO1xuICAgICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgICAgICAuZmlsdGVyKGZ1bmN0aW9uIChydWxlKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gaW5saW5lci5zaG91bGRQcm9jZXNzKHJ1bGUuc3R5bGUuZ2V0UHJvcGVydHlWYWx1ZSgnc3JjJykpO1xuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgZnVuY3Rpb24gZ2V0Q3NzUnVsZXMoc3R5bGVTaGVldHMpIHtcbiAgICAgICAgICAgICAgICB2YXIgY3NzUnVsZXMgPSBbXTtcbiAgICAgICAgICAgICAgICBzdHlsZVNoZWV0cy5mb3JFYWNoKGZ1bmN0aW9uIChzaGVldCkge1xuICAgICAgICAgICAgICAgICAgICB0cnkge1xuICAgICAgICAgICAgICAgICAgICAgICAgdXRpbC5hc0FycmF5KHNoZWV0LmNzc1J1bGVzIHx8IFtdKS5mb3JFYWNoKGNzc1J1bGVzLnB1c2guYmluZChjc3NSdWxlcykpO1xuICAgICAgICAgICAgICAgICAgICB9IGNhdGNoIChlKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygnRXJyb3Igd2hpbGUgcmVhZGluZyBDU1MgcnVsZXMgZnJvbSAnICsgc2hlZXQuaHJlZiwgZS50b1N0cmluZygpKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIHJldHVybiBjc3NSdWxlcztcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgZnVuY3Rpb24gbmV3V2ViRm9udCh3ZWJGb250UnVsZSkge1xuICAgICAgICAgICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICAgICAgICAgIHJlc29sdmU6IGZ1bmN0aW9uIHJlc29sdmUoKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICB2YXIgYmFzZVVybCA9ICh3ZWJGb250UnVsZS5wYXJlbnRTdHlsZVNoZWV0IHx8IHt9KS5ocmVmO1xuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGlubGluZXIuaW5saW5lQWxsKHdlYkZvbnRSdWxlLmNzc1RleHQsIGJhc2VVcmwpO1xuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICBzcmM6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiB3ZWJGb250UnVsZS5zdHlsZS5nZXRQcm9wZXJ0eVZhbHVlKCdzcmMnKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH07XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBmdW5jdGlvbiBuZXdJbWFnZXMoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBpbmxpbmVBbGw6IGlubGluZUFsbCxcbiAgICAgICAgICAgIGltcGw6IHtcbiAgICAgICAgICAgICAgICBuZXdJbWFnZTogbmV3SW1hZ2VcbiAgICAgICAgICAgIH1cbiAgICAgICAgfTtcblxuICAgICAgICBmdW5jdGlvbiBuZXdJbWFnZShlbGVtZW50KSB7XG4gICAgICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgICAgIGlubGluZTogaW5saW5lXG4gICAgICAgICAgICB9O1xuXG4gICAgICAgICAgICBmdW5jdGlvbiBpbmxpbmUoZ2V0KSB7XG4gICAgICAgICAgICAgICAgaWYgKHV0aWwuaXNEYXRhVXJsKGVsZW1lbnQuc3JjKSkgcmV0dXJuIFByb21pc2UucmVzb2x2ZSgpO1xuXG4gICAgICAgICAgICAgICAgcmV0dXJuIFByb21pc2UucmVzb2x2ZShlbGVtZW50LnNyYylcbiAgICAgICAgICAgICAgICAgICAgLnRoZW4oZ2V0IHx8IHV0aWwuZ2V0QW5kRW5jb2RlKVxuICAgICAgICAgICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHV0aWwuZGF0YUFzVXJsKGRhdGEsIHV0aWwubWltZVR5cGUoZWxlbWVudC5zcmMpKTtcbiAgICAgICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKGRhdGFVcmwpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBuZXcgUHJvbWlzZShmdW5jdGlvbiAocmVzb2x2ZSwgcmVqZWN0KSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgZWxlbWVudC5vbmxvYWQgPSByZXNvbHZlO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVsZW1lbnQub25lcnJvciA9IHJlamVjdDtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBlbGVtZW50LnNyYyA9IGRhdGFVcmw7XG4gICAgICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiBpbmxpbmVBbGwobm9kZSkge1xuICAgICAgICAgICAgaWYgKCEobm9kZSBpbnN0YW5jZW9mIEVsZW1lbnQpKSByZXR1cm4gUHJvbWlzZS5yZXNvbHZlKG5vZGUpO1xuXG4gICAgICAgICAgICByZXR1cm4gaW5saW5lQmFja2dyb3VuZChub2RlKVxuICAgICAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKG5vZGUgaW5zdGFuY2VvZiBIVE1MSW1hZ2VFbGVtZW50KVxuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIG5ld0ltYWdlKG5vZGUpLmlubGluZSgpO1xuICAgICAgICAgICAgICAgICAgICBlbHNlXG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gUHJvbWlzZS5hbGwoXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgdXRpbC5hc0FycmF5KG5vZGUuY2hpbGROb2RlcykubWFwKGZ1bmN0aW9uIChjaGlsZCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gaW5saW5lQWxsKGNoaWxkKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgICAgICAgICAgKTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgZnVuY3Rpb24gaW5saW5lQmFja2dyb3VuZChub2RlKSB7XG4gICAgICAgICAgICAgICAgdmFyIGJhY2tncm91bmQgPSBub2RlLnN0eWxlLmdldFByb3BlcnR5VmFsdWUoJ2JhY2tncm91bmQnKTtcblxuICAgICAgICAgICAgICAgIGlmICghYmFja2dyb3VuZCkgcmV0dXJuIFByb21pc2UucmVzb2x2ZShub2RlKTtcblxuICAgICAgICAgICAgICAgIHJldHVybiBpbmxpbmVyLmlubGluZUFsbChiYWNrZ3JvdW5kKVxuICAgICAgICAgICAgICAgICAgICAudGhlbihmdW5jdGlvbiAoaW5saW5lZCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgbm9kZS5zdHlsZS5zZXRQcm9wZXJ0eShcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAnYmFja2dyb3VuZCcsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaW5saW5lZCxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBub2RlLnN0eWxlLmdldFByb3BlcnR5UHJpb3JpdHkoJ2JhY2tncm91bmQnKVxuICAgICAgICAgICAgICAgICAgICAgICAgKTtcbiAgICAgICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICAgICAgLnRoZW4oZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIG5vZGU7XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgfVxufSkodGhpcyk7XG4iLCAiLypcbiogRmlsZVNhdmVyLmpzXG4qIEEgc2F2ZUFzKCkgRmlsZVNhdmVyIGltcGxlbWVudGF0aW9uLlxuKlxuKiBCeSBFbGkgR3JleSwgaHR0cDovL2VsaWdyZXkuY29tXG4qXG4qIExpY2Vuc2UgOiBodHRwczovL2dpdGh1Yi5jb20vZWxpZ3JleS9GaWxlU2F2ZXIuanMvYmxvYi9tYXN0ZXIvTElDRU5TRS5tZCAoTUlUKVxuKiBzb3VyY2UgIDogaHR0cDovL3B1cmwuZWxpZ3JleS5jb20vZ2l0aHViL0ZpbGVTYXZlci5qc1xuKi9cblxuLy8gVGhlIG9uZSBhbmQgb25seSB3YXkgb2YgZ2V0dGluZyBnbG9iYWwgc2NvcGUgaW4gYWxsIGVudmlyb25tZW50c1xuLy8gaHR0cHM6Ly9zdGFja292ZXJmbG93LmNvbS9xLzMyNzcxODIvMTAwODk5OVxudmFyIF9nbG9iYWwgPSB0eXBlb2Ygd2luZG93ID09PSAnb2JqZWN0JyAmJiB3aW5kb3cud2luZG93ID09PSB3aW5kb3dcbiAgPyB3aW5kb3cgOiB0eXBlb2Ygc2VsZiA9PT0gJ29iamVjdCcgJiYgc2VsZi5zZWxmID09PSBzZWxmXG4gID8gc2VsZiA6IHR5cGVvZiBnbG9iYWwgPT09ICdvYmplY3QnICYmIGdsb2JhbC5nbG9iYWwgPT09IGdsb2JhbFxuICA/IGdsb2JhbFxuICA6IHRoaXNcblxuZnVuY3Rpb24gYm9tIChibG9iLCBvcHRzKSB7XG4gIGlmICh0eXBlb2Ygb3B0cyA9PT0gJ3VuZGVmaW5lZCcpIG9wdHMgPSB7IGF1dG9Cb206IGZhbHNlIH1cbiAgZWxzZSBpZiAodHlwZW9mIG9wdHMgIT09ICdvYmplY3QnKSB7XG4gICAgY29uc29sZS53YXJuKCdEZXByZWNhdGVkOiBFeHBlY3RlZCB0aGlyZCBhcmd1bWVudCB0byBiZSBhIG9iamVjdCcpXG4gICAgb3B0cyA9IHsgYXV0b0JvbTogIW9wdHMgfVxuICB9XG5cbiAgLy8gcHJlcGVuZCBCT00gZm9yIFVURi04IFhNTCBhbmQgdGV4dC8qIHR5cGVzIChpbmNsdWRpbmcgSFRNTClcbiAgLy8gbm90ZTogeW91ciBicm93c2VyIHdpbGwgYXV0b21hdGljYWxseSBjb252ZXJ0IFVURi0xNiBVK0ZFRkYgdG8gRUYgQkIgQkZcbiAgaWYgKG9wdHMuYXV0b0JvbSAmJiAvXlxccyooPzp0ZXh0XFwvXFxTKnxhcHBsaWNhdGlvblxcL3htbHxcXFMqXFwvXFxTKlxcK3htbClcXHMqOy4qY2hhcnNldFxccyo9XFxzKnV0Zi04L2kudGVzdChibG9iLnR5cGUpKSB7XG4gICAgcmV0dXJuIG5ldyBCbG9iKFtTdHJpbmcuZnJvbUNoYXJDb2RlKDB4RkVGRiksIGJsb2JdLCB7IHR5cGU6IGJsb2IudHlwZSB9KVxuICB9XG4gIHJldHVybiBibG9iXG59XG5cbmZ1bmN0aW9uIGRvd25sb2FkICh1cmwsIG5hbWUsIG9wdHMpIHtcbiAgdmFyIHhociA9IG5ldyBYTUxIdHRwUmVxdWVzdCgpXG4gIHhoci5vcGVuKCdHRVQnLCB1cmwpXG4gIHhoci5yZXNwb25zZVR5cGUgPSAnYmxvYidcbiAgeGhyLm9ubG9hZCA9IGZ1bmN0aW9uICgpIHtcbiAgICBzYXZlQXMoeGhyLnJlc3BvbnNlLCBuYW1lLCBvcHRzKVxuICB9XG4gIHhoci5vbmVycm9yID0gZnVuY3Rpb24gKCkge1xuICAgIGNvbnNvbGUuZXJyb3IoJ2NvdWxkIG5vdCBkb3dubG9hZCBmaWxlJylcbiAgfVxuICB4aHIuc2VuZCgpXG59XG5cbmZ1bmN0aW9uIGNvcnNFbmFibGVkICh1cmwpIHtcbiAgdmFyIHhociA9IG5ldyBYTUxIdHRwUmVxdWVzdCgpXG4gIC8vIHVzZSBzeW5jIHRvIGF2b2lkIHBvcHVwIGJsb2NrZXJcbiAgeGhyLm9wZW4oJ0hFQUQnLCB1cmwsIGZhbHNlKVxuICB0cnkge1xuICAgIHhoci5zZW5kKClcbiAgfSBjYXRjaCAoZSkge31cbiAgcmV0dXJuIHhoci5zdGF0dXMgPj0gMjAwICYmIHhoci5zdGF0dXMgPD0gMjk5XG59XG5cbi8vIGBhLmNsaWNrKClgIGRvZXNuJ3Qgd29yayBmb3IgYWxsIGJyb3dzZXJzICgjNDY1KVxuZnVuY3Rpb24gY2xpY2sgKG5vZGUpIHtcbiAgdHJ5IHtcbiAgICBub2RlLmRpc3BhdGNoRXZlbnQobmV3IE1vdXNlRXZlbnQoJ2NsaWNrJykpXG4gIH0gY2F0Y2ggKGUpIHtcbiAgICB2YXIgZXZ0ID0gZG9jdW1lbnQuY3JlYXRlRXZlbnQoJ01vdXNlRXZlbnRzJylcbiAgICBldnQuaW5pdE1vdXNlRXZlbnQoJ2NsaWNrJywgdHJ1ZSwgdHJ1ZSwgd2luZG93LCAwLCAwLCAwLCA4MCxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgMjAsIGZhbHNlLCBmYWxzZSwgZmFsc2UsIGZhbHNlLCAwLCBudWxsKVxuICAgIG5vZGUuZGlzcGF0Y2hFdmVudChldnQpXG4gIH1cbn1cblxuLy8gRGV0ZWN0IFdlYlZpZXcgaW5zaWRlIGEgbmF0aXZlIG1hY09TIGFwcCBieSBydWxpbmcgb3V0IGFsbCBicm93c2Vyc1xuLy8gV2UganVzdCBuZWVkIHRvIGNoZWNrIGZvciAnU2FmYXJpJyBiZWNhdXNlIGFsbCBvdGhlciBicm93c2VycyAoYmVzaWRlcyBGaXJlZm94KSBpbmNsdWRlIHRoYXQgdG9vXG4vLyBodHRwczovL3d3dy53aGF0aXNteWJyb3dzZXIuY29tL2d1aWRlcy90aGUtbGF0ZXN0LXVzZXItYWdlbnQvbWFjb3NcbnZhciBpc01hY09TV2ViVmlldyA9IF9nbG9iYWwubmF2aWdhdG9yICYmIC9NYWNpbnRvc2gvLnRlc3QobmF2aWdhdG9yLnVzZXJBZ2VudCkgJiYgL0FwcGxlV2ViS2l0Ly50ZXN0KG5hdmlnYXRvci51c2VyQWdlbnQpICYmICEvU2FmYXJpLy50ZXN0KG5hdmlnYXRvci51c2VyQWdlbnQpXG5cbnZhciBzYXZlQXMgPSBfZ2xvYmFsLnNhdmVBcyB8fCAoXG4gIC8vIHByb2JhYmx5IGluIHNvbWUgd2ViIHdvcmtlclxuICAodHlwZW9mIHdpbmRvdyAhPT0gJ29iamVjdCcgfHwgd2luZG93ICE9PSBfZ2xvYmFsKVxuICAgID8gZnVuY3Rpb24gc2F2ZUFzICgpIHsgLyogbm9vcCAqLyB9XG5cbiAgLy8gVXNlIGRvd25sb2FkIGF0dHJpYnV0ZSBmaXJzdCBpZiBwb3NzaWJsZSAoIzE5MyBMdW1pYSBtb2JpbGUpIHVubGVzcyB0aGlzIGlzIGEgbWFjT1MgV2ViVmlld1xuICA6ICgnZG93bmxvYWQnIGluIEhUTUxBbmNob3JFbGVtZW50LnByb3RvdHlwZSAmJiAhaXNNYWNPU1dlYlZpZXcpXG4gID8gZnVuY3Rpb24gc2F2ZUFzIChibG9iLCBuYW1lLCBvcHRzKSB7XG4gICAgdmFyIFVSTCA9IF9nbG9iYWwuVVJMIHx8IF9nbG9iYWwud2Via2l0VVJMXG4gICAgdmFyIGEgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdhJylcbiAgICBuYW1lID0gbmFtZSB8fCBibG9iLm5hbWUgfHwgJ2Rvd25sb2FkJ1xuXG4gICAgYS5kb3dubG9hZCA9IG5hbWVcbiAgICBhLnJlbCA9ICdub29wZW5lcicgLy8gdGFibmFiYmluZ1xuXG4gICAgLy8gVE9ETzogZGV0ZWN0IGNocm9tZSBleHRlbnNpb25zICYgcGFja2FnZWQgYXBwc1xuICAgIC8vIGEudGFyZ2V0ID0gJ19ibGFuaydcblxuICAgIGlmICh0eXBlb2YgYmxvYiA9PT0gJ3N0cmluZycpIHtcbiAgICAgIC8vIFN1cHBvcnQgcmVndWxhciBsaW5rc1xuICAgICAgYS5ocmVmID0gYmxvYlxuICAgICAgaWYgKGEub3JpZ2luICE9PSBsb2NhdGlvbi5vcmlnaW4pIHtcbiAgICAgICAgY29yc0VuYWJsZWQoYS5ocmVmKVxuICAgICAgICAgID8gZG93bmxvYWQoYmxvYiwgbmFtZSwgb3B0cylcbiAgICAgICAgICA6IGNsaWNrKGEsIGEudGFyZ2V0ID0gJ19ibGFuaycpXG4gICAgICB9IGVsc2Uge1xuICAgICAgICBjbGljayhhKVxuICAgICAgfVxuICAgIH0gZWxzZSB7XG4gICAgICAvLyBTdXBwb3J0IGJsb2JzXG4gICAgICBhLmhyZWYgPSBVUkwuY3JlYXRlT2JqZWN0VVJMKGJsb2IpXG4gICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHsgVVJMLnJldm9rZU9iamVjdFVSTChhLmhyZWYpIH0sIDRFNCkgLy8gNDBzXG4gICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHsgY2xpY2soYSkgfSwgMClcbiAgICB9XG4gIH1cblxuICAvLyBVc2UgbXNTYXZlT3JPcGVuQmxvYiBhcyBhIHNlY29uZCBhcHByb2FjaFxuICA6ICdtc1NhdmVPck9wZW5CbG9iJyBpbiBuYXZpZ2F0b3JcbiAgPyBmdW5jdGlvbiBzYXZlQXMgKGJsb2IsIG5hbWUsIG9wdHMpIHtcbiAgICBuYW1lID0gbmFtZSB8fCBibG9iLm5hbWUgfHwgJ2Rvd25sb2FkJ1xuXG4gICAgaWYgKHR5cGVvZiBibG9iID09PSAnc3RyaW5nJykge1xuICAgICAgaWYgKGNvcnNFbmFibGVkKGJsb2IpKSB7XG4gICAgICAgIGRvd25sb2FkKGJsb2IsIG5hbWUsIG9wdHMpXG4gICAgICB9IGVsc2Uge1xuICAgICAgICB2YXIgYSA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2EnKVxuICAgICAgICBhLmhyZWYgPSBibG9iXG4gICAgICAgIGEudGFyZ2V0ID0gJ19ibGFuaydcbiAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7IGNsaWNrKGEpIH0pXG4gICAgICB9XG4gICAgfSBlbHNlIHtcbiAgICAgIG5hdmlnYXRvci5tc1NhdmVPck9wZW5CbG9iKGJvbShibG9iLCBvcHRzKSwgbmFtZSlcbiAgICB9XG4gIH1cblxuICAvLyBGYWxsYmFjayB0byB1c2luZyBGaWxlUmVhZGVyIGFuZCBhIHBvcHVwXG4gIDogZnVuY3Rpb24gc2F2ZUFzIChibG9iLCBuYW1lLCBvcHRzLCBwb3B1cCkge1xuICAgIC8vIE9wZW4gYSBwb3B1cCBpbW1lZGlhdGVseSBkbyBnbyBhcm91bmQgcG9wdXAgYmxvY2tlclxuICAgIC8vIE1vc3RseSBvbmx5IGF2YWlsYWJsZSBvbiB1c2VyIGludGVyYWN0aW9uIGFuZCB0aGUgZmlsZVJlYWRlciBpcyBhc3luYyBzby4uLlxuICAgIHBvcHVwID0gcG9wdXAgfHwgb3BlbignJywgJ19ibGFuaycpXG4gICAgaWYgKHBvcHVwKSB7XG4gICAgICBwb3B1cC5kb2N1bWVudC50aXRsZSA9XG4gICAgICBwb3B1cC5kb2N1bWVudC5ib2R5LmlubmVyVGV4dCA9ICdkb3dubG9hZGluZy4uLidcbiAgICB9XG5cbiAgICBpZiAodHlwZW9mIGJsb2IgPT09ICdzdHJpbmcnKSByZXR1cm4gZG93bmxvYWQoYmxvYiwgbmFtZSwgb3B0cylcblxuICAgIHZhciBmb3JjZSA9IGJsb2IudHlwZSA9PT0gJ2FwcGxpY2F0aW9uL29jdGV0LXN0cmVhbSdcbiAgICB2YXIgaXNTYWZhcmkgPSAvY29uc3RydWN0b3IvaS50ZXN0KF9nbG9iYWwuSFRNTEVsZW1lbnQpIHx8IF9nbG9iYWwuc2FmYXJpXG4gICAgdmFyIGlzQ2hyb21lSU9TID0gL0NyaU9TXFwvW1xcZF0rLy50ZXN0KG5hdmlnYXRvci51c2VyQWdlbnQpXG5cbiAgICBpZiAoKGlzQ2hyb21lSU9TIHx8IChmb3JjZSAmJiBpc1NhZmFyaSkgfHwgaXNNYWNPU1dlYlZpZXcpICYmIHR5cGVvZiBGaWxlUmVhZGVyICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgLy8gU2FmYXJpIGRvZXNuJ3QgYWxsb3cgZG93bmxvYWRpbmcgb2YgYmxvYiBVUkxzXG4gICAgICB2YXIgcmVhZGVyID0gbmV3IEZpbGVSZWFkZXIoKVxuICAgICAgcmVhZGVyLm9ubG9hZGVuZCA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgdmFyIHVybCA9IHJlYWRlci5yZXN1bHRcbiAgICAgICAgdXJsID0gaXNDaHJvbWVJT1MgPyB1cmwgOiB1cmwucmVwbGFjZSgvXmRhdGE6W147XSo7LywgJ2RhdGE6YXR0YWNobWVudC9maWxlOycpXG4gICAgICAgIGlmIChwb3B1cCkgcG9wdXAubG9jYXRpb24uaHJlZiA9IHVybFxuICAgICAgICBlbHNlIGxvY2F0aW9uID0gdXJsXG4gICAgICAgIHBvcHVwID0gbnVsbCAvLyByZXZlcnNlLXRhYm5hYmJpbmcgIzQ2MFxuICAgICAgfVxuICAgICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwoYmxvYilcbiAgICB9IGVsc2Uge1xuICAgICAgdmFyIFVSTCA9IF9nbG9iYWwuVVJMIHx8IF9nbG9iYWwud2Via2l0VVJMXG4gICAgICB2YXIgdXJsID0gVVJMLmNyZWF0ZU9iamVjdFVSTChibG9iKVxuICAgICAgaWYgKHBvcHVwKSBwb3B1cC5sb2NhdGlvbiA9IHVybFxuICAgICAgZWxzZSBsb2NhdGlvbi5ocmVmID0gdXJsXG4gICAgICBwb3B1cCA9IG51bGwgLy8gcmV2ZXJzZS10YWJuYWJiaW5nICM0NjBcbiAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkgeyBVUkwucmV2b2tlT2JqZWN0VVJMKHVybCkgfSwgNEU0KSAvLyA0MHNcbiAgICB9XG4gIH1cbilcblxuX2dsb2JhbC5zYXZlQXMgPSBzYXZlQXMuc2F2ZUFzID0gc2F2ZUFzXG5cbmlmICh0eXBlb2YgbW9kdWxlICE9PSAndW5kZWZpbmVkJykge1xuICBtb2R1bGUuZXhwb3J0cyA9IHNhdmVBcztcbn1cbiIsICJpbXBvcnQgZG9tdG9pbWFnZSBmcm9tICdkb20tdG8taW1hZ2UnXG5pbXBvcnQgeyBzYXZlQXMgfSBmcm9tICdmaWxlLXNhdmVyJ1xuXG5leHBvcnQgZGVmYXVsdCBmdW5jdGlvbiBxclBsdWdpbihcbiAge1xuICAgIHN0YXRlLFxuICB9XG4gICkge1xuICByZXR1cm4ge1xuICAgIHN0YXRlLFxuXG4gICAgLy8gWW91IGNhbiBkZWZpbmUgYW55IG90aGVyIEFscGluZS5qcyBwcm9wZXJ0aWVzIGhlcmUuXG5cbiAgICBpbml0OiBmdW5jdGlvbigpIHtcbiAgICAgIGNvbnNvbGUubG9nKCdzc3Nzc3NzJyk7XG4gICAgfSxcblxuICAgIC8vIFlvdSBjYW4gZGVmaW5lIGFueSBvdGhlciBBbHBpbmUuanMgZnVuY3Rpb25zIGhlcmUuXG4gIH1cbn07XG5cbndpbmRvdy5kb3dubG9hZCA9IGZ1bmN0aW9uKGRvbWFpbikge1xuICB2YXIgbm9kZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNxcmNvZGUgc3ZnJylcbiAgZG9tdG9pbWFnZS50b0Jsb2Iobm9kZSlcbiAgICAudGhlbihmdW5jdGlvbihibG9iKSB7XG4gICAgICBzYXZlQXMoYmxvYiwgZG9tYWluICsgJy5wbmcnKVxuICAgIH0pXG4gICAgLmNhdGNoKGZ1bmN0aW9uKGVycm9yKSB7XG4gICAgICBjb25zb2xlLmVycm9yKCdvb3BzLCBzb21ldGhpbmcgd2VudCB3cm9uZyEnLCBlcnJvcilcbiAgICB9KVxufVxuIl0sCiAgIm1hcHBpbmdzIjogIjs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBQUE7QUFBQTtBQUFBLEtBQUMsU0FBVUEsU0FBUTtBQUNmO0FBRUEsVUFBSSxPQUFPLFFBQVE7QUFDbkIsVUFBSSxVQUFVLFdBQVc7QUFDekIsVUFBSSxZQUFZLGFBQWE7QUFDN0IsVUFBSSxTQUFTLFVBQVU7QUFHdkIsVUFBSSxpQkFBaUI7QUFBQTtBQUFBLFFBRWpCLGtCQUFrQjtBQUFBO0FBQUEsUUFFbEIsV0FBVztBQUFBLE1BQ2Y7QUFFQSxVQUFJQyxjQUFhO0FBQUEsUUFDYjtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBLE1BQU07QUFBQSxVQUNGO0FBQUEsVUFDQTtBQUFBLFVBQ0E7QUFBQSxVQUNBO0FBQUEsVUFDQSxTQUFTLENBQUM7QUFBQSxRQUNkO0FBQUEsTUFDSjtBQUVBLFVBQUksT0FBTyxXQUFX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WUFBTyxZQUFZLFdBQVk7QUFDN0IsZ0JBQUlELEtBQU0sRUFBTztBQUNqQixZQUFBQSxLQUFNLElBQWNBLEtBQU1BLEdBQUksUUFBUSxnQkFBZ0IsdUJBQTVCLEdBQ3RCSSxLQUFPQSxHQUFNLFNBQVMsT0FBT0osS0FDNUIsV0FBV0EsSUFDaEJJLEtBQVE7VUFDVCxHQUNELEVBQU8sY0FBY0gsRUFBckI7UUFDRCxPQUFNO0FBQUEsY0FDRCxJQUFNLEVBQVEsT0FBTyxFQUFRLFdBQzdCLElBQU0sRUFBSSxnQkFBZ0JBLEVBQXBCO0FBQ04sVUFBQUcsS0FBT0EsR0FBTSxXQUFXLElBQ3ZCLFNBQVMsT0FBTyxHQUNyQkEsS0FBUSxNQUNSLFdBQVcsV0FBWTtBQUFFLGNBQUksZ0JBQWdCLENBQXBCO1VBQTBCLEdBQUUsR0FBM0M7UUFDWDtNQUNGO0FBR0gsUUFBUSxTQUFTLEVBQU8sU0FBUyxHQUVYLGVBQWxCLE9BQU8sV0FDVCxPQUFPLFVBQVU7SUFBQSxDQUFBOzs7OztBQ3pLbkIsMEJBQXVCO0FBQ3ZCLHdCQUF1QjtBQUVSLFNBQVIsU0FDTDtBQUFBLEVBQ0U7QUFDRixHQUNFO0FBQ0YsU0FBTztBQUFBLElBQ0w7QUFBQTtBQUFBLElBSUEsTUFBTSxXQUFXO0FBQ2YsY0FBUSxJQUFJLFNBQVM7QUFBQSxJQUN2QjtBQUFBO0FBQUEsRUFHRjtBQUNGO0FBRUEsT0FBTyxXQUFXLFNBQVMsUUFBUTtBQUNqQyxNQUFJLE9BQU8sU0FBUyxjQUFjLGFBQWE7QUFDL0Msc0JBQUFHLFFBQVcsT0FBTyxJQUFJLEVBQ25CLEtBQUssU0FBUyxNQUFNO0FBQ25CLGtDQUFPLE1BQU0sU0FBUyxNQUFNO0FBQUEsRUFDOUIsQ0FBQyxFQUNBLE1BQU0sU0FBUyxPQUFPO0FBQ3JCLFlBQVEsTUFBTSwrQkFBK0IsS0FBSztBQUFBLEVBQ3BELENBQUM7QUFDTDsiLAogICJuYW1lcyI6IFsiZ2xvYmFsIiwgImRvbXRvaW1hZ2UiLCAibm9kZSIsICJkb21Ob2RlIiwgImZpbHRlciIsICJjaGlsZHJlbiIsICJzb3VyY2UiLCAidGFyZ2V0IiwgImNsYXNzTmFtZSIsICJlbGVtZW50IiwgInN0eWxlIiwgImNvbnRlbnQiLCAidG9CbG9iIiwgInVybCIsICJzdHJpbmciLCAiYSIsICJiIiwgImMiLCAiZCIsICJnIiwgImYiLCAiZSIsICJkb210b2ltYWdlIl0KfQo=
