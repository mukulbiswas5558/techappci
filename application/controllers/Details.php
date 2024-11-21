<?php
class Details extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library(array('session'));

		$this->load->model("details_model");
	}

	function index()
	{

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$this->session->userdata['logged_in']['acct_type'];


				$this->load->view("header_view");
				$this->load->view("admin_view");
				$this->load->view("footer_view");
				//$this->load->view("admintasklist_temp_view", $data);
			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}


	}
	function profile()
	{

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$this->session->userdata['logged_in']['acct_type'];


				$this->load->view("header_view");
				$this->load->view("profile_view");
				$this->load->view("footer_view");
				//$this->load->view("admintasklist_temp_view", $data);
			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}


	}
	public function logout()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$this->session->userdata['logged_in']['acct_type'];
				// Removing session data
				$sess_array = array(
					'id' => '',
					'name' => '',
					'username' => '',
					'acct_type' => '',
					'asso_type' => '',
					'currency' => '',
					'status' => ''
				);
				$this->session->unset_userdata('logged_in', $sess_array);

				$sess_array2 = array(
					'member' => '',
					'priority' => '',
					'status' => '',
					'task' => ''
				);
				$this->session->unset_userdata('filtered_value', $sess_array2);
				$data = array('success_message' => 'Successfully Log Out');
				redirect('login');
			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}

	}
	public function dompdf()
	{
		// Load the Pdf library
		$this->load->library('Pdf');

		// Create HTML content
		$html = '<h1>PDF Title</h1>';
		$html .= '<p>This is a sample PDF generated using Dompdf in CodeIgniter 3 and saved to the assets folder.</p>';

		// Ensure 'assets/pdf' directory exists (Create it if not)
		if (!is_dir(FCPATH . 'assets/pdf')) {
			mkdir(FCPATH . 'assets/pdf', 0777, true);  // Create the directory with appropriate permissions
		}

		// Generate and save the PDF
		$this->pdf->createPDF($html, 'sample_pdf', false);  // 'false' means no stream, just save

		echo "PDF generated and saved to assets/pdf/sample_pdf.pdf";
	}

	function doctorList()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$this->session->userdata['logged_in']['acct_type'];

				$this->load->view("template_view");

				$this->load->view("doctorList_view");

			} else if ($this->session->userdata['logged_in']['acct_type'] == "patient") {
				$this->session->userdata['logged_in']['acct_type'];

				$this->load->view("template_view");

				$this->load->view("PatientToDoctorList_view");

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function patientList()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$this->session->userdata['logged_in']['acct_type'];

				$this->load->view("template_view");

				$this->load->view("patientList_view");

			} else if ($this->session->userdata['logged_in']['acct_type'] == "patient") {
				$this->session->userdata['logged_in']['acct_type'];

				$this->load->view("template_view");

				$this->load->view("PatientToDoctorList_view");

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}

	function doctorLists()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$this->session->userdata['logged_in']['acct_type'];

				$data['doctor'] = $this->details_model->getDoctorList();
				echo json_encode($data['doctor']);

			} else if ($this->session->userdata['logged_in']['acct_type'] == "patient") {
				$this->session->userdata['logged_in']['acct_type'];

				$data['doctor'] = $this->details_model->getDoctorList();
				echo json_encode($data['doctor']);

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function addPatient()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {

				$date = date("Y-m-d");

				$insertdata = array(
					'Title' => $this->input->post('Title'),
					'Name' => $this->input->post('Name'),
					'Account_For' => 'patient',
					'UserName' => $this->input->post('UserName'),
					'State' => $this->input->post('State'),
					'Phone1' => $this->input->post('Phone1'),
					'Location' => $this->input->post('Location'),
					'password' => $this->input->post('password'),
					'Status' => 1,

					'last_login' => $date
				);


				// $insert_id = $this->adminnewtask_model->task_insert($insertdata);

				$data = $this->details_model->addtDoctorList($insertdata);
				echo json_encode($data);

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}
	}
	function addDoctor()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {

				$date = date("Y-m-d");

				$insertdata = array(
					'Title' => $this->input->post('Title'),
					'Name' => $this->input->post('Name'),
					'Account_For' => 'doctor',
					'UserName' => $this->input->post('UserName'),
					'State' => $this->input->post('State'),
					'Phone1' => $this->input->post('Phone1'),
					'docFees' => $this->input->post('docFees'),
					'password' => $this->input->post('password'),
					'spec' => $this->input->post('spec'),
					'Status' => 1,

					'last_login' => $date
				);


				// $insert_id = $this->adminnewtask_model->task_insert($insertdata);

				$data = $this->details_model->addtDoctorList($insertdata);
				echo json_encode($data);



			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}

	}
	function blockDoc()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {

				$date = date("Y-m-d");

				$updatedata = array(
					'id' => $this->input->post('id'),
					'Status' => 2,
					'last_login' => $date
				);

				$data = $this->details_model->blockDoctor($updatedata);
				echo json_encode($data);

			} else {
				header("location: login");
			}

		} else {
			header("location: login");
		}


	}
	function cancelAppointment()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {

				$date = date("Y-m-d");

				$updatedata = array(
					'id' => $this->input->post('id'),
					'Status' => 2,
					'last_login' => $date
				);

				$data = $this->details_model->cancelAppoint($updatedata);
				echo json_encode($data);

			} else {
				header("location: login");
			}

		} else {
			header("location: login");
		}


	}
	function updatePatient()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {

				$date = date("Y-m-d");

				$updatetdata = array(
					'id' => $this->input->post('docid'),
					'Name' => $this->input->post('docName'),
					'Title' => $this->input->post('docTitle'),
					'Account_For' => 'patient',
					'UserName' => $this->input->post('docUserName'),
					'State' => $this->input->post('docState'),
					'Phone1' => $this->input->post('docPhone1'),
					'Location' => $this->input->post('docLocation'),
					'Notes' => $this->input->post('docNotes'),
					'password' => $this->input->post('docpassword'),
					'Status' => 1,
					'last_login' => $date
				);


				// $insert_id = $this->adminnewtask_model->task_insert($insertdata);

				$data = $this->details_model->updateDoctor($updatetdata);
				echo json_encode($data);



			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function updateDoctor()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {

				$date = date("Y-m-d");

				$updatetdata = array(
					'id' => $this->input->post('docid'),
					'Name' => $this->input->post('docName'),
					'Title' => $this->input->post('docTitle'),
					'Account_For' => 'doctor',
					'UserName' => $this->input->post('docUserName'),
					'State' => $this->input->post('docState'),
					'Phone1' => $this->input->post('docPhone1'),
					'Location' => $this->input->post('docLocation'),
					'Notes' => $this->input->post('docNotes'),
					'password' => $this->input->post('docpassword'),
					'Status' => 1,
					'last_login' => $date
				);


				// $insert_id = $this->adminnewtask_model->task_insert($insertdata);

				$data = $this->details_model->updateDoctor($updatetdata);
				echo json_encode($data);

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function prescribeToPatient()
	{

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "doctor") {
				$this->session->userdata['logged_in']['acct_type'];

				$date = date("Y-m-d");

				$prescribedata = array(
					'bookingId' => $this->input->post('bookId'),
					'prescription' => $this->input->post('prescribe'),
					'Status' => 2,
					'prescribedDate' => $date
				);


				$data['prescribedata'] = $this->details_model->doPrescribe($prescribedata);
				echo json_encode($data['prescribedata']);

			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}

	}
	function bookDoctor()
	{

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "patient") {
				$this->session->userdata['logged_in']['acct_type'];
				$date = date("Y-m-d");
				$bookingdata = array(
					'docId' => $this->input->post('docid'),
					'patientId' => $this->session->userdata['logged_in']['id'],
					'symptoms' => $this->input->post('symptoms'),
					'Status' => 1,
					'bookingDate' => $this->input->post('bookingDate'),
					'appointmentTime' => $this->input->post('appointmentTime')
				);


				$data['bookingdata'] = $this->details_model->bookDoctor($bookingdata);
				echo json_encode($data['bookingdata']);

			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}


	}

	function patientLists()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {


				$data['patient'] = $this->details_model->getPatientList();
				echo json_encode($data['patient']);

			} else if ($this->session->userdata['logged_in']['acct_type'] == "doctor") {
				$doctorId = $this->session->userdata['logged_in']['id'];
				$bookingPatient = [];

				$bookingPatientDetails = $this->details_model->getPatientListBydoctor($doctorId);
				foreach ($bookingPatientDetails as $key => $patient) {

					$bookingId = $patient->bookingId;
					$patientId = $patient->patientId;
					$symptoms = $patient->symptoms;
					$bookingDate = $patient->bookingDate;
					$appointmentTime = $patient->appointmentTime;


					$patientDetailsBydoctor = $this->details_model->patientListBydoctor($patientId);


					if ($patientDetailsBydoctor != false) {
						$data['bookingid'] = $bookingId;
						$data['symptoms'] = $symptoms;
						$data['Name'] = $patientDetailsBydoctor[0]->Name;
						$data['UserName'] = $patientDetailsBydoctor[0]->UserName;
						$data['Phone1'] = $patientDetailsBydoctor[0]->Phone1;
						$data['bookingDate'] = $bookingDate;
						$data['appointmentTime'] = $appointmentTime;

						$data['State'] = $patientDetailsBydoctor[0]->State;
					}

					$bookingPatient[] = $data;
				}

				$data['patient'] = $bookingPatient;
				// print_r($data['patient']);
				// exit;
				echo json_encode($data['patient']);

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}

	}
	function bookingByPatient()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "patient") {
				$this->session->userdata['logged_in']['acct_type'];

				$this->load->view("template_view");

				$this->load->view("bookingPatientToDoctorList_view");

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function patientHistory()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "patient") {
				$this->session->userdata['logged_in']['acct_type'];

				$this->load->view("template_view");

				$this->load->view("prescribePatientToDoctorList_view");

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function appointmentList()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$this->session->userdata['logged_in']['acct_type'];

				$this->load->view("template_view");

				$this->load->view("bookingListByAdmin");

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function doctorHistory()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "doctor") {
				$this->session->userdata['logged_in']['acct_type'];

				$this->load->view("template_view");

				$this->load->view("prescribedoctorToPatientList_view");

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function prescribePatientLists()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "doctor") {
				$doctorId = $this->session->userdata['logged_in']['id'];
				$bookingPatient = [];

				$bookingPatientDetails = $this->details_model->getPrescribePatientListBydoctor($doctorId);
				foreach ($bookingPatientDetails as $key => $patient) {

					$bookingId = $patient->bookingId;
					$patientId = $patient->patientId;
					$symptoms = $patient->symptoms;
					$bookingDate = $patient->bookingDate;
					$appointmentTime = $patient->appointmentTime;

					$prescribedDate = $patient->prescribedDate;

					$prescription = $patient->prescription;


					$patientDetailsBydoctor = $this->details_model->patientListBydoctor($patientId);




					if ($patientDetailsBydoctor != false) {
						$data['bookingid'] = $bookingId;
						$data['symptoms'] = $symptoms;
						$data['Name'] = $patientDetailsBydoctor[0]->Name;
						$data['UserName'] = $patientDetailsBydoctor[0]->UserName;
						$data['Phone1'] = $patientDetailsBydoctor[0]->Phone1;
						$data['bookingDate'] = $bookingDate;
						$data['appointmentTime'] = $appointmentTime;

						$data['prescribedDate'] = $prescribedDate;

						$data['prescription'] = $prescription;
						$data['State'] = $patientDetailsBydoctor[0]->State;
					}

					$bookingPatient[] = $data;
				}

				$data['patient'] = $bookingPatient;
				// print_r($data['patient']);
				// exit;
				echo json_encode($data['patient']);

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}

	}
	function prescribeByPatientList()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "patient") {
				$patientId = $this->session->userdata['logged_in']['id'];
				$bookingDoctor = [];

				$bookingDoctorDetails = $this->details_model->getPrescribeDoctorListByPatient($patientId);
				// print_r($bookingDoctorDetails);
				// echo $patientId;
				// exit;
				foreach ($bookingDoctorDetails as $key => $doctor) {

					$bookingId = $doctor->bookingId;
					$docId = $doctor->docId;
					$symptoms = $doctor->symptoms;
					$bookingDate = $doctor->bookingDate;
					$appointmentTime = $doctor->appointmentTime;

					$prescription = $doctor->prescription;

					$doctorDetailsBypatient = $this->details_model->doctorDetailsBypatient($docId);

					if ($doctorDetailsBypatient != false) {
						$data['bookingid'] = $bookingId;
						$data['symptoms'] = $symptoms;
						$data['bookingDate'] = $bookingDate;
						$data['appointmentTime'] = $appointmentTime;

						$data['prescription'] = $prescription;
						$data['Name'] = $doctorDetailsBypatient[0]->Name;
						$data['docFees'] = $doctorDetailsBypatient[0]->docFees;
						$data['State'] = $doctorDetailsBypatient[0]->State;
					}

					$bookingDoctor[] = $data;
				}
				$data['doctor'] = $bookingDoctor;

				echo json_encode($data['doctor']);

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function bookingByPatientList()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "patient") {
				$patientId = $this->session->userdata['logged_in']['id'];
				$bookingDoctor = [];

				$bookingDoctorDetails = $this->details_model->getDoctorListByPatient($patientId);
				// print_r($bookingDoctorDetails);
				// echo $patientId;
				// exit;
				foreach ($bookingDoctorDetails as $key => $doctor) {

					$bookingId = $doctor->bookingId;
					$docId = $doctor->docId;
					$symptoms = $doctor->symptoms;
					$bookingDate = $doctor->bookingDate;
					$appointmentTime = $doctor->appointmentTime;

					$doctorDetailsBypatient = $this->details_model->doctorDetailsBypatient($docId);

					if ($doctorDetailsBypatient != false) {
						$data['bookingid'] = $bookingId;
						$data['symptoms'] = $symptoms;
						$data['bookingDate'] = $bookingDate;
						$data['appointmentTime'] = $appointmentTime;
						$data['Name'] = $doctorDetailsBypatient[0]->Name;
						$data['docFees'] = $doctorDetailsBypatient[0]->docFees;
						$data['Phone1'] = $doctorDetailsBypatient[0]->Phone1;
						$data['State'] = $doctorDetailsBypatient[0]->State;
					}

					$bookingDoctor[] = $data;
				}
				$data['doctor'] = $bookingDoctor;

				echo json_encode($data['doctor']);

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function appointmentListByAdmin()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$appointment = [];

				$bookingDoctorDetails = $this->details_model->getAllAppointment();
				//  print_r($bookingDoctorDetails);
				//  exit;
				foreach ($bookingDoctorDetails as $key => $doctor) {

					$bookingId = $doctor->bookingId;
					$docId = $doctor->docId;
					$patientId = $doctor->patientId;

					$symptoms = $doctor->symptoms;
					$bookingDate = $doctor->bookingDate;
					$appointmentTime = $doctor->appointmentTime;

					$doctorDetailsBypatient = $this->details_model->doctorDetailsBypatient($docId);
					$patientDetailsBypatient = $this->details_model->doctorDetailsBypatient($patientId);


					$data['bookingid'] = $bookingId;
					$data['symptoms'] = $symptoms;
					$data['bookingDate'] = $bookingDate;
					$data['appointmentTime'] = $appointmentTime;
					$data['Name'] = $doctorDetailsBypatient[0]->Name;
					$data['patientName'] = $patientDetailsBypatient[0]->Name;

					$data['docFees'] = $doctorDetailsBypatient[0]->docFees;
					$data['State'] = $doctorDetailsBypatient[0]->State;


					$appointment[] = $data;
				}

				$data['bookAppointment'] = $appointment;

				echo json_encode($data['bookAppointment']);

			} else {
				header("location: login");
			}


		} else {
			header("location: login");
		}


	}
	function getPatientList()
	{

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['acct_type'] == "admin") {
				$this->session->userdata['logged_in']['acct_type'];

				$data['tasks'] = $this->details_model->getPatientList();
				echo json_encode($data['tasks']);

			} else if ($this->session->userdata['logged_in']['acct_type'] == "doctor") {
				$this->session->userdata['logged_in']['acct_type'];
				$doctorId = $this->session->userdata['logged_in']['id'];

				$data['tasks'] = $this->details_model->getPatientListsToDoctor($doctorId);
				echo json_encode($data['tasks']);

			} else {

				header("location: login");
			}


		} else {
			header("location: login");
		}


	}



}
?>