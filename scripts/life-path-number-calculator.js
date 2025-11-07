document.addEventListener('DOMContentLoaded', () => {
    populateDateDropdowns();

    const form = document.getElementById('lifePathForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        calculateWithDelay();
    });

    form.querySelector('.reset-btn').addEventListener('click', (e) => {
        e.preventDefault();
        form.reset();
        document.getElementById('resultArea').classList.add('hidden');
        document.getElementById('loading').style.display = 'none';
    });
});

const loadingPhrases = [
    "Calculating your destiny...",
    "Aligning with cosmic energies...",
    "Reading your birth chart...",
    "Unveiling your soul's purpose...",
    "Connecting with numerological vibrations..."
];

let phraseInterval;
let currentPhraseIndex = 0;

function startLoadingPhrases() {
    const loadingPhraseEl = document.getElementById('loadingPhrase');
    if (!loadingPhraseEl) return;
    phraseInterval = setInterval(() => {
        loadingPhraseEl.textContent = loadingPhrases[currentPhraseIndex];
        currentPhraseIndex = (currentPhraseIndex + 1) % loadingPhrases.length;
    }, 700);
}

function stopLoadingPhrases() {
    clearInterval(phraseInterval);
}

function populateDateDropdowns() {
    const dayEl = document.getElementById('day');
    const monthEl = document.getElementById('month');
    const yearEl = document.getElementById('year');

    for (let d = 1; d <= 31; d++) dayEl.insertAdjacentHTML('beforeend', `<option value="${d}">${d}</option>`);
    
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    months.forEach((m, i) => monthEl.insertAdjacentHTML('beforeend', `<option value="${i + 1}">${m}</option>`));

    const currentYear = new Date().getFullYear();
    for (let y = currentYear; y >= 1900; y--) yearEl.insertAdjacentHTML('beforeend', `<option value="${y}">${y}</option>`);
}

function calculateWithDelay() {
    const day = document.getElementById('day').value;
    const month = document.getElementById('month').value;
    const year = document.getElementById('year').value;

    if (!day || !month || !year) {
        alert('Please select a full date of birth.');
        return;
    }

    const loading = document.getElementById('loading');
    const resultArea = document.getElementById('resultArea');
    
    loading.style.display = 'flex';
    resultArea.classList.add('hidden');

    startLoadingPhrases();

    setTimeout(() => {
        try {
            const lifePathNumber = calculateLifePath(day, month, year);
            displayResult(lifePathNumber);
        } catch (error) {
            console.error("Calculation Error:", error);
            alert("An error occurred during calculation. Please check the console.");
        } finally {
            loading.style.display = 'none';
            stopLoadingPhrases();
        }
    }, 3000); // Increased loading time to 3 seconds
}

function reduceNumber(num, masterSafe = false) {
    let currentNum = parseInt(num, 10);
    while (currentNum > 9) {
        if (masterSafe && [11, 22, 33].includes(currentNum)) {
            return currentNum;
        }
        currentNum = String(currentNum).split('').reduce((sum, digit) => sum + parseInt(digit, 10), 0);
    }
    return currentNum;
}

function calculateLifePath(day, month, year) {
    // Step 1: Reduce Month
    let monthNum = parseInt(month, 10);
    if (monthNum !== 11) {
        monthNum = reduceNumber(monthNum);
    }

    // Step 2: Reduce Day
    let dayNum = parseInt(day, 10);
    if (dayNum !== 11 && dayNum !== 22) {
        dayNum = reduceNumber(dayNum);
    }

    // Step 3: Reduce Year
    const yearSum = String(year).split('').reduce((sum, digit) => sum + parseInt(digit, 10), 0);
    const yearNum = reduceNumber(yearSum, true); // Master numbers 11, 22, 33 are safe here

    // Step 4: Final Calculation
    const finalSum = monthNum + dayNum + yearNum;
    return reduceNumber(finalSum, true); // Master numbers 11, 22, 33 are safe here
}

function displayResult(number) {
    const meanings = {
        1: "The Leader: Number 1s are natural leaders, independent, and pioneering. They are driven to be number one and have a strong desire for personal attainment.",
        2: "The Diplomat: Number 2s are cooperative, sensitive, and peacemakers. They thrive on partnership and harmony, and have a great talent for diplomacy.",
        3: "The Communicator: Number 3s are creative, expressive, and social. They have a gift for communication and enjoy inspiring and uplifting others.",
        4: "The Builder: Number 4s are practical, organized, and hardworking. They are the builders of society, providing stability and order through their discipline.",
        5: "The Adventurer: Number 5s are freedom-loving, versatile, and adventurous. They crave variety and excitement, and adapt easily to change.",
        6: "The Nurturer: Number 6s are responsible, loving, and community-oriented. They are natural nurturers who seek to serve others and create harmony.",
        7: "The Seeker: Number 7s are analytical, spiritual, and introspective. They are seekers of truth and knowledge, often drawn to the mystical and unknown.",
        8: "The Powerhouse: Number 8s are ambitious, authoritative, and business-minded. They are driven to achieve material success and have strong leadership skills.",
        9: "The Humanitarian: Number 9s are compassionate, idealistic, and selfless. They have a deep concern for humanity and a desire to make the world a better place.",
        11: "The Visionary (Master Number): Number 11s are highly intuitive, inspirational, and have a deep connection to the spiritual realm. They are here to be a channel for higher wisdom.",
        22: "The Master Builder (Master Number): Number 22s have the ability to turn grand dreams into tangible reality. They possess the practicality of the 4 and the vision of the 11.",
        33: "The Master Teacher (Master Number): Number 33s are deeply compassionate and dedicated to healing and uplifting humanity. They combine the nurturing of the 6 with the spiritual insight of the 11."
    };

    document.getElementById('lifePathNumber').textContent = number;
    document.getElementById('lifePathMeaning').textContent = meanings[number] || "An error occurred in finding the meaning.";
    document.getElementById('resultArea').classList.remove('hidden');
}