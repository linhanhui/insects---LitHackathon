<?php

class Notes
{
    // property declaration
    public $content;
    public $company;
    public $department;
    public $team;
    public $id;
    public $username;
    public $cases;

    public function __construct($content, $company, $department, $team, $id ,$username, $cases)
    {
        $this->content = $content;
        $this->company = $company;
        $this->department = $department;
        $this->team = $team;
        $this->id = $id;
        $this->username = $username;
        $this->cases = $cases;
    }
}

?>