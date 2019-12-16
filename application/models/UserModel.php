<?php

class UserModel extends ci_model
{
	public function getUserDetail($userId)
	{
		$query = "SELECT * FROM `users` LEFT JOIN user_details on users.user_id=user_details.user_id where users.user_id='".$userId."'";

		$q = $this->db->query($query)->result_array();
		return $this->db->affected_rows() ? $q : false;
	}
	public function getAllUser($parentId)
	{
		$query = "SELECT * FROM `users` LEFT JOIN user_details on users.user_id=user_details.user_id where users.parent_id='".$parentId."'";

		$q = $this->db->query($query)->result_array();
		return $this->db->affected_rows() ? $q : false;
	}
}