document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('nameNumerologyForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        calculateWithDelay();
    });

    form.querySelector('.reset-btn').addEventListener('click', (e) => {
        e.preventDefault();
        form.reset();
        document.getElementById('resultArea').classList.add('hidden');
        document.getElementById('loading').style.display = 'none';
        document.getElementById('loadingPhrase').textContent = ''; // Clear phrase on reset
    });
});

const loadingPhrases = [
    "Analyzing your name's vibrations...",
    "Mapping your numerological blueprint...",
    "Unveiling your inner desires...",
    "Decoding your personality traits...",
    "Connecting with your spiritual path..."
];

let phraseInterval;
let currentPhraseIndex = 0;

function startLoadingPhrases() {
    const loadingPhraseEl = document.getElementById('loadingPhrase');
    if (!loadingPhraseEl) return;

    loadingPhraseEl.textContent = loadingPhrases[currentPhraseIndex];
    currentPhraseIndex = (currentPhraseIndex + 1) % loadingPhrases.length;

    phraseInterval = setInterval(() => {
        loadingPhraseEl.textContent = loadingPhrases[currentPhraseIndex];
        currentPhraseIndex = (currentPhraseIndex + 1) % loadingPhrases.length;
    }, 700); // Cycle phrase every 700ms
}

function stopLoadingPhrases() {
    clearInterval(phraseInterval);
    document.getElementById('loadingPhrase').textContent = ''; // Clear phrase
    currentPhraseIndex = 0; // Reset index
}

const pythagoreanChart = {
    'A': 1, 'J': 1, 'S': 1,
    'B': 2, 'K': 2, 'T': 2,
    'C': 3, 'L': 3, 'U': 3,
    'D': 4, 'M': 4, 'V': 4,
    'E': 5, 'N': 5, 'W': 5,
    'F': 6, 'O': 6, 'X': 6,
    'G': 7, 'P': 7, 'Y': 7,
    'H': 8, 'Q': 8, 'Z': 8,
    'I': 9, 'R': 9
};

const vowels = ['A', 'E', 'I', 'O', 'U'];

function reduceNumber(num) {
    let currentNum = parseInt(num, 10);
    // Master Numbers 11, 22 are not reduced in the final step for core numbers
    if ([11, 22].includes(currentNum)) {
        return currentNum;
    }
    while (currentNum > 9) {
        currentNum = String(currentNum).split('').reduce((sum, digit) => sum + parseInt(digit, 10), 0);
    }
    return currentNum;
}

function calculateNameNumerology(fullName) {
    const cleanedName = fullName.toUpperCase().replace(/[^A-Z]/g, '');

    let destinySum = 0;
    let soulUrgeSum = 0;
    let personalitySum = 0;

    for (const char of cleanedName) {
        const numValue = pythagoreanChart[char];
        if (numValue) {
            destinySum += numValue;
            if (vowels.includes(char)) {
                soulUrgeSum += numValue;
            } else {
                personalitySum += numValue;
            }
        }
    }

    const destinyNumber = reduceNumber(destinySum);
    const soulUrgeNumber = reduceNumber(soulUrgeSum);
    const personalityNumber = reduceNumber(personalitySum);

    return { destinyNumber, soulUrgeNumber, personalityNumber };
}

function calculateWithDelay() {
    const fullNameInput = document.getElementById('fullNameInput');
    const fullName = fullNameInput.value.trim();

    if (!fullName) {
        alert('Please enter your full name.');
        return;
    }

    const loading = document.getElementById('loading');
    const resultArea = document.getElementById('resultArea');
    
    loading.style.display = 'flex';
    resultArea.classList.add('hidden');

    startLoadingPhrases();

    setTimeout(() => {
        try {
            const { destinyNumber, soulUrgeNumber, personalityNumber } = calculateNameNumerology(fullName);
            displayResult(destinyNumber, soulUrgeNumber, personalityNumber);
        } catch (error) {
            console.error("Calculation Error:", error);
            alert("An error occurred during calculation. Please check the console.");
        } finally {
            loading.style.display = 'none';
            stopLoadingPhrases();
        }
    }, 3000); // Increased loading time to 3 seconds
}

function displayResult(destiny, soulUrge, personality) {
    const meanings = {
        1: "The Leader: Independent, pioneering, and driven to achieve. You are a natural initiator.",
        2: "The Diplomat: Cooperative, sensitive, and a peacemaker. You thrive in partnerships and seek harmony.",
        3: "The Communicator: Creative, expressive, and social. You inspire and uplift others with your words.",
        4: "The Builder: Practical, organized, and hardworking. You provide stability and order through discipline.",
        5: "The Adventurer: Freedom-loving, versatile, and adaptable. You crave variety and new experiences.",
        6: "The Nurturer: Responsible, loving, and community-oriented. You seek to serve others and create harmony.",
        7: "The Seeker: Analytical, spiritual, and introspective. You are a seeker of truth and knowledge.",
        8: "The Powerhouse: Ambitious, authoritative, and business-minded. You are driven for material success and leadership.",
        9: "The Humanitarian: Compassionate, idealistic, and selfless. You have a deep concern for humanity.",
        11: "The Visionary (Master Number): Highly intuitive, inspirational, and connected to the spiritual realm. You are here to be a channel for higher wisdom.",
        22: "The Master Builder (Master Number): The ability to turn grand dreams into tangible reality. You combine practicality with visionary insight."
    };

    document.getElementById('destinyNumber').textContent = destiny;
    document.getElementById('destinyMeaning').textContent = meanings[destiny] || "Meaning not found.";

    document.getElementById('soulUrgeNumber').textContent = soulUrge;
    document.getElementById('soulUrgeMeaning').textContent = meanings[soulUrge] || "Meaning not found.";

    document.getElementById('personalityNumber').textContent = personality;
    document.getElementById('personalityMeaning').textContent = meanings[personality] || "Meaning not found.";

    document.getElementById('resultArea').classList.remove('hidden');
}