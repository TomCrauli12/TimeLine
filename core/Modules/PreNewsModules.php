<?php

require_once __DIR__ . '/../../DB/DB.php';

class PreNews {
    static function addPreNews($title, $description, $shortDescription, $glavImage, $imageTwo, $imageThree, $author, $date, $glavNews, $category) {
        $conn = DB::getConnection();

        //переменные для генерации индивидуамльных имен
        $glavImageName = '';
        $imageTwoName = '';
        $imageThreeName = '';

        if (isset($_FILES['glavImage']) && $_FILES['glavImage']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['glavImage']['name'], PATHINFO_EXTENSION);
            $glavImageName = uniqid('', true) . '.' . $ext;
            if (!move_uploaded_file($_FILES['glavImage']['tmp_name'], '../../imageNews/' . $glavImageName)) {
                echo 'Ошибка загрузки главного изображения';
            }
        }

        if (isset($_FILES['imageTwo']) && $_FILES['imageTwo']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['imageTwo']['name'], PATHINFO_EXTENSION);
            $imageTwoName = uniqid('', true) . '.' . $ext;
            if (!move_uploaded_file($_FILES['imageTwo']['tmp_name'], '../../imageNews/' . $imageTwoName)) {
                echo 'Ошибка загрузки изображения';
            }
        }

        if (isset($_FILES['imageThree']) && $_FILES['imageThree']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['imageThree']['name'], PATHINFO_EXTENSION);
            $imageThreeName = uniqid('', true) . '.' . $ext;
            if (!move_uploaded_file($_FILES['imageThree']['tmp_name'], '../../imageNews/' . $imageThreeName)) {
                echo 'Ошибка загрузки изображения';
            }
        }

        $query = $conn->prepare("INSERT INTO `PrePosts` (`title`, `description`, `shortDescription`, `glavImage`, `imageTwo`, `imageThree`, `author`, `date`, `glavNews`, `category`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$title, $description, $shortDescription, $glavImageName, $imageTwoName, $imageThreeName, $author, $date, $glavNews, $category]);
    }


    static function deletedPreNews($id){
        $conn = DB::getConnection();

        $query = $conn->prepare("DELETE FROM PrePosts WHERE id = ?");
        $query->execute([$id]);
    }
    

    static function redactPreNews($title, $description, $shortDescription, $id){
        $conn = DB::getConnection();

        $query = $conn->prepare("UPDATE PrePosts SET `title` = ?, `description` = ?, `shortDescription` = ? WHERE `id` = ?");
        $query->execute([$title, $description, $shortDescription, $id]);
    }

    static function publishNews($title, $description, $shortDescription, $glavImage, $imageTwo, $imageThree, $author, $date, $glavNews, $category) {
        $conn = DB::getConnection();
        try {
            if ($glavNews == 'да') {
                $countQuery = $conn->query("SELECT COUNT(*) FROM News WHERE glavNews = 'да'");
                $count = $countQuery->fetchColumn();
                if ($count >= 5) {
                    $oldestQuery = $conn->query("SELECT id FROM News WHERE glavNews = 'да' ORDER BY date ASC LIMIT 1");
                    $oldestNews = $oldestQuery->fetchColumn();
                    if ($oldestNews) {
                        $updateQuery = $conn->prepare("UPDATE News SET glavNews = 'нет' WHERE id = ?");
                        $updateQuery->execute([$oldestNews]);
                    }
                }
            }
            $query = $conn->prepare("INSERT INTO News (`title`, `description`, `shortDescription`, `glavImage`, `imageTwo`, `imageThree`, `author`, `date`, `glavNews`, `category`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->execute([$title, $description, $shortDescription, $glavImage, $imageTwo, $imageThree, $author, $date, $glavNews, $category]);
        } catch (PDOException $e) {
            error_log("Ошибка при публикации новости: " . $e->getMessage());
            echo "Ошибка при публикации новости.";
        }
    }

    
}
?>
