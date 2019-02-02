<?php
class NotesDAO
{

    public function retrieve($company,$department,$team,$cases)
    {
        $sql = 'select content, company, department, team, id ,username, cases from notes where company=:company AND department=:department AND team=:team AND cases=:cases';

        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();


        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':department', $department, PDO::PARAM_STR);
        $stmt->bindParam(':team', $team, PDO::PARAM_STR);
        $stmt->bindParam(':cases', $cases, PDO::PARAM_STR);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Notes($row['content'], $row['company'], $row['department'], $row['team'], $row['id'], $row['username'],$row['cases']);
        }
    }

    public function create($notes)
    {
        $sql = "INSERT INTO notes (content, company, department, team, id, username, cases) VALUES (:content, :company, :department, :team, :id, :username, :cases)";
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':content', $notes->content, PDO::PARAM_STR);
        $stmt->bindParam(':company', $notes->company, PDO::PARAM_STR);
        $stmt->bindParam(':department', $notes->department, PDO::PARAM_STR);
        $stmt->bindParam(':team', $notes->team, PDO::PARAM_STR);
        $stmt->bindParam(':id', $notes->id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $notes->username, PDO::PARAM_STR);
        $stmt->bindParam(':cases', $notes->cases, PDO::PARAM_STR);
        $isAddOK = $stmt->execute();
        // if($isAddOK){
        //     echo "success";
        // }
        // else{
        //     echo "fail";
        // }
        // return $isAddOK;
        
    }
    
    public function update($content,$department,$team,$cases,$company)
    {
        $sql = 'UPDATE notes SET content=:content WHERE company=:company AND department=:department AND team=:team AND cases=:cases ';

        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':department', $department, PDO::PARAM_STR);
        $stmt->bindParam(':team', $team, PDO::PARAM_STR);
        $stmt->bindParam(':cases', $cases, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);

        $isUpdateOk = False;
        if ($stmt->execute()) {
            $isUpdateOk = True;
        }
        return $isUpdateOk;
    }

}