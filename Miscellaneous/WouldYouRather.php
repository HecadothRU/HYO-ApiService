<?php

class WouldYouRather
{
    private array $questions = [
        [
            'option1' => 'Be able to read minds',
            'option2' => 'Be able to teleport anywhere',
        ],
        [
            'option1' => 'Live without the internet',
            'option2' => 'Live without air conditioning and heating',
        ],
        [
            'option1' => 'Give up your favorite food forever',
            'option2' => 'Give up your favorite movie or TV show forever',
        ],
        [
            'option1' => 'Be invisible',
            'option2' => 'Be able to fly',
        ],
        [
            'option1' => 'Never be able to eat your favorite food again',
            'option2' => 'Have to eat only your favorite food for the rest of your life',
        ],
    ];

    public function getRandomQuestion(): array
    {
        $randomIndex = array_rand($this->questions);
        return $this->questions[$randomIndex];
    }
}

header('Content-Type: application/json');

try {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $response = [];

    if ($requestMethod === 'GET') {
        $wouldYouRather = new WouldYouRather();
        $question = $wouldYouRather->getRandomQuestion();
        $response = ['status' => 'success', 'question' => $question];
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid request method'];
    }

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
