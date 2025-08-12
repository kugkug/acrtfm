<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>AC Troubleshooter • Basic • Low Voltage • Refrigeration</title>

    <!-- New light/glass style (keeps all your original JS logic intact) -->
    <style>
      [hidden] {
        display: none !important;
      }
      :root {
        /* Theme */
        --bg: linear-gradient(180deg, #eef6ff 0%, #f7fbff 40%, #ffffff 100%);
        --glass: rgba(255, 255, 255, 0.78);
        --glass-strong: rgba(255, 255, 255, 0.92);
        --text: #0f172a;
        --muted: #64748b;
        --border: #e5e7eb;
        --ring: #93c5fd;
        --accent: #3b82f6;
        --accent-2: #06b6d4; /* blue -> teal */
        --good: #16a34a;
        --warn: #f59e0b;
        --bad: #ef4444;

        --shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        --radius: 20px;
        --pad: 18px;
        --radius-pill: 999px;
      }

      * {
        box-sizing: border-box;
      }
      html,
      body {
        height: 100%;
      }
      body {
        margin: 0;
        font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Inter,
          Roboto, Ubuntu, Arial, "Apple Color Emoji", "Segoe UI Emoji";
        color: var(--text);
        background: var(--bg);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      /* Header / Hero */
      header {
        position: sticky;
        top: 0;
        z-index: 10;
        background: linear-gradient(
          135deg,
          rgba(59, 130, 246, 0.85),
          rgba(6, 182, 212, 0.85)
        );
        backdrop-filter: blur(8px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.35);
      }
      .wrap {
        max-width: 1100px;
        margin: auto;
        padding: 14px 18px;
      }
      .toolbar {
        display: flex;
        gap: 12px;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        color: #fff;
      }
      .title {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .logo {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        background: conic-gradient(from 210deg, #fff, #dbeafe, #a5f3fc, #fff);
        color: #0b1020;
        font-weight: 900;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
      }
      .title h1 {
        font-size: 1.1rem;
        margin: 0;
        letter-spacing: 0.2px;
      }
      .title .tiny {
        font-size: 0.85rem;
        opacity: 0.95;
      }

      .btn {
        border: 1px solid rgba(255, 255, 255, 0.35);
        border-radius: 12px;
        padding: 10px 14px;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        font-weight: 600;
        transition: 0.2s;
      }
      .btn:hover {
        background: rgba(255, 255, 255, 0.22);
      }
      .btn.primary {
        border-color: transparent;
        background: linear-gradient(135deg, #fff, #e0f2fe);
        color: #0f172a;
      }

      main {
        padding: 22px 18px 96px;
      }

      /* Segmented Tabs (top) */
      .tabs-wrap {
        max-width: 1100px;
        margin: 0 auto 16px;
      }
      .tabs {
        display: flex;
        gap: 8px;
        padding: 6px;
        background: var(--glass);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(10px);
      }
      .tab {
        flex: 1;
        padding: 10px 14px;
        border: none;
        cursor: pointer;
        color: var(--muted);
        background: transparent;
        font-weight: 600;
        border-radius: 14px;
      }
      .tab[aria-selected="true"] {
        color: #0b1020;
        background: linear-gradient(135deg, #eff6ff, #e0f2fe);
        box-shadow: inset 0 0 0 1px #dbeafe;
      }

      /* Layout grid */
      .grid {
        max-width: 1100px;
        margin: auto;
        display: grid;
        gap: 16px;
        grid-template-columns: 1fr;
      }
      @media (min-width: 960px) {
        .grid {
          grid-template-columns: 1.2fr 0.8fr;
        }
      }

      /* Cards */
      .card {
        background: var(--glass-strong);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: var(--pad);
        box-shadow: var(--shadow);
      }
      .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 10px;
      }
      .hint {
        color: var(--muted);
        font-size: 0.92rem;
        margin-top: 4px;
      }
      .divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
        margin: 14px 0;
      }

      /* “Crumbs” of path (pills) */
      .crumbs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 4px;
      }
      .crumb {
        border: 1px solid var(--border);
        border-radius: var(--radius-pill);
        padding: 6px 10px;
        font-size: 0.86rem;
        background: #f8fafc;
        color: #475569;
      }

      /* Questions / buttons */
      .question {
        font-size: 1.05rem;
        font-weight: 650;
      }
      .btns {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 12px;
      }
      .chip {
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 10px 14px;
        cursor: pointer;
        background: #f8fafc;
        color: #0f172a;
        font-weight: 600;
        transition: 0.15s;
      }
      .chip:hover {
        box-shadow: 0 8px 18px rgba(2, 6, 23, 0.06);
        transform: translateY(-1px);
      }
      .good {
        background: #ecfdf5;
        border-color: #bbf7d0;
      }
      .warn {
        background: #fff7ed;
        border-color: #fed7aa;
      }
      .danger {
        background: #fff1f2;
        border-color: #fecdd3;
      }

      /* Result callout */
      .result {
        border-left: 3px solid var(--accent);
        padding-left: 14px;
        margin-top: 6px;
      }
      .result h3 {
        margin: 0.2rem 0 0.4rem 0;
        font-size: 1.05rem;
      }

      /* Lists */
      ul.tips {
        margin: 0.4rem 0 0 1rem;
        padding: 0;
      }
      .note {
        font-size: 0.92rem;
        color: var(--muted);
        border: 1px dashed #cbd5e1;
        padding: 10px;
        border-radius: 12px;
        background: #f8fafc;
        margin-top: 10px;
      }

      /* Form grid */
      .row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
      }
      @media (min-width: 780px) {
        .row {
          grid-template-columns: 1fr 1fr;
        }
      }
      .field {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin: 6px 0;
      }
      .field label {
        font-size: 0.92rem;
        color: #0f172a;
      }
      .field input,
      .field select {
        background: #fff;
        color: #0f172a;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 10px;
        outline: none;
        transition: box-shadow 0.15s, border-color 0.15s;
      }
      .field input:focus,
      .field select:focus {
        border-color: #bfdbfe;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
      }

      /* Badges */
      .badge {
        display: inline-block;
        padding: 2px 10px;
        border-radius: 999px;
        border: 1px solid var(--border);
        font-size: 0.8rem;
        background: #f8fafc;
        color: #64748b;
      }

      /* Footer actions */
      .foot-btns {
        margin-top: 12px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
      }
      .btn-subtle {
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #0f172a;
        border-radius: 12px;
        padding: 10px 14px;
        font-weight: 600;
        cursor: pointer;
      }
      .btn-primary {
        border: 1px solid transparent;
        color: #0b1020;
        border-radius: 12px;
        padding: 10px 14px;
        font-weight: 700;
        cursor: pointer;
        background: linear-gradient(135deg, #bfdbfe, #99f6e4);
        box-shadow: 0 10px 18px rgba(2, 132, 199, 0.18);
      }

      /* Sticky bottom bar (mobile helper) */
      .sticky-actions {
        position: fixed;
        inset: auto 0 14px 0;
        display: flex;
        justify-content: center;
        z-index: 9;
        pointer-events: none;
      }
      .sticky-actions .bar {
        pointer-events: auto;
        display: flex;
        gap: 10px;
        background: var(--glass);
        border: 1px solid var(--border);
        padding: 10px;
        border-radius: 16px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(10px);
      }
    </style>
  </head>

  <body>
    <header>
      <div class="wrap">
        <div class="toolbar">
          <div class="title">
            <div class="logo">AC</div>
            <div>
              <h1>Air Conditioning Troubleshooter</h1>
              <div class="tiny">
                Basic tree • Low-voltage (meter) • Refrigeration (SH/SC)
              </div>
            </div>
          </div>
          <button id="btnPrint" class="btn primary" type="button">
            🖨 Print / Save PDF
          </button>
        </div>
      </div>
    </header>

    <main>
      <!-- Tabs -->
      <div class="tabs-wrap" role="tablist" aria-label="Modes">
        <div class="tabs">
          <button
            class="tab"
            id="tab-basic"
            role="tab"
            aria-selected="true"
            aria-controls="panel-basic"
          >
            Basic Tree
          </button>
          <button
            class="tab"
            id="tab-lowv"
            role="tab"
            aria-selected="false"
            aria-controls="panel-lowv"
          >
            Low Voltage (Meter)
          </button>
          <button
            class="tab"
            id="tab-ref"
            role="tab"
            aria-selected="false"
            aria-controls="panel-ref"
          >
            Refrigeration (SH/SC)
          </button>
        </div>
      </div>

      <!-- BASIC TREE -->
      <section
        id="panel-basic"
        class="grid"
        role="tabpanel"
        aria-labelledby="tab-basic"
      >
        <section class="card">
          <div class="section-title">Interactive Decision Tree</div>
          <div id="crumbs" class="crumbs" aria-live="polite"></div>
          <div class="divider"></div>
          <div id="step"></div>
          <div class="foot-btns">
            <button id="btnBack" class="btn-subtle" type="button">
              ← Back
            </button>
            <button id="btnRestart" class="btn-subtle" type="button">
              ⟲ Restart
            </button>
            <button id="btnCopy" class="btn-primary" type="button">
              Copy Summary
            </button>
          </div>
          <div class="note">
            Cut power before opening panels. Refrigerant/electrical work should
            be done by a licensed tech.
          </div>
        </section>

        <aside class="card" aria-label="Quick Checks">
          <div class="section-title">Quick Checks (fast wins)</div>
          <ul class="tips">
            <li>Thermostat set to COOL, batteries fresh?</li>
            <li>Breaker/fuse OK? Indoor/outdoor disconnect ON?</li>
            <li>Filter clean? Vents open? Coils dirty?</li>
            <li>Any ice on lines/coil? Drain clogged?</li>
            <li>Outdoor fan/compressor running? Odd noises?</li>
          </ul>
          <div class="divider"></div>
          <span class="badge">Tip</span> If indoor runs but outdoor is dead:
          suspect capacitor, contactor, or wiring at condenser.
        </aside>
      </section>

      <!-- LOW VOLTAGE -->
      <section
        id="panel-lowv"
        class="grid"
        role="tabpanel"
        aria-labelledby="tab-lowv"
        hidden
      >
        <section class="card">
          <div class="section-title">Low-Voltage (24V) Diagnostic Wizard</div>
          <div class="hint">
            Use a multimeter (AC Volts). Common = C. Typical is 24–28 VAC.
          </div>
          <div class="divider"></div>

          <div class="row">
            <div class="field">
              <label for="lv_rc"
                >Is 24V present between R and C at the air handler? (VAC)</label
              >
              <input type="number" id="lv_rc" placeholder="e.g. 26" />
            </div>
            <div class="field">
              <label for="lv_call">Thermostat calling for COOL?</label>
              <select id="lv_call">
                <option value="">Select…</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="field">
              <label for="lv_yc"
                >Voltage between Y and C at air handler (call to
                condenser)</label
              >
              <input
                type="number"
                id="lv_yc"
                placeholder="e.g. 26 when calling"
              />
            </div>
            <div class="field">
              <label for="lv_gc"
                >G to C (indoor fan call) during cooling?</label
              >
              <input
                type="number"
                id="lv_gc"
                placeholder="e.g. 26 when calling"
              />
            </div>
          </div>

          <div class="row">
            <div class="field">
              <label for="lv_cont_coil"
                >At condenser contactor coil, measured across the two
                low-voltage terminals (VAC)</label
              >
              <input
                type="number"
                id="lv_cont_coil"
                placeholder="e.g. 26 when ON"
              />
            </div>
            <div class="field">
              <label for="lv_safeties"
                >Float/condensate safety or pressure switches in series?</label
              >
              <select id="lv_safeties">
                <option value="">Select…</option>
                <option>Unknown</option>
                <option>Present (SS/HP/LP)</option>
                <option>None</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="field">
              <label for="lv_cont_pull"
                >Contactor pulled in (mechanically)?</label
              >
              <select id="lv_cont_pull">
                <option value="">Select…</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
            <div class="field">
              <label for="lv_line"
                >240V across LINE side of contactor (L1-L2)</label
              >
              <input type="number" id="lv_line" placeholder="e.g. 240" />
            </div>
          </div>

          <div class="row">
            <div class="field">
              <label for="lv_load"
                >240V across LOAD side when contactor is pulled in</label
              >
              <input
                type="number"
                id="lv_load"
                placeholder="e.g. 240 when engaged"
              />
            </div>
            <div class="field">
              <label for="lv_cap_vis"
                >Capacitor visually swollen/leaking?</label
              >
              <select id="lv_cap_vis">
                <option value="">Select…</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
          </div>

          <div class="btns">
            <button class="btn-primary" id="lv_run" type="button">
              Analyze Low Voltage
            </button>
            <button class="btn-subtle" id="lv_clear" type="button">
              Clear
            </button>
          </div>

          <div class="divider"></div>
          <div id="lv_result" class="result" style="display: none"></div>
          <div class="note">
            Series safeties commonly include: float switch (SS), high/low
            pressure switches, furnace/air-handler door switch.
          </div>
        </section>

        <aside class="card" aria-label="Expected Readings">
          <div class="section-title">Expected Readings</div>
          <ul class="tips">
            <li><b>R-C:</b> ~24–28 VAC present (power healthy)</li>
            <li><b>Y-C:</b> ~24–28 VAC when cooling is requested</li>
            <li><b>Contactor coil:</b> ~24–28 VAC to energize</li>
            <li><b>Line side:</b> ~208–240 VAC</li>
            <li>
              <b>Load side:</b> ~208–240 VAC only when contactor pulled in
            </li>
          </ul>
          <div class="divider"></div>
          <span class="badge">Note</span> If Y has 24V at the air handler but
          not at the condenser, a safety/float or broken conductor is open in
          the Y circuit.
        </aside>
      </section>

      <!-- REFRIGERATION -->
      <section
        id="panel-ref"
        class="grid"
        role="tabpanel"
        aria-labelledby="tab-ref"
        hidden
      >
        <section class="card">
          <div class="section-title">
            Refrigeration Diagnostics (Superheat / Subcool)
          </div>
          <div class="hint">
            Enter temps/pressures near service valves. If your gauges show SAT°
            directly, use those.
          </div>
          <div class="divider"></div>

          <div class="row">
            <div class="field">
              <label for="ref_refrig">Refrigerant</label>
              <select id="ref_refrig">
                <option>R-410A</option>
                <option>R-22</option>
              </select>
            </div>
            <div class="field">
              <label for="ref_meter">Metering device</label>
              <select id="ref_meter">
                <option>TXV / EEV</option>
                <option>Fixed orifice (piston/cap)</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="field">
              <label for="ref_evap_sat"
                >Evap SAT temp (°F)
                <span class="tiny">(from gauge)</span></label
              >
              <input type="number" id="ref_evap_sat" placeholder="e.g. 45" />
            </div>
            <div class="field">
              <label for="ref_cond_sat"
                >Condensing SAT temp (°F)
                <span class="tiny">(from gauge)</span></label
              >
              <input type="number" id="ref_cond_sat" placeholder="e.g. 105" />
            </div>
          </div>

          <div class="row">
            <div class="field">
              <label for="ref_suc_psig">— OR — Suction pressure (psig)</label>
              <input
                type="number"
                id="ref_suc_psig"
                placeholder="e.g. 130 for R410A @ ~45°F"
              />
            </div>
            <div class="field">
              <label for="ref_liq_psig">— OR — Liquid pressure (psig)</label>
              <input
                type="number"
                id="ref_liq_psig"
                placeholder="e.g. 320 for R410A @ ~100°F"
              />
            </div>
          </div>

          <div class="row">
            <div class="field">
              <label for="ref_suc_line"
                >Suction line temp (°F)
                <span class="tiny">(insulated probe)</span></label
              >
              <input type="number" id="ref_suc_line" placeholder="e.g. 58" />
            </div>
            <div class="field">
              <label for="ref_liq_line">Liquid line temp (°F)</label>
              <input type="number" id="ref_liq_line" placeholder="e.g. 95" />
            </div>
          </div>

          <div class="row">
            <div class="field">
              <label for="ref_oat"
                >Outdoor ambient (°F)
                <span class="tiny">(optional)</span></label
              >
              <input type="number" id="ref_oat" placeholder="e.g. 90" />
            </div>
            <div class="field">
              <label for="ref_target_sc"
                >Target subcooling (°F, from nameplate, TXV)
                <span class="tiny">(optional)</span></label
              >
              <input type="number" id="ref_target_sc" placeholder="e.g. 10" />
            </div>
          </div>

          <div class="btns">
            <button class="btn-primary" id="ref_calc" type="button">
              Calculate
            </button>
            <button class="btn-subtle" id="ref_clear" type="button">
              Clear
            </button>
          </div>

          <div class="divider"></div>
          <div id="ref_result" class="result" style="display: none"></div>

          <div class="note">
            If your gauges don’t show SAT°, this tool uses an
            <b>approximate</b> pressure→saturation conversion for R-410A and
            R-22 (linear interpolation). Always defer to your manifold’s SAT
            readings when available.
          </div>
        </section>

        <aside class="card" aria-label="Rules of Thumb">
          <div class="section-title">Rules of Thumb</div>
          <ul class="tips">
            <li><b>Superheat (SH) =</b> suction line °F − evap SAT °F</li>
            <li><b>Subcool (SC) =</b> cond SAT °F − liquid line °F</li>
            <li><b>TXV systems:</b> focus on SC (nameplate ~8–12°F typical)</li>
            <li><b>Fixed orifice:</b> focus on SH (often ~10–20°F)</li>
            <li>
              <b>High condensing ΔT</b> (cond SAT − OAT &gt; 30–40°F) with
              normal SC → dirty coil / airflow / non-condensables
            </li>
          </ul>
        </aside>
      </section>
    </main>

    <!-- Handy sticky actions on mobile -->
    <div class="sticky-actions" aria-hidden="true">
      <div class="bar">
        <button class="btn-subtle" id="quickBack" type="button">← Back</button>
        <button class="btn-primary" id="quickCopy" type="button">
          Copy Summary
        </button>
      </div>
    </div>

    <script>
      /* ========= Tabs (accessible) ========= */
      /* ========= Tabs (accessible) ========= */
      const tabButtons = document.querySelectorAll('[role="tab"]');
      const tabPanels = document.querySelectorAll('[role="tabpanel"]');

      function activateTab(tab) {
        // Deselect all tabs & hide all panels
        tabButtons.forEach((b) => b.setAttribute("aria-selected", "false"));
        tabPanels.forEach((p) => (p.hidden = true));

        // Select clicked tab & show its panel
        tab.setAttribute("aria-selected", "true");
        const targetId = tab.getAttribute("aria-controls");
        const panel = document.getElementById(targetId);
        if (panel) panel.hidden = false;
      }

      // Click support
      tabButtons.forEach((btn) => {
        btn.addEventListener("click", () => activateTab(btn));
      });

      // Optional: open a tab via URL hash (e.g. #panel-lowv)
      if (location.hash) {
        const btn = document.querySelector(
          `[role="tab"][aria-controls="${location.hash.slice(1)}"]`
        );
        if (btn) activateTab(btn);
      }

      // Optional: keyboard arrows (← →)
      document
        .querySelector('[role="tablist"]')
        .addEventListener("keydown", (e) => {
          const current = document.activeElement;
          if (current.getAttribute("role") !== "tab") return;

          let idx = Array.from(tabButtons).indexOf(current);
          if (e.key === "ArrowRight") idx = (idx + 1) % tabButtons.length;
          else if (e.key === "ArrowLeft")
            idx = (idx - 1 + tabButtons.length) % tabButtons.length;
          else return;

          e.preventDefault();
          tabButtons[idx].focus();
          activateTab(tabButtons[idx]);
        });
      /* ========= Print ========= */
      document
        .getElementById("btnPrint")
        .addEventListener("click", () => window.print());

      /* ========= BASIC TREE LOGIC (unchanged logic, new UI) ========= */
      const TREE = {
        start: "q_start",
        nodes: {
          q_start: {
            id: "q_start",
            type: "q",
            text: "Is the AC turning on at all (indoor blower or outdoor unit)?",
            hint: "Stand near a supply vent and at the outdoor condenser. Any fan noise or airflow?",
            options: [
              { label: "No, completely dead", next: "leaf_dead", tone: "bad" },
              { label: "Yes, it turns on", next: "q_warm_or_ok", tone: "good" },
            ],
          },
          q_warm_or_ok: {
            id: "q_warm_or_ok",
            type: "q",
            text: "When it runs, is it cooling the air?",
            options: [
              {
                label: "No, air is warm",
                next: "q_outdoor_running",
                tone: "warn",
              },
              {
                label: "Yes, but airflow is weak",
                next: "q_poor_airflow",
                tone: "warn",
              },
              {
                label: "It cools some but cycles very quickly",
                next: "q_short_cycle",
                tone: "warn",
              },
              {
                label: "Yes, seems OK but humidity is high",
                next: "leaf_humidity",
                tone: "warn",
              },
            ],
          },
          q_outdoor_running: {
            id: "q_outdoor_running",
            type: "q",
            text: "Is the outdoor unit (fan/compressor) running?",
            hint: "Look/listen at the condenser outside.",
            options: [
              { label: "No", next: "leaf_od_unit_off", tone: "bad" },
              { label: "Yes", next: "q_suction_cold", tone: "good" },
            ],
          },
          q_suction_cold: {
            id: "q_suction_cold",
            type: "q",
            text: "Is the large copper line (suction) cold and sweating?",
            hint: "Careful—touch near the service valve; line should feel cold in cooling mode.",
            options: [
              {
                label: "No, it's not cold",
                next: "leaf_warm_no_suction",
                tone: "warn",
              },
              { label: "Yes, it's cold", next: "q_coil_iced", tone: "good" },
            ],
          },
          q_coil_iced: {
            id: "q_coil_iced",
            type: "q",
            text: "Do you see ice on the refrigerant lines or evaporator coil?",
            options: [
              { label: "Yes, ice present", next: "leaf_iced", tone: "warn" },
              { label: "No ice", next: "leaf_warm_other", tone: "warn" },
            ],
          },
          q_poor_airflow: {
            id: "q_poor_airflow",
            type: "q",
            text: "Filter/vents checked? Any improvement after replacing filter and opening vents?",
            options: [
              {
                label: "Airflow still weak",
                next: "leaf_poor_airflow_mech",
                tone: "warn",
              },
              {
                label: "Airflow improved",
                next: "leaf_poor_airflow_fixed",
                tone: "good",
              },
            ],
          },
          q_short_cycle: {
            id: "q_short_cycle",
            type: "q",
            text: "Does it shut off within 1–5 minutes repeatedly (short cycling)?",
            hint: "Note coil cleanliness & thermostat location (not above a supply).",
            options: [
              {
                label: "Yes, classic short cycling",
                next: "leaf_short_cycle",
                tone: "warn",
              },
              {
                label: "No, runs longer but uneven cooling",
                next: "leaf_uneven_cooling",
                tone: "warn",
              },
            ],
          },

          /* Leaves */
          leaf_dead: {
            id: "leaf_dead",
            type: "leaf",
            diagnosis: "System not powering on.",
            causes: [
              "Thermostat batteries dead or settings incorrect",
              "Tripped breaker/blown fuse",
              "Service disconnect off at air handler/condenser",
              "24V control issue (transformer/fuse) or failed control board",
            ],
            actions: [
              "Replace thermostat batteries; set to COOL, target ≤ 68–72°F.",
              "Reset breaker; check fuses. If it trips again, stop and call a pro.",
              "Verify both disconnects (indoor & outdoor) are ON.",
              "If still dead: check for 24V at board (tech), inspect low-voltage fuse/wiring.",
            ],
            severity: "high",
          },
          leaf_od_unit_off: {
            id: "leaf_od_unit_off",
            type: "leaf",
            diagnosis: "Indoor runs but outdoor unit is not running.",
            causes: [
              "Tripped breaker or outdoor disconnect off",
              "Failed capacitor or contactor at condenser",
              "Burned/loose wiring, bad fan motor, or compressor failure",
            ],
            actions: [
              "Check panel breaker and outdoor pull-out disconnect.",
              "Look for swollen/bulged capacitor (tech to test/replace).",
              "Inspect for burnt wires (power off first!).",
              "If motor/compressor not starting even with good capacitor → call a tech.",
            ],
            severity: "high",
          },
          leaf_warm_no_suction: {
            id: "leaf_warm_no_suction",
            type: "leaf",
            diagnosis:
              "Outdoor runs but suction line not cold → poor heat removal.",
            causes: [
              "Low refrigerant due to leak",
              "Dirty evaporator or condenser coils",
              "Metering device issue (TXV/piston), weak compressor",
            ],
            actions: [
              "Clean/replace filter; wash condenser coil (gentle water, power off).",
              "Inspect evaporator coil for dirt; clean if accessible.",
              "Have a tech check superheat/subcool & leak test; repair before recharging.",
            ],
            severity: "high",
          },
          leaf_iced: {
            id: "leaf_iced",
            type: "leaf",
            diagnosis: "Ice on coil/lines.",
            causes: [
              "Airflow restriction (dirty filter/returns/vents, dirty blower/coil)",
              "Low refrigerant charge (leak)",
              "Blower motor/capacitor issue or low indoor fan speed",
            ],
            actions: [
              "Turn system OFF, set FAN to ON to thaw completely (2–8 hrs).",
              "Replace filter; open all supply/return vents; clear returns.",
              "Clean coils; have a tech verify blower motor/capacitor.",
              "Tech to check charge & leaks before adding refrigerant.",
            ],
            severity: "medium",
          },
          leaf_warm_other: {
            id: "leaf_warm_other",
            type: "leaf",
            diagnosis: "Warm air with outdoor running; no ice.",
            causes: [
              "Dirty condenser or evaporator coils",
              "Improper charge or metering device fault",
              "Weak compressor or reversing valve (heat pump) stuck",
            ],
            actions: [
              "Clean coils indoors & out; ensure outdoor airflow is unobstructed.",
              "Tech to verify charge, TXV/piston performance, compressor amps.",
              "If heat pump, test reversing valve coil & operation.",
            ],
            severity: "medium",
          },
          leaf_poor_airflow_mech: {
            id: "leaf_poor_airflow_mech",
            type: "leaf",
            diagnosis: "Persistently weak airflow.",
            causes: [
              "Dirty blower wheel or evaporator coil",
              "Failed/weak blower motor or bad run capacitor",
              "Collapsed/blocked ductwork or closed dampers",
            ],
            actions: [
              "Inspect/clean blower wheel & evaporator coil.",
              "Test blower capacitor (µF) and motor amps (tech).",
              "Check ducts for kinks/collapses; verify dampers open.",
            ],
            severity: "medium",
          },
          leaf_poor_airflow_fixed: {
            id: "leaf_poor_airflow_fixed",
            type: "leaf",
            diagnosis: "Airflow improved after filter/vent changes.",
            causes: ["Clogged filter or supply/return restrictions"],
            actions: [
              "Use high-quality filters; replace every 1–3 months.",
              "Keep returns clear; don’t close too many supply vents.",
            ],
            severity: "low",
          },
          leaf_short_cycle: {
            id: "leaf_short_cycle",
            type: "leaf",
            diagnosis: "Short cycling (1–5 min on/off).",
            causes: [
              "Oversized equipment (common cause of humidity issues)",
              "Dirty coils or restricted airflow",
              "Low refrigerant or sensor/thermostat placement issue",
            ],
            actions: [
              "Clean coils & replace filter; ensure good airflow.",
              "Relocate thermostat away from supply drafts/sun/heat sources.",
              "Tech to check charge and compressor protection controls.",
              "Consider staged/variable equipment or dehumidification if oversized.",
            ],
            severity: "medium",
          },
          leaf_uneven_cooling: {
            id: "leaf_uneven_cooling",
            type: "leaf",
            diagnosis: "Runs longer but cooling is uneven.",
            causes: [
              "Duct balancing issues or leaks",
              "Insulation/attic heat load; weak blower or dirty coil",
              "Room return path restrictions",
            ],
            actions: [
              "Balance registers; seal obvious duct leaks; verify CFM output.",
              "Improve insulation/attic ventilation where practical.",
              "Add transfer grilles/returns to problem rooms.",
            ],
            severity: "low",
          },
          leaf_humidity: {
            id: "leaf_humidity",
            type: "leaf",
            diagnosis: "High indoor humidity despite cooling.",
            causes: [
              "Oversized unit causing short cycles",
              "Fan set to ON (re-evaporates moisture off coil)",
              "Dirty coils or low charge reducing latent removal",
            ],
            actions: [
              "Set fan to AUTO (not ON).",
              "Clean coils; have charge verified.",
              "Consider variable-speed or dedicated dehumidification if oversized.",
            ],
            severity: "medium",
          },
        },
      };

      const state = { currentId: TREE.start, path: [] };
      const elStep = () => document.getElementById("step");
      const elCrumbs = () => document.getElementById("crumbs");

      function toneClass(t) {
        if (t === "good") return "good";
        if (t === "warn") return "warn";
        if (t === "bad") return "danger";
        return "";
      }
      function renderCrumbs() {
        const c = elCrumbs();
        if (!c) return;
        c.innerHTML = "";
        state.path.forEach((p) => {
          const s = document.createElement("span");
          s.className = "crumb";
          s.textContent = p.label || (TREE.nodes[p.id]?.text ?? p.id);
          c.appendChild(s);
        });
      }
      function renderTree() {
        const node = TREE.nodes[state.currentId];
        if (!node) {
          elStep().innerHTML = '<div class="question">Unknown step.</div>';
          return;
        }
        if (node.type === "q") {
          elStep().innerHTML = `
      <div class="question">${node.text}</div>
      ${node.hint ? `<div class="hint">${node.hint}</div>` : ``}
      <div class="btns" id="optBtns"></div>
      <div class="note">Answer to advance. Use Back to revisit the previous step.</div>`;
          const optWrap = document.getElementById("optBtns");
          node.options.forEach((opt) => {
            const b = document.createElement("button");
            b.className = "chip " + toneClass(opt.tone);
            b.textContent = opt.label;
            b.onclick = () => {
              state.path.push({
                id: node.id,
                label: `${node.text} → ${opt.label}`,
              });
              state.currentId = opt.next;
              renderCrumbs();
              renderTree();
            };
            optWrap.appendChild(b);
          });
        } else {
          const sev = node.severity || "low";
          const icon = sev === "high" ? "⛔" : sev === "medium" ? "⚠️" : "ℹ️";
          elStep().innerHTML = `
      <div class="question">Result</div>
      <div class="result">
        <h3>${icon} ${node.diagnosis}</h3>
        <div class="hint">Likely causes</div>
        <ul class="tips">${node.causes
          .map((c) => `<li>${c}</li>`)
          .join("")}</ul>
        <div class="hint" style="margin-top:10px">What to do first</div>
        <ul class="tips">${node.actions
          .map((a) => `<li>${a}</li>`)
          .join("")}</ul>
      </div>`;
        }
      }
      function goBack() {
        if (!state.path.length) return;
        state.path.pop();
        renderCrumbs();
        state.currentId = state.path.length
          ? state.path[state.path.length - 1].id
          : TREE.start;
        renderTree();
      }
      function restart() {
        state.currentId = TREE.start;
        state.path = [];
        renderCrumbs();
        renderTree();
      }
      function copySummary() {
        const node = TREE.nodes[state.currentId];
        const lines = [
          "AC Troubleshooting Result",
          "-------------------------",
          "Path:",
        ];
        state.path.forEach((p, i) =>
          lines.push(`${i + 1}. ${p.label || TREE.nodes[p.id]?.text || p.id}`)
        );
        lines.push("");
        if (node?.type === "leaf") {
          lines.push(`Diagnosis: ${node.diagnosis}`);
          lines.push("Likely Causes:");
          node.causes.forEach((c) => lines.push(`- ${c}`));
          lines.push("First Actions:");
          node.actions.forEach((a) => lines.push(`- ${a}`));
        } else {
          lines.push("No final result yet—continue answering questions.");
        }
        navigator.clipboard
          .writeText(lines.join("\n"))
          .then(() => toast("Summary copied."));
      }
      function toast(msg) {
        const t = document.createElement("div");
        t.textContent = msg;
        Object.assign(t.style, {
          position: "fixed",
          left: "50%",
          top: "16px",
          transform: "translateX(-50%)",
          background: "var(--glass)",
          border: "1px solid var(--border)",
          padding: "10px 14px",
          borderRadius: "12px",
          boxShadow: "var(--shadow)",
          zIndex: 9999,
          color: "var(--text)",
        });
        document.body.appendChild(t);
        setTimeout(() => t.remove(), 1400);
      }

      document.getElementById("btnBack").addEventListener("click", goBack);
      document.getElementById("btnRestart").addEventListener("click", restart);
      document.getElementById("btnCopy").addEventListener("click", copySummary);
      document.getElementById("quickBack").addEventListener("click", goBack);
      document
        .getElementById("quickCopy")
        .addEventListener("click", copySummary);

      /* ========= LOW-VOLTAGE ANALYZER (same logic) ========= */
      function num(v) {
        const n = parseFloat(v);
        return isNaN(n) ? null : n;
      }
      function inRange(v, lo, hi) {
        return v != null && v >= lo && v <= hi;
      }

      document.getElementById("lv_run").addEventListener("click", () => {
        const rc = num(document.getElementById("lv_rc").value);
        const call = document.getElementById("lv_call").value;
        const yc = num(document.getElementById("lv_yc").value);
        const gc = num(document.getElementById("lv_gc").value);
        const coil = num(document.getElementById("lv_cont_coil").value);
        const saf = document.getElementById("lv_safeties").value;
        const pulled = document.getElementById("lv_cont_pull").value;
        const line = num(document.getElementById("lv_line").value);
        const load = num(document.getElementById("lv_load").value);
        const capVis = document.getElementById("lv_cap_vis").value;

        const findings = [];
        const actions = [];

        if (!inRange(rc, 22, 30)) {
          findings.push("No or low 24V between R and C at the air handler.");
          actions.push(
            "Check transformer primary fuse/breaker, 120/240V feed, and the low-voltage blade fuse on the board (if present)."
          );
        } else {
          findings.push("24V control power present at R-C.");
        }

        if (call === "Yes") {
          if (!inRange(yc, 22, 30)) {
            findings.push(
              "Thermostat calling, but Y-C is not ~24V at the air handler."
            );
            actions.push(
              "Thermostat or wiring issue between stat and air handler. Verify stat output on Y and wiring continuity."
            );
          } else {
            findings.push(
              "Y-C has 24V at air handler → call to condenser is present."
            );
            if (!inRange(coil, 22, 30)) {
              findings.push("No 24V at condenser contactor coil.");
              if (saf === "Present (SS/HP/LP)") {
                actions.push(
                  "Check float switch (SS), high/low pressure switches, and any door switches in series with Y. One may be open."
                );
              } else {
                actions.push(
                  "Broken conductor or connection in the Y circuit to the outdoor unit. Check splices at furnace and at condenser."
                );
              }
            } else {
              findings.push("Contactor coil receiving ~24V.");
              if (pulled === "No") {
                findings.push("Contactor not pulling in despite 24V on coil.");
                actions.push(
                  "Contactor coil open/failed or mechanical binding. Replace contactor."
                );
              } else if (pulled === "Yes") {
                findings.push("Contactor pulled in.");
                if (!inRange(line, 200, 260)) {
                  findings.push("No/low high voltage on LINE side.");
                  actions.push(
                    "Outdoor breaker/disconnect off or wiring issue to condenser. Restore 208–240V."
                  );
                } else {
                  if (!inRange(load, 200, 260)) {
                    findings.push(
                      "No/low high voltage on LOAD side with contactor engaged."
                    );
                    actions.push(
                      "Contactor contacts burned/pitted. Replace contactor."
                    );
                  } else {
                    findings.push(
                      "High voltage present on LINE and LOAD with contactor engaged."
                    );
                    if (capVis === "Yes") {
                      actions.push(
                        "Replace visibly swollen/leaking capacitor; test µF under load."
                      );
                    }
                    actions.push(
                      "If condenser fan or compressor still not running: test capacitor (µF), fan motor amps/ohms, compressor windings and overload."
                    );
                  }
                }
              }
            }
          }
        } else if (call === "No") {
          findings.push("Thermostat not calling for COOL.");
          actions.push(
            "Set stat to COOL and lower setpoint. Verify mode and delays."
          );
        }

        if (inRange(gc, 22, 30)) {
          findings.push(
            "G-C has ~24V during cooling → indoor fan call present."
          );
        }

        const res = document.getElementById("lv_result");
        res.style.display = "block";
        res.innerHTML = `
    <h3>Low-Voltage Analysis</h3>
    <div class="hint">Findings</div>
    <ul class="tips">${findings.map((f) => `<li>${f}</li>`).join("")}</ul>
    <div class="hint" style="margin-top:10px">Next Actions</div>
    <ul class="tips">${
      actions.length ? actions.map((a) => `<li>${a}</li>`).join("") : "—"
    }</ul>
  `;
      });

      document.getElementById("lv_clear").addEventListener("click", () => {
        [
          "lv_rc",
          "lv_yc",
          "lv_gc",
          "lv_cont_coil",
          "lv_line",
          "lv_load",
        ].forEach((id) => (document.getElementById(id).value = ""));
        ["lv_call", "lv_safeties", "lv_cont_pull", "lv_cap_vis"].forEach(
          (id) => (document.getElementById(id).value = "")
        );
        const res = document.getElementById("lv_result");
        res.style.display = "none";
        res.innerHTML = "";
      });

      /* ========= REFRIGERATION (SH/SC) — same logic & heuristics ========= */
      const PT = {
        "R-22": {
          suc: [
            { t: 40, p: 68 },
            { t: 45, p: 76 },
            { t: 50, p: 85 },
            { t: 55, p: 94 },
            { t: 60, p: 104 },
            { t: 65, p: 114 },
            { t: 70, p: 124 },
          ],
          liq: [
            { t: 90, p: 170 },
            { t: 95, p: 183 },
            { t: 100, p: 196 },
            { t: 105, p: 210 },
            { t: 110, p: 226 },
            { t: 115, p: 242 },
            { t: 120, p: 260 },
          ],
        },
        "R-410A": {
          suc: [
            { t: 40, p: 118 },
            { t: 45, p: 132 },
            { t: 50, p: 146 },
            { t: 55, p: 161 },
            { t: 60, p: 177 },
            { t: 65, p: 194 },
            { t: 70, p: 211 },
          ],
          liq: [
            { t: 90, p: 278 },
            { t: 95, p: 299 },
            { t: 100, p: 318 },
            { t: 105, p: 342 },
            { t: 110, p: 370 },
            { t: 115, p: 399 },
            { t: 120, p: 430 },
          ],
        },
      };
      function interpXfromY(arr, yKey, xKey, y) {
        let lo = arr[0],
          hi = arr[arr.length - 1];
        for (let i = 0; i < arr.length - 1; i++) {
          if (y >= arr[i][yKey] && y <= arr[i + 1][yKey]) {
            lo = arr[i];
            hi = arr[i + 1];
            break;
          }
        }
        if (y <= arr[0][yKey]) {
          lo = arr[0];
          hi = arr[1];
        }
        if (y >= arr[arr.length - 1][yKey]) {
          lo = arr[arr.length - 2];
          hi = arr[arr.length - 1];
        }
        const ratio = (y - lo[yKey]) / (hi[yKey] - lo[yKey]);
        return lo[xKey] + ratio * (hi[xKey] - lo[xKey]);
      }
      function satFromPsig(refrig, side, psig) {
        const arr = PT[refrig][side];
        return interpXfromY(arr, "p", "t", psig);
      }

      document.getElementById("ref_calc").addEventListener("click", () => {
        const refrig = document.getElementById("ref_refrig").value;
        const meter = document.getElementById("ref_meter").value;

        let evapSat = num(document.getElementById("ref_evap_sat").value);
        let condSat = num(document.getElementById("ref_cond_sat").value);
        const sucPsig = num(document.getElementById("ref_suc_psig").value);
        const liqPsig = num(document.getElementById("ref_liq_psig").value);
        const sucLine = num(document.getElementById("ref_suc_line").value);
        const liqLine = num(document.getElementById("ref_liq_line").value);
        const oat = num(document.getElementById("ref_oat").value);
        const targetSC = num(document.getElementById("ref_target_sc").value);

        if (evapSat == null && sucPsig != null)
          evapSat = satFromPsig(refrig, "suc", sucPsig);
        if (condSat == null && liqPsig != null)
          condSat = satFromPsig(refrig, "liq", liqPsig);

        const out = [];
        const actions = [];
        let sh = null,
          sc = null;

        if (evapSat != null && sucLine != null) {
          sh = sucLine - evapSat;
        }
        if (condSat != null && liqLine != null) {
          sc = condSat - liqLine;
        }

        if (sh == null || sc == null) {
          out.push("Need enough inputs to compute:");
          if (sh == null)
            out.push("• Superheat requires evap SAT and suction line temp.");
          if (sc == null)
            out.push("• Subcool requires condensing SAT and liquid line temp.");
        } else {
          out.push(`Superheat (SH): <b>${sh.toFixed(1)}°F</b>`);
          out.push(`Subcool (SC): <b>${sc.toFixed(1)}°F</b>`);
        }

        const diags = [];
        const txv = meter.startsWith("TXV");
        if (sh != null && sc != null) {
          if (txv) {
            // TXV: tune by subcooling first
            if (targetSC != null) {
              if (sc < targetSC - 3)
                diags.push(
                  `SC below target → likely <b>undercharge</b> or flash gas. Inspect for leaks; weigh in after repair.`
                );
              if (sc > targetSC + 3)
                diags.push(
                  `SC above target → likely <b>overcharge</b> or poor condenser airflow. Verify coil & fan.`
                );
            } else {
              if (sc < 6)
                diags.push(
                  `Low SC (&lt;6°F) → undercharge or restriction before metering device.`
                );
              if (sc > 15)
                diags.push(
                  `High SC (&gt;15°F) → overcharge or poor outdoor heat rejection.`
                );
            }
            if (sh < 3)
              diags.push(
                `Very low SH (&lt;3°F) with TXV → floodback risk; check bulb placement/insulation and TXV operation.`
              );
            if (sh > 20)
              diags.push(
                `High SH (&gt;20°F) with TXV → starved evap; check charge, TXV inlet screen, and restrictions.`
              );
          } else {
            // Fixed orifice/piston: tune by superheat first
            if (sh < 8)
              diags.push(
                `Low SH (&lt;8°F) on fixed orifice → <b>overcharge</b> or low indoor airflow.`
              );
            if (sh > 25)
              diags.push(
                `High SH (&gt;25°F) on fixed orifice → <b>undercharge</b> or restriction before evaporator.`
              );
            if (sc < 5)
              diags.push(
                `Low SC (&lt;5°F) supports an undercharge/starved condenser.`
              );
            if (sc > 15)
              diags.push(
                `High SC (&gt;15°F) supports overcharge or poor condenser airflow.`
              );
          }

          // Condensing delta-T sanity check vs ambient
          if (oat != null && condSat != null) {
            const condDT = condSat - oat;
            if (condDT > 40)
              diags.push(
                `High condensing ΔT (${condDT.toFixed(
                  0
                )}°F) → dirty condenser, low outdoor airflow, or non-condensables.`
              );
            if (condDT < 10)
              diags.push(
                `Very low condensing ΔT (${condDT.toFixed(
                  0
                )}°F) → light load/cool ambient; avoid charge changes in mild weather.`
              );
          }
        }

        // Render result
        const res = document.getElementById("ref_result");
        res.style.display = "block";
        res.innerHTML = `
    <h3>Refrigeration Analysis</h3>
    <div class="hint">Calculated</div>
    <ul class="tips">${out.map((x) => `<li>${x}</li>`).join("")}</ul>
    ${
      diags.length
        ? `<div class="hint" style="margin-top:10px">Likely Conditions</div><ul class="tips">${diags
            .map((d) => `<li>${d}</li>`)
            .join("")}</ul>`
        : ""
    }
    ${
      actions.length
        ? `<div class="hint" style="margin-top:10px">Next Actions</div><ul class="tips">${actions
            .map((a) => `<li>${a}</li>`)
            .join("")}</ul>`
        : ""
    }
  `;
      });

      document.getElementById("ref_clear").addEventListener("click", () => {
        [
          "ref_evap_sat",
          "ref_cond_sat",
          "ref_suc_psig",
          "ref_liq_psig",
          "ref_suc_line",
          "ref_liq_line",
          "ref_oat",
          "ref_target_sc",
        ].forEach((id) => (document.getElementById(id).value = ""));
        const res = document.getElementById("ref_result");
        res.style.display = "none";
        res.innerHTML = "";
      });

      restart();
    </script>
  </body>
</html>
