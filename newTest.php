<?php

    include('new_time.php');

    //Чтение содержимого JSON файла в строку
    $jsonString = file_get_contents('quest.json');
    //Преобразование JSON строки в ассоциативный массив
    $data = json_decode($jsonString, true);

    $name = $_POST['name'];
    $diff = $_POST['diff'];
    $company = $_POST['company'];
    $close_date = $_POST['date'];
    $open_date = new_time();

    $quest = [];

    for($i = 0; $i < 21; $i++) {

        if(isset($_POST['quest_'.$i])) {

            $text = $_POST['quest_'.$i];

            if(isset($_POST['quest_'.$i.'_correct'])) {

                $correct = $_POST['quest_'.$i.'_correct'];

                $variable = [];

                for($j = 0; $j < 6; $j++) {

                    if(isset($_POST['quest_'.$i.'_'.$j])) {

                        $variable[] = $_POST['quest_'.$i.'_'.$j];

                    }

                }

            }
            
            if(isset($_POST['quest_'.$i.'_correct'])) {

                $new_quest = array(
                    "text" => $text,
                    "current_varibale" => $correct,
                    "variable" => $variable
                );

            }
            else {

                $new_quest = array(
                    "text" => $text
                );

            }
            

            $quest[] = $new_quest;

        }

    }

    $newTest = array(
        "name" => $name,
        "diff" => $diff,
        "company" => $company,
        "open" => $open_date,
        "close" => $close_date,
        "quest" => $quest
    );

    $data["quests"][] = $newTest;

    $newJson = json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    file_put_contents('quest.json', $newJson);

    $script = 'employer.php';
    header("Location: $script");

?>