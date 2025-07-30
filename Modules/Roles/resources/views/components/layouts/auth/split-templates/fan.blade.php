<style>
    *,
*:after,
*:before {
  box-sizing: border-box;
  transform-style: preserve-3d;
}
:root {
  --blade-speed: 1;
  --rotation: 25;
  --fan-speed: 2;
  --state: running;
  --shade-one: #f2f2f2;
  --shade-two: #e6e6e6;
  --shade-three: #d9d9d9;
  --shade-four: #ccc;
  --shade-five: #bfbfbf;
  --shade-six: #b3b3b3;
  --shade-seven: #a6a6a6;
  --shade-eight: #999;
  --cage-one: rgba(255,255,255,0.4);
  --cage-two: rgba(255,255,255,0.2);
}
.fan-container {
  min-height: 100vh;
  display: grid;
  place-items: center;
  overflow: hidden;
  transform: scale(0.75);
}
.fan-container img {
  height: 20%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate3d(-50%, -50%, 1px);
  filter: grayscale(1);
  opacity: 0.5;
}
.fan-container input[type="radio"] {
  position: fixed;
  top: 0;
  left: 100%;
  opacity: 0;
}
.fan-container #zero:checked ~ .scene {
  --blade-speed: 0;
  --state: paused;
}
.fan-container #zero:checked ~ .scene .fan__stalk {
  transform: translate(-50%, 25%);
}
.fan-container #one:checked ~ .scene {
  --blade-speed: 1;
  --state: running;
}
.fan-container #one:checked ~ .scene .fan__control:nth-of-type(2) {
  transition: transform 0.1s cubic-bezier(0, 1.4, 0.2, 1.4);
  transform: translate(0, 50%);
}
.fan-container #two:checked ~ .scene {
  --blade-speed: 0.5;
  --state: running;
}
.fan-container #two:checked ~ .scene .fan__control:nth-of-type(3) {
  transition: transform 0.1s cubic-bezier(0, 1.4, 0.2, 1.4);
  transform: translate(0, 50%);
}
.fan-container #three:checked ~ .scene {
  --blade-speed: 0.25;
  --state: running;
}
.fan-container #three:checked ~ .scene .fan__control:nth-of-type(4) {
  transition: transform 0.1s cubic-bezier(0, 1.4, 0.2, 1.4);
  transform: translate(0, 50%);
}
.fan-container .cuboid {
  width: 100%;
  height: 100%;
  position: relative;
}
.fan-container .cuboid__side:nth-of-type(1) {
  height: calc(var(--thickness) * 1vmin);
  width: 100%;
  position: absolute;
  top: 0;
  transform: translate(0, -50%) rotateX(90deg);
}
.fan-container .cuboid__side:nth-of-type(2) {
  height: 100%;
  width: calc(var(--thickness) * 1vmin);
  position: absolute;
  top: 50%;
  right: 0;
  transform: translate(50%, -50%) rotateY(90deg);
}
.fan-container .cuboid__side:nth-of-type(3) {
  width: 100%;
  height: calc(var(--thickness) * 1vmin);
  position: absolute;
  bottom: 0;
  transform: translate(0%, 50%) rotateX(90deg);
}
.fan-container .cuboid__side:nth-of-type(4) {
  height: 100%;
  width: calc(var(--thickness) * 1vmin);
  position: absolute;
  left: 0;
  top: 50%;
  transform: translate(-50%, -50%) rotateY(90deg);
}
.fan-container .cuboid__side:nth-of-type(5) {
  height: 100%;
  width: 100%;
  transform: translate3d(0, 0, calc(var(--thickness) * 0.5vmin));
  position: absolute;
  top: 0;
  left: 0;
}
.fan-container .cuboid__side:nth-of-type(6) {
  height: 100%;
  width: 100%;
  transform: translate3d(0, 0, calc(var(--thickness) * -0.5vmin)) rotateY(180deg);
  position: absolute;
  top: 0;
  left: 0;
}
:root {
  --height: 70vmin;
  --width: 40vmin;
}
.fan-container label {
  transition: transform 0.1s;
  cursor: pointer;
}
.fan-container label:hover {
  transform: translate(0, 20%);
}
.fan-container label:active {
  transform: translate(0, 40%);
}
.fan-container .scene {
  position: absolute;
  height: var(--width);
  width: var(--width);
  top: 50%;
  left: 50%;
  transform: translate3d(-50%, -50%, 0vmin) rotateX(-24deg) rotateY(34deg) rotateX(90deg);
}
.fan-container .fan {
  height: var(--height);
  width: var(--width);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotateX(-90deg) rotateX(calc(var(--rotateX, 0) * 1deg)) rotateY(calc(var(--rotateY, 0) * 1deg));
}
.fan-container .fan__base {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translate(-50%, 0);
  height: 8%;
  width: 80%;
}
.fan-container .fan__controls {
  height: 6%;
  width: 50%;
  position: absolute;
  bottom: 6%;
  left: 50%;
  transform: translate3d(-50%, 0, calc(var(--width) * 0.3));
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 6%;
}
.fan-container .fan__housing {
  height: 150%;
  width: 150%;
  border-radius: 50%;
  top: 50%;
  left: 50%;
  position: absolute;
  border: 1vmin solid var(--shade-one);
  background: var(--cage-one);
  transform: translate3d(-50%, -50%, calc(var(--width) * 0.45));
}
.fan-container .fan__housing-rear,
.fan-container .fan__housing-front {
  position: absolute;
  top: 50%;
  left: 50%;
  height: 80%;
  width: 80%;
  background: var(--cage-two);
  border-radius: 50%;
  border: 1vmin solid var(--shade-one);
}
.fan-container .fan__housing-front {
  transform: translate3d(-50%, -50%, calc(var(--width) * 0.11));
}
.fan-container .fan__housing-front:after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  height: 35%;
  width: 35%;
  transform: translate(-50%, -50%);
  border-radius: 50%;
  background: var(--shade-one);
}
.fan-container .fan__housing-rear {
  transform: translate3d(-50%, -50%, calc(var(--width) * -0.1));
  border: 1vmin solid var(--shade-two);
}
.fan-container .fan__head {
  height: var(--width);
  width: var(--width);
  position: absolute;
  top: 0;
  left: 0;
  transform: translate3d(0, 0, calc(var(--width) * -0.25));
  -webkit-animation: fan calc(var(--fan-speed, 1) * 1s) infinite alternate ease-in-out var(--state);
          animation: fan calc(var(--fan-speed, 1) * 1s) infinite alternate ease-in-out var(--state);
}
.fan-container .fan__rotater {
  top: 50%;
  width: calc(var(--width) * 0.2);
  height: calc(var(--width) * 0.2);
  position: absolute;
  left: 50%;
  transform: translate(-50%, -50%);
}
.fan-container .fan__spine {
  height: 57.5%;
  bottom: 8%;
  width: 20%;
  position: absolute;
  left: 50%;
  transform: translate3d(-50%, 0%, calc(var(--width) * -0.25));
}
.fan-container .fan__stalk {
  height: 150%;
  left: 50%;
  bottom: 0;
  transform: translate(-50%, 0);
  transition: transform 0.2s cubic-bezier(0, 1.4, 0.2, 1.4);
  width: 25%;
  position: absolute;
}
.fan-container .fan__blades {
  position: absolute;
  top: 50%;
  left: 50%;
  height: 16%;
  width: 16%;
  transform: translate3d(-50%, -50%, -1px) rotate(0deg);
  -webkit-animation: rotate calc(var(--blade-speed, 0) * 1s) infinite linear;
          animation: rotate calc(var(--blade-speed, 0) * 1s) infinite linear;
}
.fan-container .fan__blade {
  height: 300%;
  width: 100%;
  background: var(--shade-one);
  position: absolute;
  top: 50%;
  left: 50%;
  transform-origin: 50% 0;
  transform: translate(-50%, 0) rotate(calc(var(--rotate, 0) * 1deg));
}
.fan-container .fan__blade:nth-of-type(1) {
  --rotate: 0;
}
.fan-container .fan__blade:nth-of-type(2) {
  --rotate: calc(360 / 3 * 1);
}
.fan-container .fan__blade:nth-of-type(3) {
  --rotate: calc(360 / 3 * 2);
}
.fan-container .fan__barrel {
  height: 22.5%;
  width: 22.5%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate3d(-50%, -50%, calc(var(--width) * 0.3));
}
.fan-container .base {
  --thickness: calc(40 * 0.8);
}
.fan-container .base div {
  background: var(--shade-two);
}
.fan-container .base div:nth-of-type(1) {
  background: var(--shade-one);
}
.fan-container .base div:nth-of-type(5) {
  background: var(--shade-three);
}
.fan-container .base div:nth-of-type(4) {
  background: va(--shade-six);
}
.fan-container .control {
  --thickness: calc(((40 * 0.5) - ((40 * 0.5) * 0.18)) / 3);
}
.fan-container .control div {
  background: var(--shade-five);
}
.fan-container .control div:nth-of-type(1) {
  background: var(--shade-three);
}
.fan-container .control div:nth-of-type(5) {
  background: var(--shade-six);
}
.fan-container .control div:nth-of-type(4) {
  background: va(--shade-eight);
}
.fan-container .fan__control:nth-of-type(1) .control {
  --shade-three: #f08389;
  --shade-five: #e24451;
  --shade-six: #d42736;
  --shade-eight: #ad040f;
}
.fan-container .spine {
  --thickness: calc(40 * 0.2);
}
.fan-container .spine div {
  background: var(--shade-three);
}
.fan-container .spine div:nth-of-type(1) {
  background: var(--shade-two);
}
.fan-container .spine div:nth-of-type(5) {
  background: var(--shade-four);
}
.fan-container .spine div:nth-of-type(4) {
  background: va(--shade-seven);
}
.fan-container .rotater {
  --thickness: calc(40 * 0.2);
}
.fan-container .rotater div {
  background: var(--shade-two);
}
.fan-container .rotater div:nth-of-type(1) {
  background: var(--shade-one);
}
.fan-container .rotater div:nth-of-type(5) {
  background: var(--shade-three);
}
.fan-container .rotater div:nth-of-type(4) {
  background: va(--shade-six);
}
.fan-container .barrel {
  --thickness: calc(40 * 0.5);
}
.fan-container .barrel div {
  background: var(--shade-three);
}
.fan-container .barrel div:nth-of-type(1) {
  background: var(--shade-two);
}
.fan-container .barrel div:nth-of-type(5) {
  background: var(--shade-four);
}
.fan-container .barrel div:nth-of-type(4) {
  background: va(--shade-seven);
}
.fan-container .stalk {
  --thickness: calc(40 * 0.05);
}
.fan-container .stalk div {
  background: var(--shade-four);
}
.fan-container .stalk div:nth-of-type(1) {
  background: var(--shade-three);
}
.fan-container .stalk div:nth-of-type(5) {
  background: var(--shade-five);
}
.fan-container .stalk div:nth-of-type(4) {
  background: va(--shade-eight);
}
@-webkit-keyframes fan {
  0%, 5% {
    transform: translate3d(0, 0, calc(var(--width) * -0.25)) rotateY(calc(var(--rotation, 0) * 1deg));
  }
  95%, 100% {
    transform: translate3d(0, 0, calc(var(--width) * -0.25)) rotateY(calc(var(--rotation, 0) * -1deg));
  }
}
@keyframes fan {
  0%, 5% {
    transform: translate3d(0, 0, calc(var(--width) * -0.25)) rotateY(calc(var(--rotation, 0) * 1deg));
  }
  95%, 100% {
    transform: translate3d(0, 0, calc(var(--width) * -0.25)) rotateY(calc(var(--rotation, 0) * -1deg));
  }
}
@-webkit-keyframes rotate {
  from {
    transform: translate3d(-50%, -50%, -1px) rotate(0deg);
  }
  to {
    transform: translate3d(-50%, -50%, -1px) rotate(360deg);
  }
}
@keyframes rotate {
  from {
    transform: translate3d(-50%, -50%, -1px) rotate(0deg);
  }
  to {
    transform: translate3d(-50%, -50%, -1px) rotate(360deg);
  }
}

</style>

<div class="fan-container">
<input type="radio" name="fan" id="zero"/>
<input type="radio" name="fan" id="one" checked="true"/>
<input type="radio" name="fan" id="two"/>
<input type="radio" name="fan" id="three"/>
<div class="scene">
  <div class="fan">
    <div class="fan__base">
      <div class="cuboid base">
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
      </div>
    </div>
    <div class="fan__controls">
      <label class="fan__control" for="zero">
        <div class="cuboid control">
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
        </div>
      </label>
      <label class="fan__control" for="one">
        <div class="cuboid control">
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
        </div>
      </label>
      <label class="fan__control" for="two">
        <div class="cuboid control">
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
        </div>
      </label>
      <label class="fan__control" for="three">
        <div class="cuboid control">
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
        </div>
      </label>
    </div>
    <div class="fan__spine">
      <div class="cuboid spine">
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
        <div class="cuboid__side"></div>
      </div>
    </div>
    <div class="fan__head">
      <div class="fan__rotater">
        <div class="cuboid rotater">
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
        </div>
        <div class="fan__stalk">
          <div class="cuboid stalk">
            <div class="cuboid__side"></div>
            <div class="cuboid__side"></div>
            <div class="cuboid__side"></div>
            <div class="cuboid__side"></div>
            <div class="cuboid__side"></div>
            <div class="cuboid__side"></div>
          </div>
        </div>
      </div>
      <div class="fan__barrel">
        <div class="cuboid barrel">
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
          <div class="cuboid__side"></div>
        </div>
      </div>
      <div class="fan__housing">
        <div class="fan__housing-rear"></div>
        <div class="fan__blades">
          <div class="fan__blade"></div>
          <div class="fan__blade"></div>
          <div class="fan__blade"></div>
        </div>
        <div class="fan__housing-front"><img src="https://arabhardware.net/theme-assets/images/logo.svg"/></div>
      </div>
    </div>
  </div>
</div>
</div>
