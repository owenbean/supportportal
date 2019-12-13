<?php
class SmartFormsController extends AppController {
	public function index()
	{
		$this->set('smartForms', $this->SmartForm->find('all'));
	}
	
	public function add($member_id)
	{
		$this->loadModel('User');
		$users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
		$this->set(compact('users'));
		
		$members = $member_id;
		$this->set(compact('members'));
		if ($this->request->is('post')) {
			$this->SmartForm->create();
			if ($this->SmartForm->save($this->request->data)) {
				$this->Session->setFlash('Smart Form successfully added', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash('Unable to add Smart Form', 'default', array('class' => 'alert alert-danger'));
		}
	}
	
	public function edit($id = null)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid Smart Form'));
		}
		
		$smartForm = $this->SmartForm->findById($id);
		if (!$smartForm) {
			throw new NotFoundException(__('Invalid Smart Form'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->SmartForm->id = $id;
			if ($this->SmartForm->save($this->request->data)) {
                $this->Session->setFlash('Smart Form successfully updated', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view', $id));
			}
            $this->Session->setFlash('Unable to update Smart Form', 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->loadModel('User');
			$users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
			$this->set(compact('users'));
		
			$this->request->data = $smartForm;
		}
	}
	
	public function view($id = null)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid smart form'));
		}
		
		$smartForm = $this->SmartForm->findById($id);
		if (!$smartForm) {
			throw new NotFoundException(__('Invalid smart form'));
		}
		$this->set('smartForm', $smartForm);
		$this->set('title_for_layout', $smartForm['SmartForm']['name']);
		$this->set('smartFormProjects', $this->SmartForm->SmartFormProject->find('all', array('conditions' => array('SmartFormProject.smart_form_id' => $id))));
	}
	
	public function delete($member_id, $id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->SmartForm->delete($id)) {
            $this->Session->setFlash('Smart Form deleted', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
		}
	}
	
	//this function is triggered when a smart form project of type=new is created
	//NOT CURRENTLY IN USE
	public function auto_add($member_id, $project_id)
	{
    	$this->loadModel('SmartFormProject');
    	$smartFormProjectData = $this->SmartFormProject->findById($project_id);
    	
    	$smartFormData = array(
        	'SmartForm' => array(
            	'member_id' => $smartFormProjectData['SmartFormProject']['member_id'],
            	'name' => 'TBD',
            	'sf_domain' => 'Unknown',
            	'status' => 'In Development',
            	'developer' => ($smartFormProjectData['SmartFormProject']['user_id'] ? $smartFormProjectData['SmartFormProject']['user_id'] : 'Unknown'),
            	'launch_date' => $smartFormProjectData['SmartFormProject']['target_date']
        	)
    	);
    	
		$this->SmartForm->create();
		if ($this->SmartForm->save($smartFormData)) {
    		$this->SmartFormProject->id = $project_id;
    		$this->SmartFormProject->save($this->SmartFormProject->set(array('smart_form_id' => $this->SmartForm->getLastInsertID())));
			$this->Session->setFlash('Smart Form successfully added. Please confirm details and update as needed.', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'view', $this->SmartForm->getLastInsertID()));
		}
		$this->Session->setFlash('Unable to add Smart Form', 'default', array('class' => 'alert alert-danger'));
    	
	}
}