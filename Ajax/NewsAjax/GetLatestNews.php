<?php
require "../../Models/ConnectionConfig/DataBase.php";
require "../../Models/News/News.php";

$result = News::fetchLatestNews();
$i = 0;
$temp = "";
while ($row = $result->fetch_assoc()) {
    $html = 
    "<div class='fn_header'> 
        <div class='fn_title'> 
            <h1>" . $row['news_title'] . "</h1>
        </div>
        <div class='author_time'>
            <p>" . $row['news_author'] . "</p>
            <p>" . $row['news_date'] . "</p> 
        </div> 
    </div>
    <div class='fn_content center'>
        <img class='fn_image center' src='" . $row['news_img'] . "'></img>
        <p class='fn_paragraph'>" . $row['news_content'] . "</p>
    </div>";
}

echo $html;
?>