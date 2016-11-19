<?php
// error_reporting(-1);
// ini_set('display_errors', 'On');
// set_error_handler("var_dump");
error_reporting(0);
ini_set('display_errors', 'Off');
set_error_handler("var_dump");

ob_start();
var_dump($_POST);
$var_dump = ob_get_clean();

// die("quit");


// require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';
require_once __DIR__ . '/swiftmailer/vendor/autoload.php';

// Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls')
// $transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
    ->setUsername('null.kunst@gmail.com')
    ->setPassword('EP9K8b27')
    // ->setUsername('xoartx@gmail.com')
    // ->setPassword('wbugv945db')
  ;

// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create the message
$message = Swift_Message::newInstance('My amazing subject');

// $cid = $message->embed(Swift_Image::fromPath('images/apples01.jpg'));
// $cid = $message->embed(Swift_Image::fromPath('images/apples01.jpg'));

// Give the message a subject
$message->setSubject('【webcreate】見積り依頼を受けました')

// Set the From address with an associative array
// ->setFrom(array('john@doe.com' => 'John Doe'))
->setFrom(array('null.kunst@gmail.com' => 'web 制作用'))
// ->setFrom(array('xoartx@gmail.com' => 'Taro Ogawa'))

// Set the To addresses with an associative array
// ->setTo(array('receiver@domain.org', 'other@domain.org' => 'A name'))
// ->setTo(array('xoartx@gmail.com' => 'Taro Ogawa'))
->setTo(array('taro_ogawa@hotmail.com' => 'Taro Ogawa'))

// Give it a body
// ->setBody('見積り依頼の内容')
// ->setBody(
// '<html>' .
// ' <head></head>' .
// ' <body>' .
// '  Here is an image <img src="' . $cid . '" alt="Image" />' .
// '  Rest of message' .
// ' </body>' .
// '</html>',
//   'text/html' // Mark the content-type as HTML
// )

// Set the body
->setBody(
    '<html>' .
    '<head><title>【webcreate】</title></head>' .
    '<body>' .
    '<p> こんな感じのイメージでお願いします。</p>' .
        ' <img src="' . // Embed the file
            $message->embed(Swift_Image::fromPath('images/apples01.jpg')) .
        '" alt="Image" />' .
    '<p>よろしくお願いします。</p>' .
    '<p>とかそんな感じのメールがswiftmailerから送れるよと言うテストでした。</p>' .
    '<p style="margin-top: 2em">以下、POST変数</p>' .
    '<pre>' . $var_dump . '</pre>' .
    '</body>' .
    '</html>'
    ,
    'text/html' // Mark the content-type as HTML
)

// And optionally an alternative body
// ->addPart('<q>見積り依頼の内容</q>', 'text/html')

// Optionally add any attachments
// ->attach(Swift_Attachment::fromPath('my-document.pdf'))
// ->attach(Swift_Attachment::fromPath('./images/price01.png'))

; // ←消しちゃ駄目！

// Send the message
header("Refresh: 10; URL=detail.html");

// if ($result = $mailer->send($message)) {
try {
    $mailer->send($message);

    echo <<< EOT
    <h1>正常に送信しました。</h1>
    <p>追ってこちらからメールいたします。しばらくお待ち下さい。</p>
    <p>このページは10秒後に自動的に切り替わります。</p>
EOT;
} catch (Exception $e) {
    echo <<< EOT
        <h1>送信に失敗しました。</h1>
        <p>しばらく待ってからもう1度再度フォームから送信してください。</p>
        <p>このページは10秒後に自動的に切り替わります。</p>
EOT;
};
?>
