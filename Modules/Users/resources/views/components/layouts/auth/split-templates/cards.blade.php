<style>
    :root {
        --title: "Card Mind Reader";
        --author: "Matt Cannon";
        --contact: "mc@mattcannon.design";
        --description: "An immersive mind-reading experience using binary search algorithms disguised as a magical card trick. Cards fan out beautifully while a smoky backdrop creates atmosphere. Watch as your chosen card mysteriously floats and glows after the divination process is complete.";
        --keywords: "card trick, mentalism, binary search, magic, playing cards, interactive magic, card divination, digital illusion, floating cards, magical algorithm, mind reading, responsive design, animation effects, smoky background";
        --last-modified: "2025-04-07";
        --content-language: "en";
        --generator: "HTML5, CSS3, JavaScript, animation effects, binary search algorithm, API integration, card magic";
    }

    .stage {
        font-family: "Unica One", sans-serif;
        color: #fff;
        text-align: center;
        padding: 25vh 0 25vh 0;
        margin: 0;
        overflow-x: hidden;
        max-height: 100vh;
    }


    .stage #smoke-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -3;
        pointer-events: none;
        opacity: 0.25;
        animation: videoFadeInOut 10s ease-in-out infinite;
    }

    @keyframes videoFadeInOut {

        0%,
        100% {
            opacity: 0.25;
        }

        40% {
            opacity: 0.05;
        }

        60% {
            opacity: 0.05;
        }
    }

    @keyframes videoFadeLoop {

        0%,
        95% {
            opacity: 0;
        }

        98% {
            opacity: 0.25;
        }

        100% {
            opacity: 0;
        }
    }

    .stage h2 {
        font-size: 2.3rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .stage .card-container {
        position: relative;
        width: 100%;
        max-width: 1000px;
        margin: 2rem auto 3rem auto;
        height: 180px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        pointer-events: none;
    }

    .stage .card-container img {
        position: absolute;
        bottom: 0;
        width: 90px;
        transform-origin: bottom center;
        border-radius: 8px;
        transform: scale(1.15) rotate(0deg);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        pointer-events: auto;
        left: 50%;
        z-index: 1;
    }

    .stage .card-container img:hover {
        transform: scale(1.15) rotate(0deg);
        box-shadow: none;
        z-index: 2;
    }

    .stage #card-pick {
        margin-top: 5px;
    }

    .stage #card-group {
        margin-top: -15px;
    }

    .stage .final-reveal {
        justify-content: center;
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        position: relative;
        height: 200px;
        width: 100%;
    }

    .stage .final-reveal img {
        position: absolute;
        width: 150px;
        animation: smoothReveal 0.8s ease-out forwards,
            floatGlow 1.5s ease-in-out infinite alternate,
            floatUp 5s ease-in-out infinite;
        opacity: 0;
        transform: scale(0.6) translateY(60px);
        left: calc(50% - 75px);
        transform-origin: center center;
        margin: 0;
        border-radius: 8px;
    }

    @keyframes smoothReveal {
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes floatGlow {
        0% {
            transform: scale(1) translateY(0);
        }

        100% {
            transform: scale(1.05) translateY(-10px);
        }
    }

    @keyframes floatUp {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 0;
        }

        50% {
            transform: translateY(-100px) rotate(5deg);
            opacity: 0.7;
        }

        100% {
            transform: translateY(-200px) rotate(-5deg);
            opacity: 0;
        }
    }

    .stage button {
        font-family: "Unica One", sans-serif;
        background: #111;
        color: white;
        border: 2px solid white;
        font-weight: 600;
        font-size: 1rem;
        padding: 10px 20px;
        margin-top: 1rem;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .stage button:hover {
        background: #fff;
        color: #111;
    }

    .stage .hidden {
        display: none;
    }

    @media (max-width: 768px) {
        .stage h2 {
            font-size: 1.6rem;
        }

        .stage .card-container {
            height: 130px;
        }

        .stage .card-container img {
            width: 70px;
        }

        .stage .final-reveal img {
            width: 110px;
        }
    }
</style>


<div id="stage" class="stage">
    <h2 id="main-title">PICK A CARD & REMEMBER IT</h2>
    <div id="step-1">
        <div id="card-pick" class="card-container"></div>
        <button onclick="startTrick()"><i class="fa-solid fa-wand-magic-sparkles"></i> I'VE PICKED ONE</button>
    </div>
    <div id="step-2" class="hidden">
        <h2>DO YOU SEE YOUR CARD?</h2>
        <div id="group-controls">
            <button onclick="answer(true)"><i class="fa-solid fa-check"></i> YES</button>
            <button onclick="answer(false)"><i class="fa-solid fa-xmark"></i> NO</button>
        </div>
        <div id="card-group" class="card-container"></div>
    </div>
    <div id="step-3" class="hidden">
        <h2>YOU'RE THINKING OF</h2>
        <div id="revealed-card" class="card-container final-reveal"></div>
        <button onclick="shuffleDeck()"><i class="fa-solid fa-shuffle"></i> SHUFFLE THE DECK</button>
    </div>
</div>

<script>
    let selectedCards = [];
    let cardMap = {};
    let currentBit = 0;
    let answerBits = 0;
    const maxBits = 5;
    let fullDeck = [];

    const cardPickContainer = document.getElementById("card-pick");
    const groupContainer = document.getElementById("card-group");
    const revealContainer = document.getElementById("revealed-card");

    // Fetch cards from the Deck of Cards API
    async function fetchCards() {
        try {
            const res = await fetch(
                "https://deckofcardsapi.com/api/deck/new/draw/?count=52"
            );
            const data = await res.json();

            fullDeck = data.cards;
            selectedCards = fullDeck.slice(0, 20); // Use first 20 cards for the trick

            // Assign binary values to each card (1-20)
            selectedCards.forEach((card, i) => {
                card.binaryValue = i + 1;
                cardMap[card.binaryValue] = card;
            });

            // Add cards to the initial selection display
            selectedCards.forEach((card) => {
                const img = document.createElement("img");
                img.src = card.image;
                img.alt = `${card.value} of ${card.suit}`;
                cardPickContainer.appendChild(img);
            });

            fanCards(cardPickContainer);
        } catch (error) {
            console.error("Error fetching cards:", error);
        }
    }

    // Create fan effect for cards
    function fanCards(container) {
        const cards = container.querySelectorAll("img");
        const total = cards.length;
        const spacing = 5; // angle spacing between cards
        const startAngle = -Math.floor(total / 2) * spacing;

        cards.forEach((card, i) => {
            const angle = startAngle + i * spacing;
            const offset = (i - total / 2) * 30 - 20;
            card.style.transform = `rotate(${angle}deg)`;
            card.style.left = `calc(50% + ${offset}px)`;
            card.style.bottom = `0`;
            card.style.zIndex = i;
        });
    }

    // Begin the trick
    function startTrick() {
        document.getElementById("step-1").classList.add("hidden");
        document.getElementById("main-title").classList.add("hidden");
        document.getElementById("step-2").classList.remove("hidden");
        showNextGroup();
    }

    // Show the next group of cards based on binary position
    function showNextGroup() {
        groupContainer.innerHTML = "";

        const bit = 1 << currentBit;
        const group = selectedCards.filter((card) => (card.binaryValue & bit) !== 0);

        // Get some extra cards that weren't in the selection to fill out the display
        const availableExtras = fullDeck.filter((c) => !selectedCards.includes(c));
        const shuffledExtras = availableExtras.sort(() => Math.random() - 0.5);
        const extras = shuffledExtras.slice(0, 14 - group.length);

        // Combine and shuffle
        const combined = [...group, ...extras].sort(() => Math.random() - 0.5);

        combined.forEach((card) => {
            const img = document.createElement("img");
            img.src = card.image;
            img.alt = `${card.value} of ${card.suit}`;
            groupContainer.appendChild(img);
        });

        fanCards(groupContainer);
    }

    // Process the user's answer
    function answer(isYes) {
        if (isYes) answerBits += 1 << currentBit;
        currentBit++;

        if (currentBit >= maxBits) {
            revealCard();
        } else {
            showNextGroup();
        }
    }

    // Reveal the selected card with animation
    function revealCard() {
        document.getElementById("step-2").classList.add("hidden");
        document.getElementById("step-3").classList.remove("hidden");

        const card = cardMap[answerBits];

        if (card) {
            // Create the main center card first
            const mainCard = document.createElement("img");
            mainCard.src = card.image;
            mainCard.alt = `${card.value} of ${card.suit}`;
            mainCard.className = "main-card"; // Special class for center card
            revealContainer.appendChild(mainCard);

            // Create floating background cards with delay
            setTimeout(() => {
                // Create multiple floating cards (8 copies)
                for (let i = 0; i < 12; i++) {
                    const img = document.createElement("img");
                    img.src = card.image;
                    img.alt = `${card.value} of ${card.suit}`;

                    // Randomize starting positions
                    const randomLeft = Math.random() * 100; // Random horizontal position (0-100%)
                    const randomDelay = Math.random() * 5; // Random animation delay (0-5s)
                    const randomDuration = 8 + Math.random() * 7; // Random animation duration (8-15s)

                    img.style.left = `${randomLeft}%`;
                    img.style.animationDelay = `${randomDelay}s`;
                    img.style.animationDuration = `${randomDuration}s`;

                    revealContainer.appendChild(img);
                }
            }, 800); // Delay the floating cards
        } else {
            revealContainer.innerHTML = `<div class="error-message">Card not found. Try again!</div>`;
        }
    }

    // Reset the trick
    function shuffleDeck() {
        document.getElementById("step-3").classList.add("hidden");
        document.getElementById("main-title").classList.remove("hidden");
        document.getElementById("step-1").classList.remove("hidden");

        // Clear all card containers
        cardPickContainer.innerHTML = "";
        groupContainer.innerHTML = "";
        revealContainer.innerHTML = "";

        // Reset variables
        currentBit = 0;
        answerBits = 0;
        selectedCards = [];
        cardMap = {};

        // Start fresh
        fetchCards();
    }

    const isThumbnail =
        window.location.href.includes("pen") && !window.location.href.includes("edit");
    if (isThumbnail) {
        window.addEventListener("load", () => {
            startTrick();
            for (let i = 0; i < maxBits; i++) {
                setTimeout(() => {
                    answer(Math.random() < 0.5);
                }, i * 800);
            }
        });
    } else {
        // Initialize the trick
        fetchCards();
    }
</script>
