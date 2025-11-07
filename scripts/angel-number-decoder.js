document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('angelNumberForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        findMeaningWithDelay();
    });

    form.querySelector('.reset-btn').addEventListener('click', (e) => {
        e.preventDefault();
        form.reset();
        document.getElementById('resultArea').classList.add('hidden');
        document.getElementById('loading').style.display = 'none';
    });
});

const loadingPhrases = [
    "Fetching divine insights...",
    "Extracting messages from the universe...",
    "Consulting the cosmic archives...",
    "Unveiling your spiritual guidance...",
    "Reading your numerical destiny...",
    "Connecting with higher vibrations..."
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

const angelNumberMeanings = {
    "000": "A sign of new beginnings, a fresh start, and a strong connection to the Divine. You are one with the Universe and have infinite potential.",
    "111": "Intuition, spiritual awakening, and new beginnings. Your thoughts are manifesting quickly, so focus on your desires.",
    "222": "Balance, harmony, trust, and divine timing. Keep faith that everything is working out as it's meant to be.",
    "333": "Support, encouragement, and alignment. The Ascended Masters are with you, offering guidance and protection.",
    "444": "Protection, stability, and inner wisdom. The angels are surrounding you, providing strong foundations and reassurance.",
    "555": "Change, transformation, and freedom. Significant life changes are on the horizon. Embrace them with an open heart.",
    "666": "Re-evaluation, balance your thoughts, and focus on spiritual growth. Release fears and trust the universe to provide.",
    "777": "Good fortune, spiritual enlightenment, and divine guidance. You are on the right path, and miracles are unfolding.",
    "888": "Abundance, financial prosperity, and karma. You are in alignment with the flow of abundance, and rewards are coming.",
    "999": "Completion, new cycle, and humanitarianism. A phase of your life is ending, making way for a new, purposeful beginning.",
    "1010": "Spiritual awakening, divine guidance, and positive changes. Trust your intuition and take action towards your goals.",
    "1111": "A powerful sign of spiritual awakening and manifestation. Your thoughts are creating your reality, so stay positive.",
    "1212": "Spiritual growth, positive thinking, and new opportunities. Trust in the universe and maintain a positive outlook.",
    "123": "Simplicity, progress, and moving forward. It's a sign to simplify your life and take one step at a time towards your goals.",
    "1234": "Order, progress, and building strong foundations. You are moving forward in a structured and positive way. Keep going!"
};

function findMeaningWithDelay() {
    const inputEl = document.getElementById('angelNumberInput');
    const number = inputEl.value.trim();

    if (!number) {
        alert('Please enter a number you are seeing.');
        return;
    }

    const loading = document.getElementById('loading');
    const resultArea = document.getElementById('resultArea');
    
    loading.style.display = 'flex';
    resultArea.classList.add('hidden');

    startLoadingPhrases(); // Start flashing phrases

    setTimeout(() => {
        try {
            const meaning = angelNumberMeanings[number];
            displayResult(number, meaning);
        } catch (error) {
            console.error("Lookup Error:", error);
            alert("An error occurred during lookup. Please try again.");
        } finally {
            loading.style.display = 'none';
            stopLoadingPhrases(); // Stop flashing phrases
        }
    }, 3000); // Increased delay to 3 seconds
}

function displayResult(number, meaning) {
    const decodedNumberEl = document.getElementById('decodedNumber');
    const angelMeaningEl = document.getElementById('angelMeaning');
    const resultArea = document.getElementById('resultArea');

    decodedNumberEl.textContent = number;
    if (meaning) {
        angelMeaningEl.textContent = meaning;
    } else {
        angelMeaningEl.innerHTML = `While we don't have a specific entry for <strong>${number}</strong>, here's how to find its meaning:<br><br>
            Angel numbers are often interpreted by breaking them down into single digits or by looking at the significance of the repeating patterns. For example, if you see 1234, you might consider the meaning of 1, 2, 3, and 4 individually, or the progression from 1 to 4. Trust your intuition for personal guidance.`;
    }
    resultArea.classList.remove('hidden');
}