// ログアウト処理などはそのままでOK
document.addEventListener("DOMContentLoaded", function () {
  const currentUser = localStorage.getItem("currentUser");
  if (!currentUser) {
    window.location.href = "./login.php";
    return;
  }
  const logoutBtn = document.querySelector(".header-logout");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", function (e) {
      e.preventDefault();
      if (confirm("ログアウトしますか？")) {
        localStorage.removeItem("currentUser");
        window.location.href = "./login.php";
      }
    });
  }
  
  // ★ここでデータ取得を開始します
  fetchDiaryData();
});

const weeks = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
const date = new Date();
let currentYear = date.getFullYear();
let currentMonth = date.getMonth() + 1;

// ★変更点1: 固定データを空の変数に変更
let photoData = {}; 

// ★変更点2: データをサーバーから取ってくる関数を追加
async function fetchDiaryData() {
    try {
        // さっき作ったPHPファイルにアクセス
        const response = await fetch('../diary.php'); 
        const data = await response.json();

        // DBのデータをカレンダー用の形式に変換
        // DB: date = 20260201 (数値)
        // JS: key = "2026/2/1" (文字列、0埋めなし)
        data.forEach(item => {
            const dateStr = String(item.date); // "20260201"
            const y = dateStr.substring(0, 4);
            const m = parseInt(dateStr.substring(4, 6)); // 02 -> 2
            const d = parseInt(dateStr.substring(6, 8)); // 01 -> 1
            const key = `${y}/${m}/${d}`;

            photoData[key] = {
                // 画像パスの調整（adminフォルダから見た assetsフォルダの位置）
                img: item.photo ? `../assets/img/${item.photo}` : null,
                quote: item.title,      // タイトルを quote として表示
                highlight: item.highlight // ハイライトを表示
            };
        });

        // データが準備できたらカレンダーを描画
        init();

    } catch (error) {
        console.error("データの取得に失敗しました", error);
    }
}

function init() {
  renderCalendar(currentYear, currentMonth);
  setupModalEvents();
}

function renderCalendar(year, month) {
  const grid = document.querySelector("#calendar-grid");
  grid.innerHTML = "";

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

  let dayCount = 1;
  for (let i = 0; i < 42; i++) {
    const cell = document.createElement("div");
    cell.classList.add("cell");

    if (i >= startDay && dayCount <= endDayCount) {
      const dateKey = `${year}/${month}/${dayCount}`;
      cell.innerHTML = `<span class="day-num">${dayCount}</span>`;

      // ★変更点3: データがあり、かつ画像がある場合のみ画像を表示
      if (photoData[dateKey] && photoData[dateKey].img) {
        cell.innerHTML += `<div class="img-box"><img src="${photoData[dateKey].img}"></div>`;
      }

      // データがある場合のみクリックイベントを設定するか、
      // データがなくても「記録なし」として開くかは自由ですが、今回は元のロジック通りすべてにイベントをつけます
      cell.addEventListener("click", () => openModal(dateKey));
      dayCount++;
    } else {
      cell.classList.add("is-disabled");
    }
    grid.appendChild(cell);
  }

  document.querySelector("#largeMonth").textContent = String(month).padStart(2, "0");
  document.querySelector("#year-display").textContent = year;

  const monthNames = [
    "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE",
    "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER",
  ];
  document.querySelector("#month-name-display").textContent = monthNames[month - 1];
}

// --- モーダル制御ロジック (ここはほぼ変更なし) ---

function openModal(dateKey) {
  const mask = document.getElementById("mask");
  const modal = document.getElementById("modal");
  const data = photoData[dateKey];

  document.getElementById("modal-date-display").textContent = dateKey;
  
  // データがある場合とない場合の表示分け
  document.getElementById("modal-img").src = (data && data.img)
    ? data.img
    : "https://via.placeholder.com/400x600?text=No+Memory"; // デフォルト画像

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
  // エラー防止のためのチェックを追加
  if(mask) mask.addEventListener("click", closeModal);
  if(closeBtn) closeBtn.addEventListener("click", closeModal);
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
const prevBtn = document.querySelector("#prev");
if(prevBtn) {
    prevBtn.addEventListener("click", () => {
      currentMonth--;
      if (currentMonth < 1) {
        currentYear--;
        currentMonth = 12;
      }
      renderCalendar(currentYear, currentMonth);
    });
}

const nextBtn = document.querySelector("#next");
if(nextBtn) {
    nextBtn.addEventListener("click", () => {
      currentMonth++;
      if (currentMonth > 12) {
        currentYear++;
        currentMonth = 1;
      }
      renderCalendar(currentYear, currentMonth);
    });
}

// 一番下の init() は削除（fetchDiaryDataの中で呼ぶので不要）