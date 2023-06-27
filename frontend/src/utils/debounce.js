export function debounce (fn, delay) {
    let timeoutID  = null;
    let thisLink = this
    return function (thisLink, ...args) {
        clearTimeout(timeoutID);
        timeoutID = setTimeout(() => {
            fn.apply(this, args);
        }, delay)
    }
}