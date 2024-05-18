<?php
namespace Thecoachsmb\Mymodule\Api;

interface RestapiInterface
{
   /**
    * Get posts data
    *
    * @param int|null $id
    * @return array
    */
   public function getPosts($id = null);

   /**
    * Add a new post
    *
    * @param int $userId
    * @param string $title
    * @param string $body
    * @return string
    * @throws \InvalidArgumentException
    */
    public function addPosts($userId, $title, $body);


    /**
    * Delete a post by ID
    *
    * @param int $id
    * @return array
    */
    public function deletePost($id);

    /**
 * Update a post by ID
 *
 * @param int $id
 * @param int $userId
 * @param string $title
 * @param string $body
 * @return array
 */
public function updatePost($id, $userId, $title, $body);


}