<?php

namespace App\Model;

use App\Core\DbModel;

class Item extends DbModel{

    const STATUS = [
        0 => 'Finished',
        1 => 'Active'
    ];

    protected string $title;
    protected string $dater;
    protected int $status;

    public function __construct()
    {
        $this->status = 1;
        
    }

    public function tableName(): string {

        return 'items';

    }

    public function attributes(): array
    {
        return ['title', 'dater', 'status'];
    }

    public function rules() :array {

        return [
            'title' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3],[self::RULE_MAX, 'max' => 50]],
            'dater' => [self::RULE_REQUIRED]
        ];

    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Get the value of dater
     */ 
    public function getDater()
    {
        return $this->dater;
    }

    /**
     * Set the value of dater
     *
     * @return  self
     */ 
    public function setDater($dater)
    {
        $this->dater = $dater;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    public static function findAllActive() {

        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE status = 1 ORDER BY dater ASC");
        $statement->execute();

        return $statement->fetchAll();

    }

    public function update($id, $column, $value) {

        $tableName = static::tableName();
        $statement = self::prepare("UPDATE $tableName SET $column = $value WHERE id = $id");

        $statement->execute();

    }
}