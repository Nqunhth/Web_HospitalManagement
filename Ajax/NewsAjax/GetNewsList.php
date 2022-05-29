<?php
require "../../Models/ConnectionConfig/DataBase.php";
require "../../Models/News/News.php";

$result = News::fetchNews();
$i = 0;
$temp = "";
$html = 
"<ul class='news_list'>";
while ($row = $result->fetch_assoc()) {
    $html .= "
    <li class='news_item center' onclick='onClickNewsItem();' value='" . $row['news_id'] . "'>
        <img class='thumpnail center' src='" . $row['news_img'] . "'></img>
        <div class='news_description'>
            <div class='news_des_head'>
                <h2 class='title'>" . $row['news_title'] . "</h2>
                <p class='author'>- " . $row['news_author'] . "</p>
            </div>
            <div class='des_content_container'>
                <p class='des_content'>" . $row['news_content'] . "</p>
            </div>
                <p class='update_time'>" . $row['news_date'] . "</p>            
        </div>
    </li>";
        
}
$html .= "</ul>";

echo $html;

?>