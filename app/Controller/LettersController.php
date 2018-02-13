<?php
App::uses('DboSource', 'Model/DataSource');

class LettersController extends AppController {
	public $components = array('RequestHandler');
// new stuff
	public $paginate = [
        'limit' => 30,
        'order' => ['Letter.date_received' => 'asc' ]
          
        
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    } 
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('lettersDueToday');
	}


/**
 * ACTIVE LETTERS AND STAMPS
 * Creates a list of active letter and stamp requests.
 */ 
	public function active($options = null)
	{
		// checks if user is filtering by stamp or letter (type is set as options variable)
		if (!$options) {
			// finds all letters where letter is active, order by target date
			//$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active' => true), 'order' => 'Letter.target_date')));			
			// enables sortable column headers
			//$this->set('filter_added', false);
			$table =  ( isset($_GET['t']) ? $_GET['t'] : 'Letter' );
			$sort = ( isset($_GET['s']) ? $_GET['s'] : 'date_received' );
			$order = ( isset($_GET['o']) ? $_GET['o'] : 'asc' );
			
			//$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active'), 'order' => array("Letter.$sort" => "$order"))));
			$letters = $this->paginate('Letter');
			$this->set(compact('letters'));
			//$isAsc = isset($_GET['order'])? (bool) $_GET['order']: 1;
			//old version 
			//$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active'), 'order' => array("Letter.$sort" => "$order"))));
			//$this->paginate = $this->Letter->find('all', array('conditions' => array('Letter.active'), 'order' => array("Letter.$sort" => "$order")));
			//$letters = $this->paginate();
			//$this->set(compact('letters'));

			//if ($isAsc) {
			//$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active'), 'order' => array("$table.$sort" => "$order"))));
			//} else {
			//	$order = 'desc';
			//	$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active'), 'order' => array("$table.$sort" => "$order"))));
			//}
		//}
			//$this->set('letters', $this->paginate($table));
			//new stuff
		//else {
			// finds all letters where letter is active AND type matches filter, orders by target date
			//$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.type' => $options, 'Letter.active' => true), 'order' => array('Letter.target_date'))));
			// disables sortable column headers
			//$this->set('filter_added', true);
			//$this->set('filter', $options);
		//}
	} }
/**
 * LETTER AND STAMP REQUEST HISTORY
 * Displays all of the letter and stamp requests that have ever been created.
 * Includes search function.
 */ 
	public function history()
	{
    	//allows form to be submitted with no member specified
		$this->Letter->validate = null;
		$this->loadModel('Member');
		//this loads member list into dropdown menu
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'order' => 'Member.full_name'));
		$this->set(compact('members'));
		//if member_id not set at all, user hasn't searched.
		if ( isset($_GET['member_id']) )
		{
			$sort = ( isset($_GET['s']) ? $_GET['s'] : 'date_received' );
			$order = ( isset($_GET['o']) ? $_GET['o'] : 'asc' );
			//if member_id is null, user searched for all requests
			if ( $_GET['member_id'] == null )
			{
				$this->set('letters', $this->Letter->find('all', array('order' => array("Letter.$sort" => "$order"))));
			}
			else
			{
				//this sets the member for calling at top of list
				$member = $this->Member->findById($_GET['member_id']);
				$this->set('member', $member);
				
				$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.member_id' => $_GET['member_id']), 'order' => array("Letter.$sort" => "$order"))));
			}
		}
		else
		{
			$this->set('letters', null);
		}
	}
/**
 * VIEW LETTER OR STAMP REQUEST
 * Allows user to view the request based on the request's ID.
 */ 
	public function view($id = null)
	{
		// Checks if id is in get request
		if (!$id) {
			// Displays error if no result found
			throw new NotFoundException(__('Invalid letter request'));
		}
		// Finds letter in letter model by id
		$letter = $this->Letter->findById($id);
		// Checks if result found
		if (!$letter) {
			// Displays error if no result found
			throw new NotFoundException(__('Invalid letter request'));
		}
		// Passes in user id
		$this->set('user_id', CakeSession::read('Auth.User.id'));
		// Passes in letter data
		$this->set('letter', $letter);
	}
/**
 * ADD LETTER OR STAMP REQUEST
 * Allows user to view the request based on the request's ID.
 */ 
	public function add()
	{
		// loads Member data
		$this->loadModel('Member');
		// finds active Members' full names, orders by full names, and stores in variable
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'conditions' => array('Member.active' => true), 'order' => 'Member.full_name'));
		// passes in list of full names as an associative array (by Member ID)
		$this->set(compact('members'));
		// checks for form submission via POST
		if ($this->request->is('post')) {
			// resets Model data
			$this->Letter->create();
			// saves data and check if successful
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash('Letter request successfully added', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'active'));
			}
			$this->Session->setFlash('Unable to add letter request', 'default', array('class' => 'alert alert-danger'));
		}
	}
/**
 * RETRIEVE AN ADMIN LIST FOR NEW LETTERS AND STAMPS
 * Gets a list of admins at a specific institution for the "Submitted By" field
 * when creating a new letter or stamp request.
 *
 * This function uses function activateSubmittedByDropdown() in irbnet_admin.js.
 * The javascript function detects if user selects a member, then sends an AJAX
 * request to server based on the member id. This function then retrieves the
 * admins associated with that member id.
 */ 
	public function list_admin()
	{
		// checks if ajax request
		if($this->RequestHandler->isAjax()) {
			// loads admin data
			$this->loadModel('Admin');
			// retrieve member id from get request
			$member_id = $_GET['member_id'];
			// passes in the member id
			$this->set('member_id', $member_id);
			// get a list of active admins at that member
			$submitters = $this->Admin->find('all', array('conditions' => array('Admin.member_id' => $member_id, 'Admin.active' => true)));
			// pass in the list as submitter names
			$this->set('submitter_names', $submitters);
		} else {
			$this->redirect(array('action' => 'add'));
		}
	}
/**
 * EDIT LETTER OR STAMP REQUEST
 * Allows user to edit the request based on the request's id. 
 */ 
	public function edit($id = null)
	{
		// if no id in get request, shows error
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		// looks up letter by id
		$letter = $this->Letter->findById($id);
		// if no result found, shows error
		if (!$letter) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		// if form submission via post or put, saves form data
		if ($this->request->is(array('post', 'put'))) {
			// looks up letter in Model by id
			$this->Letter->id = $id;
			// saves form data at db row with that id
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash('Letter request successfully updated', 'default', array('class' => 'alert alert-success'));
				// returns user to view page
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash('Unable to update letter request', 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $letter;
			$this->set('letter', $letter);
		}
	}
/**
 * CLAIM LETTER OR STAMP REQUEST
 * Marks letter or stamp request as claimed based on request's id.
 */ 
	public function claim($id)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		// get user id from the session info
		$user_id = CakeSession::read('Auth.User.id');
		// look up db row by the claim id
		$this->Letter->id = $id;
		// save the user id and the claimed date to the db row
		if ($this->Letter->save($this->Letter->set(array('request_owner' => $user_id, 'claimed_date' => DboSource::expression('NOW()'))))) {
			$this->Session->setFlash('Letter request claimed', 'default', array('class' => 'alert alert-success'));
			// take user to active requests queue
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash('Unable to claim letter request', 'default', array('class' => 'alert alert-danger'));
	}
/**
 * UNCLAIM LETTER OR STAMP REQUEST
 * Marks letter or stamp request as claimed based on request's id.
 */ 
	public function unclaim($id)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		$user_id = CakeSession::read('Auth.User.id');
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('request_owner' => null, 'claimed_date' => null)))) {
			$this->Session->setFlash('Letter request unclaimed', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'view', $id));
		}
		$this->Session->setFlash('Unable to unclaim letter request', 'default', array('class' => 'alert alert-danger'));
	}
/**
 * MARK LETTER OR STAMP REQUEST COMPLETE
 * Marks letter or stamp request as complete based on request's id.
 */ 
	public function complete($id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('active' => 0, 'completed_date' => DboSource::expression('NOW()'))))) {
			$this->lettersCompleteEmail($id);
			$this->Session->setFlash('Letter request completed', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash('Unable to complete letter request', 'default', array('class' => 'alert alert-danger'));
	}
	
	public function delete($id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Letter->delete($id)) {
			$this->Session->setFlash('Letter request successfully deleted', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
	}
/**
 * LETTER OR STAMP REQUEST COMPLETED EMAIL
 * Marks letter or stamp request as claimed based on request's id.
 */ 
	public function lettersCompleteEmail($letter_id)
	{
		App::uses('CakeEmail', 'Network/Email');
        $letter = $this->Letter->find('first', array('conditions' => array('Letter.id' => $letter_id)));

		//load Users and find Support Desk account, for email purposes
		$this->loadModel('User');
        $support = $this->User->find('first', array('conditions' => array('User.username' => 'support')));
        
        if ($letter === false) {
            debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");
            return false;
        }
		
        $user_name = $letter['User']['first_name'];
        $support_email_address = $support['User']['email_address'];
		$member_name = $letter['Member']['full_name'];
		$member_short_name = $letter['Member']['short_name'];
		$date_received = $letter['Letter']['date_received'];
		$target_date = $letter['Letter']['target_date'];
		$type = $letter['Letter']['type'];

		$Email = new CakeEmail('gmail');
		$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
		$Email->to($support_email_address);
		$Email->subject($type . ' Request Completed - ' . $member_short_name);
		$Email->template('letters_complete');
		$Email->emailFormat('html');
		$Email->viewVars(array('user_name' => $user_name, 'member_name' => $member_name, 'date_received' => $date_received, 'target_date' => $target_date, 'type' => $type));
		$Email->send();
	}

	//this function runs every day via a Cron Job and send an email for each active letter request due that day
	public function lettersDueToday()
	{
		App::uses('CakeEmail', 'Network/Email');
		
		$letters = $this->Letter->find('all', array('conditions' => array('Letter.target_date' => date('Y-m-d'), 'Letter.active' => true)));
		
		//load Users and find Support Desk account, for email purposes
		$this->loadModel('User');
        $support = $this->User->find('first', array('conditions' => array('User.username' => 'support')));
		
		$this->set('letters', $letters);

		if($this->request->is('post')) {
			foreach($letters as $letter):
		        $user_name = $letter['User']['first_name'];
        		$support_email_address = $support['User']['email_address'];
		    	$user_email = $letter['User']['email_address'];
				$member_name = $letter['Member']['full_name'];
				$member_short_name = $letter['Member']['short_name'];
				$date_received = $letter['Letter']['date_received'];
				$target_date = $letter['Letter']['target_date'];

				if($user_name) {
					$Email = new CakeEmail('gmail');
					$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
					$Email->to($user_email);
					$Email->cc($support_email_address);
					$Email->subject('Letter Request Due - ' . $member_short_name);
					$Email->template('claimed_letters_due');
					$Email->emailFormat('html');
					$Email->viewVars(array('user_name' => $user_name, 'member_name' => $member_name, 'date_received' => $date_received, 'target_date' => $target_date));
					$Email->send();
				} else {
					$Email = new CakeEmail('gmail');
					$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
					$Email->to($support_email_address);
					$Email->subject('Unclaimed Letter Request Due - ' . $member_short_name);
					$Email->template('unclaimed_letters_due');
					$Email->emailFormat('html');
					$Email->viewVars(array('user_name' => 'Support', 'member_name' => $member_name, 'date_received' => $date_received, 'target_date' => $target_date));
					$Email->send();				
				}
			endforeach;
			unset($letter);
		}
	}
	public function all()
	{
		$this->loadModel('Member');

		$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.type' => 'Stamp'), 'group' => 'Letter.member_id', 'order' => 'Member.full_name')));
	}
}