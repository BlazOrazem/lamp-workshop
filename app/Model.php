<?php

class Model
{
    private static $db = null;

    public static function setup()
    {
        static::$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        static::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getWorkshop($id)
    {
        $stmt = static::$db->prepare('
            SELECT *
            FROM workshop
            WHERE id = ?
        ');
        $stmt->execute([$id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($results)) {
            return $results[0];
        }

        return null;
    }

    public static function getActiveWorkshops()
    {
        $stmt = static::$db->query('
            SELECT *
            FROM workshop
            WHERE start_date > NOW()
            ORDER BY start_date DESC
        ');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllWorkshops()
    {
        $stmt = static::$db->query('
            SELECT workshop.*, COUNT(application.id) AS applications
            FROM workshop
            LEFT JOIN application ON application.workshop_id = workshop.id
            GROUP BY workshop.id
            ORDER BY start_date DESC
        ');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function saveWorkshop($title, $startDate, $capacity, $workshopId = null)
    {
        if ($workshopId) {
            $stmt = static::$db->prepare('
                UPDATE workshop
                SET title = ?, start_date = ?, capacity = ?
                WHERE id = ?
            ');
            $stmt->execute([$title, $startDate, $capacity, $workshopId]);
            $recordId = $workshopId;
        } else {
            $stmt = static::$db->prepare('
                INSERT INTO workshop(title, start_date, capacity)
                VALUES (?, ?, ?)
            ');
            $stmt->execute([$title, $startDate, $capacity]);
            $recordId = static::$db->lastInsertId();
        }

        return $recordId;
    }

    public static function checkApplication($workshop, $email)
    {
        $stmt = static::$db->prepare('
            SELECT *
            FROM application
            WHERE workshop_id = ?
            AND email = ?
        ');
        $stmt->execute([$workshop, $email]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return count($results) ? true : false;
    }

    public static function saveApplication($workshop, $email, $name)
    {
        $stmt = static::$db->prepare('
            INSERT INTO application(workshop_id, email, full_name, date_added)
            VALUES (?, ?, ?, NOW())
        ');
        $stmt->execute([$workshop, $email, $name]);

        return static::$db->lastInsertId();
    }

    public static function getWorkshopApplications($workshopId)
    {
        $stmt = static::$db->prepare('
            SELECT *
            FROM application
            WHERE workshop_id = ?
        ');
        $stmt->execute([$workshopId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function checkWorkshopCapacity($id)
    {
        $workshop = static::getWorkshop($id);
        $applications = static::getWorkshopApplications($id);
        if (!empty($workshop) && !empty($applications)) {
            return $workshop['capacity'] ? $workshop['capacity'] > count($applications) : true;
        }

        return true;
    }

    public static function authenticateAdmin($username, $password)
    {
        $stmt = static::$db->prepare('
            SELECT *
            FROM admin
            WHERE username = ?
            AND password = ?
        ');
        $stmt->execute([trim($username), trim(md5($password))]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
