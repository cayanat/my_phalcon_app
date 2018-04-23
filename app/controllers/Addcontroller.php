<?php
use Phalcon\Mvc\View;
class AddController extends ControllerBase{
 
 public function indexAction(){
  if($this->request->isPost()){
    
    $email = trim($this->request->getPost('eventname')); // รับค่าจาก form
    $pass = trim($this->request->getPost('eventdate')); // รับค่าจาก form
    $firstname = trim($this->request->getPost('eventdetail')); // รับค่าจาก form
    $photo = trim($this->request->getPost('photo')); // รับค่าจาก form

    $member=new Event();
    $member->eventname=$email;
    $member->eventdate=$pass;
    $member->eventdetail=$firstname;
    $member->eventpicture=$photo;
    $member->save();

    $this->response->redirect('profile');

    
    }
  
}

}