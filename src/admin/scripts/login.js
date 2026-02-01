function showMessage(text, type) {
  const msg = document.getElementById("message");
  msg.textContent = text;
  msg.className = "message " + type;
  msg.style.display = "block";
  setTimeout(() => (msg.style.display = "none"), 3000);
}

function login() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  if (!email || !password) {
    showMessage("メールアドレスとパスワードを入力してください", "error");
    return;
  }

  const users = JSON.parse(localStorage.getItem("users") || "[]");
  const user = users.find((u) => u.email === email && u.password === password);

  if (user) {
    localStorage.setItem("currentUser", JSON.stringify(user));
    showMessage("ログイン成功！", "success");

    // index.phpに遷移
    setTimeout(() => {
      window.location.href = "../index.php";
    }, 1000);
  } else {
    showMessage("メールアドレスまたはパスワードが違います", "error");
  }
}

function register() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  if (!email || !password) {
    showMessage("メールアドレスとパスワードを入力してください", "error");
    return;
  }

  if (password.length < 6) {
    showMessage("パスワードは6文字以上で設定してください", "error");
    return;
  }

  const users = JSON.parse(localStorage.getItem("users") || "[]");

  if (users.find((u) => u.email === email)) {
    showMessage("このメールアドレスは既に登録されています", "error");
    return;
  }

  const newUser = {
    id: Date.now(),
    email: email,
    password: password,
    name: email.split("@")[0],
  };

  users.push(newUser);
  localStorage.setItem("users", JSON.stringify(users));
  showMessage("登録完了！ログインしてください", "success");

  // フォームをクリア
  document.getElementById("password").value = "";
}

// 初期化：すでにログイン済みならindex.phpへリダイレクト
window.onload = function () {
  const user = localStorage.getItem("currentUser");
  if (user) {
    window.location.href = "../index.php";
  }
};
