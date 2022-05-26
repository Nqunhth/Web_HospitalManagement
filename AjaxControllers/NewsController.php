<?php



// class NewsController
// {
//     public static function getAllNews()
//     {  
        

//         return $result;
//     }
// }

$result = News::fetchFourLatestNews();
$i = 0;
$temp = "";
while ($row = $result->fetch_assoc()) {
    $temp .= $row['news_content'] . $row['news_title']  ;
    $i++;
}

echo $temp;

?>