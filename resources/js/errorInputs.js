
/**
 * 
 * @param {HTMLElement} input 
 * @param {boolean} timeout 
 * @param {number} timer 
 * @param {boolean} focus 
 */
window.errorInput = function (input, timeout = false, timer = false, focus = false){
    if (input) {
        input.classList.add('border-red-500', 'focus:ring-red-500');
        if (timeout && timer){            
            setTimeout(() => {
                input.classList.remove('border-red-500', 'focus:ring-red-500');
            }, timer);            
        }
        if (focus){
            input.focus();
        }
    }
}