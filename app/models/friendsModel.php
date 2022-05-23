<?php

class FriendsModel {
    private $connection;

    function __construct(){
        require __DIR__ . '/../db.php';
        $this->connection = $db;
    }

    function getAllFriendsRequestsAccepter($userid, $status){
        $query = $this->connection->prepare('SELECT * FROM friends WHERE accepter=:userid AND status=:status;');
        $query->execute([
            ':userid'=>$userid,
            ':status'=>$status
        ]);

        return $query;
    }
    function getAllFriendsRequestsBoth($userid, $status){
        $query = $this->connection->prepare('SELECT * FROM friends WHERE (accepter=:userid OR requester=:userid) AND status=:status;');
        $query->execute([
            ':userid'=>$userid,
            ':status'=>$status
        ]);

        return $query;
    }
    function insertFriendRequest($requester, $accepter, $status){
        $query = $this->connection->prepare('INSERT INTO friends (accepter, requester, status) VALUES ( :accepter, :requester, :status);');
        $query->execute([
            ':requester'=>$requester,
            ':accepter'=>$accepter,
            ':status'=>$status
        ]);
    }
    function updateRequestStatus($user1, $user2, $status){
        $query = $this->connection->prepare('UPDATE friends SET status=:status WHERE (accepter = :user1 AND requester = :user2) OR (accepter = :user2 AND requester = :user1);');
        $query->execute([
            ':user1'=>$user1,
            ':user2'=>$user2,
            ':status'=>$status
        ]);
    }
    function deleteFriend($user1, $user2){
        $query = $this->connection->prepare('DELETE FROM friends WHERE (accepter = :user1 AND requester = :user2) OR (accepter = :user2 AND requester = :user1);');
        $query->execute([
            ':user1'=>$user1,
            ':user2'=>$user2
        ]);
    }

}