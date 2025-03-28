<?php
class NcVillageModel extends CI_Model
{

    /** GET Generated Notification FOR ALL DEPT USER */
    public function getGeneratedNotification($type,$user)
    {
        $this->db = $this->load->database('db2', TRUE);
        $notification = array();
        if($user == 'ps' && $type == 'pending')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('ps_verified', null);
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'ps' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'ps' && $type == 'reverted')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified',  'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('reverted', 'Y');
            $this->db->where('minister_verified', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'secretary' && $type == 'pending')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('secretary_verified', null);
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'secretary' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'joint_secretary' && $type == 'pending')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', null);
            $this->db->where('status', 'A');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'joint_secretary' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'joint_secretary' && $type == 'reverted')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', null);
            $this->db->where('status', 'A');
            $this->db->where('reverted', 'Y');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'section_officer' && $type == 'pending')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', null);
            $this->db->where('status', 'A');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'section_officer' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'section_officer' && $type == 'reverted')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', null);
            $this->db->where('status', 'A');
            $this->db->where('reverted', 'Y');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'asst_section_officer' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'asst_section_officer' && $type == 'reverted')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', null);
            $this->db->where('status', 'A');
            $this->db->where('reverted', 'Y');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'minister' && $type == 'pending')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('minister_verified', null);
            $this->db->where('status', 'A');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'minister' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('minister_verified', 'Y');
            $this->db->where('status', 'A');
            $this->db->where('reverted', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }

        return $notification;
    }

    /** Forward Notification FOR ALL DEPT USER */
    public function forwardedNcNotification($notification_id,$notification,$note,$dist_code,$user)
    {
        $this->db = $this->load->database('db2', TRUE);
        $user_code = $this->session->userdata('user_code');
        if($user == 'ps')
        {
            $this->db->set([
                'ps_note' => $note,
                'ps_notification' => $notification,
                'ps_verified' => "Y",
                'ps_verified_at' => date('Y-m-d H:i:s'),
                "ps_user_code" => $user_code,
                "reverted" => null,
            ]);
        }
        elseif($user == 'secretary')
        {
            $this->db->set([
                'secretary_note' => $note,
                'secretary_notification' => $notification,
                'secretary_verified' => "Y",
                'secretary_verified_at' => date('Y-m-d H:i:s'),
                "secretary_user_code" => $user_code,
                "reverted" => null,
            ]);
        }
        elseif($user == 'joint_secretary')
        {
            $this->db->set([
                'joint_secretary_note' => $note,
                'joint_secretary_notification' => $notification,
                'joint_secretary_verified' => "Y",
                'joint_secretary_verified_at' => date('Y-m-d H:i:s'),
                "joint_secretary_user_code" => $user_code,
                "reverted" => null,
            ]);
        }
        elseif($user == 'section_officer')
        {
            $this->db->set([
                'section_officer_note' => $note,
                'section_officer_notification' => $notification,
                'section_officer_verified' => "Y",
                'section_officer_verified_at' => date('Y-m-d H:i:s'),
                "section_officer_user_code" => $user_code,
                "reverted" => null,
            ]);
        }
        elseif($user == 'minister')
        {
            $this->db->set([
                'minister_note' => $note,
                'minister_verified' => "Y",
                'minister_verified_at' => date('Y-m-d H:i:s'),
                "minister_user_code" => $user_code,
                "reverted" => null,
            ]);
        }

        $this->db->where('id', $notification_id);
        $this->db->where('dist_code', $dist_code);
        $this->db->update('nc_village_gen_notification');
        if ($this->db->affected_rows() > 0) {
            return 'Y';
        }else{
            return 'N';
        }
    }

    /** revert Notification FOR ALL DEPT USER */
    public function revertNcNotification($proposal_no,$notification_id,$notification,$note,$dist_code,$user)
    {
        $this->db = $this->load->database('db2', TRUE);
        $data['user_code'] = $user_code = $this->session->userdata('user_code');
        $data['proposal_no'] = $proposal_no;
        $data['dist_code'] = $dist_code;
        $data['note'] = $note;
        if($user == 'ps')
        {
            $this->db->set([
                'ps_note' => $note,
                'ps_notification' => $notification,
                'ps_verified' => "Y",
                'ps_verified_at' => date('Y-m-d H:i:s'),
                "ps_user_code" => $user_code,
            ]);
        }
        elseif($user == 'secretary')
        {
            $this->db->set([
                'secretary_note' => $note,
                'secretary_notification' => $notification,
                'secretary_verified' => null,
                'secretary_verified_at' => date('Y-m-d H:i:s'),
                "secretary_user_code" => $user_code,
                "reverted" => 'Y',
            ]);
        }
        elseif($user == 'joint_secretary')
        {
            $this->db->set([
                'joint_secretary_note' => $note,
                'joint_secretary_notification' => $notification,
                'joint_secretary_verified_at' => date('Y-m-d H:i:s'),
                "joint_secretary_user_code" => $user_code,
                "joint_secretary_verified" => null,
                "reverted" => 'Y',
            ]);
        }
        elseif($user == 'section_officer')
        {
            $this->db->set([
                'section_officer_note' => $note,
                'section_officer_notification' => $notification,
                'section_officer_verified_at' => date('Y-m-d H:i:s'),
                "section_officer_user_code" => $user_code,
                "section_officer_verified" => null,
                "reverted" => 'Y',
            ]);
        }
        elseif($user == 'minister')
        {
            $this->db->set([
                'minister_note' => $note,
                'minister_verified_at' => date('Y-m-d H:i:s'),
                "minister_user_code" => $user_code,
                "reverted" => 'Y',
            ]);
        }

        $this->db->where('id', $notification_id);
        $this->db->where('dist_code', $dist_code);
        $this->db->update('nc_village_gen_notification');
        if ($this->db->affected_rows() > 0) {
            return 'Y';
        }else{
            return 'N';
        }
    }

    /** get Approved Notification */
    public function getApprovedNotification($type,$user)
    {
        $this->db = $this->load->database('db2', TRUE);
        $notification = array();
        if($user == 'ps' && $type == 'pending')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('minister_verified', 'Y');
            $this->db->where('ps_sign', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'ps' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('minister_verified', 'Y');
            $this->db->where('ps_sign', 'Y');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'dlr' && $type == 'pending')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('minister_verified', 'Y');
            $this->db->where('ps_sign', 'Y');
            $this->db->where('dlr_verified', null);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'dlr' && $type == 'reverted')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('dlr_verified', null);
            $this->db->where('status', 'R');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'ps' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('minister_verified', 'Y');
            $this->db->where('ps_sign', 'Y');
            $this->db->where('dlr_verified', 'Y');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'jds' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('minister_verified', 'Y');
            $this->db->where('ps_sign', 'Y');
            $this->db->where('status !=', 'R');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif ($user == 'ads' && $type == 'verified')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('minister_verified', 'Y');
            $this->db->where('ps_sign', 'Y');
            $this->db->where('status !=', 'R');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }

        return $notification;
    }

    /** get Reverted Proposal */
    public function getRevertedProposal($type,$user)
    {
        $this->db = $this->load->database('db2', TRUE);
        $notification = array();
        if($user == 'dlr' && $type == 'reverted')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('dlr_verified', null);
            $this->db->where('status', 'R');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }
        elseif($user == 'adlr' && $type == 'reverted')
        {
            $this->db->select('*');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('asst_section_officer_verified', 'Y');
            $this->db->where('section_officer_verified', 'Y');
            $this->db->where('joint_secretary_verified', 'Y');
            $this->db->where('secretary_verified', 'Y');
            $this->db->where('ps_verified', 'Y');
            $this->db->where('dlr_verified', null);
            $this->db->where('adlr_verified', null);
            $this->db->where('status', 'R');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $notification = $query->result();
            }
        }

        return $notification;
    }

    /** View Notification FOR ALL DEPT USER */
    public function getNotification($notification_id,$dist_code,$user)
    {
        $this->db = $this->load->database('db2', TRUE);

        if($user == 'ps')
        {
            $this->db->select('ps_notification');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('id', $notification_id);
            $this->db->where('dist_code', $dist_code);
            $query = $this->db->get();
            $notification = null;
            if ( $query->num_rows() > 0 )
            {
                $notification = $query->row()->ps_notification;
            }

            return $notification;
        }
        elseif($user == 'joint_secretary')
        {
            $this->db->select('joint_secretary_notification');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('id', $notification_id);
            $this->db->where('dist_code', $dist_code);
            $query = $this->db->get();
            $notification = null;
            if ( $query->num_rows() > 0 )
            {
                $notification = $query->row()->joint_secretary_notification;
            }

            return $notification;
        }
        elseif($user == 'secretary')
        {
            $this->db->select('secretary_notification');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('id', $notification_id);
            $this->db->where('dist_code', $dist_code);
            $query = $this->db->get();
            $notification = null;
            if ( $query->num_rows() > 0 )
            {
                $notification = $query->row()->secretary_notification;
            }

            return $notification;
        }
        elseif($user == 'section_officer')
        {
            $this->db->select('section_officer_notification');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('id', $notification_id);
            $this->db->where('dist_code', $dist_code);
            $query = $this->db->get();
            $notification = null;
            if ( $query->num_rows() > 0 )
            {
                $notification = $query->row()->section_officer_notification;
            }

            return $notification;
        }
        elseif($user == 'asst_section_officer')
        {
            $this->db->select('asst_section_officer_notification');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('id', $notification_id);
            $this->db->where('dist_code', $dist_code);
            $query = $this->db->get();
            $notification = null;
            if ( $query->num_rows() > 0 )
            {
                $notification = $query->row()->asst_section_officer_notification;
            }

            return $notification;
        }
        elseif($user == 'asst_section_officer_reverted')
        {
            $this->db->select('section_officer_notification');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('id', $notification_id);
            $this->db->where('dist_code', $dist_code);
            $query = $this->db->get();
            $notification = null;
            if ( $query->num_rows() > 0 )
            {
                $notification = $query->row()->section_officer_notification;
            }

            return $notification;
        }
        elseif($user == 'minister')
        {
            $this->db->select('ps_notification');
            $this->db->from('nc_village_gen_notification');
            $this->db->where('id', $notification_id);
            $this->db->where('dist_code', $dist_code);
            $query = $this->db->get();
            $notification = null;
            if ( $query->num_rows() > 0 )
            {
                $notification = $query->row()->ps_notification;
            }

            return $notification;
        }
    }

    /** Revert Back Notification */
    public function notificationRevertBackToDLRS($notification_id,$notification,$note,$dist_code,$user)
    {
        $this->db = $this->load->database('db2', TRUE);
        $user_code = $this->session->userdata('user_code');
        if($user == 'ps')
        {
            $this->db->set([
                'status' =>'R',
                'ps_note' => $note,
                'ps_notification' => $notification,
                'ps_verified' => "Y",
                'ps_verified_at' => date('Y-m-d H:i:s'),
                "ps_user_code" => $user_code,
                "reverted" => 'Y',
            ]);
        }

        $this->db->where('id', $notification_id);
        $this->db->where('dist_code', $dist_code);
        $this->db->where('status', 'A');
        $this->db->update('nc_village_gen_notification');
        if ($this->db->affected_rows() == 1) {
            return 'Y';
        }else{
            return 'N';
        }
    }

    /** dlr send message */
    public function dlrSendMessage($notification_id,$adlr_note,$jds_note,$user)
    {
        $this->db = $this->load->database('db2', TRUE);
        if($user == 'dlr')
        {
            $this->db->where('id', $notification_id)
                ->update('nc_village_gen_notification', array(
                    'dlr_to_adlr_msg' => $adlr_note,
                    'dlr_to_jds_msg' => $jds_note,
                ));
            if ($this->db->affected_rows() == 1) {
                return 'Y';
            }else{
                return 'N';
            }
        }
    }


    /** command api */
    public static function callApi($url,$method='GET', $data=null)
    {
        $curl = curl_init();
        if($method == 'POST')
        {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_VERBOSE => 1,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                ),
            ));
        }else{
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode != 200)
        {
            log_message("error", 'NCVILLAGE API FAIL #NCAPI0001');
            $arr = (object) array(
                'data' => [],
                'status_code' => 404
            );
            return $arr;
        }
        if ($response) {
            return json_decode($response);
        } else {
            log_message("error", 'NCVILLAGE API NO DATA FOUND #NCAPI0002');
            $arr = (object) array(
                'data' => [],
                'status_code' => 404
            );
            return $arr;
        }
    }


    public function getLocations($dist = null, $sub = null, $cir = null, $mouza = null, $lot = null, $village = null)
    {
        if ($dist) {
            $location['dist'] = $this->db->select('loc_name,dist_code')->where(array('dist_code' => $dist, 'subdiv_code' => '00', 'cir_code' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->get('location')->row_array();
        }
        if ($sub) {
            $location['subdiv'] = $this->db->select('loc_name,dist_code,subdiv_code')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->get('location')->row_array();
        }
        if ($cir) {
            $location['circle'] = $this->db->select('loc_name,dist_code,subdiv_code,cir_code')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => $cir, 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->get('location')->row_array();
        }
        if ($mouza) {
            $location['mouza'] = $this->db->select('loc_name,dist_code,subdiv_code,cir_code,mouza_pargona_code')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => $cir, 'mouza_pargona_code' => $mouza, 'lot_no' => '00', 'vill_townprt_code' => '00000'))->get('location')->row_array();
        }
        if ($lot) {
            $location['lot'] = $this->db->select('loc_name,dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => $cir, 'mouza_pargona_code' => $mouza, 'lot_no' => $lot, 'vill_townprt_code' => '00000'))->get('location')->row_array();
        }
        if ($village) {
            $location['village'] = $this->db->select('loc_name,dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => $cir, 'mouza_pargona_code' => $mouza, 'lot_no' => $lot, 'vill_townprt_code' => $village))->get('location')->row_array();
        }

        return $location;
    }


    public function districtdetails()
    {
        return $this->db->get_where('location', array('dist_code !=' => '00', 'subdiv_code' => '00', 'cir_code' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->result_array();
    }
    public function subdivisiondetails($dist, $subdiv_code = null)
    {
        if ($subdiv_code) {
            return $this->db->get_where('location', array('dist_code' => $dist, 'subdiv_code ' => $subdiv_code, 'cir_code' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->result_array();
        } else {
            return $this->db->get_where('location', array('dist_code' => $dist, 'subdiv_code !=' => '00', 'cir_code' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->result_array();
        }
    }

    public function  subDivdetails($dist)
    {
        if ($dist) {
            return $this->db->get_where('location', array('dist_code' => $dist, 'subdiv_code !=' => '00', 'cir_code ' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->result_array();
        }
    }

    public function  circledetails($dist, $sub, $cir_code=null)
    {
        if ($cir_code) {
            return $this->db->get_where('location', array('dist_code' => $dist, 'subdiv_code =' => $sub, 'cir_code ' => $cir_code, 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->result_array();
        } else {
            return $this->db->get_where('location', array('dist_code' => $dist, 'subdiv_code =' => $sub, 'cir_code!=' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->result_array();
        }
    }
    public function mouzadetails($dist, $sub, $circle)
    {
        return $this->db->get_where('location', array('dist_code' => $dist, 'subdiv_code =' => $sub, 'cir_code=' => $circle, 'mouza_pargona_code!=' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->result_array();
    }
    public function lotdetails($dist, $sub, $circle, $mza)
    {
        return $this->db->get_where('location', array('dist_code' => $dist, 'subdiv_code =' => $sub, 'cir_code=' => $circle, 'mouza_pargona_code=' => $mza, 'lot_no!=' => '00', 'vill_townprt_code' => '00000'))->result_array();
    }
    public function villagedetails($dist, $sub, $circle, $mza, $lot)
    {
        return $this->db->get_where('location', array('dist_code' => $dist, 'subdiv_code =' => $sub, 'cir_code=' => $circle, 'mouza_pargona_code=' => $mza, 'lot_no=' => $lot, 'vill_townprt_code!=' => '00000'))->result_array();
    }
    public function districtdetailsreport()
    {
        return $this->db->get_where('location', array('subdiv_code' => '00', 'cir_code' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->result_array();
    }

    public function getPattaType()
    {
        $ptype = $this->db->query("Select type_code,patta_type from patta_code order by type_code asc");
        return $ptype->result();
    }

    public function getLandclasscode()
    {
        $landclasstype = $this->db->query("Select class_code,land_type from landclass_code order by class_code asc");
        return $landclasstype->result();
    }

    public function getGuardrelation()
    {
        return $this->db->get_where('master_guard_rel', array('guard_rel!=' => ''))->result();
    }

    function patta_type_name($pattatype)
    {
        $this->db->select('patta_type');
        $qp = $this->db->get_where('patta_code', array('type_code' => $pattatype));
        $rp = $qp->row_array();
        $patname = $rp['patta_type'];
        return $patname;
    }

    function checkpattadarid()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $patta_no = $this->session->userdata('patta_no');
        $patta_type_code = $this->session->userdata('patta_type');
        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and trim(patta_no)=trim('$patta_no') and patta_type_code='$patta_type_code')";
        $this->db->select_max('pdar_id', 'max');
        $query = $this->db->get_where('chitha_pattadar', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    function relation()
    {
        $this->db->select('guard_rel,guard_rel_desc_as');
        $query = $this->db->get_where('master_guard_rel');
        return $query->result();
    }

    function ntrcode()
    {
        $this->db->select('trans_code,trans_desc_as');
        $query = $this->db->get_where('nature_trans_code');
        return $query->result();
    }

    function fmuttype()
    {
        $this->db->select('order_type_code,order_type');
        $query = $this->db->get_where('master_field_mut_type');
        return $query->result();
    }

    function lmname()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no')";
        $this->db->select('lm_code,lm_name');
        $query = $this->db->get_where('lm_code', $where);
        return $query->result();
    }

    function coname()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and user_desig_code='CO')";
        $this->db->select('user_code,username');
        $query = $this->db->get_where('users', $where);
        return $query->result();
    }

    function ordersrno()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');

        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and dag_no='$dag_no')";
        $this->db->select_max('col8order_cron_no', 'max');
        $query = $this->db->get_where('chitha_col8_order', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    function occupantid()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');

        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and dag_no='$dag_no')";
        $this->db->select_max('occupant_id', 'max');
        $query = $this->db->get_where('chitha_col8_occup', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    function inplaceid()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');
        $col8crno = $this->session->userdata('col8crno');

        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and dag_no='$dag_no' and col8order_cron_no=$col8crno)";
        $this->db->select_max('inplace_of_id', 'max');
        $query = $this->db->get_where('chitha_col8_inplace', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    function relationame($pdar_rel)
    {
        $this->db->select('guard_rel_desc_as');
        $qp = $this->db->get_where('master_guard_rel', array('guard_rel' => $pdar_rel));
        $rp = $qp->row_array();
        $relname = $rp['guard_rel_desc_as'];
        return $relname;
    }

    function pdardag($patta_no, $pattatype, $dag_no)
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and patta_no='$patta_no' and patta_type_code='$pattatype' and dag_no!='$dag_no')";
        $this->db->select('dag_no');
        $this->db->distinct();
        $query = $this->db->get_where('chitha_dag_pattadar', $where);
        return $query->result();
    }

    function checknewpatta($patta_type, $patta_no)
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');

        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and trim(patta_no)=trim('$patta_no') and patta_type_code='$patta_type')";
        $this->db->select('patta_no');
        $query = $this->db->get_where('chitha_basic', $where);
        $count = $query->num_rows();
        if ($count > 0) {
            $newpatta = 'N';
        } else {
            $newpatta = 'Y';
        }

        return $newpatta;
    }


    function pattadardet($patta_no, $pattatype, $dag_no)
    {

        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $sql = "select a.pdar_id,a.pdar_name,a.patta_no,a.patta_type_code,b.dag_no from chitha_pattadar as a join chitha_dag_pattadar as b on a.patta_no=b.patta_no and a.patta_type_code=b.patta_type_code and a.dist_code=b.dist_code and a.subdiv_code=b.subdiv_code and a.cir_code=b.cir_code and a.mouza_pargona_code=b.mouza_pargona_code and a.lot_no=b.lot_no and a.vill_townprt_code=b.vill_townprt_code and a.pdar_id=b.pdar_id where a.patta_no='$patta_no' and a.patta_type_code='$pattatype' and a.dist_code='$dcode' and a.subdiv_code='$scode' and a.cir_code='$ccode' and a.mouza_pargona_code='$mcode' and a.lot_no='$lcode' and a.vill_townprt_code='$vcode' and b.dag_no!='$dag_no' order by b.dag_no";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function pattadardagdet($patta_no, $pattatype, $dagno)
    {

        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $sql = "select a.pdar_id,a.pdar_name,a.patta_no,a.patta_type_code,a.lot_no,a.vill_townprt_code,b.dag_no from chitha_pattadar as a join chitha_dag_pattadar as b on a.patta_no=b.patta_no and a.patta_type_code=b.patta_type_code and a.dist_code=b.dist_code and a.subdiv_code=b.subdiv_code and a.cir_code=b.cir_code and a.mouza_pargona_code=b.mouza_pargona_code and a.lot_no=b.lot_no and a.vill_townprt_code=b.vill_townprt_code and a.pdar_id=b.pdar_id where b.dag_no='$dagno' and a.patta_no='$patta_no' and a.patta_type_code='$pattatype' and a.dist_code='$dcode' and a.subdiv_code='$scode' and a.cir_code='$ccode' and a.mouza_pargona_code='$mcode' and a.lot_no='$lcode' and a.vill_townprt_code='$vcode' order by b.dag_no";

        $query = $this->db->query($sql);

        $str = '';

        $str = $str . '<table class="table" border=0 bgcolor="#BFFFE6">';
        $str = $str . '<tr><td></td><td>Id</td><td>Name</td></tr>';
        if ($query) {
            foreach ($query->result() as $row) {
                $pid = $row->pdar_id;
                $pname = $row->pdar_name;
                $patta = $row->patta_no;
                $ptype = $row->patta_type_code;
                $dno = $row->dag_no;
                $vl = $pid . ',' . $pname . ',' . $patta . ',' . $ptype . ',' . $dno;
                $str = $str . '<tr><td><input type="checkbox" name="chk[]" id="chk[]" value="' . $vl . '"></td><td>' . $row->pdar_id . '</td><td>' . $row->pdar_name . '</td><tr>';
            }
        }
        $str = $str . '</table>';
        return $str;
    }

    function pattadarinsdet($patta, $ptype, $dagno)
    {
        $base = $this->config->item('base_url');
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $sql = "select a.pdar_id,a.pdar_name,a.patta_no,a.patta_type_code,b.dag_no from chitha_pattadar as a join chitha_dag_pattadar as b on a.patta_no=b.patta_no and a.patta_type_code=b.patta_type_code and a.dist_code=b.dist_code and a.subdiv_code=b.subdiv_code and a.cir_code=b.cir_code and a.mouza_pargona_code=b.mouza_pargona_code and a.lot_no=b.lot_no and a.vill_townprt_code=b.vill_townprt_code and a.pdar_id=b.pdar_id where b.dag_no='$dagno' and a.patta_no='$patta' and a.patta_type_code='$ptype' and a.dist_code='$dcode' and a.subdiv_code='$scode' and a.cir_code='$ccode' and a.mouza_pargona_code='$mcode' and a.lot_no='$lcode' and a.vill_townprt_code='$vcode' order by a.pdar_id";

        $query = $this->db->query($sql);

        $str = '';

        $str = $str . '<table class="table" border=0 bgcolor="#BFFFE6">';
        $str = $str . '<tr><td>Id</td><td>Name</td></tr>';
        if ($query) {
            foreach ($query->result() as $row) {
                $pid = $row->pdar_id;
                $pname = $row->pdar_name;
                $patta = $row->patta_no;
                $ptype = $row->patta_type_code;
                $dno = $row->dag_no;
                $vll = $pid . '-' . $patta . '-' . $ptype . '-' . $dno;
                //$str=$str.'<tr><td>'.$row->pdar_id.'</td><td>'.$row->pdar_name.'</td><tr>';
                $str = $str . '<tr><td>' . $row->pdar_id . '</td><td><a href=' . $base . 'index.php/Chithacontrol/pdaredit/' . $vll . ' title="Click here to edit pattadar details"><u>' . $row->pdar_name . '</u></a></td><tr>';
            }
        }
        $str = $str . '</table>';
        return $str;
    }

    function pattadarexispid($pid, $pattano, $pattatype, $dagno)
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $sql = "select a.pdar_id,a.pdar_gender,a.pdar_name,a.patta_no,a.patta_type_code,a.pdar_guard_reln,a.pdar_father,a.pdar_add1,a.pdar_add2,a.pdar_add3,a.pdar_pan_no,a.pdar_citizen_no,
b.dag_por_b,b.dag_por_k,b.dag_por_lc,b.dag_por_g,b.pdar_land_n,b.pdar_land_s,b.pdar_land_e,b.pdar_land_w,b.pdar_land_revenue,b.pdar_land_localtax,b.p_flag 
from chitha_pattadar as a join chitha_dag_pattadar as b on a.patta_no=b.patta_no and a.patta_type_code=b.patta_type_code and a.dist_code=b.dist_code and a.subdiv_code=b.subdiv_code and a.cir_code=b.cir_code and a.mouza_pargona_code=b.mouza_pargona_code and a.lot_no=b.lot_no and a.vill_townprt_code=b.vill_townprt_code and a.pdar_id=b.pdar_id where a.pdar_id=$pid and b.dag_no='$dagno' and a.patta_no='$pattano' and a.patta_type_code='$pattatype' and a.dist_code='$dcode' and a.subdiv_code='$scode' and a.cir_code='$ccode' and a.mouza_pargona_code='$mcode' and a.lot_no='$lcode' and a.vill_townprt_code='$vcode' order by b.dag_no";

        $query = $this->db->query($sql);
        $row = $query->row_array();
        $pid = $row['pdar_id'];
        $pname = $row['pdar_name'];
        $prel = $row['pdar_guard_reln'];
        $pfath = $row['pdar_father'];
        $padd1 = $row['pdar_add1'];
        $padd2 = $row['pdar_add2'];
        $padd3 = $row['pdar_add3'];
        $ppan = $row['pdar_pan_no'];
        $pcit = $row['pdar_citizen_no'];
        $bigha = $row['dag_por_b'];
        $katha = $row['dag_por_k'];
        $lessa = $row['dag_por_lc'];
        $ganda = $row['dag_por_g'];
        $landn = $row['pdar_land_n'];
        $lands = $row['pdar_land_s'];
        $lande = $row['pdar_land_e'];
        $landw = $row['pdar_land_w'];
        $lrev = $row['pdar_land_revenue'];
        $ltax = $row['pdar_land_localtax'];
        $pflag = $row['p_flag'];
        $pGender = $row['pdar_gender'];

        return $pdet = $pid . '$' . $pname . '$' . $prel . '$' . $pfath . '$' . $padd1 . '$' . $padd2 . '$' . $padd3 . '$' . $ppan . '$' . $pcit . '$' . $bigha . '$' . $katha . '$' . $lessa . '$' . $ganda . '$' . $landn . '$' . $lands . '$' . $lande . '$' . $landw . '$' . $lrev . '$' . $ltax . '$' . $pflag . '$' . $pGender;
    }


    function insertexitdag($pid, $pname, $patta, $ptype)
    {

        $edagno = $this->input->post('edag');

        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');

        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and  dag_no='$edagno' and pdar_id=$pid and patta_no='$patta' and patta_type_code='$ptype')";
        $this->db->select('dag_no,patta_no');
        $query = $this->db->get_where('chitha_dag_pattadar', $where);
        if ($query->num_rows() == 0) {

            $data['data'] = array(
                'dist_code' => $this->session->userdata('dist_code'),
                'subdiv_code' => $this->session->userdata('subdiv_code'),
                'cir_code' => $this->session->userdata('cir_code'),
                'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
                'lot_no' => $this->session->userdata('lot_no'),
                'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
                'dag_no' => $edagno,
                'pdar_id' => $pid,
                'patta_no' => $patta,
                'patta_type_code' => $ptype,
                'dag_por_b' => 0,
                'dag_por_k' => 0,
                'dag_por_lc' => 0,
                'dag_por_g' =>  0,
                'pdar_land_n' => '',
                'pdar_land_s' => '',
                'pdar_land_e' => '',
                'pdar_land_w' => '',
                'pdar_land_acre' => 0,
                'pdar_land_revenue' => 0,
                'pdar_land_localtax' => 0,
                'user_code' => 'aaa',
                'date_entry' => date("Y-m-d | h:i:sa"),
                'operation' => 'E',
                'p_flag' => 0,
                'jama_yn' => 'n',

            );
            $data['data_1'] = $this->security->xss_clean($data['data']);
            $nrows = $this->db->insert('chitha_dag_pattadar', $data['data_1']);

            return $nrows;
        }
    }

    function updatepattadar()
    {

        $dagno = $this->input->post('dag_no');
        $pid = $this->input->post('pdar_id');
        $patta = $this->input->post('patta_no');
        $ptype = $this->input->post('patta_type_code');

        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');

        //$where="(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and  dag_no='$edagno' and pdar_id=$pid and patta_no='$patta' and patta_type_code='$ptype')";
        //$this->db->select('dag_no,patta_no');
        //$query=$this->db->get_where('chitha_dag_pattadar',$where);
        //if($query->num_rows() == 0){

        $data['data'] = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $dagno,
            'pdar_id' => $pid,
            'patta_no' => $patta,
            'patta_type_code' => $ptype,
            'dag_por_b'   => $this->input->post('dag_por_b') ? $this->input->post('dag_por_b') : 0,
            'dag_por_k'   => $this->input->post('dag_por_k') ? $this->input->post('dag_por_k') : 0,
            'dag_por_lc'  => $this->input->post('dag_por_lc') ? $this->input->post('dag_por_lc') : 0,
            'dag_por_g'   => $this->input->post('dag_por_g') ? $this->input->post('dag_por_g') : 0,
            'pdar_land_n' => $this->input->post('pdar_land_n'),
            'pdar_land_s' => $this->input->post('pdar_land_s'),
            'pdar_land_e' => $this->input->post('pdar_land_e'),
            'pdar_land_w' => $this->input->post('pdar_land_w'),
            'pdar_land_acre' => 0,
            'pdar_land_revenue' => $this->input->post('pdar_land_revenue') ? $this->input->post('pdar_land_revenue') : 0,
            'pdar_land_localtax' => $this->input->post('pdar_land_localtax') ? $this->input->post('pdar_land_localtax') : 0,
            'p_flag' => $this->input->post('p_flag'),
            'jama_yn' => 'n'
        );
        $this->db->where(array('dist_code' => $dcode, 'subdiv_code' => $scode, 'cir_code' => $ccode, 'mouza_pargona_code' => $mcode, 'lot_no' => $lcode, 'vill_townprt_code' => $vcode, 'dag_no' => $dagno, 'pdar_id' => $pid, 'patta_no' => $patta, 'patta_type_code' => $ptype));
        $data['data_1'] = $this->security->xss_clean($data['data']);
        $nrows = $this->db->update('chitha_dag_pattadar', $data['data_1']);
        $data['data'] = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'pdar_id' => $this->input->post('pdar_id'),
            'patta_no' => $this->input->post('patta_no'),
            'patta_type_code' => $this->input->post('patta_type_code'),
            'pdar_name' => $this->input->post('pdar_name'),
            'pdar_gender' => $this->input->post('p_gender'),
            'pdar_guard_reln' => $this->input->post('pdar_relation'),
            'pdar_father' => $this->input->post('pdar_father'),
            'pdar_add1' => $this->input->post('pdar_add1'),
            'pdar_add2' => $this->input->post('pdar_add2'),
            'pdar_add3' => $this->input->post('pdar_add3'),
            'pdar_pan_no' => $this->input->post('pdar_pan_no'),
            'pdar_citizen_no' => $this->input->post('pdar_citizen_no'),
            'jama_yn' => 'n'
        );
        if ($this->db->field_exists('pdar_relation', 'chitha_pattadar')) {
            $data['data']['pdar_relation'] =  $this->input->post('pdar_relation');
        }
        $this->db->where(array('dist_code' => $dcode, 'subdiv_code' => $scode, 'cir_code' => $ccode, 'mouza_pargona_code' => $mcode, 'lot_no' => $lcode, 'vill_townprt_code' => $vcode, 'pdar_id' => $pid, 'patta_no' => $patta, 'patta_type_code' => $ptype));
        $data['data_1'] = $this->security->xss_clean($data['data']);
        $this->db->update('chitha_pattadar', $data['data_1']);
        $nrows = $this->db->affected_rows();
        return $nrows;
        //}

    }

    function occupnm($patta_no, $pattatype, $dag_no)
    {

        $sql = "select a.pdar_id,a.pdar_name,a.pdar_father,a.pdar_relation,b.dag_por_b,b.dag_por_k,b.dag_por_lc from chitha_pattadar as a join chitha_dag_pattadar as b on a.patta_no=b.patta_no and a.patta_type_code=b.patta_type_code and a.dist_code=b.dist_code and a.subdiv_code=b.subdiv_code and a.cir_code=b.cir_code and a.mouza_pargona_code=b.mouza_pargona_code and a.lot_no=b.lot_no and a.vill_townprt_code=b.vill_townprt_code and a.pdar_id=b.pdar_id where b.dag_no='$dag_no' and a.patta_no='$patta_no' and a.patta_type_code='$pattatype'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function insertdag($is_svamitva = false)
    {
        $dag_no = $this->input->post('dag_no');
        $dag_no_int = $dag_no * 100;
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');


        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and  dag_no='$dag_no')";
        $this->db->select('dag_no,patta_no');
        $query = $this->db->get_where('chitha_basic', $where);
        if ($query->num_rows() == 0) {
            $details = array(
                'dist_code' => $dcode,
                'subdiv_code' => $scode,
                'cir_code' => $ccode,
                'mouza_pargona_code' => $mcode,
                'lot_no' => $lcode,
                'vill_townprt_code' => $vcode,
                'old_dag_no' => $this->input->post('old_dag_no'),
                'dag_no'     => $dag_no,
                'dag_no_int' => $dag_no_int,
                'patta_type_code' => $this->input->post('patta_type_code'),
                'patta_no'        => $this->input->post('patta_no'),
                'land_class_code' => $this->input->post('land_class_code'),
                'dag_area_b'    => $this->input->post('dag_area_b'),
                'dag_area_k'    => $this->input->post('dag_area_k'),
                'dag_area_lc'   => $this->input->post('dag_area_lc'),
                'dag_area_g'    => $this->input->post('dag_area_g') ? $this->input->post('dag_area_g') : 0,
                'dag_area_are'  => $this->input->post('dag_area_r'),
                'dag_revenue'   => $this->input->post('dag_land_revenue'),
                'dag_local_tax' => $this->input->post('dag_local_tax'),
                'dag_n_desc'    => $this->input->post('dag_n_desc'),
                'dag_s_desc'    => $this->input->post('dag_s_desc'),
                'dag_e_desc'    => $this->input->post('dag_e_desc'),
                'dag_w_desc'    => $this->input->post('dag_w_desc'),
                'dag_n_dag_no'  => $this->input->post('dag_n_dag_no'),
                'dag_s_dag_no'  => $this->input->post('dag_s_dag_no'),
                'dag_e_dag_no'  => $this->input->post('dag_e_dag_no'),
                'dag_w_dag_no'  => $this->input->post('dag_w_dag_no'),
                'dag_area_kr'   => '00',
                'dag_nlrg_no'   => $this->input->post('dag_nlrg_no'),
                'dp_flag_yn'    => $this->input->post('dp_flag_yn'),
                'user_code'     => $this->session->userdata('usercode'),
                'date_entry'    => date("Y-m-d | h:i:sa"),
                'operation'     => 'E',
                'jama_yn'       => 'n',

                'old_patta_no'      => $this->input->post('patta_no_old'),

            );
            if ($is_svamitva) {
                $details['status']       = 'S';
            }
            if ($this->input->post('zonal_value')) {
                $details['zonal_value']       = $this->input->post('zonal_value');
            }
            if ($this->input->post('police_station')) {
                $details['police_station']       = $this->input->post('police_station');
            }
            if ($this->input->post('revenue_paid_upto')) {
                $details['revenue_paid_upto']       = $this->input->post('revenue_paid');
            }
            if ($this->session->userdata('block_code')) {
                $details['block_code']       = $this->session->userdata('block_code');
            }
            if ($this->session->userdata('gram_panch_code')) {
                $details['gp_code']       = $this->session->userdata('gram_panch_code');
            }
            $data = $this->security->xss_clean($details);
            $nrows = $this->db->insert('chitha_basic', $details);
            return $nrows;
        } else {

            $details = array(
                'old_dag_no' => $this->input->post('old_dag_no'),
                'patta_type_code' => $this->input->post('patta_type_code'),
                'patta_no' => $this->input->post('patta_no'),
                'land_class_code' => $this->input->post('land_class_code'),
                'dag_area_b' => $this->input->post('dag_area_b'),
                'dag_area_k' => $this->input->post('dag_area_k'),
                'dag_area_lc' => $this->input->post('dag_area_lc'),
                'dag_area_g'  => $this->input->post('dag_area_g') ? $this->input->post('dag_area_g') : 0,
                'dag_area_are'  => $this->input->post('dag_area_r'),
                'dag_revenue'   => $this->input->post('dag_land_revenue'),
                'dag_local_tax' => $this->input->post('dag_local_tax'),
                'dag_n_desc' => $this->input->post('dag_n_desc'),
                'dag_s_desc' => $this->input->post('dag_s_desc'),
                'dag_e_desc' => $this->input->post('dag_e_desc'),
                'dag_w_desc' => $this->input->post('dag_w_desc'),
                'dag_n_dag_no' => $this->input->post('dag_n_dag_no'),
                'dag_s_dag_no' => $this->input->post('dag_s_dag_no'),
                'dag_e_dag_no' => $this->input->post('dag_e_dag_no'),
                'dag_w_dag_no' => $this->input->post('dag_w_dag_no'),
                'dag_area_kr' => '0',
                'dag_nlrg_no' => $this->input->post('dag_nlrg_no'),
                'dp_flag_yn'  => $this->input->post('dp_flag_yn'),
                'user_code'   => $this->session->userdata('usercode'),
                'date_entry'  => date("Y-m-d | h:i:sa"),

                'old_patta_no'      => $this->input->post('patta_no_old'),
                'jama_yn' => 'n',

            );
            if ($is_svamitva) {
                $details['status']       = 'S';
            }
            if ($this->input->post('zonal_value')) {
                $details['zonal_value']       = $this->input->post('zonal_value');
            }
            if ($this->input->post('police_station')) {
                $details['police_station']       = $this->input->post('police_station');
            }
            if ($this->input->post('revenue_paid_upto')) {
                $details['revenue_paid_upto']       = $this->input->post('revenue_paid');
            }
            if ($this->session->userdata('block_code')) {
                $details['block_code']       = $this->session->userdata('block_code');
            }
            if ($this->session->userdata('gram_panch_code')) {
                $details['gp_code']       = $this->session->userdata('gram_panch_code');
            }
            $this->db->where(array('dist_code' => $dcode, 'subdiv_code' => $scode, 'cir_code' => $ccode, 'mouza_pargona_code' => $mcode, 'lot_no' => $lcode, 'vill_townprt_code' => $vcode, 'dag_no' => $dag_no));
            $data = $this->security->xss_clean($details);
            $nrows = $this->db->update('chitha_basic', $data);
            return $nrows;
        }
    }

    function insertpattadar()
    {

        $data['data'] = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->input->post('dag_no'),
            'pdar_id' => $this->input->post('pdar_id'),
            'patta_no' => $this->input->post('patta_no'),
            'patta_type_code' => $this->input->post('patta_type_code'),
            'dag_por_b' => $this->input->post('dag_por_b') ? $this->input->post('dag_por_b') : 0,
            'dag_por_k' => $this->input->post('dag_por_k') ? $this->input->post('dag_por_k') : 0,
            'dag_por_lc' => $this->input->post('dag_por_lc') ?: 0,
            'dag_por_g' =>  $this->input->post('dag_por_g') ? $this->input->post('dag_por_g') : 0,
            'pdar_land_n' => $this->input->post('pdar_land_n'),
            'pdar_land_s' => $this->input->post('pdar_land_s'),
            'pdar_land_e' => $this->input->post('pdar_land_e'),
            'pdar_land_w' => $this->input->post('pdar_land_w'),
            'pdar_land_acre' => $this->input->post('pdar_land_acre') ? $this->input->post('pdar_land_acre') : 0,
            'pdar_land_revenue' => $this->input->post('pdar_land_revenue') ? $this->input->post('pdar_land_revenue') : 0,
            'pdar_land_localtax' => $this->input->post('pdar_land_localtax') ? $this->input->post('pdar_land_localtax') : 0,
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E',
            'p_flag' => $this->input->post('p_flag'),
            'jama_yn' => 'n',

        );
        $data['data_1'] = $this->security->xss_clean($data['data']);
        $this->db->insert('chitha_dag_pattadar', $data['data_1']);

        $data['data3'] = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'pdar_id' => $this->input->post('pdar_id'),
            'patta_no' => $this->input->post('patta_no'),
            'patta_type_code' => $this->input->post('patta_type_code'),
            'pdar_name' => $this->input->post('pdar_name'),
            'pdar_guard_reln' => $this->input->post('pdar_relation'),
            'pdar_father' => $this->input->post('pdar_father'),
            'pdar_add1' => $this->input->post('pdar_add1'),
            'pdar_add2' => $this->input->post('pdar_add2'),
            'pdar_add3' => $this->input->post('pdar_add3'),
            'pdar_pan_no' => $this->input->post('pdar_pan_no'),
            'pdar_citizen_no' => $this->input->post('pdar_citizen_no'),
            'pdar_gender' => $this->input->post('p_gender'),
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'o',
            'jama_yn' => 'n',
        );

        if ($this->db->field_exists('pdar_relation', 'chitha_pattadar')) {
            $data['data3']['pdar_relation'] =  $this->input->post('pdar_relation');
        }

        $data['data_2'] = $this->security->xss_clean($data['data3']);
        $this->db->insert('chitha_pattadar', $data['data_2']);
        $nrows = $this->db->affected_rows();
        return $nrows;
    }

    function insertcol8order()
    {

        $deed_value = $this->input->post('deed_value');
        if (!$deed_value) {
            $deed_value = '0.0000';
        }
        $deed_date = $this->input->post('deed_date');
        if (!$deed_date) {
            $deed_date = '1900-01-01';
        }
        $data['data'] = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->input->post('dag_no'),
            'col8order_cron_no' => $this->input->post('col8order_cron_no'),
            'order_pass_yn' => $this->input->post('order_pass_yn'),
            'order_type_code' => $this->input->post('order_type_code'),
            'nature_trans_code' => $this->input->post('nature_trans_code'),
            'lm_code' => $this->input->post('lm_code'),
            'lm_sign_yn' => $this->input->post('lm_sign_yn'),
            'lm_note_date' => $this->input->post('lm_note_date'),
            'co_code' => $this->input->post('co_code'),
            'co_sign_yn' => $this->input->post('co_sign_yn'),
            'co_ord_date' => $this->input->post('co_ord_date'),
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E',
            'jama_updated' => 'n',
            'deed_reg_no' => $this->input->post('deed_reg_no'),
            'deed_value' => $deed_value,
            'deed_date' => $deed_date,
            'case_no' => $this->input->post('case_no'),
            'mut_land_area_b' => 0,
            'mut_land_area_k' => 0,
            'mut_land_area_lc' => 0,
            'mut_land_area_g' => 0,
            'mut_land_area_kr' => 0,
            'land_area_left_b' => 0,
            'land_area_left_k' => 0,
            'land_area_left_lc' => 0,
            'land_area_left_g' => 0,
            'land_area_left_kr' => 0,


        );
        $data['data_1'] = $this->security->xss_clean($data['data']);
        $this->db->insert('chitha_col8_order', $data['data_1']);
        $nrows = $this->db->affected_rows();
        return $nrows;
    }

    function insertcol8occup()
    {
        $data['data'] = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->input->post('dag_no'),
            'col8order_cron_no' => $this->input->post('col8order_cron_no'),
            'occupant_id' => $this->input->post('occupant_id'),
            'occupant_name' => $this->input->post('occupantnm'),
            'occupant_fmh_name' => $this->input->post('occupant_fmh_name'),
            'occupant_fmh_flag' => $this->input->post('occupant_fmh_flag'),
            'occupant_add1' => $this->input->post('occupant_add1'),
            'occupant_add2' => $this->input->post('occupant_add2'),
            'occupant_add3' => $this->input->post('occupant_add3'),
            'land_area_b' => $this->input->post('land_area_b'),
            'land_area_k' => $this->input->post('land_area_k'),
            'land_area_lc' => $this->input->post('land_area_lc'),
            'land_area_g' => $this->input->post('land_area_g'),
            'land_area_kr' => 0,
            'old_patta_no' => $this->input->post('old_patta_no'),
            'new_patta_no' => $this->input->post('new_patta_no'),
            'old_dag_no' => $this->input->post('old_dag_no'),
            'new_dag_no' => $this->input->post('new_dag_no'),
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E',
            'chitha_up' => 'n',

        );
        $data['data_1'] = $this->security->xss_clean($data['data']);
        $this->db->insert('chitha_col8_occup', $data['data_1']);
        $nrows = $this->db->affected_rows();
        return $nrows;
    }

    function insertcol8inplace()
    {
        $data['data'] = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->input->post('dag_no'),
            'col8order_cron_no' => $this->input->post('col8order_cron_no'),
            'inplace_of_id' => $this->input->post('inplace_of_id'),
            'inplaceof_alongwith' => $this->input->post('inplaceof_alongwith'),
            'inplace_of_name' => $this->input->post('inplace_of_name'),
            'land_area_b' => $this->input->post('land_area_b'),
            'land_area_k' => $this->input->post('land_area_k'),
            'land_area_lc' => $this->input->post('land_area_lc'),
            'land_area_g' => $this->input->post('land_area_g'),
            'land_area_kr' => 0,
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E',

        );
        $data['data_1'] = $this->security->xss_clean($data['data']);
        $this->db->insert('chitha_col8_inplace', $data['data_1']);
        $nrows = $this->db->affected_rows();
        return $nrows;
    }

    function relname()
    {
        $this->db->select('guard_rel,guard_rel_desc_as');
        $query = $this->db->get_where('master_guard_rel');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function tentype()
    {
        $this->db->select('type_code,tenant_type');
        $query = $this->db->get_where('tenant_type');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function checktenantid()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');
        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and trim(dag_no)=trim('$dag_no'))";
        $this->db->select_max('tenant_id', 'max');
        $query = $this->db->get_where('chitha_tenant', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    function inserttenant()
    {

        $details = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->session->userdata('dag_no'),
            'tenant_id' => $this->input->post('tenant_id'),
            'tenant_name' => $this->input->post('tenant_name'),
            'tenants_father' => $this->input->post('tenants_father'),
            'relation' => $this->input->post('guard_rel'),
            'tenants_add1' => $this->input->post('tenants_add1'),
            'tenants_add2' => $this->input->post('tenants_add2'),
            'tenants_add3' => $this->input->post('tenants_add3'),
            'type_of_tenant' => $this->input->post('type_of_tenant'),
            'khatian_no' => $this->input->post('khatian_no'),
            'revenue_tenant' => $this->input->post('revenue_tenant'),
            'crop_rate' => $this->input->post('crop_rate'),
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E',
            'status' => 'O',
            'year_no' => '2021',
            'possession_area_b' => $this->input->post('possession_area_b'),
            'possession_area_k' => $this->input->post('possession_area_k'),
            'possession_area_l' => $this->input->post('possession_area_l'),
            'possession_area_g' => $this->input->post('possession_area_g') ? $this->input->post('possession_area_g') : 0,
            'possession_length' => $this->input->post('possession_length'),
            'tenant_status' => $this->input->post('tenant_status'),
            'paid_cash_kind' => $this->input->post('paid_cash_kind'),
            'payable_cash_kind' => $this->input->post('payable_cash_kind'),
            'special_condition' => $this->input->post('special_condition'),
            'remark' => $this->input->post('remark')
        );
        $data = $this->security->xss_clean($details);
        $nrows = $this->db->insert('chitha_tenant', $data);
        return $nrows;
    }

    public function tenidsub()
    {
        //$this->db->select('tenant_id,tenant_name');
        //$query=$this->db->get_where('chitha_tenant');
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');

        //$query = $this->db->query("select tenant_id,tenant_name from chitha_tenant");// where dist_code='24' and subdiv_code='01' and cir_code='01' and mouza_pargona_code='01' and lot_no='01' and vill_townprt_code='10001' and dag_no='01'");
        $query = $this->db->query("select tenant_id,tenant_name from chitha_tenant where dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and trim(dag_no)=trim('$dag_no')");
        //$query="(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and trim(dag_no)=trim('$dag_no'))";
        return $query->result();
    }

    function checksubtenantid()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');
        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and trim(dag_no)=trim('$dag_no'))";
        $this->db->select_max('subtenant_id', 'max');
        $query = $this->db->get_where('chitha_subtenant', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    public function insertsubtenant()
    {

        $details = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->session->userdata('dag_no'),
            'subtenant_id' => $this->input->post('subtenant_id'),
            'tenant_id' => $this->input->post('tenantid'),
            'subtenant_name' => $this->input->post('subtennm'),
            'subtenants_father' => $this->input->post('subtenants_father'),
            'relation' => $this->input->post('guard_rel'),
            'subtenants_add1' => $this->input->post('subtenants_add1'),
            'subtenants_add2' => $this->input->post('subtenants_add2'),
            'subtenants_add3' => $this->input->post('subtenants_add3'),
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E',
            'year_no' => '2021'
        );
        $data = $this->security->xss_clean($details);
        $nrows = $this->db->insert('chitha_subtenant', $details);
        return $nrows;
    }

    function cropname()
    {
        $this->db->select('crop_code,crop_name');
        $query = $this->db->get_where('crop_code');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function cropcat()
    {
        $this->db->select('crop_categ_code,crop_categ_desc');
        $query = $this->db->get_where('crop_category_code');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function cropseason()
    {
        $this->db->select('season_code,crop_season');
        $query = $this->db->get_where('crop_season');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function watersource()
    {
        $this->db->select('water_source_code,source');
        $query = $this->db->get_where('source_water');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function checkcropid()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');
        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and trim(dag_no)=trim('$dag_no'))";
        $this->db->select_max('crop_sl_no', 'max');
        $query = $this->db->get_where('chitha_mcrop', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    function insertcrop()
    {
        $details = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->session->userdata('dag_no'),
            'crop_sl_no' => $this->input->post('cropslno'),
            'yearno' => $this->input->post('yearno'),
            'crop_code' => $this->input->post('cropname'),
            'crop_season' => $this->input->post('cropseason'),
            'source_of_water' => $this->input->post('sourcewater'),
            'crop_land_area_b' => $this->input->post('croparea_b'),
            'crop_land_area_k' => $this->input->post('croparea_k'),
            'crop_land_area_lc' => $this->input->post('croparea_lc'),
            'crop_land_area_g' => 0,
            'crop_land_area_kr' => 0,
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E',
            'crop_categ_code' => $this->input->post('cropcatg')
        );
        //var_dump($details);
        $data = $this->security->xss_clean($details);
        $nrows = $this->db->insert('chitha_mcrop', $details);
        return $nrows;
    }

    function ncropname()
    {
        $this->db->select('used_noncrop_type_code,noncrop_type');
        $query = $this->db->get_where('used_noncrop_type');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function checknoncropid()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');
        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and trim(dag_no)=trim('$dag_no'))";
        $this->db->select_max('noncrop_use_id', 'max');
        $query = $this->db->get_where('chitha_noncrop', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    function insertnoncrop()
    {
        $details = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->session->userdata('dag_no'),
            'noncrop_use_id' => $this->input->post('ncropslno'),
            'yn' => $this->input->post('yearno'),
            'type_of_used_noncrop' => $this->input->post('ncropcode'),
            'noncrop_land_area_b' => $this->input->post('ncroparea_b'),
            'noncrop_land_area_k' => $this->input->post('ncroparea_k'),
            'noncrop_land_area_lc' => $this->input->post('ncroparea_lc'),
            'noncrop_land_area_g' => 0,
            'noncrop_land_area_kr' => 0,
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E'
        );
        //var_dump($details);
        $data = $this->security->xss_clean($details);
        $nrows = $this->db->insert('chitha_noncrop', $details);
        return $nrows;
    }

    function fruitname()
    {
        $this->db->select('fruit_code,fruit_name');
        $query = $this->db->get_where('fruit_tree_code');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    function checkfruitid()
    {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $lot_no = $this->session->userdata('lot_no');
        $vill_townprt_code = $this->session->userdata('vill_townprt_code');
        $dag_no = $this->session->userdata('dag_no');
        $where = "(dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and trim(dag_no)=trim('$dag_no'))";
        $this->db->select_max('fruit_plant_id', 'max');
        $query = $this->db->get_where('chitha_fruit', $where);
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max == 0 ? 1 : $max + 1;
    }

    function insertfruit()
    {
        $details = array(
            'dist_code' => $this->session->userdata('dist_code'),
            'subdiv_code' => $this->session->userdata('subdiv_code'),
            'cir_code' => $this->session->userdata('cir_code'),
            'mouza_pargona_code' => $this->session->userdata('mouza_pargona_code'),
            'lot_no' => $this->session->userdata('lot_no'),
            'vill_townprt_code' => $this->session->userdata('vill_townprt_code'),
            'dag_no' => $this->session->userdata('dag_no'),
            'fruit_plant_id' => $this->input->post('frplantid'),
            'fruit_plants_name' => $this->input->post('frname'),
            'no_of_plants' => $this->input->post('fplantno'),
            //'fruit_land_area_b'=> 0,
            //'fruit_land_area_k'=> 0,
            //'fruit_land_area_lc'=> 0,
            //'fruit_land_area_g'=> 0,
            //'fruit_land_area_kr'=> 0,
            'user_code' => $this->session->userdata('usercode'),
            'date_entry' => date("Y-m-d | h:i:sa"),
            'operation' => 'E'
        );
        //var_dump($details);
        $data = $this->security->xss_clean($details);
        $nrows = $this->db->insert('chitha_fruit', $details);
        return $nrows;
    }

    public function getlocationnames($dist, $sub, $cir, $mouza, $lot, $village)
    {

        $location['dist_name'] = $this->db->select('loc_name')->where(array('dist_code' => $dist, 'subdiv_code' => '00', 'cir_code' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->get('location')->row_array();
        $location['subdiv_name'] = $this->db->select('loc_name')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => '00', 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->get('location')->row_array();
        $location['cir_name'] = $this->db->select('loc_name')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => $cir, 'mouza_pargona_code' => '00', 'lot_no' => '00', 'vill_townprt_code' => '00000'))->get('location')->row_array();
        $location['mouza_name'] = $this->db->select('loc_name')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => $cir, 'mouza_pargona_code' => $mouza, 'lot_no' => '00', 'vill_townprt_code' => '00000'))->get('location')->row_array();
        $location['lot'] = $this->db->select('loc_name')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => $cir, 'mouza_pargona_code' => $mouza, 'lot_no' => $lot, 'vill_townprt_code' => '00000'))->get('location')->row_array();
        $location['village'] = $this->db->select('loc_name')->where(array('dist_code' => $dist, 'subdiv_code' => $sub, 'cir_code' => $cir, 'mouza_pargona_code' => $mouza, 'lot_no' => $lot, 'vill_townprt_code' => $village))->get('location')->row_array();

        return $location;
    }

    function gettenants()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');
        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and dag_no='$dagno')";
        $this->db->select('tenant_id,tenant_name,tenants_father,dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,dag_no');
        $this->db->order_by('tenant_id');
        $query = $this->db->get_where('chitha_tenant', $where);
        return $query->result();
    }


    function idtendet($nm)
    {
        $tn = explode("-", $nm);
        $tid = $tn[0];
        $dagno = $tn[1];
        $dcode = $tn[2];
        $scode = $tn[3];
        $ccode = $tn[4];
        $mcode = $tn[5];
        $lcode = $tn[6];
        $vcode = $tn[7];

        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and dag_no='$dagno' and tenant_id=$tid)";
        $this->db->select('tenant_id,tenant_name,tenants_father,relation,tenants_add1,tenants_add2,tenants_add3,type_of_tenant,khatian_no,revenue_tenant,crop_rate');
        $query = $this->db->get_where('chitha_tenant', $where);
        //return $query->result();
        $row = $query->row_array();
        $tnid = $row['tenant_id'];
        $tnme = $row['tenant_name'];
        $tfme = $row['tenants_father'];
        $trel = $row['relation'];
        $tad1 = $row['tenants_add1'];
        $tad2 = $row['tenants_add2'];
        $tad3 = $row['tenants_add3'];
        $ttyp = $row['type_of_tenant'];
        $khno = $row['khatian_no'];
        $trev = $row['revenue_tenant'];
        $crte = $row['crop_rate'];
        return $tdet = $tnid . '$' . $tnme . '$' . $tfme . '$' . $trel . '$' . $tad1 . '$' . $tad2 . '$' . $tad3 . '$' . $ttyp . '$' . $khno . '$' . $trev . '$' . $crte;
    }

    public function getTenant($loc)
    {
        $tn = explode("-", $loc);
        $tid = $tn[0];
        $dagno = $tn[1];
        $dcode = $tn[2];
        $scode = $tn[3];
        $ccode = $tn[4];
        $mcode = $tn[5];
        $lcode = $tn[6];
        $vcode = $tn[7];

        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and dag_no='$dagno' and tenant_id=$tid)";
        $this->db->select('tenant_id,tenant_name,tenants_father,relation,tenants_add1,tenants_add2,tenants_add3,type_of_tenant,khatian_no,revenue_tenant,crop_rate,possession_area_b,possession_area_k,possession_area_l,possession_area_g,possession_length,tenant_status,paid_cash_kind,payable_cash_kind,special_condition,remark');
        $query = $this->db->get_where('chitha_tenant', $where);
        return $query->row();
    }

    function updatetenant()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');
        $tenid = $this->input->post('tenant_id');

        $details = array(
            'tenant_name' => $this->input->post('tenant_name'),
            'tenants_father' => $this->input->post('tenants_father'),
            'relation' => $this->input->post('guard_rel'),
            'tenants_add1' => $this->input->post('tenants_add1'),
            'tenants_add2' => $this->input->post('tenants_add2'),
            'tenants_add3' => $this->input->post('tenants_add3'),
            'type_of_tenant' => $this->input->post('type_of_tenant'),
            'khatian_no' => $this->input->post('khatian_no'),
            'revenue_tenant' => $this->input->post('revenue_tenant'),
            'crop_rate' => $this->input->post('crop_rate'),
            'possession_area_b' => $this->input->post('possession_area_b'),
            'possession_area_k' => $this->input->post('possession_area_k'),
            'possession_area_l' => $this->input->post('possession_area_l'),
            'possession_area_g' => $this->input->post('possession_area_g') ? $this->input->post('possession_area_g') : 0,
            'possession_length' => $this->input->post('possession_length'),
            'tenant_status' => $this->input->post('tenant_status'),
            'paid_cash_kind' => $this->input->post('paid_cash_kind'),
            'payable_cash_kind' => $this->input->post('payable_cash_kind'),
            'special_condition' => $this->input->post('special_condition'),
            'remark' => $this->input->post('remark')
        );
        $this->db->where(array('dist_code' => $dcode, 'subdiv_code' => $scode, 'cir_code' => $ccode, 'mouza_pargona_code' => $mcode, 'lot_no' => $lcode, 'vill_townprt_code' => $vcode, 'dag_no' => $dagno, 'tenant_id' => $tenid));
        $data = $this->security->xss_clean($details);
        $nrows = $this->db->update('chitha_tenant', $data);
        return $nrows;
    }








    // ******* newly by Masud Reza 11/05/2022

    function getSubTenants()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');
        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and dag_no='$dagno')";
        $this->db->select('chitha_subtenant.*');
        $this->db->order_by('subtenant_id');
        $query = $this->db->get_where('chitha_subtenant', $where);
        return $query->result();
    }

    function idSubTenantDetails($nm)
    {
        $tn = explode("-", $nm);
        $tid = $tn[0];
        $dagno = $tn[1];
        $dcode = $tn[2];
        $scode = $tn[3];
        $ccode = $tn[4];
        $mcode = $tn[5];
        $lcode = $tn[6];
        $vcode = $tn[7];

        $where = "(dist_code='$dcode' and subdiv_code='$scode' and cir_code='$ccode' and mouza_pargona_code='$mcode' and lot_no='$lcode' and vill_townprt_code='$vcode' and dag_no='$dagno' and subtenant_id=$tid)";
        $this->db->select('chitha_subtenant.*');
        $query = $this->db->get_where('chitha_subtenant', $where);
        //return $query->result();
        $row = $query->row_array();
        $tnid = $row['subtenant_id'];
        $tnme = $row['subtenant_name'];
        $tfme = $row['subtenants_father'];
        $trel = $row['relation'];
        $tad1 = $row['subtenants_add1'];
        $tad2 = $row['subtenants_add2'];
        $tad3 = $row['subtenants_add3'];
        return $tdet = $tnid . '$' . $tnme . '$' . $tfme . '$' . $trel . '$' . $tad1 . '$' . $tad2 . '$' . $tad3;
    }

    function updateSubTenant()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');
        $tenid = $this->input->post('subTenantId');

        $details = array(
            'subtenant_name'  => $this->input->post('subTenantName'),
            'subtenants_father' => $this->input->post('subTenantsFather'),
            'relation' => $this->input->post('guard_rel'),
            'subtenants_add1' => $this->input->post('subTenants_add1'),
            'subtenants_add2' => $this->input->post('subTenants_add2'),
            'subtenants_add3' => $this->input->post('subTenants_add3'),

        );
        $this->db->where(array('dist_code' => $dcode, 'subdiv_code' => $scode, 'cir_code' => $ccode, 'mouza_pargona_code' => $mcode, 'lot_no' => $lcode, 'vill_townprt_code' => $vcode, 'dag_no' => $dagno, 'subtenant_id' => $tenid));
        $data = $this->security->xss_clean($details);
        $nrows = $this->db->update('chitha_subtenant', $data);
        return $nrows;
    }



    function getCropList()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');

        $this->db->select('chitha_mcrop.*,crop_code.crop_name,
        crop_category_code.crop_categ_desc,crop_season.crop_season');
        $this->db->where('chitha_mcrop.dist_code', $dcode);
        $this->db->where('chitha_mcrop.subdiv_code', $scode);
        $this->db->where('chitha_mcrop.cir_code', $ccode);
        $this->db->where('chitha_mcrop.mouza_pargona_code', $mcode);
        $this->db->where('chitha_mcrop.lot_no', $lcode);
        $this->db->where('chitha_mcrop.vill_townprt_code', $vcode);
        $this->db->where('chitha_mcrop.dag_no', $dagno);
        $this->db->from('chitha_mcrop');
        $this->db->join('crop_code', 'crop_code.crop_code=chitha_mcrop.crop_code');
        $this->db->join('crop_category_code', 'crop_category_code.crop_categ_code=chitha_mcrop.crop_categ_code');
        $this->db->join('crop_season', 'crop_season.season_code=chitha_mcrop.crop_season');
        $this->db->order_by('chitha_mcrop.crop_sl_no', 'asc');
        $allCrop = $this->db->get();
        return $allCrop->result();
    }

    function cropDetailsWithId($crId)
    {
        $tn = explode("-", $crId);
        $tid  = $tn[0];
        $dagno = $tn[1];
        $dcode = $tn[2];
        $scode = $tn[3];
        $ccode = $tn[4];
        $mcode = $tn[5];
        $lcode = $tn[6];
        $vcode = $tn[7];

        $this->db->select('chitha_mcrop.*');
        $this->db->where('chitha_mcrop.dist_code', $dcode);
        $this->db->where('chitha_mcrop.subdiv_code', $scode);
        $this->db->where('chitha_mcrop.cir_code', $ccode);
        $this->db->where('chitha_mcrop.mouza_pargona_code', $mcode);
        $this->db->where('chitha_mcrop.lot_no', $lcode);
        $this->db->where('chitha_mcrop.vill_townprt_code', $vcode);
        $this->db->where('chitha_mcrop.dag_no', $dagno);
        $this->db->where('chitha_mcrop.crop_sl_no', $tid);
        $this->db->from('chitha_mcrop');
        $row = $this->db->get()->row();

        return $row;
    }

    function updateCropDetails()
    {
        $dcode  = $this->session->userdata('dist_code');
        $scode  = $this->session->userdata('subdiv_code');
        $ccode  = $this->session->userdata('cir_code');
        $mcode  = $this->session->userdata('mouza_pargona_code');
        $lcode  = $this->session->userdata('lot_no');
        $vcode  = $this->session->userdata('vill_townprt_code');
        $dagno  = $this->session->userdata('dag_no');
        $cropId = $this->input->post('cropslno');

        $details = array(
            'yearno'            => $this->input->post('yearno'),
            'crop_code'         => $this->input->post('cropname'),
            'crop_season'       => $this->input->post('cropseason'),
            'source_of_water'   => $this->input->post('sourcewater'),
            'crop_land_area_b'  => $this->input->post('croparea_b'),
            'crop_land_area_k'  => $this->input->post('croparea_k'),
            'crop_land_area_lc' => $this->input->post('croparea_lc'),
            'crop_categ_code'   => $this->input->post('cropcatg'),
        );

        $this->db->where(array(
            'dist_code' => $dcode, 'subdiv_code' => $scode, 'cir_code' => $ccode, 'mouza_pargona_code' => $mcode, 'lot_no' => $lcode, 'vill_townprt_code' => $vcode, 'dag_no' => $dagno,
            'crop_sl_no' => $cropId
        ));
        $data = $this->security->xss_clean($details);
        $nrows = $this->db->update('chitha_mcrop', $data);
        return $nrows;
    }



    function getNonCropList()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');

        $this->db->select('chitha_noncrop.*,used_noncrop_type.noncrop_type,');
        $this->db->where('chitha_noncrop.dist_code', $dcode);
        $this->db->where('chitha_noncrop.subdiv_code', $scode);
        $this->db->where('chitha_noncrop.cir_code', $ccode);
        $this->db->where('chitha_noncrop.mouza_pargona_code', $mcode);
        $this->db->where('chitha_noncrop.lot_no', $lcode);
        $this->db->where('chitha_noncrop.vill_townprt_code', $vcode);
        $this->db->where('chitha_noncrop.dag_no', $dagno);
        $this->db->from('chitha_noncrop');
        $this->db->join('used_noncrop_type', 'used_noncrop_type.used_noncrop_type_code=chitha_noncrop.type_of_used_noncrop');
        $this->db->order_by('chitha_noncrop.noncrop_use_id', 'asc');
        $allNonCrop = $this->db->get();
        return $allNonCrop->result();
    }

    function nonCropDetailsWithId($ncId)
    {
        $tn = explode("-", $ncId);
        $tid  = $tn[0];
        $dagno = $tn[1];
        $dcode = $tn[2];
        $scode = $tn[3];
        $ccode = $tn[4];
        $mcode = $tn[5];
        $lcode = $tn[6];
        $vcode = $tn[7];

        $this->db->select('chitha_noncrop.*');
        $this->db->where('chitha_noncrop.dist_code', $dcode);
        $this->db->where('chitha_noncrop.subdiv_code', $scode);
        $this->db->where('chitha_noncrop.cir_code', $ccode);
        $this->db->where('chitha_noncrop.mouza_pargona_code', $mcode);
        $this->db->where('chitha_noncrop.lot_no', $lcode);
        $this->db->where('chitha_noncrop.vill_townprt_code', $vcode);
        $this->db->where('chitha_noncrop.dag_no', $dagno);
        $this->db->where('chitha_noncrop.noncrop_use_id', $tid);
        $this->db->from('chitha_noncrop');
        $row = $this->db->get()->row();

        return $row;
    }

    function updateNonCropDetails()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');
        $ncId  = $this->input->post('ncropslno');

        $details = array(
            'yn' => $this->input->post('yearno'),
            'type_of_used_noncrop' => $this->input->post('ncropcode'),
            'noncrop_land_area_b'  => $this->input->post('ncroparea_b'),
            'noncrop_land_area_k'  => $this->input->post('ncroparea_k'),
            'noncrop_land_area_lc' => $this->input->post('ncroparea_lc'),
        );

        $this->db->where(array(
            'dist_code' => $dcode, 'subdiv_code' => $scode, 'cir_code' => $ccode, 'mouza_pargona_code' => $mcode, 'lot_no' => $lcode, 'vill_townprt_code' => $vcode, 'dag_no' => $dagno,
            'noncrop_use_id' => $ncId
        ));
        $data  = $this->security->xss_clean($details);
        $nrows = $this->db->update('chitha_noncrop', $data);
        return $nrows;
    }



    function getFruitList()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');

        $this->db->select('chitha_fruit.*,fruit_tree_code.fruit_name,');
        $this->db->where('chitha_fruit.dist_code', $dcode);
        $this->db->where('chitha_fruit.subdiv_code', $scode);
        $this->db->where('chitha_fruit.cir_code', $ccode);
        $this->db->where('chitha_fruit.mouza_pargona_code', $mcode);
        $this->db->where('chitha_fruit.lot_no', $lcode);
        $this->db->where('chitha_fruit.vill_townprt_code', $vcode);
        $this->db->where('chitha_fruit.dag_no', $dagno);
        $this->db->from('chitha_fruit');
        $this->db->join('fruit_tree_code', 'fruit_tree_code.fruit_code=chitha_fruit.fruit_plants_name');
        $this->db->order_by('chitha_fruit.fruit_plant_id', 'asc');
        $allNonCrop = $this->db->get();
        return $allNonCrop->result();
    }

    function fruitDetailsWithId($fId)
    {
        $tn = explode("-", $fId);
        $tid  = $tn[0];
        $dagno = $tn[1];
        $dcode = $tn[2];
        $scode = $tn[3];
        $ccode = $tn[4];
        $mcode = $tn[5];
        $lcode = $tn[6];
        $vcode = $tn[7];

        $this->db->select('chitha_fruit.*');
        $this->db->where('chitha_fruit.dist_code', $dcode);
        $this->db->where('chitha_fruit.subdiv_code', $scode);
        $this->db->where('chitha_fruit.cir_code', $ccode);
        $this->db->where('chitha_fruit.mouza_pargona_code', $mcode);
        $this->db->where('chitha_fruit.lot_no', $lcode);
        $this->db->where('chitha_fruit.vill_townprt_code', $vcode);
        $this->db->where('chitha_fruit.dag_no', $dagno);
        $this->db->where('chitha_fruit.fruit_plant_id', $tid);
        $this->db->from('chitha_fruit');
        $row = $this->db->get()->row();

        return $row;
    }

    function updateFruitDetails()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');
        $frId  = $this->input->post('frplantid');

        $details = array(
            'fruit_plants_name' => $this->input->post('frname'),
            'no_of_plants'      => $this->input->post('fplantno'),
        );

        $this->db->where(array(
            'dist_code' => $dcode, 'subdiv_code' => $scode, 'cir_code' => $ccode, 'mouza_pargona_code' => $mcode, 'lot_no' => $lcode, 'vill_townprt_code' => $vcode, 'dag_no' => $dagno,
            'fruit_plant_id' => $frId
        ));
        $data  = $this->security->xss_clean($details);
        $nrows = $this->db->update('chitha_fruit', $data);
        return $nrows;
    }


    // 18/05/2022 Masud Reza
    function landDetails()
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');

        $this->db->select('chitha_basic.*');
        $this->db->where('chitha_basic.dist_code', $dcode);
        $this->db->where('chitha_basic.subdiv_code', $scode);
        $this->db->where('chitha_basic.cir_code', $ccode);
        $this->db->where('chitha_basic.mouza_pargona_code', $mcode);
        $this->db->where('chitha_basic.lot_no', $lcode);
        $this->db->where('chitha_basic.vill_townprt_code', $vcode);
        $this->db->where('chitha_basic.dag_no', $dagno);
        $this->db->from('chitha_basic');
        $row = $this->db->get()->row();

        return $row;
    }

    function landDetailsInCrop($year)
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');

        $this->db->select('chitha_mcrop.*');
        $this->db->where('chitha_mcrop.dist_code', $dcode);
        $this->db->where('chitha_mcrop.subdiv_code', $scode);
        $this->db->where('chitha_mcrop.cir_code', $ccode);
        $this->db->where('chitha_mcrop.mouza_pargona_code', $mcode);
        $this->db->where('chitha_mcrop.lot_no', $lcode);
        $this->db->where('chitha_mcrop.vill_townprt_code', $vcode);
        $this->db->where('chitha_mcrop.dag_no', $dagno);
        $this->db->where('chitha_mcrop.yearno', $year);
        $this->db->from('chitha_mcrop');
        $allCrop = $this->db->get();
        return $allCrop->result();
    }

    function landDetailsInNonCrop($year)
    {
        $dcode = $this->session->userdata('dist_code');
        $scode = $this->session->userdata('subdiv_code');
        $ccode = $this->session->userdata('cir_code');
        $mcode = $this->session->userdata('mouza_pargona_code');
        $lcode = $this->session->userdata('lot_no');
        $vcode = $this->session->userdata('vill_townprt_code');
        $dagno = $this->session->userdata('dag_no');

        $this->db->select('chitha_noncrop.*');
        $this->db->where('chitha_noncrop.dist_code', $dcode);
        $this->db->where('chitha_noncrop.subdiv_code', $scode);
        $this->db->where('chitha_noncrop.cir_code', $ccode);
        $this->db->where('chitha_noncrop.mouza_pargona_code', $mcode);
        $this->db->where('chitha_noncrop.lot_no', $lcode);
        $this->db->where('chitha_noncrop.vill_townprt_code', $vcode);
        $this->db->where('chitha_noncrop.dag_no', $dagno);
        $this->db->where('chitha_noncrop.yn', $year);
        $this->db->from('chitha_noncrop');
        $allCrop = $this->db->get();
        return $allCrop->result();
    }


    public function getPattaNo($dis, $subdiv, $cir, $mza, $lot, $vill)
    {
        $dtype = $this->db->query("Select dag_no from chitha_basic where
        dist_code='$dis' and subdiv_code='$subdiv' and cir_code='$cir' and mouza_pargona_code='$mza' and lot_no='$lot' and vill_townprt_code='$vill' order by dag_no_int asc");

        return $dtype->result();
    }

    public function getVillageuuid($dis, $subdiv, $cir, $mza, $lot, $vill)
    {
        $dtype = $this->db->query("Select uuid from location where
        dist_code='$dis' and subdiv_code='$subdiv' and cir_code='$cir' and mouza_pargona_code='$mza' and lot_no='$lot' and vill_townprt_code='$vill'");

        return $dtype->row();
    }

    public function allData()
    {
        $data = $this->db->query("Select * from supportive_document ");
        return $data->result();
    }

    /** command api */
    public static function callApiV2($url,$method='GET', $data=null)
    {
        $curl = curl_init();
        if($method == 'POST')
        {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_VERBOSE => 1,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                ),
            ));
        }else{
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
        }

        $response = curl_exec($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        if($httpcode != 200)
        {
            log_message("error", 'NCVILLAGE API FAIL #NCAPI0003');
            return false;
        }

        return $response;
    }

    public function getDistrictName($dist_code)
    {
        $this->db = $this->load->database('auth', true);

        $district = $this->db->query("select loc_name AS district from location where dist_code =?  and "
            . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
            . " vill_townprt_code=? and lot_no=?", array($dist_code, '00', '00', '00', '00000', '00'));

        return $district->row()->district;
    }

    public function getSubDivName($dist_code, $subdiv_code)
    {
        $this->db = $this->load->database('auth', true);
        $subdiv = $this->db->query("select loc_name AS subdiv from location where dist_code =?  and "
            . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
            . " vill_townprt_code=? and lot_no=?", array($dist_code, $subdiv_code, '00', '00', '00000', '00'));
        return $subdiv->row()->subdiv;
    }

    public function getCircleName($dist_code, $subdiv_code, $circle_code)
    {
        $this->db = $this->load->database('auth', true);
        $circle = $this->db->query("select loc_name AS circle from location where dist_code =?  and "
            . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
            . " vill_townprt_code=? and lot_no=?", array($dist_code, $subdiv_code, $circle_code, '00', '00000', '00'));

        return $circle->row()->circle;
    }

    //function created for displaying the mouza name
    public function getMouzaName($dist_code, $subdiv_code, $circle_code, $mouza_code)
    {
        $this->db = $this->load->database('auth', true);
        //$ds=$CI->session->userdata['db'];
        $mouza = $this->db->query("select loc_name AS mouza from location where dist_code =?  and "
            . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
            . " vill_townprt_code=? and lot_no=?", array($dist_code, $subdiv_code, $circle_code, $mouza_code, '00000', '00'));
        return $mouza->row()->mouza;
    }
}
