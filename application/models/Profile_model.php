<?php

class Profile_Model extends CI_Model
{
    public function save_profile_info($data)
    {
        return $this->db->insert('profile', $data);
    }

    public function get_all_profile()
    {
        $this->db->select('*');
        $this->db->from('profile');
        $this->db->order_by('profile.id', 'DESC');
        $info = $this->db->get();
        return $info->result();
    }

    public function delete_profile_info($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('profile');
    }

    public function edit_profile_info($id)
    {
        $this->db->select('*');
        $this->db->from('profile');
        $this->db->where('profile.id', $id);
        $info = $this->db->get();
        return $info->row();
    }

    public function update_profile_info($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('profile', $data);
    }

}