<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use MongoDB\BSON\ObjectId;

#[Document]
class Task
{
    #[ODM\Id]
    private string $id;

    public function __construct(
        #[ODM\Field(type: "string")]
        private string $name,
    ) {
        $this->id = (string) (new ObjectId());
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}