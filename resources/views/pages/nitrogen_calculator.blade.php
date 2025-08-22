<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Nitrogen PT Calculator (Gauge PSI vs Temperature)</title>
<style>
  :root{
    --bg:#0b1025; --panel:#0f172a; --glass:#111827cc; --muted:#9aa6b2; --text:#e8eef5;
    --border: #1f2a44; --accent:#22d3ee; --accent2:#a78bfa; --good:#22c55e; --warn:#f59e0b; --bad:#ef4444;
  }
  *{box-sizing:border-box}
  body{
    margin:0; padding:28px 16px; color:var(--text);
    font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Apple Color Emoji","Segoe UI Emoji";
    background:
      radial-gradient(800px 500px at 15% -20%, rgba(34,211,238,.18), transparent 60%),
      radial-gradient(900px 520px at 110% 0%, rgba(167,139,250,.16), transparent 55%),
      var(--bg);
  }
  .wrap{max-width:980px; margin:0 auto}
  header{ text-align:center; margin-bottom:14px }
  h1{margin:0 0 6px; font-size:clamp(22px,3.5vw,32px); letter-spacing:.2px}
  .sub{color:var(--muted); font-size:14px}

  .card{
    background: linear-gradient(180deg, #0e162a 0%, #0c1325 100%);
    border:1px solid var(--border);
    border-radius:16px;
    box-shadow: 0 12px 40px rgba(0,0,0,.45), inset 0 1px 0 rgba(255,255,255,.03);
    padding:18px;
  }

  .grid{display:grid; gap:18px}
  @media (min-width:900px){ .grid{ grid-template-columns: 1.2fr .8fr } }

  .section{
    background:linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.01));
    border:1px solid var(--border);
    border-radius:14px; padding:14px 14px 10px;
  }
  .section h3{margin:0 0 10px; font-size:13px; color:var(--muted); letter-spacing:.2px}

  .row{display:flex; gap:14px; align-items:center; flex-wrap:wrap; margin:10px 0}
  .label{width:220px; color:var(--muted)}
  input[type="number"]{
    width:130px; padding:10px 12px; border-radius:10px; outline:none;
    background: #0c1325; color:var(--text); border:1px solid var(--border);
    box-shadow: inset 0 0 0 1px rgba(255,255,255,.02);
  }

  /* Fancy slider */
  .slider-wrap{ position:relative; flex:1; min-width:220px; }
  .slider-wrap input[type="range"]{
    -webkit-appearance:none; appearance:none; width:100%; height:10px; border-radius:999px;
    background: linear-gradient(90deg, var(--accent), var(--accent2));
    outline:none; border:1px solid #2a3657; box-shadow: inset 0 1px 1px rgba(0,0,0,.6), 0 0 10px rgba(34,211,238,.25);
  }
  .slider-wrap input[type="range"]::-webkit-slider-thumb{
    -webkit-appearance:none; appearance:none; width:22px; height:22px; border-radius:50%;
    background: radial-gradient(10px 10px at 35% 35%, #ffffff, #c7e7ff 60%, #8ddcff 61%);
    border:2px solid #66e0ff; box-shadow: 0 0 0 6px rgba(34,211,238,.18), 0 8px 16px rgba(0,0,0,.45);
    cursor:pointer;
  }
  .slider-wrap input[type="range"]::-moz-range-thumb{
    width:22px; height:22px; border:none; border-radius:50%;
    background: radial-gradient(10px 10px at 35% 35%, #ffffff, #c7e7ff 60%, #8ddcff 61%);
    box-shadow: 0 0 0 6px rgba(34,211,238,.18), 0 8px 16px rgba(0,0,0,.45);
    cursor:pointer;
  }
  .bubble{
    position:absolute; top:-36px; translate:-50% 0;
    padding:4px 8px; border-radius:8px;
    background: #0b1224; border:1px solid #2a3657; color:#d9e3f0; font-size:12px; font-variant-numeric: tabular-nums;
    box-shadow: 0 8px 20px rgba(0,0,0,.4), inset 0 1px 0 rgba(255,255,255,.03);
    pointer-events:none;
  }
  .ticks{
    position:absolute; left:0; right:0; bottom:-14px; display:flex; justify-content:space-between; color:var(--muted); font-size:10px
  }

  .out{display:grid; gap:12px}
  .kpis{display:grid; grid-template-columns:repeat(3,1fr); gap:12px}
  @media (max-width:700px){ .kpis{ grid-template-columns:1fr } }
  .kpi{
    background:#0b1224; border:1px solid var(--border); border-radius:12px; padding:12px;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.03);
  }
  .kpi h4{margin:0 0 6px; color:var(--muted); font-size:12px}
  .big{font-size:clamp(22px,3.3vw,32px); font-weight:900; letter-spacing:.3px}

  .eq{
    margin-top:12px; color:var(--muted); font-size:12px;
    border:1px dashed #2a3657; border-radius:10px; padding:10px;
    background:linear-gradient(180deg, rgba(255,255,255,.02), rgba(255,255,255,.00));
  }
  code{font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, "Liberation Mono", monospace}
</style>
</head>
<body>
  <div class="wrap">
    <header>
      <h1>Nitrogen PT Calculator</h1>
      <div class="sub">Pressure-test drift vs. temperature (constant volume). Units: °F + gauge PSI. Uses absolute temps and gauge↔absolute conversion.</div>
    </header>

    <div class="card">
      <div class="grid">
        <!-- Inputs -->
        <section class="section">
          <h3>Inputs</h3>

          <div class="row">
            <div class="label">Atmospheric pressure (psi)</div>
            <input id="patm" type="number" step="0.001" value="14.696">
          </div>

          <div class="row">
            <div class="label">Baseline pressure P₁ (gauge psi)</div>
            <input id="p1" type="number" min="0" step="1" value="100">
            <div class="slider-wrap">
              <input id="p1s" type="range" min="0" max="600" step="1" value="100">
              <div class="bubble" id="p1b">100</div>
              <div class="ticks"><span>0</span><span>150</span><span>300</span><span>450</span><span>600</span></div>
            </div>
          </div>

          <div class="row">
            <div class="label">Baseline temperature T₁ (°F)</div>
            <input id="t1" type="number" step="1" value="70">
            <div class="slider-wrap">
              <input id="t1s" type="range" min="-40" max="180" step="1" value="70">
              <div class="bubble" id="t1b">70°F</div>
              <div class="ticks"><span>-40</span><span>0</span><span>70</span><span>120</span><span>180</span></div>
            </div>
          </div>

          <div class="row" style="margin-bottom:4px">
            <div class="label">Target temperature T₂ (°F)</div>
            <input id="t2" type="number" step="1" value="50">
            <div class="slider-wrap">
              <input id="t2s" type="range" min="-40" max="180" step="1" value="50">
              <div class="bubble" id="t2b">50°F</div>
              <div class="ticks"><span>-40</span><span>0</span><span>50</span><span>120</span><span>180</span></div>
            </div>
          </div>
        </section>

        <!-- Outputs -->
        <section class="section out">
          <h3>Result</h3>
          <div class="kpi">
            <h4>Projected pressure at T₂</h4>
            <div class="big" id="p2psi">— psi</div>
            <div style="color:var(--muted); font-size:12px">Absolute: <span id="p2abs">—</span> psi</div>
          </div>

          <div class="kpis">
            <div class="kpi">
              <h4>Δ Pressure (P₂ − P₁)</h4>
              <div class="big" id="dp">— psi</div>
            </div>
            <div class="kpi">
              <h4>kPa</h4>
              <div class="big" id="p2kpa">—</div>
            </div>
            <div class="kpi">
              <h4>bar</h4>
              <div class="big" id="p2bar">—</div>
            </div>
          </div>

          <div class="eq">
            <strong>Formula:</strong>
            <div><code>P₁(abs) = P₁(g) + P_atm</code></div>
            <div><code>P₂(abs) = P₁(abs) × (T₂ / T₁)</code> with absolute temps (°R): <code>T(°R) = °F + 459.67</code></div>
            <div><code>P₂(g) = P₂(abs) − P_atm</code></div>
          </div>
        </section>
      </div>
    </div>
  </div>

<script>
  // ---------- elements ----------
  const $ = id => document.getElementById(id);
  const els = {
    patm: $("patm"),
    p1: $("p1"), p1s: $("p1s"), p1b: $("p1b"),
    t1: $("t1"), t1s: $("t1s"), t1b: $("t1b"),
    t2: $("t2"), t2s: $("t2s"), t2b: $("t2b"),
    p2psi: $("p2psi"), p2abs: $("p2abs"),
    dp: $("dp"), p2kpa: $("p2kpa"), p2bar: $("p2bar")
  };

  // ---------- helpers ----------
  const fToR   = F => F + 459.67;        // °F → °R
  const psi2kPa= p => p * 6.8947572932;
  const psi2bar= p => p * 0.068947572932;
  const fmt    = (n, d=2) => isFinite(n) ? Number(n).toFixed(d) : "—";

  // position bubble over slider thumb
  function placeBubble(slider, bubble){
    const min = Number(slider.min), max = Number(slider.max), val = Number(slider.value);
    const pct = (val - min) / (max - min); // 0..1
    const x   = pct * slider.clientWidth;
    bubble.style.left = ${x}px;
  }

  // mirror number<->slider + bubble text
  function bindPair(numberEl, rangeEl, bubbleEl, suffix=""){
    function syncFromNum(){
      rangeEl.value = numberEl.value;
      bubbleEl.textContent = numberEl.value + suffix;
      placeBubble(rangeEl, bubbleEl);
      compute();
    }
    function syncFromRange(){
      numberEl.value = rangeEl.value;
      bubbleEl.textContent = rangeEl.value + suffix;
      placeBubble(rangeEl, bubbleEl);
      compute();
    }
    numberEl.addEventListener("input", syncFromNum);
    rangeEl.addEventListener("input", syncFromRange);
    // initial place
    bubbleEl.textContent = numberEl.value + suffix;
    placeBubble(rangeEl, bubbleEl);
  }

  bindPair(els.p1, els.p1s, els.p1b, "");
  bindPair(els.t1, els.t1s, els.t1b, "°F");
  bindPair(els.t2, els.t2s, els.t2b, "°F");

  // ---------- core compute (gauge → absolute → gauge) ----------
  function compute(){
    const Patm = Number(els.patm.value) || 14.696;
    const P1g  = Math.max(0, Number(els.p1.value) || 0);
    const T1F  = Number(els.t1.value);
    const T2F  = Number(els.t2.value);

    const T1R = fToR(T1F);
    const T2R = fToR(T2F);

    if(!(T1R > 0 && T2R > 0)){
      els.p2psi.textContent = "— psi";
      els.p2abs.textContent = "—";
      els.dp.textContent    = "— psi";
      els.p2kpa.textContent = "—";
      els.p2bar.textContent = "—";
      return;
    }

    const P1abs = P1g + Patm;
    const P2abs = P1abs * (T2R / T1R);
    const P2g   = P2abs - Patm;

    els.p2psi.textContent = fmt(P2g, 2) + " psi";
    els.p2abs.textContent = fmt(P2abs, 2);
    els.dp.textContent    = fmt(P2g - P1g, 2) + " psi";
    els.p2kpa.textContent = fmt(psi2kPa(P2g), 1);
    els.p2bar.textContent = fmt(psi2bar(P2g), 3);

    // color cue by delta
    const delta = P2g - P1g;
    els.p2psi.style.color = delta > 0.5 ? "#22c55e" : (delta < -0.5 ? "#ef4444" : "#f59e0b");
  }

  els.patm.addEventListener("input", compute);

  // initial compute & bubble placement on load + resize
  window.addEventListener("load", ()=>{
    ["p1s","t1s","t2s"].forEach(id=>{
      const s = $(id), b = $(id.replace("s","b"));
      placeBubble(s,b);
    });
    compute();
  });
  window.addEventListener("resize", ()=>{
    ["p1s","t1s","t2s"].forEach(id=>{
      const s = $(id), b = $(id.replace("s","b"));
      placeBubble(s,b);
    });
  });
</script>
</body>
</html>

