<?php
use Phalcon\Mvc\View;
class EditController extends ControllerBase{
 
  public function indexAction(){
    if($this->request->isPost()){
    $this->response->redirect('profile');
    }
  }
  public function setAction($num){
    session_start();
        $_SESSION["edit"] = $num;
        if($this->request->isPost()){
          $email = trim($this->request->getPost('eventname')); // รับค่าจาก form
          $pass = trim($this->request->getPost('eventdate')); // รับค่าจาก form
          $firstname = trim($this->request->getPost('eventdetail')); // รับค่าจาก form
          $photo = trim($this->request->getPost('photo')); // รับค่าจาก form
          $photoUpdate='';
          if($this->request->hasFiles() == true){
              $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $uploads = $this->request->getUploadedFiles();
          
              $isUploaded = false;			
              foreach($uploads as $upload){
                if(in_array($upload->gettype(), $allowed)){					
                $photoName=md5(uniqid(rand(), true)).strtolower($upload->getname());
                $path = '../public/img/'.$photoName;
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                }
              }
                    
              if($isUploaded)  $photoUpdate=$photoName ;
          }else
              die('You must choose at least one file to send. Please try again.');
 	
 
          
          $no = $_SESSION["edit"] ;
          $member = Event::findFirst("id = '$no'");
          $member->eventname=$email;
          $member->eventdate=$pass;
          $member->eventdetail=$firstname;
          $member->eventpicture=$photoUpdate;
          $member->save();
      
          $this->response->redirect('profile');
      
          
          }
  }
  public function delAction($num){
    session_start();
        
            
          $email = trim($this->request->getPost('eventname')); // รับค่าจาก form
          $pass = trim($this->request->getPost('eventdate')); // รับค่าจาก form
          $firstname = trim($this->request->getPost('eventdetail')); // รับค่าจาก form
          $photo = trim($this->request->getPost('photo')); // รับค่าจาก form

          
          $member = Event::findFirst("id = '$num'");
          $member->delete();
      
          $this->response->redirect('profile');
      
          
  }

}
