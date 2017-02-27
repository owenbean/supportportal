<?php
App::uses('DboSource', 'Model/DataSource');

class SmartFormProjectsController extends AppController {
    public $components = array('RequestHandler');

/**
 * ACTIVE PROJECTS
 * Creates a list of active smart form projects, used in Wizards tracking.
 */ 
    public function active()
    {
        $this->log('logging data from active controller: ' . print_r($this->request->data, 1));
        $this->set('smartFormProjects', $this->SmartFormProject->find('all', array('conditions' => array('SmartFormProject.active' => true))));
    }
/**
 * VIEW PROJECT
 * Allows user to view the project based on the project's ID.
 */ 
    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid Smart Form Project'));
        }
        
        $smartFormProject = $this->SmartFormProject->findById($id);
        if (!$smartFormProject) {
            throw new NotFoundException(__('Invalid Smart Form Project'));
        }

		$this->set('user_id', CakeSession::read('Auth.User.id'));
        $this->set('smartFormProject', $smartFormProject);
    }
/**
 * ADD PROJECT
 * Produces a "New Smart Form Request" form that allows user to add a new
 * smart form project.
 */ 
    public function add($member_id = null)
    {
		// Open the user model
        $this->loadModel('User');
		// Get users who are admins and site admins (i.e. not contractors) to populate "Request Owner" dropdown
        $users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'), 'User.active' => true)));
        $this->set(compact('users'));
        // Populate the FULL list of members
        if ($member_id) {
            $members = $member_id;
            $this->set(compact('members'));            
        } else {
            $this->loadModel('Member');
            $members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'conditions' => array('Member.active' => true), 'order' => 'Member.full_name'));
            $this->set(compact('members'));            
        }
		// When the form is submitted via POST, then send form info to db.
        if ($this->request->is('post')) {
            $this->SmartFormProject->create();
            if ($this->SmartFormProject->save($this->request->data)) {
                $this->Session->setFlash('Smart Form Project successfully added', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'active'));
            }
            $this->Session->setFlash('Unable to add Smart Form Project', 'default', array('class' => 'alert alert-danger'));
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
                return $this->redirect(array('action' => 'active'));
            }
            $this->Session->setFlash('Unable to update Smart Form Project', 'default', array('class' => 'alert alert-danger'));
        }
        
        if (!$this->request->data) {
            $this->loadModel('User');
            $users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
            $this->set(compact('users'));
    
            $this->request->data = $smartFormProject;
            $this->set('smartFormProject', $smartFormProject);
        }
    }
/**
 * AJAX JSCRIPT DATA RETRIEVAL
 * The "Add New Smart Form Project" page uses a javascript function to 
 * validate data without submitting to the database. To do this, it uses 
 * irbnet_admin.js "submittedByAndSmartFormsDropdowns()" That js function 
 * uses the data that is being called here.
 */ 
    public function list_admin_and_forms()
    {
        if ($this->RequestHandler->isAjax()) {
            $this->loadModel('Admin');
            $this->loadModel('SmartForm');
            
            $member_id = $_GET['member_id'];
            $this->set('member_id', $member_id);
            
            $request_type = $_GET['request_type'];
            $this->set('request_type', $request_type);

            $submitters = $this->Admin->find('all', array('conditions' => array('Admin.member_id' => $member_id, 'Admin.active' => true)));
            $this->set('submitter_names', $submitters);

            $smart_forms = $this->SmartForm->find('all', array('conditions' => array('SmartForm.member_id' => $member_id)));
            $this->set('smart_forms', $smart_forms);
        } else {
            $this->redirect(array('action' => 'add'));
        }
    }
/**
 * DELETE SMART FORM PROJECT
 * Allows user to delete a smart form project.
 */ 
	public function delete($id)
	{
		// Only works if request is submitted via POST
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		// Check to see if it worked.
		if ($this->SmartFormProject->delete($id)) {
			$this->Session->setFlash('Project successfully deleted', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
	}
/**
 * SMART FORM PROJECT HISTORY
 * Displays all of the smart form projects that have ever been created.
 * Includes search function.
 */ 
	public function history()
	{
    	//allows form to be submitted with no member or user specified
		$this->SmartFormProject->validate = null;

		$this->loadModel('Member');
		$this->loadModel('User');

		//this loads member and user lists into dropdown menu
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'order' => 'Member.full_name'));
		$this->set(compact('members'));
		
		$users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name'));
		$this->set(compact('users'));
		
		//if member_id not set at all, user hasn't searched.
		if ( (isset($_GET['member_id'])) && (isset($_GET['user_id'])) ) 
        {
            $sort = ( isset($_GET['s']) ? $_GET['s'] : 'date_received' );
            //if member_id is null and user_id is null, user searched for all requests by all users.
			if ( $_GET['member_id'] == null && $_GET['user_id'] == null )
			{
				$this->set('smartFormProjects', $this->SmartFormProject->find('all', array('order' => array("SmartFormProject.$sort" => 'asc'))));
			}
			//if member_id is not null and user_id is null, user searched for requests for a member by all users.
			elseif ( $_GET['member_id'] != null && $_GET['user_id'] == null )
			{
				$member = $this->Member->findById($_GET['member_id']);
				$this->set('member', $member);
				$this->set('smartFormProjects', $this->SmartFormProject->find('all', array('conditions' => array('SmartFormProject.member_id' => $_GET['member_id']), 'order' => array("SmartFormProject.$sort" => 'asc'))));
			}
			//if member_id is not null and user_id is not null, user searched for request for a member by a specific user.
			elseif ( $_GET['member_id'] != null && $_GET['user_id'] != null )
			{
				$member = $this->Member->findById($_GET['member_id']);
				$user = $this->User->findById($_GET['user_id']);
				$this->set('user', $user);
				$this->set('member', $member);
				$this->set('smartFormProjects', $this->SmartFormProject->find('all', array('conditions' => array('SmartFormProject.member_id' => $_GET['member_id'], 'SmartFormProject.user_id' => $_GET['user_id']), 'order' => array("SmartFormProject.$sort" => 'asc'))));
			}
			//if member_id is null and user_id is not null, user searched for all member request by a specific user.
			else
			{
				$user = $this->User->findById($_GET['user_id']);
				$this->set('user', $user);
				$this->set('smartFormProjects', $this->SmartFormProject->find('all', array('conditions' => array('SmartFormProject.user_id' => $_GET['user_id']), 'order' => array("SmartFormProject.$sort" => 'asc'))));
			}
		}
        else
        {
			$this->set('smartFormProjects', null);
		} 
	}
	

/**
 * CLAIM A SMART FORM PROJECT
 * Allows user to associate Smart Form Project with his/her user id.
 */ 
	public function claim($id)
	{
		// Smart form ID was not valid.
		if (!$id) {
			throw new NotFoundException(__('Invalid smart form project'));
		}
		// Get user info from session and smart form ID from function argument
		$user_id = CakeSession::read('Auth.User.id');
		$this->SmartFormProject->id = $id;
		// Retrieve timestamp, save to DB along with user id of user.
		if ($this->SmartFormProject->save($this->SmartFormProject->set(array('user_id' => $user_id, 'claimed_date' => DboSource::expression('NOW()'))))) {
			// Show success message
			$this->Session->setFlash('Smart Form project claimed', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
		// Didn't work, show error message.
		$this->Session->setFlash('Unable to claim project', 'default', array('class' => 'alert alert-danger'));
	}
/**
 * UNCLAIM A SMART FORM PROJECT
 * Allows user to disassociate Smart Form Project with his/her user id.
 */ 
	public function unclaim($id)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid smart form project'));
		}
		
		$user_id = CakeSession::read('Auth.User.id');
		$this->SmartFormProject->id = $id;
		if ($this->SmartFormProject->save($this->SmartFormProject->set(array('user_id' => null, 'claimed_date' => null)))) {
			$this->Session->setFlash('Smart Form project unclaimed', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'view', $id));
		}
		$this->Session->setFlash('Unable to unclaim smart form project', 'default', array('class' => 'alert alert-danger'));
	}
/**
 * COMPLETE A SMART FORM PROJECT
 * Allows user to mark the Smart Form Project as complete.
 */ 
	public function complete($id)
	{
		// Must be submitted via POST
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		// Retrieve Smart Form id from argument
		$this->SmartFormProject->id = $id;
		// Retrieve timestamp, save to DB along with user id of user.
		if ($this->SmartFormProject->save($this->SmartFormProject->set(array('active' => 0, 'completed_date' => DboSource::expression('NOW()'))))) {
			
			// 2016019 OB: Leftover from when Zack converted this from Letters requests. Leaving in place in case we want to send a completion email.
			// $this->lettersCompleteEmail($id);
			
			// Show success message
			$this->Session->setFlash('Smart Form project completed', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
		// Didn't work, show error message.
		$this->Session->setFlash('Unable to complete smart form project', 'default', array('class' => 'alert alert-danger'));
	}
/**
 * PROJECT SCOPE TEMPLATE
 * Allows user to create a project scope template based on the information entered
 * for that request.
 */ 
    public function scope($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid Smart Form Project'));
        }
        
        $smartFormProject = $this->SmartFormProject->findById($id);
        if (!$smartFormProject) {
            throw new NotFoundException(__('Invalid Smart Form Project'));
        }

		// Get current year from the smartFormProject's date received field, then previous year
		$currentYear = date('Y', strtotime($smartFormProject['SmartFormProject']['date_received']));
		$previousYear = ($currentYear - 1);
		
		$this->set('thisUser_first_name', CakeSession::read('Auth.User.first_name'));
        $this->set('smartFormProject', $smartFormProject);
        $this->set('currentYear', $currentYear);
		$this->set('previousYear', $previousYear);
		
		// Pass in the number of projects that were requested by member in the current year BEFORE this project
		// 'Current year' is defined as the year in which this request was received
		$this->set('currentYearProjects', $this->SmartFormProject->find('all', array(
			'conditions' => array(
				array('SmartFormProject.member_id' => $smartFormProject['SmartFormProject']['member_id']),
				array("NOT" => array('SmartFormProject.id' => $id)),
				array('SmartFormProject.date_received >=' => "$currentYear-01-01", 'SmartFormProject.date_received <=' => $smartFormProject['SmartFormProject']['date_received'])
			),
			'order' => array('date_received' => 'asc')
		)));
		// Pass in number of projects that were requested in previous year by member
		$this->set('previousYearProjects', $this->SmartFormProject->find('all', array(
			'conditions' => array(
				array('SmartFormProject.member_id' => $smartFormProject['SmartFormProject']['member_id']),
				array('SmartFormProject.date_received >=' => "$previousYear-01-01", 'SmartFormProject.date_received <=' => "$previousYear-12-31")
			),
			'order' => array('date_received' => 'asc')
		)));
    }
}
