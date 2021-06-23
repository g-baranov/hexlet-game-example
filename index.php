<?php

use function cli\choose;
use function cli\line;
use function cli\prompt;

require_once __DIR__ . '/vendor/autoload.php';

line('Это игра Палиндром. Игроку нужно ответить является ли слово палиндромом');
$playerName = prompt('Укажите ник');
line("{$playerName}, добро пожаловать в игру!");

$score = 0;
while (true) {
    $word = getRandomWord();
    $playerAnswer = choose("Слово '{$word}' явяляется полиндромом", 'yn', 'n');
    $playerAnswer = isPositiveAnswer($playerAnswer);
    $gameAnswer = isPalindrome($word);

    if ($playerAnswer === $gameAnswer) {
        $score++;
        line("Верно! Текущий счет: {$score}");
    } else {
        line("Ошибка! Игра окончена! Итоговый счет: {$score}");
        break;
    }
}

function isPositiveAnswer(string $answer): bool
{
    return $answer === 'y';
}

function getRandomWord(): string
{
    $words = [
        'радар',
        'игра',
        'дед',
        'довод',
        'доход',
        'заказ',
        'сказка',
        'автомобиль'
    ];
    $randomIndex = array_rand($words);
    return $words[$randomIndex];
}

function isPalindrome(string $word): bool
{
    return strrev_arr($word) === $word;
}

function strrev_arr($str)
{
    preg_match_all('/./us', $str, $array);
    $str = join('', array_reverse($array[0]));
    return $str;
}

