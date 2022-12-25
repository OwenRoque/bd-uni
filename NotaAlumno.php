<?php

    class NotaAlumno {

        public $codigo_mtr;
        public $codigo_curso;
        public $grupo;
        public $ausente;
        public $C1;
        public $C2;
        public $C3;
        public $E1;
        public $E2;
        public $E3;

        public function __construct($codigo_mtr, $codigo_curso, $grupo, $ausente, $C1, $C2, $C3,$E1,$E2,$E3){
            $this->codigo_mtr = $codigo_mtr;
            $this->codigo_curso = $codigo_curso;
            $this->grupo = $grupo;
            $this->ausente = $ausente;
            $this->$C1 = $C1;
            $this->$C2 = $C2;
            $this->$C3 = $C3;
            $this->$E1 = $E1;
            $this->$E2 = $E2;
            $this->$E3 = $E3;
        }
    };

?>