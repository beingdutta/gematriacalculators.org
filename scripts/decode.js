/**
 * Clears the input field and resets the result area.
 */
function clearDecodeInput() {
    document.getElementById('decodeInput').value = '';
    document.getElementById('decodeResult').style.display = 'none';
    document.getElementById('decodedText').textContent = '';
}

/**
 * Decodes a single numerical value into a string.
 * @param {number} total - The English Gematria total to decode.
 * @returns {string} The decoded string or "no match".
 */
function decodeSingleValue(total) {
    if (isNaN(total) || total <= 0 || total % 6 !== 0) {
        return "no match";
    }

    let simpleTotal = total / 6;
    let result = '';
    // Start from Z to find the largest possible letters that fit.
    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split('').reverse();

    for (const letter of letters) {
        const value = letter.charCodeAt(0) - 'A'.charCodeAt(0) + 1;
        while (simpleTotal >= value) {
            simpleTotal -= value;
            result += letter;
        }
    }

    // If there's a small remainder, append the corresponding letter.
    if (simpleTotal > 0 && simpleTotal <= 26) {
        result += String.fromCharCode(64 + simpleTotal);
    }

    // Always return a result, even if imperfect. Reverse it for readability.
    return result.split('').reverse().join('') || "no match";
}

/**
 * Main function to trigger the decoding process from the UI.
 */
function decode() {
    const inputElement = document.getElementById('decodeInput');
    const resultElement = document.getElementById('decodeResult');
    const textElement = document.getElementById('decodedText');
    const loadingElement = document.getElementById('loading');

    const input = inputElement.value.trim();
    if (!input) {
        textElement.textContent = 'Please enter a value.';
        resultElement.style.display = 'block';
        return;
    }

    loadingElement.style.display = 'flex';
    resultElement.style.display = 'none';

    setTimeout(() => {
        const totals = input.split(/[\s,]+/).filter(n => n.trim() !== '').map(Number);
        const decodedParts = totals.map(total => decodeSingleValue(total));
        const finalResult = decodedParts.join(' ');

        textElement.textContent = finalResult;

        loadingElement.style.display = 'none';
        resultElement.style.display = 'block';
    }, 6000); // Simulate processing time
}