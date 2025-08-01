  <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    .coffee-container {
        height: 100%;
        box-sizing: border-box;
          overflow: hidden;
      }

      .coffee-container {
          display: flex;
          flex-direction: row;
          justify-content: center;
          align-items: center;
          margin: 0;
          font-family: Poppins;
          /* background: #cebca6; */
      }

      @media screen and (max-height: 500px) {
          .coffee-container>* {
              scale: 0.8
          }

          ;
      }

      @media screen and (max-height: 430px) {
          .coffee-container>* {
              scale: 0.7
          }

          .options {
              translate: 259px 2px !important;
          }
      }

      .options {
          position: relative;
          width: 200px;
          display: flex;
          flex-direction: column;
          text-align: left;
          background: rgba(0, 0, 0, 0.04);
          padding: 12px;
      }

      .options>div {
          transition: all 0.1s ease-in-out;
      }

      .options>div:hover {
          background: rgba(255, 255, 255, 1);
          cursor: pointer;
          font-size: 22px;
          box-shadow:
              0 0 2px 0px rgba(0, 0, 0, 0.2),
              0 0 3px 2px rgba(255, 255, 255, 0.1),
              0 0 3px 0 rgba(0, 0, 0, 0.1);
          color: #462814be;
      }

      .options:hover>* {
          animation-play-state: paused;
      }

      .options {
          background: none;
          height: fit-content;
          position: absolute;
          left: 0;
          right: 0;
          top: 0;
          bottom: 0%;
          margin: auto;
          translate: 259px 12px;
          transform-origin: -157px 107%;
          rotate: -100deg;
      }

      @keyframes rotateC {
          0% {
              rotate: 0deg;
          }

          100% {
              rotate: 360deg;
          }
      }

      .options>div {
          --_speed: 4;
          color: #4628148e;
          position: absolute;
          border-radius: 4px;
          background-color: rgb(245, 236, 236);
          transform-origin: -145px 50%;
          padding: 4px 12px 1px 22px;
          -webkit-user-select: none;
          /* Safari */
          -ms-user-select: none;
          /* IE 10 and IE 11 */
          user-select: none;
          /* Standard syntax */
          animation: rotateC calc(var(--_speed) * 36s) linear infinite;
      }

      .options>div:nth-child(1) {
          animation-delay: calc(var(--_speed) * -1s);
      }

      .options>div:nth-child(2) {
          animation-delay: calc(var(--_speed) * -2s);
      }

      .options>div:nth-child(3) {
          animation-delay: calc(var(--_speed) * -3s);
      }

      .options>div:nth-child(4) {
          animation-delay: calc(var(--_speed) * -4s);
      }

      .options>div:nth-child(5) {
          animation-delay: calc(var(--_speed) * -5s);
      }

      .options>div:nth-child(6) {
          animation-delay: calc(var(--_speed) * -6s);
      }

      .options>div:nth-child(7) {
          animation-delay: calc(var(--_speed) * -7s);
      }

      .options>div:nth-child(8) {
          animation-delay: calc(var(--_speed) * -8s);
      }

      .options>div:nth-child(9) {
          animation-delay: calc(var(--_speed) * -9s);
      }

      .options>div:nth-child(10) {
          animation-delay: calc(var(--_speed) * -10s);
      }

      .options>div:nth-child(11) {
          animation-delay: calc(var(--_speed) * -11s);
      }

      .options>div:nth-child(12) {
          animation-delay: calc(var(--_speed) * -12s);
      }

      .options>div:nth-child(13) {
          animation-delay: calc(var(--_speed) * -13s);
      }

      .options>div:nth-child(14) {
          animation-delay: calc(var(--_speed) * -14s);
      }

      .options>div:nth-child(15) {
          animation-delay: calc(var(--_speed) * -15s);
      }

      .options>div:nth-child(16) {
          animation-delay: calc(var(--_speed) * -16s);
      }

      .options>div:nth-child(17) {
          animation-delay: calc(var(--_speed) * -17s);
      }

      .options>div:nth-child(18) {
          animation-delay: calc(var(--_speed) * -18s);
      }

      .options>div:nth-child(19) {
          animation-delay: calc(var(--_speed) * -19s);
      }

      .options>div:nth-child(20) {
          animation-delay: calc(var(--_speed) * -20s);
      }

      .options>div:nth-child(21) {
          animation-delay: calc(var(--_speed) * -21s);
      }

      .options>div:nth-child(22) {
          animation-delay: calc(var(--_speed) * -22s);
      }

      .options>div:nth-child(23) {
          animation-delay: calc(var(--_speed) * -23s);
      }

      .options>div:nth-child(24) {
          animation-delay: calc(var(--_speed) * -24s);
      }

      .options>div:nth-child(25) {
          animation-delay: calc(var(--_speed) * -25s);
      }

      .options>div:nth-child(26) {
          animation-delay: calc(var(--_speed) * -26s);
      }

      .options>div:nth-child(27) {
          animation-delay: calc(var(--_speed) * -27s);
      }

      .options>div:nth-child(28) {
          animation-delay: calc(var(--_speed) * -28s);
      }

      .options>div:nth-child(29) {
          animation-delay: calc(var(--_speed) * -29s);
      }

      .options>div:nth-child(30) {
          animation-delay: calc(var(--_speed) * -30s);
      }

      .options>div:nth-child(31) {
          animation-delay: calc(var(--_speed) * -31s);
      }

      .options>div:nth-child(32) {
          animation-delay: calc(var(--_speed) * -32s);
      }

      .options>div:nth-child(33) {
          animation-delay: calc(var(--_speed) * -33s);
      }

      .options>div:nth-child(34) {
          animation-delay: calc(var(--_speed) * -34s);
      }

      .options>div:nth-child(35) {
          animation-delay: calc(var(--_speed) * -35s);
      }

      .coffee-wrapper {
          position: relative;
          width: 300px;
          height: 300px;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 50%;
          background-color: #9b8c83;
          background:
              repeating-linear-gradient(45deg, #9c7154, #ffdfca 8px, #fff0 8px, #fff0 25px),
              repeating-linear-gradient(-45deg, #7a5943, #ffcaa6 8px, #fff0 8px, #fff0 25px);
          background-color: #533723;
          box-shadow:
              0 0 1px 1px #7a665a,
              0 0 4px 2px #9b8c83,
              inset 0 -630px 20px -500px #c59473,
              inset 0 -680px 40px -500px #9c7154,
              inset 0 -700px 0 -500px #775843;

          -webkit-user-select: none;
          -ms-user-select: none;
          user-select: none;
      }

      .shadow {
          position: absolute;
          top: 69.7%;
          left: 12%;
          width: 55%;
          height: 22px;
          border-radius: 50%;
          box-shadow:
              inset 0 0 0 100px rgba(0, 0, 0, 0.05);
          background:
              repeating-linear-gradient(-45deg, #0002, #0002 1px, #0000 1px, #0000 3px),
              repeating-linear-gradient(45deg, #0002, #0002 1px, #0000 1px, #0000 3px);
      }

      .title {
          height: fit-content;
          width: fit-content;
          position: absolute;
          left: 0;
          right: 0;
          bottom: 7%;
          margin: auto;
          display: flex;
          color: rgb(255, 255, 255);
          text-align: center;


          font-size: 20px;
          text-shadow:
              0 0 3px rgba(255, 255, 255, 0.5),
              0 0px 1px rgba(0, 0, 0, 0.7);
      }

      .cup {
          width: 160px;
          height: 162px;
          position: relative;
      }

      .contents {
          height: 100%;
          display: flex;
          flex-direction: column;
          justify-content: end;
          background: rgba(247, 247, 247, 0.9);
          clip-path: path('m 0 0 q 4.59 145.8 34.425 155.52 c 29.835 8.1 68.85 8.1 96.39 0 q 29.835 -9.72 29.835 -155.52 C 143 11 16 13 0 0 Z');
      }

      .contents::before {
          content: '';
          display: block;
          position: absolute;
          width: 100%;
          height: 100%;
          z-index: 1000;
          box-shadow:
              inset -18px 0px 4px -10px rgba(255, 255, 255, 0.7),
              inset 42px -22px 12px -10px rgba(0, 0, 0, 0.03),
              inset 0 -22px 12px -10px rgba(0, 0, 0, 0.2),
              inset 20px 0 10px -10px rgba(0, 0, 0, 0.2);
      }

      .cup::before {
          content: '';
          display: block;
          position: absolute;
          z-index: 2;
          top: -10px;
          width: 100%;
          height: 20px;
          background: linear-gradient(63deg, rgba(253, 253, 253, 0.7) 9%, rgba(238, 238, 238, 0.7) 100%);
          border-radius: 50%;
          box-shadow:
              0 1px 2px 0px rgba(0, 0, 0, 0.05),
              inset 0 0 1px 2px rgba(0, 0, 0, 0.05);
      }

      .cup::after {
          content: '';
          background: #fff;
          width: 0%;
          height: 0%;
          scale: 1.15 0.7;
          transform-origin: 0% 0%;
          z-index: 1;
          position: absolute;
          top: 0;
      }

      .contents :is(.foam, .cream, .steamed-milk, .milk, .chocolate, .sugar, .whiskey, .water, .gelato, .espresso, .coffee) {
          width: 100%;
          height: 0px;
          display: flex;
          justify-content: center;
          align-items: center;
          overflow: hidden;
          border-radius: 50% / 20%;
          font-size: 12px;
          transition: all 1s ease-in-out;
          opacity: 0.94;
          position: relative;
          margin-top: 0;
          padding-top: 0;
          color: rgba(0, 0, 0, 0);
          margin: 0 auto;
      }

      .contents :is(.foam, .cream, .steamed-milk, .milk, .chocolate, .sugar, .whiskey, .water, .espresso, .coffee)::before {
          content: '';
          display: block;
          width: 100%;
          height: 26px;
          border-radius: 50%;
          position: absolute;
          top: -10%;
          transition: all 1s ease-in-out;
          opacity: 0.1;
          background: white;
          z-index: inherit;
      }

      .contents :is(.foam, .cream, .steamed-milk, .milk)::before {
          background: rgb(141, 141, 141);
      }

      .contents .foam {
          background: #ffffff;
          z-index: 12;
      }

      .contents .cream {
          background: #fffbe7;
          z-index: 11;
      }

      .contents .steamed-milk {
          background: #fffcf8;
          z-index: 10;
      }

      .contents .milk {
          background: #f8f2e8;
          z-index: 9;
      }

      .contents .chocolate {
          background: #47260a;
          z-index: 8;
      }

      .contents .sugar {
          background: #ffffff;
          z-index: 7;
      }

      .contents .whiskey {
          background: rgba(207, 129, 39, 0.8);
          color: #fff;
          z-index: 6;
      }

      .contents .water {
          background: #e5f7ff;
          z-index: 5;
      }

      .contents .coffee {
          background: #5a341a;
          z-index: 4;
      }

      .contents .gelato {
          background: #fcf9ea;
          z-index: 4;
      }

      .contents .espresso {
          background: #462814;
          z-index: 3;
      }

      .contents .espresso span {
          display: none;
      }


      /* Black Coffee */
      .black .coffee {
          height: 90%;
          border-radius: 50% / 10%;
          padding-top: 0px;

          color: rgba(255, 255, 255, 1);
      }

      .black .coffee::before {
          opacity: 0.1;
          background: white;
          top: 0%;
      }

      /* Latte */
      .latte .espresso {
          color: rgba(255, 255, 255, 1);
          height: 30%;
          padding-top: 12px;
          margin-top: -20px;
      }

      .latte .steamed-milk {
          color: rgba(0, 0, 0, 1);
          height: 60%;
          margin-top: -20px;
          padding-top: 12px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .latte .foam {
          color: rgba(0, 0, 0, 1);
          height: 24%;
          padding-top: 22px;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .latte .foam::before {
          background: #faf8f5;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }


      /* Flat White */
      .flat-white .espresso {
          color: rgba(255, 255, 255, 1);
          height: 40%;
          margin-top: -21px;
          padding-top: 20px;
      }

      .flat-white .espresso::before {
          background: none;
      }

      .flat-white .steamed-milk {
          color: rgba(0, 0, 0, 1);
          height: 40%;
          margin-top: -20px;
          padding-top: 20px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .flat-white .steamed-milk::before {
          background: #faf8f5;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      /* Cappuccino */
      .cappuccino .espresso {
          color: rgba(255, 255, 255, 1);
          height: 30%;
          margin-top: -20px;
          padding-top: 20px;
      }

      .cappuccino .espresso::before {
          top: -33%;
      }

      .cappuccino .steamed-milk {
          color: rgba(0, 0, 0, 1);
          height: 30%;
          margin-top: -20px;
          padding-top: 20px;
      }

      .cappuccino .foam {
          color: rgba(0, 0, 0, 1);
          height: 40%;
          padding-top: 20px;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .cappuccino .foam::before {
          background: #faf8f5;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      /* Americano */
      .americano .water {
          color: rgba(0, 0, 0, 1);
          height: 60%;
          padding-top: 20px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .americano .water::before {
          background: #eff9fd;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
          top: 0;
      }

      .americano .espresso {
          color: rgba(255, 255, 255, 1);
          height: 30%;
          margin-top: -20px;
          padding-top: 20px;
      }

      /* Espresso */
      .cup.espresso .espresso {
          color: rgba(255, 255, 255, 1);
          height: 30%;
          margin-top: -20px;
          padding-top: 20px;
      }

      .cup.espresso .espresso::before {
          background: #9e4a12;
          opacity: 0.4;
      }

      /* Doppio */
      .doppio .espresso {
          color: rgba(255, 255, 255, 1);
          height: 40%;
          padding-top: 10px;
      }

      .doppio .espresso::before {
          background: #9e4a12;
          opacity: 0.4;
      }

      .doppio .espresso span {
          display: contents;
      }

      /* Cortado */
      .cortado .steamed-milk {
          color: rgba(0, 0, 0, 1);
          height: 30%;
          margin-top: -20px;
          padding-top: 20px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .cortado .steamed-milk::before {
          background: #faf8f5;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      .cortado .espresso {
          color: rgba(255, 255, 255, 1);
          height: 30%;
          margin-top: -20px;
          padding-top: 20px;
      }

      /* Macchiato */
      .macchiato .foam::before {
          background: #faf8f5;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      .macchiato .foam {
          color: rgba(0, 0, 0, 1);
          height: 30%;
          margin-top: -20px;
          padding-top: 20px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .macchiato .espresso {
          color: rgba(255, 255, 255, 1);
          height: 30%;
          margin-top: -20px;
          padding-top: 20px;
      }

      /* Mocha */
      .mocha .steamed-milk {
          color: rgba(0, 0, 0, 1);
          height: 40%;
          margin-top: -20px;
          padding-top: 20px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .mocha .steamed-milk::before {
          background: #faf8f5;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      .mocha .chocolate {
          color: rgba(255, 255, 255, 1);
          height: 25%;
          margin-top: -20px;
          padding-top: 20px;
          border-bottom: 1px dashed rgba(255, 255, 255, 0.5);
      }

      .mocha .espresso {
          color: rgba(255, 255, 255, 1);
          height: 40%;
          margin-top: -21px;
          padding-top: 20px;
      }

      .mocha .espresso::before {
          background: none;
      }

      /* Affogato */
      .affogato .gelato {
          opacity: 1;
          color: rgba(0, 0, 0, 1);
          height: 30%;
          padding-top: 10px;
          width: 60%;
          border-radius: 100% 100% 50% 50%;
          border: 1px dashed rgba(75, 75, 75, 0.5);
          border-bottom: none;
      }

      .affogato .espresso {
          margin-top: -16px;
          color: rgba(255, 255, 255, 1);
          height: 30%;
          padding-top: 10px;
      }

      .affogato .espresso::before {
          background: #9e4a12;
          opacity: 0.4;
      }

      /* Con Panna */
      .con-panna .cream {
          color: rgba(0, 0, 0, 1);
          height: 24%;
          padding-top: 20px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .con-panna .cream::before {
          background: #fcf9ea;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      .con-panna .espresso {
          margin-top: -16px;
          color: rgba(255, 255, 255, 1);
          height: 40%;
          padding-top: 10px;
      }

      .con-panna .espresso::before {
          opacity: 0;
      }

      /* Cafe Au Lait */
      .cafe-au-lait .steamed-milk {
          color: rgba(0, 0, 0, 1);
          height: 50%;
          padding-top: 10px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .cafe-au-lait .steamed-milk::before {
          background: #faf8f5;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      .cafe-au-lait .coffee {
          margin-top: -16px;
          color: rgba(255, 255, 255, 1);
          height: 50%;
          padding-top: 10px;
      }

      /* Irish */
      .irish .cream {
          color: rgba(0, 0, 0, 1);
          height: 24%;
          padding-top: 20px;
          border-top: 1px dashed rgba(75, 75, 75, 0.3);
      }

      .irish .cream::before {
          background: #fcf9ea;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      .irish .sugar {
          color: rgba(0, 0, 0, 1);
          height: 22%;
          margin-top: -18px;
          padding-top: 20px;
      }

      .irish .sugar::before {
          background: #fcf9ea;
          border-bottom: 1px dashed rgba(75, 75, 75, 0.5);
          opacity: 1;
      }

      .irish .whiskey {
          color: rgba(255, 255, 255, 1);
          height: 30%;
          margin-top: -18px;
          padding-top: 10px;
      }

      .irish .coffee {
          margin-top: -18px;
          color: rgba(255, 255, 255, 1);
          height: 40%;
          padding-top: 10px;
      }

      .irish .coffee::before {
          opacity: 0;
      }
  </style>

  <div class="coffee-container">

  <div class="options">
      <div>Black</div>
      <div>Flat White</div>
      <div>Latte</div>
      <div>Cappuccino</div>
      <div>Americano</div>
      <div>Espresso</div>
      <div>Doppio</div>
      <div>Cortado</div>
      <div>Macchiato</div>
      <div>Mocha</div>
      <div>Affogato</div>
      <div>Con Panna</div>
      <div>Irish</div>
      <div>Cafe Au Lait</div>

      <!-- vv repeats vv -->
      <div>Black</div>
      <div>Flat White</div>
      <div>Latte</div>
      <div>Cappuccino</div>
      <div>Americano</div>
      <div>Espresso</div>
      <div>Doppio</div>
      <div>Cortado</div>
      <div>Macchiato</div>
      <div>Mocha</div>
      <div>Affogato</div>
      <div>Con Panna</div>
      <div>Irish</div>
      <div>Cafe Au Lait</div>
      <div>Black</div>
      <div>Flat White</div>
      <div>Latte</div>
      <div>Cappuccino</div>
      <div>Americano</div>
      <div>Espresso</div>
      <div>Doppio</div>
      <div>Cortado</div>
  </div>

  <div class="coffee-wrapper">
      <div class="shadow"></div>
      <div class="title">Latte</div>
      <div class="cup latte">
          <div class="contents">
              <div class="gelato">gelato</div>
              <div class="foam">milk foam</div>
              <div class="cream">cream</div>
              <div class="steamed-milk">steamed milk</div>
              <div class="milk">milk</div>
              <div class="chocolate">chocolate</div>
              <div class="sugar">sugar</div>
              <div class="whiskey">whiskey</div>
              <div class="water">water</div>
              <div class="coffee">coffee</div>
              <div class="espresso"><span>(2)&nbsp;</span> espresso</div>
          </div>
      </div>
  </div>

  </div>
  <script>
      let options = document.querySelectorAll(".options div");
      let cup = document.querySelector(".cup");
      let title = document.querySelector(".title");

      function formatOption(option) {
          return option.toLowerCase().replace(/\s/g, "-");
      }

      options.forEach((option) => {
          option.addEventListener("click", function() {
              options.forEach((opt) => {
                  cup.classList.remove(formatOption(opt.textContent));
              });
              cup.classList.add(formatOption(this.textContent));
              title.innerHTML = this.textContent;
          });
      });
  </script>
