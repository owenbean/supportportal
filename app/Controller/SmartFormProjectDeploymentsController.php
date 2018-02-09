<?php
App::uses('DboSource', 'Model/DataSource');

class SmartFormProjectDeploymentsController extends AppController {
    public $components = array('RequestHandler');

/**
 * VIEW PROJECT
 * Allows user to view the project based on the project's ID.
 */ 
    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid Smart Form Project Deployment'));
        }
        
        $smartFormProjectDeployment = $this->SmartFormProjectDeployment->findById($id);
        if (!$smartFormProjectDeployment) {
            throw new NotFoundException(__('Invalid Smart Form Project Deployment'));
        }

		$this->set('user_id', CakeSession::read('Auth.User.id'));
        $this->set('smartFormProject', $smartFormProject);
    }
/**
 * ADD PROJECT
 * Produces a "New Smart Form Request" form that allows user to add a new
 * smart form project.
 */ 
    public function add($smartFormProject_id = null)
    {
		// If smart form project ID provided in URL, pass it in
		$smartformprojects = $smartFormProject_id;
		$this->set(compact('smartformprojects'));
		// When the form is submitted via POST, then send form info to db.
        if ($this->request->is('post')) {
            $this->SmartFormProjectDeployment->create();
            if ($this->SmartFormProjectDeployment->save($this->request->data)) {
                $this->Session->setFlash('Smart Form Project Deployment successfully added', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'smartFormProjects', 'action' => 'view', $smartFormProject_id));
            }
            $this->Session->setFlash('Unable to add Smart Form Project Deployment', 'default', array('class' => 'alert alert-danger'));
        }
    }
/**
 * EDIT PROJECT
 * Produces a "New Smart Form Request" form that allows user to add a new
 * smart form project. This form functions in similar fashion to "add,"
 * except that the view restricts edits on Request Type, Member Name, SF,
 * and Submitted By.
 */ 
    public function edit($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid Smart Form Project Deployment'));
        }
        
        $smartFormProjectDeployment = $this->SmartFormProjectDeployment->findById($id);
        if (!$smartFormProjectDeployment) {
            throw new NotFoundException(__('Invalid Smart Form Project Deployment'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $this->SmartFormProjectDeployment->id = $id;
            if ($this->SmartFormProjectDeployment->save($this->request->data)) {
                $this->Session->setFlash('Smart Form Project Deployment successfully updated', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'view'));
            }
            $this->Session->setFlash('Unable to update Smart Form Project Deployment', 'default', array('class' => 'alert alert-danger'));
        }
    }
/**
 * DELETE SMART FORM PROJECT DEPLOYMENT
 * Allows user to delete a deployment.
 */ 
	public function delete($id)
	{
		// Only works if request is submitted via POST
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		// Get the Smart Form Project ID so that we can redirect to it later
		$smartFormProjectDeployment = $this->SmartFormProjectDeployment->findById($id);
		$smart_form_project_id = $smartFormProjectDeployment['SmartFormProjectDeployment']['smart_form_project_id'];
		
		// Delete the deployment
		if ($this->SmartFormProjectDeployment->delete($id)) {
			$this->Session->setFlash('Project Deployment successfully deleted', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('controller' => 'smartFormProjects', 'action' => 'view', $smart_form_project_id));
		}
	}
	
/**
 * COMPLETE A SMART FORM PROJECT DEPLOYMENT
 * Allows user to mark the Smart Form Project as being deployed to Training.
 */ 
	public function complete($id)
	{
		// Must be submitted via POST
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		// Retrieve Smart Form id from argument
		$this->SmartFormProjectDeployment->id = $id;
		// Retrieve timestamp, save to DB along with user id of user.
		if ($this->SmartFormProjectDeployment->save($this->SmartFormProjectDeployment->set(array('active' => 0, 'completed_date' => DboSource::expression('NOW()'))))) {		
			// Show success message
			$this->Session->setFlash('Project logged as deployed.', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
		// Didn't work, show error message.
		$this->Session->setFlash('Unable to log as deployed.', 'default', array('class' => 'alert alert-danger'));
	}
}
