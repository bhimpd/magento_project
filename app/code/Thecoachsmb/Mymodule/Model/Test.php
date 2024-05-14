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

    /**
     * {@inheritdoc}
     */
    public function getPosts($id = null)
    {
        // Validate ID if provided
        if ($id !== null) {
            if (!is_numeric($id)) {
                throw new InvalidArgumentException("ID must be numeric.");
            }
            $id = (int)$id;
        }

        // Fetch data based on ID if provided
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('posts');
        $select = $connection->select()->from($tableName);
        
        if ($id !== null) {
            $select->where('id = ?', $id);
        }

        $posts = $connection->fetchAll($select);

        // Handle case where ID does not exist
        if ($id !== null && empty($posts)) {
            throw new InvalidArgumentException("No data found for ID $id.");
        }

        return $posts;
    }


      /**
     * {@inheritdoc}
     */
    public function addPosts($userId, $title, $body)
    {
        // Validate input data
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

        // Add new post to the database
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('posts');
        
        $data = [
            'userId' => $userId,
            'title' => $title,
            'body' => $body,
        ];

        $connection->insert($tableName, $data);

        // Get the last inserted ID
        $lastInsertId = $connection->lastInsertId();

        // Prepare the response
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

            // Encode the response data as JSON
        $jsonResponse = json_encode($responseData);

        // Set the Content-Type header to indicate JSON
        header('Content-Type: application/json');

        // Output the JSON response
        echo $jsonResponse;

        // Stop further execution
        exit;
    }

    /**
     * {@inheritdoc}
     */
    public function deletePost($id)
    {
        // Validate ID
        if (!is_numeric($id)) {
            return [
                "status" => false,
                "message" => "ID must be numeric."
            ];
        }
        
        // Check if post with given ID exists
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

        // Delete post
        $connection->delete($tableName, ['id = ?' => $id]);

        // Prepare response
        return [
            "status" => true,
            "message" => "Post with ID $id deleted successfully."
        ];
    }


        /**
 * {@inheritdoc}
 */
public function updatePost($id, $userId, $title, $body)
{
    // Validate ID
    if (!is_numeric($id)) {
        throw new InvalidArgumentException("ID must be numeric.");
    }
    
    // Check if post with given ID exists
    $connection = $this->resourceConnection->getConnection();
    $tableName = $this->resourceConnection->getTableName('posts');
    $select = $connection->select()->from($tableName)->where('id = ?', $id);
    $post = $connection->fetchRow($select);

    if (!$post) {
        throw new InvalidArgumentException("No post found with ID $id.");
    }

    // Validate input data
    $this->validateInputData(compact('userId', 'title', 'body'));

    // Further processing logic for updating the post
    $connection = $this->resourceConnection->getConnection();
    $tableName = $this->resourceConnection->getTableName('posts');

    $data = [
        'userId' => $userId,
        'title' => $title,
        'body' => $body,
    ];

    $connection->update($tableName, $data, ['id = ?' => $id]);

    $responseData = [
        "status" => true, // Set status to boolean true
        "message" => "Post updated successfully",
        "data" => [
            "id" => $id,
            "userId" => $userId,
            "title" => $title,
            "body" => $body
        ]
    ];
    
    // Encode the response data as JSON
    $jsonResponse = json_encode($responseData);

    // Set the Content-Type header to indicate JSON
    header('Content-Type: application/json');

    // Output the JSON response
    echo $jsonResponse;

    // Stop further execution
    exit;
}




    /**
     * Validate input data for update operation
     *
     * @param array $postData
     * @throws InvalidArgumentException
     */
    protected function validateInputData($postData)
    {
        // Check if required fields are present
        if (!isset($postData['userId'], $postData['title'], $postData['body'])) {
            throw new InvalidArgumentException('Required fields are missing.');
        }

        // Validate userId
        if (!is_numeric($postData['userId'])) {
            throw new InvalidArgumentException('userId must be numeric.');
        }

      
    }
    
}