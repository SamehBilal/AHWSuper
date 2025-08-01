<style>
    .page {
        position: relative;
        /* position: absolute; */
        /* left: 50%;
        top: 50%; */
        /* margin: -270px 0 0 -480px;
        width: 960px; */
        height: 100vh;
        overflow: hidden;
    }

    .wall-bg {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }

    .wall-bg ul {
        width: 100%;
        height: 100%;
    }

    .wall-bg ul:after {
        content: "";
        display: table;
        clear: both;
    }

    .wall-bg li {
        float: left;
        width: 32px;
        height: 100%;
        background: #120a20;
    }

    .wall-bg li:nth-child(odd) {
        background: #160d24;
    }

    .wall-poster {
        position: absolute;
        left: 620px;
        top: 70px;
        width: 200px;
        height: 252px;
        background: #190e28;
        background: #211138;
        overflow: hidden;
    }

    .wall-poster h1 {
        position: absolute;
        left: 14px;
        top: 14px;
        font-size: 24px;
        font-size: 2.4rem;
        line-height: 1;
        color: #291c3b;
        color: #4d2d79;
        text-transform: uppercase;
        text-align: left;
    }

    .wall-poster h1 span {
        position: relative;
        bottom: 10px;
        display: block;
        font-size: 40px;
        font-size: 4rem;
        line-height: 1;
        text-align: left;
    }

    .wall-poster span {
        position: absolute;
        right: 0;
        bottom: 10px;
        width: 75px;
        height: 40px;
        font-size: 30px;
        font-size: 3rem;
        line-height: 40px;
        color: #291c3b;
        color: #4d2d79;
        text-align: center;
        letter-spacing: -1.4px;
    }

    .mr-akabei {
        position: absolute;
        right: 12px;
        bottom: 80px;
        width: 77px;
        height: 74px;
        border-radius: 38px 38px 0 0;
        background: #241637;
        background: #4d2d79;
    }

    .mr-akabei i {
        position: absolute;
        top: 80%;
        right: 100%;
        margin-top: -5px;
        width: 10px;
        height: 10px;
        border-radius: 6px;
        background: #241637;
        background: #43226f;
    }

    .mr-akabei .point-first {
        margin-right: 10px;
    }

    .mr-akabei .point-second {
        margin-right: 30px;
    }

    .mr-akabei .point-third {
        margin-right: 50px;
    }

    .mr-akabei .point-four {
        margin-right: 70px;
    }

    .mr-akabei .point-last {
        margin-right: 90px;
    }

    .mr-akabei-content .mr-akabei-eye-first,
    .mr-akabei-content .mr-akabei-eye-second {
        position: absolute;
        top: 26px;
        width: 20px;
        height: 20px;
        border-radius: 10px;
        background: #2f2143;
        background: #8454c7;
    }

    .mr-akabei-content .mr-akabei-eye-first:before,
    .mr-akabei-content .mr-akabei-eye-second:before {
        content: '';
        position: absolute;
        left: 3px;
        top: 3px;
        width: 9px;
        height: 9px;
        border-radius: 6px;
        background: #1c112b;
    }

    .mr-akabei-content .mr-akabei-eye-first {
        left: 12px;
    }

    .mr-akabei-content .mr-akabei-eye-second {
        right: 12px;
    }

    .mr-akabei-content .mr-akabei-bottom-1 {
        position: absolute;
        left: 0;
        top: 68px;
        width: 11px;
        height: 20px;
        border-radius: 0 0 6px 6px;
        background: #241637;
        background: #4d2d79;
    }

    .mr-akabei-content .mr-akabei-bottom-2 {
        position: absolute;
        left: 11px;
        top: 62px;
        width: 11px;
        height: 20px;
        border-radius: 6px;
        background: #190e28;
    }

    .mr-akabei-content .mr-akabei-bottom-3 {
        position: absolute;
        left: 22px;
        top: 68px;
        width: 11px;
        height: 24px;
        border-radius: 0 0 6px 6px;
        background: #241637;
        background: #4d2d79;
    }

    .mr-akabei-content .mr-akabei-bottom-4 {
        position: absolute;
        left: 33px;
        top: 62px;
        width: 11px;
        height: 20px;
        border-radius: 6px;
        background: #190e28;
    }

    .mr-akabei-content .mr-akabei-bottom-5 {
        position: absolute;
        left: 44px;
        top: 68px;
        width: 11px;
        height: 20px;
        border-radius: 0 0 6px 6px;
        background: #241637;
        background: #4d2d79;
    }

    .mr-akabei-content .mr-akabei-bottom-6 {
        position: absolute;
        left: 55px;
        top: 66px;
        width: 11px;
        height: 24px;
        border-radius: 6px;
        background: #190e28;
    }

    .mr-akabei-content .mr-akabei-bottom-7 {
        position: absolute;
        left: 66px;
        top: 68px;
        width: 11px;
        height: 24px;
        border-radius: 0 0 6px 6px;
        background: #241637;
        background: #4d2d79;
    }

    .mr-pacman {
        position: absolute;
        right: 70px;
        bottom: 10px;
        width: 40px;
        height: 40px;
        border-radius: 20px;
        background: #241637;
        background: #4d2d79;
    }

    .mr-pacman:after {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        margin-top: -8px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 8px 0 8px 20px;
        border-color: transparent transparent transparent #1c112b;
        border-color: transparent transparent transparent #211138;
    }

    .mr-pacman i {
        position: absolute;
        top: 50%;
        right: 100%;
        margin-top: -5px;
        width: 10px;
        height: 10px;
        border-radius: 6px;
        background: #241637;
        background: #43226f;
    }

    .mr-pacman .point-first {
        margin-right: 10px;
    }

    .mr-pacman .point-second {
        margin-right: 30px;
    }

    .mr-pacman .point-third {
        margin-right: 50px;
    }

    .mr-pacman .point-four {
        margin-right: 70px;
    }

    .wall-desk {
        position: absolute;
        left: 30px;
        top: 160px;
        width: 200px;
        height: 32px;
    }

    .wall-desk-bottom {
        position: absolute;
        left: 0;
        top: 5px;
        width: 146px;
        height: 10px;
        background-color: #160c25;
        background-image: linear-gradient(#3e2b56 0%, #180f28 100%);
        transform: skew(80deg, 0);
        transform-origin: left top;
    }

    .wall-desk-shadow {
        position: absolute;
        left: 16px;
        top: -1px;
        width: 146px;
        height: 10px;
        background-color: #0c0915;
        transform: skew(74deg, 0);
        transform-origin: left top;
    }

    .wall-desk-front {
        position: absolute;
        left: 0;
        top: 0;
        width: 140px;
        height: 5px;
        background: #26173a;
    }

    .wall-desk-right {
        position: absolute;
        top: 0;
        left: 140px;
        width: 56px;
        height: 5px;
        background: #201233;
        transform: skew(0deg, 10deg);
        transform-origin: left top;
    }

    .timer {
        position: absolute;
        left: 30px;
        bottom: 100%;
        margin-bottom: 3px;
        width: 105px;
        height: 34px;
    }

    .timer:before {
        content: '';
        position: absolute;
        left: 50%;
        top: -2px;
        width: 36px;
        height: 2px;
        margin-left: -18px;
        border-radius: 2px 2px 0 0;
        background: #57328d;
    }

    .timer .timer-content {
        position: relative;
        padding: 5px;
        width: 100%;
        height: 100%;
        border-radius: 18px;
        background-color: #38274e;
        z-index: 2;
    }

    .timer .timer-right {
        position: absolute;
        left: 100%;
        top: 0;
        margin-left: -20px;
        width: 40px;
        height: 34px;
        border-radius: 0 18px 20px 0;
        border-top-right-radius: 60px 30px;
        background-color: #2b1843;
    }

    .timer .timer-hr {
        position: relative;
        width: 100%;
        height: 100%;
        border-radius: 18px;
        background: #160d24;
        box-shadow: inset 2px 0 0 0 #0c0915;
    }

    .timer .timer-hr:before {
        content: '';
        position: absolute;
        left: 10px;
        top: 50%;
        width: 10px;
        height: 10px;
        margin-top: -5px;
        border-radius: 6px;
        background: #57328d;
        box-shadow: 2px 0 0 #341760;
    }

    .timer .timer-hr-first,
    .timer .timer-hr-second,
    .timer .timer-hr-third,
    .timer .timer-hr-last {
        position: absolute;
        top: 100%;
        left: 18px;
        width: 8px;
        height: 4px;
        border-radius: 0 0 4px 4px;
        background: #241736;
    }

    .timer .timer-hr-second {
        left: 80px;
    }

    .timer .timer-hr-third,
    .timer .timer-hr-last {
        left: 36px;
        background: #180e26;
    }

    .timer .timer-hr-last {
        left: 102px;
    }

    .timer-digits {
        padding: 4px 8px 0 24px;
        width: 100%;
        height: 100%;
        font-family: 'Orbitron', 'Arial CE', Arial, sans-serif;
        font-size: 16px;
        font-size: 1.6rem;
        line-height: 20px;
        font-weight: 500;
        color: #ee8b3c;
        text-align: center;
        opacity: 0.6;
        filter: alpha(opacity=60);
        -webkit-animation: timeblink 1s infinite;
        animation: timeblink 1s infinite;
    }

    @-webkit-keyframes timeblink {
        0% {
            opacity: 0.3;
            filter: alpha(opacity=30);
        }

        49% {
            opacity: 0.3;
            filter: alpha(opacity=30);
        }

        50% {
            opacity: 0.6;
            filter: alpha(opacity=60);
        }
    }

    @keyframes timeblink {
        0% {
            opacity: 0.3;
            filter: alpha(opacity=30);
        }

        49% {
            opacity: 0.3;
            filter: alpha(opacity=30);
        }

        50% {
            opacity: 0.6;
            filter: alpha(opacity=60);
        }
    }

    .timer-shadow {
        position: absolute;
        left: 40px;
        top: 10px;
        width: 105px;
        height: 26px;
        border-radius: 20px;
        background: #0c0915;
    }

    .timer-hr-right {
        position: absolute;
        left: 100%;
        top: 50%;
        width: 10px;
        height: 1px;
        transform: rotate(14deg);
        background: #160d24;
    }

    .timer-hr-right:before,
    .timer-hr-right:after {
        content: '';
        position: absolute;
        left: 0;
        width: 6px;
        height: 1px;
        background: #160d24;
    }

    .timer-hr-right:before {
        top: -3px;
    }

    .timer-hr-right:after {
        left: 2px;
        top: 3px;
    }

    .floor-bg {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 245px;
        background-color: #110c1e;
        background-image: linear-gradient(#06040b 0%, #110c1e 100%);
    }

    .floor-hr {
        position: absolute;
        left: 0;
        top: -38px;
        width: 100%;
        height: 38px;
        background: #221532;
    }

    .floor-hr:after,
    .floor-hr:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 2px;
        background: #160d24;
    }

    .floor-hr:after {
        top: 5px;
    }

    .floor-hr i {
        position: absolute;
        left: 0;
        top: -7px;
        width: 100%;
        height: 7px;
        background: #191028;
    }

    .tv-content {
        position: absolute;
        left: 190px;
        bottom: 110px;
        width: 534px;
        height: 318px;
    }

    .tv {
        position: absolute;
        left: 60px;
        top: -100px;
        width: 340px;
        height: 274px;
    }

    .tv-shadow {
        position: absolute;
        left: 80px;
        top: 50px;
        width: 320px;
        height: 260px;
        border-radius: 20px;
        background: #0c0915;
        transform: perspective(700px) rotateX(150deg);
        -moz-filter: blur(2px);
        -o-filter: blur(2px);
        -ms-filter: blur(2px);
        filter: blur(2px);
    }

    .tv-right {
        position: absolute;
        left: 100%;
        top: 22px;
        margin-left: -30px;
        width: 97px;
        height: 232px;
        border-radius: 10px;
        background-color: #36274a;
        background-image: linear-gradient(#2b1d3d 0%, #1a0e29 100%);
        transform: perspective(200px) rotateY(45deg);
        z-index: 3;
    }

    .tv-bottom {
        position: absolute;
        left: 28px;
        bottom: -20px;
        width: 282px;
        height: 24px;
        border-radius: 0 0 9px 9px;
        background-color: #620e32;
        background-image: linear-gradient(to top, #211333 0%, #110222 100%);
        z-index: 2;
    }

    .tv-bottom ul {
        position: absolute;
        left: 0;
        top: 8px;
        padding-left: 30px;
        width: 100%;
        height: 11px;
    }

    .tv-bottom ul:after {
        content: "";
        display: table;
        clear: both;
    }

    .tv-bottom ul li {
        float: left;
        margin: 0 4px 0 0;
        width: 3px;
        height: 100%;
        border-radius: 2px;
        background: #12081f;
    }

    .tv-bottom i {
        position: absolute;
        left: 100%;
        bottom: 0;
        width: 40px;
        height: 22px;
        background: #130622;
        transform: skew(0deg, -28deg);
        transform-origin: left bottom;
    }

    .tv-screen {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border-radius: 24px;
        background-color: #7f1b46;
        background-image: linear-gradient(to bottom left, #4a3863 0%, #34214c 100%);
        z-index: 4;
        transform: translateZ(1000px);
        transform-style: preserve-3d;
    }

    .pw-btn {
        position: absolute;
        left: 36px;
        bottom: 4px;
        width: 10px;
        height: 3px;
        background: #ee8b3c;
    }

    .tv-hr {
        position: absolute;
        left: 12px;
        top: 9px;
        width: 316px;
        height: 254px;
        border-radius: 18px;
        background: #57328d;
    }

    .tv-hr-2 {
        position: absolute;
        left: 3px;
        top: 3px;
        width: 310px;
        height: 248px;
        border-radius: 18px;
        background: #1c1330;
    }

    .tv-hr-3 {
        position: absolute;
        left: 4px;
        top: 4px;
        width: 302px;
        height: 240px;
        border-radius: 18px;
        background: #110a20;
    }

    .tv-glass {
        position: absolute;
        left: 6px;
        top: 5px;
        width: 290px;
        height: 230px;
        border-radius: 12px;
        background: black;
        overflow: hidden;
        -webkit-transform: translate3d(0, 0, 0);
    }

    .tv-glass canvas {
        position: absolute;
        left: 0;
        top: 0;
        transform: scale(0.42);
        opacity: 0.5;
        filter: alpha(opacity=50);
        transform-origin: left top;
        transition: all 0.2s ease-in-out;
    }

    .show-player .tv-glass canvas {
        opacity: 1;
        filter: alpha(opacity=100);
    }

    iframe {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border: 0;
        border-radius: 9px;
        overflow: hidden;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .ytframe {
        left: -20%;
        width: 140%;
        height: 100%;
    }

    .tv-loading {
        display: block;
        padding: 10px 0 0 18px;
        font-size: 24px;
        font-size: 2.4rem;
        line-height: 1;
        color: #fff;
        opacity: 0.8;
        filter: alpha(opacity=80);
    }

    .tv-glass-vintage {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .tv-glass-vintage ul {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }

    .tv-glass-vintage ul li {
        position: relative;
        width: 100%;
        height: 4%;
    }

    .tv-glass-vintage ul li:after {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 2px;
        background: #fff;
        opacity: 0.07;
        filter: alpha(opacity=7);
    }

    .tv-noise,
    .tv-noise-second {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-image: url(data:image/png;base64,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);
        -webkit-animation: blink 0.3s infinite linear;
        animation: blink 0.3s infinite linear;
    }

    .tv-noise-second {
        background-image: url(data:image/png;base64,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);
        opacity: 0;
        filter: alpha(opacity=0);
        -webkit-animation-direction: reverse;
        animation-direction: reverse;
    }

    @-webkit-keyframes blink {
        0% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        50% {
            opacity: 0.15;
            filter: alpha(opacity=15);
        }

        100% {
            opacity: 0.3;
            filter: alpha(opacity=30);
        }
    }

    @keyframes blink {
        0% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        50% {
            opacity: 0.15;
            filter: alpha(opacity=15);
        }

        100% {
            opacity: 0.3;
            filter: alpha(opacity=30);
        }
    }

    .tv-glow {
        position: absolute;
        top: 10px;
        right: 10px;
        border-radius: 18px 0 0 18px;
        width: 120px;
        height: 120px;
        background-image: radial-gradient(circle at 100% 100%, rgba(204, 0, 0, 0) 59px, #fff 60px);
        background-size: 50% 50%;
        background-repeat: no-repeat;
        opacity: 0.2;
        filter: alpha(opacity=20);
        filter: blur(3px);
        transform: rotate(90deg);
    }

    .tv-flashing {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        -webkit-transform: translate3d(0, 0, 0);
    }

    .tv-flashing i {
        -moz-filter: blur(10px);
        -o-filter: blur(10px);
        -ms-filter: blur(10px);
        filter: blur(10px);
        opacity: 0;
        filter: alpha(opacity=0);
        -webkit-animation: blink2 3s infinite linear;
        animation: blink2 3s infinite linear;
    }

    .tv-flashing .tv-flashing-left {
        position: absolute;
        right: 100%;
        top: -4px;
        margin-right: -73px;
        width: 200px;
        height: 254px;
        transform: perspective(400px) rotateY(64.4deg);
        background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, #ffffff 100%);
    }

    .tv-flashing .tv-flashing-bottom {
        position: absolute;
        left: -27px;
        top: 100%;
        margin-top: -40px;
        width: 300px;
        height: 100px;
        transform: perspective(600px) rotateX(60deg) skew(-28deg);
        background: linear-gradient(to top, rgba(255, 255, 255, 0) 0%, #ffffff 100%);
    }

    .tv-flashing .tv-flashing-bottom-placeholder {
        position: absolute;
        left: 0;
        top: 100%;
        margin: -28px 0 0 8px;
        width: 30px;
        height: 30px;
        background-image: radial-gradient(circle at 100% 0, rgba(204, 0, 0, 0) 14px, #fff 15px);
        background-size: 50% 50%;
        background-repeat: no-repeat;
    }

    @-webkit-keyframes blink2 {
        0% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        5% {
            opacity: 0.1;
            filter: alpha(opacity=10);
        }

        7% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        14% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        22% {
            opacity: 0.1;
            filter: alpha(opacity=10);
        }

        26% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        66% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        78% {
            opacity: 0.08;
            filter: alpha(opacity=8);
        }

        82% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        88% {
            opacity: 0.08;
            filter: alpha(opacity=8);
        }

        92% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        100% {
            opacity: 0;
            filter: alpha(opacity=0);
        }
    }

    @keyframes blink2 {
        0% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        5% {
            opacity: 0.1;
            filter: alpha(opacity=10);
        }

        7% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        14% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        22% {
            opacity: 0.1;
            filter: alpha(opacity=10);
        }

        26% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        66% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        78% {
            opacity: 0.08;
            filter: alpha(opacity=8);
        }

        82% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        88% {
            opacity: 0.08;
            filter: alpha(opacity=8);
        }

        92% {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        100% {
            opacity: 0;
            filter: alpha(opacity=0);
        }
    }

    .tv-top {
        position: absolute;
        left: 0;
        bottom: 100%;
        margin-bottom: -4px;
        width: 100%;
        height: 100px;
    }

    .tv-top i {
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 4px;
        height: 80px;
        background: #36274a;
        transform-origin: left bottom;
    }

    .tv-top i:after {
        content: '';
        position: absolute;
        left: -2px;
        top: -2px;
        width: 8px;
        height: 8px;
        border-radius: 4px;
        background: #36274a;
    }

    .tv-top .item-left {
        transform: rotate(-35deg);
    }

    .tv-top .item-right {
        margin-left: -6px;
        height: 140px;
        transform: rotate(45deg);
    }

    .tv-desk {
        position: absolute;
        left: 0;
        bottom: 100px;
        width: 100%;
        height: 60px;
    }

    .tv-desk-top,
    .tv-desk-shadow {
        position: absolute;
        left: 0;
        bottom: 8px;
        width: 420px;
        height: 51px;
        background-color: #372757;
        background-image: linear-gradient(to top, #130a21 0%, #07000e 100%);
        transform: skew(-60deg, 0);
        transform-origin: left bottom;
    }

    .tv-desk-shadow {
        bottom: -30px;
        background: #050409;
    }

    .tv-desk-front {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 412px;
        height: 10px;
        background: #1f1131;
    }

    .tv-desk-right {
        position: absolute;
        bottom: 0;
        left: 412px;
        width: 92px;
        height: 10px;
        background: #28183d;
        transform: skew(0deg, -28deg);
        transform-origin: left bottom;
    }

    .tv-desk-item-left,
    .tv-desk-item-right,
    .tv-desk-item-rear {
        position: absolute;
        left: 40px;
        top: 100%;
        margin-top: -16px;
        width: 14px;
        height: 58px;
        background: #28183d;
        transform: perspective(100px) rotateX(120deg);
    }

    .tv-desk-item-left-shadow,
    .tv-desk-item-right-shadow,
    .tv-desk-item-rear-shadow {
        position: absolute;
        left: 52px;
        top: 100%;
        margin-top: 25px;
        width: 8px;
        height: 46px;
        background: #170c26;
        transform: skew(0deg, -28deg) perspective(100px) rotateX(120deg);
        transform-origin: left top;
    }

    .tv-desk-item-right {
        left: 370px;
    }

    .tv-desk-item-right-shadow {
        left: 382px;
    }

    .tv-desk-item-rear {
        margin-top: -52px;
        left: 450px;
        background: #170c26;
    }

    .tv-desk-item-rear-shadow {
        margin-top: -12px;
        left: 462px;
        background: #12091f;
    }

    .console {
        position: absolute;
        left: 60px;
        bottom: 106px;
        width: 132px;
        height: 40px;
    }

    .console-shadow {
        position: absolute;
        right: 0;
        bottom: 0;
        margin-right: 10px;
        width: 100px;
        height: 100px;
        background: black;
        transform: skew(-69deg, 0);
        transform-origin: left bottom;
    }

    .console-top {
        position: absolute;
        left: 0;
        bottom: 40px;
        width: 132px;
        height: 46px;
        background-color: #342448;
        background-image: linear-gradient(#180f28 0%, #342448 60%);
        transform: skew(-60deg, 0);
        transform-origin: left bottom;
    }

    .console-top-panel {
        position: absolute;
        left: 85px;
        bottom: 0;
        width: 30px;
        height: 46px;
        background: #1b1127;
    }

    .console-top-panel i {
        display: block;
        width: 100%;
        height: 6px;
        border-bottom: 1px solid #160e20;
    }

    .console-top-panel .console-top-panel-item-1 {
        height: 4px;
    }

    .console-top-panel .console-top-panel-item-4,
    .console-top-panel .console-top-panel-item-5,
    .console-top-panel .console-top-panel-item-6 {
        border-color: #291d3a;
        background: #2d1e3f;
    }

    .console-game-top {
        position: absolute;
        left: 10px;
        bottom: 0;
        width: 60px;
        height: 16px;
        border: 1px solid #2b1d3e;
        border-bottom: 0;
    }

    .console-right-top {
        position: absolute;
        bottom: 16px;
        left: 131px;
        width: 80px;
        height: 24px;
        background: #28183d;
        transform: skew(0deg, -30deg);
        transform-origin: left bottom;
    }

    .console-right-top:after {
        content: '';
        position: absolute;
        top: 0;
        left: 100%;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 24px 0 0 5px;
        border-color: transparent transparent transparent #28183d;
    }

    .console-right-bottom {
        position: absolute;
        bottom: 0;
        left: 131px;
        width: 80px;
        height: 16px;
        background: #1b1127;
        transform: skew(0deg, -30deg);
        transform-origin: left bottom;
    }

    .console-right-bottom:after {
        content: '';
        position: absolute;
        top: 0;
        left: 100%;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 16px 6px 0 0;
        border-color: #1b1127 transparent transparent transparent;
    }

    .console-front-panel {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .front-panel-top {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 50%;
        background: #392652;
    }

    .front-panel-top:before,
    .front-panel-top:after {
        content: '';
        position: absolute;
        top: 0;
        width: 0;
        height: 0;
        border-style: solid;
    }

    .front-panel-top:before {
        right: 100%;
        border-width: 0 0 20px 4px;
        border-color: transparent transparent #392652 transparent;
    }

    .front-panel-top:after {
        left: 100%;
        border-width: 20px 0 0 4px;
        border-color: transparent transparent transparent #392652;
    }

    .console-game {
        position: absolute;
        left: 8px;
        bottom: 6px;
        width: 60px;
        height: 14px;
        border: 1px solid #2b1d3e;
        border-top: 0;
        transform: skew(-10deg, 0deg);
        transform-origin: left bottom;
    }

    .console-power-dark {
        position: absolute;
        left: 82px;
        bottom: 0;
        width: 30px;
        height: 20px;
        background: #231831;
        transform: skew(-10deg, 0deg);
        transform-origin: left bottom;
    }

    .front-panel-bottom {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 50%;
        background: #28193b;
    }

    .front-panel-bottom:before,
    .front-panel-bottom:after {
        content: '';
        position: absolute;
        top: 0;
        width: 0;
        height: 0;
        border-style: solid;
    }

    .front-panel-bottom:before {
        right: 100%;
        border-width: 0 4px 20px 0;
        border-color: transparent #28193b transparent transparent;
    }

    .front-panel-bottom:after {
        left: 100%;
        border-width: 20px 4px 0 0;
        border-color: #28193b transparent transparent transparent;
    }

    .console-power-indicator {
        position: absolute;
        left: 9px;
        top: 9px;
        width: 4px;
        height: 4px;
        border-radius: 2px;
        background: #ee8b3c;
    }

    .console-btn-first,
    .console-btn-second {
        position: absolute;
        left: 24px;
        top: 7px;
        width: 16px;
        height: 8px;
        border-radius: 3px;
        border: 1px solid #0e0a19;
        background: #392652;
    }

    .console-btn-second {
        left: 44px;
    }

    .console-power {
        position: absolute;
        right: 20px;
        top: 0;
        width: 30px;
        height: 100%;
        background: #1b1127;
    }

    .console-power-plug {
        position: absolute;
        left: 5px;
        top: 4px;
        width: 20px;
        height: 12px;
        border-radius: 2px;
        background: #020204;
    }

    .console-power-plug i {
        position: absolute;
        left: 1px;
        top: 2px;
        width: 16px;
        height: 10px;
        border-radius: 2px;
        background: #140c1d;
    }

    .console-power-cable {
        position: absolute;
        right: 14px;
        top: 8px;
        width: 40px;
        height: 6px;
        border-radius: 10px;
        background: black;
        transform: skew(0deg, -30deg);
        transform-origin: right top;
    }

    .player-1 {
        position: absolute;
        right: 40px;
        bottom: -10px;
        width: 310px;
        height: 140px;
        transition: all 0.5s cubic-bezier(0.32, 0, 0.56, 1.4);
        bottom: -180px;
        transform: perspective(600px) rotateY(20deg) rotateX(80deg) scale(1.15);
    }

    .show-player .player-1 {
        bottom: -10px;
        bottom: 0px;
        transform: perspective(600px) rotateY(0deg) rotateX(0deg) scale(1.15);
    }

    .press-spacebar .player-1 {
        transform: rotate(2deg) scale(1.1);
    }

    .press-w .player-1,
    .press-a .player-1,
    .press-s .player-1,
    .press-d .player-1 {
        transform: rotate(-2deg) scale(1.1);
    }

    .player-hand-left {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 110px;
        height: 100px;
    }

    .player-hand-left .hand-content {
        position: absolute;
        left: 0;
        bottom: -20px;
        width: 100px;
        height: 160px;
    }

    .player-hand-left .hand-content .hand-inner {
        position: absolute;
        right: 4px;
        top: 34px;
        width: 36px;
        height: 36px;
        border-radius: 30px;
        background: #231733;
        z-index: 5;
    }

    .player-hand-left .hand-content .hand-left {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 140px;
        border-top-left-radius: 100px 200px;
        border-bottom-left-radius: 50px 50px;
        background: #2f2140;
        transform: rotate(10deg);
        transform-origin: left bottom;
    }

    .player-hand-left .finger-content {
        position: absolute;
        left: 40px;
        bottom: 30px;
        width: 52px;
        height: 52px;
    }

    .player-hand-left .finger-content .finger-placeholder {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        border-radius: 30px;
        background: #2f2140;
        transition: all 0.2s ease-in-out;
    }

    .press-w .player-hand-left .finger-content .finger-placeholder {
        left: 0px;
        bottom: 4px;
    }

    .press-a .player-hand-left .finger-content .finger-placeholder {
        left: -2px;
    }

    .press-s .player-hand-left .finger-content .finger-placeholder {
        left: 4px;
    }

    .press-d .player-hand-left .finger-content .finger-placeholder {
        left: 2px;
    }

    .player-hand-left .finger-content .finger-touch {
        position: absolute;
        left: 50%;
        top: 50%;
        margin-top: -5px;
        width: 32px;
        height: 24px;
        background: #2f2140;
        transform: rotate(-44deg);
        z-index: 10;
        transform-origin: left top;
        transition: all 0.2s ease-in-out;
    }

    .press-w .player-hand-left .finger-content .finger-touch {
        width: 50px;
        transform: rotate(-50deg);
    }

    .press-a .player-hand-left .finger-content .finger-touch {
        width: 30px;
        transform: rotate(-54deg);
    }

    .press-s .player-hand-left .finger-content .finger-touch {
        width: 38px;
        transform: rotate(-30deg);
    }

    .press-d .player-hand-left .finger-content .finger-touch {
        width: 50px;
        transform: rotate(-36deg);
    }

    .player-hand-left .finger-content .finger-touch:before {
        content: '';
        position: absolute;
        top: 0;
        right: -12px;
        width: 24px;
        height: 24px;
        border-radius: 12px;
        background: #2f2140;
    }

    .player-hand-left .finger-content .finger-touch:after {
        content: '';
        position: absolute;
        right: -10px;
        top: 4px;
        width: 14px;
        height: 16px;
        border-radius: 0 8px 8px 0;
        background: #423256;
    }

    .player-hand-left .hair-item-1,
    .player-hand-left .hair-item-2,
    .player-hand-left .hair-item-3,
    .player-hand-left .hair-item-4,
    .player-hand-left .hair-item-5,
    .player-hand-left .hair-item-6,
    .player-hand-left .hair-item-7,
    .player-hand-left .hair-item-8,
    .player-hand-left .hair-item-9,
    .player-hand-left .hair-item-10,
    .player-hand-left .hair-item-11,
    .player-hand-left .hair-item-12,
    .player-hand-left .hair-item-13,
    .player-hand-left .hair-item-14,
    .player-hand-left .hair-item-15,
    .player-hand-left .hair-item-16 {
        position: absolute;
        left: 48px;
        top: 54px;
        width: 1px;
        height: 10px;
        background: #1d112c;
        transform: rotate(50deg);
        z-index: 15;
    }

    .player-hand-left .hair-item-2 {
        margin-left: 6px;
        margin-top: 8px;
    }

    .player-hand-left .hair-item-3 {
        margin-left: -10px;
        margin-top: 6px;
    }

    .player-hand-left .hair-item-4 {
        margin-left: -10px;
        margin-top: 20px;
    }

    .player-hand-left .hair-item-5 {
        margin-left: 6px;
        margin-top: 20px;
        transform: rotate(38deg);
    }

    .player-hand-left .hair-item-6 {
        margin-left: 8px;
        margin-top: 36px;
        transform: rotate(38deg);
    }

    .player-hand-left .hair-item-7 {
        margin-left: -10px;
        margin-top: 36px;
        transform: rotate(38deg);
    }

    .player-hand-left .hair-item-8 {
        margin-left: 0px;
        margin-top: 32px;
        transform: rotate(38deg);
    }

    .player-hand-left .hair-item-9 {
        margin-left: -20px;
        margin-top: 22px;
        transform: rotate(38deg);
    }

    .player-hand-left .hair-item-10 {
        margin-left: -24px;
        margin-top: 34px;
        transform: rotate(22deg);
    }

    .player-hand-left .hair-item-11 {
        margin-left: -10px;
        margin-top: 56px;
        transform: rotate(22deg);
    }

    .player-hand-left .hair-item-12 {
        margin-left: -26px;
        margin-top: 52px;
        transform: rotate(22deg);
    }

    .player-hand-left .hair-item-13 {
        margin-left: 0px;
        margin-top: 60px;
        transform: rotate(22deg);
    }

    .player-hand-left .hair-item-14 {
        margin-left: -12px;
        margin-top: 80px;
        transform: rotate(22deg);
    }

    .player-hand-left .hair-item-15 {
        margin-left: -22px;
        margin-top: 70px;
        transform: rotate(22deg);
    }

    .player-hand-left .hair-item-16 {
        margin-left: -34px;
        margin-top: 76px;
        transform: rotate(22deg);
    }

    .player-hand-right {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 110px;
        height: 120px;
    }

    .player-hand-right .hand-content {
        position: absolute;
        right: 0;
        bottom: -20px;
        width: 100px;
        height: 180px;
    }

    .player-hand-right .hand-content .hand-inner {
        position: absolute;
        left: 4px;
        top: 34px;
        width: 38px;
        height: 38px;
        border-radius: 30px;
        background: #231733;
        z-index: 5;
    }

    .player-hand-right .hand-content .hand-left {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 60px;
        height: 160px;
        border-top-right-radius: 100px 200px;
        background: #2f2140;
        transform: rotate(-10deg);
        transform-origin: right bottom;
    }

    .player-hand-right .finger-content {
        position: absolute;
        right: 40px;
        bottom: 50px;
        width: 52px;
        height: 52px;
    }

    .player-hand-right .finger-content .finger-placeholder {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        border-radius: 30px;
        background: #2f2140;
        transition: all 0.2s ease-in-out;
    }

    .press-spacebar .player-hand-right .finger-content .finger-placeholder {
        right: 5px;
    }

    .player-hand-right .finger-content .finger-touch {
        position: absolute;
        right: 50%;
        top: 50%;
        margin-top: -16px;
        width: 36px;
        height: 24px;
        background: #2f2140;
        transform: rotate(36deg);
        z-index: 10;
        transition: all 0.2s ease-in-out;
    }

    .press-spacebar .player-hand-right .finger-content .finger-touch {
        width: 52px;
        transform: rotate(30deg);
    }

    .player-hand-right .finger-content .finger-touch:before {
        content: '';
        position: absolute;
        top: 0;
        left: -12px;
        width: 24px;
        height: 24px;
        border-radius: 12px;
        background: #2f2140;
    }

    .player-hand-right .finger-content .finger-touch:after {
        content: '';
        position: absolute;
        left: -10px;
        top: 4px;
        width: 14px;
        height: 16px;
        border-radius: 8px 0 0 8px;
        background: #423256;
    }

    .player-hand-right .hair-item-1,
    .player-hand-right .hair-item-2,
    .player-hand-right .hair-item-3,
    .player-hand-right .hair-item-4,
    .player-hand-right .hair-item-5,
    .player-hand-right .hair-item-6,
    .player-hand-right .hair-item-7,
    .player-hand-right .hair-item-8,
    .player-hand-right .hair-item-9,
    .player-hand-right .hair-item-10,
    .player-hand-right .hair-item-11,
    .player-hand-right .hair-item-12,
    .player-hand-right .hair-item-13,
    .player-hand-right .hair-item-14,
    .player-hand-right .hair-item-15,
    .player-hand-right .hair-item-16 {
        position: absolute;
        left: 62px;
        top: 68px;
        width: 1px;
        height: 10px;
        background: #1d112c;
        transform: rotate(-50deg);
        z-index: 15;
    }

    .player-hand-right .hair-item-2 {
        margin-left: 6px;
        margin-top: 8px;
    }

    .player-hand-right .hair-item-3 {
        margin-left: 20px;
        margin-top: 70px;
        transform: rotate(-22deg);
    }

    .player-hand-right .hair-item-4 {
        margin-left: -10px;
        margin-top: 20px;
    }

    .player-hand-right .hair-item-5 {
        margin-left: 6px;
        margin-top: 20px;
        transform: rotate(-38deg);
    }

    .player-hand-right .hair-item-6 {
        margin-left: 8px;
        margin-top: 36px;
        transform: rotate(-38deg);
    }

    .player-hand-right .hair-item-7 {
        margin-left: -10px;
        margin-top: 36px;
        transform: rotate(-38deg);
    }

    .player-hand-right .hair-item-8 {
        margin-left: 20px;
        margin-top: 50px;
        transform: rotate(-22deg);
    }

    .player-hand-right .hair-item-9 {
        margin-left: -20px;
        margin-top: 22px;
        transform: rotate(-38deg);
    }

    .player-hand-right .hair-item-10 {
        margin-left: -24px;
        margin-top: 34px;
        transform: rotate(-22deg);
    }

    .player-hand-right .hair-item-11 {
        margin-left: -10px;
        margin-top: 56px;
        transform: rotate(-22deg);
    }

    .player-hand-right .hair-item-12 {
        margin-left: -26px;
        margin-top: 52px;
        transform: rotate(-22deg);
    }

    .player-hand-right .hair-item-13 {
        margin-left: 0px;
        margin-top: 70px;
        transform: rotate(-22deg);
    }

    .player-hand-right .hair-item-14 {
        margin-left: -12px;
        margin-top: 80px;
        transform: rotate(-22deg);
    }

    .player-hand-right .hair-item-15 {
        margin-left: -22px;
        margin-top: 70px;
        transform: rotate(-22deg);
    }

    .player-hand-right .hair-item-16 {
        margin-left: -34px;
        margin-top: 76px;
        transform: rotate(-22deg);
    }

    .controller-nes {
        position: absolute;
        top: 20px;
        left: 68px;
        padding: 16px 8px 8px 8px;
        width: 160px;
        height: 70px;
        border-radius: 4px;
        background: #493762;
        background-image: linear-gradient(to top right, #34214c 0%, #4a3863 100%);
        transform: rotate(-10deg);
        transform-origin: left top;
        z-index: 8;
    }

    .in-controller-nes {
        position: relative;
        width: 100%;
        height: 100%;
        background: #201330;
    }

    .controller-nes-pad {
        position: absolute;
        left: 8px;
        bottom: 8px;
        width: 30px;
        height: 30px;
    }

    .controller-nes-pad:before,
    .controller-nes-pad:after {
        content: '';
        position: absolute;
        border-radius: 4px;
        background: #06040b;
    }

    .controller-nes-pad:before {
        top: 0;
        left: 50%;
        margin-left: -6px;
        width: 12px;
        height: 100%;
    }

    .controller-nes-pad:after {
        top: 50%;
        left: 0;
        margin-top: -6px;
        width: 100%;
        height: 12px;
    }

    .controller-nes-option {
        position: absolute;
        left: 50px;
        top: 0;
        width: 34px;
        height: 100%;
        overflow: hidden;
    }

    .controller-nes-option i {
        position: absolute;
        left: 0;
        display: block;
        width: 100%;
        height: 8px;
        border-radius: 4px;
        background: #43305b;
    }

    .controller-nes-option .hr-first {
        top: -2px;
    }

    .controller-nes-option .hr-second {
        top: 7px;
    }

    .controller-nes-option .hr-third {
        top: 16px;
    }

    .controller-nes-option .hr-last {
        bottom: -2px;
    }

    .controller-nes-option .controller-nes-option-btn {
        position: absolute;
        left: 0;
        top: 25px;
        width: 100%;
        height: 14px;
        border-radius: 4px;
        background: #57328d;
    }

    .controller-nes-option .controller-nes-option-btn:before,
    .controller-nes-option .controller-nes-option-btn:after {
        content: '';
        position: absolute;
        top: 5px;
        width: 10px;
        height: 4px;
        border-radius: 2px;
        background: #6c41aa;
    }

    .controller-nes-option .controller-nes-option-btn:before {
        left: 4px;
    }

    .controller-nes-option .controller-nes-option-btn:after {
        right: 4px;
    }

    .controller-nes-btn {
        position: absolute;
        right: 14px;
        bottom: 8px;
        width: 36px;
        height: 14px;
    }

    .controller-nes-btn i {
        position: relative;
        float: left;
        margin: 0 0 0 4px;
        width: 14px;
        height: 14px;
        border-radius: 2px;
        background: #34214c;
    }

    .controller-nes-btn i:after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -4px 0 0 -4px;
        width: 8px;
        height: 8px;
        border-radius: 4px;
        background: #730505;
    }

    .c:after {
        content: "";
        display: table;
        clear: both;
    }

    /* html {
        -khtml-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
    }

    *,
    *::before,
    *::after {
        box-sizing: inherit;
    }

    html,
    body {
        width: 100%;
        height: 100%;
    } */

    .page {
        /* position: relative;
        min-width: 960px;
        min-height: 540px;
        margin: 0;
        line-height: 1; */
        font-size: 12px;
        font-size: 1.2rem;
        line-height: 18px;
        font-family: 'VT323', Georgia, "Times New Roman", Times, serif;
        color: #000;
        /* background: #110c1e; */
        -webkit-font-smoothing: antialiased;
    }

    .page h1,
    .page h2,
    .page h3,
    .page h4,
    .page h5,
    .page h6,
    .page p,
    .page blockquote,
    .page pre,
    .page a,
    .page abbr,
    .page acronym,
    .page address,
    .page cite,
    .page code,
    .page del,
    .page dfn,
    .page em,
    .page img,
    .page q,
    .page s,
    .page samp,
    .page small,
    .page strike,
    .page strong,
    .page sub,
    .page sup,
    .page tt,
    .page var,
    .page dd,
    .page dl,
    .page dt,
    .page li,
    .page ol,
    .page ul,
    .page fieldset,
    .page form,
    .page label,
    .page legend,
    .page button,
    .page table,
    .page caption,
    .page tbody,
    .page tfoot,
    .page thead,
    .page tr,
    .page th,
    .page td {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        line-height: 1;
        font-family: inherit;
    }

    .page html {
        font-size: 62.5%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
</style>
<div class="page">
    <div class="wall-bg">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="wall-poster">
            <h1>game <span>over</span></h1>
            <i class="mr-akabei">
                <div class="mr-akabei-content">
                    <span class="mr-akabei-eye-first"></span>
                    <span class="mr-akabei-eye-second"></span>
                    <span class="mr-akabei-bottom-1"></span>
                    <span class="mr-akabei-bottom-2"></span>
                    <span class="mr-akabei-bottom-3"></span>
                    <span class="mr-akabei-bottom-4"></span>
                    <span class="mr-akabei-bottom-5"></span>
                    <span class="mr-akabei-bottom-6"></span>
                    <span class="mr-akabei-bottom-7"></span>
                </div>
                <i class="point-first"></i>
                <i class="point-second"></i>
                <i class="point-third"></i>
                <i class="point-four"></i>
                <i class="point-last"></i>
            </i>
            <i class="mr-pacman">
                <i class="point-first"></i>
                <i class="point-second"></i>
                <i class="point-third"></i>
                <i class="point-four"></i>
            </i>
            <span>1980</span>
        </div>
        <div class="wall-desk">
            <div class="timer">
                <i class="timer-shadow"></i>
                <div class="timer-content">
                    <div class="timer-hr">
                        <div class="timer-digits"></div>
                    </div>
                    <i class="timer-hr-right"></i>
                </div>
                <i class="timer-right"></i>
                <i class="timer-hr-first"></i>
                <i class="timer-hr-second"></i>
                <i class="timer-hr-third"></i>
                <i class="timer-hr-last"></i>
            </div>
            <i class="wall-desk-shadow"></i>
            <i class="wall-desk-bottom"></i>
            <i class="wall-desk-front"></i>
            <i class="wall-desk-right"></i>
        </div>
    </div>
    <div class="floor-bg">
        <div class="floor-hr"><i></i></div>
    </div>

    <div class="tv-content">
        <div class="tv">
            <div class="tv-top"><i class="item-left"></i><i class="item-right"></i></div>
            <div class="tv-shadow"></div>
            <div class="tv-right"></div>
            <div class="tv-bottom">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <i></i>
            </div>
            <div class="tv-screen"><a href="" class="pw-btn"></a>
                <div class="tv-hr">
                    <div class="tv-hr-2">
                        <div class="tv-hr-3">
                            <div class="tv-glass">
                                <canvas></canvas>
                                <div class="tv-glass-vintage">
                                    <ul>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>

                                    <i class="tv-noise"></i><i class="tv-noise-second"></i>
                                    <i class="tv-glow"></i>
                                </div>
                            </div>
                            <div class="tv-flashing">
                                <i class="tv-flashing-left"></i>
                                <i class="tv-flashing-bottom"></i>
                                <i class="tv-flashing-bottom-placeholder"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tv-desk">
            <i class="tv-desk-shadow"></i>
            <i class="tv-desk-item-left-shadow"></i>
            <i class="tv-desk-item-left"></i>
            <i class="tv-desk-item-right-shadow"></i>
            <i class="tv-desk-item-right"></i>
            <i class="tv-desk-item-rear-shadow"></i>
            <i class="tv-desk-item-rear"></i>
            <i class="tv-desk-top"></i>
            <i class="tv-desk-front"></i>
            <i class="tv-desk-right"></i>
        </div>
    </div>

    <div class="console">
        <i class="console-shadow"></i>
        <div class="console-top">
            <i class="console-game-top"></i>
            <div class="console-top-panel">
                <i class="console-top-panel-item-1"></i>
                <i class="console-top-panel-item-2"></i>
                <i class="console-top-panel-item-3"></i>
                <i class="console-top-panel-item-4"></i>
                <i class="console-top-panel-item-5"></i>
                <i class="console-top-panel-item-6"></i>
                <i class="console-top-panel-item-7"></i>
                <i class="console-top-panel-item-8"></i>
            </div>
        </div>
        <i class="console-right-top"></i>
        <i class="console-right-bottom"></i>
        <div class="console-front-panel">
            <div class="front-panel-top">
                <i class="console-game"></i>
                <i class="console-power-dark"></i>
            </div>
            <div class="front-panel-bottom">
                <i class="console-power-indicator"></i>
                <i class="console-btn-first"></i>
                <i class="console-btn-second"></i>
                <div class="console-power">
                    <div class="console-power-plug"><i></i></div>
                    <i class="console-power-cable"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="player-1">
        <div class="player-hand-left">
            <div class="hand-content">
                <i class="hand-left"></i><i class="hand-inner"></i>
                <i class="hair-item-1"></i>
                <i class="hair-item-2"></i>
                <i class="hair-item-3"></i>
                <i class="hair-item-4"></i>
                <i class="hair-item-5"></i>
                <i class="hair-item-6"></i>
                <i class="hair-item-7"></i>
                <i class="hair-item-8"></i>
                <i class="hair-item-9"></i>
                <i class="hair-item-10"></i>
                <i class="hair-item-11"></i>
                <i class="hair-item-12"></i>
                <i class="hair-item-13"></i>
                <i class="hair-item-14"></i>
                <i class="hair-item-15"></i>
                <i class="hair-item-16"></i>
            </div>
            <div class="finger-content"><i class="finger-placeholder"></i><i class="finger-touch"></i></div>
        </div>
        <div class="player-hand-right">
            <div class="hand-content">
                <i class="hand-left"></i><i class="hand-inner"></i>
                <i class="hair-item-1"></i>
                <i class="hair-item-2"></i>
                <i class="hair-item-3"></i>
                <i class="hair-item-4"></i>
                <i class="hair-item-5"></i>
                <i class="hair-item-6"></i>
                <i class="hair-item-7"></i>
                <i class="hair-item-8"></i>
                <i class="hair-item-9"></i>
                <i class="hair-item-10"></i>
                <i class="hair-item-11"></i>
                <i class="hair-item-12"></i>
                <i class="hair-item-13"></i>
                <i class="hair-item-14"></i>
                <i class="hair-item-15"></i>
                <i class="hair-item-16"></i>
            </div>
            <div class="finger-content"><i class="finger-placeholder"></i><i class="finger-touch"></i></div>
        </div>

        <div class="controller-nes"><i class="controller-nes-cable"></i>
            <div class="in-controller-nes">
                <i class="controller-nes-pad"></i>
                <div class="controller-nes-option">
                    <i class="hr-first"></i>
                    <i class="hr-second"></i>
                    <i class="hr-third"></i>
                    <i class="hr-last"></i>
                    <div class="controller-nes-option-btn"></div>
                </div>
                <div class="controller-nes-btn"><i></i><i></i></div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    "use strict";
    /*
      ------------------------
      Check out my video of how i created this piece of...
      https://www.twitch.tv/videos/115237628 [3hour]
      https://www.twitch.tv/videos/115351889 [6hour]
      ------------------------
      No IMG needed, just pure CSS!
      ------------------------
      Inspiration: http://bit.ly/8bitgaming
      ------------------------
      Design created by @dominikrezek
      ------------------------
      Game created by @remvst
      http://js13kgames.com/entries/taxi-drift
      ------------------------
    */
    // JS
    $(document).ready(function() {
        // TIME
        setInterval(function() {
            var dt = new Date(),
                hours = dt.getHours(),
                minutes = dt.getMinutes();
            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            var time = hours + ":" + minutes;
            $('.timer-digits').html(time);
        }, 1000);
        /*
            W =         87
            A =         65
            S =         83
            D =         68

            spacebar =  32
            R =         82
        */
        $(document).on('keydown', function(e) {
            var code = e.keyCode,
                delay = 300;
            //console.log(code);
            if (code == 13) {
                $('html').addClass('show-player');
            }
            if (code == 87 || code == 38) {
                $('html').addClass('press-w');
                setTimeout(function() {
                    $('html').removeClass('press-w');
                }, delay);
            }
            if (code == 65 || code == 37) {
                $('html').addClass('press-a');
                setTimeout(function() {
                    $('html').removeClass('press-a');
                }, delay);
            }
            if (code == 83 || code == 40) {
                $('html').addClass('press-s');
                setTimeout(function() {
                    $('html').removeClass('press-s');
                }, delay);
            }
            if (code == 68 || code == 39) {
                $('html').addClass('press-d');
                setTimeout(function() {
                    $('html').removeClass('press-d');
                }, delay);
            }
            if (code == 32 || code == 82) {
                $('html').addClass('press-spacebar');
                setTimeout(function() {
                    $('html').removeClass('press-spacebar');
                }, delay);
            }
        });
    });
    var _ = window,
        raf = (function() {
            return _.requestAnimationFrame ||
                _.webkitRequestAnimationFrame ||
                _.mozRequestAnimationFrame ||
                function(c) {
                    setTimeout(c, 1000 / 60);
                };
        })(),
        M = Math,
        abs = M.abs,
        to = setTimeout;

    function rd(a, b) {
        if (b === undefined) {
            b = a;
            a = 0;
        }
        return M.random() * (b - a) + a;
    };

    function rp(a) {
        return a[~~(rd(a.length))];
    };

    function normalizeAngle(a) {
        while (a < -Math.PI)
            a += Math.PI * 2;
        while (a > Math.PI)
            a -= Math.PI * 2;
        return a;
    };

    function xt(o, x) {
        var r = {};
        // Copying
        for (var i in o) {
            r[i] = o[i];
        }
        // Overriding
        for (var i in x) {
            r[i] = x[i];
        }
        return r;
    };
    // Shortcuts
    var p = CanvasRenderingContext2D.prototype;
    p.fr = p.fillRect;
    p.sv = p.save;
    p.rs = p.restore;
    p.tr = p.translate;
    p.lt = p.lineTo;
    p.mt = p.moveTo;
    p.sc = p.scale;
    p.bp = p.beginPath;
    p.clg = p.createLinearGradient;
    p.rt = p.rotate;
    p.ft = p.fillText;
    p.alpha = function(x) {
        this.globalAlpha = x;
    };
    p.fs = function(p) {
        this.fillStyle = p;
    };
    p.di = function(i, x, y) {
        this.drawImage.apply(this, arguments);
    };
    // Adding all these functions to the global scope
    for (var i in p) {
        _[i] = (function(f) {
            return function() {
                c[f].apply(c, arguments);
            };
        })(i);
    }

    function shape(points, color) {
        var tx = points[0].x,
            ty = points[0].y;
        c.sv();
        c.tr(tx, ty);
        c.fs(color);
        c.bp();
        c.moveTo(0, 0);
        for (var i = 1; i < points.length; i++) {
            c.lineTo(points[i].x - tx, points[i].y - ty);
        }
        c.closePath();
        c.fill();
        c.rs();
    };

    function cache(w, h, rr, t) {
        var c = document.createElement('canvas');
        c.width = w;
        c.height = h;
        var r = c.getContext('2d');
        rr(c, r, w, h);
        //setTimeout((rr(c, r, w, h)), 3000);
        if (t === 'pattern') {
            var p = r.createPattern(c, 'repeat');
            p.width = w;
            p.height = h;
            return p;
        }
        return c;
    };

    function noop() {};

    function limit(x, a, b) {
        return M.max(a, M.min(b, x));
    };

    function shuffle(o) {
        for (var j, x, i = o.length; i; j = ~~(M.random() * i), x = o[--i], o[i] = o[j], o[j] = x)
        ;
        return o;
    };

    function dist(x1, y1, x2, y2) {
        return Math.sqrt((x1 - x2) * (x1 - x2) + (y1 - y2) * (y1 - y2));
    };

    function createCycle(pts) {
        // Smooth angles
        var l = 40,
            cur, next, prev, res = [],
            anglePrev, angleNext;
        for (var i = 0; i < pts.length; i++) {
            cur = pts[i];
            next = pts[(i + 1) % pts.length];
            prev = pts[(i - 1 + pts.length) % pts.length];
            anglePrev = Math.atan2(prev.y - cur.y, prev.x - cur.x);
            angleNext = Math.atan2(next.y - cur.y, next.x - cur.x);
            // Smooth before
            res.push({
                x: cur.x + l * Math.cos(anglePrev),
                y: cur.y + l * Math.sin(anglePrev)
            });
            res.push({
                x: cur.x + l * Math.cos(angleNext),
                y: cur.y + l * Math.sin(angleNext)
            });
        }
        // Linking points together
        for (var i = 0; i < res.length; i++) {
            res[i].next = res[(i + 1) % res.length];
        }
        return res[0];
    };

    function newCar(color, noLights) {
        return cache(52, 24, function(c, r) {
            with(r) {
                var b = r;
                fs('rgba(0,0,0,1)');
                fr(0, 0, c.width, c.height);
                tr((c.width - 50) / 2, (c.height - 22) / 2);
                fs(color);
                fr(0, 0, 50, 22);
                fs('#000');
                fr(10, 3, 5, 16);
                fr(30, 3, 10, 16);
                fr(15, 1, 7, 1);
                fr(23, 1, 7, 1);
                fr(15, 20, 7, 1);
                fr(23, 20, 7, 1);
                if (!noLights) {
                    fs('#ff0');
                    fr(48, 0, 2, 3);
                    fr(48, 19, 2, 3);
                    fs('#f00');
                    fr(0, 0, 2, 3);
                    fr(0, 19, 2, 3);
                }
            }
        });
    };
    var P = {
        w: 700,
        h: 550,
        v: 130
    };

    function Game() {
        window.rotation = true;
        this.can = document.querySelector('canvas');
        with(this.can) {
            var b = this.can;
            width = P.w;
            height = P.h;
        }
        this.ctx = window.c = this.can.getContext('2d');
        this.start();
        // Resizing
        //this.resize();
        //addEventListener('resize', this.resize, false);
        addEventListener('keydown', this.keyDown.bind(this), false);
        addEventListener('keyup', this.keyUp.bind(this), false);
        // Loop
        this.lastFrame = Date.now();
        raf(function() {
            G.cycle();
            raf(arguments.callee);
        });
        this.elapsedList = [];
        this.frameCount = 0;
        this.frameCountStart = Date.now();
    };
    Game.prototype = {
        start: function() {
            this.world = new World();
            this.menu = new Home();
        },
        restart: function() {
            this.world = new World();
            this.menu = null;
        },
        gameOver: function() {
            this.menu = new End();
        },
        cycle: function() {
            sv();
            sc(this.resolution, this.resolution);
            var n = Date.now(),
                e = (n - this.lastFrame) / 1000;
            //e = M.min(e, 1 / 30);
            this.lastFrame = n;
            this.world.cycle(e);
            if (this.menu) {
                this.menu.cycle(e);
            }
            Easing.cycle(e);
            this.frameCount++;
            if (this.frameCount === 200) {
                var totalTime = Date.now() - this.frameCountStart;
                var fps = this.frameCount / (totalTime / 1000);
                if (fps < 30) {
                    this.setResolution(.6);
                }
            }
            /*fillStyle = '#fff';
            font = '20pt Arial';
            textBaseline = 'top';
            textAlign = 'left';
            ft(~~(1 / e) + 'fps', 10, 10);

            this.elapsedList.push(e);
            if(this.elapsedList.length > 100){
                this.elapsedList.shift();
            }

            c.fillStyle = '#000';
            c.strokeStyle = '#fff';
            c.fr(0, 0, this.elapsedList.length * 2, 100);
            c.strokeRect(0, 0, this.elapsedList.length * 2, 100);

            var fps;
            c.strokeStyle = '#fff'
            c.beginPath();
            for(var i = 0, x = 0 ; i < this.elapsedList.length ; i++, x+=2){
                fps = ~~(1 / this.elapsedList[i]);
                //c.fr(x, 100 - (fps / 60) * 100, 2, 2);
                c.lineTo(x, 100 - (fps / 60) * 100);
            }
            c.stroke();*/
            rs();
        },
        newWorld: function() {
            this.world = new World();
        },
        /*resize : function(){
            to(function(){
                var maxWidth = innerWidth,
                    maxHeight = innerHeight,

                    availableRatio = maxWidth / maxHeight,
                    baseRatio = P.w / P.h,
                    ratioDifference = abs(availableRatio - baseRatio),
                    width,
                    height,
                    s = document.getElementById('canvascontainer').style;

                if(availableRatio <= baseRatio){
                    width = maxWidth;
                    height = width / baseRatio;
                }else{
                    height = maxHeight;
                    width = height * baseRatio;
                }

                s.width = width + 'px';
                s.height = height + 'px';
            },100);
        },*/
        keyDown: function(e) {
            if (e.keyCode == 32 || e.keyCode == 40 || e.keyCode == 38)
                e.preventDefault();
            if (e.keyCode == 82)
                window.rotation = !window.rotation;
            if (this.menu)
                return this.menu.keyDown(e.keyCode);
            this.world.keyDown(e.keyCode);
        },
        keyUp: function(e) {
            if (this.menu)
                return;
            this.world.keyUp(e.keyCode);
        },
        setResolution: function(r) {
            this.can.width = P.w * r;
            this.can.height = P.h * r;
            this.resolution = r;
        }
    };

    function World() {
        wld = this;
        this.score = 0;
        this.particles = [];
        this.cars = [];
        this.buildings = [];
        this.clients = [];
        this.clientSpots = [];
        this.textures = [];
        this.trails = [];
        this.down = {};
        this.t = 0;
        var w = 8000,
            h = 8000,
            bt = 100;
        //this.addBuilding(new Building(-bt, 0, bt, h));
        //this.addBuilding(new Building(w, 0, bt, h));
        //this.addBuilding(new Building(0, -bt, w, bt));
        //this.addBuilding(new Building(0, h, w, bt));
        var bs = 300;
        var sw = 300;
        var cellSize = 900,
            swSize = 50,
            roadSize = 200,
            xwSize = 50;
        var building = function(x, y, w, h, b) {};
        var park = function(x, y, w, h, b) {
            var tex = new Texture(grass, x, y, w, h);
            wld.textures.push(tex);
            // I'm lazy so I'm adding an invisible building to get cycles and shit
            b.visible = false;
            b.collides = false;
            for (var i = 0; i < 10; i++) {
                var t = new Tree(tex.x + ~~rd(0, tex.w), tex.y + ~~rd(0, tex.h));
                wld.buildings.push(t);
            }
        };
        var lot = function(x, y, w, h, b) {
            var tex = new Texture(parking, x, y, w, h);
            wld.textures.push(tex);
            // I'm lazy so I'm adding an invisible building to get cycles and shit
            b.visible = false;
            b.collides = false;
            // Exits
            wld.textures.push(new Texture(road, tex.x - swSize, tex.y + swSize * 2, swSize, swSize * 2));
            wld.textures.push(new Texture(road, tex.x + tex.w, tex.y + swSize * 2, swSize, swSize * 2));
            wld.textures.push(new Texture(road, tex.x - swSize, tex.y + tex.h - swSize * 4, swSize, swSize * 2));
            wld.textures.push(new Texture(road, tex.x + tex.w, tex.y + tex.h - swSize * 4, swSize, swSize * 2));
            // Random cars
            var positions = [];
            for (var x = tex.x + swSize / 2; x < tex.x + tex.w - swSize / 2; x += swSize) {
                for (var y = tex.y + swSize; y < tex.y + tex.h; y += parking.height) {
                    positions.push({
                        x: x,
                        y: y
                    });
                    positions.push({
                        x: x,
                        y: y + swSize * 4
                    });
                }
            }
            for (var i = 0; i < 10; i++) {
                var ind = ~~rd(positions.length);
                var pos = positions[ind];
                positions.splice(ind, 1);
                var s = parking.width / 2;
                var c = new Enemy();
                c.x = pos.x;
                c.y = pos.y;
                c.rotation = rp([M.PI / 2, -M.PI / 2]);
                wld.addCar(c);
            }
        };
        var cell = function(x, y, w, h) {
            // First, adding a sidewalk
            var tex = new Texture(sidewalk, x - swSize, y - swSize, w + 2 * swSize, h + 2 * swSize);
            wld.textures.push(tex);
            var b = new Building(x, y, w, h);
            wld.buildings.push(b);
            // Then, random type of area
            var type = rp([park, park, building, building, building, lot]);
            type(x, y, w, h, b);
        };
        var cols = 10,
            rows = 10;
        for (var row = 0; row <= rows; row++) {
            for (var col = 0; col <= cols; col++) {
                // Crosswalks
                wld.textures.push(new Texture(xwalkv, col * cellSize - roadSize / 2 - xwSize, row * cellSize -
                    roadSize / 2, xwSize, roadSize));
                wld.textures.push(new Texture(xwalkv, col * cellSize + roadSize / 2, row * cellSize - roadSize / 2,
                    xwSize, roadSize));
                wld.textures.push(new Texture(xwalkh, col * cellSize - roadSize / 2, row * cellSize - roadSize / 2 -
                    xwSize, roadSize, xwSize));
                wld.textures.push(new Texture(xwalkh, col * cellSize - roadSize / 2, row * cellSize + roadSize / 2,
                    roadSize, xwSize));
                // Road lines
                wld.textures.push(new Texture(hline, col * cellSize + roadSize / 2 + xwSize, row * cellSize - hline
                    .height / 2, cellSize - roadSize - xwSize * 2, hline.height));
                wld.textures.push(new Texture(vline, col * cellSize - vline.width / 2, row * cellSize + roadSize / 2 +
                    xwSize, vline.width, cellSize - roadSize - xwSize * 2));
            }
        }
        var double = false;
        for (var row = 0; row < rows; row++) {
            for (var col = 0; col < cols; col++) {
                double = !double && col < cols - 1 && Math.random() < .5;
                var x = col * cellSize + swSize + roadSize / 2;
                var y = row * cellSize + swSize + roadSize / 2;
                var w = cellSize - 2 * swSize - roadSize;
                var h = cellSize - 2 * swSize - roadSize;
                if (double) {
                    w = w * 2 + roadSize + 2 * swSize;
                    col++;
                }
                cell(x, y, w, h);
            }
        }
        // water
        var sizes = [
            [-roadSize / 2 - swSize, -roadSize / 2 - swSize, cols * cellSize + 4000, -2000],
            [-roadSize / 2 - swSize, rows * cellSize + roadSize / 2 + swSize, cols * cellSize + 4000, 2000],
            [-roadSize / 2 - swSize, -roadSize / 2 - 2000, -2000, rows * cellSize + 6000],
            [cols * cellSize + roadSize / 2 + swSize, -roadSize / 2 - 2000, 2000, rows * cellSize + 6000]
        ];
        sizes.forEach(function(s) {
            var b = new Building(s[0], s[1], s[2], s[3]);
            b.visible = false;
            wld.buildings.push(b);
            wld.textures.push(new Texture(water, s[0], s[1], s[2], s[3]));
        });
        // Surround with sidewalks
        this.textures.push(new Texture(sidewalk, -roadSize / 2 - swSize, -roadSize / 2 - swSize, cols * cellSize + 2 *
            swSize + roadSize, swSize));
        this.textures.push(new Texture(sidewalk, -roadSize / 2 - swSize, rows * cellSize + roadSize / 2, cols *
            cellSize + 2 * swSize + roadSize, swSize));
        this.textures.push(new Texture(sidewalk, -roadSize / 2 - swSize, -roadSize / 2 - swSize, swSize, rows *
            cellSize + 2 * swSize + roadSize));
        this.textures.push(new Texture(sidewalk, cols * cellSize + roadSize / 2, -roadSize / 2 - swSize, swSize, rows *
            cellSize + 2 * swSize + roadSize));
        this.player = this.addCar(new Player());
        this.player.x = cols / 2 * cellSize,
            this.player.y = rows / 2 * cellSize;
        this.camX = this.player.x - P.w / 2;
        this.camY = this.player.y - P.h / 2;
        this.camRotation = 0;
        for (var i = 0; i < this.buildings.length - 4; i++) {
            var b = this.buildings[i];
            if (b.visible && b.collides || !b.visible && !b.collides) {
                var cycle = b.getCycle();
                if (cycle) {
                    var enemy = this.addCar(new Enemy());
                    enemy.x = cycle.x;
                    enemy.y = cycle.y;
                    enemy.follow(cycle);
                }
                this.clientSpots = this.clientSpots.concat(b.getCorners(25));
            }
        }
        this.nextClientSpawn = 0;
        this.timeleft = 180;
    };
    World.prototype = {
        cycle: function(e) {
            this.t += e;
            this.nextClientSpawn -= e;
            if (this.nextClientSpawn <= 0) {
                this.respawnClients();
                this.nextClientSpawn = 5;
            }
            // Background
            fs(road);
            fr(0, 0, P.w, P.h);
            for (var i in this.cars) {
                this.cars[i].cycle(e);
            }
            // TODO handle camera
            //var angle = !this.player.dead ? this.player.moveAngle : this.player.moveAngle + M.PI;
            //var idealX = this.player.x - P.w / 2 + M.cos(angle) * this.player.speed * .4;
            //var idealY = this.player.y - P.h / 2 + M.sin(angle) * this.player.speed * .4;
            //idealX = wld.player.x - P.w / 2 + M.cos(angle) * this.player.speed * .4;
            //idealY = wld.player.y - P.h / 2 + M.sin(angle) * this.player.speed * .4;
            var camSpeed = !this.player.dead ? 600 : 100;
            //var distance = dist(idealX, idealY, this.camX, this.camY);
            //var appliedDistance = limit(distance, -camSpeed * e, camSpeed * e);
            //var angle = Math.atan2(idealY - this.camY, idealX - this.camX);
            //this.camX += Math.cos(angle) * appliedDistance;
            //this.camY += Math.sin(angle) * appliedDistance;
            this.camX = wld.player.x - P.w / 2 + M.cos(wld.player.moveAngle) * 100;
            this.camY = wld.player.y - P.h / 2 + M.sin(wld.player.moveAngle) * 100;
            if (this.shakeTime > 0) {
                this.camX += rd(-10, 10);
                this.camY += rd(-10, 10);
            }
            //this.camX = idealX;
            //this.camY = idealX;
            var idealRotation = -this.player.rotation - M.PI / 2;
            var diff = idealRotation - this.camRotation;
            diff = normalizeAngle(diff);
            var rotationSpeed = M.max(abs(diff) / M.PI, .01) * M.PI * 2;
            diff = limit(diff, -rotationSpeed * e, rotationSpeed * e);
            this.camRotation += diff;
            this.shakeTime -= e;
            sv();
            if (window.rotation) {
                tr(P.w / 2, P.h / 2);
                rotate(this.camRotation);
                tr(-P.w / 2, -P.h / 2);
            }
            tr(-~~this.camX, -~~this.camY);
            fs(road);
            fr(~~this.camX, ~~this.camY, P.w, P.h);
            var sw = 50;
            for (var i in this.textures) {
                this.textures[i].render();
            }
            /*for(var i in this.trails){
                this.trails[i].render();
            }*/
            for (var i in this.clients) {
                this.clients[i].cycle(e);
            }
            for (var i = this.cars.length - 1; i >= 0; i--) {
                this.cars[i].render();
            }
            for (var i = this.particles.length - 1; i >= 0; i--) {
                this.particles[i].render();
            }
            for (var i in this.buildings) {
                this.buildings[i].render();
            }
            this.player.render2();
            rs();
            if (!G.menu) {
                this.player.hud.cycle(e);
                if (!this.player.client) {
                    this.timeleft -= e;
                    if (this.timeleft <= 0) {
                        G.gameOver();
                    }
                }
            }
            if (this.player.x < -this.roadSize / 2) {
                this.player.explode();
            }
        },
        keyUp: function(k) {
            this.down[k] = 0;
            this.evalKeyboardMovement();
        },
        keyDown: function(k) {
            this.down[k] = true;
            this.evalKeyboardMovement();
        },
        evalKeyboardMovement: function() {
            this.player.rotationDir = 0;
            this.player.accelerates = false;
            this.player.brakes = false;
            if (this.down[37]) {
                this.player.rotationDir = -1;
            }
            if (this.down[39]) {
                this.player.rotationDir = 1;
            }
            if (this.down[38]) {
                this.player.accelerates = true;
            }
            if (this.down[40]) {
                this.player.brakes = true;
            }
            if (this.down[32]) {
                G.start();
            }
        },
        addParticle: function(p) {
            this.particles.push(p);
        },
        removeParticle: function(p) {
            var ind = this.particles.indexOf(p);
            if (ind >= 0)
                this.particles.splice(ind, 1);
        },
        /*addTrail: function(p){
            this.trails.push(p);
        },
        removeTrail: function(p){
            var ind = this.trails.indexOf(p);
            if(ind >= 0) this.trails.splice(ind, 1);
        },*/
        addBuilding: function(b) {
            this.buildings.push(b);
            return b;
        },
        addCar: function(c) {
            this.cars.push(c);
            return c;
        },
        removeCar: function(c) {
            var i = this.cars.indexOf(c);
            if (i >= 0) {
                this.cars.splice(i, 1);
            }
        },
        addClient: function(c) {
            this.clients.push(c);
            return c;
        },
        removeClient: function(c) {
            var i = this.clients.indexOf(c);
            if (i >= 0)
                this.clients.splice(i, 1);
        },
        getRandomDestination: function() {
            return rp(this.clientSpots);
        },
        respawnClients: function() {
            var minD = M.max(P.w, P.h);
            var maxD = M.max(P.w, P.h) * 2;
            for (var i = this.clients.length - 1; i >= 0; i--) {
                var client = this.clients[i];
                var d = dist(client.x, client.y, this.camX + P.w / 2, this.camY + P.h / 2);
                if (d > maxD) {
                    this.clients.splice(i, 1);
                }
            }
            var potential = [];
            for (var i = 0; i < this.clientSpots.length; i++) {
                var spot = this.clientSpots[i];
                var d = dist(spot.x, spot.y, this.camX + P.w / 2, this.camY + P.h / 2);
                if (d < maxD && d > minD) {
                    potential.push(spot);
                }
            }
            var target = 10;
            while (potential.length > 0 && this.clients.length < target) {
                var ind = ~~rd(potential.length);
                var spot = potential[ind];
                potential.splice(ind, 1);
                var client = this.addClient(new Client());
                client.x = spot.x;
                client.y = spot.y;
            }
        },
        findClosestClientSpot: function(x, y) {
            var spot, minDist, d, closest;
            for (var i = 0; i < this.clientSpots.length; i++) {
                spot = this.clientSpots[i];
                d = dist(spot.x, spot.y, x, y);
                if (!closest || d < minDist) {
                    closest = spot;
                    minDist = d;
                }
            }
            return closest;
        },
        shake: function() {
            this.shakeTime = .5;
        }
    };

    function Menu() {
        this.alpha = 0;
        Easing.tween(this, 'alpha', 0, 1, .5);
    }
    Menu.prototype = {
        cycle: function(e) {
            alpha(this.alpha);
            fs('rgba(0,0,0,.7)');
            fr(0, 0, P.w, P.h);
        }
    };

    function Home(g) {
        Menu.call(this);
    }
    Home.prototype = xt(Menu.prototype, {
        cycle: function(e) {
            Menu.prototype.cycle.call(this, e);
            var t = 'taxi drift',
                w = textWidth(t);
            drawText(c, t, 'white', (P.w - w) / 2, 80, 1, 1);
            t = 'find customers and drive them';
            w = textWidth(t, .5);
            drawText(c, t, 'white', (P.w - w) / 2, 200, .5, 1);
            t = 'to their destination';
            w = textWidth(t, .5);
            drawText(c, t, 'white', (P.w - w) / 2, 250, .5, 1);
            t = 'press enter to start';
            w = textWidth(t, .5);
            drawText(c, t, 'white', (P.w - w) / 2, 350, .5, 1);
            t = 'press r to toggle rotation';
            w = textWidth(t, .5);
            drawText(c, t, 'white', (P.w - w) / 2, 400, .5, 1);
            t = 'press space to restart game';
            w = textWidth(t, .5);
            drawText(c, t, 'white', (P.w - w) / 2, 450, .5, 1);
            alpha(1);
        },
        keyDown: function(k) {
            if (k === 13)
                G.menu = null;
        }
    });

    function End(s) {
        Menu.call(this);
    }
    End.prototype = xt(Menu.prototype, {
        cycle: function(e) {
            Menu.prototype.cycle.call(this, e);
            var t = 'game over',
                w = textWidth(t);
            drawText(c, t, 'white', (P.w - w) / 2, 80, 1, 1);
            var t = 'you served ' + wld.player.dropoffs + ' customers',
                w = textWidth(t, .5);
            drawText(c, t, 'white', (P.w - w) / 2, 200, .5, 1);
            var t = 'and collected $' + wld.player.cash,
                w = textWidth(t, .5);
            drawText(c, t, 'white', (P.w - w) / 2, 250, .5, 1);
            var t = 'press enter to try again',
                w = textWidth(t, .5);
            drawText(c, t, 'white', (P.w - w) / 2, 480, .5, 1);
            alpha(1);
        },
        keyDown: function(k) {
            if (k === 13)
                G.restart();
        }
    });

    function Car() {
        this.l = 50;
        this.w = 30;
        this.x = 0;
        this.y = 0;
        this.rotation = 0;
        this.speed = 0;
        this.rotationSpeed = M.PI;
        this.rotationDir = 0;
        this.vectors = [];
        this.accelerates = false;
        this.brakes = false;
        this.maxSpeed = 500;
        this.drifts = true;
        this.t = 0;
        this.maxAcceleration = 400;
        this.maxDeceleration = 100000;
        this.maxDeceleration = 400;
        this.speedVector = {};
        this.moveAngle = 0;
        this.moveAngleSpeed = M.PI * 1.5;
        this.radius = 10;
        this.carType = rp([
            car.white,
            car.blue,
            car.red,
            car.green,
            car.purple,
            car.gray
        ]);
    }
    Car.prototype = {
        cycle: function(e) {
            this.t += e;
            if (this.dead) {
                return;
            }
            var oppositeAngle = this.rotation + Math.PI;
            var speedRatio = limit(1 - this.speed / this.maxSpeed, .5, 1);
            var angleDiff = normalizeAngle(this.rotation - this.moveAngle);
            var appliedDiff = limit(angleDiff, -this.moveAngleSpeed * speedRatio * e, this.moveAngleSpeed *
                speedRatio * e);
            this.moveAngle += this.drifts ? appliedDiff : angleDiff;
            var r = limit(this.speed * 3 / this.maxSpeed, -1, 1);
            this.rotation += this.rotationSpeed * e * this.rotationDir * r;
            this.x += this.speed * M.cos(this.moveAngle) * e;
            this.y += this.speed * M.sin(this.moveAngle) * e;
            var targetSpeed = 0,
                opposite = false;
            if (this.accelerates) {
                targetSpeed = this.maxSpeed;
                if (this.speed < 0)
                    opposite = true;
            } else if (this.brakes) {
                targetSpeed = -this.maxSpeed / 2;
                if (this.speed > 0)
                    opposite = true;
            }
            var diff = targetSpeed - this.speed;
            var acc = opposite ? this.maxAcceleration * 2 : this.maxAcceleration;
            diff = limit(diff, -e * acc, e * acc);
            this.speed += diff;
            //return;
            //
            //var acceleration = this.accelerates ? this.maxAcceleration : -this.maxDeceleration;
            //this.speed = limit(this.speed + acceleration * e, 0, this.maxSpeed);
            // Turning "opposition"
            var opposition = abs(normalizeAngle(this.rotation - this.moveAngle)) / M.PI;
            this.speed = limit(this.speed - opposition * e * this.maxDeceleration * 2, -this.maxSpeed, this
                .maxSpeed);
        },
        render: function() {
            sv();
            tr(this.x, this.y);
            rt(this.rotation);
            var img = this.dead ? brokenCar : this.carType;
            di(img, -img.width / 2, -img.height / 2);
            rs();
        },
        explode: function() {
            this.dead = true;
            for (var i = 0; i < 40; i++) {
                var c = rp(['#ff0', '#f00', '#ff8400', '#000']);
                var p = new Particle(5, c);
                p.x = this.x + rd(-5, 5);
                p.y = this.y + rd(-5, 5);
                wld.addParticle(p);
                var a = rd(M.PI * 2),
                    d = rd(20, 100),
                    t = rd(.5, 1);
                Easing.tween(p, 'x', p.x, p.x + M.cos(a) * d, t);
                Easing.tween(p, 'y', p.y, p.y + M.sin(a) * d, t);
                Easing.tween(p, 'a', 1, 0, t);
                Easing.tween(p, 's', p.s, p.s * rd(5, 10), t, 0, linear, function() {
                    wld.removeParticle(p);
                });
            }
        },
        collidesWith: function(c) {
            return dist(c.x, c.y, this.x, this.y) < this.radius + c.radius;
        }
    };

    function Player() {
        Car.call(this);
        this.carType = car.yellow;
        this.client = null;
        this.hud = new HUD();
        this.lastGoodPosition = null;
        this.nextGoodPosition = null;
        this.nextGoodPositionTimer = 0;
        this.cash = 0;
        this.lives = 3;
        this.dropoffs = 0;
    }
    Player.prototype = xt(Car.prototype, {
        cycle: function(e) {
            var tmpX = this.x,
                tmpY = this.y,
                tmpAngle = this.rotation;
            this.noControlTimer -= e;
            if (this.noControlTimer >= 0) {
                this.accelerates = false;
                this.rotationDir = 0;
            }
            Car.prototype.cycle.call(this, e);
            if (this.dead)
                return;
            this.nextGoodPositionTimer -= e;
            if (this.nextGoodPositionTimer <= 0) {
                this.lastGoodPosition = this.nextGoodPosition;
                this.nextGoodPosition = {
                    x: this.x,
                    y: this.y
                };
                this.nextGoodPositionTimer = .1;
            }
            if (this.accelerates && this.speed < 400 || this.brakes && this.speed > -200 ||
                abs(this.speed) > 20 && abs(normalizeAngle(this.rotation - this.moveAngle)) > Math.PI / 8) {
                var posOnLine = -this.l / 2;
                var p = new Particle(5, '#fff');
                p.x = this.x + M.cos(this.rotation) * posOnLine + rd(-5, 5);
                p.y = this.y + M.sin(this.rotation) * posOnLine + rd(-5, 5);
                wld.addParticle(p);
                var d = 100,
                    t = rd(.3, .6),
                    a = this.rotation + M.PI + rd(-M.PI / 32, M.PI / 32);
                //Easing.tween(p, 'x', p.x, p.x + M.cos(a) * d, t);
                //Easing.tween(p, 'y', p.y, p.y + M.sin(a) * d, t);
                Easing.tween(p, 'a', 1, 0, t);
                Easing.tween(p, 's', p.s, p.s * rd(5, 10), t, 0, linear, function() {
                    wld.removeParticle(this);
                });
                /*var split = 10;
                var t1 = new Trail(
                    this.x + M.cos(this.rotation + M.PI / 2) * split,
                    this.y + M.sin(this.rotation + M.PI / 2) * split,
                    tmpX + M.cos(tmpAngle + M.PI / 2) * split,
                    tmpY + M.sin(tmpAngle + M.PI / 2) * split
                );
                wld.addTrail(t1);
                var t2 = new Trail(
                    this.x + M.cos(this.rotation - M.PI / 2) * split,
                    this.y + M.sin(this.rotation - M.PI / 2) * split,
                    tmpX + M.cos(tmpAngle - M.PI / 2) * split,
                    tmpY + M.sin(tmpAngle - M.PI / 2) * split
                );
                wld.addTrail(t2);

                Easing.tween(t1, 'a', 1, 0, 1, 2, linear, function(){
                    wld.removeTrail(t1);
                });
                Easing.tween(t2, 'a', 1, 0, 1, 2, linear, function(){
                    wld.removeTrail(t2);
                });*/
            }
            // Collisions
            var me = this;
            wld.buildings.forEach(function(b) {
                if (!me.dead && b.collides && b.contains(me.x, me.y)) {
                    me.explode();
                }
            });
            wld.cars.forEach(function(c) {
                if (!me.dead && c !== me && !c.dead && c.collidesWith(me)) {
                    me.collided(c);
                }
            });
            // Client
            if (this.client) {
                this.clientTimeLeft = M.max(0, this.clientTimeLeft - e);
                var d = dist(this.x, this.y, this.clientSettings.destination.x, this.clientSettings
                    .destination.y);
                if (d < this.clientSettings.radius) {
                    if (this.speed === 0) {
                        this.drop();
                    }
                } else {
                    if (this.clientTimeLeft == 0 && this.speed < 100) {
                        this.drop();
                    }
                }
            }
        },
        render2: function() {
            if (this.clientSettings && !this.dead) {
                var r = (this.t % 1) * this.clientSettings.radius;
                alpha(.3);
                c.fillStyle = '#0f0';
                c.lineWidth = 4;
                c.strokeStyle = '#0f0';
                c.beginPath();
                c.arc(this.clientSettings.destination.x, this.clientSettings.destination.y, r, 0, 2 * M.PI,
                    true);
                c.fill();
                c.stroke();
                alpha(1);
                var d = dist(this.x, this.y, this.clientSettings.destination.x, this.clientSettings
                    .destination.y);
                var angle = M.atan2(this.clientSettings.destination.y - this.y, this.clientSettings
                    .destination.x - this.x);
                var arrowDist = limit(d / 10000, 0, 1) * 200 + 100;
                if (d > 300) {
                    sv();
                    tr(this.x + M.cos(angle) * arrowDist, this.y + M.sin(angle) * arrowDist);
                    c.rotate(angle);
                    di(arrow, -arrow.width / 2, -arrow.height / 2);
                    rs();
                }
            }
        },
        pickup: function(c) {
            if (!this.client) {
                this.client = c;
                this.clientSettings = c.getDestinationSettings();
                this.clientTimeLeft = this.clientSettings.time;
                wld.removeClient(c);
            }
        },
        drop: function() {
            // Drop the client on the side
            this.client.done = true;
            this.client.x = this.x + M.cos(this.rotation + M.PI / 2) * 40;
            this.client.y = this.y + M.sin(this.rotation + M.PI / 2) * 40;
            this.client.findSidewalk();
            wld.addClient(this.client);
            var d = dist(this.x, this.y, this.clientSettings.destination.x, this.clientSettings.destination
                .y);
            var price = d <= this.clientSettings.radius ? this.clientSettings.price : 0;
            if (price > 0) {
                this.hud.message('reward: $' + price);
                this.cash += price;
            } else {
                this.hud.message('too slow');
            }
            this.client = null;
            this.clientSettings = null;
            this.dropoffs++;
        },
        collided: function(c) {
            this.explode();
            c.explode();
            wld.removeCar(c);
            window.collider = c;
        },
        explode: function() {
            Car.prototype.explode.call(this);
            this.lives--;
            if (this.lives > 0) {
                setTimeout(this.respawn.bind(this), 2000);
            } else {
                // game over
                setTimeout(G.gameOver.bind(G), 2000);
            }
            wld.shake();
        },
        respawn: function() {
            this.hud.message('cars left: ' + this.lives);
            this.client = null;
            this.clientTimeLeft = 0;
            this.clientSettings = null;
            this.dead = false;
            this.x = this.lastGoodPosition.x;
            this.y = this.lastGoodPosition.y;
            this.speed = 0;
        }
    });

    function Enemy() {
        Car.call(this);
        this.path = null;
        this.maxSpeed = 100;
        this.distanceLeft = 0;
        this.drifts = false;
    }
    Enemy.prototype = xt(Car.prototype, {
        cycle: function(e) {
            this.accelerates = !!this.path;
            var a = M.atan2(wld.player.y - this.y, wld.player.x - this.x);
            var d = dist(wld.player.x, wld.player.y, this.x, this.y);
            if (abs(normalizeAngle(a - this.rotation)) < M.PI / 4 && d < 300) {
                this.accelerates = false;
            }
            if (this.path) {
                var targetAngle = M.atan2(this.path.y - this.y, this.path.x - this.x);
                var diff = normalizeAngle(targetAngle - this.rotation);
                diff = limit(diff, -this.rotationSpeed * e, this.rotationSpeed * e);
                this.rotation += diff;
                //this.moveAngle = targetAngle;
                if (dist(this.x, this.y, this.path.x, this.path.y) < e * this.speed) {
                    this.x = this.path.x;
                    this.y = this.path.y;
                    this.follow(this.path.next);
                }
            }
            Car.prototype.cycle.call(this, e);
        },
        follow: function(p) {
            this.path = p;
        }
    });

    function Client() {
        this.x = this.y = 0;
        this.done = false;
        this.type = rp([clientRed, clientBlue, clientBlack, clientYellow]);
    };
    Client.prototype = {
        cycle: function(e) {
            var d = dist(this.x, this.y, wld.player.x, wld.player.y);
            if (d < 200 &&
                !wld.player.dead &&
                wld.player.speed < 100 &&
                !this.done &&
                !wld.player.client) {
                this.target = null;
                if (d < 30 && wld.player.speed < 50) {
                    wld.player.pickup(this);
                } else {
                    // Approach
                    var diff = Math.min(50 * e, d);
                    this.x += M.cos(this.angle) * diff;
                    this.y += M.sin(this.angle) * diff;
                }
            } else if (!this.target) {
                this.findSidewalk();
            }
            if (this.target) {
                var d = dist(this.x, this.y, this.target.x, this.target.y);
                var diff = Math.min(50 * e, d);
                if (diff > 0) {
                    this.angle = M.atan2(this.target.y - this.y, this.target.x - this.x);
                    this.x += M.cos(this.angle) * diff;
                    this.y += M.sin(this.angle) * diff;
                }
            } else {
                this.angle = M.atan2(wld.player.y - this.y, wld.player.x - this.x);
            }
            var me = this;
            wld.cars.forEach(function(c) {
                var d = dist(me.x, me.y, c.x, c.y);
                if (d < 20 && abs(c.speed) > 20) {
                    me.die();
                }
            });
            this.render();
        },
        render: function() {
            sv();
            tr(this.x, this.y);
            rt(this.angle);
            di(this.type, -this.type.width / 2, -this.type.height / 2);
            rs();
        },
        getDestinationSettings: function() {
            var dest = wld.getRandomDestination();
            var dist = abs(this.x - dest.x) + abs(this.y - dest.y);
            var exigence = ~~rd(1, 4); // 1-3
            var pricePerPx = 1 / 100;
            var perfectTime = dist / wld.player.maxSpeed; // very best possible time
            var reasonableIdealTime = perfectTime * 4;
            var price = ~~((exigence / 3) * pricePerPx * dist);
            var time = (1 - exigence / 4) * reasonableIdealTime;
            return {
                destination: dest,
                exigence: exigence,
                time: time,
                price: M.max(5, price),
                radius: 200
            };
        },
        die: function() {
            wld.removeClient(this);
            for (var i = 0; i < 40; i++) {
                var p = new Particle(4, '#950000', 1);
                var a = rd(M.PI * 2);
                var d = rd(5, 25);
                var t = rd(.05, .2);
                p.x = this.x;
                p.y = this.y;
                wld.addParticle(p);
                Easing.tween(p, 'a', 1, 0, 1, 3, linear, p.remove.bind(p));
                Easing.tween(p, 'x', p.x, p.x + M.cos(a) * d, t);
                Easing.tween(p, 'y', p.y, p.y + M.sin(a) * d, t);
            }
            wld.player.hud.message('don\'t kill customers!');
        },
        findSidewalk: function() {
            var t = wld.findClosestClientSpot(this.x, this.y);
            this.target = {
                x: t.x + rd(-15, 15),
                y: t.y + rd(-15, 15)
            };
        }
    };

    function HUD() {
        this.msgT = 0;
    };
    HUD.prototype = {
        cycle: function(e) {
            this.msgT -= e;
            var m;
            if (wld.player.dead) {
                m = 'wasted';
            } else if (this.msgT > 0) {
                m = this.msg;
            } else if (wld.player.client) {
                var tl = M.ceil(M.max(0, wld.player.clientTimeLeft));
                m = 'customer time left: ' + tl;
            } else {
                m = 'find a customer';
            }
            var w = textWidth(m, .5);
            var x = (P.w - w) / 2,
                y = P.h / 2 + 200;
            //drawText(c, m, 'black', x, y + 5, .5);
            drawText(c, m, 'white', x, y, .5, 1);
            m = 'cash: $' + wld.player.cash;
            w = textWidth(m, .5);
            drawText(c, m, 'white', P.w - w - 20, 20, .5, 1);
            drawText(c, 'cars: ' + wld.player.lives, 'white', 20, 20, .5, 1);
            if (!wld.player.client) {
                m = 'time: ' + ~~(wld.timeleft);
                w = textWidth(m, .5);
                drawText(c, m, 'white', (P.w - w) / 2, 20, .5, 1);
            }
        },
        message: function(m) {
            this.msgT = 2;
            this.msg = m.toLowerCase();
        }
    };

    function Building(x, y, w, h) {
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        if (this.w < 0) {
            this.x += this.w;
            this.w = -this.w;
        }
        if (this.h < 0) {
            this.y += this.h;
            this.h = -this.h;
        }
        this.visible = true;
        this.collides = true;
    };
    Building.prototype = {
        render: function() {
            if (!this.visible)
                return;
            if (this.x > wld.camX + P.w + P.v ||
                this.y > wld.camY + P.h + P.v ||
                this.x + this.w < wld.camX - P.v ||
                this.y + this.h < wld.camY - P.v) {
                return;
            }
            var topLeft1 = {
                x: this.x,
                y: this.y
            };
            var topRight1 = {
                x: this.x + this.w,
                y: this.y
            };
            var bottomRight1 = {
                x: this.x + this.w,
                y: this.y + this.h
            };
            var bottomLeft1 = {
                x: this.x,
                y: this.y + this.h
            };
            var topLeft2 = this.pointUpperPosition(this.x, this.y);
            var topRight2 = this.pointUpperPosition(this.x + this.w, this.y);
            var bottomRight2 = this.pointUpperPosition(this.x + this.w, this.y + this.h);
            var bottomLeft2 = this.pointUpperPosition(this.x, this.y + this.h);
            var windowWidth = 25;
            // Bottom
            //shape([topLeft1, topRight1, bottomRight1, bottomLeft1], 'green');
            // Top
            //shape([topLeft2, topRight2, bottomRight2, bottomLeft2], '#6f6f6f');
            //shape([topLeft2, topRight2, bottomRight2, bottomLeft2], roof);
            var x = topLeft2.x,
                y = topLeft2.y,
                w = bottomRight2.x - topLeft2.x,
                h = bottomRight2.y - topLeft2.y,
                r = 20;
            sv();
            tr(x, y);
            // Border
            fs(roofb);
            fr(0, 0, w, h);
            // Main roof
            fs(roof);
            fr(r, r, w - 2 * r, h - 2 * r);
            rs();
            // Sides
            fs('#00f');
            // Left side
            if (topLeft2.x > topLeft1.x) {
                //shape([topLeft1, topLeft2, bottomLeft2, bottomLeft1], '#7e7e7e');
                shape([topLeft1, topLeft2, bottomLeft2, bottomLeft1], side1);
                var windows = this.h / (2 * windowWidth),
                    stepZ = .3,
                    stepY = this.h / windows;
                for (var z = stepZ / 2; z < 1; z += stepZ) {
                    for (var y = this.y + stepY / 2; y < this.y + this.h; y += stepY) {
                        var lower1 = this.pointUpperPosition(this.x, y - windowWidth / 2, z);
                        var upper1 = this.pointUpperPosition(this.x, y - windowWidth / 2, z + stepZ / 2);
                        var lower2 = this.pointUpperPosition(this.x, y + windowWidth / 2, z);
                        var upper2 = this.pointUpperPosition(this.x, y + windowWidth / 2, z + stepZ / 2);
                        shape([lower1, upper1, upper2, lower2], 'black');
                    }
                }
            }
            // Right side
            if (topRight2.x < topRight1.x) {
                //shape([topRight2, topRight1, bottomRight1, bottomRight2], '#7e7e7e');
                shape([topRight2, topRight1, bottomRight1, bottomRight2], side1);
                var windows = this.h / (2 * windowWidth),
                    stepZ = .3,
                    stepY = this.h / windows;
                for (var z = stepZ / 2; z < 1; z += stepZ) {
                    for (var y = this.y + stepY / 2; y < this.y + this.h; y += stepY) {
                        var lower1 = this.pointUpperPosition(this.x + this.w, y - windowWidth / 2, z);
                        var upper1 = this.pointUpperPosition(this.x + this.w, y - windowWidth / 2, z + stepZ /
                            2);
                        var lower2 = this.pointUpperPosition(this.x + this.w, y + windowWidth / 2, z);
                        var upper2 = this.pointUpperPosition(this.x + this.w, y + windowWidth / 2, z + stepZ /
                            2);
                        shape([lower1, upper1, upper2, lower2], 'black');
                    }
                }
            }
            // Top side
            if (topLeft2.y > topLeft1.y) {
                //shape([topLeft1, topLeft2, topRight2, topRight1], '#999999');
                shape([topLeft1, topLeft2, topRight2, topRight1], side2);
                var windows = this.w / (2 * windowWidth),
                    stepZ = .3,
                    stepX = this.w / windows;
                for (var z = stepZ / 2; z < 1; z += stepZ) {
                    for (var x = this.x + stepX / 2; x < this.x + this.w; x += stepX) {
                        var lower1 = this.pointUpperPosition(x - windowWidth / 2, this.y, z);
                        var upper1 = this.pointUpperPosition(x - windowWidth / 2, this.y, z + stepZ / 2);
                        var lower2 = this.pointUpperPosition(x + windowWidth / 2, this.y, z);
                        var upper2 = this.pointUpperPosition(x + windowWidth / 2, this.y, z + stepZ / 2);
                        shape([lower1, upper1, upper2, lower2], 'black');
                    }
                }
            }
            // Bottom side
            if (bottomLeft2.y < bottomLeft1.y) {
                //shape([bottomLeft1, bottomLeft2, bottomRight2, bottomRight1], '#999999');
                shape([bottomLeft1, bottomLeft2, bottomRight2, bottomRight1], side2);
                var windows = this.w / (2 * windowWidth),
                    stepZ = .3,
                    stepX = this.w / windows;
                for (var z = stepZ / 2; z < 1; z += stepZ) {
                    for (var x = this.x + stepX / 2; x < this.x + this.w; x += stepX) {
                        var lower1 = this.pointUpperPosition(x - windowWidth / 2, this.y + this.h, z);
                        var upper1 = this.pointUpperPosition(x - windowWidth / 2, this.y + this.h, z + stepZ /
                            2);
                        var lower2 = this.pointUpperPosition(x + windowWidth / 2, this.y + this.h, z);
                        var upper2 = this.pointUpperPosition(x + windowWidth / 2, this.y + this.h, z + stepZ /
                            2);
                        shape([lower1, upper1, upper2, lower2], 'black');
                    }
                }
            }
        },
        pointUpperPosition: function(x, y, prct) {
            if (isNaN(prct))
                prct = 1;
            var fromCenterX = x - (wld.camX + P.w / 2);
            var fromCenterY = y - (wld.camY + P.h / 2);
            return {
                x: x + (fromCenterX / P.h) * 200 * prct,
                y: y + (fromCenterY / P.h) * 200 * prct
            };
        },
        contains: function(x, y) {
            return x >= this.x - 10 &&
                y >= this.y - 10 &&
                x <= this.x + this.w + 10 &&
                y <= this.y + this.h + 10;
        },
        getCycle: function() {
            var cycle = createCycle(this.getCorners(100));
            var it = rd(8);
            for (var i = 0; i < it; i++) {
                cycle = cycle.next;
            }
            return cycle;
        },
        getCorners: function(r) {
            return [{
                    x: this.x - r,
                    y: this.y - r
                },
                {
                    x: this.x + this.w + r,
                    y: this.y - r
                },
                {
                    x: this.x + this.w + r,
                    y: this.y + this.h + r
                },
                {
                    x: this.x - r,
                    y: this.y + this.h + r
                }
            ];
        }
    };

    function Texture(t, x, y, w, h) {
        this.t = t;
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        if (this.w < 0) {
            this.x += this.w;
            this.w = -this.w;
        }
        if (this.h < 0) {
            this.y += this.h;
            this.h = -this.h;
        }
    }
    Texture.prototype = {
        render: function() {
            if (this.x > wld.camX + P.w + P.v ||
                this.y > wld.camY + P.h + P.v ||
                this.x + this.w < wld.camX - P.v ||
                this.y + this.h < wld.camY - P.v) {
                return;
            }
            sv();
            tr(this.x, this.y);
            fs(this.t);
            fr(0, 0, this.w, this.h);
            rs();
        }
    };
    var defs = {
        a: [
            [1, 1, 1],
            [1, , 1],
            [1, 1, 1],
            [1, , 1],
            [1, , 1]
        ],
        b: [
            [1, 1, 1],
            [1, , 1],
            [1, 1, ],
            [1, , 1],
            [1, 1, 1]
        ],
        c: [
            [1, 1, 1],
            [1, , ],
            [1, , ],
            [1, , ],
            [1, 1, 1]
        ],
        d: [
            [1, 1, 0],
            [1, , 1],
            [1, , 1],
            [1, , 1],
            [1, 1, 1]
        ],
        e: [
            [1, 1, 1],
            [1, , ],
            [1, 1, ],
            [1, , ],
            [1, 1, 1]
        ],
        f: [
            [1, 1, 1],
            [1, , ],
            [1, 1, ],
            [1, , ],
            [1, , ]
        ],
        g: [
            [1, 1, 1],
            [1, , ],
            [1, , ],
            [1, , 1],
            [1, 1, 1]
        ],
        h: [
            [1, , 1],
            [1, , 1],
            [1, 1, 1],
            [1, , 1],
            [1, , 1]
        ],
        i: [
            [1, 1, 1],
            [, 1, ],
            [, 1, ],
            [, 1, ],
            [1, 1, 1]
        ],
        j: [
            [, , 1],
            [, , 1],
            [, , 1],
            [1, , 1],
            [1, 1, 1]
        ],
        k: [
            [1, , 1],
            [1, , 1],
            [1, 1, ],
            [1, , 1],
            [1, , 1]
        ],
        l: [
            [1, , 0],
            [1, , ],
            [1, , ],
            [1, , ],
            [1, 1, 1]
        ],
        m: [
            [1, , 1],
            [1, 1, 1],
            [1, , 1],
            [1, , 1],
            [1, , 1]
        ],
        n: [
            [1, 1, 1],
            [1, , 1],
            [1, , 1],
            [1, , 1],
            [1, , 1]
        ],
        o: [
            [1, 1, 1],
            [1, , 1],
            [1, , 1],
            [1, , 1],
            [1, 1, 1]
        ],
        p: [
            [1, 1, 1],
            [1, , 1],
            [1, 1, 1],
            [1, , ],
            [1, , ]
        ],
        r: [
            [1, 1, 1],
            [1, , 1],
            [1, 1, ],
            [1, , 1],
            [1, , 1]
        ],
        s: [
            [1, 1, 1],
            [1, , ],
            [1, 1, 1],
            [, , 1],
            [1, 1, 1]
        ],
        '$': [
            [, , 1, , 0],
            [1, 1, 1, 1, 1],
            [1, , 1, , ],
            [1, 1, 1, 1, 1],
            [, , 1, , 1],
            [1, 1, 1, 1, 1],
            [, , 1, , ]
        ],
        t: [
            [1, 1, 1],
            [, 1, ],
            [, 1, ],
            [, 1, ],
            [, 1, ]
        ],
        u: [
            [1, , 1],
            [1, , 1],
            [1, , 1],
            [1, , 1],
            [1, 1, 1]
        ],
        v: [
            [1, , 1],
            [1, , 1],
            [1, , 1],
            [1, , 1],
            [, 1, ]
        ],
        w: [
            [1, , , , 1],
            [1, , , , 1],
            [1, , 1, , 1],
            [1, , 1, , 1],
            [, 1, , 1, ]
        ],
        x: [
            [1, , 1],
            [1, , 1],
            [, 1, ],
            [1, , 1],
            [1, , 1]
        ],
        y: [
            [1, , 1],
            [1, , 1],
            [1, 1, 1],
            [, 1, ],
            [, 1, ]
        ],
        '\'': [
            [1]
        ],
        '.': [
            [0],
            [0],
            [0],
            [0],
            [1]
        ],
        ' ': [
            [, 0],
            [, ],
            [, ],
            [, ],
            [, ]
        ],
        '-': [
            [, 0],
            [, ],
            [1, 1],
            [, ],
            [, ]
        ],
        ':': [
            [0],
            [1],
            [],
            [1],
            []
        ],
        '?': [
            [1, 1, 1],
            [, , 1],
            [, 1, 1],
            [, , ],
            [, 1, ]
        ],
        '!': [
            [, 1, ],
            [, 1, ],
            [, 1, ],
            [, , ],
            [, 1, ]
        ],
        '1': [
            [1, 1, 0],
            [, 1, ],
            [, 1, ],
            [, 1, ],
            [1, 1, 1]
        ],
        '2': [
            [1, 1, 1],
            [, , 1],
            [1, 1, 1],
            [1, , ],
            [1, 1, 1]
        ],
        '3': [
            [1, 1, 1],
            [, , 1],
            [, 1, 1],
            [, , 1],
            [1, 1, 1]
        ],
        '4': [
            [1, , 0],
            [1, , ],
            [1, , 1],
            [1, 1, 1],
            [, , 1]
        ],
        '5': [
            [1, 1, 1],
            [1, , ],
            [1, 1, ],
            [, , 1],
            [1, 1, ]
        ],
        '6': [
            [1, 1, 1],
            [1, , ],
            [1, 1, 1],
            [1, , 1],
            [1, 1, 1]
        ],
        '7': [
            [1, 1, 1],
            [, , 1],
            [, 1, ],
            [, 1, ],
            [, 1, ]
        ],
        '8': [
            [1, 1, 1],
            [1, , 1],
            [1, 1, 1],
            [1, , 1],
            [1, 1, 1]
        ],
        '9': [
            [1, 1, 1],
            [1, , 1],
            [1, 1, 1],
            [, , 1],
            [1, 1, 1]
        ],
        '0': [
            [1, 1, 1],
            [1, , 1],
            [1, , 1],
            [1, , 1],
            [1, 1, 1]
        ]
    };
    var Font = {};
    var createFont = function(color) {
        Font[color] = {};
        for (var i in defs) {
            var d = defs[i];
            Font[color][i] = cache(d[0].length * 10 + 10, d.length * 10, function(c, r) {
                r.fs(color);
                for (var i = 0; i < d.length; i++) {
                    for (var j = 0; j < d[i].length; j++) {
                        if (d[i][j]) {
                            r.fr(j * 10, i * 10, 10, 10);
                        }
                    }
                }
            });
        }
    };
    createFont('white');
    createFont('black');
    createFont('orange');
    var drawText = function(r, t, c, x, y, s, b) {
        s = s || 1;
        // Shadow
        if (b)
            drawText(r, t, 'black', x, y + 5, s, false);
        r.sv();
        r.tr(x, y);
        r.sc(s, s);
        x = 0;
        for (var i = 0; i < t.length; i++) {
            var ch = t.charAt(i),
                img = Font[c][ch];
            if (img) {
                r.di(img, x, 0);
                x += img.width;
            }
        }
        r.rs();
    };
    var textWidth = function(t, s) {
        var w = 0,
            i = t.length;
        while (i--) {
            var img = Font['white'][t.charAt(i)];
            w += img ? img.width : 0;
        }
        return w * (s || 1);
    };
    var s = 4,
        car = {
            white: newCar('#fff'),
            broken: newCar('#1b1b1b', true),
            yellow: newCar('#ff0'),
            blue: newCar('#00f'),
            red: newCar('#f00'),
            green: newCar('#0f0'),
            purple: newCar('#f0f'),
            gray: newCar('#6c6c6c'),
        },
        client = function(color) {
            return cache(20, 30, function(c, r) {
                r.fs(color);
                //r.beginPath();
                //r.arc(c.width / 2, c.height / 2, 9, 0, M.PI * 2, true);
                //r.fill();
                var w = 14,
                    h = 18;
                r.fr((c.width - w) / 2, (c.height - h) / 2, w, h);
                r.bp();
                r.arc(c.width / 2, c.height / 2 - 10, 4, 0, M.PI * 2, true);
                r.arc(c.width / 2, c.height / 2 + 10, 4, 0, M.PI * 2, true);
                r.fill();
                r.fs('#e99a79');
                r.bp();
                r.arc(c.width / 2, c.height / 2, 6, 0, M.PI * 2, true);
                r.fill();
                r.fs('#000');
                r.fr(c.width / 2 + 2, c.height / 2 - 3, 2, 2);
                r.fr(c.width / 2 + 2, c.height / 2 + 3, 2, -2);
            });
        },
        clientRed = client('#900'),
        clientBlack = client('#000'),
        clientBlue = client('#00f'),
        clientYellow = client('#880'),
        arrow = cache(40, 40, function(c, r) {
            with(r) {
                var b = r;
                tr(c.width / 2, c.height / 2);
                rotate(Math.PI / 2);
                tr(-c.width / 2, -c.height / 2);
                tr(0, c.height);
                sc(1, -1);
                fs('#fff');
                bp();
                mt(20, 40);
                lt(40, 20);
                lt(30, 20);
                lt(30, 0);
                lt(10, 0);
                lt(10, 20);
                lt(0, 20);
                fill();
            }
        }),
        brokenCar = cache(50, 22, function(c, r) {
            with(r) {
                var b = r;
                fs('#1b1b1b');
                fr(0, 0, 50, 22);
                fs('#000');
                fr(10, 3, 5, 16);
                fr(30, 3, 10, 16);
                fr(15, 1, 7, 1);
                fr(23, 1, 7, 1);
                fr(15, 20, 7, 1);
                fr(23, 20, 7, 1);
            }
        }),
        grass = cache(200, 200, function(c, r) {
            var s = 4;
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    r.fs('rgb(0,' + (128 + ~~rd(-50, 50)) + ', 0)');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        sidewalk = cache(100, 100, function(c, r) {
            var b = 8;
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var isBorder = x < b ||
                        y < b ||
                        x >= c.width - b ||
                        y >= c.height - b ||
                        x >= c.width / 2 - b && x <= c.width / 2 + b ||
                        y >= c.height / 2 - b && y <= c.height / 2 + b;
                    var v = (isBorder ? 80 : 100) + ~~rd(-10, 10);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        road = cache(200, 200, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var v = 40 + ~~rd(-10, 10);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        water = cache(100, 100, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    r.fs('rgb(0, ' + ~~(168 + ~~rd(-10, 10)) + ', 255)');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        xwalkh = cache(25, 50, function(c, r) {
            for (var x = ~~(c.width / 4); x < c.width * .75; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var v = 255 - ~~rd(10, 50);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        xwalkv = cache(50, 25, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = ~~(c.height / 4); y < c.height * .75; y += s) {
                    var v = 255 - ~~rd(10, 50);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern');
    roof = cache(100, 100, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var v = 100 + ~~rd(-10, 10);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        roofb = cache(100, 100, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var v = 50 + ~~rd(-10, 10);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        side1 = cache(100, 100, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var v = 128 + ~~rd(-5, 5);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        side2 = cache(100, 100, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var v = 153 + ~~rd(-5, 5);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        hline = cache(100, 4, function(c, r) {
            for (var x = c.width * .25; x < c.width * .75; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var v = 255 - ~~rd(10, 50);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        vline = cache(4, 100, function(c, r) {
            for (var y = c.height * .25; y < c.height * .75; y += s) {
                for (var x = 0; x < c.height; x += s) {
                    var v = 255 - ~~rd(10, 50);
                    r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                    r.fr(x, y, s, s);
                }
            }
        }, 'pattern'),
        tree = cache(200, 200, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var d = dist(c.width / 2, c.height / 2, x, y);
                    var f = d < c.width * .4 && Math.random() < .8;
                    if (f) {
                        var v = 50 + ~~rd(-25, 25);
                        r.fs('rgb(0, ' + v + ', 0)');
                        r.fr(x, y, s, s);
                    }
                }
            }
        }),
        tree2 = cache(150, 150, function(c, r) {
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var d = dist(c.width / 2, c.height / 2, x, y);
                    var f = d < c.width * .4 && Math.random() < .8;
                    if (f) {
                        var v = 50 + ~~rd(-25, 25);
                        r.fs('rgb(0, ' + v + ', 0)');
                        r.fr(x, y, s, s);
                    }
                }
            }
        }),
        parking = cache(100, 300, function(c, r) {
            r.fs(road);
            r.fillRect(0, 0, c.width, c.height);
            for (var x = 0; x < c.width; x += s) {
                for (var y = 0; y < c.height; y += s) {
                    var draw = y < s ||
                        y >= c.height - s ||
                        (x < s || x >= c.width - s || x >= c.width / 2 - s && x <= c.width / 2 + s) && (y < c
                            .height * .3 || y >= c.height * .7);
                    if (draw) {
                        var v = 255 - ~~rd(10, 50);
                        r.fs('rgb(' + v + ', ' + v + ', ' + v + ')');
                        r.fr(x, y, s, s);
                    }
                }
            }
        }, 'pattern');
    addEventListener('load', function() {
        G = new Game();
    });
    var tweens = [];

    function linear(t, b, c, d) {
        return (t / d) * c + b;
    };

    function easeOutBack(t, b, c, d, s) {
        if (s == undefined)
            s = 1.70158;
        return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b;
    };

    function easeOutBounce(t, b, c, d) {
        if ((t /= d) < (1 / 2.75)) {
            return c * (7.5625 * t * t) + b;
        } else if (t < (2 / 2.75)) {
            return c * (7.5625 * (t -= (1.5 / 2.75)) * t + .75) + b;
        } else if (t < (2.5 / 2.75)) {
            return c * (7.5625 * (t -= (2.25 / 2.75)) * t + .9375) + b;
        } else {
            return c * (7.5625 * (t -= (2.625 / 2.75)) * t + .984375) + b;
        }
    };
    var Easing = {
        tween: function(o, p, a, b, d, l, f, e) {
            tweens.push({
                o: o,
                p: p,
                a: a,
                b: b,
                d: d,
                l: l || 0,
                f: f || linear,
                e: e || noop,
                t: 0
            });
        },
        cycle: function(e) {
            var tw;
            for (var i = tweens.length - 1; i >= 0; i--) {
                tw = tweens[i];
                if (tw.l > 0) {
                    tw.l -= e;
                    tw.o[tw.p] = tw.a;
                } else {
                    tw.t = M.min(tw.d, tw.t + e);
                    tw.o[tw.p] = tw.f(tw.t, tw.a, tw.b - tw.a, tw.d);
                    if (tw.t == tw.d) {
                        tw.e.call(tw.o);
                        tweens.splice(i, 1);
                    }
                }
            }
        }
    };

    function Particle(s, c, a) {
        this.s = s;
        this.c = c;
        this.a = a;
    };
    Particle.prototype = {
        render: function(e) {
            alpha(this.a);
            fs(this.c);
            fr(this.x - this.s / 2, this.y - this.s / 2, this.s, this.s);
            alpha(1);
        },
        remove: function() {
            wld.removeParticle(this);
        }
    };

    function Tree(x, y) {
        this.x = x;
        this.y = y;
        this.collides = true;
    };
    Tree.prototype = xt(Building.prototype, {
        render: function() {
            if (this.x > wld.camX + P.w + 200 ||
                this.y > wld.camY + P.h + 200 ||
                this.x < wld.camX - 200 ||
                this.y < wld.camY - 200) {
                return;
            }
            var p1 = this.pointUpperPosition(this.x, this.y, .2);
            var p2 = this.pointUpperPosition(this.x, this.y, .4);
            c.strokeStyle = '#5a3900';
            c.lineWidth = 15;
            bp();
            mt(this.x, this.y);
            lt(p2.x, p2.y);
            stroke();
            di(tree, p1.x - tree.width / 2, p1.y - tree.height / 2);
            di(tree2, p2.x - tree2.width / 2, p2.y - tree2.height / 2);
        },
        contains: function(x, y) {
            return abs(x - this.x) < 15 &&
                abs(y - this.y) < 15;
        },
        getCycle: function() {
            return null;
        },
        getCorners: function(r) {
            return [];
        }
    });
</script>
