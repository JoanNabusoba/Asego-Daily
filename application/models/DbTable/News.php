<?php

class Application_Model_DbTable_News extends Zend_Db_Table_Abstract
{

    protected $_name = 'news';

public function getNews($id) 
{
$id = (int)$id;
$row = $this->fetchRow('id = ' . $id);
if (!$row) {
throw new Exception("Could not find row $id");
}
return $row->toArray(); 
}
public function saveNews($title, $content,$id1,$id2,$status, $image)
{
	$date = new Zend_Db_Expr('NOW()');
$data = array(
'content' => $content,
'title' => $title,
'reporterid'=> $id1,
'editorid'=> $id2,
'createdAt'=> $date ,
'publishedAt'=> NULL,
'image'=>$image,
'status' => $status
);
$this->insert($data);
}
public function editNews($id,$title, $content,$id1,$id2)
{
$data = array(
'content' => $content,
'title' => $title,
'reporterid'=> $id1,
'editorid'=> $id2,
'editedAt'=>'now()' ,
'status'=> 'edited',

);
$this->update($data, 'id = '. (int)$id);
}
public function publishNews($id,$title, $content,$id1,$id2,$type)
{
$data = array(
'content' => $content,
'title' => $title,
'reporterid'=> $id1,
'editorid'=> $id2,
'publishedAt'=> 'now()' ,
'status'=> 'published',
'type' =>$type
);
$this->update($data, 'id = '. (int)$id);
}
public function updateNews($id,$title, $content,$id1,$id2,$status)
{
$data = array(
'content' => $content,
'title' => $title,
);
$this->update($data, 'id = '. (int)$id);
}
public function deleteNews($id)
{
$this->delete('id =' . (int)$id);
}
public function getSpecNews($status, $userid, $who) {
$row = $this->fetchRow('status = ' . $status . ' and '.$who.' =' .$userid );
if (!$row) {
throw new Exception("Could not find row $id");
}
return $row->toArray(); 
}
public function getMainNews($type) {
$sql = 'SELECT * FROM news WHERE status= "published" AND type= "'.$type.'" ';  
       $query = $this->getAdapter()->query($sql);
        $result = $query->fetchAll();
        if (!$result) {
throw new Exception("Could not find row $id");
}
return $result; 
}
public function lastID(){
	$sql = 'SELECT max(id) FROM news';  
        $query = $this->getAdapter()->query($sql);
        $result = $query->fetchAll();
        return $result[0]['max(id)']; 
}


}

?>