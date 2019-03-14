<?php
require_once __DIR__ . "/../vendor/autoload.php";
Toro::serve(array(
    "/" => "Controllers\\HomeController",
    "/login" => "Controllers\\LoginController",
    "/signup" => "Controllers\\SignupController",
    "/addquestion" => "Controllers\\AddQController",
    "/quizboard" => "Controllers\\QuizBoardController",
    "/leaderboard" => "Controllers\\LeaderBoardController",
));
?>