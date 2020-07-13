<?php namespace App\Models;
use CodeIgniter\Model;

class Mdl_user extends Model
{
	protected $table = 'user';
	public function get_data($username, $password)
	{
        return $this->db->table($this->table)
        ->where(array('username' => $username, 'password' => $password))
        ->get()->getRowArray();
	}

	public function get_user($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}

		return $this->getWhere(['id' => $id]);
	}

	public function saveUser($data)
	{
		$query = $this->db->table($this->table)
			->insert($data);
		return $query;
	}

	public function deleteUser($id)
	{
		$query = $this->db->table($this->table)
			->delete(['id' => $id]);
		return $query;
	}

	public function updateUser($data, $id)
	{
		return $this->db->table('user')->update($data, ['id' => $id]);
	}

	
}
