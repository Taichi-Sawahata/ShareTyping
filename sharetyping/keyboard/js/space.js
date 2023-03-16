'use strict';
document.addEventListener('keypress', keypress_ivent);

function keypress_ivent(e) {
    if (e.code === 'Space') {
        window.location.href = 'startKey.php';
        console.log('aaa');
    }
    return false;
}