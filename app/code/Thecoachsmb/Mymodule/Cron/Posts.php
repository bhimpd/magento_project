<?php

namespace Thecoachsmb\Mymodule\Cron;

use Magento\Framework\App\ResourceConnection;
use Psr\Log\LoggerInterface;

class Posts
{
    protected $resourceConnection;
    protected $logger;

    public function __construct(
        ResourceConnection $resourceConnection,
        LoggerInterface $logger
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->logger = $logger;
    }

    public function execute()
    {
        try {
            // Fetch data from the REST API
            $apiUrl = 'https://jsonplaceholder.typicode.com/posts';
            $response = file_get_contents($apiUrl);
            $this->logger->info("API Response: " . $response);

            // Decode API response
            $postsData = json_decode($response, true);
            $this->logger->info("Decoded Data: " . print_r($postsData, true));

            if (!empty($postsData)) {
                // Store data in the database table "posts"
                $this->storePostsData($postsData);

                // Log the fetched data in the posts.log file
                $this->logPostsData();
            } else {
                $this->logger->error("No data received from the API.");
            }

            return $this;
        } catch (\Exception $e) {
            $this->logger->error("Error: " . $e->getMessage());
            return $this;
        }
    }

    protected function storePostsData($postsData)
    {
        try {
            $connection = $this->resourceConnection->getConnection();
            $tableName = $connection->getTableName('posts');

            $data = [];
            foreach ($postsData as $post) {
                $data[] = [
                    'id' => $post['id'],
                    'userId' => $post['userId'],
                    'title' => $post['title'],
                    'body' => $post['body'],
                ];
            }

            $connection->insertMultiple($tableName, $data);
            $this->logger->info("Data stored successfully in the database.");
        } catch (\Exception $e) {
            $this->logger->error("Error storing data in the database: " . $e->getMessage());
        }
    }

    protected function logPostsData()
    {
        try {
            $connection = $this->resourceConnection->getConnection();
            $tableName = $connection->getTableName('posts');
            $posts = $connection->fetchAll("SELECT * FROM $tableName");

            $logMessage = '';
            foreach ($posts as $post) {
                $logMessage .= "ID: " . $post['id'] . ", Title: " . $post['title'] . ", Body: " . $post['body'] . "\n";
            }

            $fileDirectory = BP . '/var/log/posts.log';
            file_put_contents($fileDirectory, $logMessage, FILE_APPEND);
            $this->logger->info("Data logged successfully in the posts.log file.");
        } catch (\Exception $e) {
            $this->logger->error("Error logging data to the posts.log file: " . $e->getMessage());
        }
    }
}