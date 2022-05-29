<?php

class News{
    public static function fetchNews(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `news`
            ORDER BY news_date desc
            LIMIT 6";
        return $conn->query($query);
    }

    public static function fetchNewsById($newsId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `news`
            WHERE news_id = '" . $newsId . "'";
        return $conn->query($query);
    }

    public static function fetchLatestNews(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `news`
            ORDER BY news_date desc
            LIMIT 1";
        return $conn->query($query);
    }

    public static function fetchFourLatestNews(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `news`
            ORDER BY news_date desc
            LIMIT 4";
        return $conn->query($query);
    }
}
?>