<?php
class SmartFormProjectsController extends AppController {
    public $components = array('RequestHandler');
    
    public function index()
    {
        $this->set('smartFormProjects', $this->SmartFormProject->find('all'));
    }
    
    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid Smart Form Project'));
        }
        
        $smartFormProject = $this->SmartFormProject->findById($id);
        if (!$smartFormProject) {
            throw new NotFoundException(__('Invalid Smart Form Project'));
        }
        $this->set('smartFormProject', $smartFormProject);
    }
    
    public function add($member_id = null)
    {
        $this->loadModel('User');
        $users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
        $this->set(compact('users'));
        
        if ($member_id) {
            $members = $member_id;
            $this->set(compact('members'));            
        } else {
            $this->loadModel('Member');
            $members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'conditions' => array('Member.active' => true), 'order' => 'Member.full_name'));
            $this->set(compact('members'));            
        }
        
        if ($this->request->is('post')) {
            $this->SmartFormProject->create();
            if ($this->SmartFormProject->save($this->request->data)) {
                $this->Session->setFlash('Smart Form Project successfully added', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
            }
            $this->Session->setFlash('Unable to add Smart Form Project', 'default', array('class' => 'alert alert-danger'));
        }
    }
    
    public function edit($member_id, $id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid Smart Form Project'));
        }
        
        $smartFormProject = $this->SmartFormProject->findById($id);
        if (!$smartFormProject) {
            throw new NotFoundException(__('Invalid Smart Form Project'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $this->SmartFormProject->id = $id;
            if ($this->SmartFormProject->save($this->request->data)) {
                $this->Session->setFlash('Smart Form Project successfully updated', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
            }
            $this->Session->setFlash('Unable to update Smart Form Project', 'default', array('class' => 'alert alert-danger'));
        }
        
        if (!$this->request->data) {
            $this->loadModel('User');
            $users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
            $this->set(compact('users'));
    
            $this->request->data = $smartFormProject;
        }
    }

    public function list_admin() {
        if($this->RequestHandler->isAjax()) {
            $this->loadModel('Admin');
            $member_id = $_GET['member_id'];
            $this->set('member_id', $member_id);
            $submitters = $this->Admin->find('all', array('conditions' => array('Admin.member_id' => $member_id, 'Admin.active' => true)));
            $this->set('submitter_names', $submitters);
        } else {
            $this->redirect(array('action' => 'add'));
        }
    }
    
}
