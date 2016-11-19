<?php
// ページ構成
$page_lists = array("index.html"=>"トップ", "development.html"=>"ホームページ作成", "easy.html"=>"カンタン見積もり",
"detail.html"=>"お見積もりフォーム", "about_me.html"=>"制作者について", "twitter.html"=>"ツイッター");

// currentなhtmlファイル
$pattern = '/(.*)\/([a-zA-Z0-9].+)(\.html)/';
$replacement = '$2$3';
$subject = $_SERVER['SCRIPT_NAME'] ;
$cur_html = preg_replace($pattern, $replacement, $subject);

// ページタイトル
$page_title = "ホームページ、作ります";

// link_list();
function link_list() {
    global $page_lists;
    global $cur_html;
    foreach ($page_lists as $key => $value) {
        echo "<li>";
        if ($key == $cur_html) {
            // 見てるページなら
            echo $value;
        } else if ($key == "index.html") {
            echo "<a href=\"./\">$value</a>";
        } else {
            echo "<a href=\"$key\">$value</a>";
        }
        echo "</li>\n";
    }
}
?>
