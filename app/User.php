<?php

class User
{
    // property declaration
    public $username;
    public $password;
    public $company;
    public $department;
    public $team;
    public $id;

    public function __construct($username, $password, $company, $department, $team ,$id)
    {
        $this->username = $username;
        $this->password = $password;
        $this->company = $company;
        $this->department = $department;
        $this->team = $team;
        $this->id = $id;
    }
}

?>