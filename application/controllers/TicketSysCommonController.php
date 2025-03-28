<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TicketSysCommonController extends MY_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->model('TicketSysCommonModel');
        $this->load->model('TicketNicDevModel');
        $this->load->model('TicketNicManModel');

    }



    public function checkUserPermissionTechTicketAdmin()
    {
        $userDesignation = $this->session->userData('designation');
        if($userDesignation != TICKET_SYSTEM_NIC_ADMIN)
        {
            $this->session->set_flashdata('error',"You are not Authorized ! ");
            redirect( base_url().'dashboard');
        }
    }


    public function checkTicketAccess()
    {
        $userDesignation = $this->session->userData('designation');
        if (!in_array($userDesignation, TECHNICAL_TICKET_ACCESS_NIC))
        {
            $errors = '#MR: You are not Authorized for this process';
            $this->session->set_flashdata('error', $errors);
            redirect( base_url().'dashboard');
        }
    }



    // get application type list
    public function createApplication()
    {
        $this->checkUserPermissionTechTicketAdmin();

        $application = $this->TicketSysCommonModel->getAllApplicationWithOutStatus();
        $data['applications'] = $application;

        $data['_view'] = 'Ticket_System/application_list';
        $this->load->view('layouts/main', $data);

    }

    // save application type
    public function saveApplicationData()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $this->form_validation->set_rules('applicationTypeName','Application Type Name',
            'trim|required|min_length[2]|max_length[80]');
        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('error',"Please provide valid data and try again");
            redirect( base_url().'get-application');
        }

        $name     = trim($this->input->post("applicationTypeName"));
        $userCode = $this->session->userData('user_code');

        if($this->TicketSysCommonModel->checkApplicationTypeDuplicate($name) == 1)
        {
            $this->session->set_flashdata('error',"Application Type already exist, Please try new one");
            redirect( base_url().'get-application');
        }

        $data = array(
            'application_name' => $name,
            'status'           => 1,
            'created_by'       => $userCode,

        );
        $this->TicketSysCommonModel->saveApplicationType($data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('error',"There is some problem, Please try again");
            redirect( base_url().'get-application');
        }
        else
        {
            $this->session->set_flashdata('success',"Application type successfully added ");
            redirect( base_url().'get-application');
        }
    }

    // get application details page
    public function getApplicationDetailsPage()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $appId = $this->input->get('app');
        $appQuery = $this->TicketSysCommonModel->getApplicationDetailsWithId($appId);
        if($appQuery->num_rows() != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'get-application');
        }
        $application  = $appQuery->row();
        $allServices  = $this->TicketSysCommonModel->getAllServicesWithApplicationId($appId);
        $serviceCount = $allServices->num_rows();
        $services     = $allServices->result();

        $data['application']  = $application;
        $data['serviceCount'] = $serviceCount;
        $data['services']     = $services;

        $data['_view'] = 'Ticket_System/application_details';
        $this->load->view('layouts/main', $data);
    }

    // update application type
    public function updateApplicationData()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $this->form_validation->set_rules('applicationTypeName','Application Type Name', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('appId','Application Type Name', 'trim|required');
        $this->form_validation->set_rules('status','Application Type Status', 'trim|required|in_list[0,1]');
        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('error',"Please provide valid data and try again");
            redirect( base_url().'get-application');
        }

        $name     = trim($this->input->post("applicationTypeName"));
        $appId    = base64_decode($this->input->post("appId"));
        $status   = trim($this->input->post("status"));
        $userCode = $this->session->userData('user_code');
        $appQuery = $this->TicketSysCommonModel->getApplicationDetailsWithId($appId);
        if($appQuery->num_rows() != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'get-application');
        }

        $data = array(
            'application_name' => $name,
            'status'           => $status,
        );

        $this->TicketSysCommonModel->updateApplicationType($appId,$data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('error',"There is some problem, Please try again");
            redirect( base_url().'TicketSysCommonController/getApplicationDetailsPage/?app='.$appId);
        }
        else
        {
            $this->session->set_flashdata('success',"Application type successfully updated ");
            redirect( base_url().'TicketSysCommonController/getApplicationDetailsPage/?app='.$appId);
        }
    }





    // get Service type list
    public function createServiceType()
    {
        $this->checkUserPermissionTechTicketAdmin();

        $application = $this->TicketSysCommonModel->getAllApplication();
        $service     = $this->TicketSysCommonModel->getAllServiceTypeWithOutStatus();

        $data['applications'] = $application;
        $data['services']     = $service;

        $data['_view'] = 'Ticket_System/service_list';
        $this->load->view('layouts/main', $data);

    }

    // save Service type
    public function saveServiceTypeData()
    {
        $this->checkUserPermissionTechTicketAdmin();

        $this->form_validation->set_rules('applicationType','Application Type Name',
            'trim|required');
        $this->form_validation->set_rules('serviceTypeName','Service Type Name',
            'trim|required|min_length[2]|max_length[80]');

        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('error',"Please provide valid data and try again");
            redirect( base_url().'get-service-type');
        }

        $appName     = trim($this->input->post("applicationType"));
        $serviceName = trim($this->input->post("serviceTypeName"));
        $userCode    = $this->session->userData('user_code');

        if($this->TicketSysCommonModel->checkApplicationTypeIdExistOrNot($appName) ==0)
        {
            $this->session->set_flashdata('error',"Application type not exist !");
            redirect( base_url().'get-service-type');
        }
        if($this->TicketSysCommonModel->checkDuplicateTicketCategoryWithName($appName,$serviceName) == 1)
        {
            $this->session->set_flashdata('error',"Application Type already exist, Please try new one");
            redirect( base_url().'get-service-type');
        }

        $data = array(
            'app_id'           => $appName,
            'service_name'     => $serviceName,
            'status'           => 1,
            'created_by'       => $userCode,

        );
        $this->TicketSysCommonModel->saveServiceType($data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('error',"There is some problem, Please try again");
            redirect( base_url().'get-service-type');
        }
        else
        {
            $this->session->set_flashdata('success',"Service type successfully added ");
            redirect( base_url().'get-service-type');
        }
    }

    // get Service details page
    public function getServiceTypeDetailsPage()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $serviceId = $this->input->get('app');
        $appQuery  = $this->TicketSysCommonModel->getServiceTypeDetailsWithId($serviceId);
        if($appQuery->num_rows() != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'get-application');
        }
        $services    = $appQuery->row();
        $application = $this->TicketSysCommonModel->getAllApplication();

        $data['applications'] = $application;
        $data['service']      = $services;

        $data['_view'] = 'Ticket_System/service_details';
        $this->load->view('layouts/main', $data);

    }

    // update Service type
    public function updateServiceTypeData()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $this->form_validation->set_rules('serviceTypeName','Service Type Name', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('appId','Application Type Name', 'trim|required');
        $this->form_validation->set_rules('applicationType','Application Type Name', 'trim|required');
        $this->form_validation->set_rules('status','Application Type Status', 'trim|required|in_list[0,1]');
        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('error',"Please provide valid data and try again");
            redirect( base_url().'get-service-type');
        }

        $name     = trim($this->input->post("serviceTypeName"));
        $appId    = base64_decode($this->input->post("appId"));
        $status   = trim($this->input->post("status"));
        $appType  = trim($this->input->post("applicationType"));
        $userCode = $this->session->userData('user_code');
        $serviceQuery = $this->TicketSysCommonModel->getAllServicesWithApplicationId($appId);
        if($serviceQuery->num_rows() != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'get-service-type');
        }
        $appQuery = $this->TicketSysCommonModel->getApplicationDetailsWithId($appType);
        if($appQuery->num_rows() != 1)
        {
            $this->session->set_flashdata('error',"Application type not found !");
            redirect( base_url().'get-service-type');
        }
        $appTypeData = $appQuery->row();
        if($appTypeData->status != 1)
        {
            $this->session->set_flashdata('error',"Application type is not active !");
            redirect( base_url().'get-service-type');
        }

        $data = array(
            'app_id'       => $appType,
            'service_name' => $name,
            'status'       => $status,
        );

        $this->TicketSysCommonModel->updateServiceType($appId,$data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('error',"There is some problem, Please try again");
            redirect( base_url().'TicketSysCommonController/getServiceTypeDetailsPage/?app='.$appId);
        }
        else
        {
            $this->session->set_flashdata('success',"Application type successfully updated ");
            redirect( base_url().'TicketSysCommonController/getServiceTypeDetailsPage/?app='.$appId);
        }
    }





    // get Ticket type list
    public function createTicketType()
    {
        $this->checkUserPermissionTechTicketAdmin();

        $ticketType = $this->TicketSysCommonModel->getAllTicketType();
        $data['ticketTypes'] = $ticketType;

        $data['_view'] = 'Ticket_System/ticket_type_list';
        $this->load->view('layouts/main', $data);

    }

    // save application type
    public function saveTicketTypeData()
    {
        $this->checkUserPermissionTechTicketAdmin();

        $this->form_validation->set_rules('ticketTypeName','Ticket Type Name',
            'trim|required|min_length[2]|max_length[80]');

        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('error',"Please provide valid data and try again");
            redirect( base_url().'get-ticket-type');
        }

        $name     = trim($this->input->post("ticketTypeName"));
        $userCode = $this->session->userData('user_code');

        if($this->TicketSysCommonModel->checkTicketTypeDuplicate($name) == 1)
        {
            $this->session->set_flashdata('error',"Ticket Type already exist, Please try new one");
            redirect( base_url().'get-ticket-type');
        }

        $data = array(
            't_type_name' => $name,
            'status'      => 1,
            'created_by'  => $userCode,

        );
        $this->TicketSysCommonModel->saveTicketType($data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('error',"There is some problem, Please try again");
            redirect( base_url().'get-ticket-type');
        }
        else
        {
            $this->session->set_flashdata('success',"Ticket type successfully added ");
            redirect( base_url().'get-ticket-type');
        }
    }





    // get NIC Developer list
    public function getAllNicDeveloperData()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $dev = $this->TicketSysCommonModel->getAllNicDeveloper();
        $data['developers'] = $dev;

        $data['_view'] = 'Ticket_System/Nic/nic_developer_list';
        $this->load->view('layouts/main', $data);
    }

    // get NIC Developer details
    public function getNicDeveloperDetailsData()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $devId = $this->input->get('app');
        if($this->TicketSysCommonModel->countNicDeveloperWithId($devId) != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'get-nic-developer');
        }
        $devDetails    = $this->TicketSysCommonModel->getNicDeveloperDetailsWithId($devId);
        $userDegCode   = TICKET_SYSTEM_NIC;
        $userCode      = $devDetails->unique_user_id;
        $pendingTicket = $this->TicketNicDevModel->countAssignedTicketNicDev($userDegCode,TICKET_STATUS_PENDING,$userCode);
        $requestTicket = $this->TicketNicDevModel->countRequestForClosedTicketNicDev($userDegCode,TICKET_STATUS_PENDING,$userCode);
        $closedTicket  = $this->TicketNicDevModel->countClosedTicketNicDev($userDegCode,TICKET_STATUS_CLOSED,$userCode);

        $data['developer'] = $devDetails;
        $data['pending']   = $pendingTicket;
        $data['request']   = $requestTicket;
        $data['closed']    = $closedTicket;

        $data['_view'] = 'Ticket_System/Nic/nic_developer_details';
        $this->load->view('layouts/main', $data);
    }

    // view all pending ticket with selected NIC Developer
    public function getPendingTicketWithSelectedNicDev()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $devId = $this->input->get('app');
        if($this->TicketSysCommonModel->countNicDeveloperWithId($devId) != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'get-nic-developer');
        }

        $pendingTicket = $this->TicketNicDevModel->allAssignedTicketNicDev(TICKET_SYSTEM_NIC,TICKET_STATUS_PENDING,$devId);

        $data['devId']    = $devId;
        $data['tickets']  = $pendingTicket;
        $data['tHeading'] = 'Pending Ticket';
        $data['tType']    = TICKET_STATUS_PENDING;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_with_nic_dev';
        $this->load->view('layouts/main', $data);
    }

    // view all request for ticket by selected NIC Developer
    public function getRequestToClosedTicketBySelectedNicDev()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $devId = $this->input->get('app');
        if($this->TicketSysCommonModel->countNicDeveloperWithId($devId) != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'get-nic-developer');
        }


        $pendingTicket = $this->TicketNicDevModel->allRequestForClosedTicketNicDev(TICKET_SYSTEM_NIC,TICKET_STATUS_PENDING,$devId);

        $data['devId']    = $devId;
        $data['tickets']  = $pendingTicket;
        $data['tHeading'] = 'Request For Closed';
        $data['tType']    = TICKET_STATUS_PENDING;

        $data['_view'] = 'Ticket_System/Nic/request_for_closed_ticket_by_nic_dev';
        $this->load->view('layouts/main', $data);

    }

    // view all closed ticket by selected NIC Developer
    public function getClosedTicketBySelectedNicDev()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $devId = $this->input->get('app');
        if($this->TicketSysCommonModel->countNicDeveloperWithId($devId) != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'get-nic-developer');
        }

        $pendingTicket = $this->TicketNicDevModel->allClosedTicketNicDev(TICKET_SYSTEM_NIC,TICKET_STATUS_CLOSED,$devId);

        $data['devId']    = $devId;
        $data['tickets']  = $pendingTicket;
        $data['tHeading'] = 'Request For Closed';
        $data['tType']    = TICKET_STATUS_CLOSED;

        $data['_view'] = 'Ticket_System/Nic/closed_ticket_by_nic_dev';
        $this->load->view('layouts/main', $data);
    }

    // ticket Details
    public function getTechnicalTicketDetailsOnly()
    {
        $this->checkTicketAccess();
        $this->checkUserPermissionTechTicketAdmin();
        $tId = $this->input->get('app');
        if($this->TicketNicManModel->countTicketDetailsById($tId) != 1)
        {
            $this->session->set_flashdata('errorM', "Ticket details not found !");
            redirect(base_url().'get-nic-developer');
        }

        $ticketDetails       = $this->TicketNicManModel->getTicketDetailsById($tId);
        $data['ticket']      = $ticketDetails;
        $data['histories']   = $this->TicketNicManModel->getTicketHistoryById($tId);
        $data['attachments'] = $this->TicketNicManModel->getTicketDocumentById($tId);
        $data['comments']    = $this->TicketNicManModel->getTicketCommentById($tId);
        $data['locations']   = '';

        $districtName    = '';
        $subDivisionName = '';
        $circleName      = '';
        if($ticketDetails->dist_code != '')
        {
            $districtName = $this->utilclass->getDistrictName($ticketDetails->dist_code);
        }
        if($ticketDetails->subdiv_code != '')
        {
            $subDivisionName = $this->utilclass->getSubDivName($ticketDetails->dist_code, $ticketDetails->subdiv_code);
        }
        if($ticketDetails->cir_code != '')
        {
            $circleName = $this->utilclass->getCircleName($ticketDetails->dist_code, $ticketDetails->subdiv_code, $ticketDetails->cir_code);
        }

        $devList = $this->TicketSysCommonModel->getAllNicDeveloper();

        $data['developers']      = $devList;
        $data['districtName']    = $districtName;
        $data['subDivisionName'] = $subDivisionName;
        $data['circleName']      = $circleName;

        $data['_view'] = 'Ticket_System/Nic/tech_ticket_details_only';
        $this->load->view('layouts/main', $data);

    }




    private function UUID4()
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr(ord($bytes[6]) & 0x0f | 0x40);
        $bytes[8] = chr(ord($bytes[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
    }


    // decode for showing file
    public function decodeBase64($encoded_string)
    {
        $file_data = base64_decode($encoded_string);
        $file = finfo_open();
        $mime_type = finfo_buffer($file, $file_data, FILEINFO_MIME_TYPE);
        $file_type = explode('/', $mime_type)[0];
        $extension = explode('/', $mime_type)[1];
        log_message("error", "No error occured" . json_encode($mime_type));
        return $mime_type;
    }



    // add comment on ticket
    public function addCommentOnTechnicalTicket()
    {
        $this->checkTicketAccess();
        $tId      = trim($this->input->post('tId'));
        $ticketId = base64_decode($tId);
        $this->form_validation->set_rules('tId', 'Ticket Details', 'trim|required');
        $this->form_validation->set_rules('comment', 'comment', 'trim|required|min_length[2]|max_length[2500]');
        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $this->session->set_flashdata('errorM', $errors);
            redirect(base_url() . 'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$ticketId);

        }

        $comment = trim($this->input->post('comment'));
        if($this->TicketNicManModel->countTicketDetailsById($ticketId) != 1)
        {
            $this->session->set_flashdata('errorM', "Ticket details not found !");
            redirect(base_url() . 'dashboard');
        }
        $ticketDetails = $this->TicketNicManModel->getOnlyTicketDetailsById($ticketId);
        if($ticketDetails->ticket_status != 1)
        {
            $this->session->set_flashdata('errorM', "You cannot comment on this Ticket !");
            redirect(base_url() . 'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$ticketId);
        }

        // validation for file type and file size
        $name = $_FILES['attachment']['name'];
        $size = $_FILES['attachment']['size'];
        $fileHasOrNot = 0;
        $exp  = '';
        if($name != NULL)
        {
            $mime = mime_content_type($_FILES['attachment']['tmp_name']);
            $exp  = explode("/",$mime);
            $ext  = $exp[1];

            $fileHasOrNot = 1;

            if($ext == NULL)
            {
                $this->session->set_flashdata('error', "Attachment type must be " . UPLOAD_TYPE_VALIDATION_SHOW);
                redirect(base_url() . 'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$ticketId);
            }
            if(! in_array($ext, UPLOAD_TYPE_VALIDATION))
            {
                $this->session->set_flashdata('error', "Attachment type must be " . UPLOAD_TYPE_VALIDATION_SHOW);
                redirect(base_url() . 'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$ticketId);
            }
            if($size > UPLOAD_MAX_SIZE)
            {
                $this->session->set_flashdata('error', "Attachment size is more then " . UPLOAD_MAX_SIZE_VALIDATION_SHOW);
                redirect(base_url() . 'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$ticketId);
            }
        }

        $user_code   = trim($this->session->userdata('user_code'));
        $user_Id     = trim($this->session->userdata('unique_user_id'));
        $userDegCode = trim($this->session->userdata('designation'));
        $today       = date('Y-m-d G:i:s');
        $ipAddress   = $this->TicketSysCommonModel->get_client_ip();
        if($userDegCode == TICKET_SYSTEM_NIC_ADMIN)
        {
            $userDegCodeSub = 'NIC Manager';
        }
        elseif($userDegCode == TICKET_SYSTEM_NIC_DEVELOPER)
        {
            $userDegCodeSub = 'NIC Developer';
        }
        else
        {
            $userDegCodeSub = 'NIC Team';
        }

        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->trans_begin();

        $dataSave = array(
            'ticket_id'       => $ticketId,
            'comment_by'      => $userDegCodeSub,
            'comment_code'    => $user_Id,
            'comment_details' => $comment,
            'ip'              => $ipAddress,
            'status'          => 1,
            'created_at'      => $today,
        );

        if($fileHasOrNot > 0)
        {
            // save attachment
            $_FILES['file']['name']     = $_FILES['attachment']['name'];
            $_FILES['file']['type']     = $_FILES['attachment']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['attachment']['tmp_name'];
            $_FILES['file']['error']    = $_FILES['attachment']['error'];
            $_FILES['file']['size']     = $_FILES['attachment']['size'];

            $mime = mime_content_type($_FILES['attachment']['tmp_name']);
            $exp  = explode("/",$mime);
            $onlyExtension  = $exp[1];

            $fileRename =  $this->UUID4() . '.' . $onlyExtension;

            $config['upload_path']   = UPLOAD_DIR;
            $config['allowed_types'] = UPLOAD_ALLOW_TYPE;
            $config['max_size']      = UPLOAD_MAX_SIZE;;
            $config['file_name']     = $fileRename;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file'))
            {
                $dataSave = array(
                    'ticket_id'       => $ticketId,
                    'comment_by'      => $userDegCode,
                    'comment_code'    => $user_code,
                    'comment_details' => $comment,
                    'ip'              => $ipAddress,
                    'status'          => 1,
                    'created_at'      => $today,
                    'file_path'       => UPLOAD_DIR . $fileRename,
                    'file_name'       => $_FILES['file']['name'],
                    'file_type'       => $_FILES['file']['type'],
                );
            }
            else
            {
                $this->session->set_flashdata('error', "There is some problem, Please try again");
                redirect(base_url() . 'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$ticketId);
            }
        }

        $insertTicketHis = $this->db->insert('technical_ticket_comment', $dataSave);
        if ($insertTicketHis != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#MRTT0002: Insertion failed in technical_ticket_comment for Ticket No ' . $ticketId . 'and query is ' . $this->db->last_query());
            $this->session->set_flashdata('error', "There is some problem, Please try again");
            redirect(base_url() . 'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$ticketId);
        }

        $this->db->trans_commit();

        if($userDegCode == TICKET_SYSTEM_NIC_ADMIN)
        {
            $this->session->set_flashdata('success', "Your Comment Successfully added ");
            redirect(base_url() . 'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$ticketId);
        }
        elseif($userDegCode == TICKET_SYSTEM_NIC_DEVELOPER)
        {
            $this->session->set_flashdata('success', "Your Comment Successfully added ");
            redirect(base_url() . 'index.php/TicketNicDevController/getTechnicalTicketDetailsDev/?app='.$ticketId);
        }

    }



    // todo view uploaded Ticket doc
    public function getViewTicketUploadedDoc()
    {
        $this->checkTicketAccess();
        $filePathId = $this->input->get('fileId');
        $fileType   = $this->input->get('type');
        if($filePathId == '' OR $fileType == '')
        {
            die("Unable to open file !");
        }

        $fileDetails = $this->TicketSysCommonModel->getTicketDocWithFileId($filePathId);
        if($fileType == 1)
        {
            if($fileDetails->file_path == '')
            {
                die("Unable to open file !");
            }
            else
            {

                if(!file_exists($fileDetails->file_path))
                {
                    $parts = explode("uploads".UPLOAD_SEPARATOR, $fileDetails->file_path, 2);
                    if (count($parts) > 1)
                    {
                        $path = BACKUP_DIR_34."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    else
                    {
                        $path = $fileDetails->file_path;
                    }

                    if(!file_exists($path))
                    {
                        $path = BACKUP_DIR_35."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    if(!file_exists($path))
                    {
                        return false;
                    }
                }
                else
                {
                    $path = $fileDetails->file_path;
                }

                $mainfile = file_get_contents($path);
                $conType  = mime_content_type($path);
                $mainfile = base64_encode($mainfile);

                if ($conType == 'jpeg' || $conType == 'png' || $conType == 'jpg' || $conType == 'image/jpeg' || $conType == 'image/png' || $conType == 'image/jpg')
                {
                    echo "<img src = data:" . $this->decodeBase64($mainfile) . ";base64," . $mainfile . ">";
                }
                else
                {
                    header("Content-type: ".$conType);
                    echo base64_decode($mainfile);
                }
            }
        }
        elseif($fileType == 2)
        {
            if($fileDetails->file_path == '')
            {
                die("Unable to open file !");
            }
            else
            {

                if(!file_exists($fileDetails->file_path))
                {
                    $parts = explode("uploads".UPLOAD_SEPARATOR, $fileDetails->file_path, 2);
                    if (count($parts) > 1)
                    {
                        $path = BACKUP_DIR_34."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    else
                    {
                        $path = $fileDetails->file_path;
                    }

                    if(!file_exists($path))
                    {
                        $path = BACKUP_DIR_35."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    if(!file_exists($path))
                    {
                        return false;
                    }
                }
                else
                {
                    $path = $fileDetails->file_path;
                }

                $mainfile = file_get_contents($path);
                $conType  = mime_content_type($path);
                $mainfile = base64_encode($mainfile);

                if ($conType == 'jpeg' || $conType == 'png' || $conType == 'jpg' || $conType == 'image/jpeg' || $conType == 'image/png' || $conType == 'image/jpg')
                {
                    echo "<img src = data:" . $this->decodeBase64($mainfile) . ";base64," . $mainfile . ">";
                }
                else
                {
                    header("Content-type: ".$conType);
                    echo base64_decode($mainfile);
                }
            }
        }
        else
        {
            die("Unable to open file !");
        }

    }


    // todo view uploaded comment doc
    public function getViewTicketCommentDoc()
    {
        $this->checkTicketAccess();
        $filePathId = $this->input->get('fileId');
        $fileType   = $this->input->get('type');
        if($filePathId == '' OR $fileType == '')
        {
            die("Unable to open file !");
        }

        $fileDetails = $this->TicketSysCommonModel->getTicketCommentDocWithFileId($filePathId);
        if($fileType == 1)
        {
            if($fileDetails->file_path == '')
            {
                die("Unable to open file !");
            }
            else
            {

                if(!file_exists($fileDetails->file_path))
                {
                    $parts = explode("uploads".UPLOAD_SEPARATOR, $fileDetails->file_path, 2);
                    if (count($parts) > 1)
                    {
                        $path = BACKUP_DIR_34."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    else
                    {
                        $path = $fileDetails->file_path;
                    }

                    if(!file_exists($path))
                    {
                        $path = BACKUP_DIR_35."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    if(!file_exists($path))
                    {
                        return false;
                    }
                }
                else
                {
                    $path = $fileDetails->file_path;
                }

                $mainfile = file_get_contents($path);
                $conType  = mime_content_type($path);
                $mainfile = base64_encode($mainfile);

                if ($conType == 'jpeg' || $conType == 'png' || $conType == 'jpg' || $conType == 'image/jpeg' || $conType == 'image/png' || $conType == 'image/jpg')
                {
                    echo "<img src = data:" . $this->decodeBase64($mainfile) . ";base64," . $mainfile . ">";
                }
                else
                {
                    header("Content-type: ".$conType);
                    echo base64_decode($mainfile);
                }
            }
        }
        elseif($fileType == 2)
        {
            if($fileDetails->file_path == '')
            {
                die("Unable to open file !");
            }
            else
            {

                if(!file_exists($fileDetails->file_path))
                {
                    $parts = explode("uploads".UPLOAD_SEPARATOR, $fileDetails->file_path, 2);
                    if (count($parts) > 1)
                    {
                        $path = BACKUP_DIR_34."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    else
                    {
                        $path = $fileDetails->file_path;
                    }

                    if(!file_exists($path))
                    {
                        $path = BACKUP_DIR_35."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    if(!file_exists($path))
                    {
                        return false;
                    }
                }
                else
                {
                    $path = $fileDetails->file_path;
                }

                $mainfile = file_get_contents($path);
                $conType  = mime_content_type($path);
                $mainfile = base64_encode($mainfile);

                if ($conType == 'jpeg' || $conType == 'png' || $conType == 'jpg' || $conType == 'image/jpeg' || $conType == 'image/png' || $conType == 'image/jpg')
                {
                    echo "<img src = data:" . $this->decodeBase64($mainfile) . ";base64," . $mainfile . ">";
                }
                else
                {
                    header("Content-type: ".$conType);
                    echo base64_decode($mainfile);
                }
            }
        }
        else
        {
            die("Unable to open file !");
        }

    }



}



