/* ─────────── GLOBAL ─────────────────────────────────────────────────── */
let latestCounts = null;            // will hold last calculation (for PDF)
let loadingInterval = null;
const loadingPhrases = [
  "Aligning cosmic energies...",
  "Consulting ancient charts...",
  "Mapping your numerological matrix...",
  "Calculating your Mulank and Bhagyank...",
  "Revealing your hidden strengths...",
  "Decoding the planes of destiny...",
  "Unveiling your path..."
];

/* ─────────── init & theming ─────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => { // DOMContentLoaded is a good place for this
  populateDropdowns();
  const saved = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', saved);
  ['summary','gridContainer','traitsContainer'].forEach(id =>
    document.getElementById(id).classList.add('hidden'));
});
function toggleTheme(){
  const html=document.documentElement;
  const next=html.getAttribute('data-theme')==='light'?'dark':'light';
  html.setAttribute('data-theme',next);localStorage.setItem('theme',next);
}

/* ─────────── dropdown helpers ───────────────────────────────────────── */
function populateDropdowns(){
  const dayEl=document.getElementById('day');
  for(let d=1;d<=31;d++)dayEl.insertAdjacentHTML('beforeend',`<option>${d}</option>`);
  const monthEl=document.getElementById('month');
  ['January','February','March','April','May','June','July','August','September','October','November','December']
    .forEach((m,i)=>monthEl.insertAdjacentHTML('beforeend',`<option value="${i+1}">${m}</option>`));
  const yearEl=document.getElementById('year');
  const thisYear=new Date().getFullYear();
  for(let y=thisYear;y>=1900;y--)yearEl.insertAdjacentHTML('beforeend',`<option>${y}</option>`);
}
document.getElementById('loshuForm').addEventListener('submit',e=>{
  e.preventDefault();calculateWithDelay();
});

/* ─────────── calculator core ───────────────────────────────────────── */
function calculateWithDelay(){
  const d=+document.getElementById('day').value,
        m=+document.getElementById('month').value,
        y=+document.getElementById('year').value;
  if(!d||!m||!y){alert('Please select day, month and year.');return;}
  showLoading(true);
  startLoadingPhrases();
  setTimeout(()=>{
    try{
      latestCounts=calculateLoShuGrid(d,m,y);   // store globally
      renderSummary(latestCounts);
      renderGrid(latestCounts);
      renderTraits(latestCounts);
      document.getElementById('resultArea').classList.remove('hidden');
      document.getElementById('downloadBtn').classList.remove('hidden');
    } catch(err) {
      console.error(err);
      alert('Something went wrong.');
    } finally {
      showLoading(false);
      stopLoadingPhrases();
    }
  },7000);
}
function showLoading(state) {
  document.getElementById('loading').style.display = state ? 'flex' : 'none';
}
function startLoadingPhrases() {
    let i = 0;
    const phraseEl = document.getElementById('loadingPhrase');
    phraseEl.textContent = loadingPhrases[i];
    loadingInterval = setInterval(() => {
        i = (i + 1) % loadingPhrases.length;
        phraseEl.textContent = loadingPhrases[i];
    }, 1000);
}
function stopLoadingPhrases() {
    clearInterval(loadingInterval);
    document.getElementById('loadingPhrase').textContent = '';
}
function resetForm(){
  ['summary','gridContainer','traitsContainer'].forEach(id=>{
    const el = document.getElementById(id);
    el.innerHTML='';
    el.classList.add('hidden');
  });
  document.getElementById('resultArea').classList.add('hidden');
  document.getElementById('downloadBtn').classList.add('hidden');
  latestCounts=null;
}

/* math helpers */
const reduce=n=>{while(n>9)n=[...String(n)].reduce((a,b)=>a+ +b,0);return n;}
function calculateLoShuGrid(d,m,y){
  const digits=[...String(d),...String(m),...String(y)].map(Number).filter(n=>n!==0);
  const mulank=reduce(d), bhagyank=reduce(digits.reduce((a,b)=>a+b,0));
  const bag=[...digits,mulank,bhagyank];
  const counts=Array.from({length:10},()=>0);bag.forEach(n=>counts[n]++);
  return counts;
}

/* ─────────── rendering ─────────────────────────────────────────────── */
function renderSummary(counts){
  const present=[],missing=[];
  counts.forEach((c,i)=>{if(!i)return;c?present.push(...Array(c).fill(i)):missing.push(i);});
  const box=document.getElementById('summary');
  box.innerHTML=
    `<span class="present-label">Present Numbers:</span> ${present.join(' ')}<br><br>`+
    `<span class="missing-label">Missing Numbers:</span> ${missing.join(' ')}`;
  box.classList.remove('hidden');
}

function renderGrid(counts){
  const wrap=document.getElementById('gridContainer');wrap.innerHTML='';wrap.classList.remove('hidden');
  [[4,9,2],[3,5,7],[8,1,6]].flat().forEach(num=>{
    const count=counts[num] || 0;
    const cell=document.createElement('div');
    cell.className=`loshu-cell ${count?'present':'missing'}`;cell.dataset.num=num;
    const nums=count?Array(count).fill(num).join(' '):`<span class="fade">${num}</span>`;
    cell.innerHTML=
      `<div class="cell-content"><span class="number">${nums}</span>
       <div class="trait">${getTrait(num,!!count)}</div></div>`;
    wrap.appendChild(cell);
  });
}

function getTrait(n,p){
  const t={
    1:{p:'Leadership, initiative & confidence.',m:'Self-doubt, hesitation to take charge.'},
    2:{p:'Co-operation, diplomacy & emotional balance.',m:'Relationship struggles, oversensitivity.'},
    3:{p:'Creativity, optimism & clear expression.',m:'Shyness, difficulty voicing ideas.'},
    4:{p:'Practicality, discipline & organisation.',m:'Scattered focus, resistance to routine.'},
    5:{p:'Adaptability, freedom-loving & adventure.',m:'Fear of change, restlessness.'},
    6:{p:'Responsibility, nurturing & harmony at home.',m:'Avoidance of duty, detachment from family.'},
    7:{p:'Spiritual insight, intuition & research mind.',m:'Materialistic outlook, surface-level thinking.'},
    8:{p:'Ambition, authority & material success.',m:'Low drive, weak sense of self-worth.'},
    9:{p:'Compassion, humanitarian spirit & completion.',m:'Emotional detachment, lack of empathy.'}
  };
  return p?t[n].p:t[n].m;
}

function renderTraits(counts){
  const pres=[],miss=[];
  counts.forEach((c,i)=>{if(!i)return;c?pres.push(i):miss.push(i);});
  const box=document.getElementById('traitsContainer');box.classList.remove('hidden');
  box.innerHTML=
    `<h3>What Your Present Numbers Mean</h3><ul>${
      pres.map(n=>`<li><strong>${n}</strong> – ${getTrait(n,true)}</li>`).join('')}</ul>
     <hr style="border:none;border-top:1px solid rgb(0 0 0 /.08);margin:1.4rem 0">
     <h3>Impact of Missing Numbers</h3><ul>${
      miss.map(n=>`<li><strong>${n}</strong> – ${getTrait(n,false)}</li>`).join('')}</ul>`;
}

/* ─────────── PDF generation (always builds the grid) ─────────── */
function downloadPDF () {

  /* basic validation --------------------------------------------------- */
  const d = +document.getElementById('day').value,
        m = +document.getElementById('month').value,
        y = +document.getElementById('year').value;
  if (!d || !m || !y) { alert('Please select day, month and year.'); return; }

  /* ask visitor’s name ------------------------------------------------- */
  let userName = prompt('Enter the name you’d like on your report:');
  if (userName === null) return;           // user hit Cancel
  userName = userName.trim() || 'User';

  /* show the same spinner we use for “Calculate” ----------------------- */
  showLoading(true);

  setTimeout(() => {                       // tiny delay so spinner is visible
    /* if the user never pressed “Calculate”, create counts right here */
    const counts = latestCounts || calculateLoShuGrid(d, m, y);

    const present = [], missing = [];
    counts.forEach((c, i) => { if (!i) return; c ? present.push(...Array(c).fill(i))
                                                 : missing.push(i); });

    /* build the PDF ---------------------------------------------------- */
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({ unit: 'pt', format: 'a4' });
    const pw  = doc.internal.pageSize.getWidth();

    /* banner */
    doc.setFillColor(74,144,226);
    doc.rect(0, 0, pw, 60, 'F');
    doc.setFont('helvetica', 'bold').setFontSize(22).setTextColor(255,255,255);
    doc.text(`Lo Shu Grid Report for ${userName}`, pw / 2, 38, { align: 'center' });

    let yPos = 85;

    /* present / missing rows */
    doc.setFontSize(12).setFont('helvetica', 'bold').setTextColor(11,83,69);
    doc.text(`Present Numbers:  ${present.join(' ')}`, pw / 2, yPos, { align: 'center' });
    yPos += 22;
    doc.setTextColor(192,57,43);
    doc.text(`Missing Numbers:  ${missing.join(' ')}`, pw / 2, yPos, { align: 'center' });
    yPos += 35;

    /* centred 3 × 3 grid ---------------------------------------------- */
    const sq  = 70, gap = 18, gridW = 3 * sq + 2 * gap;
    const startX = (pw - gridW) / 2, startY = yPos;
    const palette = {
      1:[233,248,229],2:[234,245,255],3:[255,244,230],4:[243,236,255],5:[255,251,230],
      6:[232,255,251],7:[249,233,255],8:[255,238,243],9:[230,249,255]
    };

    [[4,9,2],[3,5,7],[8,1,6]].forEach((row, r) => {
      row.forEach((n, c) => {
        const x  = startX + c * (sq + gap),
              yy = startY + r * (sq + gap),
              has = counts[n] > 0,
              fill = has ? palette[n] : [255,229,229],
              col  = has ? [11,83,69] : [192,57,43];

        doc.setFillColor(...fill).setDrawColor(...col).rect(x, yy, sq, sq, 'FD');
        doc.setFontSize(13).setTextColor(...col);
        doc.text(has ? Array(counts[n]).fill(n).join(' ') : `${n}`,
                 x + sq / 2, yy + 20, { align: 'center' });
        doc.setFontSize(8).setTextColor(85,85,85);
        doc.text(getTrait(n, has).split(' ')[0], x + sq / 2, yy + 40, { align: 'center' });
      });
    });
    yPos = startY + 3 * sq + 2 * gap + 40;

    /* traits lists ----------------------------------------------------- */
    const writeList = (title, arr, color) => {
      doc.setFont('helvetica','bold').setFontSize(12).setTextColor(...color);
      doc.text(title, pw / 2, yPos, { align: 'center' }); yPos += 18;
      doc.setFont('helvetica','normal').setTextColor(33,33,33);
      arr.forEach(n => {
        const txt = `${n} – ${getTrait(n, color === green)}`;
        doc.splitTextToSize(txt, pw - 120).forEach(line => {
          doc.text(line, pw / 2, yPos, { align: 'center' }); yPos += 14;
        });
        yPos += 4;
      });
    };
    const green = [11,83,69], red = [192,57,43];
    writeList('Present Traits', present, green);
    writeList('Missing Traits', missing, red);

    doc.save('lo-shu-grid-report.pdf');
    showLoading(false);                     // hide spinner
  }, 80);                                   // end setTimeout
}


/* ─────────── FAQ accordion ─────────────────────────────────────────── */
document.addEventListener('click',e=>{
  if(e.target.closest('.faq-question')){
    e.target.closest('.faq-item').classList.toggle('open');
  }
});
