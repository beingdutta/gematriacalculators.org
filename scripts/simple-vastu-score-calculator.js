document.addEventListener('DOMContentLoaded', () => {
    populateDirectionDropdowns();

    const form = document.getElementById('vastuForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        calculateWithDelay();
    });

    form.querySelector('.reset-btn').addEventListener('click', (e) => {
        e.preventDefault();
        form.reset();
        document.getElementById('resultArea').classList.add('hidden');
        document.getElementById('loading').style.display = 'none';
        document.getElementById('loadingPhrase').textContent = '';
    });
});

const loadingPhrases = [
    "Analyzing your home's energy flow...",
    "Mapping cosmic directions...",
    "Calculating elemental balance...",
    "Checking for energetic harmony...",
    "Unveiling your home's potential..."
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
    document.getElementById('loadingPhrase').textContent = '';
    currentPhraseIndex = 0;
}

const directions = ["North", "Northeast", "East", "Southeast", "South", "Southwest", "West", "Northwest", "Center"];
const directionAbbr = { "North": "N", "Northeast": "NE", "East": "E", "Southeast": "SE", "South": "S", "Southwest": "SW", "West": "W", "Northwest": "NW", "Center": "Center" };

function populateDirectionDropdowns() {
    const selects = document.querySelectorAll('#vastuForm select');
    selects.forEach(select => {
        select.innerHTML = '<option value="">Select Direction</option>';
        directions.forEach(dir => {
            select.insertAdjacentHTML('beforeend', `<option value="${directionAbbr[dir]}">${dir}</option>`);
        });
    });
}

const vastuScores = {
    kitchen: { 'SE': 20, 'NW': 10, 'E': 0, 'S': 0, 'W': -5, 'N': -10, 'SW': -10, 'NE': -20, 'Center': -20 },
    bedroom: { 'SW': 20, 'S': 10, 'W': 10, 'NW': 5, 'N': 0, 'E': 0, 'SE': -10, 'NE': -20, 'Center': -10 },
    toilet: { 'NW': 20, 'W': 10, 'S': 5, 'N': 0, 'E': 0, 'SE': -10, 'SW': -20, 'NE': -20, 'Center': -20 },
    pooja: { 'NE': 20, 'E': 10, 'N': 10, 'W': 0, 'Center': -10, 'SE': -10, 'S': -15, 'NW': -15, 'SW': -20 },
    entrance: { 'N': 20, 'E': 20, 'NE': 20, 'NW': 10, 'W': 5, 'S': -10, 'SE': -10, 'SW': -20, 'Center': -20 }
};

const placementText = {
    kitchen: (dir, score) => `Kitchen in ${dir} is ${score > 10 ? 'excellent' : (score > 0 ? 'good' : (score === 0 ? 'average' : 'a defect'))}.`,
    bedroom: (dir, score) => `Master Bedroom in ${dir} is ${score > 10 ? 'excellent' : (score > 0 ? 'good' : (score === 0 ? 'average' : 'a defect'))}.`,
    toilet: (dir, score) => `Toilet in ${dir} is ${score > 10 ? 'ideal' : (score > 0 ? 'acceptable' : (score === 0 ? 'average' : 'a major defect'))}.`,
    pooja: (dir, score) => `Pooja Room in ${dir} is ${score > 10 ? 'excellent' : (score > 0 ? 'good' : (score === 0 ? 'average' : 'a defect'))}.`,
    entrance: (dir, score) => `Main Entrance in ${dir} is ${score > 10 ? 'excellent' : (score > 0 ? 'good' : (score === 0 ? 'average' : 'a defect'))}.`
};

function calculateWithDelay() {
    const form = document.getElementById('vastuForm');
    if (!form.checkValidity()) {
        alert('Please select a direction for all rooms.');
        return;
    }

    const loading = document.getElementById('loading');
    const resultArea = document.getElementById('resultArea');
    
    loading.style.display = 'flex';
    resultArea.classList.add('hidden');

    startLoadingPhrases();

    setTimeout(() => {
        try {
            calculateVastuScore();
        } catch (error) {
            console.error("Calculation Error:", error);
            alert("An error occurred during calculation.");
        } finally {
            loading.style.display = 'none';
            stopLoadingPhrases();
        }
    }, 3000);
}

function calculateVastuScore() {
    let totalScore = 0;
    const goodPlacements = [];
    const defects = [];

    const selections = {
        kitchen: document.getElementById('kitchenDirection').value,
        bedroom: document.getElementById('bedroomDirection').value,
        toilet: document.getElementById('toiletDirection').value,
        pooja: document.getElementById('poojaDirection').value,
        entrance: document.getElementById('entranceDirection').value
    };

    for (const room in selections) {
        const direction = selections[room];
        const score = vastuScores[room][direction];
        totalScore += score;

        const text = placementText[room](direction, score);
        if (score > 0) {
            goodPlacements.push(text);
        } else if (score < 0) {
            defects.push(text);
        }
    }

    displayResults(totalScore, goodPlacements, defects);
}

function displayResults(score, good, bad) {
    const scoreEl = document.getElementById('vastuScore');
    const scoreBar = document.getElementById('scoreBar');
    const goodList = document.getElementById('goodPlacementsList');
    const defectsList = document.getElementById('defectsList');
    const goodCard = document.getElementById('goodPlacementsCard');
    const defectsCard = document.getElementById('defectsCard');

    scoreEl.textContent = score;

    // Update score bar
    const percentage = ((score + 100) / 200) * 100; // Normalize score from -100/100 to 0/100
    scoreBar.style.width = `${percentage}%`;
    if (percentage > 75) {
        scoreBar.style.backgroundColor = '#28a745'; // Green
    } else if (percentage > 50) {
        scoreBar.style.backgroundColor = '#ffc107'; // Yellow
    } else {
        scoreBar.style.backgroundColor = '#dc3545'; // Red
    }

    // Populate good placements
    goodList.innerHTML = '';
    if (good.length > 0) {
        good.forEach(item => {
            goodList.insertAdjacentHTML('beforeend', `<li>${item}</li>`);
        });
        goodCard.classList.remove('hidden');
    } else {
        goodCard.classList.add('hidden');
    }

    // Populate defects
    defectsList.innerHTML = '';
    if (bad.length > 0) {
        bad.forEach(item => {
            defectsList.insertAdjacentHTML('beforeend', `<li>${item}</li>`);
        });
        defectsCard.classList.remove('hidden');
    } else {
        defectsList.innerHTML = '<li>Congratulations! No major Vastu defects found.</li>';
        defectsCard.classList.remove('hidden');
    }

    document.getElementById('resultArea').classList.remove('hidden');
}