/*------------------------------------------------------------------

  Utility

-------------------------------------------------------------------*/
const $ = window.jQuery;
const tween = window.TweenMax;
const isIOs =
    /iPad|iPhone|iPod/.test(window.navigator.userAgent) && !window.MSStream;
const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/g.test(
    window.navigator.userAgent || window.navigator.vendor || window.opera
);
const isFireFox = typeof InstallTrigger !== "undefined";
const isTouch =
    "ontouchstart" in window ||
    (window.DocumentTouch && document instanceof window.DocumentTouch);

// add 'is-mobile' or 'is-desktop' classname to html tag
$("html").addClass(isMobile ? "is-mobile" : "is-desktop");

/**
 * window size
 */
const $wnd = $(window);
const $doc = $(document);
const $body = $("body");
let wndW = 0;
let wndH = 0;
let docH = 0;
function getWndSize() {
    wndW = $wnd.outerWidth();
    wndH = $wnd.height();
    docH = $doc.height();
}
getWndSize();
$wnd.on("resize load orientationchange rui-ajax-loaded", getWndSize);

/**
 * Debounce resize
 */
const resizeArr = [];
let resizeTimeout;
function debounceResized() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        if (resizeArr.length) {
            for (let k = 0; k < resizeArr.length; k++) {
                resizeArr[k]();
            }
        }
    }, 50);
}
$wnd.on("ready load resize orientationchange", debounceResized);
debounceResized();

function debounceResize(func) {
    if (typeof func === "function") {
        resizeArr.push(func);
    } else {
        window.dispatchEvent(new window.Event("resize"));
    }
}

/**
 * Throttle scroll
 * thanks: https://jsfiddle.net/mariusc23/s6mLJ/31/
 */
const hideOnScrollList = [];
let didScroll;
let lastST = 0;

$wnd.on("scroll load resize orientationchange", () => {
    if (hideOnScrollList.length) {
        didScroll = true;
    }
});

function hasScrolled() {
    const ST = $wnd.scrollTop();

    let type = ""; // [up, down, end, start]

    if (ST > lastST) {
        type = "down";
    } else if (ST < lastST) {
        type = "up";
    } else {
        type = "none";
    }

    if (ST === 0) {
        type = "start";
    } else if (ST >= docH - wndH) {
        type = "end";
    }

    hideOnScrollList.forEach(item => {
        if (typeof item === "function") {
            item(type, ST, lastST, $wnd);
        }
    });

    lastST = ST;
}

setInterval(() => {
    if (didScroll) {
        didScroll = false;
        window.requestAnimationFrame(hasScrolled);
    }
}, 250);

function throttleScroll(callback) {
    hideOnScrollList.push(callback);
}

/**
 * Body Overflow
 * Thanks https://jsfiddle.net/mariusc23/s6mLJ/31/
 * Usage:
 *    // enable
 *    bodyOverflow(1);
 *
 *    // disable
 *    bodyOverflow(0);
 */
let bodyOverflowEnabled;
let isBodyOverflowing;
let scrollbarWidth;
let originalBodyPadding;
function isBodyOverflowed() {
    return bodyOverflowEnabled;
}
function bodyGetScrollbarWidth() {
    // thx d.walsh
    const scrollDiv = document.createElement("div");
    scrollDiv.className = "rui-body-scrollbar-measure";
    $body[0].appendChild(scrollDiv);
    const result = scrollDiv.offsetWidth - scrollDiv.clientWidth;
    $body[0].removeChild(scrollDiv);
    return result;
}
function bodyCheckScrollbar() {
    let fullWindowWidth = window.innerWidth;
    if (!fullWindowWidth) {
        // workaround for missing window.innerWidth in IE8
        const documentElementRect = document.documentElement.getBoundingClientRect();
        fullWindowWidth =
            documentElementRect.right - Math.abs(documentElementRect.left);
    }
    isBodyOverflowing = $body[0].clientWidth < fullWindowWidth;
    scrollbarWidth = bodyGetScrollbarWidth();
}
function bodySetScrollbar() {
    if (typeof originalBodyPadding === "undefined") {
        originalBodyPadding = $body.css("padding-right") || "";
    }

    if (isBodyOverflowing) {
        $body
            .add($(".rui-navbar-mobile"))
            .css("paddingRight", `${scrollbarWidth}px`);
    }
}
function bodyResetScrollbar() {
    $body.css("paddingRight", originalBodyPadding);
    $(".rui-navbar-mobile").css("paddingRight", "");
}
function bodyOverflow(enable) {
    if (enable && !bodyOverflowEnabled) {
        bodyOverflowEnabled = 1;
        bodyCheckScrollbar();

        if (scrollbarWidth) {
            bodySetScrollbar();
        }

        $body.css("overflow", "hidden");
    } else if (!enable && bodyOverflowEnabled) {
        bodyOverflowEnabled = 0;
        $body.css("overflow", "");

        if (scrollbarWidth) {
            bodyResetScrollbar();
        }
    }
}

/**
 * In Viewport checker
 * return visible percent from 0 to 1
 *
 * @param {Object} $item jQuery element.
 * @param {boolean} returnRect check if return rect.
 *
 * @return {boolean|Array} is in viewport.
 */
function isInViewport($item, returnRect) {
    const rect = $item[0].getBoundingClientRect();
    let result = 1;

    if (rect.right <= 0 || rect.left >= wndW) {
        result = 0;
    } else if (rect.bottom < 0 && rect.top <= wndH) {
        result = 0;
    } else {
        const beforeTopEnd = Math.max(0, rect.height + rect.top);
        const beforeBottomEnd = Math.max(
            0,
            rect.height - (rect.top + rect.height - wndH)
        );
        const afterTop = Math.max(0, -rect.top);
        const beforeBottom = Math.max(0, rect.top + rect.height - wndH);
        if (rect.height < wndH) {
            result = 1 - (afterTop || beforeBottom) / rect.height;
        } else if (beforeTopEnd <= wndH) {
            result = beforeTopEnd / wndH;
        } else if (beforeBottomEnd <= wndH) {
            result = beforeBottomEnd / wndH;
        }
        result = result < 0 ? 0 : result;
    }
    if (returnRect) {
        return [result, rect];
    }
    return result;
}

export {
    $,
    tween,
    isIOs,
    isMobile,
    isFireFox,
    isTouch,
    $wnd,
    $doc,
    $body,
    wndW,
    wndH,
    docH,
    debounceResize,
    throttleScroll,
    bodyOverflow,
    isBodyOverflowed,
    isInViewport
};
