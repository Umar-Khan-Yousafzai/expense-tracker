<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;



/**
 * UserService
 */
class UserService
{
    /**
     * Get all users that are not deleted.
     *
     * @return array
     */
    public function getAllUsers(): array
    {
        return User::whereNull('deleted_at')->get()->toArray();
    }//end getAllUsers()


    /**
     * Get a single user by ID.
     *
     * @param  integer $id The ID of the user.
     * @return User
     * @throws ModelNotFoundException If the user is not found.
     */
    public function getUserById(int $id): User
    {
        return User::where('id', $id)->whereNull('deleted_at')->firstOrFail();
    }//end getUserById()


    /**
     * Soft delete a user by ID.
     *
     * @param  integer $id The ID of the user.
     * @return boolean
     * @throws ModelNotFoundException If the user is not found.
     */
    public function deleteUser(int $id): bool
    {
        $user             = $this->getUserById($id);
        $user->deleted_at = now();
        return $user->save();
    }//end deleteUser()


    /**
     * Create a new user.
     *
     * @param  array $data The data for the new user.
     * @return User
     */
    public function createUser(array $data): User
    {
        return User::create($data);
    }//end createUser()


    /**
     * Edit an existing user by ID.
     *
     * @param  integer $id   The ID of the user.
     * @param  array   $data The data to update the user with.
     * @return User
     * @throws ModelNotFoundException If the user is not found.
     */
    public function editUser(int $id, array $data): User
    {
        $user = $this->getUserById($id);
        $user->update($data);
        return $user;
    }//end editUser()


}//end class
