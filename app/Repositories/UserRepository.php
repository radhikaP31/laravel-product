<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{

    /**
    * @var array
    */
    protected $fieldsearchable = ['name'];

    /** Return searchable fields.
    *   @return array
    */
    public function getFieldsSearchable()
    { 
        return $this->fieldsearchable;
    }

    /**
    *   Configure the Model
    **/
    public function model()
    {
        return User::class;
    }


    /**
     * get all user data
     */
    public function all()
    {
        return User::paginate(5);
    }

    /**
     * get all user data
     */
    public function getUserById($id = '')
    {
        return User::findOrFail($id);
    }

}
?>