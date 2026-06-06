# LEGENS 有限会社レジェンズ コーポレートサイト

## ファイル構成

```
legens_project/  ← 本番納品物（FTP転送用）
├ index.html         # トップページ
├ works.html         # 施工事例
├ company.html       # 会社案内
├ contact.html       # お問い合わせ
├ css/
│  ├ style.css       # 共通スタイル
│  └ pages.css       # ページ別スタイル
├ js/
│  └ main.js         # 共通JavaScript
└ images/
   ├ service/        # トップページ用イメージ画像（6点）
   └ works/          # 施工事例画像（17点）
```

## 残作業

- [ ] contact.php（フォーム送信処理）の作成
- [ ] メインビジュアル画像の差し替え（クライアント素材待ち）
- [ ] ロゴデータの正式版差し替え（現在は仮実装）
- [ ] ファビコンの正式版差し替え（現在は仮実装SVG）

## 仕様

- 対応ブラウザ：Chrome / Safari / Edge 最新版
- レスポンシブ：768px / 480pxで切り替え
- JavaScript：モバイルメニュー、スクロールアニメーション、施工事例タブ切替、フォームバリデーション
- フォント：Noto Sans JP（本文）/ Montserrat（英字）

## クライアント確認用Vercelデプロイ手順

別ZIPの `legens_vercel_demo.zip` をご利用ください。

### 手順

1. **GitHub にリポジトリ作成**
   - https://github.com/new
   - リポジトリ名：例 `legens-demo`
   - Public または Private を選択 → Create

2. **ZIPの中身をアップロード**
   - 作成したリポジトリで「Add file」→「Upload files」
   - `legens_vercel_demo.zip` を解凍した中身全部をドラッグ＆ドロップ
   - 一番下の「Commit changes」をクリック

3. **Vercel にデプロイ**
   - https://vercel.com/new
   - GitHub アカウントでログイン
   - 上記リポジトリを Import
   - そのまま Deploy をクリック
   - 数十秒で `https://xxxx.vercel.app` のURLが発行される

4. **クライアントへ共有**
   - 発行されたURLをクライアントに送って確認してもらう
   - 左上に赤い「DEMO - CLIENT REVIEW」バナーが表示される（確認用識別子）

## 本番納品時の注意

- `legens_production.zip` を解凍してFTPでアップロード
- 本番版にはDEMOバナーは含まれていない
- ルートディレクトリに index.html が来るように配置
