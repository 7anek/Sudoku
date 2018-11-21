<?php

class Sudoku {

    public $sudoku = [];

    function __construct($sudoku) {
        $this->sudoku = $sudoku;
    }

    function backtracking() {
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                if ($this->sudoku[$i][$j] == 0) {
                    for ($l = 1; $l <= 9; $l++) {
                        if ($this->isCorrect($i, $j, $l)) {
                            $this->sudoku[$i][$j] = $l;
                            if ($this->backtracking() !== []) {
                                return $this->sudoku;
                            } else {
                                $this->sudoku[$i][$j] = 0;
                            }
                        }
                    }
                    return [];
                }
            }
        }
        return $this->sudoku;
    }

    function isCorrect($i, $j, $l) {
        for ($k = 0; $k < 9; $k++) {
            if ($l == $this->sudoku[$i][$k]) {
                return false;
            }
            if ($l == $this->sudoku[$k][$j]) {
                return false;
            }
            $subx = (floor($k / 3)) + (floor($i / 3) * 3);
            $suby = ($k % 3) + (floor($j / 3) * 3);
            if ($l == $this->sudoku[$subx][$suby]) {
                return false;
            }
        }
        return true;
    }

}

$sudoku = [
    [5, 3, 0, 0, 7, 0, 0, 0, 0],
    [6, 0, 0, 1, 9, 5, 0, 0, 0],
    [0, 9, 8, 0, 0, 0, 0, 6, 0],
    [8, 0, 0, 0, 6, 0, 0, 0, 3],
    [4, 0, 0, 8, 0, 3, 0, 0, 1],
    [7, 0, 0, 0, 2, 0, 0, 0, 6],
    [0, 6, 0, 0, 0, 0, 2, 8, 0],
    [0, 0, 0, 4, 1, 9, 0, 0, 5],
    [0, 0, 0, 0, 8, 0, 0, 7, 9]
];
$s = new Sudoku($sudoku);
var_dump($s->backtracking());
