const weeks = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
const date = new Date();
let currentYear = date.getFullYear();
let currentMonth = date.getMonth() + 1;

// 画像データのサンプル（PHPやSQLを使う際にここを動的に取得するようにします）
const photoData = {
  "2026/1/2": "https://picsum.photos/200/300?random=1",
  "2026/1/5": "https://picsum.photos/200/300?random=2",
  "2026/1/15": "https://picsum.photos/200/300?random=3",
};

function init() {
  renderCalendar(currentYear, currentMonth);
}

function renderCalendar(year, month) {
  const grid = document.querySelector("#calendar-grid");
  grid.innerHTML = "";

  // ヘッダー（曜日）の追加
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

  // カレンダーのマス目作成（6週分 = 42マス）
  let dayCount = 1;
  for (let i = 0; i < 42; i++) {
    const cell = document.createElement("div");
    cell.classList.add("cell");

    if (i >= startDay && dayCount <= endDayCount) {
      const dateKey = `${year}/${month}/${dayCount}`;
      cell.innerHTML = `<span class="day-num">${dayCount}</span>`;

      // 画像があれば追加
      if (photoData[dateKey]) {
        cell.innerHTML += `<div class="img-box"><img src="${photoData[dateKey]}"></div>`;
      }
      dayCount++;
    } else {
      cell.classList.add("is-disabled");
    }
    grid.appendChild(cell);
  }

  // 左側の大きな数字などを更新
  document.querySelector("#largeMonth").textContent = String(month).padStart(
    2,
    "0",
  );
  document.querySelector("#year-display").textContent = year;
}

// ボタンイベント
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
