<style>

.login-shape {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
    top: 30vh;
    bottom: 0;
    width: 26rem;
    border-radius: 26rem;
    overflow: hidden;
    height: 26rem;
    position: relative;
}

.objects_computer {
    position: absolute;
    width: 7rem;
    height: 5.5rem;
    background: #bfbfbf;
    left: 3.8rem;
    top: 14.8rem;
    transform: skew(17deg, 0deg);
    border-radius: 0.6rem 0.6rem 0 0;
    box-shadow: inset -6px 1px darkgrey;
}

.objects_computer:after {
    content: "";
    position: absolute;
    width: 2rem;
    height: 0.5rem;
    background: darkgrey;
    top: 5.1rem;
    left: 7rem;
    transform: skew(0deg, 2deg);
}

.objects_table {
    position: absolute;
    width: 22rem;
    top: 20.4rem;
    height: 1.4rem;
    background: #63321f;
    left: 2rem;
    box-shadow: 0px -3px #582714;
}

.objects_table:before {
    content: "";
    width: 19rem;
    height: 1.2rem;
    position: absolute;
    background: #582714;
    border-radius: 0 1rem;
    top: 1.4rem;
    left: 3rem;
    z-index: 1;
}

.objects_cup {
    position: absolute;
    width: 2.4rem;
    top: 17.2rem;
    background: #f11420;
    left: 16.8rem;
    height: 3rem;
    border-radius: 0.3rem 0.3rem 0 0;
    z-index: 55;
    box-shadow: -2px 0px #f50e1a;
}

.objects_cup:after {
    content: "";
    width: 2rem;
    height: 2rem;
    background: #f11420;
    position: absolute;
    top: 0.7rem;
    left: 0.4rem;
    border: none;
    border-radius: 0;
    z-index: 5;
}

.objects_cup:before {
    content: "";
    position: absolute;
    width: 1.4rem;
    height: 1.3rem;
    border: 4px solid #f50e1a;
    left: 1.6rem;
    top: 0.8rem;
    border-radius: 1rem;
    z-index: 1;
}

.objects_chair {
    height: 10.2rem;
    position: absolute;
    width: 9.1rem;
    background: #3c3c3c;
    left: 16.6rem;
    top: 10rem;
    border-radius: 2rem 2rem 0 0;
    transform: skew(-9deg, 0deg);
    box-shadow: inset -9px 5px #424242;
}

.box_1 {
    position: absolute;
    width: 5.4rem;
    height: 6.8rem;
    left: 1.3rem;
    top: 6.7rem;
    background-color: rgba(99, 102, 115, 0.709804);
    border-radius: 0.6rem;
    box-shadow: 1px 3px 5px #00000052;
    animation: float 2s infinite;
}

.box_1 div {
    background: #f11420;
    position: absolute;
    border-radius: 1rem;
}

.box_1 :nth-child(1) {
    width: 1.8rem;
    height: 0.3rem;
    top: 0.6rem;
    left: 1.3rem;
}

.box_1 :nth-child(2) {
    width: 1rem;
    height: 0.3rem;
    top: 0.6rem;
    left: 3.3rem;
}

.box_1 :nth-child(3) {
    width: 1.1rem;
    height: 0.3rem;
    top: 1.4rem;
    left: 2.1rem;
}

.box_1 :nth-child(4) {
    width: 1.4rem;
    height: 0.3rem;
    top: 1.4rem;
    left: 3.3rem;
}

.box_1 :nth-child(5) {
    width: 0.7rem;
    height: 0.3rem;
    top: 2.1rem;
    left: 2.7rem;
    box-shadow: 1rem 0px #f11420, 1.8rem 0px #f11420, -0.5rem 11px #f11420;
}

.box_1 :nth-child(6) {
    width: 1.8rem;
    height: 0.3rem;
    top: 3.5rem;
    left: 1.2rem;
    box-shadow: 1rem 22px #f11420, 0rem 43px #f11420;
}

.box_1 :nth-child(7) {
    width: 0.8rem;
    height: 0.3rem;
    top: 4.2rem;
    left: 1.7rem;
    box-shadow: 0rem 22px #f11420;
}

.box_2 {
    position: absolute;
    width: 6.4rem;
    height: 4.4rem;
    left: 7.6rem;
    top: 1.7rem;
    background-color: rgba(99, 102, 115, 0.709804);
    border-radius: 0.6rem;
    box-shadow: 1px 3px 5px #00000052;
    animation: float2 2s 1s infinite;
}

.box_2 div {
    position: absolute;
    border-radius: 1rem;
}

.box_2 :nth-child(1) {
    transform: rotate(45deg);
    width: 0.2rem;
    height: 0.6rem;
    left: 0.8rem;
    top: -1rem;
    box-shadow: 1.1rem 0.5rem #f11420, 2.5rem -0.5rem #f11420, 6rem 0.5rem #f11420;
}

.box_2 :nth-child(2) {
    transform: rotate(133deg);
    width: 0.2rem;
    height: 0.6rem;
    left: 0.8rem;
    top: -0.6rem;
    box-shadow: 0.5rem -1.1rem #f11420, -0.9rem -2rem #f11420, 0.2rem -5.5rem #f11420;
}

.box_2:after {
    content: "";
    width: 1rem;
    height: 0.2rem;
    background: #f11420;
    position: absolute;
    border-radius: 6rem;
    top: 1.8rem;
    left: 2.2rem;
}

.box_2:before {
    content: "";
    width: 0.8rem;
    height: 0.2rem;
    background: #f11420;
    position: absolute;
    border-radius: 6rem;
    top: 0.5rem;
    left: 2rem;
    transform: rotate(-68deg);
    box-shadow: -2.2rem 2.8rem #f11420;
}

.box_3 {
    position: absolute;
    width: 4.9rem;
    height: 4.2rem;
    left: 7.6rem;
    top: 7.4rem;
    background-color: rgba(99, 102, 115, 0.709804);
    border-radius: 0.6rem;
    box-shadow: 1px 3px 5px #00000052;
    animation: float3 2.5s infinite;
}

.box_3:after {
    content: "";
    position: absolute;
    background: #f11420;
    width: 0.8rem;
    height: 0.2rem;
    transform: rotate(-64deg);
    border-radius: 5rem;
    top: 0.8rem;
    left: 0.5rem;
    box-shadow: 0.2rem 0.5rem #f11420;
}

.smoke {
    width: 70px;
    height: 100px;
    background: none;
    position: absolute;
    left: 18rem;
    margin-left: -40px;
    z-index: 3;
    top: 13.8rem;
    animation: bk 11s infinite;
}

.smoke:after {
    content: "";
    width: 100px;
    height: 100px;
    background: none;
    position: absolute;
    background-image: -webkit-radial-gradient(42% 48%, ellipse, rgba(255, 255, 255, 0.2), transparent 25%), -webkit-radial-gradient(35% 70%, ellipse, rgba(255, 255, 255, 0.2), transparent 15%), -webkit-radial-gradient(42% 61%, ellipse, rgba(255, 255, 255, 0.2), transparent 10%);
    animation: smoke 2s 1s infinite;
    transform: rotate(18deg);
}

@keyframes float {
    0% {
        top: 6.7rem;
    }

    50% {
        top: 7rem;
    }

    100% {
        top: 6.7rem;
    }
}

@keyframes float2 {
    0% {
        top: 1.7rem;
    }

    50% {
        top: 2rem;
    }

    100% {
        top: 1.7rem;
    }
}

@keyframes float3 {
    0% {
        top: 7.4rem;
    }

    50% {
        top: 7.7rem;
    }

    100% {
        top: 7.4rem;
    }
}

@keyframes smoke {
    0% {
        background-position: 0 0;
        opacity: 0;
    }

    15%,
    85% {
        opacity: 1;
    }

    100% {
        background-position: -20px -25px, -5px -25px, 0px -25px, 0px -25px;
        opacity: 0;
    }
}

</style>

<div class="login-shape">
    <div class="objects">
        <div class="objects_computer"></div>
        <div class="objects_table"></div>
        <div class="objects_cup"></div>
        <div class="smoke"></div>
        <div class="objects_chair"></div>
    </div>
    <div class="box">
        <div class="box_1">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="box_2">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="box_3"></div>
    </div>
</div>
