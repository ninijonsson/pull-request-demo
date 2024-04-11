<?php

// We'll create an empty array of dogs
$dogs = [];

if (file_exists("dogs.json")) {
    // ...And if the file exists (with our dogs)
    $json = file_get_contents("dogs.json");
    // We'll insert them into our array
    $dogs = json_decode($json, true);
}

// The user message starts out as an empty string
$message = "";

// We'll check if we received what we wanted
if (isset($_POST["name"], $_POST["breed"], $_POST["age"], $_POST["favoriteFood"])) {
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $food = $_POST["favoriteFood"];

    // ...And that the values are not empty
    if ($name != "" && $breed != "" && $age != "" && $food != "") {
        $newDog = [
            "name" => $name,
            "breed" => $breed,
            "age" => intval($age),    // NOTE: intval converts a variable to an integer (https://www.php.net/manual/en/function.intval.php)
            "favoriteFood" => $food,
        ];

        // ...If so, we'll add the new dog to our database
        $dogs[] = $newDog;
        file_put_contents("dogs.json", json_encode($dogs, JSON_PRETTY_PRINT));

        // Here we set the user message, so we can notify them of what happened
        $message = "$name ($breed) was added to the kennel!";
    }
}
?>