<?php
/**
 * 有限会社レジェンズ お問い合わせフォーム送信処理
 * 
 * 必要環境: PHP 7.0以上、mb_send_mail() が動作するサーバー
 * 送信先: legends.higo@gmail.com
 * 
 * 本実装は基本的なmail()関数を使用しています。
 * Gmail等への安定送信が必要な場合は、PHPMailer + SMTP認証への切替を推奨します。
 */

// =====================================================
// 設定
// =====================================================
$TO_EMAIL    = 'legends.higo@gmail.com';
$FROM_EMAIL  = 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'example.com');
$SITE_NAME   = '有限会社レジェンズ';

// =====================================================
// POST受信＆バリデーション
// =====================================================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./contact.html');
    exit;
}

mb_language('Japanese');
mb_internal_encoding('UTF-8');

$company  = trim($_POST['company']  ?? '');
$name     = trim($_POST['name']     ?? '');
$tel      = trim($_POST['tel']      ?? '');
$email    = trim($_POST['email']    ?? '');
$message  = trim($_POST['message']  ?? '');
$agree    = isset($_POST['agree']);

$errors = [];
if ($name === '')    { $errors[] = 'お名前を入力してください。'; }
if ($email === '')   { $errors[] = 'メールアドレスを入力してください。'; }
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'メールアドレスの形式が正しくありません。';
}
if (!$agree)         { $errors[] = '個人情報の取り扱いに同意してください。'; }

if (!empty($errors)) {
    http_response_code(400);
    echo '<h1>入力エラー</h1><ul>';
    foreach ($errors as $e) { echo '<li>' . htmlspecialchars($e) . '</li>'; }
    echo '</ul><p><a href="./contact.html">戻る</a></p>';
    exit;
}

// =====================================================
// メール送信
// =====================================================
$subject = '[' . $SITE_NAME . '] お問い合わせを受け付けました';
$body = <<<EOT
{$SITE_NAME} のウェブサイトよりお問い合わせがありました。

────────────────────────
■ 会社名
{$company}

■ お名前
{$name}

■ お電話番号
{$tel}

■ E-mail
{$email}

■ ご要望詳細
{$message}
────────────────────────

送信日時: 
EOT;
$body .= date('Y-m-d H:i:s');

$headers  = 'From: ' . mb_encode_mimeheader($SITE_NAME, 'UTF-8') . " <{$FROM_EMAIL}>\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$sent = mb_send_mail($TO_EMAIL, $subject, $body, $headers);

if ($sent) {
    header('Location: ./contact.html?status=success');
    exit;
} else {
    http_response_code(500);
    echo '<h1>送信エラー</h1>';
    echo '<p>申し訳ございません、送信に失敗しました。お手数ですがお電話にてお問い合わせください。</p>';
    echo '<p><a href="./contact.html">戻る</a></p>';
    exit;
}
