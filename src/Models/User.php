<?php

class User implements JsonSerializable
{
    private $userId, $login, $userName, $userPhoto;
	function __construct($userId, $login, $userName, $userPhoto)
    {
        $this->userId = $userId;
        $this->login = $login;
        $this->userName = $userName;
        $this->userPhoto = $userPhoto;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }/**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }/**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }/**
     * @return mixed
     */
    public function getUserPhoto()
    {
        return $this->userPhoto;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'userId' => $this->userId,
            'login' => $this->login,
            'userName' => $this->userName,
            'userPhoto'=> $this->userPhoto
        ];
    }
}