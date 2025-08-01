<style>
#draw {
  overflow: hidden;
  position: relative;
  top: 5%;
  left: 5%;
  transform: translateX(-5%) translateY(-5%);
  min-width: 100%;
  min-height: 100%;
}
#draw svg {
  min-height: 100vh;
}
#draw * {
  transform-origin: center;
  -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
  -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
  -webkit-animation-direction: alternate;
          animation-direction: alternate;
  -webkit-animation-duration: 20s;
          animation-duration: 20s;
}
#draw #land1 {
  transform: translateY(-10%) scale(1.3);
  -webkit-animation-name: anim1;
          animation-name: anim1;
}
#draw #land2,
#draw #whitesun {
  transform: translateY(-8%) scale(1.2);
  -webkit-animation-name: anim2;
          animation-name: anim2;
}
#draw #land3 {
  transform: translateY(-10%) scale(1.3);
  -webkit-animation-name: anim3;
          animation-name: anim3;
}
#draw #c-left1,
#draw #c-left2,
#draw #c-left3 {
  transform: translateX(-20%) translateY(-10%) scale(1.5);
  opacity: 0.01;
  -webkit-animation-name: anim4;
          animation-name: anim4;
}
#draw #c-right1,
#draw #c-right2,
#draw #c-right3 {
  transform: translateX(20%) translateY(-10%) scale(1.5);
  opacity: 0.01;
  -webkit-animation-name: anim5;
          animation-name: anim5;
}
#draw #baloons,
#draw #birds-paradise {
  transform: translateX(-5%) translateY(-5%) scale(1.2);
  -webkit-animation-name: anim6;
          animation-name: anim6;
}
#draw #birds {
  transform: translateX(5%) translateY(-5%) scale(1.2);
  -webkit-animation-name: anim7;
          animation-name: anim7;
}
#draw #sky {
  transform: translateY(30%);
  -webkit-animation-name: anim8;
          animation-name: anim8;
}
#draw #whitesun > path {
  opacity: 0.5;
  -webkit-animation-name: anim9;
          animation-name: anim9;
}
@-webkit-keyframes anim1 {
  from {
    transform: translateY(-10%) scale(1.3);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@keyframes anim1 {
  from {
    transform: translateY(-10%) scale(1.3);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@-webkit-keyframes anim2 {
  from {
    transform: translateY(-8%) scale(1.2);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@keyframes anim2 {
  from {
    transform: translateY(-8%) scale(1.2);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@-webkit-keyframes anim3 {
  from {
    transform: translateY(-10%) scale(1.3);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@keyframes anim3 {
  from {
    transform: translateY(-10%) scale(1.3);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@-webkit-keyframes anim4 {
  from {
    transform: translateX(-20%) translateY(-10%) scale(1.5);
    opacity: 0.01;
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
    opacity: 0.15;
  }
}
@keyframes anim4 {
  from {
    transform: translateX(-20%) translateY(-10%) scale(1.5);
    opacity: 0.01;
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
    opacity: 0.15;
  }
}
@-webkit-keyframes anim5 {
  from {
    transform: translateX(20%) translateY(-10%) scale(1.5);
    opacity: 0.01;
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
    opacity: 0.15;
  }
}
@keyframes anim5 {
  from {
    transform: translateX(20%) translateY(-10%) scale(1.5);
    opacity: 0.01;
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
    opacity: 0.15;
  }
}
@-webkit-keyframes anim6 {
  from {
    transform: translateX(-5%) translateY(-5%) scale(1.2);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@keyframes anim6 {
  from {
    transform: translateX(-5%) translateY(-5%) scale(1.2);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@-webkit-keyframes anim7 {
  from {
    transform: translateX(5%) translateY(-5%) scale(1.2);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@keyframes anim7 {
  from {
    transform: translateX(5%) translateY(-5%) scale(1.2);
  }
  to {
    transform: translateX(0%) translateY(0%) scale(1);
  }
}
@-webkit-keyframes anim8 {
  from {
    transform: translateY(30%);
  }
  to {
    transform: translateY(0%);
  }
}
@keyframes anim8 {
  from {
    transform: translateY(30%);
  }
  to {
    transform: translateY(0%);
  }
}
@-webkit-keyframes anim9 {
  from {
    opacity: 0.2;
  }
  to {
    opacity: 0.5;
  }
}
@keyframes anim9 {
  from {
    opacity: 0.2;
  }
  to {
    opacity: 0.5;
  }
}

</style>

<div id="draw"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 250 1000 563">
        <defs>
            <style>
                .cls-1,
                .cls-21,
                .cls-4,
                .cls-5 {
                    fill: #fff;
                }

                .cls-2 {
                    fill: url(#gradiant1);
                }

                .cls-3 {
                    opacity: 0.89;
                }

                .cls-4 {
                    opacity: 0.43;
                }

                .cls-5 {
                    opacity: 0.34;
                }

                .cloud {
                    fill: #fff4f7;
                    opacity: 0.16;
                }

                .cls-7 {
                    fill: #654877;
                }

                .cls-8 {
                    opacity: 0.69;
                }

                .cls-11,
                .cls-12,
                .cls-13,
                .cls-14,
                .cls-15,
                .cls-16,
                .cls-9 {
                    fill: #2d284f;
                }

                .cls-10 {
                    opacity: 0.49;
                }

                .cls-11 {
                    opacity: 0.96;
                }

                .cls-12 {
                    opacity: 0.92;
                }

                .cls-13 {
                    opacity: 0.9;
                }

                .cls-14 {
                    opacity: 0.62;
                }

                .cls-15 {
                    opacity: 0.58;
                }

                .cls-16 {
                    opacity: 0.56;
                }

                .cls-17 {
                    fill: #141023;
                }

                .cls-18 {
                    fill: url(#gradiant2);
                }

                .cls-19 {
                    filter: url(#blur);
                }

                .cls-20 {
                    fill: url(#gradiant3);
                }

                .cls-21 {
                    opacity: 0;
                }
            </style>
            <linearGradient id="gradiant1" x1="500" y1="10.35" x2="500" y2="710.44"
                gradientUnits="userSpaceOnUse">
                <stop offset="0.2" stop-color="#000000" />
                <stop offset="0.42" stop-color="#4d3870" />
                <stop offset="1" stop-color="#ff83a7" />
            </linearGradient>
            <radialGradient id="gradiant2" cx="500" cy="591.82" r="280.24" gradientUnits="userSpaceOnUse">
                <stop offset="0.13" stop-color="#f4457b" stop-opacity="0.5" />
                <stop offset="0.58" stop-color="#f2387b" stop-opacity="0.3" />
                <stop offset="0.98" stop-color="#f4377f" stop-opacity="0" />
            </radialGradient>
            <filter id="blur" name="blur">
                <feGaussianBlur stdDeviation="2" in="SourceGraphic" />
            </filter>
            <linearGradient id="gradiant3" x1="500" y1="357.2" x2="500" y2="257.62"
                gradientUnits="userSpaceOnUse">
                <stop offset="0" stop-color="#fff" stop-opacity="0" />
                <stop offset="0.2" stop-color="#fff" stop-opacity="0.5" />
                <stop offset="1" stop-color="#fff" />
            </linearGradient>
            <symbol id="star" data-name="star" viewBox="0 0 6.29 6.29">
                <path class="cls-1"
                    d="M6.29,3.14A7.21,7.21,0,0,0,3.14,6.29,5.76,5.76,0,0,0,0,3.14,5.34,5.34,0,0,0,3.14,0C3.41,1,4.4,2.08,6.29,3.14Z" />
            </symbol>
        </defs>
        <g id="sky">
            <polygon class="cls-2" points="0 0 0 250 0 811.21 1000 811.21 1000 250 1000 0 0 0" />
            <use width="6.29" height="6.29" transform="translate(926.11 321.87) scale(0.58)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(824.93 322.03) scale(0.42)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(566.38 251.11) scale(0.79)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(430.44 304.1) scale(0.3)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(318.23 362.89) scale(0.23)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(295.31 381.01) scale(0.22)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(292.33 388.81) scale(0.25)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(595.61 254.47) scale(0.68)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(815.69 237.29) scale(0.61)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(350.54 343.5) scale(0.23)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(398.14 317.17) scale(0.18)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(497.55 212.97) scale(0.27)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(314.79 350.86) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(454.16 294.69) scale(0.13)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(466.22 203.67) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(265.46 277.6) scale(0.52)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(369.38 124.26) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(333.22 286.4) scale(0.62)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(443.53 332.31) scale(0.35)"
                xlink:href="#star" />
            <g class="cls-3">
                <path class="cls-4"
                    d="M532.8-89.8a4.82,4.82,0,0,0-2.13,2.13,3.88,3.88,0,0,0-2.13-2.13,3.66,3.66,0,0,0,2.13-2.13C530.85-91.23,531.52-90.52,532.8-89.8Z"
                    transform="translate(0 250)" />
            </g>
            <use width="6.29" height="6.29" transform="translate(421.12 327.87) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(495.32 223.56) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(482.4 285.5) scale(0.14)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(223.75 356.41) scale(0.57)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(566.29 91.7) scale(0.36)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(506.9 268.62) scale(0.27)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(495.13 82.69) scale(0.58)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(320.91 140.14) scale(0.61)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(207.65 164.9) scale(0.02)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(349.66 74.71) scale(0.27)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(112.44 151.25) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(243.15 49.77) scale(0.52)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(221.64 66.62) scale(0.6)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(119.43 101.2) scale(0.31)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(217.08 32.75) scale(0.61)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(135.55 73.25) scale(0.5)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(65.38 89.77) scale(0.23)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(80.82 87.96) scale(0.24)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(80.7 91.04) scale(0.24)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(87.78 87.84) scale(0.26)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(87.65 90.8) scale(0.25)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(163.75 87.04) scale(0.61)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(195.78 92.07) scale(0.17)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(403.84 134.29) scale(0.55)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(610.24 93.51) scale(0.34)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(861.69 123.36) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(851.96 126.62) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(616.92 78.79) scale(0.3)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(540.44 113.79) scale(0.5)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(339.3 140.34) scale(0.67)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(193.91 155.06) scale(0.27)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(142.79 164.64) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(117.36 163.85) scale(0.5)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(167.7 170.85) scale(0.06)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(503.3 182.35) scale(0.36)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(520.65 134.41) scale(0.51)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(579.85 98.71) scale(0.62)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(492.64 168.07) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(482.35 278.07) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(161.28 234.41) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(130.38 241.58) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(132.21 238.87) scale(0.46)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(136.67 244.4) scale(0.46)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(429.82 334.32) scale(0.1)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(496.23 187.67) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(889.38 248.44) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(928.86 247.21) scale(0.8)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(863.74 239.93) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(862.72 234.8) scale(0.6)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(617.99 87.83) scale(0.32)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(491.9 226.46) scale(0.26)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(395.85 289.41) scale(0.51)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(154.62 285.38) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(111.14 178.76) scale(0.5)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(146.57 121.88) scale(0.58)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(158.48 101.65) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(12.56 170.23) scale(0.86)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(21.35 224.18) scale(0.89)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(112.43 402.48) scale(0.58)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(303.99 358.96) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(475.96 281.84) scale(0.3)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(152.51 336.89) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(107.76 375.93) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(267.99 403.04) scale(0.2)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(355.74 389.78) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(607.79 428.43) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(768.45 446.22) scale(0.52)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(853.77 404.25) scale(0.57)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(909.78 357.58) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(829.54 437.96) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(945.06 237.05) scale(0.88)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(987.07 59.05) scale(0.32)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(986.35 15.81) scale(0.31)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(912.79 111.05) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(871.67 174.87) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(861.02 57.9) scale(0.57)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(566.83 85.04) scale(0.32)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(573.54 82.15) scale(0.35)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(856.89 50.75) scale(0.66)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(234.79 62.84) scale(0.38)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(595.12 53.17) scale(0.33)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(862.53 158.4) scale(0.26)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(875.72 158.03) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(835.98 121.8) scale(0.29)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(680.03 97.94) scale(0.39)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(627.03 84.59) scale(0.4)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(620.62 80.99) scale(0.3)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(561.22 94.99) scale(0.31)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(506.31 159.76) scale(0.27)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(500.28 167.83) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(485.39 177.25) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(471.47 188.11) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(480.02 214.41) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(484.93 250.32) scale(0.16)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(493.46 255.67) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(203.62 142.17) scale(0.02)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(215 140.82) scale(0.23)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(302.5 124.44) scale(0.35)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(434.74 138.93) scale(0.54)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(490.79 147.65) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(516.93 122.28) scale(0.84)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(592.83 79.9) scale(0.46)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(608.3 82.1) scale(0.54)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(621.79 100.51) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(735.82 90.23) scale(0.37)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(857.94 96.38) scale(0.33)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(847.64 98.94) scale(0.35)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(834.29 88.05) scale(0.45)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(633.68 88.56) scale(0.4)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(603.73 70.56) scale(0.4)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(544.19 85.07) scale(0.44)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(497.94 140.93) scale(0.4)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(476.43 148.31) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(468.52 144.41) scale(0.51)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(514.95 104.05) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(631.39 54.67) scale(0.37)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(675.41 49.73) scale(0.5)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(667.99 51.65) scale(0.47)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(685.01 44.03) scale(0.56)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(639.29 41.57) scale(0.54)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(482.07 44.88) scale(0.68)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(397.76 51.32) scale(0.41)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(433.65 51.26) scale(0.68)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(541.61 31.93) scale(0.39)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(644.66 35.38) scale(0.6)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(565.62 35.35) scale(0.34)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(359.69 48.32) scale(0.31)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(297.93 47.31) scale(0.36)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(290.86 46.94) scale(0.37)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(341.98 40.9) scale(0.32)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(382.18 39.37) scale(0.4)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(299.46 36.94) scale(0.4)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(146.93 39.69) scale(0.63)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(111.81 40.74) scale(0.45)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(101.64 39.88) scale(0.4)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(51.96 42.29) scale(0.32)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(15.76 38.65) scale(0.54)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(12.75 20.05) scale(0.67)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(13.76 2.92) scale(0.73)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(48.77 31.42) scale(0.42)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(190.25 60.33) scale(0.59)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(269.96 59.95) scale(0.38)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(480.17 65.05) scale(0.59)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(593.84 45.13) scale(0.31)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(644.53 57.98) scale(0.47)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(693.31 49.33) scale(0.51)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(780.87 36.21) scale(0.6)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(848.43 21.72) scale(0.91)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(900.3 8.33) scale(0.55)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(924.96 2.78) scale(0.43)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(940.18 5.53) scale(0.34)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(939.91 1.35) scale(0.38)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(945.94 3.55) scale(0.34)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(939.41 55.73) scale(0.25)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(924.66 111.76) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(918.13 143.18) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(908.34 180.23) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(908.34 219.45) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(907.62 231.71) scale(0.56)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(896.29 250.95) scale(0.63)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(857.03 286.09) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(835.62 316.28) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(830.89 322.62) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(865.81 207.48) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(734.83 297.11) scale(0.55)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(709.03 358.54) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(698.2 365.21) scale(0.38)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(780.74 264.03) scale(0.56)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(839.36 161.88) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(821.74 133.83) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(803.21 133.74) scale(0.46)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(514.08 196.69) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(453.79 312.33) scale(0.11)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(435.31 321.19) scale(0.22)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(499.91 266.07) scale(0.3)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(555.01 120.56) scale(0.69)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(567.97 112.65) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(482.01 271.49) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(371.06 322.89) scale(0.51)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(351.59 329.92) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(372.44 333.47) scale(0.27)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(489.93 235.49) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(497.4 233.37) scale(0.48)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(385.32 315.87) scale(0.34)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(340.6 369.39) scale(0.55)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(336.2 362.74) scale(0.41)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(350.16 365.77) scale(0.56)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(279.61 407.06) scale(0.32)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(276.71 416.34) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(269.05 444.91) scale(0.3)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(269.28 471.26) scale(0.34)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(272.46 481.98) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(277.16 494.5) scale(0.41)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(342.75 332.12) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(356.16 339.51) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(339.77 350.03) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(293.75 375.14) scale(0.2)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(271.26 395.84) scale(0.24)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(257.35 409.92) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(254.4 415.54) scale(0.27)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(247.08 422.32) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(216.72 452.38) scale(0.44)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(205.36 455.37) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(215.66 430.46) scale(0.5)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(176.78 382.66) scale(0.68)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(105.82 362.58) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(77.9 361.7) scale(0.34)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(73.81 366.83) scale(0.36)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(76.61 377.61) scale(0.41)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(77.56 393.13) scale(0.49)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(70.05 392.83) scale(0.5)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(121.38 302.11) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(104.21 294.66) scale(0.34)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(91.16 285.38) scale(0.35)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(60.27 248.15) scale(0.55)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(46.94 228.7) scale(0.72)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(47.98 224) scale(0.73)" xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(47.49 241.71) scale(0.62)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(45.98 291.32) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(45.08 312.46) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(38.51 316.24) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(29.19 317.65) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(28.8 314.17) scale(0.32)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(70.1 168.42) scale(0.51)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(76.93 168.4) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(103.71 217.87) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(111.83 260.16) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(111.07 295.26) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(110.85 299.54) scale(0.34)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(212.24 264.51) scale(0.59)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(466.72 286.69) scale(0.07)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(503.38 284.76) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(329.82 345.41) scale(0.26)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(311.5 357.86) scale(0.17)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(318.96 353.76) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(372.92 311.16) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(311.81 315.15) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(116.91 345.52) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(91.46 360.28) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(245.5 372.09) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(442.26 324.29) scale(0.22)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(486.74 288.97) scale(0.21)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(386.47 328.93) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(300.62 365.77) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(306.9 362.48) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(489.55 308.82) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(495.74 177.17) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(489.2 191.89) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(478.21 293.08) scale(0.2)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(454.76 304.78) scale(0.2)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(489.71 280.68) scale(0.17)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(582.08 110.83) scale(0.42)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(595.87 116.58) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(592.69 132.53) scale(0.76)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(559.42 168.2) scale(0.55)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(545.98 172.78) scale(0.61)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(861.67 202.54) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(868.31 191.88) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(865.04 187.96) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(649.78 185.46) scale(0.73)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(537.28 248.42) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(551.98 261.33) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(702.78 337.26) scale(0.54)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(687.08 372.66) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(587.04 393.13) scale(0.54)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(570.4 419.17) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(568.26 446.56) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(583.96 444.92) scale(0.51)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(659.3 431.31) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(669.41 431.96) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(617.47 422.63) scale(0.32)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(323.36 379.12) scale(0.42)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(323.46 384.22) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(330.49 365.96) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(379.87 345.89) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(363.31 352.3) scale(0.17)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(293.91 398.06) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(286.07 398.85) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(288.85 401.15) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(306.01 390.82) scale(0.27)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(607.2 459.91) scale(0.56)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(629.44 462.63) scale(0.55)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(677.09 471.64) scale(0.7)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(710.38 471.69) scale(0.84)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(806.7 433.38) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(845.7 400.12) scale(0.56)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(861.18 378.3) scale(0.55)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(894.83 337.98) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(901.82 334.05) scale(0.4)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(881.25 365.21) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(812.31 425.67) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(794.14 436.78) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(781.3 430.76) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(773.55 399.46) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(773.84 392.44) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(716.34 408.22) scale(0.54)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(558.16 439.73) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(637.85 416.98) scale(0.32)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(742.39 356.86) scale(0.54)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(830.05 295.27) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(841.48 283.39) scale(0.44)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(835.68 287.32) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(799.15 301.02) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(811.06 290.4) scale(0.42)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(862.74 220.87) scale(0.44)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(860.15 176.17) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(864.59 175.91) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(840.13 192.37) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(855.02 214.68) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(868.63 172.21) scale(0.21)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(895.74 154.34) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(901.66 151.47) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(878.17 185.99) scale(0.27)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(873.38 210.93) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(884.95 217.27) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(920.45 226.14) scale(0.56)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(925.03 301.3) scale(0.67)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(932.56 336.84) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(935.59 343.18) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(972.3 303.97) scale(0.83)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(991.17 119.21) scale(0.84)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(984.05 87.08) scale(0.46)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(982.77 79.25) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(937.97 108.72) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(913.98 138.81) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(910.01 174.36) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(910.04 191.7) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(918.1 183.13) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(940.64 116.02) scale(0.54)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(948.91 78.59) scale(0.32)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(903.6 119.31) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(869.81 161.11) scale(0.2)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(874.63 166.21) scale(0.24)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(838.55 134.07) scale(0.26)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(613.96 97.38) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(530.81 128.4) scale(0.81)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(509.11 178.43) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(502.35 196.8) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(484.99 202.32) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(515.44 169.77) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(753.51 80.87) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(778.18 67.38) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(740.68 66.78) scale(0.34)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(612.94 86.75) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(572.58 97.55) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(507.72 142.82) scale(0.26)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(576.3 106.81) scale(0.44)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(625.23 66.49) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(623.71 59.97) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(544.22 95.98) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(475.44 173.65) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(470.11 172.63) scale(0.44)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(415.79 92.93) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(362.72 101.92) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(254.28 153.58) scale(0.08)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(243.61 176.61) scale(0.05)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(240.85 180.52) scale(0.05)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(224.22 158.6) scale(0.46)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(261.92 89.63) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(275.2 81.34) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(229.19 102.78) scale(0.06)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(164.73 185.3) scale(0.27)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(158.89 203.65) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(176.67 136.63) scale(0.03)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(264.86 29.08) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(316.97 2.47) scale(0.63)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(338.18 2.28) scale(0.6)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(362.16 9.58) scale(0.56)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(373.49 9.26) scale(0.6)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(553.42 75.96) scale(0.32)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(573.7 62.57) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(584.92 56.32) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(609.06 33.6) scale(0.42)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(540.94 145.09) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(524.9 151.62) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(501.92 238.94) scale(0.21)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(457.84 297.21) scale(0.12)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(467.88 320.41) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(444.73 297.58) scale(0.11)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(428.89 287.03) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(313.73 183.89) scale(0.67)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(250.78 121.08) scale(0.08)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(254.01 115.25) scale(0.12)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(211.59 124.91) scale(0.08)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(123.12 195.75) scale(0.55)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(105.84 208.25) scale(0.53)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(101.58 204.36) scale(0.55)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(137.14 37.29) scale(0.62)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(119.42 97.4) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(73.93 211.2) scale(0.65)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(75.36 228.4) scale(0.6)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(81.46 236.18) scale(0.53)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(114.76 224.94) scale(0.45)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(185.26 138.56) scale(0.04)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(207.07 120.61) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(201.45 126) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(196.31 228.22) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(197.46 237.89) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(200.01 230.4) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(235.87 166.81) scale(0.02)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(297.28 226.41) scale(0.65)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(279.88 330.65) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(284.05 349.71) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(278.91 351.2) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(510.04 150.63) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(513.72 159.05) scale(0.42)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(478.46 225.07) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(469.74 293.71) scale(0.12)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(446.48 301.96) scale(0.07)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(447.61 308.1) scale(0.09)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(595.09 95.4) scale(0.46)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(598.24 105.39) scale(0.4)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(512.49 183.52) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(489.43 274.5) scale(0.15)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(497.11 295.11) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(484.54 221.95) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(549.83 131.65) scale(0.61)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(553.6 143.53) scale(0.51)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(503 248.09) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(480.52 267.7) scale(0.14)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(483 191.38) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(525.42 142.55) scale(0.4)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(535.65 139.44) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(500.86 276.47) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(462.18 308.04) scale(0.2)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(497.69 250.93) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(499.86 205.97) scale(0.58)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(490.4 208.31) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(445 314.5) scale(0.12)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(481.98 306.45) scale(0.16)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(494.81 199.08) scale(0.21)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(621.48 92.73) scale(0.42)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(663.06 91.61) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(699.11 78.01) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(628.06 112.16) scale(0.44)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(565.29 124.89) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(563.62 134) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(590.18 107.32) scale(0.59)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(704.95 130.58) scale(0.53)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(697.52 132.74) scale(0.49)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(810.49 171.74) scale(0.63)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(663.1 323.1) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(641.37 309.26) scale(0.34)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(683.59 340.83) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(776.06 239.09) scale(0.72)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(856.55 202.56) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(864.99 197.74) scale(0.4)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(690.63 158.59) scale(0.71)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(519.72 177.66) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(316.01 366.39) scale(0.24)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(301.33 373.9) scale(0.24)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(288.29 387) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(280.73 425.39) scale(0.22)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(297.75 429.43) scale(0.24)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(435.75 364.56) scale(0.19)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(694.88 383.97) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(711.57 377.53) scale(0.42)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(707.14 374.66) scale(0.53)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(654.06 398) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(553.37 384.93) scale(0.7)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(485.34 397.69) scale(0.79)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(448.06 392.62) scale(0.78)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(491.32 363.65) scale(0.46)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(494.4 340.69) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(484.51 345.14) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(469.97 343.73) scale(0.33)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(558.15 311.38) scale(0.75)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(613.19 333.56) scale(0.52)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(481.22 249.35) scale(0.15)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(480.64 300.35) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(472.44 290.01) scale(0.12)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(490.87 292.14) scale(0.26)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(481.42 233.74) scale(0.23)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(482.02 227.72) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(476.99 315.66) scale(0.19)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(467.49 312.15) scale(0.1)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(485.47 244.34) scale(0.27)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(503.66 173.82) scale(0.37)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(540.27 154.43) scale(0.8)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(582.76 120.28) scale(0.54)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(694.88 347.2) scale(0.24)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(704.4 361.58) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(703.43 380.61) scale(0.53)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(720.64 395.18) scale(0.65)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(726.76 411.09) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(728.77 426.27) scale(0.54)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(766.57 393.26) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(852.42 263.11) scale(0.5)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(876.15 200.21) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(879.58 199.31) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(870.22 187.62) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(564.62 144.61) scale(0.85)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(484.53 236.98) scale(0.17)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(474.05 297.27) scale(0.18)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(462.55 300.66) scale(0.18)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(439.02 309.23) scale(0.08)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(331.72 352.97) scale(0.3)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(311.81 362.36) scale(0.24)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(347.48 320.53) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(499.13 259.82) scale(0.26)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(498.4 226.37) scale(0.35)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(489.85 251.43) scale(0.24)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(406.6 333.02) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(323.41 334.45) scale(0.44)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(389.37 339.8) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(429.66 312.88) scale(0.28)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(413.71 316.5) scale(0.41)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(321.99 344.24) scale(0.31)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(357.27 325.28) scale(0.2)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(494.29 280.99) scale(0.52)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(473.52 209.47) scale(0.36)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(494.71 268.13) scale(0.19)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(291.88 347.37) scale(0.25)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(189.14 348.87) scale(0.63)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(131.26 362.04) scale(0.39)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(128.88 359.74) scale(0.38)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(229.78 364.19) scale(0.48)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(254.45 366.88) scale(0.29)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(200.59 389.19) scale(0.63)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(133.5 410.95) scale(0.61)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(179.58 374.67) scale(0.65)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(283.94 287.09) scale(0.57)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(459.67 316.81) scale(0.22)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(461.65 324.22) scale(0.2)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(314.88 298.59) scale(0.55)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(262.36 318.31) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(290.5 297.72) scale(0.56)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(487.65 265.96) scale(0.19)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(486.67 261.39) scale(0.15)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(517.13 142.13) scale(0.47)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(554.94 102.95) scale(0.32)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(565.5 104.58) scale(0.43)"
                xlink:href="#star" />
            <use width="6.29" height="6.29" transform="translate(560.17 108.2) scale(0.38)"
                xlink:href="#star" />
            <g id="moon" class="cls-19 cls-14">
                <path class="cls-5"
                    d="M753.43-53.14a25.92,25.92,0,0,1-25.91-25.92,25.81,25.81,0,0,1,6.63-17.3,25.91,25.91,0,0,0-18.7,24.89,25.91,25.91,0,0,0,25.91,25.91,25.86,25.86,0,0,0,19.28-8.61A26,26,0,0,1,753.43-53.14Z"
                    transform="translate(0 250)" />
            </g>
        </g>
        <g id="cloud">
            <polygon class="cloud"
                points="255.7 464.65 505.29 464.65 484.13 480.63 291.11 480.63 284.29 487.45 140.98 487.45 157.66 470.77 250.36 470.77 255.7 464.65"
                id="c-left1"></polygon>
            <polygon class="cloud" points="202.6 501.42 369.06 501.42 375.52 494.96 207.72 494.96 202.6 501.42"
                id="c-left2"></polygon>
            <polygon class="cloud"
                points="826.23 480.99 514.82 480.99 527.56 493.73 631.02 493.73 638.05 500.76 854.51 500.76 833.9 480.15 826.23 480.99"
                id="c-right1"></polygon>
            <polygon class="cloud" points="766.02 517.75 586.94 517.75 593.4 524.22 772.47 524.22 766.02 517.75"
                id="c-right2"></polygon>
            <polygon class="cloud"
                points="745.51 548.67 618.14 548.67 622.49 553.01 580.81 553.01 591.26 563.47 758.62 563.47 745.51 548.67"
                id="c-right3"></polygon>
            <polygon class="cloud" points="260.13 548.67 377.21 548.67 372.42 553.46 252.56 553.46 260.13 548.67"
                id="c-left3"></polygon>
        </g>
        <g id="land3">
            <path id="land3-2" data-name="land3" class="cls-7"
                d="M956.51,202.68c-5.11,11.23-60.77,25.53-78.13,21.79s-47.49-6-71,5.44c-7.16,3.49-12.59,12.43-18.38,12.43s-17,5.28-26.89,18.72c-10,13.65-16.64,18.9-26.9,19.27-3.74.14,1.67,16.68,3.07,18.35C764,329.45,699,381.57,682.13,323.19c-3.07-10.61-10.9-6.81-15,1.36s-6.3,22.13-15,22.13c-5.45,0-3.4.68-5.45,6.13s-22.12,26-56.84,11.36c-4.88-2.06-8.52-6.18-11.58-.64s-13.45,7.08-16.34.34c-3.76-8.74-7.62-8.36-17.36,9s-85.45,20.29-110-6.68c-8.15-9-11.24-10.65-13.62-2.48s-23.66,17.7-34.38,0c-5.15-8.5-9.92-14.23-18.73-11.4-13.78,4.42-33.7.17-38.63-25.87-2-10.71-12.48-12.39-14.88-3.11-4.19,16.21-22.44,23.06-36,18.25s-28.42-27.06-17-36.42c6.91-5.67,12.6-21.79-1.36-27.41-6.8-2.73-15-2.89-18-10.38s-6.81-21.1-22.81-22.47c-6.79-.57-15.66-.68-21.11-8.85-7-10.44-42.21-22.81-68.42-12.25C92.28,238.82,53.67,203.68,0,189.63V531.5H1000V177.7C979.81,180.73,960.75,193.35,956.51,202.68ZM56.43,304.81c-4-21.07-2.73-40.34,9.53-42s20.76-1,25.19,10.77S59.49,320.81,56.43,304.81Zm80.68-15.32c-7-21.42,20.76-67.75,42.89-30S159.23,357.23,137.11,289.49Zm73.19,2.72c-11.85-14.22,2-36.5,18.72-18.59S223.91,308.55,210.3,292.21ZM776.77,329c-22.29-29.12,13.27-62.64,40.17-42.21S806.72,368.13,776.77,329Zm85.78-26.89c-11.46-20.69,11.24-38.47,23.15-17.37S876.51,327.28,862.55,302.09Zm60.26-23.15c0-32.68,42.49-47.87,42.55-1.37C965.43,329.32,922.81,311.62,922.81,278.94Z"
                transform="translate(0 250)" />
        </g>
        <g id="baloons">
            <g id="baloon2" class="cls-8">
                <path class="cls-9"
                    d="M365.22,277.73c5.14-5.39,10.93-10.28,10.93-16.6a12.25,12.25,0,1,0-24.49,0c0,6.32,5.79,11.21,10.93,16.6Z"
                    transform="translate(0 250)" />
                <rect class="cls-9" x="361.29" y="530.54" width="5.23" height="2.19" />
            </g>
            <g id="baloon1" class="cls-10">
                <path class="cls-9"
                    d="M397.19,286.24c3.67-3.85,7.8-7.34,7.8-11.84a8.74,8.74,0,0,0-17.47,0c0,4.5,4.13,8,7.8,11.84Z"
                    transform="translate(0 250)" />
                <rect class="cls-9" x="394.39" y="538.24" width="3.73" height="1.56" />
            </g>
        </g>
        <g id="birds-paradise">
            <path id="bird1-p" class="cls-9"
                d="M261.23,203.88a20.38,20.38,0,0,0,2.56.64c-3.41-13.11-99.58-26.14-115.92-26.82,29.8,2.4,59.31,8.63,88,16.68,5.06,1.5,10.09,3.1,15,5,.29.12.25,1.11.61,1l.42.14c-.54.83-1.43,1.74-1.55,2.51-.16,1.69,1.66,4.44-.16,9.67,2.43.32,9.9-6.22,9.13-8.33A4.91,4.91,0,0,0,261.23,203.88Z"
                transform="translate(0 250)" />
            <path id="bird2-p" class="cls-9"
                d="M235.8,170.47c-.26-1-.86-2.65-1.12-3.35,2.12-1.24,6.17-2.68.68-12.43-6.51,5.69-9.09,7.54-8.51,11C198,156.52,146.76,156,125.16,155.1v.07c31.38,2.37,64,2.23,94.37,11.19q2.64.76,5.26,1.65c1.8.6,3.26,2.14,5,2.81,1.41.53,3.13.19,4.53.77l1.39.66a11,11,0,0,0,1.44.63c-.46-.47-.13-1.4-.66-1.84Z"
                transform="translate(0 250)" />
        </g>
        <g id="birds">
            <path id="bird6" class="cls-11"
                d="M606.43,294.39c-1.66-3-5-8.42-7.79-9.95,4.72,2,6.25,3.44,7.79,5,.7-1.14,3.46-3,7.4-4.08C608.47,290.05,608.09,291.71,606.43,294.39Z"
                transform="translate(0 250)" />
            <path id="bird5" class="cls-12"
                d="M617.4,277.22a22.32,22.32,0,0,0-8.55-8.17c3.26.45,7.15,2.05,8.55,3.45.51-1.51,3-2.64,6.26-3.45A14,14,0,0,0,617.4,277.22Z"
                transform="translate(0 250)" />
            <path id="bird4" class="cls-13"
                d="M591.36,281.5c3.58-1.91,6.51-2.55,10-.89C597.11,275.5,596.72,276,591.36,281.5Z"
                transform="translate(0 250)" />
            <path id="bird3" class="cls-14"
                d="M579,288.27c-1.34-1.79-4.47-5.88-7.15-6.77,3.57,0,5.87,2.17,7.15,3.38a9.53,9.53,0,0,1,5.81-3.38C581.66,283.54,580.64,285.33,579,288.27Z"
                transform="translate(0 250)" />
            <path id="bird2" class="cls-15"
                d="M574.26,295c-2.43-.64-5.75-.51-7.92,1.15C567,293.24,571.83,290.05,574.26,295Z"
                transform="translate(0 250)" />
            <path id="bird1" class="cls-16"
                d="M563.53,287.12c-2.3-1.53-4.72.12-6.25,1.78C557.28,285.71,560.34,282.52,563.53,287.12Z"
                transform="translate(0 250)" />
        </g>
        <g id="land2">
            <path id="land2-2" data-name="land2" class="cls-9"
                d="M997.79,218.34c.75.14,1.49.31,2.21.49V159.11c-18.13-1.21-32.09,2.3-43,7.95l-4.35-2.34,4.59-3.4-11.91-8-12.43,8.34,4.43,2.21-11.49,8L930,174.6l-8.34,6,4.17,1.71-6.22,3.91s5.11,3.58,8.78,6.28c-6.9,9.13-11.1,16.65-15.07,17-52.6,5.11-87.49,50.72-91.24,55.83s-5.34,8.19-4.76,12.42c2.89,21.28,7.18,37.22,0,48.86-23.32,37.78-41.54,21.95-44.43,18.89s-5.16-2.2-7.83,3.57c-30.81,66.73-82,55.83-85.79,49.88-2.56-4.08-5.34-2.27-7,1.19-5.62,11.9-26.9,3.4-35.07-10.39-1.86-3.13-8.34-4.42-9.19-.68s-13.11,26.33-15.49,25.54c-3.06-1-7.83-2.57-9.87,4.48-1.42,4.89-21.79,12.71-36.09-13.68-2.23-4.12-6.64,6.64-15.49,7.94V396h-7.49V378.68c0-6.81-6.12-10.21-9.87-10.55V356.89h-8.51c15.47-23.21-23.51-32.47-23.51-41.15V308.4c9,0,9.11-14.42,0-14.42v-7.62c3.62.32,20.72,5.7,11.66,24.85,11-5,9.32-31.59-12.66-31.59H500c-22,0-23.64,26.55-12.66,31.59-9.06-19.15,8-24.53,11.66-24.85V294c-9.11,0-9,14.42,0,14.42v7.34c0,8.69-39,17.94-23.51,41.15H467v11.24c-3.75.34-9.87,3.74-9.87,10.55V396h-7.49v14.3c-7.49,0-12.26-2.72-15-7.83s-5.28-4.77-7.83,3.4c-3,9.47-7.83,18.9-16,8.87-3.66-4.48-7.49-5.12-10.21-.69s-40.86,8.34-49.71-23.49c-2.83-10.18-5.44-11.24-10.21-2.39s-34.55,30-57.53,5.11c-5.89-6.37-8-17.53-19.41-16-9.92,1.33-22.72-9.16-24.51-21.79C238,347,233.28,339,225.62,346c-8.38,7.64-53.79,8.68-51.41-75.23.21-7.22-3.1-11.75-10.89-13.62-31.15-7.49-35.53-25.32-48.34-35.41a724.21,724.21,0,0,0-60.72-43.3l8-7.08-10.09-6.25L58,161.53l-11.87-8-2.94,2.3-5.24-3.45,4.09-3-11.62-8-11.23,8L23.62,153l-6.8,4.18Q8.32,152.9,0,149.32V272.19c3.81,8,5.5,20.31,11,21.72,7.91,2,8.43-7.87,13.28-8.42,11.23-1.28,11.23,23.43,7.4,33.45-2.37,6.2-3.83,15.57-7.4,19.4-2.54,2.72-15,9.42-24.26,12.53V563H1000V341.56c-11.06-1-27.87-11-44.85-28.37-16.09-16.47-14.81-46.34-4.6-42.51,3.43,1.28,7.15,6.89,6.13,0S960.51,211.45,997.79,218.34Zm-946,47.23c-9.67-15.93-4.34-51.31,30.13-23.74C101.23,257.25,65.62,288.3,51.83,265.57Zm88.08,60.26c6.13,14-15.31,42.89-33.95,11.49-18.24-30.73,4.89-59.05,20.93-57.19C157.79,283.7,155.74,328.89,139.91,325.83Zm361,35.93,4.42,4.42-4.42,4.43-4.42-4.43ZM489.4,373.23l4.42-4.43,4.42,4.43-4.42,4.42Zm11.1,11.1-4.42-4.42,4.42-4.43,4.42,4.43Zm7-7-4.42-4.43,4.42-4.42,4.42,4.42Zm400.89-51.2c-4.86,27.31-30.9,24.25-33.2,13.78s-7.14-10-9.44-6.89-5.94,7.13-7.66-6.89c-5.62-45.71,35.49-55.92,35.74-40.35s1.85,22.18,6.64,20.43C911,302.34,909.92,317.65,908.43,326.09Z"
                transform="translate(0 250)" />
        </g>
        <g id="land1">
            <path id="land1-2" data-name="land1" class="cls-17"
                d="M998.47,325.35c-1.28-.51-2.47-17.46-2.9-22.77s1.11-5,1.11-6.25-1.19-11.3-3-15.07c1.9-.07,4.46.79,7,1.92V278.9c-.54-.63-6.27-1.53-6.72-1.92.54,0,6.26-1.85,6.72-2.09v-1.36c-1.46-.57-4.15-.77-8.68-.15.17-2.48,4.26-6.16,6.72-10.53-3.66,0-10.21,7-13.19,11.9-.85-3.68-6-5.48-12.17-5.48,4.6.69,6.38,5.05,8.94,8.56-4.26-1-14.56,6.94-13.53,14.3.34-3.42,6.63-8.05,11.32-9.42-2.81,1.72-5.11,14.9-3.15,17.21-.34-3.51,4.59-11.21,7-14.38-.17,1.88,2.47,9.93,2.3,12.67s3.07,3.6,4,4.54,2.39,15.67,3.58,22.43c-4.85-.51-11.66,16.44-14.9,16.18s-14.21-1.71-14.38-2S958.38,324,956,315.93s-6.21,2.83-9.62,10c-3.32-1.54-14-26.71-15.4-30s-6.38-.34-6.38-.34.34,24.23-10.13,24.92-14.56,28.25-14.56,28.25-1.87.17-5.61.17-8.17,11.82-10.47,16.35c-2,.6-5.45.69-10.3.69-7.83-3.6-10.47-27.14-10.47-29.62s-4.17-2.15-5.53-.78-7.83,20-12.76,36.72c-8.09.85-23.75,6.44-23.75,6.44l-1.11-2.32-6.38,5.23-.68-.6,5-7.19L814,370.21l-4.34,10h-1.28l2.72-11.13L806.72,367l-1.44,12.67-1.37-.08.69-12.93-4.69-.86L801,380H799.4l-2.21-13.87-4.34.43,3.66,12.25-1.11.42-4.85-10.61-3.4,2.91,6.3,9.16-.68.68-7.66-8.3L782.3,376l9.36,9.42-.77,1.2-11.32-7.88-2,3.94,10.12,7.19L777.87,387l.09,4.8,4.25.51s-42.38,18.5-51.49,20.12c-.17-8.47-4-81.33-4.68-85.87s3.58-1.28,2.56-7.45c-.3-1.77-2.47-12.67-3.32-17.21,3.91-.25,10.29,3.94,16.25,10.79.51-6.85-6.13-12.59-13.79-14.9,3.24-2,11.75-.68,19,1.2-2.63-6.85-16.59-8.3-25-5.65,0-2.57,5.79-8.56,8-11.72-3.06.61-12.68,6.46-14.64,13.6-1.61-2.91-7.06-7.62-13.61-7.1,3.91.85,7,6.16,8.85,9.84-5.36.09-17.53,10.79-15.75,17.3.26-5.31,9.62-10.36,13.28-10.79-3.15,1.46-6,13.27-3.32,19.09-.94-6.68,6.55-13.52,8.34-17.12,1.11,1.8,1.79,9.42,2.38,14.73s3.41,3.42,6,6.07,1.19,75.6.94,77.49-4.26,9.41-7.15,15.66c-2.64,0-13.36-1.37-19.41,2.49-1.7-12.5-4.25-50.6-5.61-54.63a36.4,36.4,0,0,1,2.13-3.51s-2.39-11.81-3.15-17.2c3-.35,7,2,14,8.47a16.75,16.75,0,0,0-11.66-12.24c2.13-1.29,10.13-1.89,16.51.6-4.68-6.34-13.19-7.79-20.85-4.63.34-2.74,3.23-5.82,6-10.36-4.51,1.12-11,7.62-12.6,11.39a14.06,14.06,0,0,0-11.91-5.82c2,.94,4.68,5,7.91,8.22-6,.43-13.7,10.44-13.87,15,.76-2.31,8.59-7.79,11.49-8.39-2.9,2.14-5.79,11.13-2.22,17.55-1.27-6.42,3.58-11.56,7.41-14.64-.51,3.86,2.3,14.13,2.3,14.13l4.08,2c2.56,6.68,3.83,44.7,2.56,50.09S683,431,683,431l-12-9.25-6.64.78-10.72,14.89-5.11.26-3.32,6.16h-9.45a52.9,52.9,0,0,1-4.08,9.51c-126.38,37-203.61,16.26-268.09-3.34a564.3,564.3,0,0,1-61.45-23.17,138.77,138.77,0,0,1-9.44-24.69c.17-29.45,3.21-52,4.26-54.75,2.42.25,3.31-2.17,3.83-4.88.46-2.49,2.46-7.49,2.8-13.66,4.6,2.06,7.32,8.39,8.86,17.81,3.06-8.56.51-15.07-4.09-20.72,3.23.17,12.5,4.68,13.79,10.45.68-5.66-5.28-13.36-16.34-17,1-3.08,3.46-8.68,9.53-9.41-3.75.17-10.21.34-14.64,6.67-.34-2.39-6.4-12.51-13.79-13.69,5.58,4.19,7.24,7.53,7.32,11.3-5.1-1.72-19.4,0-22.81,6.33,4.26-1.71,14.43-1.62,20.05-.6-7,0-16.81,6.94-16,14.81.51-4.11,13.28-10.61,17.19-10.61-1.36,2.74-2.55,11.64-3.26,16.95s2.54,5.69,2.54,5.69c-3.24,27.19-5.27,49.35-5.19,73.12-15.26-6.91-28.91-13.4-43.3-19.89-.69-13.76,3.77-42.48,4.79-45.39,2.21.13,3.25-1.29,4.51-4.11a47.87,47.87,0,0,0,2.56-13c3.58.34,6.76,4.9,7.22,15,2.56-6,3.49-16.44-5.06-19.65,5.87-1.15,9.91.09,14.68,5.91-.17-5.31-6.72-10.74-15.06-12.46.34-2.22,3.44-5.78,10.46-8.09-3.4-.17-12.34,1.59-15.57,7.07-1.19-4.8-5.45-11.3-12.94-12,4.6,2.91,4.6,5.14,5.79,9.76-5.62-2.4-14.94-2.14-21.79,6.68,6.6-3.94,16.05-4.84,20.26-1.89-6.13-1-13.62,5.66-14.64,13.19,2.21-3.42,10.94-10.23,15.53-8.18a63.21,63.21,0,0,0-3.5,14.17c-.6,5.62,2.1,6.17,2.1,6.17-2.55,21.53-3.58,31-4.16,44.6-29.49-13.1-57.61-23.81-86-27.05-.85-4.45-5.11-6.17-3.83-12.07-2.21-2.23-5.11,0-10.47,0-3-8.56-10.12-5.31-12.51-9.25-3.49-5.76-21.7-10.1-25.27-8.22-5.32,2.8-7-4.19-8.43-6.68-1.16-2-6.3-.94-6.89.52-.88,2.13-4.34,4.11-6.64,4.11s-3.15-4.71-8.43-5.91c-5-1.13-6.55-21.75-11.3-40.2-.7-2.7-6.15-1.55-6.82.39-1.2,3.42-3.41,8.56-4.35,21.06-1.62-.61-9.27,2.57-9,5.31.56,5.92-2.41,13-3.49,21.4-.76-2.82-1.1-8.73-6.89-6.68,1.36-10.1-14-17.46-15.32,0-3.93.24-8.48.05-12.34,0V563h1000V325.7A7.36,7.36,0,0,1,998.47,325.35Z"
                transform="translate(0 250)" />
        </g>
        <g id="light">
            <g id="glow">
                <circle class="cls-18" cx="500" cy="591.82" r="280.24" />
            </g>
            <g id="whitesun" class="cls-19">
                <path class="cls-20"
                    d="M473.66,353.72C463.6,332.81,499,324,499,315.74V308.4c-9,0-9.11-14.42,0-14.42v-7.62c-3.62.32-20.72,5.7-11.66,24.85-11-5-9.32-31.59,12.66-31.59h.68c22,0,23.64,26.55,12.66,31.59,9.06-19.15-8-24.53-11.66-24.85V294c9.11,0,9,14.42,0,14.42v7.34c0,8.2,34.78,16.92,25.59,37.43a52.22,52.22,0,1,0-53.61.55Z"
                    transform="translate(0 250)" />
            </g>
        </g>
        <g id="hover">
            <circle class="cls-21" cx="500" cy="558.89" r="56.04" />
        </g>
    </svg></div>
