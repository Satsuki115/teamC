DROP DATABASE IF EXISTS laravel_db;

CREATE DATABASE laravel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE laravel_db;

create table diary(
    id int primary key AUTO_INCREMENT,
    date int not null,
    title varchar(255) not null,
    highlight text,
    record text,
    thanks text,
    photo varchar(255)
);

INSERT INTO diary (date, title, highlight, record, thanks, photo) VALUES
(20260201, 'ハッカソン初日', 'チームビルディング完了', 'ついに開発がスタートした。役割分担も決まり、やる気十分！お昼に飲んだジュースが美味しかった。', 'チームメンバー', 'juice.png'),
(20260202, 'DB設計の壁', '正規化について議論', 'テーブル設計で少し揉めたけれど、最終的に良い形に落ち着いた。ホワイトボードを使って議論するのは楽しい。', '的確なアドバイス', 'line01.jpg'),
(20260203, 'デザイン作成', 'CSSグリッド習得', 'メイン画面のレイアウトを作成。レスポンシブ対応に苦戦したけれど、なんとか形になった。', '参考にした技術ブログ', 'line02.jpg'),
(20260204, 'API連携成功', 'データが表示された！', 'PHPからDBのデータを取得して画面に出せた瞬間は感動した。これぞバックエンドの醍醐味。', '公式ドキュメント', 'line03.jpg'),
(20260205, 'バグとの戦い', 'タイポで3時間溶かした', 'エラーが消えなくて焦ったが、原因はスペルミスだった。疲れているときは休憩が必要だと痛感。', 'コーヒー', 'line04.jpg'),
(20260206, 'デプロイ準備', '環境変数の設定', '本番環境へのデプロイ手順を確認。Dockerを使っているおかげで環境差異が少なくて助かる。', 'Docker開発者', 'line05.jpg'),
(20260207, 'リリース完了！', '打ち上げ最高', '無事に動くものをリリースできた。チーム全員で食べたピザの味は忘れない。', '全ての関わってくれた人', 'line06.jpg');