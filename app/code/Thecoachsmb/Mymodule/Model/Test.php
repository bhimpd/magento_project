<?php
namespace Thecoachsmb\Mymodule\Model;

use Thecoachsmb\Mymodule\Api\RestapiInterface;
use Magento\Framework\App\ResourceConnection;
use InvalidArgumentException;

class Test implements RestapiInterface
{
    protected $resourceConnection;

    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        $this->resourceConnection = $resourceConnection;
    }

    public function getPosts($id = null)
    {
        try {
            if ($id !== null) {
                if (!is_numeric($id)) {
                    throw new InvalidArgumentException("ID must be numeric.");
                }
                $id = (int)$id;
            }

            $connection = $this->resourceConnection->getConnection();
            $tableName = $this->resourceConnection->getTableName('posts');
            $select = $connection->select()->from($tableName);
            
            if ($id !== null) {
                $select->where('id = ?', $id);
            }

            $posts = $connection->fetchAll($select);

            if ($id !== null && empty($posts)) {
                throw new InvalidArgumentException("No data found for ID $id.");
            }

            return $posts;
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function addPosts($userId, $title, $body)
    {
        try {
            if (!is_numeric($userId)) {
                return [
                    "status" => false,
                    "message" => "User ID must be numeric."
                ];
            }
            
            if (empty($title) || empty($body)) {
                return [
                    "status" => false,
                    "message" => "Title and body cannot be empty."
                ];
            }

            $connection = $this->resourceConnection->getConnection();
            $tableName = $this->resourceConnection->getTableName('posts');
            
            $data = [
                'userId' => $userId,
                'title' => $title,
                'body' => $body,
            ];

            $connection->insert($tableName, $data);
            $lastInsertId = $connection->lastInsertId();

            $responseData = [
                "status" => true,
                "message" => "Data inserted successfully",
                "data" => [
                    "id" => $lastInsertId,
                    "userId" => $userId,
                    "title" => $title,
                    "body" => $body
                ]
            ];

            $jsonResponse = json_encode($responseData);
            header('Content-Type: application/json');
            echo $jsonResponse;
            exit;
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function deletePost($id)
    {
        try {
            if (!is_numeric($id)) {
                return [
                    "status" => false,
                    "message" => "ID must be numeric."
                ];
            }
            
            $connection = $this->resourceConnection->getConnection();
            $tableName = $this->resourceConnection->getTableName('posts');
            $select = $connection->select()->from($tableName)->where('id = ?', $id);
            $post = $connection->fetchRow($select);

            if (!$post) {
                return [
                    "status" => false,
                    "message" => "No post found with ID $id."
                ];
            }

            $connection->delete($tableName, ['id = ?' => $id]);

            return [
                "status" => true,
                "message" => "Post with ID $id deleted successfully."
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function updatePost($id, $userId, $title, $body)
    {
        try {
            if (!is_numeric($id) || !is_numeric($userId)) {
                return [
                    "status" => false,
                    "message" => "ID and User ID must be numeric."
                ];
            }

            if (empty($title) || empty($body)) {
                return [
                    "status" => false,
                    "message" => "Title and body cannot be empty."
                ];
            }
            
            $connection = $this->resourceConnection->getConnection();
            $tableName = $this->resourceConnection->getTableName('posts');
            
            $data = [
                'userId' => $userId,
                'title' => $title,
                'body' => $body,
            ];

            $connection->update($tableName, $data, ['id = ?' => $id]);

            return [
                "status" => true,
                "message" => "Post with ID $id updated successfully."
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
