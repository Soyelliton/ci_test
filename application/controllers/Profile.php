<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
        $data                    = array();
        $data['get_all_profile'] = $this->profile_model->get_all_profile();
		$this->load->view('header');
		$this->load->view('home', $data);
		$this->load->view('footer');
	}

    public function add_profile()
	{
        $this->load->view('header');
		$this->load->view('add_profile');
        $this->load->view('footer');
	}

    public function save_profile()
	{

        $data                              = array();
        $date                              = date("d/m/Y");
        $data['date']                      = $date;
        $data['fullname']                  = $this->input->post('name');
        $data['username']                  = $this->input->post('username');
        $data['password']                  = md5($this->input->post('password'));
        $data['email']                     = $this->input->post('email');
        $data['phone']                     = $this->input->post('phone');
        $data['gender']                    = $this->input->post('gender');
        $data['address']                   = $this->input->post('address');

        $this->form_validation->set_rules('fullname', 'Fullname', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[profile.email]');
        $this->form_validation->set_rules('phone', 'Phone');
        $this->form_validation->set_rules('gender', 'Gender');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        $this->form_validation->set_rules('date', 'Date');

        if (!empty($_FILES['userfile']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            // $config['max_size']      = 4096;
            // $config['max_width']     = 2000;
            // $config['max_height']    = 2000;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('userfile')) {
                $error = $this->upload->display_errors();
                // print_r($error); //debug it here 
                // $this->load->view('add/profile', $error);
                // redirect('add/profile');
            } else {
                $post_image            = $this->upload->data();
                $data['image'] = $post_image['file_name'];
            }
        }

        if ($this->form_validation->run() == true) {
            $result = $this->profile_model->save_profile_info($data);
            
            if ($result) {
                redirect('/');
            } else {
                redirect('add/profile');
            }
        } else {
            redirect('add/profile');
        }
		
	}

    public function delete_profile($id)
    {
        $delete_image = $this->get_image_by_id($id);
        unlink('uploads/' . $delete_image->image);
        $result = $this->profile_model->delete_profile_info($id);
        if ($result) {
            redirect('/');
        } else {
            redirect('/');
        }
    }

    private function get_image_by_id($id)
    {
        $this->db->select('image');
        $this->db->from('profile');
        $this->db->where('profile.id', $id);
        $info = $this->db->get();
        return $info->row();
    }

    public function edit_profile($id)
	{
        $data                           = array();
        $data['profile_info_by_id']     = $this->profile_model->edit_profile_info($id);
        $this->load->view('header');
		$this->load->view('edit_profile', $data);
        $this->load->view('footer');
	}

    public function update_profile($id)
    {
        $data                              = array();
        $date                              = date("d/m/Y");
        $data['update_date']               = $date;
        $data['fullname']                  = $this->input->post('name');
        $data['username']                  = $this->input->post('username');
        $data['password']                  = md5($this->input->post('password'));
        $data['email']                     = $this->input->post('email');
        $data['phone']                     = $this->input->post('phone');
        $data['gender']                    = $this->input->post('gender');
        $data['address']                   = $this->input->post('address');
        $profile_delete_image              = $this->input->post('profile_delete_image');

        $delete_image = substr($profile_delete_image, strlen(base_url()));

        $this->form_validation->set_rules('fullname', 'Fullname', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('phone', 'Phone');
        $this->form_validation->set_rules('gender', 'Gender');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        $this->form_validation->set_rules('date', 'Date');

        if (!empty($_FILES['userfile']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            // $config['max_size']      = 4096;
            // $config['max_width']     = 2000;
            // $config['max_height']    = 2000;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('userfile')) {
                $error = $this->upload->display_errors();
                // print_r($error); //debug it here 
                // $this->load->view('add/profile', $error);
                // redirect('add/profile');
            } else {
                $post_image            = $this->upload->data();
                $data['image'] = $post_image['file_name'];
                unlink($delete_image);
            }
        }
        if ($this->form_validation->run() == true) {

            $result = $this->profile_model->update_profile_info($data, $id);

            if ($result) {
                redirect('/');
            } else {
                redirect('edit/profile');
            }
        } else {
            redirect('edit/profile');
        }
    }
}