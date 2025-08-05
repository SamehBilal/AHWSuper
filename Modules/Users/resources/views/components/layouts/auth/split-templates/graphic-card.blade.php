<style>
   /*  @charset "UTF-8";

    body,
    html {
        box-sizing: border-box
    }

    body {
        display: flex;
        display: -ms-flex;
        flex: 1 0 auto;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: radial-gradient(#111, #000)
    }
 */
    .frame {
        z-index: 10;
        width: 225px;
        height: 520px;
        background: linear-gradient(to top, rgba(85, 85, 85, .6) 20%, rgba(136, 136, 136, .6) 30%, rgba(102, 102, 102, .6) 40%, rgba(102, 102, 102, .6) 47%, rgba(170, 170, 170, .6) 80%, rgba(51, 51, 51, .8)), url(https://image.freepik.com/free-vector/abstract-colorful-pattern-shape-design-background_38782-954.jpg) 50%;
        filter: contrast(1.1);
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        position: relative;
        box-shadow: inset 0 0 4px;
        z-index: -1;
        user-select: none !important
    }

    .frame::before {
        position: absolute;
        content: '';
        height: 58%;
        width: 100%;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 40px;
        background: linear-gradient(75deg, rgba(51, 51, 51, .7), rgba(17, 17, 17, .7)), rgba(51, 51, 51, .8);
        box-shadow: 0 5px 0 rgba(255, 255, 255, .2), 0 -5px 0 rgba(255, 255, 255, .2), inset 0 0 5px rgba(0, 0, 0, .5)
    }

    .frame::after {
        position: absolute;
        content: 'Re-designed and Code by AMAN.      RTX SPECIAL EDITION';
        font: 6px Lato;
        right: -1px;
        z-index: -1;
        bottom: 52%;
        transform-origin: right top;
        transform: rotate(-90deg);
        color: rgba(255, 255, 255, .3)
    }

    .io_s {
        height: 2px;
        width: 100%;
        background: #666;
        position: absolute;
        bottom: -2px;
        left: 20px;
        border-radius: 0 4px 4px 0
    }

    .io_s::before {
        position: absolute;
        content: '';
        height: 20px;
        width: 2px;
        background: inherit;
        border-radius: 0 0 4px 4px
    }

    .io_s .dvi {
        position: absolute;
        content: 'A';
        width: 40px;
        height: 11px;
        left: 62%;
        bottom: -11px;
        background: linear-gradient(to top, #666, #aaa 50%, #666 55%, #777, #444);
        bottom: inherit10px;
        border-radius: 0 0 2px 2px
    }

    .io_s .dvi::after,
    .io_s .dvi::before {
        border-radius: 0 0 1px 1px;
        position: absolute;
        content: '';
        height: 10px;
        width: 6px;
        background: linear-gradient(to right, #777 10%, #777 25%, #555 25%, #555 75%, #333 75%)
    }

    .io_s .dvi::after {
        left: -12px
    }

    .io_s .dvi::before {
        right: -12px
    }

    .pci {
        background: linear-gradient(to right, #222 59%, #555 70%, transparent 72%);
        position: absolute;
        right: -16px;
        z-index: -2;
        bottom: 17%;
        width: 1rem;
        height: 43%;
        border-radius: 0 5px 5px 0
    }

    .pci::before {
        position: absolute;
        content: '';
        background: linear-gradient(to right, #222 59%, #555 70%, transparent 72%);
        bottom: -23px;
        right: 2px;
        height: 14px;
        width: 14px
    }

    .pci::after {
        background: repeating-linear-gradient(to top, #bda559 0, #6a5811 14%);
        bottom: -23px;
        position: absolute;
        content: '';
        height: 14px;
        right: 0;
        width: 8px;
        border-radius: 0 1px 1px 0
    }

    .pci .p {
        z-index: 1;
        position: inherit;
        width: 13px;
        left: 10px;
        z-index: 1;
        border-radius: 0 1px 1px 0
    }

    .pci .p::before {
        position: absolute;
        content: '';
        background: #111;
        border-radius: 50px;
        right: 9px;
        width: 10px;
        height: 3.5px;
        bottom: -3.5px
    }

    .pci .p.p1 {
        height: 10%;
        bottom: 0;
        background: repeating-linear-gradient(to top, #bda559 0, #6a5811 14%)
    }

    .pci .p.p1::before {
        display: none
    }

    .pci .p.p2 {
        height: 79%;
        bottom: 11.8%;
        background: repeating-linear-gradient(to top, #bda559 98%, #6a5811 100%)
    }

    .pci .p.p3 {
        height: 10%;
        bottom: 92.5%;
        left: 8px;
        width: 12px;
        background: #a28b41
    }

    .pci .p.p3::before {
        height: 4px;
        bottom: -4px;
        right: 8px
    }

    #aman {
        filter: sepia(10);
        text-shadow: 0 .9px .2px rgba(0, 0, 0, .2);
        background: linear-gradient(125deg, #ddd 10%, #777 30%, #999 40%, #999 50%, #eee 60%, #adadad 80%, #666);
        color: transparent;
        background-clip: text;
        -webkit-background-clip: text;
        display: inline-flex;
        font: bold 1.7rem Lato;
        position: relative;
        z-index: 1 !important;
        animation: shimmer 2s infinite alternate
    }

    @keyframes shimmer {
        from {
            background-position: -150%
        }

        to {
            background-position: 100%
        }
    }

    .fan {
        align-items: center;
        background: #555;
        border-radius: 50%;
        box-shadow: 0 10px 8px rgba(0, 0, 0, .6), 0 -2px 8px rgba(128, 128, 128, .5);
        display: inline-flex;
        justify-content: center;
        position: relative
    }

    .fan1 {
        transform: scale(.5) translateY(41%)
    }

    .fan2 {
        transform: scale(.5) translateY(-41%)
    }

    .b {
        box-shadow: 0 0 0 5px #585016;
        height: 400px;
        width: 400px;
        margin: 0 auto;
        position: relative;
        border: .5rem solid #ecd693;
        border-radius: 50%;
        overflow: hidden
    }

    .bl {
        display: block;
        height: 100%;
        left: 50%;
        padding-bottom: 1rem;
        perspective: 100px;
        position: absolute;
        top: 50%;
        transform-style: preserve-3d;
        width: 10rem
    }

    .bl::after,
    .bl::before {
        position: absolute;
        content: ''
    }

    .bl::before {
        height: 45%;
        width: 6rem;
        background: linear-gradient(-120deg, #373737 50%, #555 90%)
    }

    .bl::after {
        animation: blade 14s cubic-bezier(.96, -.01, .32, .67) infinite forwards;
        border-left: 2em solid;
        border-color: #555;
        box-shadow: 10px 0 40px;
        z-index: -1;
        left: -1em;
        width: 2em;
        background: #555;
        height: 45%;
        width: 4em;
        transform: rotate(-60deg) translate(40px, 20px) skew(30deg);
        transform-origin: bottom
    }

    @keyframes blade {
        0% {
            border-color: #4285f4
        }

        16% {
            border-color: #db4437
        }

        32% {
            border-color: #f4b400
        }

        48% {
            border-color: #0f9d58
        }

        64% {
            border-color: #f4b400
        }

        80% {
            border-color: #db4437
        }

        100% {
            border-color: #4285f4
        }
    }

    .b1 {
        transform: translate(-50%, -50%) rotate(27.69231deg) skew(63.69231deg)
    }

    .b2 {
        transform: translate(-50%, -50%) rotate(55.38462deg) skew(63.69231deg)
    }

    .b3 {
        transform: translate(-50%, -50%) rotate(83.07692deg) skew(63.69231deg)
    }

    .b4 {
        transform: translate(-50%, -50%) rotate(110.76923deg) skew(63.69231deg)
    }

    .b5 {
        transform: translate(-50%, -50%) rotate(138.46154deg) skew(63.69231deg)
    }

    .b6 {
        transform: translate(-50%, -50%) rotate(166.15385deg) skew(63.69231deg)
    }

    .b7 {
        transform: translate(-50%, -50%) rotate(193.84615deg) skew(63.69231deg)
    }

    .b8 {
        transform: translate(-50%, -50%) rotate(221.53846deg) skew(63.69231deg)
    }

    .b9 {
        transform: translate(-50%, -50%) rotate(249.23077deg) skew(63.69231deg)
    }

    .b10 {
        transform: translate(-50%, -50%) rotate(276.92308deg) skew(63.69231deg)
    }

    .b11 {
        transform: translate(-50%, -50%) rotate(304.61538deg) skew(63.69231deg)
    }

    .b12 {
        transform: translate(-50%, -50%) rotate(332.30769deg) skew(63.69231deg)
    }

    .b13 {
        transform: translate(-50%, -50%) rotate(360deg) skew(63.69231deg)
    }

    .dial {
        height: 7rem;
        width: 7rem;
        align-items: center;
        animation: inner-dial 14s cubic-bezier(.96, -.01, .32, .67) infinite forwards;
        background: repeating-radial-gradient(rgba(170, 170, 170, .5) 97%, rgba(221, 221, 221, .5) 90%, #dadada), radial-gradient(#ddd, #444);
        border-radius: 50%;
        border: .7em double #333;
        color: #555;
        display: flex;
        font: bold 1.4rem Lato, sans-serif;
        justify-content: center;
        left: 50%;
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 1
    }

    @keyframes inner-dial {
        0% {
            box-shadow: 0 0 60px 50px rgba(17, 17, 17, .5), inset 0 0 0 4px #4285f4
        }

        16% {
            box-shadow: 0 0 60px 50px rgba(17, 17, 17, .5), inset 0 0 0 4px #db4437
        }

        32% {
            box-shadow: 0 0 60px 50px rgba(17, 17, 17, .5), inset 0 0 0 4px #f4b400
        }

        48% {
            box-shadow: 0 0 60px 50px rgba(17, 17, 17, .5), inset 0 0 0 4px #0f9d58
        }

        64% {
            box-shadow: 0 0 60px 50px rgba(17, 17, 17, .5), inset 0 0 0 4px #f4b400
        }

        80% {
            box-shadow: 0 0 60px 50px rgba(17, 17, 17, .5), inset 0 0 0 4px #db4437
        }

        100% {
            box-shadow: 0 0 60px 50px rgba(17, 17, 17, .5), inset 0 0 0 4px #4285f4
        }
    }
</style>
<div class="frame">
    <div class="fan fan1">
        <div class="b"><span class="bl b1"></span> <span class="bl b2"></span> <span class="bl b3"></span> <span
                class="bl b4"></span> <span class="bl b5"></span> <span class="bl b6"></span> <span
                class="bl b7"></span> <span class="bl b8"></span> <span class="bl b9"></span> <span
                class="bl b10"></span> <span class="bl b11"></span> <span class="bl b12"></span> <span
                class="bl b13"></span></div>
        <div class="dial">AHW</div>
    </div><span id="aman">AHW</span>
    <div class="fan fan2">
        <div class="b"><span class="bl b1"></span> <span class="bl b2"></span> <span class="bl b3"></span> <span
                class="bl b4"></span> <span class="bl b5"></span> <span class="bl b6"></span> <span
                class="bl b7"></span> <span class="bl b8"></span> <span class="bl b9"></span> <span
                class="bl b10"></span> <span class="bl b11"></span> <span class="bl b12"></span> <span
                class="bl b13"></span></div>
        <div class="dial">AHW</div>
    </div>
    <div class="io_s"><span class="dvi"></span></div>
    <div class="pci"><span class="p p1"></span> <span class="p p2"></span> <span class="p p3"></span></div>
</div>
<script src="https://codepen.io/adsingh14/pen/wjRqvZ.js"></script>