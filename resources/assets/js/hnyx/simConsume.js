import {getKeyCodes, getEvent, getKey, getCodes} from '../toodo/_keycodes';
import {parseArgs} from '../toodo/_url';

require('../toodo/init');


const keyCode = getKeyCodes();
const preCodes = getCodes();


const setFocus = function (t, select) {
    if (t) t.className = select ? 'sim-btn-focus' : 'sim-btn';
};
const setSelected = function (idx) {
    btns.forEach(function (t, index) {
        setFocus(t, idx == index);
    });
};

const handleKey = function (e) {
    e = getEvent(e);
    const curKey = getKey(e);
    if (preCodes.indexOf(curKey) != -1) {
        try {
            e.preventDefault();
        } catch (e) {
        }
    }
    switch (curKey) {
        case keyCode.up:
            if (current > 0) {
                current--;
                setSelected(current);
            }
            break;
        case keyCode.down:
            if (current < 2) {
                current++;
                setSelected(current);
            }
            break;
        case keyCode.ok:
            submit();
            break;
    }
};

const submit = function () {
    let bizIn = {
        errorCode: 1,
    };
    switch (current) {
        case 0:
            bizIn.errorCode = 1;
            break;
        case 1:
            bizIn.errorCode = -1;
            break;
        case 2:
            bizIn.errorCode = 204;
            break;
    }
    window.location.href = backUrl + '?' + parseArgs(bizIn);
};

let current = 0;
let btns = [];

let backUrl = decodeURIComponent(window.backUrl);
let tradeNo = window.tradeNo;

window.onload = function () {
    for (let i = 0; i < 3; ++i) {
        const node = document.getElementById('sim-btn' + i);
        btns.push(node);
    }

    setSelected(current);
    document.onkeydown = handleKey;
};