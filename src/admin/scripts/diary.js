const weeks = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
const date = new Date();
let currentYear = date.getFullYear();
let currentMonth = date.getMonth() + 1;

// サンプルデータ
const photoData = {
  "2026/8/2": {
    img: "https://picsum.photos/400/600?random=1",
    quote: "風が心地よい午後の読書",
    highlight:
      "お気に入りのカフェで、ずっと読みたかった本を読了。アップルパイが絶品でした。",
  },
  "2026/8/5": {
    img: "https://picsum.photos/400/600?random=2",
    quote: "夕焼けが奇跡のように綺麗だった",
    highlight:
      "仕事帰りにふと空を見上げたら、オレンジと紫のグラデーションに感動。",
  },
};

function init() {
  renderCalendar(currentYear, currentMonth);
  setupModalEvents();
}

function renderCalendar(year, month) {
  const grid = document.querySelector("#calendar-grid");
  grid.innerHTML = "";

  // 曜日ヘッダーの描画
  weeks.forEach((w) => {
    const div = document.createElement("div");
    div.classList.add("weekday-label");
    div.textContent = w;
    grid.appendChild(div);
  });

  const startDate = new Date(year, month - 1, 1);
  const endDate = new Date(year, month, 0);
  const startDay = startDate.getDay();
  const endDayCount = endDate.getDate();

  // 42マスのセルを生成
  let dayCount = 1;
  for (let i = 0; i < 42; i++) {
    const cell = document.createElement("div");
    cell.classList.add("cell");

    if (i >= startDay && dayCount <= endDayCount) {
      const dateKey = `${year}/${month}/${dayCount}`;
      cell.innerHTML = `<span class="day-num">${dayCount}</span>`;

      if (photoData[dateKey]) {
        cell.innerHTML += `<div class="img-box"><img src="${photoData[dateKey].img}"></div>`;
      }

      cell.addEventListener("click", () => openModal(dateKey));
      dayCount++;
    } else {
      cell.classList.add("is-disabled");
    }
    grid.appendChild(cell);
  }

  // --- 表示の更新処理 ---

  // 1. 左側サイドバーの大きな数字 (例: 08)
  document.querySelector("#largeMonth").textContent = String(month).padStart(
    2,
    "0",
  );

  // 2. カレンダー上部の西暦 (例: 2026)
  document.querySelector("#year-display").textContent = year;

  // 3. カレンダー上部の英語月名 (例: AUGUST)
  const monthNames = [
    "JANUARY",
    "FEBRUARY",
    "MARCH",
    "APRIL",
    "MAY",
    "JUNE",
    "JULY",
    "AUGUST",
    "SEPTEMBER",
    "OCTOBER",
    "NOVEMBER",
    "DECEMBER",
  ];
  document.querySelector("#month-name-display").textContent =
    monthNames[month - 1];
}

// --- モーダル制御ロジック ---

function openModal(dateKey) {
  const mask = document.getElementById("mask");
  const modal = document.getElementById("modal");
  const data = photoData[dateKey];

  document.getElementById("modal-date-display").textContent = dateKey;
  document.getElementById("modal-img").src = data
    ? data.img
    : "https://via.placeholder.com/400x600?text=No+Memory";
  document.getElementById("modal-quote").textContent = data
    ? data.quote
    : "この日の記録はありません";
  document.getElementById("modal-highlights").textContent = data
    ? data.highlight
    : "思い出を記録してみましょう。";

  mask.classList.add("appear");
  modal.classList.add("appear");
  createParticles(modal);
}

function closeModal() {
  document.getElementById("mask").classList.remove("appear");
  document.getElementById("modal").classList.remove("appear");
  clearParticles();
}

function setupModalEvents() {
  const mask = document.getElementById("mask");
  const closeBtn = document.querySelector(".close-btn");

  mask.addEventListener("click", closeModal);
  closeBtn.addEventListener("click", closeModal);
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeModal();
  });
}

function createParticles(target) {
  const container = document.createElement("div");
  container.className = "particles-container";
  container.style.cssText = `position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;overflow:hidden;border-radius:20px;z-index:-1;`;

  for (let i = 0; i < 20; i++) {
    const p = document.createElement("div");
    p.style.cssText = `position:absolute;width:5px;height:5px;background:rgba(255,255,255,0.7);border-radius:50%;animation:float 3s ease-in-out infinite;animation-delay:${Math.random() * 3}s;`;
    p.style.left = Math.random() * 100 + "%";
    p.style.top = Math.random() * 100 + "%";
    container.appendChild(p);
  }
  target.appendChild(container);
}

function clearParticles() {
  const pc = document.querySelector(".particles-container");
  if (pc) pc.remove();
}

// カレンダー送りボタン
document.querySelector("#prev").addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 1) {
    currentYear--;
    currentMonth = 12;
  }
  renderCalendar(currentYear, currentMonth);
});

document.querySelector("#next").addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 12) {
    currentYear++;
    currentMonth = 1;
  }
  renderCalendar(currentYear, currentMonth);
});

init();
