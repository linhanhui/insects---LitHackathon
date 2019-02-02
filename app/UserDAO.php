<?php
class UserDAO
{
    public function retrieve($id)
    {
        $sql = 'select username, password, company, department, team ,id from user where id=:id';

        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();


        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new User($row['username'], $row['password'], $row['company'], $row['department'], $row['team'], $row['id']);
        }
    }

    // public function retrieveAll()
    // {
    //     $sql = 'select * from user';

    //     $connMgr = new ConnectionManager();
    //     $conn = $connMgr->getConnection();
    //     $stmt = $conn->prepare($sql);
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     $stmt->execute();
    //     $result = array();
    //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //         $result[] = new User($row['username'], $row['password'], $row['company'], $row['department'], $row['team'], $row['$id']);
    //     }
    //     return $result;
    // }

    public function create($user)
    {
        $sql = "INSERT INTO user (username, password, company, department, team, id) VALUES (:username, :password, :company, :department, :team, :id)";
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $user->username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->password, PDO::PARAM_STR);
        $stmt->bindParam(':company', $user->company, PDO::PARAM_STR);
        $stmt->bindParam(':department', $user->department, PDO::PARAM_STR);
        $stmt->bindParam(':team', $user->team, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user->id, PDO::PARAM_INT);
        $isAddOK = $stmt->execute();

        return $isAddOK;
        
    }

    // public function update($user)
    // {
    //     $sql = 'UPDATE admin_user SET gender=:gender, password=:password, name=:name WHERE username=:username';

    //     $connMgr = new ConnectionManager();
    //     $conn = $connMgr->getConnection();
    //     $stmt = $conn->prepare($sql);

    //     $user->password = password_hash($user->password, PASSWORD_DEFAULT);
    //     $stmt->bindParam(':username', $user->username, PDO::PARAM_STR);
    //     $stmt->bindParam(':gender', $user->gender, PDO::PARAM_STR);
    //     $stmt->bindParam(':password', $user->password, PDO::PARAM_STR);
    //     $stmt->bindParam(':name', $user->name, PDO::PARAM_STR);
    //     $isUpdateOk = False;
    //     if ($stmt->execute()) {
    //         $isUpdateOk = True;
    //     }
    //     return $isUpdateOk;
    // }
}