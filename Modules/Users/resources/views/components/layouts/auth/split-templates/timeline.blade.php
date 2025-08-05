<style>
    @layer demo {
        .timeline-container {
            /* background-color: #222; */
            background-image: radial-gradient(circle,
                    rgba(175, 208, 84, 0.25) 1px,
                    rgba(0, 0, 0, 0) 1px);
            background-size: 40px 40px;
            background-attachment: fixed;
            line-height: 1.5;
            height: 100vh;
            overflow: hidden;

            &::after {
                content: '';
                background-size: cover;
                background-image: url('data:image/svg+xml,<svg id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" version="1.1"><g id="surface1"><path fill="rgb(175, 208, 84)" d="M 47.894531 0.789062 C 46.320312 0.878906 45.480469 0.949219 44.601562 1.042969 C 37.023438 1.863281 29.746094 4.394531 23.386719 8.414062 C 20.214844 10.421875 17.402344 12.65625 14.757812 15.285156 C 7.773438 22.222656 3.027344 30.992188 1.113281 40.5 C -0.460938 48.332031 -0.132812 56.378906 2.070312 64.003906 C 4.0625 70.890625 7.507812 77.195312 12.277344 82.675781 C 16.65625 87.714844 22.109375 91.898438 28.074219 94.804688 C 37.914062 99.59375 49.078125 101.03125 59.875 98.886719 C 69.480469 96.976562 78.265625 92.300781 85.253906 85.371094 C 92.304688 78.386719 97.027344 69.65625 98.960938 60.039062 C 99.636719 56.675781 99.902344 53.996094 99.902344 50.285156 C 99.902344 47.910156 99.855469 46.925781 99.660156 45.128906 C 98.671875 35.808594 95.136719 27.136719 89.324219 19.773438 C 86.917969 16.722656 83.851562 13.675781 80.777344 11.285156 C 75.664062 7.304688 69.949219 4.410156 63.695312 2.628906 C 60.5625 1.742188 57.058594 1.128906 53.609375 0.867188 C 52.796875 0.804688 48.566406 0.746094 47.894531 0.789062 Z M 54.105469 24.300781 C 54.105469 24.355469 53.550781 25.921875 52.875 27.773438 L 51.636719 31.148438 L 41.390625 31.148438 C 34.375 31.148438 31 31.167969 30.683594 31.210938 C 27.867188 31.601562 25.414062 33.695312 24.371094 36.621094 C 24.054688 37.503906 23.910156 38.265625 23.839844 39.371094 C 23.800781 40.046875 23.789062 43.769531 23.804688 50.574219 C 23.828125 61.464844 23.816406 60.867188 24.101562 62.066406 C 24.316406 62.976562 24.832031 64.132812 25.339844 64.875 C 26.515625 66.597656 28.074219 67.726562 29.9375 68.203125 C 30.679688 68.394531 31.542969 68.433594 34.851562 68.433594 C 37.878906 68.433594 37.960938 68.441406 37.925781 68.542969 C 37.90625 68.601562 37.34375 70.148438 36.671875 71.972656 L 35.460938 75.296875 L 32.726562 75.296875 C 30.136719 75.296875 29.960938 75.285156 29.269531 75.164062 C 26.808594 74.714844 24.59375 73.707031 22.644531 72.152344 C 22.015625 71.648438 20.859375 70.496094 20.335938 69.847656 C 18.960938 68.15625 17.824219 65.824219 17.285156 63.601562 C 16.824219 61.660156 16.835938 62.175781 16.859375 49.355469 C 16.882812 36.71875 16.847656 37.765625 17.292969 35.953125 C 17.882812 33.523438 18.941406 31.398438 20.515625 29.5 C 21.140625 28.746094 21.625 28.257812 22.417969 27.597656 C 24.695312 25.699219 27.460938 24.53125 30.316406 24.265625 C 30.589844 24.234375 36.054688 24.210938 42.460938 24.207031 C 53.515625 24.199219 54.105469 24.207031 54.105469 24.300781 Z M 66.320312 24.363281 C 69.789062 24.90625 72.703125 26.371094 75.039062 28.757812 C 76.65625 30.402344 77.730469 32.21875 78.382812 34.417969 C 78.683594 35.445312 78.824219 36.347656 78.867188 37.523438 C 78.964844 40.515625 78.066406 43.320312 76.21875 45.777344 C 75.949219 46.136719 75.707031 46.445312 75.675781 46.460938 C 75.558594 46.539062 75.636719 46.605469 76.246094 47 C 80.933594 50.003906 83.621094 55.320312 83.308594 60.960938 C 83.027344 65.992188 80.328125 70.570312 76.113281 73.175781 C 74.453125 74.199219 72.570312 74.894531 70.546875 75.21875 L 69.757812 75.347656 L 56.425781 75.363281 L 43.085938 75.386719 L 43.273438 74.878906 C 43.371094 74.601562 43.949219 73.027344 44.546875 71.386719 L 45.640625 68.40625 L 57.613281 68.375 L 69.582031 68.347656 L 70.167969 68.191406 C 72.121094 67.652344 73.628906 66.617188 74.753906 65.019531 C 75.40625 64.097656 75.960938 62.777344 76.175781 61.632812 C 76.328125 60.832031 76.328125 59.308594 76.175781 58.503906 C 75.867188 56.859375 75.085938 55.316406 73.960938 54.152344 C 72.835938 52.976562 71.722656 52.308594 70.191406 51.894531 L 69.582031 51.730469 L 52.117188 51.703125 L 34.65625 51.671875 L 35.691406 48.835938 C 36.265625 47.273438 36.835938 45.703125 36.96875 45.351562 L 37.207031 44.695312 L 51.269531 44.679688 L 65.328125 44.667969 L 65.941406 44.511719 C 68.972656 43.753906 71.089844 41.820312 71.71875 39.214844 C 71.890625 38.496094 71.898438 37.390625 71.722656 36.699219 C 71.019531 33.839844 68.550781 31.78125 65.21875 31.253906 C 64.984375 31.21875 63.597656 31.171875 62.058594 31.15625 L 59.3125 31.121094 L 60.523438 27.789062 C 61.195312 25.960938 61.769531 24.398438 61.800781 24.324219 L 61.863281 24.183594 L 63.710938 24.21875 C 65.164062 24.242188 65.722656 24.269531 66.320312 24.363281 Z M 66.320312 24.363281 "/></g></svg>');
            }
        }

        /* Hide radio buttons */
        .cards-container input[type="radio"] {
            position: relative;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        .cards-container {
            --base-rotation: 0deg;
            --full-circle: 360deg;
            --radius: 20vw;
            --duration: 200ms;

            --cards-container-size: calc(var(--radius) * 2);
            --cards-container-padding: 2rem;

            --border-color: transparent;

            --label-offset: calc(var(--radius) * -1 - 1rem);
            --label-size: 30px;
            --label-color: #666;
            --label-color-hover: #f11420;
            --label-line-h: 0;
            --label-line-h-current: 2rem;
            --label-dot-size: 10px;

            --title-top: 1.5rem;
            --title-offset-y: 30px;

            --info-top: 5rem;
            --info-width: min(70%, 500px);
            --info-offset-y: 30px;

            box-sizing: content-box;
            position: relative;
            inset: 0;
            margin: auto;
            width: var(--cards-container-size);
            height: var(--cards-container-size);
            padding: var(--cards-container-padding);
            top: 20vh;
            @media (width > 600px) {
                clip-path: polygon(0 0, 100% 0, 100% 50%, 0 50%);
            }

            @media (min-width: 800px) {
                --radius: 20vw;
                --label-size: 40px;
                --label-dot-size: 15px;
                --label-line-h-current: 6rem;
                --title-top: 7rem;
                --info-top: 10rem;
            }
        }

        @media (min-width: 1200px) {
            --label-size: 50px;
            --border-color: var(--label-color);
        }

    }

    .cards {
        position: absolute;
        inset: var(--cards-container-padding);
        aspect-ratio: 1;
        border-radius: 50%;
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease-in-out var(--duration);
        list-style: none;
    }



    .cards li {
        position: absolute;
        inset: 0;
        margin: 0;
        padding: 0;
        transform-origin: center;
        display: grid;
        place-content: center;
        transform: rotate(calc(var(--i) * 360deg / var(--items)));
        pointer-events: none;
    }

    .cards li>label {
        position: absolute;
        inset: 0;
        margin: auto;
        transform: translateY(var(--label-offset));
        width: var(--label-size);
        height: var(--label-size);
        cursor: pointer;
        pointer-events: initial;
        text-align: center;
        color: var(--label-color);
        font-size: clamp(.8rem, 2.5vw + .04rem, 1rem);
        transition: var(--duration) ease-in-out;

    }

    .cards li>label::before {
        content: '';
        position: absolute;
        top: var(--cards-container-padding);
        left: 50%;
        translate: -50% 0;
        width: var(--label-dot-size);
        height: var(--label-dot-size);
        aspect-ratio: 50%;
        border-radius: 50%;
        background-color: var(--label-color);
        transition: background-color var(--duration) ease-in-out;
    }

    .cards li>label::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        translate: -50% 5px;
        width: 2px;
        height: var(--label-line-h);
        background-color: #f11420;
        transition: height 300ms ease-in-out var(--label-line-delay, 0ms);
    }

    .cards li>label:hover {
        --label-color: var(--label-color-hover);
    }

    .cards>li>h2,
    .cards>li>p {
        position: absolute;
        left: 50%;
        text-align: center;
        transform: translate(-50%, 0);
        transform-origin: center;
    }

    .cards>li>h2 {
        top: var(--title-top);
        opacity: var(--title-opacity, 0);
        translate: 0 var(--title-offset-y);
        transition: var(--duration) ease-in-out var(--title-delay, 0ms);
    }

    .cards>li>p {
        top: var(--info-top);
        margin: 0 auto;
        width: var(--info-width);
        z-index: 2;
        font-size: clamp(.8rem, 2.5vw + 0.05rem, .9rem);
        text-align: center;
        text-wrap: pretty;
        opacity: var(--info-opacity, 0);
        /*translate: 0 var( --info-offset-y);*/
        transition: var(--duration) ease-in-out var(--info-delay, 0ms);
    }

    /* update custom properties for checked item */
    li:has(input:checked) {
        --label-opacity: 1;
        --label-color: var(--label-color-hover);
        --label-line-h: var(--label-line-h-current);
        --label-line-delay: calc(var(--duration) * 2);

        --title-opacity: 1;
        --title-offset-y: 0;
        --title-delay: calc(var(--duration) * 3);

        --info-opacity: 1;
        --info-offset-y: 0;
        --info-delay: calc(var(--duration) * 4);
        /*outline: 1px dashed red;*/
    }

    /* rotate container based on checked radio */
    .cards:has(input:checked) {
        transform: rotate(calc(var(--base-rotation) - (var(--index) * var(--full-circle) / var(--items))));
    }

    /*
  this would be so much simpler if we could use counter values as custom property values
  */
    .cards:has(li:nth-child(1)>input:checked) {
        --index: 0;
    }

    .cards:has(li:nth-child(2)>input:checked) {
        --index: 1;
    }

    .cards:has(li:nth-child(3)>input:checked) {
        --index: 2;
    }

    .cards:has(li:nth-child(4)>input:checked) {
        --index: 3;
    }

    .cards:has(li:nth-child(5)>input:checked) {
        --index: 4;
    }

    .cards:has(li:nth-child(6)>input:checked) {
        --index: 5;
    }

    .cards:has(li:nth-child(7)>input:checked) {
        --index: 6;
    }

    .cards:has(li:nth-child(8)>input:checked) {
        --index: 7;
    }

    .cards:has(li:nth-child(9)>input:checked) {
        --index: 8;
    }

    .cards:has(li:nth-child(10)>input:checked) {
        --index: 9;
    }

    .cards:has(li:nth-child(11)>input:checked) {
        --index: 10;
    }

    .cards:has(li:nth-child(12)>input:checked) {
        --index: 11;
    }

    .cards:has(li:nth-child(13)>input:checked) {
        --index: 12;
    }

    .cards:has(li:nth-child(14)>input:checked) {
        --index: 13;
    }

    .cards:has(li:nth-child(15)>input:checked) {
        --index: 14;
    }

    .cards:has(li:nth-child(16)>input:checked) {
        --index: 15;
    }

    .cards:has(li:nth-child(17)>input:checked) {
        --index: 16;
    }

    .cards:has(li:nth-child(18)>input:checked) {
        --index: 17;
    }

    .cards:has(li:nth-child(19)>input:checked) {
        --index: 18;
    }

    .cards:has(li:nth-child(20)>input:checked) {
        --index: 19;
    }

    .cards:has(li:nth-child(21)>input:checked) {
        --index: 20;
    }

    .cards:has(li:nth-child(22)>input:checked) {
        --index: 21;
    }

    .cards:has(li:nth-child(23)>input:checked) {
        --index: 22;
    }

    .cards:has(li:nth-child(24)>input:checked) {
        --index: 23;
    }

    .cards:has(li:nth-child(25)>input:checked) {
        --index: 24;
    }

    .cards:has(li:nth-child(26)>input:checked) {
        --index: 25;
    }
    }
</style>

<div class="timeline-container">
    <div class="cards-container">
        <ul class="cards" style="--items: 26;">
            <li style="--i: 0;">
                <input type="radio" id="item-0" name="gallery-item" checked>
                <label for="item-0">2000</label>
                <h2>2000</h2>
                <p>
                • PlayStation 2 launch revolutionizes gaming
                • Nvidia GeForce 256 "world's first GPU"
                • AMD Athlon processors debut
                • USB 2.0 standard introduced
                • Windows ME release
                • Pentium 4 architecture
                • The Sims becomes cultural phenomenon
                • Counter-Strike mod gains popularity</p>
            </li>
            <li style="--i: 1;">
                <input type="radio" id="item-1" name="gallery-item">
                <label for="item-1">2001</label>
                <h2>2001</h2>
                <p>Microsoft Xbox enters console market • GameCube launches with innovative design • Game Boy Advance
                    portable gaming • Windows XP changes computing • GeForce 3 introduces programmable shaders • Halo:
                    Combat Evolved defines FPS • Grand Theft Auto: Vice City • iPod revolutionizes media • Pentium 4
                    expands
                    market reach</p>
            </li>
            <li style="--i: 2;">
                <input type="radio" id="item-2" name="gallery-item">
                <label for="item-2">2002</label>
                <h2>2002</h2>
                <p>Xbox Live beta transforms online gaming • Steam platform announced by Valve • ATI Radeon 9700 Pro
                    graphics power • Intel Hyper-Threading technology • DDR2 memory standard development • Battlefield
                    1942
                    multiplayer warfare • Warcraft III real-time strategy • Metroid Prime 3D adventure • Vice City's
                    massive
                    commercial success</p>
            </li>
            <li style="--i: 3;">
                <input type="radio" id="item-3" name="gallery-item">
                <label for="item-3">2003</label>
                <h2>2003</h2>
                <p>AMD Athlon 64 brings 64-bit computing • Half-Life 2 announcement generates hype • Steam digital
                    distribution platform launches • Call of Duty franchise debut • Nokia N-Gage gaming phone • Nvidia
                    GeForce FX series • SATA interface replaces IDE • PCI Express development begins • World of Warcraft
                    enters beta testing</p>
            </li>
            <li style="--i: 4;">
                <input type="radio" id="item-4" name="gallery-item">
                <label for="item-4">2004</label>
                <h2>2004</h2>
                <p>World of Warcraft launches MMO revolution • Half-Life 2 releases with Source engine • Nintendo DS
                    dual-screen innovation • PlayStation Portable announced • PCI Express adoption accelerates • GeForce
                    6800 series performance • Doom 3 showcases advanced graphics • Far Cry debuts with CryEngine •
                    Windows
                    XP 64-bit edition</p>
            </li>
            <li style="--i: 5;">
                <input type="radio" id="item-5" name="gallery-item">
                <label for="item-5">2005</label>
                <h2>2005</h2>
                <p>PlayStation Portable global launch • Xbox 360 starts next generation • GeForce 7800 GTX graphics
                    leadership • Intel/AMD dual-core processors • YouTube platform launches • Guitar Hero music gaming
                    phenomenon • Shadow of the Colossus artistic achievement • F.E.A.R. advances horror gaming • Call of
                    Duty 2 next-gen showcase</p>
            </li>
            <li style="--i: 6;">
                <input type="radio" id="item-6" name="gallery-item">
                <label for="item-6">2006</label>
                <h2>2006</h2>
                <p>PlayStation 3 launches with Blu-ray • Nintendo Wii motion control revolution • GeForce 8800 series
                    performance leap • Intel Core 2 Duo architecture • DirectX 10 development preview • Gears of War
                    cover-based combat • Elder Scrolls IV: Oblivion open world • Crysis announcement pushes boundaries •
                    Blu-ray vs HD-DVD format war</p>
            </li>
            <li style="--i: 7;">
                <input type="radio" id="item-7" name="gallery-item">
                <label for="item-7">2007</label>
                <h2>2007</h2>
                <p>Crysis becomes graphics benchmark • Call of Duty 4: Modern Warfare multiplayer • iPhone introduces
                    mobile
                    gaming potential • Portal introduces innovative mechanics • Mass Effect RPG storytelling • DirectX
                    10
                    gaming implementation • Intel quad-core processors • HD gaming becomes standard • Steam platform
                    major
                    expansion</p>
            </li>
            <li style="--i: 8;">
                <input type="radio" id="item-8" name="gallery-item">
                <label for="item-8">2008</label>
                <h2>2008</h2>
                <p>Apple App Store launches mobile gaming • Android Market competition begins • Grand Theft Auto IV open
                    world excellence • Left 4 Dead cooperative gameplay • Dead Space survival horror • Fallout 3
                    franchise
                    revival • SSD technology adoption • Intel Core i7 processors • AMD Radeon HD 4000 series</p>
            </li>
            <li style="--i: 9;">
                <input type="radio" id="item-9" name="gallery-item">
                <label for="item-9">2009</label>
                <h2>2009</h2>
                <p>OnLive cloud gaming streaming service • Minecraft alpha creative phenomenon • League of Legends MOBA
                    success • Modern Warfare 2 breaks records • Assassin's Creed II refinement • Windows 7 gaming
                    improvements • GeForce GTX 200 series • USB 3.0 standard introduction • iPad announcement hints at
                    future</p>
            </li>
            <li style="--i: 10;">
                <input type="radio" id="item-10" name="gallery-item">
                <label for="item-10">2010</label>
                <h2>2010</h2>
                <p>Microsoft Kinect motion gaming launch • PlayStation Move motion controllers • iPad gaming market
                    emergence • StarCraft II esports foundation • Red Dead Redemption western epic • Mass Effect 2
                    narrative
                    excellence • GeForce GTX 400 series • Intel Sandy Bridge preview • 3D gaming technology push</p>
            </li>
            <li style="--i: 11;">
                <input type="radio" id="item-11" name="gallery-item">
                <label for="item-11">2011</label>
                <h2>2011</h2>
                <p>PlayStation Vita handheld powerhouse • Nintendo 3DS stereoscopic gaming • Intel Sandy Bridge CPU
                    revolution • Elder Scrolls V: Skyrim open world • Portal 2 cooperative gameplay • Battlefield 3
                    Frostbite engine • Modern Warfare 3 conclusion • AMD Radeon HD 6000 series • Thunderbolt interface
                    debut
                </p>
            </li>
            <li style="--i: 12;">
                <input type="radio" id="item-12" name="gallery-item">
                <label for="item-12">2012</label>
                <h2>2012</h2>
                <p>Steam Greenlight indie game platform • Journey artistic gaming experience • Diablo III online-only
                    controversy • Mass Effect 3 trilogy conclusion • XCOM franchise strategic revival • GeForce GTX 600
                    series efficiency • Intel Ivy Bridge processors • Windows 8 gaming integration • Ouya Android
                    console
                </p>
            </li>
            <li style="--i: 13;">
                <input type="radio" id="item-13" name="gallery-item">
                <label for="item-13">2013</label>
                <h2>2013</h2>
                <p>PlayStation 4 next-generation launch • Xbox One multimedia entertainment • Steam OS Linux gaming •
                    Grand
                    Theft Auto V record-breaking • The Last of Us emotional storytelling • BioShock Infinite narrative
                    complexity • GeForce GTX 700 series • Intel Haswell architecture • AMD Mantle API introduction</p>
            </li>
            <li style="--i: 14;">
                <input type="radio" id="item-14" name="gallery-item">
                <label for="item-14">2014</label>
                <h2>2014</h2>
                <p>Oculus Rift DK2 VR development • PlayStation VR announcement • Destiny shared-world shooter • Dragon
                    Age:
                    Inquisition RPG return • Far Cry 4 open world chaos • GeForce GTX 900 series Maxwell • DDR4 memory
                    standard • Intel Broadwell processors • Valve Steam Machines</p>
            </li>
            <li style="--i: 15;">
                <input type="radio" id="item-15" name="gallery-item">
                <label for="item-15">2015</label>
                <h2>2015</h2>
                <p>DOTA 2 International esports growth • CS:GO Major tournament expansion • The Witcher 3 open world
                    excellence • Fallout 4 post-apocalyptic return • Metal Gear Solid V stealth perfection • DirectX 12
                    API
                    launch • AMD Radeon R9 Fury HBM • Intel Skylake architecture • Windows 10 gaming features</p>
            </li>
            <li style="--i: 16;">
                <input type="radio" id="item-16" name="gallery-item">
                <label for="item-16">2016</label>
                <h2>2016</h2>
                <p>Oculus Rift consumer VR launch • HTC Vive room-scale VR • PlayStation VR mainstream adoption •
                    GeForce
                    GTX 10 series Pascal • Overwatch team-based phenomenon • Doom 2016 franchise revival • No Man's Sky
                    procedural hype • Intel Kaby Lake preview • Pokémon GO augmented reality</p>
            </li>
            <li style="--i: 17;">
                <input type="radio" id="item-17" name="gallery-item">
                <label for="item-17">2017</label>
                <h2>2017</h2>
                <p>Nintendo Switch hybrid console innovation • Zelda: Breath of the Wild freedom • PlayerUnknown's
                    Battlegrounds battle royale • Horizon Zero Dawn robot hunting • Super Mario Odyssey platforming joy
                    •
                    AMD Ryzen CPU competition • Intel Coffee Lake processors • Xbox One X enhanced power •
                    Cryptocurrency
                    mining GPU shortage</p>
            </li>
            <li style="--i: 18;">
                <input type="radio" id="item-18" name="gallery-item">
                <label for="item-18">2018</label>
                <h2>2018</h2>
                <p>Fortnite cultural phenomenon peak • Red Dead Redemption 2 western masterpiece • God of War franchise
                    reboot • Spider-Man PS4 web-swinging • GeForce RTX 20 series ray tracing • Real-time ray tracing
                    gaming
                    • AMD Radeon RX 500 series • Intel 9th generation Core • Game streaming services growth</p>
            </li>
            <li style="--i: 19;">
                <input type="radio" id="item-19" name="gallery-item">
                <label for="item-19">2019</label>
                <h2>2019</h2>
                <p>Google Stadia cloud gaming launch • GeForce Now streaming beta • Death Stranding unique experience •
                    Control ray tracing showcase • Modern Warfare 2019 reboot • AMD Ryzen 3000 series Zen 2 • RDNA
                    architecture debut • PCIe 4.0 storage speeds • Mobile gaming revenue dominance</p>
            </li>
            <li style="--i: 20;">
                <input type="radio" id="item-20" name="gallery-item">
                <label for="item-20">2020</label>
                <h2>2020</h2>
                <p>PlayStation 5 SSD revolution • Xbox Series X/S quick resume • Cyberpunk 2077 launch controversy •
                    Animal
                    Crossing pandemic comfort • Among Us viral social success • GeForce RTX 30 series Ampere • AMD Ryzen
                    5000 gaming leadership • RDNA 2 console graphics • Gaming industry pandemic boom</p>
            </li>
            <li style="--i: 21;">
                <input type="radio" id="item-21" name="gallery-item">
                <label for="item-21">2021</label>
                <h2>2021</h2>
                <p>Global GPU shortage crisis • Steam Deck handheld PC announcement • Resident Evil Village horror
                    return •
                    It Takes Two cooperative excellence • Metroid Dread 2D revival • Intel 11th generation Core • DDR5
                    memory launch • Windows 11 gaming optimizations • NFT gaming controversy emergence</p>
            </li>
            <li style="--i: 22;">
                <input type="radio" id="item-22" name="gallery-item">
                <label for="item-22">2022</label>
                <h2>2022</h2>
                <p>Steam Deck handheld PC launch • Elden Ring open world mastery • God of War PC port success • Horizon
                    Forbidden West sequel • GeForce RTX 40 series Ada • AMD Ryzen 7000 AM5 platform • Intel Arc graphics
                    competition • RDNA 3 architecture preview • Blockchain gaming decline</p>
            </li>
            <li style="--i: 23;">
                <input type="radio" id="item-23" name="gallery-item">
                <label for="item-23">2023</label>
                <h2>2023</h2>
                <p>DLSS 3 Frame Generation AI • Zelda: Tears of the Kingdom physics • Baldur's Gate 3 RPG renaissance •
                    Spider-Man 2 PS5 showcase • AMD FSR 3 competition • Intel 13th generation Raptor Lake • RDNA 3 RX
                    7000
                    launch • PlayStation Portal remote play • AI-assisted game development</p>
            </li>
            <li style="--i: 24;">
                <input type="radio" id="item-24" name="gallery-item">
                <label for="item-24">2024</label>
                <h2>2024</h2>
                <p>GeForce RTX 50 series anticipation • Final Fantasy VII Rebirth epic • Helldivers 2 cooperative
                    success •
                    Black Myth: Wukong technical marvel • Intel Core Ultra rebrand • AMD Ryzen 8000 APUs • PlayStation 5
                    Pro
                    enhanced • OLED gaming monitor adoption • AI-powered NPC conversations</p>
            </li>
            <li style="--i: 25;">
                <input type="radio" id="item-25" name="gallery-item">
                <label for="item-25">2025</label>
                <h2>2025</h2>
                <p>Nintendo Switch 2 successor rumors • Grand Theft Auto VI development • Next-generation VR headsets •
                    8K
                    gaming potential • Quantum computing research • Neural processing unit integration • Brain-computer
                    interface experiments • Holographic display prototypes • Metaverse gaming platform evolution</p>
            </li>
        </ul>
    </div>
</div>
