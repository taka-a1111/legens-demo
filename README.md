# 有限会社レジェンズ コーポレートサイト

## ファイル構成

```
.
├── index.html                  # トップページ
├── works.html                  # 施工事例
├── company.html                # 会社案内
├── contact.html                # お問い合わせ（フォーム）
├── contact.php                 # お問い合わせ送信処理（要PHP環境）
├── css/
│   ├── style.css               # 共通スタイル
│   └── pages.css               # ページ別スタイル
├── js/
│   └── main.js                 # 共通JavaScript
└── images/
    ├── logo-bird-transparent.png  # 公式ロゴ（透過PNG、1080×1080）
    ├── logo-bird-small.png        # 公式ロゴ（縮小版、320×320）
    ├── president.jpg              # 代表者写真
    ├── service/                   # トップページ用画像
    ├── works/                     # 施工事例画像（旧）
    └── works2/                    # 施工事例画像（クライアント提供）
```

## デプロイ手順

### Vercel（GitHub経由・静的サイト確認用）

1. GitHub に新規リポジトリを作成
2. このディレクトリの中身を全部リポジトリにアップロード（フォルダ込み）
3. Vercel で新規プロジェクト作成 → GitHubリポジトリをImport → Deploy
4. 数十秒で `https://xxxx.vercel.app` が発行される

**※ Vercel では PHP は実行されません。お問い合わせフォームの動作確認は本番サーバーで行ってください。**

### 本番サーバー（FTP）

`index.html` がルートに来るように、中身を全部アップロード。
PHPが動作するサーバー（PHP 7.0以上、`mb_send_mail()` 関数が使えること）が必要です。

## お問い合わせフォーム

- 送信先メールアドレス：`legends.higo@gmail.com`（`contact.php` 内で定義）
- 送信処理：基本の `mail()` 関数を使用
- バリデーション：お名前・E-mail・同意チェックを必須化

### Gmail宛の安定送信について

サーバーから直接Gmailへ送信する場合、SPF/DKIM未設定だと迷惑メール扱いになる可能性があります。
本番環境では PHPMailer + SMTP認証（Gmail のアプリパスワード使用）への切り替えを推奨します。

## 技術仕様

- HTML5 / CSS3 / バニラJavaScript
- Noto Sans JP + Montserrat（Google Fonts）
- レスポンシブ：768px / 480px の2段階ブレイクポイント
- メインカラー：`#3CA77A`（緑）
- 対応ブラウザ：Chrome / Safari / Edge 最新版

## 反映済み素材

- 公式ロゴ：鳥のデザイン（白背景を透過処理済み）
- 代表者写真：肥後 邦彦様
- 施工事例画像：クライアント提供分（works2/ ）
- フォーム送信先メールアドレス

## 残作業

- [ ] 本番サーバーへのFTPアップロード（接続情報待ち）
- [ ] PHPMailer + SMTP 移行（Gmail宛安定送信のため、要望次第）
