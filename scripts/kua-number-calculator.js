document.addEventListener('DOMContentLoaded', () => {
    populateYearDropdown();

    const form = document.getElementById('kuaNumberForm');
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
    "Consulting ancient Feng Shui wisdom...",
    "Mapping your personal energy...",
    "Aligning with cosmic directions...",
    "Unveiling your auspicious paths...",
    "Calculating your energetic blueprint..."
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

function populateYearDropdown() {
    const yearEl = document.getElementById('birthYear');
    const currentYear = new Date().getFullYear();
    for (let y = currentYear; y >= 1900; y--) {
        yearEl.insertAdjacentHTML('beforeend', `<option value="${y}">${y}</option>`);
    }
}

function reduceToSingleDigit(num) {
    let sum = num;
    while (sum > 9) {
        sum = String(sum).split('').reduce((acc, digit) => acc + parseInt(digit, 10), 0);
    }
    return sum;
}

function calculateKuaNumber(birthYear, gender) {
    let year = parseInt(birthYear, 10);
    let kua;

    // Calculate Base Number from the last two digits of the year
    const lastTwoDigits = year % 100;
    const sumLastTwoDigits = reduceToSingleDigit(lastTwoDigits);

    if (gender === 'male') {
        if (year < 2000) {
            kua = 10 - sumLastTwoDigits;
        } else { // year >= 2000
            kua = 9 - sumLastTwoDigits;
        }
        if (kua === 5) kua = 2; // The "5" rule for males
    } else { // female
        if (year < 2000) {
            kua = 5 + sumLastTwoDigits;
            kua = reduceToSingleDigit(kua);
        } else { // year >= 2000
            kua = 6 + sumLastTwoDigits;
            kua = reduceToSingleDigit(kua);
        }
        if (kua === 5) kua = 8; // The "5" rule for females
    }
    return kua;
}

function calculateWithDelay() {
    const birthYear = document.getElementById('birthYear').value;
    const genderMale = document.getElementById('genderMale');
    const genderFemale = document.getElementById('genderFemale');

    if (!birthYear || (!genderMale.checked && !genderFemale.checked)) {
        alert('Please select your year of birth and gender.');
        return;
    }

    const gender = genderMale.checked ? 'male' : 'female';

    const loading = document.getElementById('loading');
    const resultArea = document.getElementById('resultArea');
    
    loading.style.display = 'flex';
    resultArea.classList.add('hidden');

    startLoadingPhrases();

    setTimeout(() => {
        try {
            const kuaNumber = calculateKuaNumber(birthYear, gender);
            displayResult(kuaNumber);
        } catch (error) {
            console.error("Calculation Error:", error);
            alert("An error occurred during calculation. Please check the console.");
        } finally {
            loading.style.display = 'none';
            stopLoadingPhrases();
        }
    }, 3000); // Increased loading time to 3 seconds
}

function displayResult(kuaNumber) {
    const meanings = {
        1: {
            group: "East Group",
            description: "Kua Number 1 individuals are often calm, intuitive, and adaptable. They are associated with the Water element. Your lucky directions are Southeast (Wealth), East (Health), South (Relationships), and North (Personal Growth).",
            luckyDirections: "Southeast (Wealth), East (Health), South (Relationships), North (Personal Growth)"
        },
        2: {
            group: "West Group",
            description: "Kua Number 2 individuals are nurturing, stable, and supportive. They are associated with the Earth element. Your lucky directions are Northeast (Wealth), West (Health), Northwest (Relationships), and Southwest (Personal Growth).",
            luckyDirections: "Northeast (Wealth), West (Health), Northwest (Relationships), Southwest (Personal Growth)"
        },
        3: {
            group: "East Group",
            description: "Kua Number 3 individuals are energetic, pioneering, and growth-oriented. They are associated with the Wood element. Your lucky directions are South (Wealth), North (Health), Southeast (Relationships), and East (Personal Growth).",
            luckyDirections: "South (Wealth), North (Health), Southeast (Relationships), East (Personal Growth)"
        },
        4: {
            group: "East Group",
            description: "Kua Number 4 individuals are gentle, creative, and communicative. They are associated with the Wood element. Your lucky directions are East (Wealth), Southeast (Health), North (Relationships), and South (Personal Growth).",
            luckyDirections: "East (Wealth), Southeast (Health), North (Relationships), South (Personal Growth)"
        },
        6: {
            group: "West Group",
            description: "Kua Number 6 individuals are disciplined, authoritative, and helpful. They are associated with the Metal element. Your lucky directions are West (Wealth), Northeast (Health), Southwest (Relationships), and Northwest (Personal Growth).",
            luckyDirections: "West (Wealth), Northeast (Health), Southwest (Relationships), Northwest (Personal Growth)"
        },
        7: {
            group: "West Group",
            description: "Kua Number 7 individuals are joyful, communicative, and enjoy pleasure. They are associated with the Metal element. Your lucky directions are Northwest (Wealth), Southwest (Health), Northeast (Relationships), and West (Personal Growth).",
            luckyDirections: "Northwest (Wealth), Southwest (Health), Northeast (Relationships), West (Personal Growth)"
        },
        8: {
            group: "West Group",
            description: "Kua Number 8 individuals are strong, persistent, and grounded. They are associated with the Earth element. Your lucky directions are Southwest (Wealth), Northwest (Health), West (Relationships), and Northeast (Personal Growth).",
            luckyDirections: "Southwest (Wealth), Northwest (Health), West (Relationships), Northeast (Personal Growth)"
        },
        9: {
            group: "East Group",
            description: "Kua Number 9 individuals are dynamic, passionate, and intelligent. They are associated with the Fire element. Your lucky directions are North (Wealth), South (Health), East (Relationships), and Southeast (Personal Growth).",
            luckyDirections: "North (Wealth), South (Health), East (Relationships), Southeast (Personal Growth)"
        }
    };

    const kuaMeaningData = meanings[kuaNumber] || {
        group: "Unknown",
        description: "An error occurred in finding the meaning for this Kua number.",
        luckyDirections: "N/A"
    };

    document.getElementById('kuaNumber').textContent = kuaNumber;
    document.getElementById('kuaMeaning').innerHTML = `<strong>Group:</strong> ${kuaMeaningData.group}<br>
                                                        ${kuaMeaningData.description}<br>
                                                        <strong>Your Lucky Directions:</strong> ${kuaMeaningData.luckyDirections}`;
    document.getElementById('resultArea').classList.remove('hidden');
}