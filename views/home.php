<?php


if (!isset($_SESSION["user_role"])) {
    redirect("/admin/users");
    exit();
}

if ($_SESSION["user_role"] === "admin") redirect("/admin/users");
if ($_SESSION["user_role"] === "doctor") redirect("/medical-records");
if ($_SESSION["user_role"] === "patient") redirect("/my-records");
