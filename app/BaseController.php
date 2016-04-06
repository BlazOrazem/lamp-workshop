<?php

class BaseController
{
    public static function runIndex()
    {
        $error = false;

        if (!empty($_POST['posted'])) {
            if (check_required(['workshop', 'full_name', 'email', 'confirm'])) {
                if (Model::checkApplication($_POST['workshop'], $_POST['email'])) {
                    $error = 'Na to delavnico ste že prijavljeni!';
                } elseif (!Model::checkWorkshopCapacity($_POST['workshop'])) {
                    $error = 'Ta delavnica je že zasedena!';
                } else {
                    Model::saveApplication($_POST['workshop'], $_POST['email'], $_POST['full_name']);
                    $success = true;
                }
            } else {
                $error = 'Vsa polja so obvezna!';
            }
        }

        $workshops = Model::getActiveWorkshops();

        require 'views/home.php';
    }
}
