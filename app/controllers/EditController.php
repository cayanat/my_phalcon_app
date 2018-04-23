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
 
          
          $no = $_SESSION["edit"] ;
          $member = Event::findFirst("id = '$no'");
          $member->eventname=$email;
          $member->eventdate=$pass;
          $member->eventdetail=$firstname;
          $member->eventpicture=$photo;
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
